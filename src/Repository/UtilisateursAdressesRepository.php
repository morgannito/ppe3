<?php

namespace App\Repository;

use App\Entity\UtilisateursAdresses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UtilisateursAdresses|null find($id, $lockMode = null, $lockVersion = null)
 * @method UtilisateursAdresses|null findOneBy(array $criteria, array $orderBy = null)
 * @method UtilisateursAdresses[]    findAll()
 * @method UtilisateursAdresses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilisateursAdressesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UtilisateursAdresses::class);
    }

    // /**
    //  * @return UtilisateursAdresses[] Returns an array of UtilisateursAdresses objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UtilisateursAdresses
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
