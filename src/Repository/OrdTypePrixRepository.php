<?php

namespace App\Repository;

use App\Entity\OrdTypePrix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OrdTypePrix|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrdTypePrix|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrdTypePrix[]    findAll()
 * @method OrdTypePrix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdTypePrixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrdTypePrix::class);
    }

    // /**
    //  * @return OrdTypePrix[] Returns an array of OrdTypePrix objects
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
    public function findOneBySomeField($value): ?OrdTypePrix
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
