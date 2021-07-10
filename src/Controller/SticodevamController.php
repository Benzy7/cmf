<?php

namespace App\Controller;

use App\Entity\Adherent;
use App\Entity\CategorieAvoir;
use App\Entity\Mouvement;
use App\Entity\MouvementSearch;
use App\Entity\Operation;
use App\Form\RechMouvementType;

use App\Entity\Stock;
use App\Entity\StockSearch;
use App\Entity\Valeur;
use App\Form\RechStockPeriodeType;
use App\Form\RechStockJourType;

use Symfony\Component\Finder\Finder; 

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;

class SticodevamController extends AbstractController
{
    /**
     * @Route("/sticodevam/rech/mouvement", name="rech_mouvement")
     * Method {{ "GET" }}
     */
    public function rechMouvement(Request $request){

        $mv = new MouvementSearch();

        $rechmv = $this->createForm(RechMouvementType::class,$mv);
        $rechmv->handleRequest($request);

        $mouvements = [];

        if($rechmv->isSubmitted() && $rechmv->isValid()){

            $datebdeb = $mv->getDatebdeb();
            $datebfin = $mv->getDatebfin();
            $dateadeb = $mv->getDateadeb();
            $dateafin = $mv->getDateafin();

            $sisin = $mv->getSisin();
            $tisin = $mv->getTisin();

            $scodeop = $mv->getScodeop();
            $tcodeop = $mv->getTcodeop();

            $livreurs = [];
            $livres = [];

            $livreurs = $mv->getLivreurs();
            $livres = $mv->getLivres();

            $mouvements = $this->getDoctrine()->getRepository(Mouvement::class)
            ->findByCrt($datebdeb,$datebfin,$dateadeb,$dateafin,$sisin,$tisin,$scodeop,$tcodeop,$livreurs,$livres);
      
        }

        $operations = $this->getDoctrine()->getRepository(Operation::class)->findAll();
        $NbOp = 0;
        foreach($operations as $op){
            $NbOp++;
        }

        //Mouvements par operation
        $MvtFlt = array();
        
        $i = 0; 
        foreach ($operations as $op){
            $CodeOp = $op->getCodeOperation();
            $opExst = false;
            ${'o' . $i} = array();
            ${'o' . $i}[0] = $op->getLibelleOperation();
            ${'o' . $i}[1] = 0;
            ${'o' . $i}[2] = 0;

            foreach ($mouvements as $mvt){
                $OpMvt = $mvt->getCodeOperation();
                $codeOpMvt = $OpMvt->getCodeOperation();

                $Nbt = $mvt->getTitlesNumber();
                $qtt = $mvt->getAmount();
                if($codeOpMvt === $CodeOp){
                    $opExst = true;
                    ${'o' . $i}[1] += $Nbt;
                    ${'o' . $i}[2] += $qtt;
                }

            }

            if($opExst === true){
                $MvtFlt[] = ${'o' . $i};
            }
            $i++;
        }
        //dd($MvtFlt);


        return $this->render('sticodevam/rechmv.html.twig',[
                             'rech_form' => $rechmv->createView(),
                             'MvtFlt' => $MvtFlt
                ]);
    }

