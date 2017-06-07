<?php

namespace MyOrleansBundle\Controller;

use MyOrleansBundle\Entity\Presta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Prestum controller.
 *
 * @Route("presta")
 */
class PrestaController extends Controller
{
    /**
     * Lists all prestum entities.
     *
     * @Route("/", name="presta_index")
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
     * Creates a new prestum entity.
     *
     * @Route("/new", name="presta_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $prestum = new Prestum();
        $form = $this->createForm('MyOrleansBundle\Form\PrestaType', $prestum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($prestum);
            $em->flush();

            return $this->redirectToRoute('presta_show', array('id' => $prestum->getId()));
        }

        return $this->render('presta/new.html.twig', array(
            'prestum' => $prestum,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a prestum entity.
     *
     * @Route("/{id}", name="presta_show")
     * @Method("GET")
     */
    public function showAction(Presta $prestum)
    {
        $deleteForm = $this->createDeleteForm($prestum);

        return $this->render('presta/show.html.twig', array(
            'prestum' => $prestum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing prestum entity.
     *
     * @Route("/{id}/edit", name="presta_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Presta $prestum)
    {
        $deleteForm = $this->createDeleteForm($prestum);
        $editForm = $this->createForm('MyOrleansBundle\Form\PrestaType', $prestum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('presta_edit', array('id' => $prestum->getId()));
        }

        return $this->render('presta/edit.html.twig', array(
            'prestum' => $prestum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a prestum entity.
     *
     * @Route("/{id}", name="presta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Presta $prestum)
    {
        $form = $this->createDeleteForm($prestum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($prestum);
            $em->flush();
        }

        return $this->redirectToRoute('presta_index');
    }

    /**
     * Creates a form to delete a prestum entity.
     *
     * @param Presta $prestum The prestum entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Presta $prestum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('presta_delete', array('id' => $prestum->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
