<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\SecaoPage;

class SecaoPageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $values = [
            ["nom" => "Header"],
            ["nom" => "Footer"]];
        
        foreach($values as $value){
            
            $dao = new SecaoPage();
            $dao->setNom($value["nom"]);
            $manager->persist($dao);
            
            $manager->flush();
            
            
            
        }
    }
}
