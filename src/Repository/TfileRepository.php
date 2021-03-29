<?php

namespace App\Repository;

use App\Entity\Tfile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tfile|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tfile|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tfile[]    findAll()
 * @method Tfile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TfileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tfile::class);
    }

    // /**
    //  * @return Tfile[] Returns an array of Tfile objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tfile
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
