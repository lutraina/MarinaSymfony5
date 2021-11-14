<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Images;

class ImagesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $images = [
            ["page" => "accueil", "type_block" => "highlights", "nom" => "IMG_6468.jpg"], 
            ["page" => "accueil", "type_block" => "highlights", "nom" => "IMG_6469.jpg"],
            ["page" => "accueil", "type_block" => "highlights", "nom" => "IMG_6473.jpg"]];
        
        foreach($images as $values){
            
                $image = new Images();
                $image->setPage($values["page"]);
                $image->setNom($values["nom"]);
                $image->setTypeBlock($values["type_block"]);
                $manager->persist($image);
                
                $manager->flush();
            
            
           
        }

    }
}
