<?php

namespace App\DataFixtures;

use App\Entity\Innovation;
use App\Repository\InnovationRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class InnovationFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private InnovationRepository $repo)
    {
    }

    public function load(ObjectManager $manager): void
    {
        // Entrée en bdd d'article d'innovation
        $innovation = new Innovation();
        $innovation->setTitle('Reinforced Board Stringers');
        $innovation->setImage('../../imgs/innovation/stringers.jpg');
        $innovation->setContent('New stringer technology for improved board flexibility and strength.');
        $innovation->setCreatedAt(new \DateTimeImmutable());
        $innovation->setUpdatedAt(new \DateTimeImmutable());
        $innovation->setUser($this->getReference('user_0'));
        $manager->persist($innovation);

        // Entrée en bdd d'article d'innovation
        $innovation = new Innovation();
        $innovation->setTitle('Hydrodynamic Fins');
        $innovation->setImage('../../imgs/innovation/fins.jpg');
        $innovation->setContent('New stringer technology for improved board flexibility and strength.');
        $innovation->setCreatedAt(new \DateTimeImmutable());
        $innovation->setUpdatedAt(new \DateTimeImmutable());
        $innovation->setUser($this->getReference('user_6'));
        $manager->persist($innovation);

        // Entrée en bdd d'article d'innovation
        $innovation = new Innovation();
        $innovation->setTitle('Eco-Friendly Leash');
        $innovation->setImage('../../imgs/innovation/leash.jpg');
        $innovation->setContent('Sustainable materials to minimize ocean pollution.');
        $innovation->setCreatedAt(new \DateTimeImmutable());
        $innovation->setUpdatedAt(new \DateTimeImmutable());
        $innovation->setUser($this->getReference('user_8'));
        $manager->persist($innovation);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
