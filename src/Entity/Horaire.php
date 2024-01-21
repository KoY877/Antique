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

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $ouvertureMidi = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fermetureMidi = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $ouvertureSoir = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fermetureSoir = null;

    #[ORM\Column]
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

    public function getOuvertureMidi(): ?\DateTimeInterface
    {
        return $this->ouvertureMidi;
    }

    public function setOuvertureMidi(?\DateTimeInterface $ouvertureMidi): static
    {
        $this->ouvertureMidi = $ouvertureMidi;

        return $this;
    }

    public function getFermetureMidi(): ?\DateTimeInterface
    {
        return $this->fermetureMidi;
    }

    public function setFermetureMidi(?\DateTimeInterface $fermetureMidi): static
    {
        $this->fermetureMidi = $fermetureMidi;

        return $this;
    }

    public function getOuvertureSoir(): ?\DateTimeInterface
    {
        return $this->ouvertureSoir;
    }

    public function setOuvertureSoir(?\DateTimeInterface $ouvertureSoir): static
    {
        $this->ouvertureSoir = $ouvertureSoir;

        return $this;
    }

    public function getFermetureSoir(): ?\DateTimeInterface
    {
        return $this->fermetureSoir;
    }

    public function setFermetureSoir(?\DateTimeInterface $fermetureSoir): static
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
