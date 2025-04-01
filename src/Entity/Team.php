<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
#[ORM\Table(name: '`team`')]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable:true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'teams', fetch: 'EAGER')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CategoryTeam $category = null;

    /**
     * @var Collection<int, Member>
     */
    #[ORM\ManyToMany(targetEntity: Member::class, mappedBy: 'teams', fetch: 'EAGER')]
    private Collection $members;

    public function __construct()
    {     
        $this->createdAt = new \DateTimeImmutable();
        $this->members = new ArrayCollection();
    }





    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }



    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }



    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }



    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCategory(): ?CategoryTeam
    {
        return $this->category;
    }

    public function setCategory(?CategoryTeam $category): static
    {
        $this->category = $category;

        return $this;
    }






}
