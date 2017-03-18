<?php

namespace Administration\AdministrationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Administration\AdministrationBundle\Entity\Confidentialite;
use Administration\AdministrationBundle\Form\ConfidentialiteType;

/**
 * Confidentialite controller.
 *
 */
class ConfidentialiteController extends Controller
{
    /**
     * Lists all Confidentialite entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $confidentialites = $em->getRepository('AdministrationBundle:Confidentialite')->findAll();

        return $this->render('confidentialite/index.html.twig', array(
            'confidentialites' => $confidentialites,
        ));
    }

    /**
     * Creates a new Confidentialite entity.
     *
     */
    public function newAction(Request $request)
    {
        $confidentialite = new Confidentialite();
        $form = $this->createForm('Administration\AdministrationBundle\Form\ConfidentialiteType', $confidentialite);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        $confidentialites = $em->getRepository('AdministrationBundle:Confidentialite')->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $confidentialite->setDateConfidentialite(new \DateTime());
            $em->persist($confidentialite);
            $em->flush();

            return $this->redirectToRoute('confidentialite_index');
        }

        return $this->render('confidentialite/new.html.twig', array(
            'confidentialite' => $confidentialite,
            'confidentialites'=>$confidentialites,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Confidentialite entity.
     *
     */
    public function showAction(Confidentialite $confidentialite)
    {
        $deleteForm = $this->createDeleteForm($confidentialite);

        return $this->render('confidentialite/show.html.twig', array(
            'confidentialite' => $confidentialite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Confidentialite entity.
     *
     */
    public function editAction(Request $request, Confidentialite $confidentialite)
    {
        $deleteForm = $this->createDeleteForm($confidentialite);
        $editForm = $this->createForm('Administration\AdministrationBundle\Form\ConfidentialiteType', $confidentialite);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        $confidentialites = $em->getRepository('AdministrationBundle:Confidentialite')->findAll();
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($confidentialite);
            $em->flush();

            return $this->redirectToRoute('confidentialite_index');
        }

        return $this->render('confidentialite/edit.html.twig', array(
            'confidentialite' => $confidentialite,
            'confidentialites'=>$confidentialites,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Confidentialite entity.
     *
     */
    public function deleteAction(Request $request, Confidentialite $confidentialite)
    {
        $form = $this->createDeleteForm($confidentialite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($confidentialite);
            $em->flush();
        }

        return $this->redirectToRoute('confidentialite_index');
    }

    /**
     * Creates a form to delete a Confidentialite entity.
     *
     * @param Confidentialite $confidentialite The Confidentialite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Confidentialite $confidentialite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('confidentialite_delete', array('id' => $confidentialite->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
