<?php
namespace App\Entity;

use App\Repository\CoachRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: CoachRepository::class)]
#[UniqueEntity(fields: ['licenseNumber'], message: 'There is already an account with this licenseNumber')]
class Coach extends Member implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Column(type: "string")]
    public $email;

    #[ORM\Column(type: "json")]
    private $roles = [];

    #[ORM\Column(type: "string")]
    private $password;

    #[ORM\Column(type: "boolean")]
    private $isAdmin;

    public function __construct($licenseNumber,$firstName, $lastName, Contact $contact, Category $category, $email, $password, $isAdmin = false)
    {
        parent::__construct($licenseNumber, $firstName, $lastName, $contact, $category);
        
        $this->email = $email;
        $this->password = $password;
        $this->isAdmin = $isAdmin;
    }
   
   

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->getLicenseNumber();
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}