<?php

namespace MyOrleansBundle\Controller\front;


use MyOrleansBundle\Entity\Article;
use MyOrleansBundle\Entity\Collaborateur;
use MyOrleansBundle\Entity\Evenement;
use MyOrleansBundle\Entity\Pack;
use MyOrleansBundle\Entity\Service;
use MyOrleansBundle\Entity\Temoignage;

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

        $collaborateurs = $em->getRepository(Collaborateur::class)->findAll();

        $residenceFav = $em->getRepository(Residence::class)->findOneFav();
        $residenceTwoFav = $em->getRepository(Residence::class)->findTwoFav();
        $residenceAll = $em->getRepository(Residence::class)->findAll();

        $actu = $em->getRepository(Article::class)->findOneActu();
        $event = $em->getRepository(Evenement::class)->findOneEvent();

        $residence = new Residence();
        $simpleSearch = $this->createForm('MyOrleansBundle\Form\SimpleSearchType', $residence);
        $simpleSearch->handleRequest($request);
        if ($simpleSearch->isSubmitted() && $simpleSearch->isValid()) {
            $data = $simpleSearch->getData();
            $ville = $data['ville'];

            $residences = $em->getRepository(Residence::class)->searchByVille($ville);


            if ($residence == null) {
                $residence = $em->getRepository(Residence::class)->findAll();
            }
            return $this->render('MyOrleansBundle::nos-biens.html.twig', [
                'residences' => $residences
            ]);
        } else {
            return $this->render('MyOrleansBundle::index.html.twig', [
                'simpleSearch' => $simpleSearch->createView(),
                'collaborateurs' => $collaborateurs,
                'residenceFav' => $residenceFav,
                'residenceTwoFav' => $residenceTwoFav,
                'residenceAll' => $residenceAll,
                'actu' => $actu,
                'event' =>$event
            ]);
        }


    }

    /**
     * @Route("/nos-biens", name="nosbiens")
     */
    public function nosBiensAction()
    {
        $em = $this->getDoctrine()->getManager();

        return $this->render('MyOrleansBundle::nosbiens.html.twig');
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
     * @Route("/admin")
     */
    public function admin()
    {
        return $this->render('MyOrleansBundle::admin.html.twig');
    }


}
