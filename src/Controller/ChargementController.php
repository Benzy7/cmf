<?php

namespace App\Controller;

use App\Entity\StatMvt;
use App\Entity\StatStock;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ChargementController extends AbstractController
{
    /**
     * @Route("/cnslt/mvt", name="conslt_mvt")
     */
    public function Rmouvement()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $statMvt = $this->getDoctrine()->getRepository(StatMvt::class)->findAll();

        return $this->render('chargement/sticodevam/rmvt.html.twig', array('statMvt' => $statMvt));
    }

    /**
     * @Route("/cnslt/mvt/delete/{id}")
     * Method({"DELETE"})
     */
    public function deleteRmouvement(Request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $statMv = $this->getDoctrine()->getRepository(StatMvt::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($statMv);
        $entityManager->flush();
        
        $response = new Response();
        $response->send();
    }

    /**
     * @Route("/cnslt/stk", name="conslt_stk")
     */
    public function Rstock()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $statStk = $this->getDoctrine()->getRepository(StatStock::class)->findAll();

        return $this->render('chargement/sticodevam/rstk.html.twig', array('statStk' => $statStk));
    }

    /**
     * @Route("/cnslt/stk/delete/{id}")
     * Method({"DELETE"})
     */
    public function deleteRstock(Request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $statStk = $this->getDoctrine()->getRepository(StatStock::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($statStk);
        $entityManager->flush();
        
        $response = new Response();
        $response->send();
    }

}
