<?php

namespace App\Repository;

use App\Entity\Intermidiaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Intermidiaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Intermidiaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Intermidiaire[]    findAll()
 * @method Intermidiaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IntermidiaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Intermidiaire::class);
    }

    // /**
    //  * @return Intermidiaire[] Returns an array of Intermidiaire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Intermidiaire
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
