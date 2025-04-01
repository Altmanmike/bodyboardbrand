<?php

namespace App\Tests;

use App\Entity\CategoryPost;
use PHPUnit\Framework\TestCase;

class CategoryPostTest extends TestCase
{
    public function testCategoryPostEntity()
    {
        $category = new CategoryPost();
        $category->setName('Techniques');

        $this->assertEquals('Techniques', $category->getName());
    }
}
