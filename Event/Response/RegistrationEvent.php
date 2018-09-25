<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pl )
 */
declare(strict_types=1);

namespace DawBed\UserBundle\Event\Response;

use DawBed\UserBundle\Domain\User\CreateModel;
use DawBed\UserBundle\Event\Events;
use Symfony\Component\HttpFoundation\Request;


class RegistrationEvent extends AbstractResponseEvent
{
    private $userModel;

    function __construct(CreateModel $userModel, Request $request)
    {
        $this->userModel = $userModel;

        parent::__construct($request);
    }

    public function getUserModel(): CreatorModel
    {
        return $this->userModel;
    }

    public static function getName(): string
    {
        return Events::REGISTRATION_RESPONSE;
    }

}