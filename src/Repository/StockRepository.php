<?php

namespace App\Repository;

use Doctrine\ORM\Query\Expr\Join;

use App\Entity\Stock;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stock|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stock|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stock[]    findAll()
 * @method Stock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stock::class);
    }

    public function findByPeriode($dateadeb,$dateafin,$datebdeb,$datebfin,$sisin,$tisin,$scodead,$tcodead)
    {
         $qb = $this->createQueryBuilder('m')
            ->andWhere('m.StockExchangeDate >= :datebdeb')
            ->setParameter('datebdeb', $datebdeb)
            ->andWhere('m.StockExchangeDate <= :datebfin')
            ->setParameter('datebfin', $datebfin)
            ->andWhere('m.AccountingDate >= :dateadeb')
            ->setParameter('dateadeb', $dateadeb)
            ->andWhere('m.AccountingDate <= :dateafin')
            ->setParameter('dateafin', $dateafin);

            if($sisin || $tisin) {
            $qb->innerJoin('App\Entity\Valeur','v',Join::WITH,'v.id = m.CodeValeur');
            $qb->andWhere('v.id LIKE :sisin OR v.CodeValeur LIKE :tisin')
                ->setParameter('sisin', $sisin)
                ->setParameter('tisin', $tisin);
            }

            if($scodead || $tcodead) {
            $qb->innerJoin('App\Entity\Adherent','a',Join::WITH,'a.id = m.CodeAdherent');
            $qb->andWhere('a.id LIKE :scodead OR a.CodeAdherent LIKE :tcodead')
                ->setParameter('scodead', $scodead)
                ->setParameter('tcodead', $tcodead);
            }

        return $qb->orderBy('m.StockExchangeDate', 'ASC')->getQuery()->getResult(); 
    }

    public function findByJour($dateadeb,$datebdeb,$sisin,$tisin,$scodead,$tcodead,$scoden,$tcoden,$TypeAdherents,$TypeValeurs)
    {
         $qb = $this->createQueryBuilder('m')
            ->andWhere('m.AccountingDate = :dateadeb')
            ->setParameter('dateadeb', $dateadeb)
            ->andWhere('m.StockExchangeDate = :datebdeb')
            ->setParameter('datebdeb', $datebdeb);

            if($sisin || $tisin) {
         $qb->innerJoin('App\Entity\Valeur','v',Join::WITH,'v.id = m.CodeValeur');
         $qb->andWhere('v.id LIKE :sisin OR v.CodeValeur LIKE :tisin')
            ->setParameter('sisin', $sisin)
            ->setParameter('tisin', $tisin);
            }

            if($scodead || $tcodead) {
         $qb->innerJoin('App\Entity\Adherent','a',Join::WITH,'a.id = m.CodeAdherent');
         $qb->andWhere('a.id LIKE :scodead OR a.CodeAdherent LIKE :tcodead')
            ->setParameter('scodead', $scodead)
            ->setParameter('tcodead', $tcodead);
            }

            if($scoden || $tcoden) {
         $qb->innerJoin('App\Entity\CodeNature','n',Join::WITH,'n.id = m.NatureCompte');
         $qb->andWhere('n.id LIKE :scoden OR n.CodeNatureCompte LIKE :tcoden')
            ->setParameter('scoden', $scoden)
            ->setParameter('tcoden', $tcoden);
            }

            if($TypeAdherents) {
                //$qb->innerJoin('App\Entity\Adherent','as',Join::WITH,'as.id = m.CodeAdherent');
                //$qb->innerJoin('App\Entity\TypeAdherent','ta',Join::WITH,'ta.id = as.CodeTypeAdherent');
                $qb->innerJoin('App\Entity\Adherent','ta',Join::WITH,'ta.TypeAdherent = m.CodeAdherent');
                foreach($TypeAdherents as $ta){
                //$qb->andWhere('ta.id = m.CodeAdherent');
                $qb->andWhere('ta.TypeAdherent = :lv')
                   ->setParameter('lv', $ta);
                }
                //$qb->setParameter('Adherents', $Adherents);

            }

            if($TypeValeurs) {
                $qb->innerJoin('App\Entity\Valeur','tv',Join::WITH,'tv.TypeValeur = m.CodeValeur');
                foreach($TypeValeurs as $tv){
                $qb->andWhere('tv.TypeValeur = :typev')
                    ->setParameter('typev', $tv);
                }                
            }     

        return $qb->orderBy('m.CategorieAvoir', 'ASC')->getQuery()->getResult(); 
    }

    // /**
    //  * @return Stock[] Returns an array of Stock objects
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
    public function findOneBySomeField($value): ?Stock
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
