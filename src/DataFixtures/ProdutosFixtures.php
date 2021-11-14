<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Produtos;
use App\Entity\Categorias;

class ProdutosFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $images = [
            ["nom" => "produto1", "id_image" => 1, "descricao" => "IMG_6468.jpg"],
            ["nom" => "produto2", "id_image" => 2, "descricao" => "IMG_6469.jpg"],
            ["nom" => "produto3", "id_image" => 3, "descricao" => "IMG_6473.jpg"]];
        
        $valuesCat = ["nom" => "Oleos", "nom" => "Massagens"];
        
            $cat = new Categorias();
            $cat->setNom($valuesCat["nom"]);
            $manager->persist($cat);
        
        foreach($images as $values){
            
            $dao = new Produtos();
            $dao->setNom($values["nom"]);
            $dao->setIdImage($values["id_image"]);
            $dao->setDescricao($values["descricao"]);
            $dao->setCategorias($cat);
            $manager->persist($dao);
            
            $manager->flush();
            
            
            
        }
    }
}
