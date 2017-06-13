<?php
/**
 * Created by PhpStorm.
 * User: wilder3
 * Date: 12/06/17
 * Time: 14:57
 */

namespace MyOrleansBundle\Controller\front;

use MyOrleansBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use MyOrleansBundle\Entity\Residence;
use MyOrleansBundle\Entity\Flat;
use MyOrleansBundle\Form\SimpleSearchType;
use MyOrleansBundle\Repository\ArticleRepository;


class NosBiensController extends Controller
{
    /**
     * @Route("/nos-biens", name="nosbiens")
     */
    public function nosBiensAction(Request $request)
    {
        // Generation du manager et creation du form simpleSearch
        $em = $this->getDoctrine()->getManager();

        $simpleSearch = $this->createForm('MyOrleansBundle\Form\SimpleSearchType',
            null,
            ['action' => $this->generateUrl('nosbiens')]);

        $simpleSearch->handleRequest($request);

        // affectation des valeurs ville et type si le form simpleSearch est valide
        if ($simpleSearch->isSubmitted() && $simpleSearch->isValid()) {

            // Envoi de contenu different en fonction du bouton clique : investisseur ou residence principale
            if ($simpleSearch->get('resPrincipaleBtn')->isClicked()) {
                // Generation des articles avec le tag 'Residence Principale'
                $articles = $em->getRepository(Article::class)->articleByTag('Residence Principale');

                $objectif = "residence";
            }
            if ($simpleSearch->get('investBtn')->isClicked()) {
                // Generation des articles avec le tag 'Investissement'
                $articles = $em->getRepository(Article::class)->articleByTag('Investissement');

                $objectif = "investir";
            }

            // Prise en compte des filtres du moteur de recherche
            $data = $simpleSearch->getData();
            $ville = $data['ville'];
            $type = $data['type'];
            $residences = $em -> getRepository(Residence::class)->simpleSearch($ville, $type);

            //Selection aleatoire d'un article
            $numRandom = mt_rand(0, count($articles) - 1);
            $articleRandom = $articles[$numRandom];

            $message = count($residences)." résidence(s) correspondent à votre recherche";

            // Recuperation de toutes les residences pour affichage si la ville selectionnee n'existe pas
            if(empty($residences)) {
                $residences = $em -> getRepository(Residence::class)->findAll();
                $message = "Aucune résidence ne correspond à votre recherche. Découvrez les biens suggérés.";
            }

            return $this->render('MyOrleansBundle::nosbiens.html.twig',[
                'residences' => $residences,
                'message' => $message,
                'objectif' => $objectif,
                'article' => $articleRandom
            ]);

        // donnees envoyees a la page nos biens si le form simpleSearch n'est pas valide ou lorqu'on clique sur
        // l'onglet nos biens dans la navbar
        } else {
            // Generation des articles avec le tag 'Investissement'
            $articles = $em->getRepository(Article::class)->articleByTag('Investissement');

            //Selection aleatoire d'un article
            $numRandom = mt_rand(0, count($articles) - 1);
            $articleRandom = $articles[$numRandom];

            $residences = $em->getRepository(Residence::class)->findAll();
            $message = "Découvrez les biens suggérés";
            $objectif = "Investir";

/*            var_dump($articleRandom);
            die();*/

            return $this->render('MyOrleansBundle::nosbiens.html.twig', [
                'residences' => $residences,
                'message' => $message,
                'objectif' => $objectif,
                'article' => $articleRandom
            ]);


        }


    }



}