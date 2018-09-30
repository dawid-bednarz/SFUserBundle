<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pro )
 */
declare(strict_types=1);

namespace DawBed\UserBundle\Event\Request;

use DawBed\UserBundle\Event\Events;

class RegistrationEvent extends AbstractRequestEvent
{
    public static function getName(): string
    {
        return Events::REGISTRATION_REQUEST;
    }
}