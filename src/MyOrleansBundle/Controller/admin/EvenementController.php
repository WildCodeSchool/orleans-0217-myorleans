<?php

namespace MyOrleansBundle\Controller\admin;

use MyOrleansBundle\Entity\Evenement;
use MyOrleansBundle\Entity\Media;
use MyOrleansBundle\Form\EvenementType;
use MyOrleansBundle\Form\MediaType;
use MyOrleansBundle\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Evenement controller.
 *
 * @Route("admin/evenement")
 */
class EvenementController extends Controller
{
    /**
     * Lists all evenement entities.
     *
     * @Route("/", name="admin_evenement_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $evenements = $em->getRepository('MyOrleansBundle:Evenement')->findAll();

        return $this->render('evenement/index.html.twig', array(
            'evenements' => $evenements,
        ));
    }

    /**
     * Creates a new evenement entity.
     *
     * @Route("/new", name="admin_evenement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, FileUploader $fileUploader)
    {
        $evenement = new Evenement();
        $media = new Media();
        $evenement->getMedias()->add($media);
        $form = $this->createForm('MyOrleansBundle\Form\EvenementType', $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $medias = $evenement->getMedias();

            foreach ($medias as $media) {
                $file = $media->getLien();
                $filename = $fileUploader->upload($file);
                $media->setLien($filename);
                $media->setEvenement($evenement);
            }
            $em->persist($evenement);
            $em->flush();

            return $this->redirectToRoute('admin_evenement_show', array('id' => $evenement->getId()));
        }

        return $this->render('evenement/new.html.twig', array(
            'evenement' => $evenement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a evenement entity.
     *
     * @Route("/{id}", name="admin_evenement_show")
     * @Method("GET")
     */
    public function showAction(Evenement $evenement)
    {
        $deleteForm = $this->createDeleteForm($evenement);

        return $this->render('evenement/show.html.twig', array(
            'evenement' => $evenement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing evenement entity.
     *
     * @Route("/{id}/edit", name="admin_evenement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Evenement $evenement, FileUploader $fileUploader)
    {
        $deleteForm = $this->createDeleteForm($evenement);
        if (count($evenement->getMedias()) == 0) {
            $media = new Media();
            $evenement->getMedias()->add($media);
        }
        $editForm = $this->createForm(EvenementType::class, $evenement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $evenement = $editForm->getData();
            $medias = $evenement->getMedias();
            foreach ($medias as $media) {
                $file = $media->getLien();

                if ($file) {
                    $filename = $fileUploader->upload($file);
                    $media->setLien($filename);
                    $media->setEvenement($evenement);
                }
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_evenement_show', array('id' => $evenement->getId()));
        }
        return $this->render('evenement/edit.html.twig', array(
            'evenement' => $evenement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Deletes a evenement entity.
     *
     * @Route("/{id}", name="admin_evenement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Evenement $evenement)
    {
        $form = $this->createDeleteForm($evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($evenement);
            $em->flush();
        }

        return $this->redirectToRoute('admin_evenement_index');
    }


    /**
     * Deletes a evenement media.
     *
     * @Route("/{id}/delete_media", name="evenement_media_delete")
     * @Method({"GET", "POST"})
     */
    public function deleteMedia(Media $media)
    {
        $evenement = $media->getEvenement();
        $em = $this->getDoctrine()->getManager();

        $path = $media->getLien();
        unlink($this->getParameter('upload_directory') . '/' . $path);
        $evenement->removeMedia($media);
        $em->remove($media);

        $em->flush();
        return $this->redirectToRoute('admin_evenement_edit', array('id' => $evenement->getId()));
    }

    /**
     * Creates a form to delete a evenement entity.
     *
     * @param Evenement $evenement The evenement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Evenement $evenement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_evenement_delete', array('id' => $evenement->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
