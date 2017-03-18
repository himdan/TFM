<?php

namespace Administration\AdministrationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Administration\AdministrationBundle\Entity\Filtre;
use Administration\AdministrationBundle\Form\FiltreType;

/**
 * Filtre controller.
 *
 */
class FiltreController extends Controller
{
    /**
     * Lists all Filtre entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $filtres = $em->getRepository('AdministrationBundle:Filtre')->findAll();

        return $this->render('filtre/index.html.twig', array(
            'filtres' => $filtres,
        ));
    }

    /**
     * Creates a new Filtre entity.
     *
     */
    public function newAction(Request $request)
    {
        $filtre = new Filtre();
        $form = $this->createForm('Administration\AdministrationBundle\Form\FiltreType', $filtre);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $filtres = $em->getRepository('AdministrationBundle:Filtre')->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $filtre->setDateFiltre(new \DateTime());
            $em->persist($filtre);
            $em->flush();

            return $this->redirectToRoute('filtre_index');
        }

        return $this->render('filtre/new.html.twig', array(
            'filtre' => $filtre,
            'filtres'=>$filtres,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Filtre entity.
     *
     */
    public function showAction(Filtre $filtre)
    {
        $deleteForm = $this->createDeleteForm($filtre);

        return $this->render('filtre/show.html.twig', array(
            'filtre' => $filtre,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Filtre entity.
     *
     */
    public function editAction(Request $request, Filtre $filtre)
    {
        $deleteForm = $this->createDeleteForm($filtre);
        $editForm = $this->createForm('Administration\AdministrationBundle\Form\FiltreType', $filtre);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $filtres = $em->getRepository('AdministrationBundle:Filtre')->findAll();
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($filtre);
            $em->flush();

            return $this->redirectToRoute('filtre_index');
        }

        return $this->render('filtre/edit.html.twig', array(
            'filtre' => $filtre,
            'filtres'=>$filtres,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Filtre entity.
     *
     */
    public function deleteAction(Request $request, Filtre $filtre)
    {
        $form = $this->createDeleteForm($filtre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($filtre);
            $em->flush();
        }

        return $this->redirectToRoute('filtre_index');
    }

    /**
     * Creates a form to delete a Filtre entity.
     *
     * @param Filtre $filtre The Filtre entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Filtre $filtre)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('filtre_delete', array('id' => $filtre->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
