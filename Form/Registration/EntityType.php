<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pro )
 */
declare(strict_types=1);

namespace DawBed\UserRegistrationBundle\Form\Registration;

use DawBed\UserBundle\Entity\User;
use DawBed\UserBundle\Service\EntityService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntityType extends AbstractType
{
    private $entityService;

    function __construct(EntityService $entityService)
    {
        $this->entityService = $entityService;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => $this->entityService->User,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}