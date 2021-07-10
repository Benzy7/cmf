<?php

namespace App\Repository;

use App\Entity\TypeValeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeValeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeValeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeValeur[]    findAll()
 * @method TypeValeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeValeurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeValeur::class);
    }

    // /**
    //  * @return TypeValeur[] Returns an array of TypeValeur objects
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
    public function findOneBySomeField($value): ?TypeValeur
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
