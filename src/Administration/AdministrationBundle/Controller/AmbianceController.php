<?php

namespace Administration\AdministrationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Administration\AdministrationBundle\Entity\Ambiance;
use Administration\AdministrationBundle\Form\AmbianceType;

/**
 * Ambiance controller.
 *
 */
class AmbianceController extends Controller
{
    /**
     * Lists all Ambiance entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ambiances = $em->getRepository('AdministrationBundle:Ambiance')->findAll();

        return $this->render('ambiance/index.html.twig', array(
            'ambiances' => $ambiances,
        ));
    }

    /**
     * Creates a new Ambiance entity.
     *
     */
    public function newAction(Request $request)
    {
        $ambiance = new Ambiance();
        $form = $this->createForm('Administration\AdministrationBundle\Form\AmbianceType', $ambiance);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $ambiances = $em->getRepository('AdministrationBundle:Ambiance')->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $ambiance->setDateAmbiance(new \DateTime());
            $em->persist($ambiance);
            $em->flush();

            return $this->redirectToRoute('ambiance_index');
        }

        return $this->render('ambiance/new.html.twig', array(
            'ambiance' => $ambiance,
            'ambiances'=>$ambiances,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Ambiance entity.
     *
     */
    public function showAction(Ambiance $ambiance)
    {
        $deleteForm = $this->createDeleteForm($ambiance);

        return $this->render('ambiance/show.html.twig', array(
            'ambiance' => $ambiance,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Ambiance entity.
     *
     */
    public function editAction(Request $request, Ambiance $ambiance)
    {
        $deleteForm = $this->createDeleteForm($ambiance);
        $editForm = $this->createForm('Administration\AdministrationBundle\Form\AmbianceType', $ambiance);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $ambiances = $em->getRepository('AdministrationBundle:Ambiance')->findAll();
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ambiance);
            $em->flush();

            return $this->redirectToRoute('ambiance_index');
        }

        return $this->render('ambiance/edit.html.twig', array(
            'ambiance' => $ambiance,
            'ambiances'=>$ambiances,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Ambiance entity.
     *
     */
    public function deleteAction(Request $request, Ambiance $ambiance)
    {
        $form = $this->createDeleteForm($ambiance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ambiance);
            $em->flush();
        }

        return $this->redirectToRoute('ambiance_index');
    }

    /**
     * Creates a form to delete a Ambiance entity.
     *
     * @param Ambiance $ambiance The Ambiance entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Ambiance $ambiance)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ambiance_delete', array('id' => $ambiance->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
