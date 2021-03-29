<?php

namespace App\Repository;

use App\Entity\StatMvt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StatMvt|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatMvt|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatMvt[]    findAll()
 * @method StatMvt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatMvtRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatMvt::class);
    }

    // /**
    //  * @return StatMvt[] Returns an array of StatMvt objects
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
    public function findOneBySomeField($value): ?StatMvt
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
