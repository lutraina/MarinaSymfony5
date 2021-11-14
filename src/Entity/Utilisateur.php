<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 * @UniqueEntity("username", message="User existente")
 */
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150, nullable=false)
     * @Assert\Length(min=5, max=10, minMessage="Il faut plus de 5 carac", maxMessage="Il faut moins de 10 carac.")
     * 
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\Length(min=5, max=10, minMessage="Il faut plus de 5 carac", maxMessage="Il faut moins de 10 carac.")
     */
    private $password;
    
    /**
     * @Assert\Length(min=5, max=10, minMessage="Il faut plus de 5 carac", maxMessage="Il faut moins de 10 carac.")
     * @Assert\EqualTo("password", message="Senhas diferentes")
     */
    private $verificationPassword;

    private $plainPassword;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $roles = [];
    
    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    public function __construct(){
        $this->username = 'Default value';
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Thias method can be removed in Symfony 6.0 - 
     * it's not needed for apps
     * {@inheritDoc}
     * @see \Symfony\Component\Security\Core\User\UserInterface::getPassword()
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }


    public function getVerificationPassword(): ?string
    {
        return $this->password;
    }
    
    public function setVerificationPassword(?string $verificationPassword): self
    {
        $this->verificationPassword = $verificationPassword;
        
        return $this;
    }
    
    public function eraseCredentials(){
        $this->plainPassword = null;   
    }
    
    public function getUserIdentifier(): ?string
    {
        return $this->username;
    }
    
    public function getSalt(){
        
    }
    
    public function getRoles()
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        //return ['ROLE_USER'];
        return array_unique($roles);
        
        //return $this->getRoles()->toArray();
    }
    
    public function __toString(): string
    {
        return $this->username;
    }

    public function setRoles(?array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
    
    
    
}
