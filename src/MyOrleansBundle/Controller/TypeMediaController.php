<?php

namespace MyOrleansBundle\Controller;

use MyOrleansBundle\Entity\TypeMedia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Typemedia controller.
 *
 * @Route("admin/typemedia")
 */
class TypeMediaController extends Controller
{
    /**
     * Lists all typeMedia entities.
     *
     * @Route("/", name="admin_typemedia_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $typeMedia = $em->getRepository('MyOrleansBundle:TypeMedia')->findAll();

        return $this->render('typemedia/index.html.twig', array(
            'typeMedia' => $typeMedia,
        ));
    }

    /**
     * Creates a new typeMedia entity.
     *
     * @Route("/new", name="admin_typemedia_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $typeMedia = new Typemedia();
        $form = $this->createForm('MyOrleansBundle\Form\TypeMediaType', $typeMedia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeMedia);
            $em->flush();

            return $this->redirectToRoute('admin_typemedia_show', array('id' => $typeMedia->getId()));
        }

        return $this->render('typemedia/new.html.twig', array(
            'typeMedia' => $typeMedia,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a typeMedia entity.
     *
     * @Route("/{id}", name="admin_typemedia_show")
     * @Method("GET")
     */
    public function showAction(TypeMedia $typeMedia)
    {
        $deleteForm = $this->createDeleteForm($typeMedia);

        return $this->render('typemedia/show.html.twig', array(
            'typeMedia' => $typeMedia,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing typeMedia entity.
     *
     * @Route("/{id}/edit", name="admin_typemedia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TypeMedia $typeMedia)
    {
        $deleteForm = $this->createDeleteForm($typeMedia);
        $editForm = $this->createForm('MyOrleansBundle\Form\TypeMediaType', $typeMedia);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_typemedia_edit', array('id' => $typeMedia->getId()));
        }

        return $this->render('typemedia/edit.html.twig', array(
            'typeMedia' => $typeMedia,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a typeMedia entity.
     *
     * @Route("/{id}", name="admin_typemedia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TypeMedia $typeMedia)
    {
        $form = $this->createDeleteForm($typeMedia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typeMedia);
            $em->flush();
        }

        return $this->redirectToRoute('admin_typemedia_index');
    }

    /**
     * Creates a form to delete a typeMedia entity.
     *
     * @param TypeMedia $typeMedia The typeMedia entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TypeMedia $typeMedia)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_typemedia_delete', array('id' => $typeMedia->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
