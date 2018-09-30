<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pro )
 */
declare(strict_types=1);

namespace DawBed\UserBundle\Event\Request;

use DawBed\UserBundle\Event\AbstractEvent;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractRequestEvent extends AbstractEvent
{
    private $request;

    function __construct(Request $request)
    {
        $this->request = $request;
    }

}