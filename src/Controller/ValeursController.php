<?php

namespace App\Controller;

use App\Entity\Valeur;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ValeursController extends AbstractController
{
    /**
     * @Route("/valeur", name="liste_valeurs")
     */
    public function valeurs(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $valeurs = $this->getDoctrine()->getRepository(Valeur::class)->findAll();

        return $this->render('referentiel/general/valeurs/valeur.html.twig', [
            'valeurs' => $valeurs ,
        ]);
    }

    /**
     * @Route("/valeur/new" , name="new_valeur")
     * Method( {"GET", "POST"})
     */
    public function newValeur(request $request){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $valeur = new  Valeur();

        $form = $this->createFormBuilder($valeur)
        ->add('CodeValeur', TextType::class, array(
            'required' => true ,
            'attr'=> array('class' => 'form-control')
            ))  

        ->add('LibelleValeur', TextType::class, array(
            'required' => false ,
            'attr'=> array('class' => 'form-control')
            ))   

        ->add('Mnemonique', TextType::class, array(
            'required' => false ,
            'attr'=> array('class' => 'form-control')
            ))   

        ->add('TypeValeur', TextType::class,array(
            'required' => false ,
            'attr'=> array('class' => 'form-control')
            ))   

        ->add('GroupCotation', TextType::class,array(
            'required' => false ,
            'attr'=> array('class' => 'form-control')
            ))   

        ->add('save', SubmitType::class, array(
            'label' => 'Valider',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $valeur = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($valeur);
            $entityManager->flush();

            return $this->redirectToRoute('liste_valeurs');
        }

        return $this->render('referentiel/general/valeurs/new.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("/valeur/edit/{id}" , name="valeur_edit")
     * Method( {"GET", "POST"})
     */
    public function editValeur(request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $valeur = new Valeur();
        $valeur = $this->getDoctrine()->getRepository(Valeur::class)->find($id);

        $form = $this->createFormBuilder($valeur)
        ->add('CodeValeur', TextType::class, array(
            'required' => true ,
            'attr'=> array('class' => 'form-control')
            ))  

        ->add('LibelleValeur', TextType::class, array(
            'required' => false ,
            'attr'=> array('class' => 'form-control')
            ))   

        ->add('Mnemonique', TextType::class, array(
            'required' => false ,
            'attr'=> array('class' => 'form-control')
            ))   

        ->add('TypeValeur', TextType::class,array(
            'required' => false ,
            'attr'=> array('class' => 'form-control')
            ))   

        ->add('GroupCotation', TextType::class,array(
            'required' => false ,
            'attr'=> array('class' => 'form-control')
            ))
            
            ->add('save', SubmitType::class, array(
            'label' => 'Mise a jour',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('liste_valeurs');
        }

        return $this->render('referentiel/general/valeurs/edit.html.twig', array( 'form' => $form->createView() ));
    }


    /**
     * @Route("/valeur/delete/{id}")
     * Method({"DELETE"})
     */
    public function deleteValeur(Request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $valeur = $this->getDoctrine()->getRepository(Valeur::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($valeur);
        $entityManager->flush();
        
        $response = new Response();
        $response->send();
    }

}
