<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use OpenApi\Attributes as OA;

#[ORM\Entity(repositoryClass: MemberRepository::class)]
#[ORM\Table(name: '`member`')]
class Member
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['members.index'])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $firstname = null;

    #[ORM\Column(length: 100)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[OA\Property(type: 'string', maxLength: 255)]
    #[Groups(['members.index','members.show','members.create','members.update'])]
    private ?string $nickname = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[OA\Property(type: 'string', maxLength: 255)]
    #[Groups(['members.index','members.show','members.create','members.update'])]
    private ?string $photo = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[OA\Property(type: 'string')]
    #[Groups(['members.show','members.create','members.update'])]
    private ?string $biography = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[OA\Property(type: 'string', maxLength: 100)]
    #[Groups(['members.show','members.create','members.update'])]
    private ?string $role = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[OA\Property(type: 'string', maxLength: 255)]
    #[Groups(['members.show','members.create','members.update'])]
    private ?string $sponsors = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[OA\Property(type: 'string', maxLength: 255)]
    #[Groups(['members.show','members.create','members.update'])]
    private ?string $instagram = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[OA\Property(type: 'string', maxLength: 255)]
    #[Groups(['members.show','members.create','members.update'])]
    private ?string $facebook = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[OA\Property(type: 'string', maxLength: 255)]
    #[Groups(['members.show','members.create','members.update'])]
    private ?string $youtube = null;

    #[ORM\Column(nullable: true)]
    #[OA\Property(type: 'integer')]
    #[Groups(['members.show','members.create','members.update'])]
    private ?int $ranking = null;

    #[ORM\OneToOne(inversedBy: 'member', cascade: ['persist', 'remove'], fetch: 'EAGER')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    /**
     * @var Collection<int, Team>
     */
    #[ORM\ManyToMany(targetEntity: Team::class, inversedBy: 'members', fetch: 'EAGER')]
    private Collection $teams;

    #[ORM\Column(options: ['default' => 'CURRENT_TIMESTAMP'])]
    #[Groups(['members.date'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable:true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {     
        $this->createdAt = new \DateTimeImmutable();
        $this->teams = new ArrayCollection();
    }





    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }



    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }



    public function setNickname(?string $nickname): static
    {
        $this->nickname = $nickname;

        return $this;
    }



    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }



    public function setBiography(?string $biography): static
    {
        $this->biography = $biography;

        return $this;
    }



    public function setRole(?string $role): static
    {
        $this->role = $role;

        return $this;
    }



    public function setSponsors(?string $sponsors): static
    {
        $this->sponsors = $sponsors;

        return $this;
    }



    public function setInstagram(?string $instagram): static
    {
        $this->instagram = $instagram;

        return $this;
    }



    public function setFacebook(?string $facebook): static
    {
        $this->facebook = $facebook;

        return $this;
    }



    public function setYoutube(?string $youtube): static
    {
        $this->youtube = $youtube;

        return $this;
    }



    public function setRanking(?int $ranking): static
    {
        $this->ranking = $ranking;

        return $this;
    } 

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }



    public function addTeam(Team $team): static
    {
        if (!$this->teams->contains($team)) {
            $this->teams->add($team);
        }

        return $this;
    }

    public function removeTeam(Team $team): static
    {
        $this->teams->removeElement($team);

        return $this;
    }



    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }




}
