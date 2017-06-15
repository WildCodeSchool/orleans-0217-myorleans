<?php
/**
 * Created by PhpStorm.
 * User: HaGii
 * Date: 12/06/2017
 * Time: 16:49
 */

namespace MyOrleansBundle\Controller\front;

use MyOrleansBundle\Entity\Collaborateur;
use MyOrleansBundle\Entity\Partenaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AgenceController extends Controller
{
    /**
     * @Route("/agence", name="agence")
     */
    public function agencyAction()
    {
        $em = $this->getDoctrine()->getManager();

        $partenaires = $em->getRepository(Partenaire::class)->findAll();
        $collaborateurs = $em->getRepository(Collaborateur::class)->findAll();

        return $this->render('MyOrleansBundle::agence.html.twig',
            ['partenaires' => $partenaires,
             'collaborateurs'=>$collaborateurs
            ]
        );
    }


}