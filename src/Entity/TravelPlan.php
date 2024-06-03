<?php

namespace App\Entity;

use App\Repository\TravelPlanRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TravelPlanRepository::class)]
class TravelPlan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $morning = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $noon = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $afternoon = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $evening = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getMorning(): ?string
    {
        return $this->morning;
    }

    public function setMorning(?string $morning): static
    {
        $this->morning = $morning;

        return $this;
    }

    public function getNoon(): ?string
    {
        return $this->noon;
    }

    public function setNoon(?string $noon): static
    {
        $this->noon = $noon;

        return $this;
    }

    public function getAfternoon(): ?string
    {
        return $this->afternoon;
    }

    public function setAfternoon(?string $afternoon): static
    {
        $this->afternoon = $afternoon;

        return $this;
    }

    public function getEvening(): ?string
    {
        return $this->evening;
    }

    public function setEvening(?string $evening): static
    {
        $this->evening = $evening;

        return $this;
    }
}
