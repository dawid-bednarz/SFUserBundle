<?php
/**
 * Created by PhpStorm.
 * User: q3
 * Date: 17.08.2018
 * Time: 20:31
 */

namespace DawBed\UserBundle\Controller\Registration;

use DawBed\UserBundle\Event\Response\RegistrationEvent;
use DawBed\UserBundle\Exception\Form\ErrorException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use DawBed\UserBundle\Form\Registration\RegistrationType;
use DawBed\UserBundle\Service\User\CreateService;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController extends AbstractController
{
    private $eventDispatcher;

    function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function registration(Request $request, CreateService $createService): Response
    {
        $model = $createService->getModel();

        $form = $this->createForm(RegistrationType::class, $model, [
            'method' => 'POST',
            'validation_groups' => ['registration']
        ]);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            throw new ErrorException($form);
        }

        $createService->entity();

        $registrationEvent = new RegistrationEvent($model, $request);
        $this->eventDispatcher->dispatch((string)$registrationEvent, $registrationEvent);
        return $registrationEvent->getResponse();
    }
}