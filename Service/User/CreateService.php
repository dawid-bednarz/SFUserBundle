<?php
/**
 * Created by PhpStorm.
 * User: q3
 * Date: 17.08.2018
 * Time: 20:30
 */

namespace DawBed\UserBundle\Service\User;

use DawBed\ConfirmationBundle\Entity\Token\Type\TokenType;
use DawBed\UserBundle\Domain\User\CreateModel;
use DawBed\UserBundle\Service\EventDispatcher;
use Doctrine\ORM\EntityManagerInterface;
use DawBed\ConfirmationBundle\Entity\Token\Token;
use DawBed\UserBundle\Event\Token\GenerateEvent as GenerateTokenEvent;

class CreateService
{
    protected $entityManager;
    private $eventDispatcher;

    function __construct(EntityManagerInterface $entityManager, EventDispatcher $eventDispatcher)
    {
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function entity(CreateModel $model): EntityManagerInterface
    {
        $entity = $model->make();
        $entity->setActivateToken($this->getActivateToken());
        $this->entityManager->persist($entity);

        return $this->entityManager;
    }

    private function getActivateToken():?Token
    {
        return $this->eventDispatcher->dispatch(new GenerateTokenEvent(new \DateInterval('P1D'), new TokenType(TokenType::PUBLIC)))
            ->getToken();
    }
}