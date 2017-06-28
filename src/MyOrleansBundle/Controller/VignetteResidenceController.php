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
    public function affichageResidenceAction(Residence $residence, CalculateurCaracteristiquesResidence $calculateur)
    {
        //recuperation des caracteristiques de chaque residence
        $prixMin = $calculateur->calculPrix($residence);
        $flatsDispo = $calculateur->calculFlatDispo($residence);
        $typeMinMax = $calculateur->calculSizes($residence);

        // Fin recup caracteristiques

        return $this->render('MyOrleansBundle::affichage_residence.html.twig', [
                'residence' => $residence,
                'prixMin' => $prixMin,
                'flatsDispo' => $flatsDispo,
                'typeMin' => $typeMinMax[0],
                'typeMax' => $typeMinMax[1]
        ]);

    }


    /**
     * @param $id
     * @param CalculateurCaracteristiquesResidence $calculateur
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/vignette-residence-simplifie/{id}", name="vignette-residence-simplifie")
     */
    public function affichageResidenceSimplifieAction(Residence $residence, CalculateurCaracteristiquesResidence $calculateur)
    {
        //recuperation des caracteristiques de chaque residence
        $prixMin = $calculateur->calculPrix($residence);

        // Fin recup caracteristiques

        return $this->render('MyOrleansBundle:blog:blog_affichage_residence.html.twig', [
            'residence' => $residence,
            'prixMin' => $prixMin,
        ]);

    }

}