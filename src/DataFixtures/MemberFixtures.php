<?php

namespace App\DataFixtures;

use App\Entity\Member;
use App\Repository\MemberRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MemberFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private MemberRepository $repo) {}    

    public function load(ObjectManager $manager): void
    {
        // Génération de l'admin du site de l'application GeoPV
        $member = new Member();

        $member->setFirstname('BoB');
        $member->setLastname('ALTMAN');
        $member->setNickname('MikyMike');
        $member->setRole('Dev Web');
        $member->setPhoto('/build/images/dev.0e60f8e1.jpg');
        $member->setBiography('Meet Mike, a 30-year-old with a passion for the ocean and a newfound love for coding. When hes not catching waves at his local beach, hes diving into the world of web development. As a beginner bodyboarder, Mike is still learning the ropes, but his determination and enthusiasm are undeniable.');
        $member->setSponsors('KZ, Volcom');
        $member->setInstagram('https://www.instagram.com/mikymike/');
        $member->setFacebook('https://www.facebook.com/mikymike/');
        $member->setYoutube('https://www.youtube.com/mikymike/');
        $member->setRanking(0);
        $member->setCreatedAt(new \DateTimeImmutable());
        $member->setUser($this->getReference('user_0'));
        
        $manager->persist($member);

        
        $member = new Member();

        $member->setFirstname('Dominique');
        $member->setLastname('BERNARD');
        $member->setNickname('Domy');
        $member->setRole('Leader');
        $member->setPhoto('/build/images/leader.9f810f05.jpg');
        $member->setBiography('Domy, a legend in the bodyboarding world, hails from the shores of Lacanau. As an international leader and KZ team rider, his powerful style and innovative maneuvers have inspired generations. When hes not dominating competitions, hes mentoring young riders and pushing the limits of the sport.');
        $member->setSponsors('KZ, Volcom, Vans');
        $member->setInstagram('https://www.instagram.com/domard/');
        $member->setFacebook('https://www.facebook.com/domard/');
        $member->setYoutube('https://www.youtube.com/domard/');
        $member->setRanking(17);
        $member->setCreatedAt(new \DateTimeImmutable());
        $member->setUser($this->getReference('user_1'));
        
        $manager->persist($member);


        $member = new Member();

        $member->setFirstname('Joseph');
        $member->setLastname('JACQUET');
        $member->setNickname('Jo');
        $member->setRole('Pro');
        $member->setPhoto('/build/images/pro1.84373019.jpg');
        $member->setBiography('Jo brings a unique flavor to the KZ team, representing the vibrant bodyboarding scene of Guiana. With his explosive style and fearless approach, hes a rising star on the pro circuit. When hes not chasing barrels, hes exploring the untouched waves of his home coast.');
        $member->setSponsors('KZ');
        $member->setInstagram('https://www.instagram.com/jo750/');
        $member->setFacebook('https://www.facebook.com/jo750/');
        $member->setYoutube('https://www.youtube.com/jo750/');
        $member->setRanking(30);
        $member->setCreatedAt(new \DateTimeImmutable());
        $member->setUser($this->getReference('user_2'));
        
        $manager->persist($member);
        

        $member = new Member();

        $member->setFirstname('Antoinette');
        $member->setLastname('DIDIER');
        $member->setNickname('Didou');
        $member->setRole('Pro');
        $member->setPhoto('/build/images/pro2.b86b29c3.jpg');
        $member->setBiography('Didou, a local hero from Reunion Island, is known for his powerful performances in heavy waves. As a KZ pro, he combines raw talent with a deep connection to the ocean. When hes not charging reefs, hes sharing his passion for bodyboarding with the next generation.');
        $member->setSponsors('KZ');
        $member->setInstagram('https://www.instagram.com/didouuu/');
        $member->setFacebook('https://www.facebook.com/didouuu/');
        $member->setYoutube('https://www.youtube.com/didouuu/');
        $member->setRanking(30);
        $member->setCreatedAt(new \DateTimeImmutable());
        $member->setUser($this->getReference('user_3'));
        
        $manager->persist($member);

        
        $member = new Member();

        $member->setFirstname('Renée');
        $member->setLastname('MARQUES');
        $member->setNickname('Mark');
        $member->setRole('Junior');
        $member->setPhoto('/build/images/junior2.405bd38f.jpg');
        $member->setBiography('Mark is the future of Lacanau bodyboarding. As a junior team rider, his raw talent and dedication are evident in every session. With his sights set on the pro circuit, hes constantly pushing his limits and learning from the best.');
        $member->setSponsors('KZ');
        $member->setInstagram('https://www.instagram.com/rm02/');
        $member->setFacebook('https://www.facebook.com/rm02/');
        $member->setYoutube('https://www.youtube.com/rm02/');
        $member->setRanking(30);
        $member->setCreatedAt(new \DateTimeImmutable());
        $member->setUser($this->getReference('user_4'));
        
        $manager->persist($member);

        
        $member = new Member();

        $member->setFirstname('Daniel');
        $member->setLastname('FONTAINE');
        $member->setNickname('Dann');
        $member->setRole('Photograph');
        $member->setPhoto('/public/build/images/photo2.ee0a96ff.jpg');
        $member->setBiography('Dann captures the soul of bodyboarding through his lens. Based in Brittany, he braves the elements to document the sports most epic moments. When hes not behind the camera, hes exploring the rugged coastline and searching for the perfect shot.');
        $member->setSponsors('Volcom');
        $member->setInstagram('https://www.instagram.com/dann48/');
        $member->setFacebook('https://www.facebook.com/dann48/');
        $member->setYoutube('https://www.youtube.com/dann48/');
        $member->setRanking(30);
        $member->setCreatedAt(new \DateTimeImmutable());
        $member->setUser($this->getReference('user_5'));
        
        $manager->persist($member);
        
        
        $manager->flush();     
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ]; 
    }
}