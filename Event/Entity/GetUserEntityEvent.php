<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pro )
 */
declare(strict_types=1);

namespace DawBed\UserBundle\Event\Entity;

use DawBed\UserBundle\Entity\User\User;
use DawBed\UserBundle\Entity\User\UserInterface;
use DawBed\UserBundle\Event\AbstractEvent;
use DawBed\UserBundle\Event\Events;

class GetUserEntityEvent extends AbstractEvent
{
    private $entity;

    function __construct()
    {
        $this->entity = new User;
    }

    public function setEntity(UserInterface $entity): void
    {
        $this->entity = $entity;
    }

    public function getEntity(): UserInterface
    {
        return $this->entity;
    }

    public static function getName(): string
    {
        return Events::GET_USER_ENTITY;
    }
}