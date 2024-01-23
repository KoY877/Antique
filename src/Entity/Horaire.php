<?php

namespace App\Entity;

use App\Repository\HoraireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HoraireRepository::class)]
class Horaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomDuJour = null;

    #[ORM\Column(length: 255)]
    private ?string $ouvertureMidi = null;

    #[ORM\Column(length: 255)]
    private ?string $fermetureMidi = null;

    #[ORM\Column(length: 255)]
    private ?string $ouvertureSoir = null;

    #[ORM\Column(length: 255)]
    private ?string $fermetureSoir = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDuJour(): ?string
    {
        return $this->nomDuJour;
    }

    public function setNomDuJour(string $nomDuJour): static
    {
        $this->nomDuJour = $nomDuJour;

        return $this;
    }

    public function getOuvertureMidi(): ?string
    {
        return $this->ouvertureMidi;
    }

    public function setOuvertureMidi(?string $ouvertureMidi): static
    {
        $this->ouvertureMidi = $ouvertureMidi;

        return $this;
    }

    public function getFermetureMidi(): ?string
    {
        return $this->fermetureMidi;
    }

    public function setFermetureMidi(?string $fermetureMidi): static
    {
        $this->fermetureMidi = $fermetureMidi;

        return $this;
    }

    public function getOuvertureSoir(): ?string
    {
        return $this->ouvertureSoir;
    }

    public function setOuvertureSoir(?string $ouvertureSoir): static
    {
        $this->ouvertureSoir = $ouvertureSoir;

        return $this;
    }

    public function getFermetureSoir(): ?string
    {
        return $this->fermetureSoir;
    }

    public function setFermetureSoir(?string $fermetureSoir): static
    {
        $this->fermetureSoir = $fermetureSoir;

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
