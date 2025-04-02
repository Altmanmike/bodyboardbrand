<?php

namespace App\DataFixtures;

use App\Entity\Member;
use App\Repository\MemberRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MemberFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private MemberRepository $repo)
    {
    }

    #[\Override]
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
        $member->setCreatedAt(new \DateTimeImmutable());

        $member->setUser($this->getReference('user_0'));

        $manager->persist($member);
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
