<?php

namespace MyOrleansBundle\Controller\admin;

use MyOrleansBundle\Entity\Presta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * presta controller.
 *
 * @Route("admin/presta")
 */
class PrestaController extends Controller
{
    /**
     * Lists all presta entities.
     *
     * @Route("/", name="admin_presta_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $prestas = $em->getRepository('MyOrleansBundle:Presta')->findAll();

        return $this->render('presta/index.html.twig', array(
            'prestas' => $prestas,
        ));
    }

    /**
     * Creates a new presta entity.
     *
     * @Route("/new", name="admin_presta_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $presta = new Presta();
        $form = $this->createForm('MyOrleansBundle\Form\PrestaType', $presta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($presta);
            $em->flush();

            return $this->redirectToRoute('admin_presta_show', array('id' => $presta->getId()));
        }

        return $this->render('presta/new.html.twig', array(
            'presta' => $presta,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a presta entity.
     *
     * @Route("/{id}", name="admin_presta_show")
     * @Method("GET")
     */
    public function showAction(Presta $presta)
    {
        $deleteForm = $this->createDeleteForm($presta);

        return $this->render('presta/show.html.twig', array(
            'presta' => $presta,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing presta entity.
     *
     * @Route("/{id}/edit", name="admin_presta_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Presta $presta)
    {
        $deleteForm = $this->createDeleteForm($presta);
        $editForm = $this->createForm('MyOrleansBundle\Form\PrestaType', $presta);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_presta_edit', array('id' => $presta->getId()));
        }

        return $this->render('presta/edit.html.twig', array(
            'presta' => $presta,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a presta entity.
     *
     * @Route("/{id}", name="admin_presta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Presta $presta)
    {
        $form = $this->createDeleteForm($presta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($presta);
            $em->flush();
        }

        return $this->redirectToRoute('admin_presta_index');
    }

    /**
     * Creates a form to delete a presta entity.
     *
     * @param Presta $presta The presta entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Presta $presta)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_presta_delete', array('id' => $presta->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
