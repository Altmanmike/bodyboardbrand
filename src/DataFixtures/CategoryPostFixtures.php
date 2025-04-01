<?php

namespace App\DataFixtures;

use App\Entity\CategoryPost;
use App\Repository\CategoryPostRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryPostFixtures extends Fixture
{


    public function load(ObjectManager $manager): void
    {
        // Entrée en bdd de catégories de vidéos youtube
        $categoryPost = new CategoryPost();
        $categoryPost->setName('Team');
        $categoryPost->setDescription('Best moments from the K&Z team in competitions.'); 
        $categoryPost->setCreatedAt(new \DateTimeImmutable());
        $categoryPost->setUpdatedAt(new \DateTimeImmutable());
        $this->addReference('categoryPost_0', $categoryPost);
        $manager->persist($categoryPost);

        $categoryPost = new CategoryPost();
        $categoryPost->setName('Friends and co');
        $categoryPost->setDescription('Best moments from others!!!'); 
        $categoryPost->setCreatedAt(new \DateTimeImmutable());
        $categoryPost->setUpdatedAt(new \DateTimeImmutable());
        $this->addReference('categoryPost_1', $categoryPost);
        $manager->persist($categoryPost);

        $categoryPost = new CategoryPost();
        $categoryPost->setName('Pro-amateurs');
        $categoryPost->setDescription('Best moments from pro-amateur riders.'); 
        $categoryPost->setCreatedAt(new \DateTimeImmutable());
        $categoryPost->setUpdatedAt(new \DateTimeImmutable());
        $this->addReference('categoryPost_2', $categoryPost);
        $manager->persist($categoryPost);

        $categoryPost = new CategoryPost();
        $categoryPost->setName('Juniors');
        $categoryPost->setDescription('Best tricks from young riders.'); 
        $categoryPost->setCreatedAt(new \DateTimeImmutable());
        $categoryPost->setUpdatedAt(new \DateTimeImmutable());
        $this->addReference('categoryPost_3', $categoryPost);
        $manager->persist($categoryPost);

        $categoryPost = new CategoryPost();
        $categoryPost->setName('Nature');
        $categoryPost->setDescription('Some from our beautiful earth'); 
        $categoryPost->setCreatedAt(new \DateTimeImmutable());
        $categoryPost->setUpdatedAt(new \DateTimeImmutable());
        $this->addReference('categoryPost_4', $categoryPost);
        $manager->persist($categoryPost);

        $categoryPost = new CategoryPost();
        $categoryPost->setName('Wave Pool');
        $categoryPost->setDescription('Discover the next technology and projects'); 
        $categoryPost->setCreatedAt(new \DateTimeImmutable());
        $categoryPost->setUpdatedAt(new \DateTimeImmutable());
        $this->addReference('categoryPost_5', $categoryPost);
        $manager->persist($categoryPost);

        $categoryPost = new CategoryPost();
        $categoryPost->setName('Travel/Trip');
        $categoryPost->setDescription('Organisation for best rides'); 
        $categoryPost->setCreatedAt(new \DateTimeImmutable());
        $categoryPost->setUpdatedAt(new \DateTimeImmutable());
        $this->addReference('categoryPost_6', $categoryPost);
        $manager->persist($categoryPost);

        $categoryPost = new CategoryPost();
        $categoryPost->setName('Gears');
        $categoryPost->setDescription('Newests tools & things...'); 
        $categoryPost->setCreatedAt(new \DateTimeImmutable());
        $categoryPost->setUpdatedAt(new \DateTimeImmutable());
        $this->addReference('categoryPost_7', $categoryPost);
        $manager->persist($categoryPost);

        $categoryPost = new CategoryPost();
        $categoryPost->setName('Futur');
        $categoryPost->setDescription('Next..'); 
        $categoryPost->setCreatedAt(new \DateTimeImmutable());
        $categoryPost->setUpdatedAt(new \DateTimeImmutable());
        $this->addReference('categoryPost_8', $categoryPost);
        $manager->persist($categoryPost);

        $categoryPost = new CategoryPost();
        $categoryPost->setName('Competition');
        $categoryPost->setDescription('All from the tour around the world'); 
        $categoryPost->setCreatedAt(new \DateTimeImmutable());
        $categoryPost->setUpdatedAt(new \DateTimeImmutable());
        $this->addReference('categoryPost_9', $categoryPost);
        $manager->persist($categoryPost);

        $categoryPost = new CategoryPost();
        $categoryPost->setName('Spots');
        $categoryPost->setDescription('We will find the best spots ever..'); 
        $categoryPost->setCreatedAt(new \DateTimeImmutable());
        $categoryPost->setUpdatedAt(new \DateTimeImmutable());
        $this->addReference('categoryPost_10', $categoryPost);
        $manager->persist($categoryPost);

        $categoryPost = new CategoryPost();
        $categoryPost->setName('Staff');
        $categoryPost->setDescription('News from our directions, technician and more..'); 
        $categoryPost->setCreatedAt(new \DateTimeImmutable());
        $categoryPost->setUpdatedAt(new \DateTimeImmutable());
        $this->addReference('categoryPost_11', $categoryPost);
        $manager->persist($categoryPost);

        $categoryPost = new CategoryPost();
        $categoryPost->setName('Boards');
        $categoryPost->setDescription('Check our new projects in making a good and innovating shape of board for our favorite sport!'); 
        $categoryPost->setCreatedAt(new \DateTimeImmutable());
        $categoryPost->setUpdatedAt(new \DateTimeImmutable());
        $this->addReference('categoryPost_12', $categoryPost);
        $manager->persist($categoryPost);

        $categoryPost = new CategoryPost();
        $categoryPost->setName('Others');
        $categoryPost->setDescription('Others'); 
        $categoryPost->setCreatedAt(new \DateTimeImmutable());
        $categoryPost->setUpdatedAt(new \DateTimeImmutable());
        $this->addReference('categoryPost_13', $categoryPost);
        $manager->persist($categoryPost);

        $manager->flush();
 
    }
}
