<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pro )
 */
declare(strict_types=1);

namespace DawBed\UserRegistrationBundle\Event;

use DawBed\ComponentBundle\Event\AbstractEvents;

class Events extends AbstractEvents
{
    const REGISTRATION_RESPONSE = 'user.registration.response';
    const REGISTRATION_REQUEST = 'user.registration.request';

    const ALL = [
        self::REGISTRATION_RESPONSE => self::REQUIRED,
        self::REGISTRATION_REQUEST => self::OPTIONAL
    ];

    protected function getAll(): array
    {
        return self::ALL;
    }

}