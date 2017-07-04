<?php
/**
 * Created by PhpStorm.
 * User: HaGii
 * Date: 12/06/2017
 * Time: 16:49
 */

namespace MyOrleansBundle\Controller\front;

use MyOrleansBundle\Entity\Client;
use MyOrleansBundle\Entity\Collaborateur;
use MyOrleansBundle\Entity\Evenement;
use MyOrleansBundle\Entity\Media;
use MyOrleansBundle\Entity\Partenaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AgenceController extends Controller
{
    /**
     * @Route("/agence", name="agence")
     */
    public function agencyAction(SessionInterface $session, Request $request)
    {
        $client = new Client();

        $parcours = null;
        if ($session->has('parcours')) {
            $parcours = $session->get('parcours');
        }


        $telephoneNumber = $this->getParameter('telephone_number');
        $em = $this->getDoctrine()->getManager();

        $partenaires = $em->getRepository(Partenaire::class)->findAll();
        $collaborateurs = $em->getRepository(Collaborateur::class)->findAll();
        $evenements =$em->getRepository(Evenement::class)->findAll();
        $cover = $em->getRepository(Media::class)->findAll();
        $formulaire = $this->createForm('MyOrleansBundle\Form\FormulaireType', $client);

        $formulaire->handleRequest($request);


        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $mailer = $this->get('mailer');

            $message = new \Swift_Message('Nouveau message de my-orleans.com');
            $message
                ->setTo($this->getParameter('mailer_user'))
                ->setFrom($this->getParameter('mailer_user'))

                ->setBody(
                    $this->renderView(

                        'MyOrleansBundle::receptionForm.html.twig',
                        array('client' => $client)
                    ),
                    'text/html'
                );

            $mailer->send($message);

            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute('immo_pratique');
        }

        return $this->render('MyOrleansBundle::agence.html.twig',
            [
                'parcours' => $parcours,
                'partenaires' => $partenaires,
                'collaborateurs'=>$collaborateurs,
                'evenements'=>$evenements,
                'telephone_number' => $telephoneNumber,
                'cover'=>$cover,
                'form' => $formulaire->createView()
            ]
        );
    }


}