<?php
/**
 * Created by PhpStorm.
 * User: wilder3
 * Date: 05/07/17
 * Time: 20:07
 */

namespace MyOrleansBundle\Controller;


use MyOrleansBundle\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class CarrouselController extends Controller
{
    /**
     *
     * @Route("/carrousel/{id}", name="carrousel")
     */
    public function affichageCarrouselAction(Evenement $evenement)
    {
        return $this->render('MyOrleansBundle::carrousel.html.twig', [
            'evenement' => $evenement
        ]);
    }

}