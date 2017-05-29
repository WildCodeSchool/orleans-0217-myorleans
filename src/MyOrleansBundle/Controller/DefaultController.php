<?php

namespace MyOrleansBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('MyOrleansBundle:Default:index.html.twig');
    }

    /**
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

}
