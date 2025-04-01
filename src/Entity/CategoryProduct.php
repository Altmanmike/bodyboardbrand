<?php

namespace App\Entity;

use App\Repository\CategoryProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use OpenApi\Attributes as OA;

#[ORM\Entity(repositoryClass: CategoryProductRepository::class)]
#[ORM\Table(name: '`categoryProduct`')]
class CategoryProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['categoryProducts.index'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[OA\Property(type: 'string', maxLength: 255)]
    #[Groups(['products.show','categoryProducts.index','categoryProducts.show','categoryProducts.create','categoryProducts.update'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[OA\Property(type: 'string')]
    #[Groups(['categoryPosts.index','categoryProducts.show','categoryProducts.create','categoryProducts.update'])]
    private ?string $description = null;

    #[ORM\Column(options: ['default' => 'CURRENT_TIMESTAMP'])]
    #[Groups(['categoryProducts.date'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['categoryProducts.date'])]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, Product>
     */
    #[ORM\OneToMany(targetEntity: Product::class, mappedBy: 'category', fetch: 'EAGER')]
    private Collection $products;

    public function __construct()
    {     
        $this->createdAt = new \DateTimeImmutable();
        $this->products = new ArrayCollection();       
    }
    


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
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

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
