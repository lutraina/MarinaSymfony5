<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\ContenuPages;
use App\Entity\Pages;
use App\Entity\SecaoPage;

class ContenuPagesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $pageValues = ["nom" => "Home", "nom_route" => "home", "contenu_text" => "IMG_6468.jpg", "titre" => "IMG_6468.jpg"];
        $sectionValues = ["nom" => "Header"];
        
        $page = new Pages();
        $page->setNom($pageValues['nom']);
        $page->setTitle($pageValues['titre']);
        $page->setNomRoute($pageValues['nom_route']);
        $manager->persist($page);
        
        $section = new SecaoPage();
        $section->setNom($sectionValues['nom']);
        $manager->persist($section);
        
        
        $images = [
            ["id_image" => 1, "type_block" => "id_page", "contenu_text" => "IMG_6468.jpg", "titre" => "IMG_6468.jpg"],
            ["id_image" => 2, "type_block" => "id_page", "contenu_text" => "IMG_6469.jpg", "titre" => "IMG_6468.jpg"],
            ["id_image" => 3, "type_block" => "id_page", "contenu_text" => "IMG_6473.jpg", "titre" => "IMG_6468.jpg"]];
        
        foreach($images as $values){
            
            $dao = new ContenuPages();
            $dao->setContenuText($values["contenu_text"]);
            $dao->setIdImage($values["id_image"]);
            $dao->setIdPage($values["id_image"]);
            $dao->setTitre($values["titre"]);
            $dao->setPages($page);
            $dao->setSections($section);
            $manager->persist($dao);
            
            $manager->flush();
            
            
            
        }
    }
}
