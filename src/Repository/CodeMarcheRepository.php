<?php

namespace App\Repository;

use App\Entity\CodeMarche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CodeMarche|null find($id, $lockMode = null, $lockVersion = null)
 * @method CodeMarche|null findOneBy(array $criteria, array $orderBy = null)
 * @method CodeMarche[]    findAll()
 * @method CodeMarche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CodeMarcheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CodeMarche::class);
    }

    // /**
    //  * @return CodeMarche[] Returns an array of CodeMarche objects
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
    public function findOneBySomeField($value): ?CodeMarche
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
