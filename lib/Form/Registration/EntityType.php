<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pro )
 */
declare(strict_types=1);

namespace DawBed\UserRegistrationBundle\Form\Registration;

use DawBed\PHPClassProvider\ClassProvider;
use DawBed\UserBundle\Entity\AbstractUser;
use DawBed\UserBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ClassProvider::get(AbstractUser::class),
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}