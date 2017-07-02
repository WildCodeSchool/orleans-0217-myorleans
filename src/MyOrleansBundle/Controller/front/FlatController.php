<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 02/07/17
 * Time: 14:48
 */

namespace MyOrleansBundle\Controller\front;


use MyOrleansBundle\Entity\Flat;
use MyOrleansBundle\Service\AutocompleteGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyOrleansBundle\Entity\Residence;

class FlatController extends Controller
{
    /**
     * @Route("/appartement/{id}")
     */
    public function flat($id)
    {
        $em = $this->getDoctrine()->getManager();
        $flat = $em->getRepository(Flat::class)->find($id);
        $residence = $em->getRepository(Residence::class)->find($id);
        /*        $prestas = $em->getRepository(Presta::class)->findAll();
                $typePrestas = $em->getRepository(TypePresta::class)->findAll();
                $categoriePrestas = $em->getRepository(CategoriePresta::class)->findAll();*/
        return $this->render('MyOrleansBundle::appartement.html.twig',[
            'flat'=>$flat,
            'residence'=>$residence,
            /*            'prestas'=>$prestas,
                        'typePrestas'=>$typePrestas,
                        'categoriePrestas'=>$categoriePrestas,*/
        ]);
    }
}