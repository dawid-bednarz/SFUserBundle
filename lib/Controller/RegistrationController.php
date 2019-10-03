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
use DawBed\UserBundle\Model\Criteria\CreateCriteria;
use DawBed\UserRegistrationBundle\Event\Events;
use DawBed\UserRegistrationBundle\Event\RequestEvent;
use DawBed\UserRegistrationBundle\Event\ResponseEvent;
use DawBed\UserRegistrationBundle\Service\StatusFactoryService;
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
        StatusFactoryService $statusFactoryService): Response
    {
        $this->eventDispatcher->dispatch(new RequestEvent($request));

        $criteria = new CreateCriteria($statusFactoryService->build(StatusFactoryService::REGISTRATION_ID));
        $model = $createService->prepareModel($criteria);

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