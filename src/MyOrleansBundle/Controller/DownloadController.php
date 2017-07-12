<?php
/**
 * Created by PhpStorm.
 * User: wilder3
 * Date: 11/07/17
 * Time: 17:52
 */

namespace MyOrleansBundle\Controller;


use MyOrleansBundle\Entity\FileArticle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;
use MyOrleansBundle\Entity\Article;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

class DownloadController extends Controller
{
    /**
     * @param Article $article
     * @Route("/download/{id}", name="download")
     */
    public function downloadAction(Article $article)
    {
        $em = $this->getDoctrine()->getManager();
        $fileArticles = $em->getRepository(FileArticle::class)->findBy(['article' => $article], ['id'=>'ASC'], 1, 0);

        if (!empty($fileArticles)) {
            $fileArticle = $fileArticles[0];
        }

        $link = $fileArticle->getName();
        $path = $this->get('kernel')->getRootDir(). "/../web/uploads/documents/";
        $content = $path.$link;

        $response = new BinaryFileResponse($content);

        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $link);

        return $response;
    }

}