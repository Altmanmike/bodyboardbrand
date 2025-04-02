<?php

namespace App\Tests;

use App\Entity\Innovation;
use PHPUnit\Framework\TestCase;

final class InnovationTest extends TestCase
{
    public function testInnovationSettersAndGetters()
    {
        $innovation = new Innovation();
        $innovation->setTitle('Stinger+ FlexTech');
        $innovation->setContent('Renforcement intelligent des planches lors des impacts');

        // Valeurs
        $this->assertEquals('Stinger+ FlexTech', $innovation->getTitle());
        $this->assertEquals('Renforcement intelligent des planches lors des impacts', $innovation->getContent());

        // Types
        $this->assertIsString($innovation->getTitle());
        $this->assertIsString($innovation->getContent());

        // Contenu
        $this->assertStringContainsString('FlexTech', $innovation->getTitle());
        $this->assertStringStartsWith('Renforcement', $innovation->getContent());
    }
}
