<?php
/**
 * Created by PhpStorm.
 * User: jean-baptiste
 * Date: 10/07/17
 * Time: 11:38
 */

namespace MyOrleansBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FormulaireController
{

    /**
     * @Route("/form", name="form")
     */
    public function FormulaireAction()
    {

        return $this->render('MyOrleansBundle::Formulaire.html.twig');
    }
}