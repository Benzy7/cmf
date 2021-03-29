<?php

namespace App\Controller;

use App\Entity\CategorieAvoir;
use App\Entity\Mouvement;
use App\Entity\MouvementSearch;
use App\Form\RechMouvementType;

use App\Entity\Stock;
use App\Entity\StockSearch;
use App\Form\RechStockPeriodeType;
use App\Form\RechStockJourType;

use Symfony\Component\Finder\Finder;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

            /* $isin = $mv->getSisin();

            if ($isin){
            $mouvements = $this->getDoctrine()->getRepository(Mouvement::class)->findBy(['Isin'=>$isin]);
            }
            else {   
            $mouvements = $this->getDoctrine()->getRepository(Mouvement::class)->findAll();
            } */
      

            //$data = $rechmv->getData();
            //$mv = $MouvementRepository->rechMouvement($data->getIsin());  

            //$mv = $MouvementRepository->rechMouvement($criteria);

            //dd($data);

        }

        return $this->render('sticodevam/rechmv.html.twig',[
                             'rech_form' => $rechmv->createView(),
                             'mouvements' => $mouvements
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
            $valeurs = [];

            $TypeAdherents = $st->getTypeAdherents();
            $valeurs = $st->getValeurs();

            $stocks = $this->getDoctrine()->getRepository(Stock::class)
            ->findByJour($dateadeb,$datebdeb,$sisin,$tisin,$scodead,$tcodead,$scoden,$tcoden,$TypeAdherents,$valeurs);

        }

        $catav = $this->getDoctrine()->getRepository(CategorieAvoir::class)->findAll();

        return $this->render('sticodevam/rechstkjr.html.twig',[
                             'rech_form_jr' => $rechst->createView(),
                             'stocks' => $stocks, 'catAv' => $catav
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

        $stocks = [];

        if($rechst->isSubmitted() && $rechst->isValid()){

            $datebdeb = $st->getDatebdeb();
            $datebfin = $st->getDatebfin();

            $dateadeb = $st->getDateadeb();
            $dateafin = $st->getDateafin();

            $sisin = $st->getSisin();
            $tisin = $st->getTisin();

            $scodead = $st->getScodead();
            $tcodead = $st->getTcodead();

            $stocks = $this->getDoctrine()->getRepository(Stock::class)
            ->findByPeriode($dateadeb,$dateafin,$datebdeb,$datebfin,$sisin,$tisin,$scodead,$tcodead);

        }

        return $this->render('sticodevam/rechstkper.html.twig',[
                             'rech_form_per' => $rechst->createView(),
                             'stocks' => $stocks
                ]);
    }

}
