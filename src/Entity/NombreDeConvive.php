<?php

namespace App\Entity;

use App\Repository\NombreDeConviveRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NombreDeConviveRepository::class)]
class NombreDeConvive
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nombreDePlaceDisponible = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreDePlaceDisponible(): ?int
    {
        return $this->nombreDePlaceDisponible;
    }

    public function setNombreDePlaceDisponible(int $nombreDePlaceDisponible): static
    {
        $this->nombreDePlaceDisponible = $nombreDePlaceDisponible;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
