<?php

namespace App\Tests;

use App\Entity\CategoryProduct;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testProductSettersAndGetters()
    {
        $category = (new CategoryProduct())->setName('Fins');

        $product = new Product();
        $product->setTitle('Turbo Fin Pro');
        $product->setDescription('Palmes de haute performance pour bodyboarders exigeants');
        $product->setPrice(59.99);
        $product->setImages(['/build/images/products/fins.png', '/build/images/products/fins2.png']);
        $product->setCategory($category);

        // Valeurs
        $this->assertEquals('Turbo Fin Pro', $product->getTitle());
        $this->assertEquals('Palmes de haute performance pour bodyboarders exigeants', $product->getDescription());
        $this->assertEquals(59.99, $product->getPrice());
        $this->assertEquals(['/build/images/products/fins.png', '/build/images/products/fins2.png'], $product->getImages());
        $this->assertEquals($category, $product->getCategory());

        // Types
        $this->assertIsString($product->getTitle());
        $this->assertIsString($product->getDescription());
        $this->assertIsFloat($product->getPrice());
        $this->assertIsArray($product->getImages());
        $this->assertInstanceOf(CategoryProduct::class, $product->getCategory());

        // Contenu
        $this->assertStringContainsString('bodyboarders', $product->getDescription());
        $this->assertContains('/build/images/products/fins2.png', $product->getImages());
        $this->assertCount(2, $product->getImages());
    }
}
