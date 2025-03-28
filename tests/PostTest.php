<?php

namespace App\Tests;

use App\Entity\Post;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    public function testPostEntity()
    {
        $post = new Post();
        $user = new User();
        $user->setFirstname("John")->setLastname("Doe");

        $post->setTitle("Mon super post")
             ->setContent("Ceci est un contenu de test")
             ->setUser($user)
             ->setCreatedAt(new \DateTimeImmutable());

        $this->assertEquals("Mon super post", $post->getTitle());
        $this->assertEquals("Ceci est un contenu de test", $post->getContent());
        $this->assertEquals("Doe", $post->getUser()->getLastname());
        $this->assertInstanceOf(\DateTimeImmutable::class, $post->getCreatedAt());
    }
}
