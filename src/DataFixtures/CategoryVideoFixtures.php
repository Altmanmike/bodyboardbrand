<?php

namespace App\DataFixtures;

use App\Entity\CategoryVideo;
use App\Repository\CategoryVideoRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryVideoFixtures extends Fixture
{
    public function __construct(private CategoryVideoRepository $repo) {}    

    public function load(ObjectManager $manager): void
    {
        // Entrée en bdd de catégories de vidéos youtube
        $categoryVideo = new CategoryVideo();
        $categoryVideo->setName('Team Highlights');
        $categoryVideo->setDescription('Best moments from the K&Z team in competitions.'); 
        $categoryVideo->setCreatedAt(new \DateTimeImmutable());
        $categoryVideo->setUpdatedAt(new \DateTimeImmutable());
        $this->addReference('categoryVideo_0', $categoryVideo);
        $manager->persist($categoryVideo);

        $categoryVideo = new CategoryVideo();
        $categoryVideo->setName('Friends and co');
        $categoryVideo->setDescription('Best moments from others!!!'); 
        $categoryVideo->setCreatedAt(new \DateTimeImmutable());
        $categoryVideo->setUpdatedAt(new \DateTimeImmutable());
        $this->addReference('categoryVideo_1', $categoryVideo);
        $manager->persist($categoryVideo);

        $categoryVideo = new CategoryVideo();
        $categoryVideo->setName('Pro team playlist');
        $categoryVideo->setDescription('Best moments from pro-amateur riders.'); 
        $categoryVideo->setCreatedAt(new \DateTimeImmutable());
        $categoryVideo->setUpdatedAt(new \DateTimeImmutable());
        $this->addReference('categoryVideo_2', $categoryVideo);
        $manager->persist($categoryVideo);

        $categoryVideo = new CategoryVideo();
        $categoryVideo->setName('Pro-amateurs playlist');
        $categoryVideo->setDescription('Best moments from pro-amateur riders.'); 
        $categoryVideo->setCreatedAt(new \DateTimeImmutable());
        $categoryVideo->setUpdatedAt(new \DateTimeImmutable());
        $this->addReference('categoryVideo_3', $categoryVideo);
        $manager->persist($categoryVideo);

        $categoryVideo = new CategoryVideo();
        $categoryVideo->setName('Juniors playlist');
        $categoryVideo->setDescription('Best tricks from young riders.'); 
        $categoryVideo->setCreatedAt(new \DateTimeImmutable());
        $categoryVideo->setUpdatedAt(new \DateTimeImmutable());
        $this->addReference('categoryVideo_4', $categoryVideo);
        $manager->persist($categoryVideo);

        $categoryVideo = new CategoryVideo();
        $categoryVideo->setName('Others');
        $categoryVideo->setDescription('Others'); 
        $categoryVideo->setCreatedAt(new \DateTimeImmutable());
        $categoryVideo->setUpdatedAt(new \DateTimeImmutable());
        $this->addReference('categoryVideo_5', $categoryVideo);
        $manager->persist($categoryVideo);

        $manager->flush();
 
    }
}
