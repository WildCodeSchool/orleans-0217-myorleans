<?php
/**
 * Created by PhpStorm.
 * User: wilder3
 * Date: 28/06/17
 * Time: 17:48
 */

namespace MyOrleansBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



class ProfilController extends Controller
{
    /**
     * @param $profil
     * @param SessionInterface $session
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/parcours/{profil}/{route}", name="parcours")
     */
    public function parametrerProfilAction($profil, $route, SessionInterface $session)
    {
        $session->set('parcours', $profil);

        return $this->redirectToRoute($route);
    }

}