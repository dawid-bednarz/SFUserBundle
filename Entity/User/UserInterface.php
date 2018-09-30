<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pl )
 */
declare(strict_types=1);

namespace DawBed\UserBundle\Entity\User;
use DawBed\ConfirmationBundle\Entity\Token\Token;
use DawBed\UserBundle\Entity\User\Status\UserStatusInterface;
use DateTime;

interface UserInterface
{
    public function getId():?int;

    public function getEmail(): ?string;

    public function getPassword(): ?string;

    public function setEmail(string $email): UserInterface;

    public function setPassword(string $password): UserInterface;

    public function getStatus(): int;

    public function setStatus(UserStatusInterface $status): UserInterface;

    public function getCreatedAt(): ?DateTime;

    public function setCreatedAt(DateTime $createdAt): UserInterface;

    public function getActivateToken(): ?Token;

    public function setActivateToken(Token $confirmationToken): UserInterface;
}