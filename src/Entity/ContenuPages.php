<?php

namespace App\Entity;

use App\Repository\ContenuPagesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContenuPagesRepository::class)
 */
class ContenuPages
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contenu_text;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_image;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $titre;

    /**
     * @ORM\ManyToOne(targetEntity=Pages::class, inversedBy="contenus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pages;

    /**
     * @ORM\ManyToOne(targetEntity=SecaoPage::class, inversedBy="contenuPages")
     */
    private $sections;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenuText(): ?string
    {
        return $this->contenu_text;
    }

    public function setContenuText(?string $contenu_text): self
    {
        $this->contenu_text = $contenu_text;

        return $this;
    }

    public function getIdImage(): ?int
    {
        return $this->id_image;
    }

    public function setIdImage(?int $id_image): self
    {
        $this->id_image = $id_image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getIdPage(): ?bool
    {
        return $this->id_page;
    }
    

    public function setIdPage(bool $id_page): self
    {
        $this->id_page = $id_page;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getPages(): ?Pages
    {
        return $this->pages;
    }

    public function setPages(?Pages $pages): self
    {
        $this->pages = $pages;

        return $this;
    }

    public function getSections(): ?SecaoPage
    {
        return $this->sections;
    }

    public function setSections(?SecaoPage $sections): self
    {
        $this->sections = $sections;

        return $this;
    }
}
