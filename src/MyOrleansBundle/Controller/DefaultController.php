<?php

namespace MyOrleansBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        return $this->render('MyOrleansBundle:Default:index.html.twig');
    }

    /**
     * @Route("/nos-biens", name="nosBiens")
     */
    public function nosBiensAction()
    {
        return $this->render('MyOrleansBundle:Default:nos-biens.html.twig');
    }


    /**
     * @Route("/nosservices", name="nosservices")
     */
    public function nosservices()
    {
        return $this->render('MyOrleansBundle:Default:nosservices.html.twig');
    }

    /**
     * @Route("/immopratique", name="immopratique")
     */
    public function immopratique()
    {
        return $this->render('MyOrleansBundle:Default:immopratique.html.twig');
    }

    /**
     * @Route("/agence", name="agence")
     */
    public function agencyAction()
    {
        return $this->render('MyOrleansBundle:Default:agence.html.twig');
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
    public function appartement()
    {
        return $this->render('MyOrleansBundle::appartement.html.twig');
    }

}
