<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements PasswordAuthenticatedUserInterface, UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 3, max: 10, minMessage: 'At least 3 characters', maxMessage: 'At most 10 characters')]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 3, max: 10, minMessage: 'At least 3 characters', maxMessage: 'At most 10 characters')]
    private ?string $password = null;

    
    #[Assert\Length(min: 3, max: 10, minMessage: 'At least 3 characters', maxMessage: 'At most 10 characters')]
    #[Assert\EqualTo(propertyPath: 'password', message: 'Passwords should match')]
    private ?string $passwordConfirm = null;

    #[ORM\Column(length: 255)]
    private ?string $roles = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }
    public function getPasswordConfirm(): ?string
    {
        return $this->passwordConfirm;
    }

    public function setPasswordConfirm(string $passwordConfirm): static
    {
        $this->passwordConfirm = $passwordConfirm;

        return $this;
    }

    public function eraseCredentials() :void
    {
    }

    public function getSalt()
    {
    }

    public function getRoles(): array
    {
        return [$this->roles];
    }

    public function getUserIdentifier(): string
    {
        return $this->username;
    }

    public function setRoles(?string $roles): static
    {
        if ($roles === null) {
            $roles = 'ROLE_USER';
        } else {
            $this->roles = $roles;
        }

        return $this;
    }
}
