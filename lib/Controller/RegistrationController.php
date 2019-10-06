<?php
/**
 * Created by PhpStorm.
 * User: q3
 * Date: 17.08.2018
 * Time: 20:31
 */

namespace DawBed\UserRegistrationBundle\Controller;

use DawBed\ComponentBundle\Event\Error\ExceptionErrorEvent;
use DawBed\ComponentBundle\Event\Error\FormErrorEvent;
use DawBed\ComponentBundle\Exception\Form\IsNotSubmitException;
use DawBed\ComponentBundle\Service\EventDispatcher;
use DawBed\StatusBundle\Provider;
use DawBed\UserBundle\Model\Criteria\CreateCriteria;
use DawBed\UserRegistrationBundle\Enum\StatusEnum;
use DawBed\UserRegistrationBundle\Event\Events;
use DawBed\UserRegistrationBundle\Event\RequestEvent;
use DawBed\UserRegistrationBundle\Event\ResponseEvent;
use DawBed\UserRegistrationBundle\Validator\ValidatorGroup;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use DawBed\UserRegistrationBundle\Form\Registration\RegistrationType;
use DawBed\UserBundle\Service\CreateService;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController extends AbstractController
{
    private $eventDispatcher;

    function __construct(EventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function registration(
        Request $request,
        CreateService $createService,
        Provider $statusProvider): Response
    {
        $this->eventDispatcher->dispatch(new RequestEvent($request));

        $model = $createService->prepareModel(
            (new CreateCriteria())->setStatus($statusProvider->build(StatusEnum::REGISTRATION))
        );

        $form = $this->createForm(RegistrationType::class, $model, [
            'method' => 'POST'
        ]);

        $form->handleRequest($request);

        if (!$form->isSubmitted()) {
            return $this->eventDispatcher->dispatch(new ExceptionErrorEvent(Events::REGISTRATION_ERROR, new IsNotSubmitException()))
                ->getResponse();
        }
        if (!$form->isValid()) {
            return $this->eventDispatcher->dispatch(new FormErrorEvent(Events::REGISTRATION_ERROR, $form))
                ->getResponse();
        }

        $em = $createService->make($form->getData());

        $response = $this->eventDispatcher->dispatch(new ResponseEvent($model->getEntity(), $model->getPassword()))
            ->getResponse();

        $em->flush();

        return $response;
    }

}