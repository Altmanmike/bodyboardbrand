<?php

namespace App\Tests;

use App\Entity\CategoryVideo;
use PHPUnit\Framework\TestCase;

class CategoryVideoTest extends TestCase
{
    public function testCategoryVideoEntity()
    {
        $category = new CategoryVideo();
        $category->setName('Best tricks');

        $this->assertEquals('Best tricks', $category->getName());
    }
}
