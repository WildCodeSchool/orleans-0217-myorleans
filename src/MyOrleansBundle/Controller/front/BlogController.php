<?php
/**
 * Created by PhpStorm.
 * User: wilder3
 * Date: 31/05/17
 * Time: 11:32
 */

namespace MyOrleansBundle\Controller\front;


use MyOrleansBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use MyOrleansBundle\Repository\ArticleRepository;

class BlogController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/blog", name="home-blog")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository(Article::class)->findNineLastArticles();

        return $this->render('MyOrleansBundle:blog:blog_home.html.twig', [
                                'articles' => $articles
        ]);
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