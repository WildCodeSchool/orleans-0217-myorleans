<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 03/07/17
 * Time: 17:01
 */

namespace MyOrleansBundle\Controller\front;


use MyOrleansBundle\Entity\Flat;
use MyOrleansBundle\Entity\Residence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PdfController extends Controller
{
    /**
     * Retrun a pdf file from a flat.
     * @return Response
     * @Route("/pdf/flat/{id}", name="flat_pdf")
     * @Method("GET")
     */
    public function pdfFlatAction(Flat $flat, SessionInterface $session)
    {
        $parcours = null;
        if ($session->has('parcours')) {
            $parcours = $session->get('parcours');
        }


        $mappy = $this->get("knp_snappy.pdf");
        $html = $this->renderView('MyOrleansBundle::pdf_appartement.html.twig', array(
            'Flat' => $flat,
            'parcours'=>$parcours
        ));

        $filename = "appartement-".$flat->getReference().".pdf";

        return new Response(
            $mappy->getOutputFromHtml($html),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            ]);

}
    /**
     * Retrun a pdf file from a residence.
     * @return Response
     * @Route("/pdf/residence/{id}", name="residence_pdf")
     * @Method("GET")
     */
    public function pdfResidenceAction(Residence $residence, SessionInterface $session)
    {
        $parcours = null;
        if ($session->has('parcours')) {
            $parcours = $session->get('parcours');
        }


        $mappy = $this->get("knp_snappy.pdf");
        $html = $this->renderView('MyOrleansBundle::pdf_residence.html.twig', array(
            'Residence' => $residence,
            'parcours'=>$parcours
        ));

        $filename = "residence-".$residence->getNom().".pdf";

        return new Response(
            $mappy->getOutputFromHtml($html),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            ]);

    }
}