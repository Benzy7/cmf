<?php

namespace App\Controller;

use App\Entity\CodeNature;
use App\Entity\Operation;
use App\Entity\CategorieAvoir;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ReferentielController extends AbstractController
{
    /**
     * @Route("/naturec", name="liste_codenature")
     * Method({"GET"})
     */
    public function nature()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $nature = $this->getDoctrine()->getRepository(CodeNature::class)->findAll();

        return $this->render('referentiel/sticodevam/nature/nature.html.twig' , array('nature' => $nature) );
    }

    /**
     * @Route("/naturec/new" , name="new_naturec")
     * Method( {"GET", "POST"})
     */
    public function newNature(request $request){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $nature = new  CodeNature();

        $form = $this->createFormBuilder($nature)
        ->add('CodeNatureCompte', TextType::class, array('attr'=> array('class' => 'form-control')))
        ->add('LibelleNatureCompte', TextType::class, array('attr'=> array('class' => 'form-control')))

        ->add('save', SubmitType::class, array(
            'label' => 'Valider',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $nature = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($nature);
            $entityManager->flush();

            return $this->redirectToRoute('liste_codenature');
        }

        return $this->render('referentiel/sticodevam/nature/new.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("/naturec/edit/{id}" , name="naturec_edit")
     * Method( {"GET", "POST"})
     */
    public function editNature(request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $nature = new CodeNature();
        $nature = $this->getDoctrine()->getRepository(CodeNature::class)->find($id);

        $form = $this->createFormBuilder($nature)
        ->add('CodeNatureCompte', TextType::class, array('attr'=> array('class' => 'form-control')))
        ->add('LibelleNatureCompte', TextType::class, array('attr'=> array('class' => 'form-control')))

        ->add('save', SubmitType::class, array(
            'label' => 'Mise a jour',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $nature->setDateMaj(new \DateTime('now'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('liste_codenature');
        }

        return $this->render('referentiel/sticodevam/nature/edit.html.twig', array( 'form' => $form->createView() ));
    }


    /**
     * @Route("/naturec/delete/{id}")
     * Method({"DELETE"})
     */
    public function deleteNature(Request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $nature = $this->getDoctrine()->getRepository(CodeNature::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($nature);
        $entityManager->flush();
        
        $response = new Response();
        $response->send();
    }

    /**
     * @Route("/codeop", name="liste_codeop")
     * Method({"GET"})
     */
     public function Operation()
     {
         $this->denyAccessUnlessGranted('ROLE_ADMIN');
 
         $operation = $this->getDoctrine()->getRepository(Operation::class)->findAll();
 
         return $this->render('referentiel/sticodevam/operation/operation.html.twig' , array('operation' => $operation) );
     }
 
     /**
      * @Route("/codeop/new" , name="new_codeop")
      * Method( {"GET", "POST"})
      */
     public function newOperation(request $request){
 
         $this->denyAccessUnlessGranted('ROLE_ADMIN');
 
         $operation = new  Operation();
 
         $form = $this->createFormBuilder($operation)
         ->add('CodeOperation', TextType::class, array('attr'=> array('class' => 'form-control')))
         ->add('LibelleOperation', TextType::class, array('attr'=> array('class' => 'form-control')))
 
         ->add('save', SubmitType::class, array(
             'label' => 'Valider',
             'attr'=> array('class' => 'btn btn-success mt-3')
         ))
         ->getForm();
 
         $form->handleRequest($request);
 
         if($form->isSubmitted() && $form->isValid() ){
             $operation = $form->getData();
 
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($operation);
             $entityManager->flush();
 
             return $this->redirectToRoute('liste_codeop');
         }
 
         return $this->render('referentiel/sticodevam/operation/new.html.twig', array( 'form' => $form->createView() ));
     }
 
     /**
      * @Route("/codeop/edit/{id}" , name="codeop_edit")
      * Method( {"GET", "POST"})
      */
     public function editOperation(request $request, $id){
 
         $this->denyAccessUnlessGranted('ROLE_ADMIN');
 
         $operation = new Operation();
         $operation = $this->getDoctrine()->getRepository(Operation::class)->find($id);
 
         $form = $this->createFormBuilder($operation)
         ->add('CodeOperation', TextType::class, array('attr'=> array('class' => 'form-control')))
         ->add('LibelleOperation', TextType::class, array('attr'=> array('class' => 'form-control')))
  
         ->add('save', SubmitType::class, array(
             'label' => 'Mise a jour',
             'attr'=> array('class' => 'btn btn-success mt-3')
         ))
         ->getForm();
 
         $form->handleRequest($request);
 
         if($form->isSubmitted() && $form->isValid() ){

             $operation->setDateMaj(new \DateTime('now'));

             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->flush();
 
             return $this->redirectToRoute('liste_codeop');
         }
 
         return $this->render('referentiel/sticodevam/operation/edit.html.twig', array( 'form' => $form->createView() ));
     }
 
 
     /**
      * @Route("/codeop/delete/{id}")
      * Method({"DELETE"})
      */
     public function deleteOperation(Request $request, $id){
 
         $this->denyAccessUnlessGranted('ROLE_ADMIN');
 
         $operation = $this->getDoctrine()->getRepository(Operation::class)->find($id);
 
         $entityManager = $this->getDoctrine()->getManager();
         $entityManager->remove($operation);
         $entityManager->flush();
         
         $response = new Response();
         $response->send();
     }

    /**
     * @Route("/ctgav", name="liste_codecategorie")
     * Method({"GET"})
     */
    public function categorie()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $categories = $this->getDoctrine()->getRepository(CategorieAvoir::class)->findAll();

        return $this->render('referentiel/sticodevam/categorie/categorie.html.twig' , array('categories' => $categories) );
    }

    /**
     * @Route("/ctgav/new" , name="new_ctgav")
     * Method( {"GET", "POST"})
     */
    public function newCategorie(request $request){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $categorie = new  CategorieAvoir();

        $form = $this->createFormBuilder($categorie)
        ->add('CodeCatgorieAvoir', TextType::class, array('attr'=> array('class' => 'form-control')))
        ->add('LibelleCategorieAvoir', TextType::class, array('attr'=> array('class' => 'form-control')))

        ->add('save', SubmitType::class, array(
            'label' => 'Valider',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $categorie = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute('liste_codecategorie');
        }

        return $this->render('referentiel/sticodevam/categorie/new.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("/ctgav/edit/{id}" , name="ctgav_edit")
     * Method( {"GET", "POST"})
     */
    public function editCategorie(request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $categorie = new CategorieAvoir();
        $categorie = $this->getDoctrine()->getRepository(CategorieAvoir::class)->find($id);

        $form = $this->createFormBuilder($categorie)
        ->add('CodeCatgorieAvoir', TextType::class, array('attr'=> array('class' => 'form-control')))
        ->add('LibelleCategorieAvoir', TextType::class, array('attr'=> array('class' => 'form-control')))

        ->add('save', SubmitType::class, array(
            'label' => 'Mise a jour',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $categorie->setDateMaj(new \DateTime('now'));
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('liste_codecategorie');
        }

        return $this->render('referentiel/sticodevam/categorie/edit.html.twig', array( 'form' => $form->createView() ));
    }


    /**
     * @Route("/ctgav/delete/{id}")
     * Method({"DELETE"})
     */
    public function deleteCategorie(Request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $categorie = $this->getDoctrine()->getRepository(CategorieAvoir::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($categorie);
        $entityManager->flush();
        
        $response = new Response();
        $response->send();
    }

}
