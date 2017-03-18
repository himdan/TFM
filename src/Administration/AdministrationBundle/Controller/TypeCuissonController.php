<?php

namespace Administration\AdministrationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Administration\AdministrationBundle\Entity\TypeCuisson;
use Administration\AdministrationBundle\Form\TypeCuissonType;

/**
 * TypeCuisson controller.
 *
 */
class TypeCuissonController extends Controller
{
    /**
     * Lists all TypeCuisson entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $typeCuissons = $em->getRepository('AdministrationBundle:TypeCuisson')->findAll();

        return $this->render('typecuisson/index.html.twig', array(
            'typeCuissons' => $typeCuissons,
        ));
    }

    /**
     * Creates a new TypeCuisson entity.
     *
     */
    public function newAction(Request $request)
    {

        $typeCuisson = new TypeCuisson();
        $form = $this->createForm('Administration\AdministrationBundle\Form\TypeCuissonType', $typeCuisson);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $typeCuissons = $em->getRepository('AdministrationBundle:TypeCuisson')->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeCuisson);
            $em->flush();

            return $this->redirectToRoute('typecuisson_index');
        }

        return $this->render('typecuisson/new.html.twig', array(
            'typeCuisson' => $typeCuisson,
            'typeCuissons'=>$typeCuissons,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TypeCuisson entity.
     *
     */
    public function showAction(TypeCuisson $typeCuisson)
    {
        $deleteForm = $this->createDeleteForm($typeCuisson);

        return $this->render('typecuisson/show.html.twig', array(
            'typeCuisson' => $typeCuisson,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TypeCuisson entity.
     *
     */
    public function editAction(Request $request, TypeCuisson $typeCuisson)
    {
        $deleteForm = $this->createDeleteForm($typeCuisson);
        $editForm = $this->createForm('Administration\AdministrationBundle\Form\TypeCuissonType', $typeCuisson);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $typeCuissons = $em->getRepository('AdministrationBundle:TypeCuisson')->findAll();
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeCuisson);
            $em->flush();

            return $this->redirectToRoute('typecuisson_index');
        }

        return $this->render('typecuisson/edit.html.twig', array(
            'typeCuisson' => $typeCuisson,
            'edit_form' => $editForm->createView(),
            'typeCuissons'=>$typeCuissons,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TypeCuisson entity.
     *
     */
    public function deleteAction(Request $request, TypeCuisson $typeCuisson)
    {
        $form = $this->createDeleteForm($typeCuisson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typeCuisson);
            $em->flush();
        }

        return $this->redirectToRoute('typecuisson_index');
    }

    /**
     * Creates a form to delete a TypeCuisson entity.
     *
     * @param TypeCuisson $typeCuisson The TypeCuisson entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TypeCuisson $typeCuisson)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('typecuisson_delete', array('id' => $typeCuisson->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
