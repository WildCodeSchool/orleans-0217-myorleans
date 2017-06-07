<?php
/**
 * Created by PhpStorm.
 * User: HaGii
 * Date: 07/06/2017
 * Time: 10:15
 */

namespace MyOrleansBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin_home")
     */
    public function indexAction()
    {

        return $this->render('index_admin.html.twig');

    }
}