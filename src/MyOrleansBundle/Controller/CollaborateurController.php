<?php

namespace MyOrleansBundle\Controller;

use MyOrleansBundle\Entity\Collaborateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Collaborateur controller.
 *
 * @Route("collaborateur")
 */
class CollaborateurController extends Controller
{
    /**
     * Lists all collaborateur entities.
     *
     * @Route("/", name="collaborateur_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $collaborateurs = $em->getRepository('MyOrleansBundle:Collaborateur')->findAll();

        return $this->render('collaborateur/index.html.twig', array(
            'collaborateurs' => $collaborateurs,
        ));
    }

    /**
     * Creates a new collaborateur entity.
     *
     * @Route("/new", name="collaborateur_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $collaborateur = new Collaborateur();
        $form = $this->createForm('MyOrleansBundle\Form\CollaborateurType', $collaborateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($collaborateur);
            $em->flush();

            return $this->redirectToRoute('collaborateur_show', array('id' => $collaborateur->getId()));
        }

        return $this->render('collaborateur/new.html.twig', array(
            'collaborateur' => $collaborateur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a collaborateur entity.
     *
     * @Route("/{id}", name="collaborateur_show")
     * @Method("GET")
     */
    public function showAction(Collaborateur $collaborateur)
    {
        $deleteForm = $this->createDeleteForm($collaborateur);

        return $this->render('collaborateur/show.html.twig', array(
            'collaborateur' => $collaborateur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing collaborateur entity.
     *
     * @Route("/{id}/edit", name="collaborateur_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Collaborateur $collaborateur)
    {
        $deleteForm = $this->createDeleteForm($collaborateur);
        $editForm = $this->createForm('MyOrleansBundle\Form\CollaborateurType', $collaborateur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('collaborateur_edit', array('id' => $collaborateur->getId()));
        }

        return $this->render('collaborateur/edit.html.twig', array(
            'collaborateur' => $collaborateur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a collaborateur entity.
     *
     * @Route("/{id}", name="collaborateur_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Collaborateur $collaborateur)
    {
        $form = $this->createDeleteForm($collaborateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($collaborateur);
            $em->flush();
        }

        return $this->redirectToRoute('collaborateur_index');
    }

    /**
     * Creates a form to delete a collaborateur entity.
     *
     * @param Collaborateur $collaborateur The collaborateur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Collaborateur $collaborateur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('collaborateur_delete', array('id' => $collaborateur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
