<?php

namespace MyOrleansBundle\Controller\admin;

use MyOrleansBundle\Entity\Flat;
use MyOrleansBundle\Entity\Media;
use MyOrleansBundle\Form\FlatType;
use MyOrleansBundle\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Flat controller.
 *
 * @Route("admin/flat")
 */
class FlatController extends Controller
{
    /**
     * Lists all flat entities.
     *
     * @Route("/", name="admin_flat_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $flats = $em->getRepository('MyOrleansBundle:Flat')->findAll();

        return $this->render('flat/index.html.twig', array(
            'flats' => $flats,
        ));
    }

    /**
     * Creates a new flat entity.
     *
     * @Route("/new", name="admin_flat_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, FileUploader $fileUploader)
    {
        $flat = new Flat();
        $media = new Media();
        $flat->getMedias()->add($media);
        $form = $this->createForm(FlatType::class, $flat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $medias = $flat->getMedias();

            foreach ($medias as $media) {
                $file = $media->getLien();
                $filename = $fileUploader->upload($file);
                $media->setLien($filename);
                $media->setFlats([$flat]);
            }
            $em->persist($flat);
            $em->flush();

            return $this->redirectToRoute('admin_flat_show', array('id' => $flat->getId()));
        }

        return $this->render('flat/new.html.twig', array(
            'flat' => $flat,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a flat entity.
     *
     * @Route("/{id}", name="admin_flat_show")
     * @Method("GET")
     */
    public function showAction(Flat $flat)
    {
        $deleteForm = $this->createDeleteForm($flat);

        return $this->render('flat/show.html.twig', array(
            'flat' => $flat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing flat entity.
     *
     * @Route("/{id}/edit", name="admin_flat_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Flat $flat, FileUploader $fileUploader)
    {
        $deleteForm = $this->createDeleteForm($flat);
        if (!empty($flat->getMedias())) {
            $media = new Media();
            $flat->getMedias()->add($media);
        }
        $editForm = $this->createForm('MyOrleansBundle\Form\FlatType', $flat);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $flat = $editForm->getData();
            $medias = $flat->getMedias();
            foreach ($medias as $media) {
                $file = $media->getLien();
                if ($file) {
                    $filename = $fileUploader->upload($file);
                    $media->setLien($filename);
                    $media->setFlats([$flat]);
                }
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_flat_edit', array('id' => $flat->getId()));
        }

        return $this->render('flat/edit.html.twig', array(
            'flat' => $flat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a flat entity.
     *
     * @Route("/{id}", name="admin_flat_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Flat $flat)
    {
        $form = $this->createDeleteForm($flat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($flat);
            $em->flush();
        }

        return $this->redirectToRoute('admin_flat_index');
    }

    /**
     * Deletes a flat media.
     *
     * @Route("/{id}/delete_media/{media_id}", name="flat_media_delete")
     * @ParamConverter("flat", class="MyOrleansBundle:Flat", options={"id" = "id"})
     * @ParamConverter("media", class="MyOrleansBundle:Media", options={"id" = "media_id"})
     * @Method({"GET", "POST"})
     */
    public function deleteMedia(Flat $flat, Media $media)
    {
        $em = $this->getDoctrine()->getManager();

        $path = $media->getLien();
        unlink($this->getParameter('upload_directory') . '/' . $path);
        $flat->removeMedia($media);
        $em->remove($media);

        $em->flush();
        return $this->redirectToRoute('admin_flat_edit', array('id' => $flat->getId()));
    }

    /**
     * Creates a form to delete a flat entity.
     *
     * @param Flat $flat The flat entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Flat $flat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_flat_delete', array('id' => $flat->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
