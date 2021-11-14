<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Categorias;

class CategoriasFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $values = [
            ["nom" => "Oleos"],
            ["nom" => "Massagens"]];
        
        foreach($values as $value){
            
            $dao = new Categorias();
            $dao->setNom($value["nom"]);
            $manager->persist($dao);
            
            $manager->flush();
             
        }
    }
}
