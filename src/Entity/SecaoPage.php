<?php

namespace App\Entity;

use App\Repository\SecaoPageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SecaoPageRepository::class)
 */
class SecaoPage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=ContenuPages::class, mappedBy="Sections")
     */
    private $contenuPages;

    public function __construct()
    {
        $this->contenuPages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|ContenuPages[]
     */
    public function getContenuPages(): Collection
    {
        return $this->contenuPages;
    }

    public function addContenuPage(ContenuPages $contenuPage): self
    {
        if (!$this->contenuPages->contains($contenuPage)) {
            $this->contenuPages[] = $contenuPage;
            $contenuPage->setSections($this);
        }

        return $this;
    }

    public function removeContenuPage(ContenuPages $contenuPage): self
    {
        if ($this->contenuPages->removeElement($contenuPage)) {
            // set the owning side to null (unless already changed)
            if ($contenuPage->getSections() === $this) {
                $contenuPage->setSections(null);
            }
        }

        return $this;
    }
}
