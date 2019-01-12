<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
declare(strict_types=1);

namespace DawBed\UserRegistrationBundle\Tests\Controller;

use DawBed\PHPUser\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    private $username = 'test@gmail.com';
    private $password = 'password1234';

    public function test_create_user()
    {
        $client = static::createClient();

        $client->request('POST', '/user/registration/registration', [
            'UserRegistration' => [
                'entity' => [
                    'email' => $this->username
                ],
                'password' => [
                    'first' => $this->password,
                    'second' => $this->password
                ]
            ]]);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $em = $client->getContainer()->get('doctrine.orm.default_entity_manager');
        $repository = $em->getRepository(User::class);
        $user = $repository->findOneByEmail($this->username);
        $this->assertInstanceOf(User::class, $user);
    }

}