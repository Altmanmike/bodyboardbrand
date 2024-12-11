<?php

namespace App\DataFixtures;

use App\Entity\CategoryProduct;
use App\Repository\CategoryProductRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryProductFixtures extends Fixture
{
    public function __construct(private CategoryProductRepository $repo) {}    

    public function load(ObjectManager $manager): void
    {
        // Entrée en bdd de catégories de vidéos youtube
        $categoryProduct = new CategoryProduct();
        $categoryProduct->setName('Boards');
        $categoryProduct->setDescription('Our boards products'); 
        $categoryProduct->setCreatedAt(new \DateTimeImmutable());
        $categoryProduct->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($categoryProduct);

        $categoryProduct = new CategoryProduct();
        $categoryProduct->setName('Gears');
        $categoryProduct->setDescription('Our best products to complete your stuff'); 
        $categoryProduct->setCreatedAt(new \DateTimeImmutable());
        $categoryProduct->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($categoryProduct);

        $categoryProduct = new CategoryProduct();
        $categoryProduct->setName('Clothing');
        $categoryProduct->setDescription('Best wear for bodyboarder and others!'); 
        $categoryProduct->setCreatedAt(new \DateTimeImmutable());
        $categoryProduct->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($categoryProduct);

        $categoryProduct = new CategoryProduct();
        $categoryProduct->setName('Accesories');
        $categoryProduct->setDescription('Little things to enjoy your life'); 
        $categoryProduct->setCreatedAt(new \DateTimeImmutable());
        $categoryProduct->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($categoryProduct);

        $categoryProduct = new CategoryProduct();
        $categoryProduct->setName('Others');
        $categoryProduct->setDescription('Others'); 
        $categoryProduct->setCreatedAt(new \DateTimeImmutable());
        $categoryProduct->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($categoryProduct);

        $manager->flush();
 
    }
}
