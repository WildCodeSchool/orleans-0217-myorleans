<?php
/**
 * Created by PhpStorm.
 * User: jean-baptiste
 * Date: 15/06/17
 * Time: 10:48
 */

namespace MyOrleansBundle\Controller\front;
use MyOrleansBundle\Entity\Client;
use MyOrleansBundle\Entity\Media;
use MyOrleansBundle\Form\FormulaireType;
use MyOrleansBundle\MyOrleansBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyOrleansBundle\Entity\Pack;
use MyOrleansBundle\Entity\Service;
use MyOrleansBundle\Entity\Temoignage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;



class NosServicesController extends Controller
{

    /**
     * @Route("/nos-services", name="nosservices")
     */
    public function nosservices(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $formulaire = $this->createForm('MyOrleansBundle\Form\FormulaireType');
        $formulaire->handleRequest($request);

        $client = new Client();
        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute('nosservices');
        }

        $services = $em->getRepository(Service::class)->findAll();
        $packs = $em->getRepository(Pack::class)->findAll();
        $temoignages = $em->getRepository(Temoignage::class)->findAll();
        return $this->render('MyOrleansBundle::nosservices.html.twig', [
            'services' => $services,
            'packs' => $packs,
            'temoignages' => $temoignages,
            'form'=>$formulaire->createView()

        ]);
    }

}



