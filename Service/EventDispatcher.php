<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pro )
 */
declare(strict_types=1);

namespace DawBed\UserBundle\Service;

use DawBed\UserBundle\Event\EventNameInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class EventDispatcher
{
    private $SFEventDispatcher;

    function __construct(EventDispatcherInterface $SFEventDispatcher)
    {
        $this->SFEventDispatcher = $SFEventDispatcher;
    }

    public function dispatch(EventNameInterface $event): Event
    {
        $this->SFEventDispatcher->dispatch((string)$event, $event);

        return $event;
    }

    public function __call(string $name, array $arguments)
    {
        return call_user_func([$this->SFEventDispatcher, $name], ...$arguments);
    }
}