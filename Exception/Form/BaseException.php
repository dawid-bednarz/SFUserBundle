<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pl )
 */
declare(strict_types=1);

namespace DawBed\UserBundle\Exception\Form;

use Symfony\Component\Form\Form;
use DawBed\UserBundle\Exception\IUserBundleException;

class BaseException extends \Exception implements IUserBundleException
{
    private $form;

    function __construct(Form $form)
    {
        $this->form = $form;
    }

    public function getForm(): Form
    {
        return $this->form;
    }
}