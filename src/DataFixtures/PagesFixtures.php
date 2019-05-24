<?php

namespace App\DataFixtures;

use App\Entity\Pages;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PagesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    { 

        for ($i = 1; $i <= 6; $i++) {
        $pages = new Pages();
        $pages->setTitre("Article n°$i");
        $pages->setContenu("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.");
        $manager->persist($pages);
        $manager->flush();




        }
    }
}
