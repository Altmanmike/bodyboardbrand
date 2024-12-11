<?php

namespace App\DataFixtures;

use App\Entity\Innovation;
use App\Repository\InnovationRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class InnovationFixtures extends Fixture
{
    public function __construct(private InnovationRepository $repo) {}    

    public function load(ObjectManager $manager): void
    {
        // Entrée en bdd d'article d'innovation
        $innovation = new Innovation();
        $innovation->setTitle('Reinforced Board Stringers');
        $innovation->setImage('../../imgs/innovation/stringers.jpg');
        $innovation->setContent('New stringer technology for improved board flexibility and strength.');
        $innovation->setAuthor('Admin admin');
        $innovation->setCreatedAt(new \DateTimeImmutable());
        $innovation->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($innovation);
 
        // Entrée en bdd d'article d'innovation
        $innovation = new Innovation();
        $innovation->setTitle('Hydrodynamic Fins');
        $innovation->setImage('../../imgs/innovation/fins.jpg');
        $innovation->setContent('New stringer technology for improved board flexibility and strength.');
        $innovation->setAuthor('Admin admin');
        $innovation->setCreatedAt(new \DateTimeImmutable());
        $innovation->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($innovation);

        // Entrée en bdd d'article d'innovation
        $innovation = new Innovation();
        $innovation->setTitle('Eco-Friendly Leash');
        $innovation->setImage('../../imgs/innovation/leash.jpg');
        $innovation->setContent('Sustainable materials to minimize ocean pollution.');
        $innovation->setAuthor('Admin admin');
        $innovation->setCreatedAt(new \DateTimeImmutable());
        $innovation->setUpdatedAt(new \DateTimeImmutable());
        /*$this->addReference('user_4', $user);*/
        $manager->persist($innovation);

        $manager->flush();
    }
}