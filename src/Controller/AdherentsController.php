<?php

namespace App\Controller;

use App\Entity\Adherent;
use App\Entity\TypeAdherent;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdherentsController extends AbstractController
{
    /**
     * @Route("/adherent", name="liste_adherents")
     * Method({"GET"})
     */
    public function adherent()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $adhrents = $this->getDoctrine()->getRepository(Adherent::class)->findAll();

        return $this->render('adherents/adr.html.twig' , array('adhrents' => $adhrents) );
    }

    /**
     * @Route("/adherent/new" , name="new_adherent")
     * Method( {"GET", "POST"})
     */
    public function new(request $request){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $adherent = new  Adherent();

        $form = $this->createFormBuilder($adherent)
        ->add('CodeAdherent', TextType::class, array('attr'=> array('class' => 'form-control')))
        ->add('NomAdherent', TextType::class, array('attr'=> array('class' => 'form-control')))

        ->add('TypeAdherent',EntityType::class,[
            'class' => TypeAdherent::class,
            'attr' => array('class' => 'form-control'),
            'choice_label' => 'CodeTypeAdherent',
        ])

        ->add('save', SubmitType::class, array(
            'label' => 'Valider',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $adherent = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($adherent);
            $entityManager->flush();

            return $this->redirectToRoute('liste_adherents');
        }

        return $this->render('adherents/new.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("/adherent/edit/{id}" , name="adherent_edit")
     * Method( {"GET", "POST"})
     */
    public function edit(request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $Adherent = new Adherent();
        $Adherent = $this->getDoctrine()->getRepository(Adherent::class)->find($id);

        $form = $this->createFormBuilder($Adherent)
        ->add('CodeAdherent', TextType::class, array('attr'=> array('class' => 'form-control')))
        ->add('NomAdherent', TextType::class, array('attr'=> array('class' => 'form-control')))
        ->add('TypeAdherent',EntityType::class,[
            'class' => TypeAdherent::class,
            'attr' => array('class' => 'form-control'),
            'choice_label' => 'CodeTypeAdherent',
        ])
        ->add('save', SubmitType::class, array(
            'label' => 'Mise a jour',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            
            $Adherent->setDateMaj(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('liste_adherents');
        }

        return $this->render('adherents/edit.html.twig', array( 'form' => $form->createView() ));
    }


    /**
     * @Route("/adherent/delete/{id}")
     * Method({"DELETE"})
     */
    public function delete(Request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $Adherent = $this->getDoctrine()->getRepository(Adherent::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($Adherent);
        $entityManager->flush();
        
        $response = new Response();
        $response->send();
    }

    /**
     * @Route("/typeadr", name="liste_type_adherents")
     * Method({"GET"})
     */
    public function typeAdherent()
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $typeAdhrents = $this->getDoctrine()->getRepository(TypeAdherent::class)->findAll();

        return $this->render('adherents/typeadr.html.twig' , array('typeAdhrents' => $typeAdhrents) );
    }

    /**
     * @Route("/typeadr/new" , name="new_type_adherent")
     * Method( {"GET", "POST"})
     */
    public function newType(request $request){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $TypeAdherent = new TypeAdherent();

        $form = $this->createFormBuilder($TypeAdherent)
        ->add('CodeTypeAdherent', TextType::class, array('attr'=> array('class' => 'form-control')))
        ->add('LibelleTypeAdherent', TextType::class, array('attr'=> array('class' => 'form-control')))

        ->add('save', SubmitType::class, array(
            'label' => 'Valider',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $TypeAdherent = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($TypeAdherent);
            $entityManager->flush();

            return $this->redirectToRoute('liste_type_adherents');
        }

        return $this->render('adherents/newtype.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("/typeadr/edit/{id}" , name="type_adherent_edit")
     * Method( {"GET", "POST"})
     */
    public function editType(request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $TypeAdherent = new TypeAdherent();
        $TypeAdherent = $this->getDoctrine()->getRepository(TypeAdherent::class)->find($id);

        $form = $this->createFormBuilder($TypeAdherent)
        ->add('CodeTypeAdherent', TextType::class, array('attr'=> array('class' => 'form-control')))
        ->add('LibelleTypeAdherent', TextType::class, array('attr'=> array('class' => 'form-control')))

        ->add('save', SubmitType::class, array(
            'label' => 'Mise a jour',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            
            $TypeAdherent->setDateMaj(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('liste_type_adherents');
        }

        return $this->render('adherents/edittype.html.twig', array( 'form' => $form->createView() ));
    }


    /**
     * @Route("/typeadr/delete/{id}")
     * Method({"DELETE"})
     */
    public function deleteType(Request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $TypeAdherent = $this->getDoctrine()->getRepository(TypeAdherent::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($TypeAdherent);
        $entityManager->flush();
        
        $response = new Response();
        $response->send();
    }

}
