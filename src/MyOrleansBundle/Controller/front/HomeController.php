<?php

namespace MyOrleansBundle\Controller\front;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {

        return $this->render('MyOrleansBundle::index.html.twig');

    }

    /**
     * @Route("/nos-biens", name="nosbiens")
     */
    public function nosBiensAction()
    {
        return $this->render('MyOrleansBundle::nosbiens.html.twig');
    }


    /*-----------------------------------------------*/

    /**
     * @Route("/nos-services", name="nosservices")
     */
    public function nosservices()
    {
        return $this->render('MyOrleansBundle::nosservices.html.twig');
    }

    /**
     * @Route("/immopratique", name="immopratique")
     */
    public function immopratique()
    {
        return $this->render('MyOrleansBundle::immopratique.html.twig');
    }

    /**
     * @Route("/agence", name="agence")
     */
    public function agencyAction()
    {
        return $this->render('MyOrleansBundle::agence.html.twig');
    }

    /**
     * @Route("/residences")
     */
    public function residence()
    {
        return $this->render('MyOrleansBundle::residence.html.twig');
    }

    /**
     * @Route("/appartement")
     */
    public function flat()
    {
        return $this->render('MyOrleansBundle::appartement.html.twig');
    }

    /**
     * @Route("/admin")
     */
    public function admin()
    {
        return $this->render('MyOrleansBundle::admin.html.twig');
    }

}
