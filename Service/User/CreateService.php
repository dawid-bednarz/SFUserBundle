<?php
/**
 * Created by PhpStorm.
 * User: q3
 * Date: 17.08.2018
 * Time: 20:30
 */

namespace DawBed\UserBundle\Service\User;

use DawBed\SOLID\Service\IMakeEntity;
use DawBed\UserBundle\Domain\User\CreateModel;
use DawBed\UserBundle\Entity\User\Status\UserStatus;
use DawBed\UserBundle\Event\Entity\GetUserEntityEvent;
use DawBed\UserBundle\Service\EventDispatcher;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class CreateService implements IMakeEntity
{
    private $entityManager;
    private $model;

    function __construct($userEntity, EntityManagerInterface $entityManager, EventDispatcherInterface $eventDispatcher)
    {
        $this->entityManager = $entityManager;
        $getUserEntityEvent = new GetUserEntityEvent;
        $eventDispatcher->dispatch((string)$getUserEntityEvent, $getUserEntityEvent);
        $this->model = new CreateModel($getUserEntityEvent->getEntity(), new UserStatus(UserStatus::DISABLED));
    }

    public function getModel()
    {
        return $this->model;
    }

    public function entity(): EntityManagerInterface
    {
        $this->model->make();

        $this->entityManager->persist($this->model->getEntity());

        return $this->entityManager;
    }
}