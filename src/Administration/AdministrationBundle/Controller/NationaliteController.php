<?php

namespace Administration\AdministrationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Administration\AdministrationBundle\Entity\Nationalite;
use Administration\AdministrationBundle\Form\NationaliteType;

/**
 * Nationalite controller.
 *
 */
class NationaliteController extends Controller
{
    /**
     * Lists all Nationalite entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $nationalites = $em->getRepository('AdministrationBundle:Nationalite')->findAll();

        return $this->render('nationalite/index.html.twig', array(
            'nationalites' => $nationalites,
        ));
    }

    /**
     * Creates a new Nationalite entity.
     *
     */
    public function newAction(Request $request)
    {
        $nationalite = new Nationalite();
        $form = $this->createForm('Administration\AdministrationBundle\Form\NationaliteType', $nationalite);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $nationalites = $em->getRepository('AdministrationBundle:Nationalite')->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $nationalite->setDateNationalite(new \DateTime());
            $em->persist($nationalite);
            $em->flush();

            return $this->redirectToRoute('nationalite_index');
        }

        return $this->render('nationalite/new.html.twig', array(
            'nationalite' => $nationalite,
            'nationalites'=>$nationalites,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Nationalite entity.
     *
     */
    public function showAction(Nationalite $nationalite)
    {
        $deleteForm = $this->createDeleteForm($nationalite);

        return $this->render('nationalite/show.html.twig', array(
            'nationalite' => $nationalite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Nationalite entity.
     *
     */
    public function editAction(Request $request, Nationalite $nationalite)
    {
        $deleteForm = $this->createDeleteForm($nationalite);
        $editForm = $this->createForm('Administration\AdministrationBundle\Form\NationaliteType', $nationalite);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $nationalites = $em->getRepository('AdministrationBundle:Nationalite')->findAll();
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($nationalite);
            $em->flush();

            return $this->redirectToRoute('nationalite_index');
        }

        return $this->render('nationalite/edit.html.twig', array(
            'nationalite' => $nationalite,
            'nationalites'=>$nationalites,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Nationalite entity.
     *
     */
    public function deleteAction(Request $request, Nationalite $nationalite)
    {
        $form = $this->createDeleteForm($nationalite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($nationalite);
            $em->flush();
        }

        return $this->redirectToRoute('nationalite_index');
    }

    /**
     * Creates a form to delete a Nationalite entity.
     *
     * @param Nationalite $nationalite The Nationalite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Nationalite $nationalite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('nationalite_delete', array('id' => $nationalite->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
