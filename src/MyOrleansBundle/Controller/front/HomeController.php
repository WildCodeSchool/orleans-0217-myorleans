<?php

namespace MyOrleansBundle\Controller\front;


use MyOrleansBundle\Entity\Article;
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
        $residence = new Residence();
        $simpleSearch = $this->createForm('MyOrleansBundle\Form\SimpleSearchType', $residence);
        $simpleSearch->handleRequest($request);
        if ($simpleSearch->isSubmitted() && $simpleSearch->isValid()) {
            $data = $simpleSearch->getData();
            $ville = $data['ville'];

            $residences = $em -> getRepository(Residence::class)->searchByVille($ville);


            if($residence == null){
                $residence = $em -> getRepository(Residence::class)->findAll();
            }
            return $this->render('MyOrleansBundle::nos-biens.html.twig',[
                'residences' => $residences
            ]);
        }else{
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
        $em=$this->getDoctrine()->getManager();

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
