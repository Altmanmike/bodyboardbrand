<?php

namespace App\DataFixtures;

use App\Entity\Innovation;
use Doctrine\Persistence\ObjectManager;
use App\Repository\InnovationRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class InnovationFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private InnovationRepository $repo) {}    

    public function load(ObjectManager $manager): void
    {
        // Entrée en bdd d'article d'innovation
        $innovation = new Innovation();
        $innovation->setTitle('Reinforced Board Stringers');
        $innovation->setImage('/build/images/stringers.6434a365.jpg');
        $innovation->setContent('New stringer technology for improved board flexibility and strength.');
        $innovation->setCreatedAt(new \DateTimeImmutable());
        $innovation->setUpdatedAt(new \DateTimeImmutable());                
        $innovation->setUser($this->getReference('user_0'));
        $manager->persist($innovation);
 
        // Entrée en bdd d'article d'innovation
        $innovation = new Innovation();
        $innovation->setTitle('Hydrodynamic Fins');
        $innovation->setImage('/build/images/fins.ec7b529c.jpg');
        $innovation->setContent('New stringer technology for improved board flexibility and strength.');
        $innovation->setCreatedAt(new \DateTimeImmutable());
        $innovation->setUpdatedAt(new \DateTimeImmutable());
        $innovation->setUser($this->getReference('user_6'));
        $manager->persist($innovation);

        // Entrée en bdd d'article d'innovation
        $innovation = new Innovation();
        $innovation->setTitle('Eco-Friendly Leash');
        $innovation->setImage('/build/images/leash.a46e4147.jpg');
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
            UserFixtures::class
        ]; 
    }
}