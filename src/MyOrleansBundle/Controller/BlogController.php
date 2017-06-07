<?php
/**
 * Created by PhpStorm.
 * User: wilder3
 * Date: 31/05/17
 * Time: 11:32
 */

namespace MyOrleansBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/blog", name="home-blog")
     */
    public function indexAction()
    {
        return $this->render('MyOrleansBundle:blog:blog_home.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/blog/article", name="")
     */
    public function afficherArticleAction()
    {
        return $this->render('MyOrleansBundle:blog:blog_article.html.twig');
    }

}