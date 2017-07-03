<?php
/**
 * Created by PhpStorm.
 * User: jean-baptiste
 * Date: 15/06/17
 * Time: 10:53
 */

namespace MyOrleansBundle\Controller\front;

use MyOrleansBundle\Entity\Client;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyOrleansBundle\Entity\Temoignage;
use MyOrleansBundle\Entity\Article;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;


class ImmoPratiqueController extends Controller
{

    /**
     * @Route("/immo_pratique", name="immo_pratique")
     */
    public function immoPratiqueAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $client = new Client();
        $formulaire = $this->createForm('MyOrleansBundle\Form\FormulaireType', $client);
        $articles = $em->getRepository(Article::class)->findAll();

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

        return $this->render('MyOrleansBundle::immoPratique.html.twig', [

            'articles' => $articles,
            'form' => $formulaire->createView()
        ]);
    }

}

