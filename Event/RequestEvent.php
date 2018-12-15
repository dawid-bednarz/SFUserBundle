<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pro )
 */
declare(strict_types=1);

namespace DawBed\UserRegistrationBundle\Event;

use DawBed\ComponentBundle\Event\AbstractEvent;
use Symfony\Component\HttpFoundation\Request;

class RequestEvent extends AbstractEvent
{
    private $request;

    function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function getName(): string
    {
        return Events::REGISTRATION_REQUEST;
    }
}