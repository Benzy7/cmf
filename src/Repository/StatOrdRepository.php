<?php

namespace App\Repository;

use App\Entity\StatOrd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StatOrd|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatOrd|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatOrd[]    findAll()
 * @method StatOrd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatOrdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatOrd::class);
    }

    // /**
    //  * @return StatOrd[] Returns an array of StatOrd objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StatOrd
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
