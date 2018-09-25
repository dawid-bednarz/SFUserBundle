<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pro )
 */
declare(strict_types=1);

namespace DawBed\UserBundle\Domain\User;

use DawBed\UserBundle\Entity\User\Status\UserStatusInterface;
use DawBed\UserBundle\Entity\User\UserInterface;
use \DateTime;

class CreateModel extends BaseModel
{
    protected $password;

    function __construct(UserInterface $user, UserStatusInterface $userStatus)
    {
        $this->entity = $user;
        $this->entity->setStatus($userStatus);
    }

    public function make(): void
    {
        $this->entity
            ->setPassword($this->hashPassword())
            ->setCreatedAt(new DateTime('NOW'));
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    private function hashPassword()
    {
        return password_hash($this->password, PASSWORD_ARGON2I);
    }
}