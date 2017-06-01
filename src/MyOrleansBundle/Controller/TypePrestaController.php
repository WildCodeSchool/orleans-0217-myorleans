<?php

namespace MyOrleansBundle\Controller;

use MyOrleansBundle\Entity\TypePresta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Typeprestum controller.
 *
 * @Route("typepresta")
 */
class TypePrestaController extends Controller
{
    /**
     * Lists all typePrestum entities.
     *
     * @Route("/", name="typepresta_index")
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
     * Creates a new typePrestum entity.
     *
     * @Route("/new", name="typepresta_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $typePrestum = new Typeprestum();
        $form = $this->createForm('MyOrleansBundle\Form\TypePrestaType', $typePrestum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typePrestum);
            $em->flush();

            return $this->redirectToRoute('typepresta_show', array('id' => $typePrestum->getId()));
        }

        return $this->render('typepresta/new.html.twig', array(
            'typePrestum' => $typePrestum,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a typePrestum entity.
     *
     * @Route("/{id}", name="typepresta_show")
     * @Method("GET")
     */
    public function showAction(TypePresta $typePrestum)
    {
        $deleteForm = $this->createDeleteForm($typePrestum);

        return $this->render('typepresta/show.html.twig', array(
            'typePrestum' => $typePrestum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing typePrestum entity.
     *
     * @Route("/{id}/edit", name="typepresta_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TypePresta $typePrestum)
    {
        $deleteForm = $this->createDeleteForm($typePrestum);
        $editForm = $this->createForm('MyOrleansBundle\Form\TypePrestaType', $typePrestum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('typepresta_edit', array('id' => $typePrestum->getId()));
        }

        return $this->render('typepresta/edit.html.twig', array(
            'typePrestum' => $typePrestum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a typePrestum entity.
     *
     * @Route("/{id}", name="typepresta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TypePresta $typePrestum)
    {
        $form = $this->createDeleteForm($typePrestum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typePrestum);
            $em->flush();
        }

        return $this->redirectToRoute('typepresta_index');
    }

    /**
     * Creates a form to delete a typePrestum entity.
     *
     * @param TypePresta $typePrestum The typePrestum entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TypePresta $typePrestum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('typepresta_delete', array('id' => $typePrestum->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
