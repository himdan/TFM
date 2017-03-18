<?php

namespace Administration\AdministrationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Administration\AdministrationBundle\Entity\Gouvernorat;
use Administration\AdministrationBundle\Form\GouvernoratType;

/**
 * Gouvernorat controller.
 *
 */
class GouvernoratController extends Controller
{
    /**
     * Lists all Gouvernorat entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $gouvernorats = $em->getRepository('AdministrationBundle:Gouvernorat')->findAll();

        return $this->render('gouvernorat/index.html.twig', array(
            'gouvernorats' => $gouvernorats,
        ));
    }

    /**
     * Creates a new Gouvernorat entity.
     *
     */
    public function newAction(Request $request)
    {
        $gouvernorat = new Gouvernorat();
        $form = $this->createForm('Administration\AdministrationBundle\Form\GouvernoratType', $gouvernorat);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        $gouvernorats = $em->getRepository('AdministrationBundle:Gouvernorat')->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gouvernorat);
            $em->flush();

            return $this->redirectToRoute('gouvernorat_index');
        }

        return $this->render('gouvernorat/new.html.twig', array(
            'gouvernorat' => $gouvernorat,
            'form' => $form->createView(),
            'gouvernorats'=>$gouvernorats
        ));
    }

    /**
     * Finds and displays a Gouvernorat entity.
     *
     */
    public function showAction(Gouvernorat $gouvernorat)
    {
        $deleteForm = $this->createDeleteForm($gouvernorat);

        return $this->render('gouvernorat/show.html.twig', array(
            'gouvernorat' => $gouvernorat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Gouvernorat entity.
     *
     */
    public function editAction(Request $request, Gouvernorat $gouvernorat)
    {
        $deleteForm = $this->createDeleteForm($gouvernorat);
        $editForm = $this->createForm('Administration\AdministrationBundle\Form\GouvernoratType', $gouvernorat);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        $gouvernorats = $em->getRepository('AdministrationBundle:Gouvernorat')->findAll();
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gouvernorat);
            $em->flush();

            return $this->redirectToRoute('gouvernorat_index');
        }

        return $this->render('gouvernorat/edit.html.twig', array(
            'gouvernorat' => $gouvernorat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'gouvernorats'=>$gouvernorats
        ));
    }

    /**
     * Deletes a Gouvernorat entity.
     *
     */
    public function deleteAction(Request $request, Gouvernorat $gouvernorat)
    {
        $form = $this->createDeleteForm($gouvernorat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($gouvernorat);
            $em->flush();
        }

        return $this->redirectToRoute('gouvernorat_index');
    }

    /**
     * Creates a form to delete a Gouvernorat entity.
     *
     * @param Gouvernorat $gouvernorat The Gouvernorat entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Gouvernorat $gouvernorat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('gouvernorat_delete', array('id' => $gouvernorat->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
