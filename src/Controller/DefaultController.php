<?php

namespace App\Controller;

use App\Entity\Pages;
use App\Entity\Produits;
use App\Entity\Categories;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use PhpParser\Node\Stmt;
use App\Entity\UtilisateursAdresses;
use App\Form\AdresseType;
use App\Entity\Utilisateurs;
use App\Entity\User;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


use Doctrine\ORM\Query;
use App\Entity\Commandes;

class DefaultController extends AbstractController
{

       /**
     * @Route("/", name="index")                               
     // *ça marche
     */
     public function index()
     {
         return $this->render('default/index.html.twig', [
             'controller_name' => 'DefaultController',
         ]);
     }

   
     

     /**
     * @Route("produits/{idcategories}", name="produitscat")
          // *ça marche
     */
     public function produitscat( $idcategories = NULL,ObjectManager $manager , Request $request)
     { $repo = $this->getDoctrine()->getRepository(Categories::class);
         $categories = $repo->findAll();
 
 
         $repo = $this->getDoctrine()->getRepository(Produits::class);
         $produits = $repo->findAll();

   
  
        
         if($idcategories!=NULL){
 
             $rawSql =   "SELECT * FROM produits WHERE categorie_id = :idcategories";
             $stmt = $manager->getConnection()->prepare($rawSql);
             $stmt->bindValue('idcategories', $idcategories);
             $stmt->execute();
             $produits = $stmt->fetchAll();
         }
 
 
    
             return $this->render('default/produits.html.twig', [
                 'controller_name' => 'DefaultController', 'categories'=>$categories,'produits'=>$produits,
             ]);
         
      
     }

    

       /**
     * @Route("produits/details/{prodtuitsdetails}", name="details")
          // *ça marche
     */
     public function details(Produits $prodtuitsdetails,Request $request, UserInterface $user = null,ObjectManager $manager)
     { 

        

             return $this->render('default/prodtuitsdetails.html.twig', [
                 'controller_name' => 'DefaultController', 'prodtuitsdetails'=>$prodtuitsdetails,
             ]);
         
      
     }
     
   


   

   


       /**
     * @Route("/panier", name="panier")
     */
     public function panier(Request $request,Session $session  ,ObjectManager $manager )
     {


            // récupere la session
        $session=$request->getSession();
        // récupere le panier
        $session->get( 'panier');
        
        $idproduit=$session->get('panier');

        if($session->get('panier')!=NULL)
        {
            $rawSql =   "SELECT * FROM produits WHERE id = :idproduit";
            $stmt = $manager->getConnection()->prepare($rawSql);
            $stmt->bindValue('idproduit', $idproduit);
            $stmt->execute();
            $produits = $stmt->fetchAll();


            
        }
        
         return $this->render('default/panier.html.twig', [
             'controller_name' => 'DefaultController','panier'=>$session->get('panier'),'produit'=>$produits
         ]);
     }




       /**
     * @Route("/ajouter/{id}", name="ajouter")
     */
     public function ajouter(Request $request,Session $session ,$id)
     {     

        
    $session=$request->getSession();
    $session->get('panier');
    
    $qte=$request->query->get('qte') ;

    $session->set('panier', $id , $qte);





       return $this->redirect($this->generateUrl('panier'));
     }


       /**
     * @Route("/livraison", name="livraison")
     */
     public function livraison(Request $request , ObjectManager $manager ,SessionInterface $session, UserInterface $user = null)
     {
    
        $user_adresse= new UtilisateursAdresses();
        $form=$this->createForm(AdresseType::class, $user_adresse);
        $form->handleRequest($request);
        if($form->isSubmitted()){
      
            $user_adresse->setUser($user);
        $manager->persist($user_adresse);
        $manager->flush();
        }

        dump($user);
    



         return $this->render('default/livraison.html.twig', [
             'controller_name' => 'DefaultController','form'=>$form->createView(),'adresse'=>$user->getAdresses(),
         ]);
     }


     
       /**
     * @Route("/validation", name="validation")
     */
     public function validation(Request $request,Session $session  ,ObjectManager $manager)
     {
        $session=$request->getSession();
        // récupere le panier
        $session->get( 'panier');
        
        $idproduit=$session->get('panier');

        if($session->get('panier')!=NULL)
        {
            $rawSql =   "SELECT * FROM produits WHERE id = :idproduit";
            $stmt = $manager->getConnection()->prepare($rawSql);
            $stmt->bindValue('idproduit', $idproduit);
            $stmt->execute();
            $produits = $stmt->fetchAll();


            
        }



         return $this->render('default/validation.html.twig', [
             'controller_name' => 'DefaultController','panier'=>$session->get('panier'),'produit'=>$produits
         ]);
     }
        /**
     * @Route("/page/", name="page")
          // *ça marche
     */
     public function menuAction2()
    { $repo = $this->getDoctrine()->getRepository(Pages::class);
        $pages = $repo->findAll();
        
        return $this->render('page/index.html.twig', array('pages' => $pages));
    }


        /**
     * @Route("search/{nom}", name="search")
     */
     public function search( $nom = NULL ,  ObjectManager $manager , Request $request)
     { 

        $repo = $this->getDoctrine()->getRepository(Produits::class);
        $produits = $repo->findAll();



        if($nom!=NULL){
 
            $rawSql =   "SELECT * FROM produits WHERE nom = :nom";
            $stmt = $manager->getConnection()->prepare($rawSql);
            $stmt->bindValue('nom', $nom);
            $stmt->execute();
            $produits = $stmt->fetchAll();
        }


        return $this->render('default/search.html.twig', ['controller_name' => 'DefaultController', 'nom'=>$nom,  ]);
         
      
     }





            /**
     * @Route("/commande", name="commande")
     */
     public function commande(Request $request,Session $session  ,ObjectManager $manager, UserInterface $user)
     {
        $session=$request->getSession();
        // récupere le panier
        $session->get( 'panier');
  
        $idproduit=$session->get('panier');


        $commande = new Commandes();
        if($session->get('panier')!=NULL)
        {
            $rawSql =   "SELECT * FROM produits WHERE id = :idproduit";
            $stmt = $manager->getConnection()->prepare($rawSql);
            $stmt->bindValue('idproduit', $idproduit);
            $stmt->execute();
            $pannier = $stmt->fetchAll();


            
        }
        $commande->setValider('1');
        $commande->setDate(\DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s')));
        
        $commande->addProduit($pannier);
        $manager->persist($commande);
        $manager->flush();

        dump($user);

    


        
        return $this->redirect($this->generateUrl('index'));


         
     }

      /**
     * @Route("/json/produits/", name="article_show")
     */
    public function showAction()
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        
        $serializer = new Serializer($normalizers, $encoders);
    
        $articles = $this->getDoctrine()->getRepository(Produits::class)->findAll();


        $jsonContent = $serializer->serialize($articles, 'json');
  
  

       return $this->render('default/json.html.twig', ['controller_name' => 'DefaultController', 'nom'=>$jsonContent  ]);
            }

}
