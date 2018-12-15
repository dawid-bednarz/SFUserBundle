<?php
/**
 * Created by PhpStorm.
 * User: q3
 * Date: 17.08.2018
 * Time: 20:31
 */

namespace DawBed\UserRegistrationBundle\Controller;

use DawBed\ComponentBundle\Event\Error\FormErrorEvent;
use DawBed\ComponentBundle\Service\EventDispatcher;
use DawBed\PHPUser\Model\User\Criteria\CreateCriteria;
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

        $form = $this->createForm(RegistrationType::class, $createService->prepareModel($criteria), [
            'method' => 'POST',
            'validation_groups' => [ValidatorGroup::REGISTRATION]
        ]);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {

            return $this->eventDispatcher->dispatch(new FormErrorEvent(Events::REGISTRATION_ERROR, $form))
                ->getResponse();
        }

        $em = $createService->make($form->getData());

        $response = $this->eventDispatcher->dispatch(new ResponseEvent($form->getData()->getEntity()))
            ->getResponse();

        $em->flush();

        return $response;
    }

}