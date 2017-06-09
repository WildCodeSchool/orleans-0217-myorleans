<?php

namespace MyOrleansBundle\Controller\front;

use MyOrleansBundle\Entity\Residence;
use MyOrleansBundle\Form\SimpleSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $residence = new Residence();
        $simpleSearch = $this->createForm('MyOrleansBundle\Form\SimpleSearchType', $residence);
        $simpleSearch->handleRequest($request);

        if ($simpleSearch->isSubmitted() && $simpleSearch->isValid()) {

/*            $type = $residence->getFlats()->getType();*/
            $ville = $residence->getVille();
            $residences = $em -> getRepository(Residence::class)->findByVille($ville);
/*            $types = $em -> getRepository(Flat::class)->searchByType($type);*/
            $message = count($residences)." résidence(s) correspondent à votre recherche";

            if(empty($residences)) {
                $residences = $em -> getRepository(Residence::class)->findAll();
                $message = "Aucune résidence ne correspond à votre recherche. Découvrez les biens suggérés.";
            }

            return $this->render('MyOrleansBundle::nosbiens.html.twig',[
                'residences' => $residences,
                'message' => $message
            ]);

        } else {

            return $this->render('MyOrleansBundle::index.html.twig', [
                'simpleSearch' => $simpleSearch->createView()
            ]);

        }


    }

    /**
     * @Route("/nos-biens", name="nosbiens")
     */
    public function nosBiensAction()
    {
        $em = $this->getDoctrine()->getManager();
        $residences = $em -> getRepository(Residence::class)->findAll();

        $message = "Découvrez les biens suggérés";

        var_dump($residences[0]);
        die();

        return $this->render('MyOrleansBundle::nosbiens.html.twig', [
            'residences' => $residences,
            'message' => $message
        ]);
    }


    /*-----------------------------------------------*/

    /**
     * @Route("/nos-services", name="nosservices")
     */
    public function nosservices()
    {
        return $this->render('MyOrleansBundle::nosservices.html.twig');
    }

    /**
     * @Route("/immopratique", name="immopratique")
     */
    public function immopratique()
    {
        return $this->render('MyOrleansBundle::immopratique.html.twig');
    }

    /**
     * @Route("/agence", name="agence")
     */
    public function agencyAction()
    {
        return $this->render('MyOrleansBundle::agence.html.twig');
    }

    /**
     * @Route("/residences")
     */
    public function residence()
    {
        return $this->render('MyOrleansBundle::residence.html.twig');
    }

    /**
     * @Route("/appartement")
     */
    public function flat()
    {
        return $this->render('MyOrleansBundle::appartement.html.twig');
    }

    /**
     * @Route("/admin")
     */
    public function admin()
    {
        return $this->render('MyOrleansBundle::admin.html.twig');
    }




}
