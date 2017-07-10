<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 02/07/17
 * Time: 14:48
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
use MyOrleansBundle\Entity\Service;
use MyOrleansBundle\Entity\Temoignage;
use MyOrleansBundle\Entity\Residence;
use MyOrleansBundle\Entity\TypeLogement;
use MyOrleansBundle\Entity\TypePresta;
use MyOrleansBundle\Entity\Ville;
use MyOrleansBundle\Form\SimpleSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class FlatController extends Controller
{
    /**
     * @Route("/appartement/{id}", name="appartement")
     */
    public function flat($id, SessionInterface $session, Request $request)
    {
        $client = new  Client();
        $parcours = null;
        if ($session->has('parcours')) {
            $parcours = $session->get('parcours');
        }

        $em = $this->getDoctrine()->getManager();
        $flat = $em->getRepository(Flat::class)->find($id);
        $residence = $em->getRepository(Residence::class)->find($id);
        $typelogement = $em->get(TypeLogement::class)->findAll();
        $type_t1 = $this->getParameter('typeLogementT1');
        $type_t2 = $this->getParameter('typeLogementT2');
        $type_t3 = $this->getParameter('typeLogementT3');
        $type_t4 = $this->getParameter('typeLogementT4+');

        // Formulaire de contact

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

                        'MyOrleansBundle::receptionForm.html.twig', [
                            'client' => $client
                        ]
                    ),
                    'text/html'
                );

            $mailer->send($message);

            $em->persist($client);
            $em->flush();
            return $this->redirectToRoute('appartement');
        }
            return $this->render('MyOrleansBundle::appartement.html.twig',[
                'flat'=>$flat,
                'parcours'=>$parcours,
                'residence'=>$residence,
                'telephone_number' => $telephoneNumber,
                'type_logment' => $typelogement,
                'typeLogementT1' => $type_t1,
                'typeLogementT2' => $type_t2,
                'typeLogementT3' => $type_t3,
                'typeLogementT4' => $type_t4,
                'form' => $formulaire->createView()
            ]);
        }

}