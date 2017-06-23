<?php
/**
 * Created by PhpStorm.
 * User: wilder3
 * Date: 20/06/17
 * Time: 11:39
 */

namespace MyOrleansBundle\Controller;


use MyOrleansBundle\Entity\Residence;
use MyOrleansBundle\Service\CalculateurCaracteristiquesResidence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class VignetteResidenceController extends Controller
{

    /**
     * @param $id
     * @param CalculateurCaracteristiquesResidence $calculateur
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/vignette-residence/{id}", name="vignette-residence")
     */
    public function affichageResidenceAction($id, CalculateurCaracteristiquesResidence $calculateur)
    {
        $em = $this->getDoctrine()->getManager();

        // recuperation de la residence par son id
        $residence = $em->getRepository(Residence::class)->find($id);

        //recuperation des caracteristiques de chaque residence
        $prixMin = $calculateur->calculPrix($residence);
        $flatsDispo = $calculateur->calculFlatDispo($residence);
        $typeMinMax = $calculateur->calculSizes($residence);

        $typeMin = $typeMinMax[0];
        $typeMax = $typeMinMax[1];
        // Fin recup caracteristiques

        return $this->render('MyOrleansBundle::affichage_residence.html.twig', [
            'residence' => $residence,
            'prixMin' => $prixMin,
            'flatsDispo' => $flatsDispo,
            'typeMin' => $typeMin,
            'typeMax' => $typeMax
        ]);

    }

}