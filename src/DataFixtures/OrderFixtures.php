<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class OrderFixtures extends Fixture
{
    public function __construct(private OrderRepository $repo) {}    

    public function load(ObjectManager $manager): void
    {
        // Entrée en bdd de commandes
        $order = new Order();        
        $order->setTotalPrice(180.00); 
        $order->setStatus(status: 'en cours');  // (en cours, expédiée, livrée, annulée)     
        $order->setCreatedAt(new \DateTimeImmutable());
        $order->setUpdatedAt(new \DateTimeImmutable());
        $order->setCompletedAt(null);
        /* manque le user */
        /*$this->addReference('user_4', $user);*/
        $manager->persist($order);

        // Entrée en bdd de commandes
        $order = new Order();        
        $order->setTotalPrice(275.00); 
        $order->setStatus(status: 'expédiée');       
        $order->setCreatedAt(new \DateTimeImmutable());
        $order->setUpdatedAt(new \DateTimeImmutable());
        $order->setCompletedAt(new \DateTimeImmutable());
        /* manque le user */
        /*$this->addReference('user_4', $user);*/
        $manager->persist($order);
        
        $manager->flush();
 
    }
}
