<?php

namespace App\Repository;

use App\Entity\OrdTypeVld;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OrdTypeVld|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrdTypeVld|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrdTypeVld[]    findAll()
 * @method OrdTypeVld[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdTypeVldRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrdTypeVld::class);
    }

    // /**
    //  * @return OrdTypeVld[] Returns an array of OrdTypeVld objects
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
    public function findOneBySomeField($value): ?OrdTypeVld
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
