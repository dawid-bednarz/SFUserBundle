<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pl )
 */
declare(strict_types=1);

namespace DawBed\UserRegistrationBundle\Event;

use DawBed\ComponentBundle\Event\AbstractResponseEvent;
use DawBed\PHPUser\UserInterface;

class ResponseEvent extends AbstractResponseEvent implements ResponseInterfaceEvent
{
    protected $user;
    protected $password;

    function __construct(UserInterface $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getName(): string
    {
        return Events::REGISTRATION_RESPONSE;
    }
}