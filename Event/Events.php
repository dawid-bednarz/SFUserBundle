<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pro )
 */
declare(strict_types=1);

namespace DawBed\UserBundle\Event;

class Events implements \IteratorAggregate
{
    const REQUIRED = 1;
    const OPTIONAL = 2;

    const REGISTRATION_RESPONSE = 'user.registration.response';
    const REGISTRATION_REQUEST = 'user.registration.request';
    const GET_USER_ENTITY = 'user.get.entity';

    const ALL = [
        self::REGISTRATION_RESPONSE => self::REQUIRED,
        self::REGISTRATION_REQUEST => self::OPTIONAL,
        self::GET_USER_ENTITY => self::OPTIONAL
    ];

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator(self::ALL);
    }

    public function getRequired()
    {
        return new class($this->getIterator()) extends \FilterIterator
        {
            public function accept()
            {
                return $this->getInnerIterator()->current() == Events::REQUIRED;
            }
        };
    }
}