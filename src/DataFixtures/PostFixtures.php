<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private PostRepository $repo)
    {
    }

    public function load(ObjectManager $manager): void
    {
        // Entrée en bdd d'articles
        $post = new Post();
        $post->setTitle('Exploring the Waves');
        $post->setImage('../../imgs/posts/waves.jpg');
        $post->setContent('Discover the best spots for bodyboarding this summer.');
        $post->setCreatedAt(new \DateTimeImmutable());
        $post->setUpdatedAt(new \DateTimeImmutable());
        $post->setUser($this->getReference('user_1'));
        $post->setCategory($this->getReference('categoryPost_10'));
        $manager->persist($post);

        // Entrée en bdd d'articles
        $post = new Post();
        $post->setTitle('Top 5 Bodyboard Tricks');
        $post->setImage('../../imgs/posts/tricks.jpg');
        $post->setContent('Learn the most exciting tricks to level up your skills.');
        $post->setCreatedAt(new \DateTimeImmutable());
        $post->setUpdatedAt(new \DateTimeImmutable());
        $post->setUser($this->getReference('user_3'));
        $post->setCategory($this->getReference('categoryPost_9'));
        $manager->persist($post);

        // Entrée en bdd d'articles
        $post = new Post();
        $post->setTitle('Maintaining Your Gear');
        $post->setImage('../../imgs/posts/gear.jpg');
        $post->setContent('Tips to ensure your bodyboard and fins last longer.');
        $post->setCreatedAt(new \DateTimeImmutable());
        $post->setUpdatedAt(new \DateTimeImmutable());
        $post->setUser($this->getReference('user_9'));
        $post->setCategory($this->getReference('categoryPost_7'));
        $manager->persist($post);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            CategoryPostFixtures::class,
        ];
    }
}
