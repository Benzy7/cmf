<?php

namespace App\Controller;

use App\Entity\OrdStat;
use App\Entity\OrdTypePrix;
use App\Entity\OrdTypeVld;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OrdersController extends AbstractController
{
    /**
     * @Route("ord/typeprix", name="liste_type_prix")
     * Method({"GET"})
     */
    public function typePrix()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $typesPrix = $this->getDoctrine()->getRepository(OrdTypePrix::class)->findAll();

        return $this->render('referentiel/orders/typePrix/typeprix.html.twig' , array('typesPrix' => $typesPrix) );
    }

    /**
     * @Route("ord/typeprix/new" , name="new_typeprix")
     * Method( {"GET", "POST"})
     */
    public function newTypePrix(request $request){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $typePrix = new  OrdTypePrix();

        $form = $this->createFormBuilder($typePrix)
        ->add('CodeTypePrix', TextType::class, array(
            'attr'=> array('class' => 'form-control'),
            'label' => 'Code Type Prix'
        ))
        ->add('LibTypePrix', TextType::class, array(
            'attr'=> array('class' => 'form-control'),
            'label' => 'Libellé Type Prix',
            ))
        ->add('save', SubmitType::class, array(
            'label' => 'Valider',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $typePrix = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typePrix);
            $entityManager->flush();

            return $this->redirectToRoute('liste_type_prix');
        }

        return $this->render('referentiel/orders/typePrix/newtypeprix.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("ord/typeprix/edit/{id}" , name="typeprix_edit")
     * Method( {"GET", "POST"})
     */
    public function editTypePrix(request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $typePrix = new OrdTypePrix();
        $typePrix = $this->getDoctrine()->getRepository(OrdTypePrix::class)->find($id);

        $form = $this->createFormBuilder($typePrix)
        ->add('CodeTypePrix', TextType::class, array(
            'attr'=> array('class' => 'form-control'),
            'label' => 'Code Type Prix'
        ))
        ->add('LibTypePrix', TextType::class, array(
            'attr'=> array('class' => 'form-control'),
            'label' => 'Libellé Type Prix',
            ))
        ->add('save', SubmitType::class, array(
            'label' => 'Mise a jour',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            
            $typePrix->setDateMaj(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('liste_type_prix');
        }

        return $this->render('referentiel/orders/typePrix/edittypeprix.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("ord/typeprix/delete/{id}")
     * Method({"DELETE"})
     */
    public function deleteTypePrix(Request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $typePrix = $this->getDoctrine()->getRepository(OrdTypePrix::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($typePrix);
        $entityManager->flush();
        
        $response = new Response();
        $response->send();
    }

    /**
     * @Route("ord/stat", name="liste_status")
     * Method({"GET"})
     */
    public function Stat()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $stats = $this->getDoctrine()->getRepository(OrdStat::class)->findAll();

        return $this->render('referentiel/orders/Stat/stat.html.twig' , array('stats' => $stats) );
    }

    /**
     * @Route("ord/stat/new" , name="new_status")
     * Method( {"GET", "POST"})
     */
    public function newStat(request $request){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $stat = new OrdStat();

        $form = $this->createFormBuilder($stat)
        ->add('CodeStatOrd', TextType::class, array(
            'attr'=> array('class' => 'form-control'),
            'label' => 'Code Statut'
        ))
        ->add('LibStatOrdd', TextType::class, array(
            'attr'=> array('class' => 'form-control'),
            'label' => 'Libellé Statut',
            ))
        ->add('save', SubmitType::class, array(
            'label' => 'Valider',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $stat = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($stat);
            $entityManager->flush();

            return $this->redirectToRoute('liste_status');
        }

        return $this->render('referentiel/orders/Stat/newstat.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("ord/stat/edit/{id}" , name="status_edit")
     * Method( {"GET", "POST"})
     */
    public function editStat(request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $stat = new OrdStat();
        $stat = $this->getDoctrine()->getRepository(OrdStat::class)->find($id);

        $form = $this->createFormBuilder($stat)
        ->add('CodeStatOrd', TextType::class, array(
            'attr'=> array('class' => 'form-control'),
            'label' => 'Code Statut'
        ))
        ->add('LibStatOrdd', TextType::class, array(
            'attr'=> array('class' => 'form-control'),
            'label' => 'Libellé Statut',
            ))
        ->add('save', SubmitType::class, array(
            'label' => 'Mise a jour',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            
            $stat->setDateMaj(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('liste_status');
        }

        return $this->render('referentiel/orders/Stat/editstat.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("ord/stat/delete/{id}")
     * Method({"DELETE"})
     */
    public function deleteStat(Request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $stat = $this->getDoctrine()->getRepository(OrdStat::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($stat);
        $entityManager->flush();
        
        $response = new Response();
        $response->send();
    }

    /**
     * @Route("ord/typevld", name="liste_type_validite")
     * Method({"GET"})
     */
    public function typeVld()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $typesVld = $this->getDoctrine()->getRepository(OrdTypeVld::class)->findAll();

        return $this->render('referentiel/orders/typeVld/typevld.html.twig' , array('typesVld' => $typesVld) );
    }

    /**
     * @Route("ord/typevld/new" , name="new_typevaldite")
     * Method( {"GET", "POST"})
     */
    public function newTypeVld(request $request){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $typeVld = new  OrdTypeVld();

        $form = $this->createFormBuilder($typeVld)
        ->add('CodeTypeVld', TextType::class, array(
            'attr'=> array('class' => 'form-control'),
            'label' => 'Code Type Validité'
        ))
        ->add('LibTypeVld', TextType::class, array(
            'attr'=> array('class' => 'form-control'),
            'label' => 'Libellé Type Validité',
            ))
        ->add('save', SubmitType::class, array(
            'label' => 'Valider',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $typeVld = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeVld);
            $entityManager->flush();

            return $this->redirectToRoute('liste_type_validite');
        }

        return $this->render('referentiel/orders/typeVld/newtypeVld.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("ord/typevld/edit/{id}" , name="typevaldite_edit")
     * Method( {"GET", "POST"})
     */
    public function editTypeVld(request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $typeVld = new OrdTypeVld();
        $typeVld = $this->getDoctrine()->getRepository(OrdTypeVld::class)->find($id);

        $form = $this->createFormBuilder($typeVld)
        ->add('CodeTypeVld', TextType::class, array(
            'attr'=> array('class' => 'form-control'),
            'label' => 'Code Type Validité'
        ))
        ->add('LibTypeVld', TextType::class, array(
            'attr'=> array('class' => 'form-control'),
            'label' => 'Libellé Type Validité',
            ))
        ->add('save', SubmitType::class, array(
            'label' => 'Mise a jour',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            
            $typeVld->setDateMaj(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('liste_type_validite');
        }

        return $this->render('referentiel/orders/typeVld/edittypeVld.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("ord/typevld/delete/{id}")
     * Method({"DELETE"})
     */
    public function delete(Request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $typeVld = $this->getDoctrine()->getRepository(OrdTypeVld::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($typeVld);
        $entityManager->flush();
        
        $response = new Response();
        $response->send();
    }
}
