<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 02/07/17
 * Time: 14:48
 */

namespace MyOrleansBundle\Controller\front;


use MyOrleansBundle\Entity\Article;
use MyOrleansBundle\Entity\CategoriePresta;
use MyOrleansBundle\Entity\Flat;
use MyOrleansBundle\Entity\Media;
use MyOrleansBundle\Entity\Pack;
use MyOrleansBundle\Entity\Service;
use MyOrleansBundle\Entity\Temoignage;
use MyOrleansBundle\Entity\Residence;
use MyOrleansBundle\Entity\TypePresta;
use MyOrleansBundle\Entity\Ville;
use MyOrleansBundle\Entity\Collaborateur;
use MyOrleansBundle\Entity\Evenement;
use MyOrleansBundle\Form\SimpleSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

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