<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( info@progresscode.pl )
 */

namespace DawBed\UserBundle\Entity\User;

use DawBed\ConfirmationBundle\Entity\Token\Token;
use DawBed\SOLID\Entity\EntityInterface;
use DawBed\UserBundle\Entity\User\Status\UserStatusInterface;
use DateTime;

class User implements EntityInterface, UserInterface
{
    protected $id;

    protected $email;

    protected $status;

    protected $password;

    protected $createdAt;

    protected $activateToken;

    public function getId():?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setEmail(string $email): UserInterface
    {
        $this->email = $email;

        return $this;
    }

    public function setPassword(string $password): UserInterface
    {
        $this->password = $password;

        return $this;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(UserStatusInterface $status): UserInterface
    {
        $this->status = $status->get();

        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): UserInterface
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getActivateToken(): ?Token
    {
        return $this->activateToken;
    }

    public function setActivateToken(Token $activateToken): UserInterface
    {
        $this->activateToken = $activateToken;

        return $this;
    }

}