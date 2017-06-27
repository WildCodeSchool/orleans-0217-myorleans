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
     * @Route("/blog/{idArticle}", name="blog-article")
     */
    public function afficherArticleAction($idArticle)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository(Article::class)->find($idArticle);

        $residence = $article->getResidence();

        //Recuperation des tags de l'article et selection du premier tag
        $tags = $article->getTags();
        foreach ($tags as $tag) {
            $nomTag[] = $tag->getNom();
        }
        $tag = $nomTag[0];
        //Fin recuperation du tag

        $articlesAssocies = $em->getRepository(Article::class)->articleByTag($tag, 2);

        return $this->render('MyOrleansBundle:blog:blog_article.html.twig',[
                'article' => $article,
                'residence' => $residence,
                'articlesAssocies' => $articlesAssocies
        ]);
    }

}