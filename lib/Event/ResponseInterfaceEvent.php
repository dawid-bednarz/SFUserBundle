<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
declare(strict_types=1);

namespace DawBed\UserRegistrationBundle\Event;

use Dawbed\UserBundle\Entity\UserInterface;

interface ResponseInterfaceEvent
{
    public function getUser(): UserInterface;

    public function getName(): string;
}