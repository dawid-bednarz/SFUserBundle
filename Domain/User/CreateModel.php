<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pro )
 */
declare(strict_types=1);

namespace DawBed\UserBundle\Domain\User;

use DawBed\UserBundle\Entity\User\Status\UserStatus;
use DawBed\UserBundle\Entity\User\UserInterface;

class CreateModel extends BaseModel
{
    public function make(): UserInterface
    {
        $this->entity->setPassword($this->hashPassword())
            ->setCreatedAt(new \DateTime('NOW'))
            ->setStatus(new UserStatus(UserStatus::DISABLED));

        return $this->entity;
    }
}