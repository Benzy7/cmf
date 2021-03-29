<?php

namespace App\Repository;

use App\Entity\StatIntermidiaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StatIntermidiaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatIntermidiaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatIntermidiaire[]    findAll()
 * @method StatIntermidiaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatIntermidiaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatIntermidiaire::class);
    }

    // /**
    //  * @return StatIntermidiaire[] Returns an array of StatIntermidiaire objects
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
    public function findOneBySomeField($value): ?StatIntermidiaire
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
