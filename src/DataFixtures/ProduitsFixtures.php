<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Produits;



class ProduitsFixtures extends Fixture 
{
    public function load(ObjectManager $manager)
    {
        $produit1 = new Produits();
        $produit1->setCategorie($this->getReference('categorie1'));
        $produit1->setDescription("Prononcez I hate en anglais, donc je déteste en français ");
        $produit1->setDisponible('1');
        $produit1->setNom('BMW i8');
        $produit1->setPrix('143800');
        $produit1->setPath('https://sf1.viepratique.fr/wp-content/uploads/sites/9/2017/11/bmw_i8_9-750x410.jpg');
        $manager->persist($produit1);

        $produit2 = new Produits();
        $produit2->setCategorie($this->getReference('categorie1'));
        $produit2->setDescription("Les américains auraient-ils entendu parler de la seconde Guerre Mondiale ?");
        $produit2->setDisponible('1');
        $produit2->setNom('Chevrolet SS');
        $produit2->setPrix('143800');
        $produit2->setPath('https://sf2.viepratique.fr/wp-content/uploads/sites/9/2017/11/chevrolet_ss_14-750x410.jpg');
        $manager->persist($produit2);

        $produit3 = new Produits();
        $produit3->setCategorie($this->getReference('categorie1'));
        $produit3->setDescription("Une cure de vitamines eut été recommandée à ses géniteurs. ");
        $produit3->setDisponible('1');
        $produit3->setNom('Kia CARENS');
        $produit3->setPrix('143800');
        $produit3->setPath('https://sf2.viepratique.fr/wp-content/uploads/sites/9/2017/11/kia_carens_11-750x410.jpg');
        $manager->persist($produit3);
        
        $produit4 = new Produits();
        $produit4->setCategorie($this->getReference('categorie1'));
        $produit4->setDescription("Pas très discret pour ..");
        $produit4->setDisponible('1');
        $produit4->setNom('Lexus IS F');
        $produit4->setPrix('143800');
        $produit4->setPath('https://sf2.viepratique.fr/wp-content/uploads/sites/9/2017/11/autowp.ru_lexus_is_f_11-750x410.jpg');
        $manager->persist($produit4);
        
        $produit5 = new Produits();
        $produit5->setCategorie($this->getReference('categorie2'));
        $produit5->setDescription("Sans commentaire.");
        $produit5->setDisponible('1');
        $produit5->setNom('Mazda LAPUTA');
        $produit5->setPrix('143800');
        $produit5->setPath('https://sf1.viepratique.fr/wp-content/uploads/sites/9/2017/11/autowp.ru_mazda_laputa_5-750x410.jpg');
        $manager->persist($produit5);
        
        $produit6 = new Produits();
        $produit6->setCategorie($this->getReference('categorie2'));
        $produit6->setDescription("Une voiture de jeune voyou, pour rester courtois.");
        $produit6->setDisponible('1');
        $produit6->setNom('Toyota MR2');
        $produit6->setPrix('143800');
        $produit6->setPath('https://sf1.viepratique.fr/wp-content/uploads/sites/9/2017/11/autowp.ru_toyota_mr2_roadster_19-750x410.jpg');
        $manager->persist($produit6);
        
        $manager->flush();
    }
    

     
}
