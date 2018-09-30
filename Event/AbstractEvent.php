<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pro )
 */
declare(strict_types=1);

namespace DawBed\UserBundle\Event;

use Symfony\Component\EventDispatcher\Event;

abstract class AbstractEvent extends Event implements EventNameInterface
{
    public function __toString(): string
    {
        return $this::getName();
    }
}