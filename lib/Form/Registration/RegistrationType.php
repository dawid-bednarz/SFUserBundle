<?php

namespace DawBed\UserRegistrationBundle\Form\Registration;

use DawBed\PHPUser\Model\User\CreateModel;
use DawBed\UserBundle\Service\PasswordService;
use DawBed\UserRegistrationBundle\Validator\ValidatorGroup;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Valid;

class RegistrationType extends AbstractType
{
    private $passwordService;

    function __construct(PasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('entity', EntityType::class, [
                'constraints' => [
                    new Valid(),
                    new NotBlank()
                ],
                'validation_groups' => [ValidatorGroup::REGISTRATION],
                'label' => 'email'
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'constraints' => $this->passwordService->getConstraints(),
                'label' => 'password'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CreateModel::class,
            'method' => Request::METHOD_POST
        ]);
    }

    public function getBlockPrefix()
    {
        return 'UserRegistration';
    }

}