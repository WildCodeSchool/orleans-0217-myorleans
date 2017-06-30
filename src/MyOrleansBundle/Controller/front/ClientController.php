<?php
/**
 * Created by PhpStorm.
 * User: jean-baptiste
 * Date: 15/06/17
 * Time: 10:55
 */

namespace MyOrleansBundle\Controller\front;
use MyOrleansBundle\Entity\Client;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



class ClientController extends Controller
{

    /**
     * @Route("/nos-services", name="nosservices")
     */
    public function formulaireAction(Request $request)
    {


        $client = new Client();
        $formBuilder = $this->createFormBuilder($client);

        $formBuilder->add('nom', TextType::class)
                    ->add('prenom', TextType::class)
                    ->add('email', TextType::class)
                    ->add('telephone', TextType::class)
                    ->add('adresse', TextType::class)
                    ->add('codePostal', TextType::class)
                    ->add('ville', TextType::class)
                    ->add('newsletter', TextType::class)
                    ->add('save', SubmitType::class);


        $form = $formBuilder->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute('nosservices');
        }


        return $this->render('MyOrleansBundle::nosservices.html.twig', array('form' => $form->createView()));

    }

}

