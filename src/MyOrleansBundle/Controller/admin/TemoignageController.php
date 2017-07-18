<?php

namespace MyOrleansBundle\Controller\admin;

use MyOrleansBundle\Entity\Temoignage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Temoignage controller.
 *
 * @Route("admin/temoignage")
 */
class TemoignageController extends Controller
{
    /**
     * Lists all temoignage entities.
     *
     * @Route("/", name="admin_temoignage_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $temoignages = $em->getRepository('MyOrleansBundle:Temoignage')->findAll();

        /**
         * @var $pagination "Knp\Component\Pager\Paginator"
         * */
        $pagination = $this->get('knp_paginator');
        $results = $pagination->paginate(
            $temoignages,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 10)
        );

        return $this->render('temoignage/index.html.twig', array(
            'temoignages' => $results,
        ));
    }

    /**
     * Creates a new temoignage entity.
     *
     * @Route("/new", name="admin_temoignage_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $temoignage = new Temoignage();
        $form = $this->createForm('MyOrleansBundle\Form\TemoignageType', $temoignage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($temoignage);
            $em->flush();

            $this->addFlash('success', 'Votre témoignage a bien été ajouté');
            return $this->redirectToRoute('admin_temoignage_index', array('id' => $temoignage->getId()));
        }

        return $this->render('temoignage/new.html.twig', array(
            'temoignage' => $temoignage,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a temoignage entity.
     *
     * @Route("/{id}", name="admin_temoignage_show")
     * @Method("GET")
     */
    public function showAction(Temoignage $temoignage)
    {
        $deleteForm = $this->createDeleteForm($temoignage);

        return $this->render('temoignage/show.html.twig', array(
            'temoignage' => $temoignage,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing temoignage entity.
     *
     * @Route("/{id}/edit", name="admin_temoignage_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Temoignage $temoignage)
    {
        $deleteForm = $this->createDeleteForm($temoignage);
        $editForm = $this->createForm('MyOrleansBundle\Form\TemoignageType', $temoignage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Votre témoignage a bien été mis à jour');
            return $this->redirectToRoute('admin_temoignage_index', array('id' => $temoignage->getId()));
        }

        return $this->render('temoignage/edit.html.twig', array(
            'temoignage' => $temoignage,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a temoignage entity.
     *
     * @Route("/{id}", name="admin_temoignage_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Temoignage $temoignage)
    {
        $form = $this->createDeleteForm($temoignage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($temoignage);
            $em->flush();
        }

        $this->addFlash('danger', 'Votre témoignage a bien été supprimé');
        return $this->redirectToRoute('admin_temoignage_index');
    }

    /**
     * Creates a form to delete a temoignage entity.
     *
     * @param Temoignage $temoignage The temoignage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Temoignage $temoignage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_temoignage_delete', array('id' => $temoignage->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
