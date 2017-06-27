<?php

namespace MyOrleansBundle\Controller\admin;

use MyOrleansBundle\Entity\Media;
use MyOrleansBundle\Entity\Residence;
use MyOrleansBundle\Entity\TypeMedia;
use MyOrleansBundle\Form\ResidenceType;
use MyOrleansBundle\Service\MyOrleans_Twig_Extension;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Residence controller.
 *
 * @Route("/admin/residence")
 */
class ResidenceController extends Controller
{
    /**
     * Lists all residence entities.
     *
     * @Route("/", name="admin_residence_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $residences = $em->getRepository('MyOrleansBundle:Residence')->findAll();

        return $this->render('residence/index.html.twig', array(
            'residences' => $residences,
        ));
    }

    /**
     * Creates a new residence entity.
     *
     * @Route("/new", name="admin_residence_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {

        $residence = new Residence();
        $media = new Media();
        $residence->getMedias()->add($media);

        $form = $this->createForm(ResidenceType::class, $residence);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $medias = $residence->getMedias();

            foreach ($medias as $media) {
                $file = $media->getLien();
                $filename = 'image' . uniqid() . '.' . $file->guessExtension();
                $file->move(
                    $this->getParameter('upload_directory'),
                    $filename
                );
                $media->setLien($filename);
            }
            $em->persist($residence);
            $em->flush();

            return $this->redirectToRoute('admin_residence_show', array('id' => $residence->getId()));
        }

        return $this->render('residence/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a residence entity.
     *
     * @Route("/{id}", name="admin_residence_show")
     * @Method("GET")
     */
    public function showAction(Residence $residence)
    {
        $deleteForm = $this->createDeleteForm($residence);

        return $this->render('residence/show.html.twig', array(
            'residence' => $residence,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing residence entity.
     *
     * @Route("/{id}/edit", name="admin_residence_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Residence $residence)
    {
        $deleteForm = $this->createDeleteForm($residence);
        $editForm = $this->createForm(ResidenceType::class, $residence);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_residence_edit', array('id' => $residence->getId()));
        }

        return $this->render('residence/edit.html.twig', array(
            'residence' => $residence,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a residence entity.
     *
     * @Route("/{id}", name="admin_residence_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Residence $residence)
    {
        $form = $this->createDeleteForm($residence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($residence);
            $em->flush();
        }

        return $this->redirectToRoute('admin_residence_index');
    }

    /**
     * Creates a form to delete a residence entity.
     *
     * @param Residence $residence The residence entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Residence $residence)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_residence_delete', array('id' => $residence->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
