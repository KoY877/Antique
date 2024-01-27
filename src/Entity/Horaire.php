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
    private ?string $slug = null;


    #[ORM\Column(length: 255)]
    private ?string $midi = null;

    #[ORM\Column(length: 255)]
    private ?string $soir = null;


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

    public function getMidi(): ?string
    {
        return $this->midi;
    }

    public function setMidi(?string $ouvertureMidi): static
    {
        $this->midi = $ouvertureMidi;

        return $this;
    }

    public function getSoir(): ?string
    {
        return $this->soir;
    }

    public function setSoir(?string $fermetureSoir): static
    {
        $this->soir = $fermetureSoir;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

}
