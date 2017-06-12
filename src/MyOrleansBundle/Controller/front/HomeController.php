<?php

namespace MyOrleansBundle\Controller\front;

use MyOrleansBundle\Entity\Article;
use MyOrleansBundle\Entity\Pack;
use MyOrleansBundle\Entity\Service;
use MyOrleansBundle\Entity\Temoignage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {

        return $this->render('MyOrleansBundle::index.html.twig');

    }

    /**
     * @Route("/nos-biens", name="nosbiens")
     */
    public function nosBiensAction()
    {
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

        return $this->render('MyOrleansBundle::immopratique.html.twig',[

        'articles'=>$articles
        ]);
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
