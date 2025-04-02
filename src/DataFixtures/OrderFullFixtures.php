<?php

namespace App\DataFixtures;

use App\Entity\OrderFull;
use App\Repository\OrderFullRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrderFullFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private OrderFullRepository $repo)
    {
    }

    #[\Override]
    public function load(ObjectManager $manager): void
    {
        // Entrée en bdd de commandes
        $orderFull = new OrderFull();
        $orderFull->setTotalPrice(180.00);
        $orderFull->setStatus(status: 'en cours');  // (en cours, expédiée, livrée, annulée)
        $orderFull->setCreatedAt(new \DateTimeImmutable());
        $orderFull->setUpdatedAt(new \DateTimeImmutable());
        $orderFull->setCompletedAt(null);
        $orderFull->setUser($this->getReference('user_2'));
        $this->addReference('orderFull_0', $orderFull);
        $manager->persist($orderFull);

        // Entrée en bdd de commandes
        $orderFull = new OrderFull();
        $orderFull->setTotalPrice(275.00);
        $orderFull->setStatus(status: 'expédiée');
        $orderFull->setCreatedAt(new \DateTimeImmutable());
        $orderFull->setUpdatedAt(new \DateTimeImmutable());
        $orderFull->setCompletedAt(new \DateTimeImmutable());
        $orderFull->setUser($this->getReference('user_5'));
        $this->addReference('orderFull_1', $orderFull);
        $manager->persist($orderFull);

        $manager->flush();
    }

    #[\Override]
    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
