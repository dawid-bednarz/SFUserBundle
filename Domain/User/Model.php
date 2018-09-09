<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pl )
 */
declare(strict_types=1);

namespace DawBed\UserBundle\Domain\User;

use DawBed\SOLID\Entity\IEntity;
use DawBed\SOLID\Model\IEntityModifier;


class Model implements IEntityModifier
{
    private $entity;

    public function getEntity(): IEntity
    {
        return $this->entity;
    }

    public function setEntity(IEntity $entity): void
    {
        $this->entity = $entity;
    }
}