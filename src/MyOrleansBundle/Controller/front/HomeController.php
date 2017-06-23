<?php

namespace MyOrleansBundle\Controller\front;


use MyOrleansBundle\Entity\Article;
use MyOrleansBundle\Entity\Pack;
use MyOrleansBundle\Entity\Service;
use MyOrleansBundle\Entity\Temoignage;
use MyOrleansBundle\Entity\Residence;
use MyOrleansBundle\Entity\Flat;
use MyOrleansBundle\Form\SimpleSearchType;
use MyOrleansBundle\Service\AutocompleteGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request, AutocompleteGenerator $generator)
    {
        $em = $this->getDoctrine()->getManager();

        // Recuperation de la liste des villes dans lesqulles se trouvent les residences
        $residences = $em->getRepository(Residence::class)->findAll();
        $villes = $generator->findVilles($residences);

        // Fin recuperation des villes

        $simpleSearch = $this->createForm('MyOrleansBundle\Form\SimpleSearchType',
                                            null,
                                            ['action' => $this->generateUrl('nosbiens')]);

        return $this->render('MyOrleansBundle::index.html.twig', [
            'simpleSearch' => $simpleSearch->createView(),
            'villes' => $villes
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
        $temoignages =$em->getRepository(Temoignage::class)->findAll();
        return $this->render('MyOrleansBundle::nosservices.html.twig',[
            'services'=>$services,
            'packs'=>$packs,
            'temoignages'=>$temoignages
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
        $articlesImmo[] = $articles[0];
        $articlesImmo[] = $articles[1];
        // TMP

        return $this->render('MyOrleansBundle::immopratique.html.twig',[

        'articles'=>$articlesImmo
        ]);
    }


    /**
     * @Route("/parcours-immobilier", name="parcoursimmo")
     */
    public function parcoursImmoAction()
    {
        return $this->render('MyOrleansBundle::parcoursimmo.html.twig');
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
     * @Route("/admin")
     */
    public function admin()
    {
        return $this->render('MyOrleansBundle::admin.html.twig');
    }




}
