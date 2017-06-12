<?php
/**
 * Created by PhpStorm.
 * User: wilder3
 * Date: 12/06/17
 * Time: 14:57
 */

namespace MyOrleansBundle\Controller\front;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use MyOrleansBundle\Entity\Residence;
use MyOrleansBundle\Entity\Flat;
use MyOrleansBundle\Form\SimpleSearchType;


class NosBiensController extends Controller
{
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



}