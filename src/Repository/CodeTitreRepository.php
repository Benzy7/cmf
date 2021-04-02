<?php

namespace App\Repository;

use App\Entity\CodeTitre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CodeTitre|null find($id, $lockMode = null, $lockVersion = null)
 * @method CodeTitre|null findOneBy(array $criteria, array $orderBy = null)
 * @method CodeTitre[]    findAll()
 * @method CodeTitre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CodeTitreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CodeTitre::class);
    }

    // /**
    //  * @return CodeTitre[] Returns an array of CodeTitre objects
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
    public function findOneBySomeField($value): ?CodeTitre
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
