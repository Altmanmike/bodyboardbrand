<?php

namespace App\Tests;

use App\Entity\OrderFull;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class OrderFullTest extends TestCase
{
    public function testOrderFullSettersAndGetters()
    {
        $user = (new User())->setEmail('client@kz.com');

        $order = new OrderFull();
        $order->setUser($user);
        $order->setStatus('validée');
        $order->setTotalPrice(189.90);
        $order->setCreatedAt(new \DateTimeImmutable());

        // Valeurs
        $this->assertEquals($user, $order->getUser());
        $this->assertEquals('validée', $order->getStatus());
        $this->assertEquals(189.90, $order->getTotalPrice());

        // Types
        $this->assertInstanceOf(User::class, $order->getUser());
        $this->assertIsString($order->getStatus());
        $this->assertIsFloat($order->getTotalPrice());
        $this->assertInstanceOf(\DateTimeImmutable::class, $order->getCreatedAt());

        // Contenu
        $this->assertStringContainsString('validée', $order->getStatus());
        $this->assertGreaterThan(0, $order->getTotalPrice());
    }
}
