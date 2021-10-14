<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\ContenuPages;

class ContenuPagesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $contenu1 = new ContenuPages();
        $contenu1->setContenuText("Contenu page Methodologie");
        $manager->persist($contenu1);

        $manager->flush();
    }
}
