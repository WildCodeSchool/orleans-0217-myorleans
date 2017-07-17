<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 27/06/17
 * Time: 11:52
 */

namespace MyOrleansBundle\Controller\front;

use MyOrleansBundle\Entity\CategoriePresta;
use MyOrleansBundle\Entity\Client;
use MyOrleansBundle\Entity\Flat;
use MyOrleansBundle\Entity\Prestation;
use MyOrleansBundle\Entity\Residence;
use MyOrleansBundle\Entity\TypeLogement;
use MyOrleansBundle\Entity\TypePresta;
use MyOrleansBundle\Service\CalculateurCaracteristiquesResidence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ResidencesController extends Controller
{
    /**
     * @Route("/residences/{slug}", name="residences")
     * @ParamConverter("residence", class="MyOrleansBundle:Residence", options={"slug" = "slug"})
     */
    public function residenceAction(Residence $residence, SessionInterface $session, Request $request, CalculateurCaracteristiquesResidence $calculator)
    {
        $parcours = null;
        if ($session->has('parcours')) {
            $parcours = $session->get('parcours');
        }

        $em = $this->getDoctrine()->getManager();
        $flats = $em->getRepository(Flat::class)->flatsByResidenceAndStatus($residence);
        $typelogment = $em->getRepository(TypeLogement::class)->findAll();
/*        $categoriepresta = $em->getRespository(CategoriePresta::class)->findAll();
        $typepresta = $em->getRepository(TypePresta::class)->findAll();
        $prestation = $em->getRepository(Prestation::class)->findAll();*/
        $prixMin = $calculator->calculPrix($residence);
        $flatsDispo = $calculator->calculFlatDispo($residence);
        $typeMinMax = $calculator->calculSizes($residence);

        $medias = $residence->getMedias();
        $mediaDefine = [];
        foreach ($medias as $media) {
            if ($media->getTypeMedia()->getNom() == 'video') {
                $mediaDefine['video'] = $media;
            } elseif ($media->getTypeMedia()->getNom() == 'image') {
                $mediaDefine['image'] = $media;
            }
        }

        // Formulaire de contact
        $client = new  Client();
        $formulaire = $this->createForm('MyOrleansBundle\Form\FormulaireType', $client);
        $telephoneNumber = $this->getParameter('telephone_number');
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
            return $this->redirectToRoute('residences');
        }

        return $this->render('MyOrleansBundle::residence.html.twig', [
            'residence' => $residence,
            'flats' => $flats,
            'parcours' => $parcours,
            'media' => $mediaDefine,
            'telephone_number' => $telephoneNumber,
            'prixMin' => $prixMin,
            'flatsDispo' => $flatsDispo,
            'typeMin' => $typeMinMax[0],
            'typeMax' => $typeMinMax[1],
            'typeLogement'=>$typelogment,
/*            'categoriePresta' => $categoriepresta,
            'typePresta' => $typepresta,
            'prestation' => $prestation,*/
            'form' => $formulaire->createView()
        ]);


    }

}