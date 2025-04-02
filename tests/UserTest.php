<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    public function testUserEntity()
    {
        $user = new User();
        $user->setFirstname('Micheline')
             ->setLastname('Dupont')
             ->setEmail('mich@example.com')
             ->setPhone('0623456789');

        $this->assertEquals('Micheline', $user->getFirstname());
        $this->assertEquals('Dupont', $user->getLastname());
        $this->assertEquals('mich@example.com', $user->getEmail());
        $this->assertEquals('0623456789', $user->getPhone());
    }
}
