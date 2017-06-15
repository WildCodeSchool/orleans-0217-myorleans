<?php

namespace MyOrleansBundle\Controller\admin;

use MyOrleansBundle\Entity\TypePresta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * typepresta controller.
 *
 * @Route("admin/typepresta")
 */
class TypePrestaController extends Controller
{
    /**
     * Lists all typepresta entities.
     *
     * @Route("/", name="admin_typepresta_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $typePrestas = $em->getRepository('MyOrleansBundle:TypePresta')->findAll();

        return $this->render('typepresta/index.html.twig', array(
            'typePrestas' => $typePrestas,
        ));
    }

    /**
     * Creates a new typepresta entity.
     *
     * @Route("/new", name="admin_typepresta_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $typepresta = new TypePresta();
        $form = $this->createForm('MyOrleansBundle\Form\TypePrestaType', $typepresta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typepresta);
            $em->flush();

            return $this->redirectToRoute('admin_typepresta_show', array('id' => $typepresta->getId()));
        }

        return $this->render('typepresta/new.html.twig', array(
            'typepresta' => $typepresta,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a typepresta entity.
     *
     * @Route("/{id}", name="admin_typepresta_show")
     * @Method("GET")
     */
    public function showAction(TypePresta $typepresta)
    {
        $deleteForm = $this->createDeleteForm($typepresta);

        return $this->render('typepresta/show.html.twig', array(
            'typepresta' => $typepresta,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing typepresta entity.
     *
     * @Route("/{id}/edit", name="admin_typepresta_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TypePresta $typepresta)
    {
        $deleteForm = $this->createDeleteForm($typepresta);
        $editForm = $this->createForm('MyOrleansBundle\Form\TypePrestaType', $typepresta);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_typepresta_edit', array('id' => $typepresta->getId()));
        }

        return $this->render('typepresta/edit.html.twig', array(
            'typepresta' => $typepresta,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a typepresta entity.
     *
     * @Route("/{id}", name="admin_typepresta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TypePresta $typepresta)
    {
        $form = $this->createDeleteForm($typepresta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typepresta);
            $em->flush();
        }

        return $this->redirectToRoute('admin_typepresta_index');
    }

    /**
     * Creates a form to delete a typepresta entity.
     *
     * @param TypePresta $typepresta The typepresta entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TypePresta $typepresta)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_typepresta_delete', array('id' => $typepresta->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
