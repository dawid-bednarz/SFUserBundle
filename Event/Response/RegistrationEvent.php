<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pl )
 */
declare(strict_types=1);

namespace DawBed\UserBundle\Event\Response;

use DawBed\UserBundle\Entity\User\UserInterface;
use DawBed\UserBundle\Event\Events;
use Symfony\Component\HttpFoundation\Request;

class RegistrationEvent extends AbstractResponseEvent
{
    private $user;

    function __construct(UserInterface $user, Request $request)
    {
        $this->user = $user;

        parent::__construct($request);
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public static function getName(): string
    {
        return Events::REGISTRATION_RESPONSE;
    }

}