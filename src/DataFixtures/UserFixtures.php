<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordEncoder, private UserRepository $repo) {}    

    public function load(ObjectManager $manager): void
    {
        // Génération de l'admin du site de l'application GeoPV
        $admin = new User();
        $admin->setEmail('altman_mike@yahoo.fr');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setFirstname('BoB');
        $admin->setLastname('ALTMAN');
        $admin->setPhone('+33781570127');
        $admin->setZipcode('69003');
        $admin->setCity('LYON');
        $admin->setLocation('Sans soucis proche metro');
        $admin->setCountry('France');
        $admin->setDepartment('Rhône');
        $admin->setRegion('Auvergne-Rhône-Alpes');
        $admin->setVerified(1);
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'admin') // l'admin devra changer le mdp      
        );      
        $admin->setCreatedAt(new \DateTimeImmutable());
        $admin->setLastLoginAt(new \DateTimeImmutable());
       
        $this->addReference('user_0', $admin);
        
        $manager->persist($admin);

        // Génération d'une DataFixtures de fausses données d'utilisateurs via FakerPHP
        $faker = Factory::create('fr_FR');

        for($i=1; $i <= 10; $i++)
        {
            $user = new User();
            $user->setEmail($faker->email());
            $user->setRoles(['ROLE_USER']);
            $user->setFirstname($faker->firstname());
            $user->setLastname($faker->lastname()); 
            $user->setPhone($faker->e164PhoneNumber()); 
            $user->setZipcode(str_replace(' ', '', $faker->postcode()));            
            $user->setCity($faker->city());
            $user->setLocation($faker->secondaryAddress());
            $user->setCountry(country: 'France');
            $user->setDepartment($faker->departmentName());
            $user->setRegion($faker->region());
            $user->setVerified(0);
            $user->setPassword(
                $this->passwordEncoder->hashPassword($user, $faker->password())    
            );
            $user->setCreatedAt(new \DateTimeImmutable());
            $user->setLastLoginAt(new \DateTimeImmutable());   
            $this->addReference('user_'.$i, $user);    
            
            $manager->persist($user);        
        }

        $manager->flush();     
    }
}
