<?php

namespace MyOrleansBundle\Controller\front;

use MyOrleansBundle\Entity\Residence;
use MyOrleansBundle\Entity\Flat;
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
        $simpleSearch = $this->createForm('MyOrleansBundle\Form\SimpleSearchType',
                                            null,
                                            ['action' => $this->generateUrl('nosbiens')]);

        return $this->render('MyOrleansBundle::index.html.twig', [
            'simpleSearch' => $simpleSearch->createView()
        ]);
    }



    /**
     * @Route("/nos-biens", name="nosbiens")
     */
    public function nosBiensAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $residence = new Residence();
        $flat = new Flat();
        
        // TMP
        $simpleSearch = $this->createForm('MyOrleansBundle\Form\SimpleSearchType',
                                            null,
                                            ['action' => $this->generateUrl('nosbiens')]);

        $simpleSearch->handleRequest($request);

        if ($simpleSearch->isSubmitted() && $simpleSearch->isValid()) {

            // Envoi de contenu different en fonction du bouton clique : investisseur ou residence principale
            if ($simpleSearch->get('resPrincipaleBtn')->isClicked()) {
                $titreContenuSuggere = "Devenez propriétaire en toute sérénité";
                $titreServiceSuggere = "Parcours Immobilier";
                $texteServiceSuggere = "Not the same lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum
                                        lorem ipsum lorem ipsum lorem ipsum lorem ipsum.";
            }

            if ($simpleSearch->get('investBtn')->isClicked()) {
                $titreContenuSuggere = "Investissez en toute sérénité";
                $titreServiceSuggere = "Location et Gestion locative";
                $texteServiceSuggere = "Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum
                                        lorem ipsum lorem ipsum lorem ipsum lorem ipsum.";
            }

            // Prise en compte des filtres du moteur de recherche
            $data = $simpleSearch->getData();
            $ville = $data['ville'];
            $type = $data['type'];

            $residences = $em -> getRepository(Residence::class)->findByVille($ville);
/*            $types = $em -> getRepository(Flat::class)->searchByType($type);*/
            $message = count($residences)." résidence(s) correspondent à votre recherche";

            if(empty($residences)) {
                $residences = $em -> getRepository(Residence::class)->findAll();
                $message = "Aucune résidence ne correspond à votre recherche. Découvrez les biens suggérés.";
            }

            return $this->render('MyOrleansBundle::nosbiens.html.twig',[
                'residences' => $residences,
                'message' => $message,
                'titreContenuSuggere' => $titreContenuSuggere,
                'titreServiceSuggere' => $titreServiceSuggere,
                'texteServiceSuggere' => $texteServiceSuggere,


            ]);

        } else {

            $residences = $em->getRepository(Residence::class)->findAll();
            $message = "Découvrez les biens suggérés";

            $titreContenuSuggere = "Devenez propriétaire en toute sérénité";
            $titreServiceSuggere = "Parcours Immobilier";
            $texteServiceSuggere = "Not the same lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum
                                        lorem ipsum lorem ipsum lorem ipsum lorem ipsum.";

            return $this->render('MyOrleansBundle::nosbiens.html.twig', [
                'residences' => $residences,
                'message' => $message,
                'titreContenuSuggere' => $titreContenuSuggere,
                'titreServiceSuggere' => $titreServiceSuggere,
                'texteServiceSuggere' => $texteServiceSuggere
            ]);


        }


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
     * @Route("/parcours-immobilier", name="parcoursimmo")
     */
    public function parcoursImmoAction()
    {
        return $this->render('MyOrleansBundle::parcoursimmo.html.twig');
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
