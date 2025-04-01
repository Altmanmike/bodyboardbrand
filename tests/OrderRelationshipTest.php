<?php

namespace App\Tests;

use App\Entity\OrderFull;
use App\Entity\OrderLine;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class OrderRelationshipTest extends TestCase
{
    public function testOrderFullWithOrderLines()
    {
        $order = new OrderFull();

        $product1 = (new Product())->setTitle('Palmes Pro');
        $product2 = (new Product())->setTitle('Combinaison 3mm');

        $line1 = (new OrderLine())->setProduct($product1)->setQuantity(2)->setPrice(50);
        $line2 = (new OrderLine())->setProduct($product2)->setQuantity(1)->setPrice(99);

        $order->addOrderLine($line1);
        $order->addOrderLine($line2);

        $this->assertCount(2, $order->getOrderLines());
        $this->assertSame($order, $line1->getOrderFull());
        $this->assertSame($order, $line2->getOrderFull());

        // Total estimé
        $expectedTotal = $line1->getQuantity() * $line1->getPrice() + $line2->getQuantity() * $line2->getPrice();
        $this->assertEquals(199, $expectedTotal);
    }
}
