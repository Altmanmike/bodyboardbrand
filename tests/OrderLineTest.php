<?php

namespace App\Tests;

use App\Entity\OrderLine;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class OrderLineTest extends TestCase
{
    public function testOrderLineSettersAndGetters()
    {
        $product = (new Product())->setTitle('Board 42"');

        $line = new OrderLine();
        $line->setProduct($product);
        $line->setQuantity(2);
        $line->setPrice(99.95);

        // Valeurs
        $this->assertEquals(2, $line->getQuantity());
        $this->assertEquals(99.95, $line->getPrice());
        $this->assertEquals($product, $line->getProduct());

        // Types
        $this->assertIsInt($line->getQuantity());
        $this->assertIsFloat($line->getPrice());
        $this->assertInstanceOf(Product::class, $line->getProduct());
    }
}
