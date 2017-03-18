<?php

namespace Administration\AdministrationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Administration\AdministrationBundle\Entity\Difficulte;
use Administration\AdministrationBundle\Form\DifficulteType;

/**
 * Difficulte controller.
 *
 */
class DifficulteController extends Controller
{
    /**
     * Lists all Difficulte entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $difficultes = $em->getRepository('AdministrationBundle:Difficulte')->findAll();

        return $this->render('difficulte/index.html.twig', array(
            'difficultes' => $difficultes,
        ));
    }

    /**
     * Creates a new Difficulte entity.
     *
     */
    public function newAction(Request $request)
    {
        $difficulte = new Difficulte();
        $form = $this->createForm('Administration\AdministrationBundle\Form\DifficulteType', $difficulte);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $difficultes = $em->getRepository('AdministrationBundle:Difficulte')->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $difficulte->setDateDifficulte(new \DateTime());
            $em->persist($difficulte);
            $em->flush();

            return $this->redirectToRoute('difficulte_index');
        }

        return $this->render('difficulte/new.html.twig', array(
            'difficulte' => $difficulte,
            'difficultes'=>$difficultes,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Difficulte entity.
     *
     */
    public function showAction(Difficulte $difficulte)
    {
        $deleteForm = $this->createDeleteForm($difficulte);

        return $this->render('difficulte/show.html.twig', array(
            'difficulte' => $difficulte,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Difficulte entity.
     *
     */
    public function editAction(Request $request, Difficulte $difficulte)
    {
        $deleteForm = $this->createDeleteForm($difficulte);
        $editForm = $this->createForm('Administration\AdministrationBundle\Form\DifficulteType', $difficulte);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $difficultes = $em->getRepository('AdministrationBundle:Difficulte')->findAll();
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($difficulte);
            $em->flush();

            return $this->redirectToRoute('difficulte_index');
        }

        return $this->render('difficulte/edit.html.twig', array(
            'difficulte' => $difficulte,
            'difficultes'=>$difficultes,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Difficulte entity.
     *
     */
    public function deleteAction(Request $request, Difficulte $difficulte)
    {
        $form = $this->createDeleteForm($difficulte);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $difficultes = $em->getRepository('AdministrationBundle:Difficulte')->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($difficulte);
            $em->flush();
        }

        return $this->redirectToRoute('difficulte_index');
    }

    /**
     * Creates a form to delete a Difficulte entity.
     *
     * @param Difficulte $difficulte The Difficulte entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Difficulte $difficulte)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('difficulte_delete', array('id' => $difficulte->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
