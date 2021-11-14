<?php

namespace App\Entity;

use App\Repository\PagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PagesRepository::class)
 */
class Pages
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $visibility_flag;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nom_route;

    /**
     * @ORM\OneToMany(targetEntity=ContenuPages::class, mappedBy="pages")
     */
    private $contenus;

    public function __construct()
    {
        $this->contenus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getVisibilityFlag(): ?bool
    {
        return $this->visibility_flag;
    }

    public function setVisibilityFlag(?bool $visibility_flag): self
    {
        $this->visibility_flag = $visibility_flag;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNomRoute(): ?string
    {
        return $this->nom_route;
    }

    public function setNomRoute(string $nom_route): self
    {
        $this->nom_route = $nom_route;

        return $this;
    }

    /**
     * @return Collection|ContenuPages[]
     */
    public function getContenus(): Collection
    {
        return $this->contenus;
    }

    public function addContenu(ContenuPages $contenu): self
    {
        if (!$this->contenus->contains($contenu)) {
            $this->contenus[] = $contenu;
            $contenu->setPages($this);
        }

        return $this;
    }

    public function removeContenu(ContenuPages $contenu): self
    {
        if ($this->contenus->removeElement($contenu)) {
            // set the owning side to null (unless already changed)
            if ($contenu->getPages() === $this) {
                $contenu->setPages(null);
            }
        }

        return $this;
    }
}
