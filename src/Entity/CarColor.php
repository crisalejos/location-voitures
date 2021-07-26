<?php

namespace App\Entity;

use App\Repository\CarColorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarColorRepository::class)
 */
class CarColor
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
    private $color;

    /**
     * @ORM\OneToMany(targetEntity=Cars::class, mappedBy="color")
     */
    private $cars_color;

    public function __construct()
    {
        $this->cars_color = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }
    public function __toString(): string
    {
        return $this->color;
    }
    //  ici change de la vr precedent  //////////////////////////////

    /**
     * @return Collection|Cars[]
     */
    public function getCarsColor(): Collection
    {
        return $this->cars_color;
    }

    public function addCarsColor(Cars $carsColor): self
    {
        if (!$this->cars_color->contains($carsColor)) {
            $this->cars_color[] = $carsColor;
            $carsColor->setColor($this);
        }

        return $this;
    }

    public function removeCarsColor(Cars $carsColor): self
    {
        if ($this->cars_color->removeElement($carsColor)) {
            // set the owning side to null (unless already changed)
            if ($carsColor->getColor() === $this) {
                $carsColor->setColor(null);
            }
        }

        return $this;
    }
}
