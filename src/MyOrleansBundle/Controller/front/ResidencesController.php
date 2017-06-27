<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 27/06/17
 * Time: 11:52
 */

namespace MyOrleansBundle\Controller\front;


use MyOrleansBundle\Entity\CategoriePresta;
use MyOrleansBundle\Entity\Presta;
use MyOrleansBundle\Entity\Residence;
use MyOrleansBundle\Entity\TypePresta;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ResidencesController extends Controller
{
    /**
     * @Route("/residences/{id}")
     */
    public function residence($id)
    {
        $em = $this->getDoctrine()->getManager();
        $residence = $em->getRepository(Residence::class)->find($id);
        /*        $media = $em->getRepository(Media::class)->find($id);*/

        $count = 0;
        foreach ($flats as $flat){
            if ($flat->getStatut() == 'DISPONIBLE'){
                $count++;
            }
        }

        $flats = $residence->getFlats();
        $prestas = $em->getRepository(Presta::class)->findAll();
        $typePrestas = $em->getRepository(TypePresta::class)->findAll();
        $categoriePrestas = $em->getRepository(CategoriePresta::class)->findAll();
        return $this->render('MyOrleansBundle::residence.html.twig',[
            'residence'=>$residence,
            'flats'=>$flats,
            'count' => $count,
            'media' => $media,
            'prestas'=>$prestas,
            'typePrestas'=>$typePrestas,
            'categoriePrestas'=>$categoriePrestas,
        ]);




    }
}