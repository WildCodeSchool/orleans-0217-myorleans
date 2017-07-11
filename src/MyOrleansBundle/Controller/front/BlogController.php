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
     * @Route("/blog/{slug}", name="blog-article")
     */
    public function afficherArticleAction(Article $article)
    {
        $residence = $article->getResidence();
        $titre = $article->getTitre();

        //Recuperation des tags de l'article et selection du premier tag
        $tags = $article->getTags();
        $tag = $tags[0]->getNom();

        //Fin recuperation du tag
        $em = $this->getDoctrine()->getManager();
        $articlesAssocies = $em->getRepository(Article::class)->articleByTag($tag, 2);

        $url = $this->generateUrl('blog-article',
            [ 'slug' => $titre]);

        return $this->render('MyOrleansBundle:blog:blog_article.html.twig',[
                'article' => $article,
                'residence' => $residence,
                'slug' => $titre,
                'articlesAssocies' => $articlesAssocies
        ]);
    }

}