<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
declare(strict_types=1);

namespace DawBed\UserBundle\Event\Token;

use DawBed\ConfirmationBundle\Event\Events;
use DawBed\UserBundle\Event\EventNameInterface;

class GenerateEvent extends \DawBed\ConfirmationBundle\Event\Token\GenerateEvent implements EventNameInterface
{
    public static function getName(): string
    {
        return Events::GENERATE;
    }

    public function __toString(): string
    {
        return $this::getName();
    }
}