<?php

namespace App\Repository;

use App\Entity\ReglementIntrm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReglementIntrm|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReglementIntrm|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReglementIntrm[]    findAll()
 * @method ReglementIntrm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReglementIntrmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReglementIntrm::class);
    }

    // /**
    //  * @return ReglementIntrm[] Returns an array of ReglementIntrm objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReglementIntrm
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
