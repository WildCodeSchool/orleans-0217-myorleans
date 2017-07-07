<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 27/06/17
 * Time: 11:52
 */

namespace MyOrleansBundle\Controller\front;


use MyOrleansBundle\Entity\Article;

use MyOrleansBundle\Entity\CategoriePresta;
use MyOrleansBundle\Entity\Flat;
use MyOrleansBundle\Entity\Media;

use MyOrleansBundle\Entity\Client;
use MyOrleansBundle\Entity\Collaborateur;
use MyOrleansBundle\Entity\Evenement;

use MyOrleansBundle\Entity\Pack;
use MyOrleansBundle\Entity\Prestation;
use MyOrleansBundle\Entity\Service;
use MyOrleansBundle\Entity\Temoignage;
use MyOrleansBundle\Entity\Residence;
use MyOrleansBundle\Entity\TypePresta;
use MyOrleansBundle\Entity\Ville;
use MyOrleansBundle\Form\SimpleSearchType;
use MyOrleansBundle\Service\CalculateurCaracteristiquesResidence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class ResidencesController extends Controller
{
    /**
     * @Route("/residences/{id}")
     */
    public function residence($id, SessionInterface $session, Request $request, CalculateurCaracteristiquesResidence $calculator)
    {
        $parcours = null;
        if ($session->has('parcours')) {
            $parcours = $session->get('parcours');
        }

        $em = $this->getDoctrine()->getManager();
        $residence = $em->getRepository(Residence::class)->find($id);
        $media = $em->getRepository(Media::class)->find($id);


//        $flats = $residence->getFlats(Flat::class)->findAll();

        $freeFlat= $calculator->calculFlatDispo($residence);

/*        $prestas = $em->getRepository(Prestation::class)->findAll();
        $typePrestas = $em->getRepository(TypePresta::class)->findAll();
        $categoriePrestas = $em->getRepository(CategoriePresta::class)->findAll();*/


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
/*            'flats' => $flats,*/
/*            'count' => $count,*/
            'media' => $media,
/*            'prestas' => $prestas,
            'typePrestas' => $typePrestas,
            'categoriePrestas' => $categoriePrestas,*/
            'parcours' => $parcours,
            'telephone_number' => $telephoneNumber,
            'freeFlat'=>$freeFlat,
            'form' => $formulaire->createView()
        ]);


    }

}