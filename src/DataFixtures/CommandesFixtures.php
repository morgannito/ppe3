<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Commandes;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class CommandesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $commande1 = new Commandes();
        $commande1->setUser($this->getReference('utilisateur1'));
        $commande1->setValider('1');
        $commande1->setDate(new \DateTime());
        $commande1->setReference('1');
        $commande1->setCommande(array('0' => array('1' => '2'),
                                      '1' => array('2' => '1'),
                                      '2' => array('4' => '5')
                                ));
        $manager->persist($commande1);
        
        $commande2 = new Commandes();
        $commande2->setUser($this->getReference('utilisateur3'));
        $commande2->setValider('1');
        $commande2->setDate(new \DateTime());
        $commande2->setReference('2');
        $commande2->setCommande(array('0' => array('1' => '2'),
                                      '1' => array('2' => '1'),
                                      '2' => array('4' => '5')
                                ));
        $manager->persist($commande2);

        $manager->flush();
    }

     // Doit charger le fichier avant celui ci, pour les reference
     public function getDependencies()
     {
         return array(
             UtilisateursAdressesFixtures::class,
         );
     }
}
