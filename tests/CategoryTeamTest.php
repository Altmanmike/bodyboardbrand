<?php

namespace App\Tests;

use App\Entity\CategoryTeam;
use PHPUnit\Framework\TestCase;

class CCategoryTeamTest extends TestCase
{
    public function testCategoryTeamEntity()
    {
        $category = new CategoryTeam();
        $category->setName('Commerciaux');

        $this->assertEquals('Commerciaux', $category->getName());
    }
}
