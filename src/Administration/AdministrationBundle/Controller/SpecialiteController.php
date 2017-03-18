<?php

namespace Administration\AdministrationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Administration\AdministrationBundle\Entity\Specialite;
use Administration\AdministrationBundle\Form\SpecialiteType;
use Symfony\Component\Validator\Constraints\Date;

/**
 * Specialite controller.
 *
 */
class SpecialiteController extends Controller
{
    /**
     * Lists all Specialite entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $specialites = $em->getRepository('AdministrationBundle:Specialite')->findAll();

        return $this->render('specialite/index.html.twig', array(
            'specialites' => $specialites,
        ));
    }

    /**
     * Creates a new Specialite entity.
     *
     */
    public function newAction(Request $request)
    {
        $specialite = new Specialite();
        $form = $this->createForm('Administration\AdministrationBundle\Form\SpecialiteType', $specialite);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $specialites = $em->getRepository('AdministrationBundle:Specialite')->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $specialite->setDateSpecialite(new \DateTime());
            $em->persist($specialite);
            $em->flush();

            return $this->redirectToRoute('specialite_index');
        }

        return $this->render('specialite/new.html.twig', array(
            'specialite' => $specialite,
            'specialites'=>$specialites,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Specialite entity.
     *
     */
    public function showAction(Specialite $specialite)
    {
        $deleteForm = $this->createDeleteForm($specialite);

        return $this->render('specialite/show.html.twig', array(
            'specialite' => $specialite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Specialite entity.
     *
     */
    public function editAction(Request $request, Specialite $specialite)
    {
        $deleteForm = $this->createDeleteForm($specialite);
        $editForm = $this->createForm('Administration\AdministrationBundle\Form\SpecialiteType', $specialite);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $specialites = $em->getRepository('AdministrationBundle:Specialite')->findAll();
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($specialite);
            $em->flush();

            return $this->redirectToRoute('specialite_index');
        }

        return $this->render('specialite/edit.html.twig', array(
            'specialite' => $specialite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'specialites'=>$specialites
        ));
    }

    /**
     * Deletes a Specialite entity.
     *
     */
    public function deleteAction(Request $request, Specialite $specialite)
    {
        $form = $this->createDeleteForm($specialite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($specialite);
            $em->flush();
        }

        return $this->redirectToRoute('specialite_index');
    }

    /**
     * Creates a form to delete a Specialite entity.
     *
     * @param Specialite $specialite The Specialite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Specialite $specialite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('specialite_delete', array('id' => $specialite->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
