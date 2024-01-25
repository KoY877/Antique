<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotCompromisedPassword;
use Symfony\Component\Validator\Mapping\ClassMetadata;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    public static function loadValidatorMetadata(ClassMetadata $metadata) {
        $metadata->addPropertyConstraint('rawPassword', new NotCompromisedPassword(
            ['message' => 'Le mot de passe doit contenir au moins 12 caractère',]
        ));
    }

    private $rawPassword;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Length(['min'=> 12, 'max' => 99])] // Mot de passe au moins 12 caractère
    private ?string $password = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?int $nombreDeConvives = null;

    #[ORM\ManyToMany(targetEntity: Allergie::class, inversedBy: 'users')]
    private Collection $mentionDesAllergies;

    public function __construct()
    {
        $this->mentionDesAllergies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getRawPassword():string
    {
        return $this->rawPassword;
    }

    public function setRawPassword(string $rawPassword):self
    {
        $this->rawPassword = $rawPassword;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getNombreDeConvives(): ?int
    {
        return $this->nombreDeConvives;
    }

    public function setNombreDeConvives(?int $nombreDeConvives): static
    {
        $this->nombreDeConvives = $nombreDeConvives;

        return $this;
    }

    /**
     * @return Collection<int, Allergie>
     */
    public function getMentionDesAllergies(): Collection
    {
        return $this->mentionDesAllergies;
    }

    public function addMentionDesAllergy(Allergie $mentionDesAllergy): static
    {
        if (!$this->mentionDesAllergies->contains($mentionDesAllergy)) {
            $this->mentionDesAllergies->add($mentionDesAllergy);
        }

        return $this;
    }

    public function removeMentionDesAllergy(Allergie $mentionDesAllergy): static
    {
        $this->mentionDesAllergies->removeElement($mentionDesAllergy);

        return $this;
    }
}
