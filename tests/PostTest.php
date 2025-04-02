<?php

namespace App\Tests;

use App\Entity\Post;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

final class PostTest extends TestCase
{
    public function testPostSettersAndGetters()
    {
        $user = (new User())
            ->setFirstname('John')
            ->setLastname('Doe');

        $title = 'Test Post';
        $content = 'Ceci est un contenu de test très pertinent pour notre projet.';
        $image = '/build/images/test.jpg';
        $createdAt = new \DateTimeImmutable();
        $updatedAt = new \DateTimeImmutable();

        $post = new Post();
        $post->setTitle($title);
        $post->setContent($content);
        $post->setImage($image);
        $post->setUser($user);
        $post->setCreatedAt($createdAt);
        $post->setUpdatedAt($updatedAt);

        // Valeurs
        $this->assertEquals($title, $post->getTitle());
        $this->assertEquals($content, $post->getContent());
        $this->assertEquals($image, $post->getImage());
        $this->assertEquals($user, $post->getUser());
        $this->assertEquals($createdAt, $post->getCreatedAt());
        $this->assertEquals($updatedAt, $post->getUpdatedAt());

        // Types
        $this->assertIsString($post->getTitle());
        $this->assertIsString($post->getContent());
        $this->assertIsString($post->getImage());
        $this->assertInstanceOf(User::class, $post->getUser());
        $this->assertInstanceOf(\DateTimeImmutable::class, $post->getCreatedAt());
        $this->assertInstanceOf(\DateTimeInterface::class, $post->getUpdatedAt());

        // Contenu
        $this->assertStringContainsString('pertinent', $post->getContent());
        $this->assertStringStartsWith('/build/', $post->getImage());
    }
}
