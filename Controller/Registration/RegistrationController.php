<?php
/**
 * Created by PhpStorm.
 * User: q3
 * Date: 17.08.2018
 * Time: 20:31
 */

namespace DawBed\UserBundle\Controller\Registration;

use DawBed\UserBundle\Exception\Form\ErrorException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use DawBed\UserBundle\Form\Registration\RegistrationType;
use DawBed\UserBundle\Service\User\CreateService;

class RegistrationController extends AbstractController
{
    public function registration(Request $request, CreateService $createService)
    {
        $form = $this->createForm(RegistrationType::class, $createService->getModel(), [
            'method' => 'POST'
        ]);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            throw new ErrorException($form);
        }

        $createService();

        return $createService->getModel();

    }
}