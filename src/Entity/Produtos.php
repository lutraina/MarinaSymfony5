<?php

namespace App\Entity;

use App\Repository\ProdutosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProdutosRepository::class)
 */
class Produtos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=120)
     */
    private $nom;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descricao;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $id_image;

    /**
     * @ORM\ManyToOne(targetEntity=Categorias::class, inversedBy="Produtos")
     */
    private $categorias;

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

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getIdImage(): ?bool
    {
        return $this->id_image;
    }

    public function setIdImage(?bool $id_image): self
    {
        $this->id_image = $id_image;

        return $this;
    }

    public function getCategorias(): ?Categorias
    {
        return $this->categorias;
    }

    public function setCategorias(?Categorias $categorias): self
    {
        $this->categorias = $categorias;

        return $this;
    }
}
