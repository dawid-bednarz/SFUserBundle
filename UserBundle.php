<?php

namespace DawBed\UserBundle;

use DawBed\UserBundle\DependencyInjection\UserExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class UserBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new UserExtension();
    }
}