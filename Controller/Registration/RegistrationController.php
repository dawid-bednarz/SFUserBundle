<?php
/**
 * Created by PhpStorm.
 * User: q3
 * Date: 17.08.2018
 * Time: 20:31
 */

namespace DawBed\UserBundle\Controller\Registration;

use DawBed\UserBundle\Domain\User\CreateModel;
use DawBed\UserBundle\Event\Entity\GetUserEntityEvent;
use DawBed\UserBundle\Event\Response\RegistrationEvent as RegistrationResponseEvent;
use DawBed\UserBundle\Exception\Form\ErrorException;
use DawBed\UserBundle\Service\EventDispatcher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use DawBed\UserBundle\Event\Request\RegistrationEvent as RegistrationRequestEvent;
use Symfony\Component\HttpFoundation\Request;
use DawBed\UserBundle\Form\Registration\RegistrationType;
use DawBed\UserBundle\Service\User\CreateService;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController extends AbstractController
{
    private $eventDispatcher;

    function __construct(EventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function registration(Request $request, CreateService $createService): Response
    {
        $this->eventDispatcher->dispatch(new RegistrationRequestEvent($request));

        $entity = $this->eventDispatcher->dispatch(new GetUserEntityEvent)->getEntity();

        $model = new CreateModel($entity);

        $form = $this->createForm(RegistrationType::class, $model, [
            'method' => 'POST',
            'validation_groups' => ['registration']
        ]);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            throw new ErrorException($form);
        }

        $createService->entity($model);

        return $this->eventDispatcher->dispatch(new RegistrationResponseEvent($entity, $request))
            ->getResponse();
    }

}