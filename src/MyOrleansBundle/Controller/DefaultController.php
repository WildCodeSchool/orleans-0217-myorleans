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
     * @Route("/nos-biens", name="nosBiens")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function nosbiensAction()
    {
        return $this->render('MyOrleansBundle::nosbiens.html.twig');
    }
}