    /**
     * @Route("sticodevam/rech/stock/jr", name="rech_stock_jr")
     * Method {{ "GET" }}
     */
    public function rechStockJour(Request $request){

        $st = new StockSearch();

        $rechst = $this->createForm(RechStockJourType::class,$st);
        $rechst->handleRequest($request);

        $stocks = [];

        if($rechst->isSubmitted() && $rechst->isValid()){

            $datebdeb = $st->getDatebdeb();
            $dateadeb = $st->getDateadeb();

            $sisin = $st->getSisin();
            $tisin = $st->getTisin();

            $scodead = $st->getScodead();
            $tcodead = $st->getTcodead();

            $scoden = $st->getScoden();
            $tcoden = $st->getTcoden();

            $TypeAdherents = [];
            $TypeValeurs = [];

            $TypeAdherents = $st->getTypeAdherents();
            $TypeValeurs = $st->getTypeValeurs();

            $stocks = $this->getDoctrine()->getRepository(Stock::class)
            ->findByJour($dateadeb,$datebdeb,$sisin,$tisin,$scodead,$tcodead,$scoden,$tcoden,$TypeAdherents,$TypeValeurs);

        }

        $catav = $this->getDoctrine()->getRepository(CategorieAvoir::class)->findAll();
        $nCtg = 0;
        foreach($catav as $cat){
            $nCtg++;
        }
        $adrs = $this->getDoctrine()->getRepository(Adherent::class)->findAll();
        $vals = $this->getDoctrine()->getRepository(Valeur::class)->findAll();

        $StocksFltV = array();
        $StocksFltA = array();


        //stocks par Valeurs

        $totKey = $nCtg + 1 ;
        $i = 0; 
        foreach ($vals as $val){
            $valExst = false;
            ${'v' . $i} = array();
            ${'v' . $i}[0] = $val->getCodeValeur();
            for ($j=1; $j <= $nCtg ; $j++) {
                ${'v' . $i}[$j] = 0;
            } 
            $codeVal = $val->getCodeValeur();

            foreach ($stocks as $stk){
                $ValStk = $stk->getCodeValeur();
                $codeValStk = $ValStk->getCodeValeur();
                $codeCtgStk = $stk->getCategorieAvoir();
                $qte = $stk->getQuantity();

                if($codeValStk == $codeVal){
                    $valExst = true;
                    $j = 1;
                    foreach($catav as $cat){
                        if($codeCtgStk == $cat){
                            ${'v' . $i}[$j] += $qte;
                        }
                        $j++;
                    }
                    
                }

            }
            $tot = ${'v' . $i};
            array_splice($tot, 0, 1);
            ${'v' . $i}[$totKey] = array_sum($tot);

            if($valExst === true){
                $StocksFltV[] = ${'v' . $i};
            }
            $i++;
        }
        $totalVAL = array();
        for ($i=0; $i < $totKey ; $i++){ 
                $totalVAL[] = 0;
        }
        $l = count($StocksFltV);
        for ($j=1,$i=0; $j <= $totKey; $j++,$i++) { 
            for ($k=0; $k < $l; $k++){ 
                $totalVAL[$i] += $StocksFltV[$k][$j];
            }
        }


        //Stocks par adhrent

        $totKey = $nCtg + 1 ;
        $i = 0; 
        foreach ($adrs as $adr){
            $adrExst = false;
            ${'a' . $i} = array();
            ${'a' . $i}[0] = $adr->getNomAdherent();
            for ($j=1; $j <= $nCtg ; $j++) {
                ${'a' . $i}[$j] = 0;
            } 
            $codeaAdr = $adr->getNomAdherent();

            foreach ($stocks as $stk){
                $AdrStk = $stk->getCodeAdherent();
                $codeAdrStk = $AdrStk->getNomAdherent();
                $codeCtgStk = $stk->getCategorieAvoir();
                $qte = $stk->getQuantity();

                if($codeAdrStk == $codeaAdr){
                    $adrExst = true;
                    $j = 1;
                    foreach($catav as $cat){
                        if($codeCtgStk == $cat){
                            ${'a' . $i}[$j] += $qte;
                        }
                        $j++;
                    }
                    
                }

            }
            $totA = ${'a' . $i};
            array_splice($totA, 0, 1);
            ${'a' . $i}[$totKey] = array_sum($totA);

            if($adrExst === true){
                $StocksFltA[] = ${'a' . $i};
            }
            $i++;
        }
        $totalADR = array();
        for ($i=0; $i < $totKey ; $i++){ 
                $totalADR[] = 0;
        }
        $l = count($StocksFltA);
        for ($j=1,$i=0; $j <= $totKey; $j++,$i++) { 
            for ($k=0; $k < $l; $k++){ 
                $totalADR[$i] += $StocksFltA[$k][$j];
            }
        }

        return $this->render('sticodevam/rechstkjr.html.twig',[
                             'rech_form_jr' => $rechst->createView(),
                             'stocksV' => $StocksFltV, 'stocksA' => $StocksFltA,
                             'catAv' => $catav,
                             'totalADR' => $totalADR, 'totalVAL' => $totalVAL
                ]);
    }

