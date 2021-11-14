<?php

namespace App\Entity;

use App\Repository\CategoriasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriasRepository::class)
 */
class Categorias
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Produtos::class, mappedBy="categorias")
     */
    private $Produtos;

    public function __construct()
    {
        $this->Produtos = new ArrayCollection();
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
     * @return Collection|Produtos[]
     */
    public function getProdutos(): Collection
    {
        return $this->Produtos;
    }

    public function addProduto(Produtos $produto): self
    {
        if (!$this->Produtos->contains($produto)) {
            $this->Produtos[] = $produto;
            $produto->setCategorias($this);
        }

        return $this;
    }

    public function removeProduto(Produtos $produto): self
    {
        if ($this->Produtos->removeElement($produto)) {
            // set the owning side to null (unless already changed)
            if ($produto->getCategorias() === $this) {
                $produto->setCategorias(null);
            }
        }

        return $this;
    }
    
    public function __toString(){
        return '';   
    }
}
