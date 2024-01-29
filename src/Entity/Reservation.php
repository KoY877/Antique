<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $nombreDeConvive = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 150)]
    private ?string $heurePrevue = null;

    #[ORM\Column(length: 150)]
    private ?string $minutePrevue = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(length: 255)]
    private ?string $mentionDesAllergies = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNombreDeConvive(): ?int
    {
        return $this->nombreDeConvive;
    }

    public function setNombreDeConvive(int $nombreDeConvive): static
    {
        $this->nombreDeConvive = $nombreDeConvive;

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

    public function getHeurePrevue(): ?string
    {
        return $this->heurePrevue;
    }

    public function setHeurePrevue(string $heurePrevue): static
    {
        $this->heurePrevue = $heurePrevue;

        return $this;
    }

    public function getMinutePrevue(): ?string
    {
        return $this->minutePrevue;
    }

    public function setMinutePrevue(string $minutePrevue): static
    {
        $this->minutePrevue = $minutePrevue;

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

    public function getMentionDesAllergies(): ?string
    {
        return $this->mentionDesAllergies;
    }

    public function setMentionDesAllergies(string $mentionDesAllergies): static
    {
        $this->mentionDesAllergies = $mentionDesAllergies;

        return $this;
    }
}
