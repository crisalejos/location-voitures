<?php

namespace App\Entity;

use App\Repository\CarBrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarBrandRepository::class)
 */
class CarBrand
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Cars::class, mappedBy="brand")
     */
    private $cars;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
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
    public function __toString(): string
    {
        return $this->name;
    }
    //  ici change de la vr precedent  //////////////////////////////

    /**
     * @return Collection|Cars[]
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Cars $car): self
    {
        if (!$this->cars->contains($car)) {
            $this->cars[] = $car;
            $car->setBrand($this);
        }

        return $this;
    }

    public function removeCar(Cars $car): self
    {
        if ($this->cars->removeElement($car)) {
            // set the owning side to null (unless already changed)
            if ($car->getBrand() === $this) {
                $car->setBrand(null);
            }
        }

        return $this;
    }
}
