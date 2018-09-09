<?php
/**
 * Created by PhpStorm.
 * User: q3
 * Date: 17.08.2018
 * Time: 20:30
 */

namespace DawBed\UserBundle\Service\User;

use DawBed\SOLID\Service\IMake;
use DawBed\UserBundle\Domain\User\Model;
use Doctrine\ORM\EntityManagerInterface;

class CreateService implements IMake
{
    private $entityManager;
    private $model;

    function __construct(EntityManagerInterface $entityManager, Model $model)
    {
        $this->entityManager = $entityManager;
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function __invoke(): EntityManagerInterface
    {
        $this->entityManager->persist($this->model->getEntity());

        return $this->entityManager;
    }
}