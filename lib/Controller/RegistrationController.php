<?php
/**
 * Created by PhpStorm.
 * User: q3
 * Date: 17.08.2018
 * Time: 20:31
 */

namespace DawBed\UserRegistrationBundle\Controller;

use DawBed\ComponentBundle\Enum\WriteTypeEnum;
use DawBed\ComponentBundle\Helper\EventResponseController;
use DawBed\StatusBundle\Provider;
use DawBed\UserBundle\Model\Criteria\WriteCriteria;
use DawBed\UserRegistrationBundle\Enum\StatusEnum;
use DawBed\UserRegistrationBundle\Event\RequestEvent;
use DawBed\UserRegistrationBundle\Event\ResponseEvent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use DawBed\UserRegistrationBundle\Form\Registration\RegistrationType;
use DawBed\UserBundle\Service\WriteService;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController extends AbstractController
{
    use EventResponseController;

    public function registration(
        Request $request,
        WriteService $createService,
        Provider $statusProvider): Response
    {
        $this->dispatch(new RequestEvent($request));
  
        $model = $createService->prepareModel(
            (new WriteCriteria(WriteTypeEnum::CREATE))
                ->setStatus($statusProvider->get(StatusEnum::REGISTRATION))
        );

        $form = $this->createForm(RegistrationType::class, $model);

        $form->handleRequest($request);

        if (!$form->isSubmitted()) {
            return $this->notSubmittedForm();
        }
        if (!$form->isValid()) {
            return $this->invalidForm($form);
        }

        $em = $createService->make($form->getData());

        $response = $this->response(new ResponseEvent($model->getEntity(), $model->getPassword()));

        $em->flush();

        return $response;
    }

}