<?php

namespace App\DataFixtures;

use App\Entity\Video;
use App\Repository\VideoRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class VideoFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private VideoRepository $repo)
    {
    }

    public function load(ObjectManager $manager): void
    {
        // Entrée en bdd de vidéos youtube sélectionnées
        $video = new Video();
        $video->setTitle('Another Team Highlights');
        $video->setUrl('ZeivXGDX6Bk');
        $video->setDescription('Best moments from the K&Z team in 2024 competitions.');
        $video->setCreatedAt(new \DateTimeImmutable());
        $video->setUpdatedAt(new \DateTimeImmutable());
        $video->setUser($this->getReference('user_0'));
        $video->setCategory($this->getReference('categoryVideo_0'));
        $manager->persist($video);

        // Entrée en bdd de vidéos youtube sélectionnées
        $video = new Video();
        $video->setTitle('How to Master Aerial Tricks');
        $video->setUrl('S6Twm_oofew');
        $video->setDescription('Step-by-step tutorial by our pro riders.');
        $video->setCreatedAt(new \DateTimeImmutable());
        $video->setUpdatedAt(new \DateTimeImmutable());
        $video->setUser($this->getReference('user_4'));
        $video->setCategory($this->getReference('categoryVideo_2'));
        $manager->persist($video);

        // Entrée en bdd de vidéos youtube sélectionnées
        $video = new Video();
        $video->setTitle('Junior Rider Training Day');
        $video->setUrl('--OREA5IU5s');
        $video->setDescription('A day in the life of our junior riders.');
        $video->setCreatedAt(new \DateTimeImmutable());
        $video->setUpdatedAt(new \DateTimeImmutable());
        $video->setUser($this->getReference('user_6'));
        $video->setCategory($this->getReference('categoryVideo_4'));
        $manager->persist($video);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            CategoryVideoFixtures::class,
        ];
    }
}
