<?php

namespace App\Tests;

use App\Entity\CategoryProduct;
use PHPUnit\Framework\TestCase;

final class CategoryProductTest extends TestCase
{
    public function testCategoryProductEntity()
    {
        $category = new CategoryProduct();
        $category->setName('Fins');

        $this->assertEquals('Fins', $category->getName());
    }
}
