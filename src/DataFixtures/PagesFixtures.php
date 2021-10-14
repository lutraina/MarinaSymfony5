<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Pages;

class PagesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        $pages = ["Home", "QuemSou", "Metodologia", "Produtos", "Contato"];
        
        foreach($pages as $value){
            $page1 = new Pages();
            $page1->setNom($value);
            $manager->persist($page1);
            
            $manager->flush();
        }

        
    }
}
