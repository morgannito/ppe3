<?php
// src/Entity/User.php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="Utilisateurs")
*/
class User extends BaseUser
{
/**
* @ORM\Id
* @ORM\Column(type="integer")
* @ORM\GeneratedValue(strategy="AUTO")
*/
protected $id;
public function __construct()
{
parent::__construct();
$this->commandes = new \Doctrine\Common\Collections\ArrayCollection();
$this->adresses = new \Doctrine\Common\Collections\ArrayCollection();
$this->commandesOrder = new ArrayCollection();
// your own logic
}
 /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commandes", mappedBy="utilisateur", cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     */
     private $commandes;

     /**
      * @ORM\OneToMany(targetEntity="App\Entity\Commandes", mappedBy="user")
      */
     private $commandesOrder;

     /**
      * @ORM\OneToMany(targetEntity="App\Entity\UtilisateursAdresses", mappedBy="user")
      */
     private $adresses;
 
     /**
      * Get id
      *
      * @return integer 
      */
     public function getId()
     {
         return $this->id;
     }
 
     /**
      * Add commandes
      *
      * @param \App\Entity\Commandes $commandes
      * @return Utilisateurs
      */
     public function addCommande(\App\Entity\Commandes $commandes)
     {
         $this->commandes[] = $commandes;
 
         return $this;
     }
 
     /**
      * Remove commandes
      *
      * @param \App\Entity\Commandes $commandes
      */
     public function removeCommande(\App\Entity\Commandes $commandes)
     {
         $this->commandes->removeElement($commandes);
     }
 
     /**
      * Get commandes
      *
      * @return \Doctrine\Common\Collections\Collection 
      */
     public function getCommandes()
     {
         return $this->commandes;
     }

     /**
      * @return Collection|Commandes[]
      */
     public function getCommandesOrder(): Collection
     {
         return $this->commandesOrder;
     }

     public function addCommandesOrder(Commandes $commandesOrder): self
     {
         if (!$this->commandesOrder->contains($commandesOrder)) {
             $this->commandesOrder[] = $commandesOrder;
             $commandesOrder->setUser($this);
         }

         return $this;
     }

     public function removeCommandesOrder(Commandes $commandesOrder): self
     {
         if ($this->commandesOrder->contains($commandesOrder)) {
             $this->commandesOrder->removeElement($commandesOrder);
             // set the owning side to null (unless already changed)
             if ($commandesOrder->getUser() === $this) {
                 $commandesOrder->setUser(null);
             }
         }

         return $this;
     }

     /**
      * @return Collection|UtilisateursAdresses[]
      */
     public function getAdresses(): Collection
     {
         return $this->adresses;
     }

     public function addAdress(UtilisateursAdresses $adress): self
     {
         if (!$this->adresses->contains($adress)) {
             $this->adresses[] = $adress;
             $adress->setUser($this);
         }

         return $this;
     }

     public function removeAdress(UtilisateursAdresses $adress): self
     {
         if ($this->adresses->contains($adress)) {
             $this->adresses->removeElement($adress);
             // set the owning side to null (unless already changed)
             if ($adress->getUser() === $this) {
                 $adress->setUser(null);
             }
         }

         return $this;
     }
}