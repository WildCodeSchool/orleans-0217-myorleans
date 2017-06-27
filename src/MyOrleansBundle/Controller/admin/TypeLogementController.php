<?php

namespace MyOrleansBundle\Controller\admin;

use MyOrleansBundle\Entity\TypeLogement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Typelogement controller.
 *
 * @Route("admin/typelogement")
 */
class TypeLogementController extends Controller
{
    /**
     * Lists all typeLogement entities.
     *
     * @Route("/", name="admin_typelogement_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $typeLogements = $em->getRepository('MyOrleansBundle:TypeLogement')->findAll();

        return $this->render('typelogement/index.html.twig', array(
            'typeLogements' => $typeLogements,
        ));
    }

    /**
     * Creates a new typeLogement entity.
     *
     * @Route("/new", name="admin_typelogement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $typeLogement = new Typelogement();
        $form = $this->createForm('MyOrleansBundle\Form\TypeLogementType', $typeLogement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeLogement);
            $em->flush();

            return $this->redirectToRoute('admin_typelogement_show', array('id' => $typeLogement->getId()));
        }

        return $this->render('typelogement/new.html.twig', array(
            'typeLogement' => $typeLogement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a typeLogement entity.
     *
     * @Route("/{id}", name="admin_typelogement_show")
     * @Method("GET")
     */
    public function showAction(TypeLogement $typeLogement)
    {
        $deleteForm = $this->createDeleteForm($typeLogement);

        return $this->render('typelogement/show.html.twig', array(
            'typeLogement' => $typeLogement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing typeLogement entity.
     *
     * @Route("/{id}/edit", name="admin_typelogement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TypeLogement $typeLogement)
    {
        $deleteForm = $this->createDeleteForm($typeLogement);
        $editForm = $this->createForm('MyOrleansBundle\Form\TypeLogementType', $typeLogement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_typelogement_edit', array('id' => $typeLogement->getId()));
        }

        return $this->render('typelogement/edit.html.twig', array(
            'typeLogement' => $typeLogement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a typeLogement entity.
     *
     * @Route("/{id}", name="admin_typelogement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TypeLogement $typeLogement)
    {
        $form = $this->createDeleteForm($typeLogement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typeLogement);
            $em->flush();
        }

        return $this->redirectToRoute('admin_typelogement_index');
    }

    /**
     * Creates a form to delete a typeLogement entity.
     *
     * @param TypeLogement $typeLogement The typeLogement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TypeLogement $typeLogement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_typelogement_delete', array('id' => $typeLogement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
