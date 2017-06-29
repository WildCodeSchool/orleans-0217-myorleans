<?php

namespace MyOrleansBundle\Controller\front;

use MyOrleansBundle\Entity\Article;
use MyOrleansBundle\Entity\Pack;
use MyOrleansBundle\Entity\Service;
use MyOrleansBundle\Entity\Temoignage;
use MyOrleansBundle\Entity\Residence;
use MyOrleansBundle\Entity\Flat;
use MyOrleansBundle\Entity\Ville;
use MyOrleansBundle\Entity\Collaborateur;
use MyOrleansBundle\Entity\Evenement;
use MyOrleansBundle\Form\SimpleSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(SessionInterface $session)
    {
        $parcours = null;
        if (isset($_SESSION['parcours'])) {
            $parcours = $_SESSION['parcours'];
        }
        $em = $this->getDoctrine()->getManager();

        $collaborateurs = $em->getRepository(Collaborateur::class)->findAll();

        $residenceFav = $em->getRepository(Residence::class)->findOneFav();
        $residenceTwoFav = $em->getRepository(Residence::class)->findTwoFav();
        $residenceAll = $em->getRepository(Residence::class)->findAll();

        $testimonials = $em->getRepository(Temoignage::class)->findAll();

        $actu = $em->getRepository(Article::class)->findOneActu();
        $event = $em->getRepository(Evenement::class)->findOneEvent();


        // Recuperation de la liste des villes dans lesqulles se trouvent les residences
        $villes = $em->getRepository(Ville::class)->findAll();

        // Fin recuperation des villes
        $simpleSearch = $this->createForm('MyOrleansBundle\Form\SimpleSearchType',
            null,
            ['action' => $this->generateUrl('nosbiens')]);


        return $this->render('MyOrleansBundle::index.html.twig', [
            'parcours' => $parcours,
            'simpleSearch' => $simpleSearch->createView(),
            'villes'=> $villes,
            'collaborateurs' => $collaborateurs,
            'residenceFav' => $residenceFav,
            'residenceTwoFav' => $residenceTwoFav,
            'residenceAll' => $residenceAll,
            'actu' => $actu,
            'event' => $event,
            'testimonials' => $testimonials
        ]);
    }

    /*-----------------------------------------------*/

    /**
     * @Route("/nos-services", name="nosservices")
     */
    public function nosservices()
    {
        $em = $this->getDoctrine()->getManager();
        $services = $em->getRepository(Service::class)->findAll();
        $packs = $em->getRepository(Pack::class)->findAll();
        $temoignages = $em->getRepository(Temoignage::class)->findAll();
        return $this->render('MyOrleansBundle::nosservices.html.twig', [
            'services' => $services,
            'packs' => $packs,
            'temoignages' => $temoignages
        ]);
    }
    /**
     * @Route("/immopratique", name="immopratique")
     */
    public function immopratique()
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository(Article::class)->findAll();

        // TMP
        //$articlesImmo[] = $articles[0];
        //$articlesImmo[] = $articles[1];
        // TMP

        return $this->render('MyOrleansBundle::immopratique.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/residences", name="residences")
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
     * @Route("/parcours-immobilier", name="parcoursimmo")
     */
    public function parcoursImmoAction()
    {
        $parcours = null;
        if (isset($_SESSION)) {
            $parcours = $_SESSION['parcours'];
        }

        return $this->render('MyOrleansBundle::parcoursimmo.html.twig', [
            'parcours' => $parcours
        ]);
    }


    /**
     * @Route("/admin")
     */
    public function admin()
    {
        return $this->render('MyOrleansBundle::admin.html.twig');
    }


}
