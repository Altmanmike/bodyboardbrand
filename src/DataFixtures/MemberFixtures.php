<?php

namespace App\DataFixtures;

use App\Entity\Member;
use App\Repository\MemberRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class MemberFixtures extends Fixture
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
        $member->setPhoto('');
        $member->setBiography('');
        $member->setSponsors('Vans');
        $member->setInstagram('');
        $member->setFacebook('');
        $member->setYoutube('');
        $member->setRanking(0);
        $member->setJoinDate(new \DateTimeImmutable());

        /*$this->addReference('user_4', $user);*/
        $manager->persist($member);
        $manager->flush();     
    }
}
