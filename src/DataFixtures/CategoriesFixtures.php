<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Categories;

class CategoriesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categorie1 = new Categories();
        $categorie1->setNom('Voiture Fun');

        $manager->persist($categorie1);
       
        $categorie2 = new Categories();
        $categorie2->setNom('Voiture');
        $manager->persist($categorie2);
       
        $manager->flush();
       
             
        $this->addReference('categorie1', $categorie1);
        $this->addReference('categorie2', $categorie2);

    }
    
    // Doit charger le fichier avant celui ci, pour les reference

    
}
