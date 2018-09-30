<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
declare(strict_types=1);

namespace DawBed\UserBundle\Event;

interface EventNameInterface
{
    public static function getName(): string;

    public function __toString(): string;
}