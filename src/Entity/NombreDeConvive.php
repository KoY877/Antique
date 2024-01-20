<?php

namespace App\Entity;

use App\Repository\NombreDeConviveRepository;
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

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
