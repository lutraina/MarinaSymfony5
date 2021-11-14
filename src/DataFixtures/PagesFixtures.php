<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Pages;

class PagesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        $values = [
            ["nom" => "Home", "nom_route" => "home", "contenu_text" => "IMG_6468.jpg", "titre" => "IMG_6468.jpg"],
            ["nom" =>"Profissional", "nom_route" => "quem_sou", "contenu_text" => "IMG_6469.jpg", "titre" => "IMG_6468.jpg"],
            ["nom" => "Metodologia", "nom_route" => "metodologia", "contenu_text" => "IMG_6469.jpg", "titre" => "IMG_6468.jpg"],
            ["nom" => "Produtos", "nom_route" => "produtos", "contenu_text" => "IMG_6469.jpg", "titre" => "IMG_6468.jpg"],
            ["nom" => "Contato", "nom_route" => "contato", "contenu_text" => "IMG_6473.jpg", "titre" => "IMG_6468.jpg"]];
        
        foreach($values as $value){
            
            $dao = new Pages();
            $dao->setNom($value["nom"]);
            $dao->setNomRoute($value["nom_route"]);
            $manager->persist($dao);
            
            $manager->flush();
            
            
            
        }
        
       

        
    }
}
