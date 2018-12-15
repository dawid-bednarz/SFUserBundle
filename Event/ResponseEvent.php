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

    function __construct(UserInterface $user)
    {
        $this->user = $user;
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