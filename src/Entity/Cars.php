<?php

namespace App\Entity;

use App\Repository\CarsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarsRepository::class)
 */
class Cars
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $registration_number;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $km;

    /**
     * @ORM\ManyToOne(targetEntity=CarBrand::class, inversedBy="cars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $brand;

    /**
     * @ORM\ManyToOne(targetEntity=CarColor::class, inversedBy="cars_color")
     * @ORM\JoinColumn(nullable=false)
     */
    private $color;

    /**
     * @ORM\OneToMany(targetEntity=Booking::class, mappedBy="car", orphanRemoval=true)
     */
    private $booked_car;

    public function __construct()
    {
        $this->booked_car = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegistrationNumber(): ?string
    {
        return $this->registration_number;
    }

    public function setRegistrationNumber(string $registration_number): self
    {
        $this->registration_number = $registration_number;

        return $this;
    }

    public function getKm(): ?int
    {
        return $this->km;
    }

    public function setKm(?int $km): self
    {
        $this->km = $km;

        return $this;
    }

    public function getBrand(): ?CarBrand
    {
        return $this->brand;
    }

    public function setBrand(?CarBrand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getColor(): ?CarColor
    {
        return $this->color;
    }

    public function setColor(?CarColor $color): self
    {
        $this->color = $color;

        return $this;
    }
    public function __toString(): string
    {
        return $this->registration_number;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getBookedCar(): Collection
    {
        return $this->booked_car;
    }

    public function addBookedCar(Booking $bookedCar): self
    {
        if (!$this->booked_car->contains($bookedCar)) {
            $this->booked_car[] = $bookedCar;
            $bookedCar->setCar($this);
        }

        return $this;
    }

    public function removeBookedCar(Booking $bookedCar): self
    {
        if ($this->booked_car->removeElement($bookedCar)) {
            // set the owning side to null (unless already changed)
            if ($bookedCar->getCar() === $this) {
                $bookedCar->setCar(null);
            }
        }

        return $this;
    }
}
