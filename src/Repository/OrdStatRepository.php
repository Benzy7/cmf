<?php

namespace App\Repository;

use App\Entity\OrdStat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OrdStat|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrdStat|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrdStat[]    findAll()
 * @method OrdStat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdStatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrdStat::class);
    }

    // /**
    //  * @return OrdStat[] Returns an array of OrdStat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrdStat
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
