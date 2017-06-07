<?php

namespace MyOrleansBundle\Controller;

use MyOrleansBundle\Entity\CategoriePresta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Categorieprestum controller.
 *
 * @Route("categoriepresta")
 */
class CategoriePrestaController extends Controller
{
    /**
     * Lists all categoriePrestum entities.
     *
     * @Route("/", name="categoriepresta_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categoriePrestas = $em->getRepository('MyOrleansBundle:CategoriePresta')->findAll();

        return $this->render('categoriepresta/index.html.twig', array(
            'categoriePrestas' => $categoriePrestas,
        ));
    }

    /**
     * Creates a new categoriePrestum entity.
     *
     * @Route("/new", name="categoriepresta_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $categoriePrestum = new Categorieprestum();
        $form = $this->createForm('MyOrleansBundle\Form\CategoriePrestaType', $categoriePrestum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoriePrestum);
            $em->flush();

            return $this->redirectToRoute('categoriepresta_show', array('id' => $categoriePrestum->getId()));
        }

        return $this->render('categoriepresta/new.html.twig', array(
            'categoriePrestum' => $categoriePrestum,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a categoriePrestum entity.
     *
     * @Route("/{id}", name="categoriepresta_show")
     * @Method("GET")
     */
    public function showAction(CategoriePresta $categoriePrestum)
    {
        $deleteForm = $this->createDeleteForm($categoriePrestum);

        return $this->render('categoriepresta/show.html.twig', array(
            'categoriePrestum' => $categoriePrestum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing categoriePrestum entity.
     *
     * @Route("/{id}/edit", name="categoriepresta_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CategoriePresta $categoriePrestum)
    {
        $deleteForm = $this->createDeleteForm($categoriePrestum);
        $editForm = $this->createForm('MyOrleansBundle\Form\CategoriePrestaType', $categoriePrestum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categoriepresta_edit', array('id' => $categoriePrestum->getId()));
        }

        return $this->render('categoriepresta/edit.html.twig', array(
            'categoriePrestum' => $categoriePrestum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a categoriePrestum entity.
     *
     * @Route("/{id}", name="categoriepresta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CategoriePresta $categoriePrestum)
    {
        $form = $this->createDeleteForm($categoriePrestum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categoriePrestum);
            $em->flush();
        }

        return $this->redirectToRoute('categoriepresta_index');
    }

    /**
     * Creates a form to delete a categoriePrestum entity.
     *
     * @param CategoriePresta $categoriePrestum The categoriePrestum entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CategoriePresta $categoriePrestum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categoriepresta_delete', array('id' => $categoriePrestum->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
