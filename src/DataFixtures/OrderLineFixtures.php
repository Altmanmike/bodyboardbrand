<?php

namespace App\DataFixtures;

use App\Entity\OrderLine;
use App\Repository\OrderLineRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class OrderLineFixtures extends Fixture
{
    public function __construct(private OrderLineRepository $repo) {}    

    public function load(ObjectManager $manager): void
    {
        // Entrée en bdd de ligne de commande
        $orderLine = new OrderLine();
        $orderLine->setQuantity(3);
        $orderLine->setPrice(60.00);        
        $orderLine->setCreatedAt(new \DateTimeImmutable());
        $orderLine->setUpdatedAt(new \DateTimeImmutable());
        /* manque le product */
        /*$this->addReference('user_4', $user);*/
        $manager->persist($orderLine);

        // Entrée en bdd de ligne de commande
        $orderLine = new OrderLine();
        $orderLine->setQuantity(1);
        $orderLine->setPrice(275.00);        
        $orderLine->setCreatedAt(new \DateTimeImmutable());
        $orderLine->setUpdatedAt(new \DateTimeImmutable());
        /* manque le product */
        /*$this->addReference('user_4', $user);*/
        $manager->persist($orderLine);
        
        $manager->flush();
 
    }
}
