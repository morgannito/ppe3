<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\UtilisateursAdresses;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UtilisateursAdressesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $adresse1 = new UtilisateursAdresses();
        $adresse1->setUser($this->getReference('utilisateur1'));
        $adresse1->setNom('Catelain');
        $adresse1->setPrenom('Benjamin');
        $adresse1->setTelephone('0600000000');
        $adresse1->setAdresse('3 rue alberta rubosca');
        $adresse1->setCp('76600');
        $adresse1->setPays('France');
        $adresse1->setVille('Le Havre');
        $adresse1->setComplement('face à l\'église');
        $manager->persist($adresse1);
        
        $adresse2 = new UtilisateursAdresses();
        $adresse2->setUser($this->getReference('utilisateur3'));
        $adresse2->setNom('premier');
        $adresse2->setPrenom('albert');
        $adresse2->setTelephone('0600000000');
        $adresse2->setAdresse('5 rue rubosca');
        $adresse2->setCp('76600');
        $adresse2->setPays('France');
        $adresse2->setVille('Le Havre');
        $adresse2->setComplement('face à la plage');
        $manager->persist($adresse2);
        
        $manager->flush();
    }
    
     // Doit charger le fichier avant celui ci, pour les reference
     public function getDependencies()
     {
         return array(
             UtilisateursFixtures::class,
         );
     }

}
