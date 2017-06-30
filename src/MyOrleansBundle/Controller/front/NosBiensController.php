<?php
/**
 * Created by PhpStorm.
 * User: wilder3
 * Date: 12/06/17
 * Time: 14:57
 */

namespace MyOrleansBundle\Controller\front;

use MyOrleansBundle\Entity\Article;
use MyOrleansBundle\Entity\Quartier;
use MyOrleansBundle\Entity\Ville;
use MyOrleansBundle\Service\AutocompleteGenerator;
use MyOrleansBundle\Service\CalculateurCaracteristiquesResidence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use MyOrleansBundle\Entity\Residence;
use MyOrleansBundle\Form\SimpleSearchType;
use MyOrleansBundle\Form\CompleteSearchType;
use MyOrleansBundle\Repository\ArticleRepository;
use MyOrleansBundle\Service\MyOrleans_Twig_Extension;


class NosBiensController extends Controller
{
    /**
     * @Route("/nos-biens", name="nosbiens")
     */
    public function nosBiensAction(Request $request, SessionInterface $session)
    {
        // Definition des contenus associes par defaut
        $message = "Découvrez les biens suggérés";
        $objectif = "investir";

        // Definition du parcours du visiteur
        $parcours = null;

        if ($session->has('parcours')) {
            $parcours = $session->get('parcours');
            if ($parcours == $this->getParameter('parcours_investisseur')) {
                $objectif = 'investir';
            } else {
                $objectif = 'Residence Principale';
            }
        }

        // Generation du manager
        $em = $this->getDoctrine()->getManager();

        // Recuperation de la liste des villes et des quartiers dans lesqulles se trouvent les residences
        $villes = $em->getRepository(Ville::class)->findAll();
        $quartiers = $em->getRepository(Quartier::class)->findAll();

        // Generation du dernier article avec le tag 'Investissement'
        $article = $em->getRepository(Article::class)->articleByTag('Investissement', 1);
        $article = $article[0];

        // Generation du moteur de recherche simplifie
        $simpleSearch = $this->createForm('MyOrleansBundle\Form\SimpleSearchType', null, ['action' => $this->generateUrl('nosbiens')]);
        $simpleSearch->handleRequest($request);

        // Generation du moteur de recherche complet
        $completeSearch = $this->createForm('MyOrleansBundle\Form\CompleteSearchType', null, ['action' => $this->generateUrl('nosbiens-search')]);
        $completeSearch->handleRequest($request);



        // affectation des valeurs ville et type si le form simpleSearch est valide
        if ($simpleSearch->isSubmitted() && $simpleSearch->isValid()) {

            // Envoi de contenu different en fonction du bouton clique : investisseur ou residence principale
            $objectif = 'investir';
            $tag = 'Investissement';

            $session->set('parcours', $this->getParameter('parcours_investisseur'));

            if ($simpleSearch->get('resPrincipaleBtn')->isClicked()) {
                $objectif = $tag = 'Residence Principale';

                $session->set('parcours', $this->getParameter('parcours_residence'));

            }
            // Generation du dernier article avec le tag 'Residence Principale'
            $article = $em->getRepository(Article::class)->articleByTag($tag, 1);
            $article = $article[0];

            // Prise en compte des filtres du moteur de recherche
            $data = $simpleSearch->getData();
            $residences = $em -> getRepository(Residence::class)->simpleSearch($data['ville'], $data['type']);

            $message = count($residences)." résidence(s) correspondent à votre recherche";

            // Recuperation de toutes les residences pour affichage si la ville selectionnee n'existe pas
            if(empty($residences)) {
                $residences = $em -> getRepository(Residence::class)->findAll();
                $message = "Aucune résidence ne correspond à votre recherche. Découvrez les biens suggérés.";
            }

            // Parametrage du parcours visiteur
            $parcours = $session->get('parcours');

        }

        // Recuperation de toutes les residences pour affichage si la ville selectionnee n'existe pas
        if(empty($residences)) {
            $residences = $em -> getRepository(Residence::class)->findAll();
        }

        return $this->render('MyOrleansBundle::nosbiens.html.twig', [
            'parcours' => $parcours,
            'residences' => $residences,
            'completeSearch' => $completeSearch->createView(),
            'villes' => $villes,
            'quartiers' => $quartiers,
            'message' => $message,
            'objectif' => $objectif,
            'article' => $article,
        ]);

    }

    /**
     * @Route("/nos-biens/search", name="nosbiens-search")
     */
    public function completeSearchAction(Request $request, SessionInterface $session)
    {
        $em = $this->getDoctrine()->getManager();
        $completeSearch = $this->createForm('MyOrleansBundle\Form\CompleteSearchType');
        $completeSearch->handleRequest($request);

        // Recuperation de la liste des villes et des quartiers dans lesqulles se trouvent les residences
        $villes = $em->getRepository(Ville::class)->findAll();
        $quartiers = $em->getRepository(Quartier::class)->findAll();

        // Traitement de la requete
        if ($completeSearch->isSubmitted()) {

            $data = $completeSearch->getData();
            $ville = $data['ville'];
            $quartier = $data['quartier'];
            $type = $data['type'];
            $surfaceMin = $data['surfaceMin'];
            $surfaceMax = $data['surfaceMax'];
            $nbChambres = $data['nbChambres'];
            $objectif = $data['objectif'];
            $budgetMin = $data['budgetMin'];
            $budgetMax = $data['budgetMax'];
            $objectif = $data['objectif'];

            $residences = $em->getRepository(Residence::class)->completeSearch($ville, $quartier, $type, $surfaceMin,
                                                                                $surfaceMax, $nbChambres, $budgetMin,
                                                                                $budgetMax);

            $message = count($residences)." résidence(s) correspondent à votre recherche";

            // Recuperation de toutes les residences pour affichage si la ville selectionnee n'existe pas
            if(empty($residences)) {
                $residences = $em->getRepository(Residence::class)->findAll();
                $message = "Aucune résidence ne correspond à votre recherche. Découvrez les biens suggérés.";
            }

            // Generation des contenus associes en fonction de l'objectif
            if (isset($objectif) && $objectif == 'Residence Principale') {
                // Generation du dernier article avec le tag 'Residence Principale'
                $article = $em->getRepository(Article::class)->articleByTag('Residence Principale', 1);
                $article = $article[0];

                $objectif = "Residence Principale";

                $session->set('parcours', $this->getParameter('parcours_residence'));

            }

            if (isset($objectif) && $objectif == 'investir') {
                $session->set('parcours', $this->getParameter('parcours_investisseur'));

            }

            // Parametrage du parcours visiteur
            $parcours = $session->get('parcours');

            // Generation du derier article avec le tag 'Investissement'
            $article = $em->getRepository(Article::class)->articleByTag('Investissement', 1);
            $article = $article[0];

            // Fin contenu associe

            return $this->render('MyOrleansBundle::nosbiens.html.twig',[
                'parcours' => $parcours,
                'completeSearch' => $completeSearch->createView(),
                'residences' => $residences,
                'villes' => $villes,
                'quartiers' => $quartiers,
                'message' => $message,
                'objectif' => $objectif,
                'article' => $article
            ]);

        } else {
            return $this->redirectToRoute('nosbiens');
        }

    }

}