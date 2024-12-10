<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PostFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordEncoder, private PostRepository $repo) {}    

    public function load(ObjectManager $manager): void
    {
        // Entrée en bdd d'articles 
        $post = new Post();
        $post->setTitle('Exploring the Waves');
        $post->setImage('../../imgs/posts/waves.jpg');
        $post->setContent('Discover the best spots for bodyboarding this summer.');
        $post->setAuthor('Jane Doe');
        $post->setCreatedAt(new \DateTimeImmutable());
        $post->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($post);
        $manager->flush();
 
        // Entrée en bdd d'articles
        $post = new Post();
        $post->setTitle('Top 5 Bodyboard Tricks');
        $post->setImage('../../imgs/posts/tricks.jpg');
        $post->setContent('Learn the most exciting tricks to level up your skills.');
        $post->setAuthor('John Smith');
        $post->setCreatedAt(new \DateTimeImmutable());
        $post->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($post);
        $manager->flush();

        // Entrée en bdd d'articles
        $post = new Post();
        $post->setTitle('Maintaining Your Gear');
        $post->setImage('../../imgs/posts/gear.jpg');
        $post->setContent('Tips to ensure your bodyboard and fins last longer.');
        $post->setAuthor('Emily Brown');
        $post->setCreatedAt(new \DateTimeImmutable());
        $post->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($post);
        $manager->flush();
    }
}