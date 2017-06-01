<?php

namespace MyOrleansBundle\Controller;

use MyOrleansBundle\Entity\Media;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Medium controller.
 *
 * @Route("media")
 */
class MediaController extends Controller
{
    /**
     * Lists all medium entities.
     *
     * @Route("/", name="media_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $media = $em->getRepository('MyOrleansBundle:Media')->findAll();

        return $this->render('media/index.html.twig', array(
            'media' => $media,
        ));
    }

    /**
     * Creates a new medium entity.
     *
     * @Route("/new", name="media_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $medium = new Medium();
        $form = $this->createForm('MyOrleansBundle\Form\MediaType', $medium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($medium);
            $em->flush();

            return $this->redirectToRoute('media_show', array('id' => $medium->getId()));
        }

        return $this->render('media/new.html.twig', array(
            'medium' => $medium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a medium entity.
     *
     * @Route("/{id}", name="media_show")
     * @Method("GET")
     */
    public function showAction(Media $medium)
    {
        $deleteForm = $this->createDeleteForm($medium);

        return $this->render('media/show.html.twig', array(
            'medium' => $medium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing medium entity.
     *
     * @Route("/{id}/edit", name="media_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Media $medium)
    {
        $deleteForm = $this->createDeleteForm($medium);
        $editForm = $this->createForm('MyOrleansBundle\Form\MediaType', $medium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('media_edit', array('id' => $medium->getId()));
        }

        return $this->render('media/edit.html.twig', array(
            'medium' => $medium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a medium entity.
     *
     * @Route("/{id}", name="media_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Media $medium)
    {
        $form = $this->createDeleteForm($medium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($medium);
            $em->flush();
        }

        return $this->redirectToRoute('media_index');
    }

    /**
     * Creates a form to delete a medium entity.
     *
     * @param Media $medium The medium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Media $medium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('media_delete', array('id' => $medium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
