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
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use MyOrleansBundle\Repository\ArticleRepository;

class BlogController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/blog", name="homeblog")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository(Article::class)->findLatestArticles();

        return $this->render('MyOrleansBundle:blog:blog_home.html.twig', [
                    'articles' => $articles
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/blog/article", name="blog-article")
     */
    public function afficherArticleAction($idArticle)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository(Article::class)->find($idArticle);

        $tags = $article->getTags();

        $articlesAssocies = $tags->getArticles();
        $articleAssocie = $articlesAssocies[0];
        var_dump($articleAssocie);
        die();

        return $this->render('MyOrleansBundle:blog:blog_article.html.twig',[
                'article' => $article,
                'articleAssocie' => $articleAssocie
        ]);
    }

}