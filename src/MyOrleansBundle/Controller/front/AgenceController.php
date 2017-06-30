<?php
/**
 * Created by PhpStorm.
 * User: HaGii
 * Date: 12/06/2017
 * Time: 16:49
 */

namespace MyOrleansBundle\Controller\front;

use MyOrleansBundle\Entity\Collaborateur;
use MyOrleansBundle\Entity\Evenement;
use MyOrleansBundle\Entity\Media;
use MyOrleansBundle\Entity\Partenaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AgenceController extends Controller
{
    /**
     * @Route("/agence", name="agence")
     */
    public function agencyAction(SessionInterface $session)
    {
        $parcours = null;
        if (!empty($session->get('parcours'))) {
            $parcours = $session->get('parcours');
        }

        $em = $this->getDoctrine()->getManager();

        $partenaires = $em->getRepository(Partenaire::class)->findAll();
        $collaborateurs = $em->getRepository(Collaborateur::class)->findAll();
        $evenements =$em->getRepository(Evenement::class)->findAll();
        $cover = $em->getRepository(Media::class)->findAll();

        return $this->render('MyOrleansBundle::agence.html.twig',
            [
                'parcours' => $parcours,
                'partenaires' => $partenaires,
                'collaborateurs'=>$collaborateurs,
                'evenements'=>$evenements,
                'cover'=>$cover
            ]
        );
    }


}