<?php

namespace App\Repository;

use App\Entity\CodeProfit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CodeProfit|null find($id, $lockMode = null, $lockVersion = null)
 * @method CodeProfit|null findOneBy(array $criteria, array $orderBy = null)
 * @method CodeProfit[]    findAll()
 * @method CodeProfit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CodeProfitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CodeProfit::class);
    }

    // /**
    //  * @return CodeProfit[] Returns an array of CodeProfit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CodeProfit
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
