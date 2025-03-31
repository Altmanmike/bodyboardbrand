<?php

namespace App\Tests;

use App\Entity\Video;
use App\Entity\CategoryVideo;
use PHPUnit\Framework\TestCase;

class VideoTest extends TestCase
{
    public function testVideoSettersAndGetters()
    {
        $video = new Video();
        $category = (new CategoryVideo())->setName('Tutorials');

        $video->setTitle('360° Dropknee Tutorial');
        $video->setUrl('V2pw_Rinnw');
        $video->setDescription('Learn how to do perfect dropknee rotations.');
        $video->setCategory($category);
        $video->setCreatedAt(new \DateTimeImmutable());

        // Valeurs
        $this->assertEquals('360° Dropknee Tutorial', $video->getTitle());
        $this->assertEquals('V2pw_Rinnw', $video->getUrl());
        $this->assertEquals($category, $video->getCategory());

        // Types
        $this->assertIsString($video->getTitle());
        $this->assertIsString($video->getUrl());
        $this->assertIsString($video->getDescription());
        $this->assertInstanceOf(CategoryVideo::class, $video->getCategory());
        $this->assertInstanceOf(\DateTimeImmutable::class, $video->getCreatedAt());

        // Contenu
        $this->assertStringContainsString('Rinnw', $video->getUrl());
        $this->assertStringContainsString('dropknee', strtolower($video->getTitle()));
    }
}
