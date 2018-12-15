<?php

namespace DawBed\UserRegistrationBundle\Form\Registration;

use DawBed\PHPUser\Model\User\CreateModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entity', EntityType::class)
            ->add('password', RepeatedType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CreateModel::class
        ]);
    }

    public function getBlockPrefix()
    {
        return 'UserRegistration';
    }

}