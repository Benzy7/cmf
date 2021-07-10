<?php

namespace App\Controller;

use App\Entity\StatMvt;
use App\Entity\StatStock;
use App\Entity\StatIntermidiaire;
use App\Entity\AdhrentIntermidiaire;
use App\Entity\StatOrd;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ChargementController extends AbstractController
{
    /**
     * @Route("chrg/mvt", name="chrg_mvt")
     */
    public function ChrgMvt(request $request){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createFormBuilder()
        ->add('Chrg', SubmitType::class, array(
            'label' => 'Soumettre',
            'attr'=> array('class' => 'btn btn-primary btn-lg')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            exec('C:\files\batch\mvtImport.bat');
        }
        
        return $this->render('chargement/sticodevam/chrgmvt.html.twig', array( 'form' => $form->createView()) );
    }

    /**
     * @Route("chrg/stk", name="chrg_stk")
     */
    public function ChrgStk(request $request){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createFormBuilder()
        ->add('Chrg', SubmitType::class, array(
            'label' => 'Soumettre',
            'attr'=> array('class' => 'btn btn-primary btn-lg')
        ))
        ->getForm();
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            exec('C:\files\batch\StkImport.bat');
        }
        
        return $this->render('chargement/sticodevam/chrgstk.html.twig', array( 'form' => $form->createView()) );
    }

    /**
     * @Route("chrg/intrm", name="chrg_intrm")
     */
    public function ChrgIntrm(request $request){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createFormBuilder()
        ->add('Chrg', SubmitType::class, array(
            'label' => 'Soumettre',
            'attr'=> array('class' => 'btn btn-primary btn-lg')
        ))
        ->getForm();
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            exec('C:\files\batch\IntrmImport.bat');
        }
        
        return $this->render('chargement/intermidiaires/chrgintrm.html.twig', array( 'form' => $form->createView()) );
    }

    /**
     * @Route("chrg/ord", name="chrg_ord")
     */
    public function ChrgOrders(request $request){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createFormBuilder()
        ->add('Chrg', SubmitType::class, array(
            'label' => 'Soumettre',
            'attr'=> array('class' => 'btn btn-primary btn-lg')
        ))
        ->getForm();
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            exec('C:\files\batch\OrdImport.bat');
        }
        
        return $this->render('chargement/orders/chrgord.html.twig', array( 'form' => $form->createView()) );
    }

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

    
    /**
     * @Route("/cnslt/intrm", name="conslt_intrm")
     */
    public function Rintrm()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $statIntrm = $this->getDoctrine()->getRepository(StatIntermidiaire::class)->findAll();
        $intermidiares = $this->getDoctrine()->getRepository(AdhrentIntermidiaire::class)->findAll();

        return $this->render('chargement/intermidiaires/rintrm.html.twig', array(
            'statIntrm' => $statIntrm,
            'intermidiares' => $intermidiares
        ));
    }

    /**
     * @Route("/cnslt/intrm/delete/{id}")
     * Method({"DELETE"})
     */
    public function deleteRintrm(Request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $statIntrm = $this->getDoctrine()->getRepository(StatIntermidiaire::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($statIntrm);
        $entityManager->flush();
        
        $response = new Response();
        $response->send();
    }

    /**
     * @Route("/cnslt/ord", name="conslt_ord")
     */
    public function Rorders()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $statOrd = $this->getDoctrine()->getRepository(StatOrd::class)->findAll();

        return $this->render('chargement/orders/rord.html.twig', array('statOrd' => $statOrd));
    }

    /**
     * @Route("/cnslt/ord/delete/{id}")
     * Method({"DELETE"})
     */
    public function deleteRorders(Request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $statOrd = $this->getDoctrine()->getRepository(StatOrd::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($statOrd);
        $entityManager->flush();
        
        $response = new Response();
        $response->send();
    }

}
