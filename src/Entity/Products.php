<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductsRepository::class)]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?Category $category = null;

    #[ORM\OneToMany(mappedBy: 'products', targetEntity: order::class)]
    private Collection $pizza_id;

    public function __construct()
    {
        $this->pizza_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCategoryId(): ?Category
    {
        return $this->category_id;
    }

    public function setCategoryId(?Category $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * @return Collection<int, order>
     */
    public function getPizzaId(): Collection
    {
        return $this->pizza_id;
    }

    public function addPizzaId(order $pizzaId): self
    {
        if (!$this->pizza_id->contains($pizzaId)) {
            $this->pizza_id->add($pizzaId);
            $pizzaId->setProducts($this);
        }

        return $this;
    }

    public function removePizzaId(order $pizzaId): self
    {
        if ($this->pizza_id->removeElement($pizzaId)) {
            // set the owning side to null (unless already changed)
            if ($pizzaId->getProducts() === $this) {
                $pizzaId->setProducts(null);
            }
        }

        return $this;
    }
}
