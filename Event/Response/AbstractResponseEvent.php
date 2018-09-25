<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pl )
 */
declare(strict_types=1);

namespace DawBed\UserBundle\Event\Response;

use DawBed\UserBundle\Event\AbstractEvent;
use DawBed\UserBundle\Event\EventNameInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractResponseEvent extends AbstractEvent
{
    private $request;
    private $response;

    function __construct(Request $request, ?Response $response = null)
    {
        $this->request = $request;
        $this->response = $response ?? new Response;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    public function getResponse(): Response
    {
        return $this->response;
    }

    public function setResponse(Response $response)
    {
        $this->response = $response;
    }

}