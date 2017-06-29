<?php
/**
 * Created by PhpStorm.
 * User: jean-baptiste
 * Date: 15/06/17
 * Time: 10:48
 */

namespace MyOrleansBundle\Controller\front;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyOrleansBundle\Entity\Pack;
use MyOrleansBundle\Entity\Service;
use MyOrleansBundle\Entity\Temoignage;


class NosServicesController extends Controller
{

    /**
     * @Route("/nos-services", name="nosservices")
     */
    public function nosservices()
    {
        $parcours = null;
        if (isset($_SESSION)) {
            $parcours = $_SESSION['parcours'];
        }

        $em = $this->getDoctrine()->getManager();
        $services = $em->getRepository(Service::class)->findAll();
        $packs = $em->getRepository(Pack::class)->findAll();
        $temoignages =$em->getRepository(Temoignage::class)->findAll();
        return $this->render('MyOrleansBundle::nosservices.html.twig',[
            'parcours' => $parcours,
            'services'=>$services,
            'packs'=>$packs,
            'temoignages'=>$temoignages
        ]);

    }

    public function formulaire()
    {
        $alert = '';
        if (isset($_POST['mail'])) {
            $send = new MailController();
            if (0 == $send->Send($_POST, $this->expediteur)) {
                $alert = 2;
            } else {
                $alert = 1;
            };
        }
        return $this->getTwig()->render('nosservices.html.twig', array('alert' => $alert));
    }
}