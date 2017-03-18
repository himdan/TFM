<?php

namespace Administration\AdministrationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Administration\AdministrationBundle\Entity\Prix;
use Administration\AdministrationBundle\Form\PrixType;

/**
 * Prix controller.
 *
 */
class PrixController extends Controller
{
    /**
     * Lists all Prix entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $prixes = $em->getRepository('AdministrationBundle:Prix')->findAll();

        return $this->render('prix/index.html.twig', array(
            'prixes' => $prixes,
        ));
    }

    /**
     * Creates a new Prix entity.
     *
     */
    public function newAction(Request $request)
    {
        $prix = new Prix();
        $form = $this->createForm('Administration\AdministrationBundle\Form\PrixType', $prix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($prix);
            $em->flush();

            return $this->redirectToRoute('prix_show', array('id' => $prix->getId()));
        }

        return $this->render('prix/new.html.twig', array(
            'prix' => $prix,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Prix entity.
     *
     */
    public function showAction(Prix $prix)
    {
        $deleteForm = $this->createDeleteForm($prix);

        return $this->render('prix/show.html.twig', array(
            'prix' => $prix,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Prix entity.
     *
     */
    public function editAction(Request $request, Prix $prix)
    {
        $deleteForm = $this->createDeleteForm($prix);
        $editForm = $this->createForm('Administration\AdministrationBundle\Form\PrixType', $prix);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($prix);
            $em->flush();

            return $this->redirectToRoute('prix_edit', array('id' => $prix->getId()));
        }

        return $this->render('prix/edit.html.twig', array(
            'prix' => $prix,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Prix entity.
     *
     */
    public function deleteAction(Request $request, Prix $prix)
    {
        $form = $this->createDeleteForm($prix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($prix);
            $em->flush();
        }

        return $this->redirectToRoute('prix_index');
    }

    /**
     * Creates a form to delete a Prix entity.
     *
     * @param Prix $prix The Prix entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Prix $prix)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('prix_delete', array('id' => $prix->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
