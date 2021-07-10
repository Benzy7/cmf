<?php

namespace App\Controller;

use App\Entity\CodeCompteIntrm;
use App\Entity\CodeMarche;
use App\Entity\CodeProfit;
use App\Entity\CodeTitre;
use App\Entity\ReglementIntrm;

use App\Entity\AdhrentIntermidiaire;
use App\Entity\Adherent;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RefIntermidairesController extends AbstractController
{
    /**
     * @Route("/intermidiares", name="liste_intermidiares")
     */
    public function listeIntermidiares()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $intrms = $this->getDoctrine()->getRepository(AdhrentIntermidiaire::class)->findAll();

        return $this->render('referentiel/general/intrm/listintrm.html.twig', [
            'intrms' => $intrms ,
        ]);
    }

    /**
     * @Route("/intermidiares/new" , name="new_intermidiares")
     * Method( {"GET", "POST"})
     */
    public function newIntermidiare(request $request){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $intrm = new  AdhrentIntermidiaire();

        $form = $this->createFormBuilder($intrm)
        ->add('CodeInterm',EntityType::class,[
            'class' => Adherent::class,
            'label' => 'Intermédiaire :',
            'group_by' => 'CodeAdherent',
            'attr' => array('class' => 'form-control'),
            'choice_label' => 'NomAdherent',
        ])
        ->add('LibelleSigle', TextType::class, array(
            'required' => false ,
            'label' => 'Libellé Sigle :',
            'attr'=> array('class' => 'form-control')
            ))
        ->add('LibelleReduit', TextType::class, array(
            'required' => false ,
            'label' => 'Libellé Réduit :',
            'attr'=> array('class' => 'form-control')
            ))      
        ->add('DateCult',DateType::class,[
            'years' => range(date('Y'), 1990),
            'attr'=> array('class' => 'form-control'),
            'required' => false,
            'label' => 'Date de clôture du code :',
            ])
    
        ->add('save', SubmitType::class, array(
            'label' => 'Valider',
            'attr'=> array('class' => 'btn btn-success mt-3')
            ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $intrm = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($intrm);
            $entityManager->flush();

            return $this->redirectToRoute('liste_intermidiares');
        }

        return $this->render('referentiel/general/intrm/newintrm.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("/intermidiares/edit/{id}" , name="intermidiare_edit")
     * Method( {"GET", "POST"})
     */
    public function editIntermidiare(request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $intr = new AdhrentIntermidiaire();
        $intr = $this->getDoctrine()->getRepository(AdhrentIntermidiaire::class)->find($id);

        $form = $this->createFormBuilder($intr)
        ->add('CodeInterm',EntityType::class,[
            'class' => Adherent::class,
            'label' => 'Intermédiaire :',
            'attr' => array('class' => 'form-control'),
            'choice_label' => 'NomAdherent',
        ])
        ->add('LibelleSigle', TextType::class, array(
            'required' => false ,
            'label' => 'Libellé Sigle :',
            'attr'=> array('class' => 'form-control')
            ))
        ->add('LibelleReduit', TextType::class, array(
            'required' => false ,
            'label' => 'Libellé Réduit :',
            'attr'=> array('class' => 'form-control')
            ))      
        ->add('DateCult',DateType::class,[
            'years' => range(date('Y'), 1990),
            'attr'=> array('class' => 'form-control'),
            'required' => false,
            'label' => 'Date de clôture du code :',
            ])
    
        ->add('save', SubmitType::class, array(
            'label' => 'Mise a jour',
            'attr'=> array('class' => 'btn btn-success mt-3')
            ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $intr->setDateMaj(new \DateTime('now'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('liste_intermidiares');
        }

        return $this->render('referentiel/general/intrm/editintrm.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("/intermidiares/delete/{id}")
     * Method({"DELETE"})
     */
    public function deleteIntermidiare(Request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $dintr = $this->getDoctrine()->getRepository(AdhrentIntermidiaire::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($dintr);
        $entityManager->flush();
        
        $response = new Response();
        $response->send();
    }

    /**
     * @Route("/comptec", name="code_compte")
     */
    public function comptec()/* : Response */
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $comptes = $this->getDoctrine()->getRepository(CodeCompteIntrm::class)->findAll();

        return $this->render('referentiel/intermidaires/compte/comptes.html.twig', [
            'comptes' => $comptes ,
        ]);
    }

    /**
     * @Route("/comptec/new" , name="new_code_compte")
     * Method( {"GET", "POST"})
     */
    public function newComptec(request $request){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $compte = new  CodeCompteIntrm();

        $form = $this->createFormBuilder($compte)
        ->add('CodeCompte', TextType::class, array(
            'required' => true ,
            'attr'=> array('class' => 'form-control')
            ))  

        ->add('LibelleCompte', TextType::class, array(
            'required' => true ,
            'attr'=> array('class' => 'form-control')
            ))   
    
        ->add('save', SubmitType::class, array(
            'label' => 'Valider',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $compte = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($compte);
            $entityManager->flush();

            return $this->redirectToRoute('code_compte');
        }

        return $this->render('referentiel/intermidaires/compte/newcompte.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("/comptec/edit/{id}" , name="code_compte_edit")
     * Method( {"GET", "POST"})
     */
    public function editComptec(request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $compte = new CodeCompteIntrm();
        $compte = $this->getDoctrine()->getRepository(CodeCompteIntrm::class)->find($id);

        $form = $this->createFormBuilder($compte)
        ->add('CodeCompte', TextType::class, array(
            'required' => true ,
            'attr'=> array('class' => 'form-control')
            ))  

        ->add('LibelleCompte', TextType::class, array(
            'required' => true ,
            'attr'=> array('class' => 'form-control')
            ))   
            
        ->add('save', SubmitType::class, array(
            'label' => 'Mise a jour',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $compte->setDateMaj(new \DateTime('now'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('code_compte');
        }

        return $this->render('referentiel/intermidaires/compte/editcompte.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("/comptec/delete/{id}")
     * Method({"DELETE"})
     */
    public function deleteComptec(Request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $compte = $this->getDoctrine()->getRepository(CodeCompteIntrm::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($compte);
        $entityManager->flush();
        
        $response = new Response();
        $response->send();
    }

    /**
     * @Route("/marchec", name="code_marche")
     */
    public function marchec()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $marches = $this->getDoctrine()->getRepository(CodeMarche::class)->findAll();

        return $this->render('referentiel/intermidaires/marche/marches.html.twig', [
            'marches' => $marches ,
        ]);
    }

    /**
     * @Route("/marchec/new" , name="new_code_marche")
     * Method( {"GET", "POST"})
     */
    public function newCmarche(request $request){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $marche = new  CodeMarche();

        $form = $this->createFormBuilder($marche)
        ->add('CodeMarche', TextType::class, array(
            'required' => true ,
            'attr'=> array('class' => 'form-control')
            ))  

        ->add('LibelleMarche', TextType::class, array(
            'required' => true ,
            'attr'=> array('class' => 'form-control')
            ))   
    
        ->add('save', SubmitType::class, array(
            'label' => 'Valider',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $marche = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($marche);
            $entityManager->flush();

            return $this->redirectToRoute('code_marche');
        }

        return $this->render('referentiel/intermidaires/marche/newmarche.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("/marchec/edit/{id}" , name="code_marche_edit")
     * Method( {"GET", "POST"})
     */
    public function editCmarche(request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $marche = new CodeMarche();
        $marche = $this->getDoctrine()->getRepository(CodeMarche::class)->find($id);

        $form = $this->createFormBuilder($marche)
        ->add('CodeMarche', TextType::class, array(
            'required' => true ,
            'attr'=> array('class' => 'form-control')
            ))  

        ->add('LibelleMarche', TextType::class, array(
            'required' => true ,
            'attr'=> array('class' => 'form-control')
            ))   
            
        ->add('save', SubmitType::class, array(
            'label' => 'Mise a jour',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $marche->setDateMaj(new \DateTime('now'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('code_marche');
        }

        return $this->render('referentiel/intermidaires/marche/editmarche.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("/marchec/delete/{id}")
     * Method({"DELETE"})
     */
    public function deleteCmarche(Request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $marche = $this->getDoctrine()->getRepository(CodeMarche::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($marche);
        $entityManager->flush();
        
        $response = new Response();
        $response->send();
    }

    /**
     * @Route("/profit", name="code_profit")
     */
    public function profit()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $profits = $this->getDoctrine()->getRepository(CodeProfit::class)->findAll();

        return $this->render('referentiel/intermidaires/profit/profit.html.twig', [
            'profits' => $profits ,
        ]);
    }

    /**
     * @Route("/profit/new" , name="new_code_profit")
     * Method( {"GET", "POST"})
     */
    public function newProfit(request $request){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $profit = new  CodeProfit();

        $form = $this->createFormBuilder($profit)
        ->add('CodeProfit', TextType::class, array(
            'required' => true ,
            'attr'=> array('class' => 'form-control')
            ))  

        ->add('LibelleProfit', TextType::class, array(
            'required' => true ,
            'attr'=> array('class' => 'form-control')
            ))   
    
        ->add('save', SubmitType::class, array(
            'label' => 'Valider',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $profit = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($profit);
            $entityManager->flush();

            return $this->redirectToRoute('code_profit');
        }

        return $this->render('referentiel/intermidaires/profit/newprofit.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("/profit/edit/{id}" , name="code_profit_edit")
     * Method( {"GET", "POST"})
     */
    public function editProfit(request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $profit = new CodeProfit();
        $profit = $this->getDoctrine()->getRepository(CodeProfit::class)->find($id);

        $form = $this->createFormBuilder($profit)
        ->add('CodeProfit', TextType::class, array(
            'required' => true ,
            'attr'=> array('class' => 'form-control')
            ))  

        ->add('LibelleProfit', TextType::class, array(
            'required' => true ,
            'attr'=> array('class' => 'form-control')
            ))   
            
        ->add('save', SubmitType::class, array(
            'label' => 'Mise a jour',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $profit->setDateMaj(new \DateTime('now'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('code_profit');
        }

        return $this->render('referentiel/intermidaires/profit/editprofit.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("/profit/delete/{id}")
     * Method({"DELETE"})
     */
    public function deleteProfit(Request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $profit = $this->getDoctrine()->getRepository(CodeProfit::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($profit);
        $entityManager->flush();
        
        $response = new Response();
        $response->send();
    }

    /**
     * @Route("/titre", name="code_titre")
     */
    public function titre()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $titres = $this->getDoctrine()->getRepository(CodeTitre::class)->findAll();

        return $this->render('referentiel/intermidaires/titre/titre.html.twig', [
            'titres' => $titres ,
        ]);
    }

    /**
     * @Route("/titre/new" , name="new_code_titre")
     * Method( {"GET", "POST"})
     */
    public function newTitre(request $request){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $titre = new  CodeTitre();

        $form = $this->createFormBuilder($titre)
        ->add('CodeTitre', TextType::class, array(
            'required' => true ,
            'attr'=> array('class' => 'form-control')
            ))  

        ->add('LibelleTitre', TextType::class, array(
            'required' => true ,
            'attr'=> array('class' => 'form-control')
            ))   
    
        ->add('save', SubmitType::class, array(
            'label' => 'Valider',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $titre = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($titre);
            $entityManager->flush();

            return $this->redirectToRoute('code_titre');
        }

        return $this->render('referentiel/intermidaires/titre/newtitre.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("/titre/edit/{id}" , name="code_titre_edit")
     * Method( {"GET", "POST"})
     */
    public function editTitre(request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $titre = new CodeTitre();
        $titre = $this->getDoctrine()->getRepository(CodeTitre::class)->find($id);

        $form = $this->createFormBuilder($titre)
        ->add('CodeTitre', TextType::class, array(
            'required' => true ,
            'attr'=> array('class' => 'form-control')
            ))  

        ->add('LibelleTitre', TextType::class, array(
            'required' => true ,
            'attr'=> array('class' => 'form-control')
            ))   
            
        ->add('save', SubmitType::class, array(
            'label' => 'Mise a jour',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $titre->setDateMaj(new \DateTime('now'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('code_titre');
        }

        return $this->render('referentiel/intermidaires/titre/edittitre.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("/titre/delete/{id}")
     * Method({"DELETE"})
     */
    public function deleteTitre(Request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $titre = $this->getDoctrine()->getRepository(CodeTitre::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($titre);
        $entityManager->flush();
        
        $response = new Response();
        $response->send();
    }

    /**
     * @Route("/reg", name="code_reg")
     */
    public function reg()/* : Response */
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $regs = $this->getDoctrine()->getRepository(ReglementIntrm::class)->findAll();

        return $this->render('referentiel/intermidaires/reg/reg.html.twig', [
            'regs' => $regs ,
        ]);
    }

    /**
     * @Route("/reg/new" , name="new_code_reg")
     * Method( {"GET", "POST"})
     */
    public function newReg(request $request){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $reg = new  ReglementIntrm();

        $form = $this->createFormBuilder($reg)
        ->add('CodeReg', TextType::class, array(
            'required' => true ,
            'attr'=> array('class' => 'form-control')
            ))  

        ->add('LibelleReg', TextType::class, array(
            'required' => true ,
            'attr'=> array('class' => 'form-control')
            ))   
    
        ->add('save', SubmitType::class, array(
            'label' => 'Valider',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $reg = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reg);
            $entityManager->flush();

            return $this->redirectToRoute('code_reg');
        }

        return $this->render('referentiel/intermidaires/reg/newreg.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("/reg/edit/{id}" , name="code_reg_edit")
     * Method( {"GET", "POST"})
     */
    public function editReg(request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $reg = new ReglementIntrm();
        $reg = $this->getDoctrine()->getRepository(ReglementIntrm::class)->find($id);

        $form = $this->createFormBuilder($reg)
        ->add('CodeReg', TextType::class, array(
            'required' => true ,
            'attr'=> array('class' => 'form-control')
            ))  

        ->add('LibelleReg', TextType::class, array(
            'required' => true ,
            'attr'=> array('class' => 'form-control')
            ))   
            
        ->add('save', SubmitType::class, array(
            'label' => 'Mise a jour',
            'attr'=> array('class' => 'btn btn-success mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $reg->setDateMaj(new \DateTime('now'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('code_reg');
        }

        return $this->render('referentiel/intermidaires/compte/editreg.html.twig', array( 'form' => $form->createView() ));
    }

    /**
     * @Route("/reg/delete/{id}")
     * Method({"DELETE"})
     */
    public function deleteReg(Request $request, $id){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $reg = $this->getDoctrine()->getRepository(ReglementIntrm::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($reg);
        $entityManager->flush();
        
        $response = new Response();
        $response->send();
    }

}
