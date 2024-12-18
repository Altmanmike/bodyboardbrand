<?php

namespace App\DataFixtures;

use App\Entity\OrderLine;
use App\Repository\OrderLineRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class OrderLineFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private OrderLineRepository $repo) {}    

    public function load(ObjectManager $manager): void
    {
        // Entrée en bdd de ligne de commande
        $orderLine = new OrderLine();
        $orderLine->setQuantity(2);
        $orderLine->setPrice(90.00);        
        $orderLine->setCreatedAt(new \DateTimeImmutable());
        $orderLine->setUpdatedAt(new \DateTimeImmutable());
        $orderLine->setProduct($this->getReference('product_4'));
        $orderLine->setOrderFull($this->getReference('orderFull_0'));
        $manager->persist($orderLine);

        // Entrée en bdd de ligne de commande
        $orderLine = new OrderLine();
        $orderLine->setQuantity(1);
        $orderLine->setPrice(275.00);        
        $orderLine->setCreatedAt(new \DateTimeImmutable());
        $orderLine->setUpdatedAt(new \DateTimeImmutable());
        $orderLine->setProduct($this->getReference('product_0'));
        $orderLine->setOrderFull($this->getReference('orderFull_1'));
        $manager->persist($orderLine);
        
        $manager->flush();
 
    }

    public function getDependencies(): array
    {
        return [
            ProductFixtures::class
        ]; 
    }
}
