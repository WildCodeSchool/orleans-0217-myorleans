<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 02/07/17
 * Time: 14:47
 */

namespace MyOrleansBundle\Controller\front;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ResidencesConstroller extends Controller
{
    /**
     * @Route("/residences", name="residences")
     */
    public function residence()
    {
        return $this->render('MyOrleansBundle::residence.html.twig');
    }
}