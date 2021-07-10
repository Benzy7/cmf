<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrivateController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('private/index.html.twig');
    }

    /**
     * @Route("/sticodevam", name="sticodevam")
     */
    public function sticodevam(){

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('private/sticodevam.html.twig');

    }

    /**
     * @Route("/ref", name="Referentiel")
     */
    public function Ref(){

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('private/ref.html.twig');

    }

    /**
     * @Route("/chrg", name="Chargement")
     */
    public function Chrg(){

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('private/chrg.html.twig');

    }

    /**
     * @Route("/orders", name="Orders")
     */
    public function Orders(){

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('private/ord.html.twig');

    }

}
