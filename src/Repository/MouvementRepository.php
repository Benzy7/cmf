<?php

namespace App\Repository;

use Doctrine\ORM\Query\Expr\Join;

use App\Entity\Mouvement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mouvement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mouvement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mouvement[]    findAll()
 * @method Mouvement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MouvementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mouvement::class);
    }

    public function findByCrt($datebdeb,$datebfin,$dateadeb,$dateafin,$sisin,$tisin,$scodeop,$tcodeop,$livreurs,$livres)
    {
         $qb = $this->createQueryBuilder('m')
            ->andWhere('m.StockExchangeDate >= :datebdeb')
            ->setParameter('datebdeb', $datebdeb)
            ->andWhere('m.StockExchangeDate <= :datebfin')
            ->setParameter('datebfin', $datebfin)
            ->andWhere('m.AccounttingDate >= :dateadeb')
            ->setParameter('dateadeb', $dateadeb)
            ->andWhere('m.AccounttingDate <= :dateafin')
            ->setParameter('dateafin', $dateafin);

            if($sisin || $tisin) {
         $qb->andWhere('m.Isin LIKE :sisin OR m.Isin LIKE :tisin')
            ->setParameter('sisin', $sisin)
            ->setParameter('tisin', $tisin);
            }

            if($scodeop || $tcodeop) {
         $qb->innerJoin('App\Entity\Operation','o',Join::WITH,'o.id = m.CodeOperation');
         $qb->andWhere('o.id LIKE :scodeop OR o.CodeOperation LIKE :tcodeop')
            ->setParameter('scodeop', $scodeop)
            ->setParameter('tcodeop', $tcodeop);
            }

            if($livreurs) {
                $qb->innerJoin('App\Entity\Adherent','a',Join::WITH,'a.id = m.CodeAdherentLivreur');
                foreach($livreurs as &$lv){
                $qb->andWhere('a.id = :lv')
                   ->setParameter('lv', $lv);
                }
                //$qb->setParameter('livreurs', $livreurs);

            }

            if($livres) {
                $i=1;

                foreach($livres as $lvs){

                $ae = "ae" . $i;
                
                $qb->innerJoin('App\Entity\Adherent', $ae, Join::WITH, 'ae' . $i . '.id = m.CodeAdherentLivre');
                $qb->andWhere('ae' . $i . '.id = :lvs ');
                $qb->setParameter('lvs', $lvs);

                $i++;
                }
                //$qb->setParameter('livres', $livres);
            }     

        return $qb->orderBy('m.id', 'ASC')->getQuery()->getResult(); 
    }

/*     public function RechMouvement($criteria)
    {
        return $this->createQueryBuilder('m')
            ->leftJoin('m.Datebdeb','StockExchangeDate')
            ->leftJoin('m.Datebfin','StockExchangeDate')
            ->Where('StockExchangeDate BETWEEN :Datebdeb AND :Datebfin')
            ->setParameter('Datebdeb', $criteria->format('Y-m-d'))
            ->setParameter('Datebfin', $criteria->format('Y-m-d'))
            ->leftJoin('m.Dateadeb','AccounttingDate')
            ->leftJoin('m.Dateafin','AccounttingDate')
            ->andWhere('AccounttingDate BETWEEN :Dateadeb AND :Dateafin')
            ->setParameter('Dateadeb', $criteria->format('Y-m-d'))
            ->setParameter('Dateafin', $criteria->format('Y-m-d'))
            ->leftJoin('m.Sisin','Isin')
            ->andWhere('m.Isin =:Sisin')
            ->setParameter('Sisin',$criteria['Isin']->getIsin())
            ->getQuery()
            ->getResult()
        ;
    } */

    // /**
    //  * @return Mouvement[] Returns an array of Mouvement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mouvement
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
