<?php

namespace DawBed\UserRegistrationBundle;

use DawBed\ComponentBundle\DependencyInjection\ChildrenBundle\ComponentBundleInterface;
use DawBed\UserRegistrationBundle\DependencyInjection\UserRegistrationExtension;
use DawBed\UserRegistrationBundle\Event\Events;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class UserRegistrationBundle extends Bundle implements ComponentBundleInterface
{
    public function getContainerExtension()
    {
        return new UserRegistrationExtension();
    }

    public static function getEvents(): ?string
    {
        return Events::class;
    }

    public static function getAlias(): string
    {
        return UserRegistrationExtension::ALIAS;
    }
}