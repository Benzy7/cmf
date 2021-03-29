<?php

namespace App\Repository;

use App\Entity\CategorieAvoir;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategorieAvoir|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieAvoir|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieAvoir[]    findAll()
 * @method CategorieAvoir[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieAvoirRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieAvoir::class);
    }

    // /**
    //  * @return CategorieAvoir[] Returns an array of CategorieAvoir objects
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
    public function findOneBySomeField($value): ?CategorieAvoir
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
