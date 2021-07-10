<?php

namespace App\Repository;

use App\Entity\AdhrentIntermidiaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AdhrentIntermidiaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdhrentIntermidiaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdhrentIntermidiaire[]    findAll()
 * @method AdhrentIntermidiaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdhrentIntermidiaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdhrentIntermidiaire::class);
    }

    // /**
    //  * @return AdhrentIntermidiaire[] Returns an array of AdhrentIntermidiaire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AdhrentIntermidiaire
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