    /**
     * @Route("sticodevam/rech/stock/per", name="rech_stock_per")
     * Method {{ "GET" }}
     */
    public function rechStockPeriode(Request $request){

        $st = new StockSearch();

        $rechst = $this->createForm(RechStockPeriodeType::class,$st);
        $rechst->handleRequest($request);

        $perStocks = [];

        if($rechst->isSubmitted() && $rechst->isValid()){

            $datebdeb = $st->getDatebdeb();
            $datebfin = $st->getDatebfin();

            $dateadeb = $st->getDateadeb();
            $dateafin = $st->getDateafin();

            $sisin = $st->getSisin();
            $tisin = $st->getTisin();

            $scodead = $st->getScodead();
            $tcodead = $st->getTcodead();

            $perStocks = $this->getDoctrine()->getRepository(Stock::class)
            ->findByPeriode($dateadeb,$dateafin,$datebdeb,$datebfin,$sisin,$tisin,$scodead,$tcodead);

        }

        $catav = $this->getDoctrine()->getRepository(CategorieAvoir::class)->findAll();
        $nCtg = 0;
        foreach($catav as $cat){
            $nCtg++;
        }

        //Stocks par date bourse

        $FltPerStocks = array();
        
        $lastDayInt = 0;
        $testJourInt = 0;

        $dateB = new \DateTime;
        $jours = new \DateTime;
        $lastDay = new \DateTime;
        $testJour = new \DateTime;

        $IDKctg = new CategorieAvoir();
        $IDKqtt = 1;
        $totKey = $nCtg + 1 ;
        $i = 0; 

        //dk
        $IDKkey = 0;

        if ($perStocks) {
            $jours = $perStocks[0]->getStockExchangeDate();

            //dk dc
            $testIDK = true;
            $IDKqtt = $perStocks[0]->getQuantity();
            $IDKctg = $perStocks[0]->getCategorieAvoir();
            $IDKkeyctg = 1;
            foreach($catav as $cat){
                if($cat == $IDKctg){
                    $IDKkey = $IDKkeyctg;
                }
                $IDKkeyctg++;
            }
    
            $testJour = $jours->format('Ymd');
            $testJourInt = intval($testJour);                      

            $lastKey = array_key_last ($perStocks);
            $lastDay = $perStocks[$lastKey]->getStockExchangeDate()->format('Ymd');
            $lastDayInt = intval($lastDay);                      
        }

        while(!($testJourInt > $lastDayInt)){
            ${'d' . $i} = array();
            ${'d' . $i}[0] = $jours->format('d/m/Y');
            for ($j=1; $j <= $nCtg ; $j++) {
                ${'d' . $i}[$j] = 0;
            } 
            
            foreach($perStocks as $stk){
                $dateB = $stk->getStockExchangeDate()->format('Ymd');
                $dateBInt = intval($dateB);                      
                $Ctg = $stk->getCategorieAvoir();
                $Qtt = $stk->getQuantity();
                if(!($testJourInt <> $dateBInt)){
                    $c = 1;
                    foreach($catav as $cat){
                        if($Ctg == $cat){
                            ${'d' . $i}[$c] += $Qtt;
                        }
                        $c++;
                    }
            
                }
            }
            $totD = ${'d' . $i};
            array_splice($totD, 0, 1);
            ${'d' . $i}[$totKey] = array_sum($totD);

            $FltPerStocks[] = ${'d' . $i};
            
            if ($testJourInt <= $lastDayInt) {
                $jours->modify('+1 day');
                $testJour = $jours->format('Ymd');
                $testJourInt = intval($testJour);                      
                $i++;
            }else{
                break; 
            }
        }

        $totalDATE = array();
        for ($i=0; $i < $totKey ; $i++){ 
                $totalDATE[] = 0;
        }

        $l = count($FltPerStocks);
        for ($j=1,$i=0; $j <= $totKey; $j++,$i++) { 
            for ($k=0; $k < $l; $k++){ 
                $totalDATE[$i] += $FltPerStocks[$k][$j];
            }
        }
        $toDel = $IDKqtt * ($l - 1);
        //dd($l);

        return $this->render('sticodevam/rechstkper.html.twig',[
                             'rech_form_per' => $rechst->createView(), 'perStocks' => $perStocks,
                             'FltPerStocks' => $FltPerStocks, 'totalDATE' => $totalDATE,
                             'catAv' => $catav , 'IDKqtt' => $IDKqtt , 'IDKkey' => $IDKkey , 'toDel' => $toDel
                ]);
    }

}
