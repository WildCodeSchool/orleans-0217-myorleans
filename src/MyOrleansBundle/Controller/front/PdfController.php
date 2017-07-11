<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 03/07/17
 * Time: 17:01
 */

namespace MyOrleansBundle\Controller\front;


use MyOrleansBundle\Entity\Flat;
use MyOrleansBundle\Entity\Media;
use MyOrleansBundle\Entity\Residence;
use MyOrleansBundle\Entity\TypeBien;
use MyOrleansBundle\Entity\TypeLogement;
use MyOrleansBundle\Service\CalculateurCaracteristiquesResidence;
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
    public function pdfFlatAction(Flat $flat, SessionInterface $session, Request $request, CalculateurCaracteristiquesResidence $calculateur)
    {
        $parcours = null;
        if ($session->has('parcours')) {
            $parcours = $session->get('parcours');
        }
        $em = $this->getDoctrine()->getManager();
        $residence = $flat->getResidence();
        $typelogment = $em->getRepository(TypeLogement::class)->findAll();
        $type_t1 = $this->getParameter('typeLogementT1');
        $type_t2 = $this->getParameter('typeLogementT2');
        $type_t3 = $this->getParameter('typeLogementT3');
        $type_t4 = $this->getParameter('typeLogementT4');
        $prixMin = $calculateur->calculPrix($residence);
        $flatsDispo = $calculateur->calculFlatDispo($residence);
        $typeMinMax = $calculateur->calculSizes($residence);
        $mailagence = $this->getParameter('mail_agence');
        $telephoneNumber = $this->getParameter('telephone_number');
        $mappy = $this->get("knp_snappy.pdf");
        $html = $this->renderView('MyOrleansBundle::pdf_appartement.html.twig', array(
            'residence' => $residence,
            'prixMin' => $prixMin,
            'flatsDispo' => $flatsDispo,
            'typeMin' => $typeMinMax[0],
            'typeMax' => $typeMinMax[1],
            'type_logement'=>$typelogment,
            'typeLogementT1' => $type_t1,
            'typeLogementT2' => $type_t2,
            'typeLogementT3' => $type_t3,
            'typeLogementT4' => $type_t4,
            'parcours' => $parcours,
            'telephone_number' => $telephoneNumber,
            'mail_agence'=>$mailagence,


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
    public function pdfResidenceAction(Residence $residence, SessionInterface $session, CalculateurCaracteristiquesResidence $calculateur)
    {
        $parcours = null;
        if ($session->has('parcours')) {
            $parcours = $session->get('parcours');
        }
        $em = $this->getDoctrine()->getManager();
        $flats = $em->getRepository(Flat::class)->findByResidence($residence);
        $typelogment = $em->getRepository(TypeLogement::class)->findAll();
        $typebien = $em->getRepository(TypeBien::class)->findAll();
        $type_t1 = $this->getParameter('typeLogementT1');
        $type_t2 = $this->getParameter('typeLogementT2');
        $type_t3 = $this->getParameter('typeLogementT3');
        $type_t4 = $this->getParameter('typeLogementT4');
        $prixMin = $calculateur->calculPrix($residence);
        $flatsDispo = $calculateur->calculFlatDispo($residence);
        $typeMinMax = $calculateur->calculSizes($residence);
        $mailagence = $this->getParameter('mail_agence');
        $googlemapstatickey = $this->getParameter('googlemap_static_map_key');
        $telephoneNumber = $this->getParameter('telephone_number');
        $mappy = $this->get("knp_snappy.pdf");
        $html = $this->renderView('MyOrleansBundle::pdf_residence.html.twig', array(
            'flats' => $flats,
            'prixMin' => $prixMin,
            'flatsDispo' => $flatsDispo,
            'typeMin' => $typeMinMax[0],
            'typeMax' => $typeMinMax[1],
            'type_logement'=>$typelogment,
            'type_bien'=>$typebien,
            'typeLogementT1' => $type_t1,
            'typeLogementT2' => $type_t2,
            'typeLogementT3' => $type_t3,
            'typeLogementT4' => $type_t4,
            'parcours'=>$parcours,
            'telephone_number' => $telephoneNumber,
            'mail_agence'=>$mailagence,
            'googlemap_static_map_key'=>$googlemapstatickey,

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