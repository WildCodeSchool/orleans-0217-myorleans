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
<<<<<<< HEAD
     * @Route("/nosservices")
     */
    public function nosservices()
    {
        return $this->render('MyOrleansBundle:Default:nosservices.html.twig');
    }

    /**
     * @Route("/immopratique")
     */
    public function immopratique()
    {
        return $this->render('MyOrleansBundle:Default:immopratique.html.twig');
    }

=======
     * @Route("/agence", name="agence")
     */
    public function agencyAction()
    {
        return $this->render('MyOrleansBundle:Default:agence.html.twig');
    }
>>>>>>> cf4c473a5df86cd5696f419d65f1790f2ad053d2
}
