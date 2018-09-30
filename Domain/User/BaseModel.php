<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pl )
 */
declare(strict_types=1);

namespace DawBed\UserBundle\Domain\User;

use DawBed\UserBundle\Entity\User\User;

abstract class BaseModel
{
    protected $entity;
    protected $password;

    function __construct(User $entity)
    {
        $this->entity = $entity;
    }

    public function getEntity(): User
    {
        return $this->entity;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function hashPassword()
    {
        return password_hash($this->password, PASSWORD_ARGON2I);
    }
}