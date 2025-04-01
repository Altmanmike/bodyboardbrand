<?php

namespace App\Tests;

use App\Entity\CategoryTeam;
use App\Entity\Member;
use App\Entity\Team;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class TeamTest extends TestCase
{
    public function testTeamSettersAndGetters()
    {
        $team = new Team();
        $category = (new CategoryTeam())->setName('Bénévoles');

        $member1 = (new Member())->setNickname('Sarah Rider');
        $member2 = (new Member())->setNickname('Micka Pro');

        $team->setName('KZ Cleaners')
             ->setDescription('Jeunes motivée pour la santé de nos plages')
             ->setCategory($category)
             ->setCreatedAt(new \DateTimeImmutable())
             ->setUpdatedAt(new \DateTimeImmutable());

        $this->assertEquals('KZ Cleaners', $team->getName());
        $this->assertEquals('Jeunes motivée pour la santé de nos plages', $team->getDescription());
        $this->assertInstanceOf(CategoryTeam::class, $team->getCategory());
        $this->assertInstanceOf(\DateTimeImmutable::class, $team->getCreatedAt());
        $this->assertInstanceOf(\DateTimeImmutable::class, $team->getUpdatedAt());

        // Init collection
        $this->assertInstanceOf(ArrayCollection::class, $team->getMembers());
        $this->assertCount(0, $team->getMembers());

        // Ajout membres
        $team->addMember($member1);
        $team->addMember($member2);

        $this->assertCount(2, $team->getMembers());
        $this->assertTrue($team->getMembers()->contains($member1));
        $this->assertTrue($team->getMembers()->contains($member2));

        // Suppression membre
        $team->removeMember($member1);
        $this->assertCount(1, $team->getMembers());
        $this->assertFalse($team->getMembers()->contains($member1));
    }
}
