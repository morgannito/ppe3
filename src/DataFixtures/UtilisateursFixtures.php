<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User as Utilisateurs;

class UtilisateursFixtures extends Fixture
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
    

        $utilisateur1 = new Utilisateurs();
        $utilisateur1->setUsername('benjamin');
        $utilisateur1->setEmail('benjamin@gmail.com');
        $utilisateur1->setEnabled(1);
        $password1 = $this->encoder->encodePassword($utilisateur1, 'utilisateur1');
        $utilisateur1->setPassword($password1);
        $manager->persist($utilisateur1);
        
        $utilisateur2 = new Utilisateurs();
        $utilisateur2->setUsername('mathilde');
        $utilisateur2->setEmail('mathilde@gmail.com');
        $utilisateur2->setEnabled(1);
        $password1 = $this->encoder->encodePassword($utilisateur2, 'utilisateur1');
        $utilisateur2->setPassword($password1);
        $manager->persist($utilisateur2);
        
        $utilisateur3 = new Utilisateurs();
        $utilisateur3->setUsername('pauline');
        $utilisateur3->setEmail('pauline@gmail.com');
        $utilisateur3->setEnabled(1);
        $password1 = $this->encoder->encodePassword($utilisateur3, 'utilisateur1');
        $utilisateur3->setPassword($password1);
        $manager->persist($utilisateur3);
        
        $utilisateur4 = new Utilisateurs();
        $utilisateur4->setUsername('tiffany');
        $utilisateur4->setEmail('tiffany@gmail.com');
        $utilisateur4->setEnabled(1);
        $password1 = $this->encoder->encodePassword($utilisateur4, 'utilisateur1');
        $utilisateur4->setPassword($password1);
        $manager->persist($utilisateur4);
         
        $utilisateur5 = new Utilisateurs();
        $utilisateur5->setUsername('dominique');
        $utilisateur5->setEmail('dominique@gmail.com');
        $utilisateur5->setEnabled(1);
        $password1 = $this->encoder->encodePassword($utilisateur5, 'utilisateur1');
        $utilisateur5->setPassword($password1);
        $manager->persist($utilisateur5);
        

        $utilisateur6 = new Utilisateurs();
        $utilisateur6->setUsername('admin');
        $utilisateur6->setEmail('lyon@gmail.com');
        $utilisateur6->setRoles(array('ROLE_ADMIN'));
        $utilisateur6->setEnabled(1);
        $password1 = $this->encoder->encodePassword($utilisateur6, 'admin');
        $utilisateur6->setPassword($password1);
        
        $manager->persist($utilisateur6);
        
        $manager->flush();
        
        $this->addReference('utilisateur1', $utilisateur1);
        $this->addReference('utilisateur2', $utilisateur2);
        $this->addReference('utilisateur3', $utilisateur3);
        $this->addReference('utilisateur4', $utilisateur4);
        $this->addReference('utilisateur5', $utilisateur5);
        $this->addReference('utilisateur6', $utilisateur6);
    }
    
    
}