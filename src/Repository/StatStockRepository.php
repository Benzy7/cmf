<?php

namespace App\Repository;

use App\Entity\StatStock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StatStock|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatStock|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatStock[]    findAll()
 * @method StatStock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatStockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatStock::class);
    }

    // /**
    //  * @return StatStock[] Returns an array of StatStock objects
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
    public function findOneBySomeField($value): ?StatStock
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
