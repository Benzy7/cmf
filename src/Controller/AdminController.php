<?php

namespace App\Controller;

use App\Entity\User;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpKernel\KernelInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        return $this->render('admin/index.html.twig', [
            'nom' =>  ''
        ]);
    }

    private $encoder;

        public function __construct(UserPasswordEncoderInterface $encoder)
        {
        $this->encoder = $encoder;
        }

    //protected $admin = array(["ROLE_admin"]);
    //protected $standard = array(["ROLE_USER"]);

/*      public function userRole(){
        $role = (['ROLE_USER']);
        return new JsonResponse($role);
    }
    public function adminRole(){
        $role = (['ROLE_ADMIN']);
        return new JsonResponse($role);
    } */

    /**
     * @Route("/user/new" , name="new_user")
     * Method( {"GET", "POST"})
     */
    public function new(request $request){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
    
        $user = new User();

        $form = $this->createFormBuilder($user)
        ->add('username', TextType::class, array(
            'attr'=> array('class' => 'form-control'),
            'label' => 'Identifiant'
            ))
        ->add('password', PasswordType::class, array(
            'label' => 'Mot de passe',
            'attr'=> array('class' => 'form-control')
        ))
        ->add('nom', TextType::class, array( 
            'required' => false ,
            'attr'=> array('class' => 'form-control')
            ))    
        ->add('prenom', TextType::class, array( 
            'required' => false ,
            'attr'=> array('class' => 'form-control')
            ))  
        ->add('email', TextType::class, array( 
            'required' => false ,
            'attr'=> array('class' => 'form-control')
            ))

/*          ->add('Roles', ChoiceType::class, [
            'choices'  => [
            'standard' => 'user',
            'Administrateur' => 'admin',
                ],
            ])  */

        ->add('ddn', BirthdayType::class, array( 
            'label' => 'Date de naiisance',
            'required' => false ,
            'attr'=> array('class' => 'form-control')
            ))  
        ->add('Sexe', ChoiceType::class, [
            'attr'=> array('class' => 'form-control'),
            'choices'  => [
                
            'Homme' => 'homme',
            'Femme' => 'femme',
                ],
            ]) 

        ->add('save', SubmitType::class, array(
            'label' => 'Valider',
            'attr'=> array('class' => 'btn btn-primary btn-lg btn-block')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $password = $this->encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $user = $form->getData();
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/newuser.html.twig', array( 'form' => $form->createView() ));
    }
    /**
     * @Route("/file/new" , name="new_file")
     * Method( {"GET", "POST"})     
     */
    public function addMv(request $request)
    {    
        $form = $this->createFormBuilder()
        ->add('MV', SubmitType::class, array(
            'label' => 'Chargement fichers Mouvement',
            'attr'=> array('class' => 'btn btn-info btn-lg btn-block')
        ))
        ->add('STK', SubmitType::class, array(
            'label' => 'Chargement fichers Stock',
            'attr'=> array('class' => 'btn btn-info btn-lg btn-block')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            if ($form->getClickedButton() && 'MV' === $form->getClickedButton()->getName()) {
                    exec('C:\files\batch\mvtImport.bat');
                    }
            
            if ($form->getClickedButton() && 'STK' === $form->getClickedButton()->getName()) {
                    exec('C:\files\batch\StkImport.bat');
                    }

            return $this->redirectToRoute('new_file');
        }

        return $this->render('admin/newfile.html.twig', array( 'form' => $form->createView() ));
    }
}