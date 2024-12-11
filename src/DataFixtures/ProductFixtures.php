<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductFixtures extends Fixture
{
    public function __construct(private ProductRepository $repo) {}    

    public function load(ObjectManager $manager): void
    {
        // BOARDS
        // Entrée en bdd de produits
        $product = new Product();
        $product->setTitle('Board Alpha');
        $product->setCover('../../imgs/products/kz-board-01.png');
        $product->setImages(['../../imgs/products/kz-board-01.png','../../imgs/products/kz-board-01.png']);
        $product->setColors(['black','cyan']);
        $product->setSizes(['41','42','43']);
        $product->setStock(5);
        $product->setPrice(275.00);
        $product->setDescription('Our board product'); 
        $product->setCreatedAt(new \DateTimeImmutable());
        $product->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($product);

        // Entrée en bdd de produits
        $product = new Product();
        $product->setTitle('Board Omega');
        $product->setCover('../../imgs/products/kz-board-02.png');
        $product->setImages(['../../imgs/products/kz-board-02.png','../../imgs/products/kz-board-02.png']);
        $product->setColors(['black','white']);
        $product->setSizes(['40','41','42','43']);
        $product->setStock(2);
        $product->setPrice(250.00);
        $product->setDescription('Our board product'); 
        $product->setCreatedAt(new \DateTimeImmutable());
        $product->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($product);

        // Entrée en bdd de produits
        $product = new Product();
        $product->setTitle('Board Beta');
        $product->setCover('../../imgs/products/kz-board-03.png');
        $product->setImages(['../../imgs/products/kz-board-03.png','../../imgs/products/kz-board-03.png']);
        $product->setColors(['red','white']);
        $product->setSizes(['40','41','42','43','44']);
        $product->setStock(8);
        $product->setPrice(285.00);
        $product->setDescription('Our board product'); 
        $product->setCreatedAt(new \DateTimeImmutable());
        $product->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($product);

        // Entrée en bdd de produits
        $product = new Product();
        $product->setTitle('Board Zeta');
        $product->setCover('../../imgs/products/kz-board-04.png');
        $product->setImages(['../../imgs/products/kz-board-04.png','../../imgs/products/kz-board-04.png']);
        $product->setColors(['white','magenta']);
        $product->setSizes(['40','41','42']);
        $product->setStock(4);
        $product->setPrice(295.00);
        $product->setDescription('Our board product'); 
        $product->setCreatedAt(new \DateTimeImmutable());
        $product->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($product);

        // BOARDS
        // Entrée en bdd de produits
        $product = new Product();
        $product->setTitle('Board Alpha');
        $product->setCover('../../imgs/products/kz-board-01.png');
        $product->setImages(['../../imgs/products/kz-board-01.png','../../imgs/products/kz-board-01.png']);
        $product->setColors(['black','cyan']);
        $product->setSizes(['41','42','43']);
        $product->setStock(5);
        $product->setPrice(250.00);
        $product->setDescription('Our board product'); 
        $product->setCreatedAt(new \DateTimeImmutable());
        $product->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($product);

        // GEARS
        // Entrée en bdd de produits : palmes
        $product = new Product();
        $product->setTitle('Fins Alpha');
        $product->setCover('../../imgs/products/kz-fins-01.png');
        $product->setImages(['../../imgs/products/kz-fins-01.png','../../imgs/products/kz-fins-01.png']);
        $product->setColors(['black']);
        $product->setSizes(['XS', 'S', 'M', 'L', 'XL', 'XXL']);
        $product->setStock(20);
        $product->setPrice(45.00);
        $product->setDescription('Our fins product for bodyboard'); 
        $product->setCreatedAt(new \DateTimeImmutable());
        $product->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($product);

        // Entrée en bdd de produits : leash for fins
        $product = new Product();
        $product->setTitle('Fins Alpha');
        $product->setCover('../../imgs/products/kz-fins-01.png');
        $product->setImages(['../../imgs/products/kz-fins-01.png','../../imgs/products/kz-fins-01.png']);
        $product->setColors(['black']);
        $product->setSizes(['XS', 'S', 'M', 'L', 'XL', 'XXL']);
        $product->setStock(20);
        $product->setPrice(45.00);
        $product->setDescription('Our fins product for bodyboard'); 
        $product->setCreatedAt(new \DateTimeImmutable());
        $product->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($product);

        // Entrée en bdd de produits : leash for fins
        $product = new Product();
        $product->setTitle('Leash Alpha');
        $product->setCover('../../imgs/products/kz-board-leash.png');
        $product->setImages(['../../imgs/products/kz-board-leash.png','../../imgs/products/kz-board-leash.png']);
        $product->setColors(['black']);
        $product->setSizes(['L']);
        $product->setStock(20);
        $product->setPrice(19.00);
        $product->setDescription('Our leash for fins product for bodyboard'); 
        $product->setCreatedAt(new \DateTimeImmutable());
        $product->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($product);

        // Entrée en bdd de produits : leash for board
        $product = new Product();
        $product->setTitle('Leash Omega');
        $product->setCover('../../imgs/products/kz-board-leash.png.png');
        $product->setImages(['../../imgs/products/kz-board-leash.png','../../imgs/products/kz-board-leash.png']);
        $product->setColors(['black']);
        $product->setSizes(['L']);
        $product->setStock(18);
        $product->setPrice(39.00);
        $product->setDescription('Our leash for board product for bodyboard'); 
        $product->setCreatedAt(new \DateTimeImmutable());
        $product->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($product);

        // CLOTHING
        // Entrée en bdd de produits : sweat
        $product = new Product();
        $product->setTitle('Sweat Alpha');
        $product->setCover('../../imgs/products/kz-sweat-black.png');
        $product->setImages(['../../imgs/products/kz-sweat-black.png','../../imgs/products/kz-sweat-black.png']);
        $product->setColors(['black']);
        $product->setSizes(['S', 'M', 'L', 'XL']);
        $product->setStock(10);
        $product->setPrice(29.00);
        $product->setDescription('Our sweat product'); 
        $product->setCreatedAt(new \DateTimeImmutable());
        $product->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($product);

        // Entrée en bdd de produits : sweat
        $product = new Product();
        $product->setTitle('Sweat Omega');
        $product->setCover('../../imgs/products/kz-sweat-white.png');
        $product->setImages(['../../imgs/products/kz-sweat-white.png','../../imgs/products/kz-sweat-white.png']);
        $product->setColors(['white']);
        $product->setSizes(['S', 'M', 'L', 'XL']);
        $product->setStock(11);
        $product->setPrice(29.00);
        $product->setDescription('Our sweat product'); 
        $product->setCreatedAt(new \DateTimeImmutable());
        $product->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($product);

        // Entrée en bdd de produits : cap
        $product = new Product();
        $product->setTitle('Cap Alpha');
        $product->setCover('../../imgs/products/kz-cap-black.png');
        $product->setImages(['../../imgs/products/kz-cap-black.png','../../imgs/products/kz-cap-black.png']);
        $product->setColors(['black']);
        $product->setSizes(['S', 'M', 'L', 'XL']);
        $product->setStock(11);
        $product->setPrice(16.00);
        $product->setDescription('Our black cap product'); 
        $product->setCreatedAt(new \DateTimeImmutable());
        $product->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($product);

        // Entrée en bdd de produits : cap
        $product = new Product();
        $product->setTitle('Cap Omega');
        $product->setCover('../../imgs/products/kz-cap-red.png');
        $product->setImages(['../../imgs/products/kz-cap-red.png','../../imgs/products/kz-cap-red.png']);
        $product->setColors(['red']);
        $product->setSizes(['S', 'M', 'L', 'XL']);
        $product->setStock(10);
        $product->setPrice(16.00);
        $product->setDescription('Our red cap product'); 
        $product->setCreatedAt(new \DateTimeImmutable());
        $product->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($product);

        // ACCESORIES
        // Entrée en bdd de produits : acces
        $product = new Product();
        $product->setTitle('Mug Alpha');
        $product->setCover('../../imgs/products/kz-mug-black.png');
        $product->setImages(['../../imgs/products/kz-mug-black.png','../../imgs/products/kz-mug-black.png']);
        $product->setColors(['black']);
        $product->setSizes(['L']);
        $product->setStock(8);
        $product->setPrice(08.00);
        $product->setDescription('Our mug product'); 
        $product->setCreatedAt(new \DateTimeImmutable());
        $product->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($product);

        // Entrée en bdd de produits : acces
        $product = new Product();
        $product->setTitle('Key Alpha');
        $product->setCover('../../imgs/products/kz-key-ring.png');
        $product->setImages(['../../imgs/products/kz-key-ring.png','../../imgs/products/kz-key-ring.png']);
        $product->setColors(['black']);
        $product->setSizes(['L']);
        $product->setStock(7);
        $product->setPrice(11.00);
        $product->setDescription('Our key ring product'); 
        $product->setCreatedAt(new \DateTimeImmutable());
        $product->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($product);

        // Entrée en bdd de produits : acces
        $product = new Product();
        $product->setTitle('Sticker Alpha');
        $product->setCover('../../imgs/products/kz-sticker.png');
        $product->setImages(['../../imgs/products/kz-sticker.png','../../imgs/products/kz-sticker.png']);
        $product->setColors(['black']);
        $product->setSizes(['L']);
        $product->setStock(30);
        $product->setPrice(2.50);
        $product->setDescription('Our sticker product'); 
        $product->setCreatedAt(new \DateTimeImmutable());
        $product->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($product);
        
        $manager->flush();
    }
}