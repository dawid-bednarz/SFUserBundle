<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pro )
 */
declare(strict_types=1);

namespace DawBed\UserBundle\Entity\User\Status;

class UserStatus implements UserStatusInterface
{
    const DISABLED = 1;

    private $status;

    function __construct(int $status)
    {
        if (!in_array($status, [self::DISABLED])) {
            throw new UserStatusException('Unexpected status');
        }
        $this->status = $status;
    }

    public function get(): int
    {
        return $this->status;
    }
}

class UserStatusException extends \Exception
{

}