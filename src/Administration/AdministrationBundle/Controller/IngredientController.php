<?php

namespace Administration\AdministrationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Administration\AdministrationBundle\Entity\Ingredient;
use Administration\AdministrationBundle\Form\IngredientType;

/**
 * Ingredient controller.
 *
 */
class IngredientController extends Controller
{
    /**
     * Lists all Ingredient entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ingredients = $em->getRepository('AdministrationBundle:Ingredient')->findAll();

        return $this->render('ingredient/index.html.twig', array(
            'ingredients' => $ingredients,
        ));
    }

    /**
     * Creates a new Ingredient entity.
     *
     */
    public function newAction(Request $request)
    {
        $ingredient = new Ingredient();
        $form = $this->createForm('Administration\AdministrationBundle\Form\IngredientType', $ingredient);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        $ingredients = $em->getRepository('AdministrationBundle:Ingredient')->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $ingredient->setDateIngredient(new \DateTime());
            $em->persist($ingredient);
            $em->flush();

            return $this->redirectToRoute('ingredient_index');
        }

        return $this->render('ingredient/new.html.twig', array(
            'ingredient' => $ingredient,
            'ingredients'=>$ingredients,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Ingredient entity.
     *
     */
    public function showAction(Ingredient $ingredient)
    {
        $deleteForm = $this->createDeleteForm($ingredient);

        return $this->render('ingredient/show.html.twig', array(
            'ingredient' => $ingredient,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Ingredient entity.
     *
     */
    public function editAction(Request $request, Ingredient $ingredient)
    {
        $deleteForm = $this->createDeleteForm($ingredient);
        $editForm = $this->createForm('Administration\AdministrationBundle\Form\IngredientType', $ingredient);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        $ingredients = $em->getRepository('AdministrationBundle:Ingredient')->findAll();
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ingredient);
            $em->flush();

            return $this->redirectToRoute('ingredient_index');
        }

        return $this->render('ingredient/edit.html.twig', array(
            'ingredient' => $ingredient,
            'ingredients'=>$ingredients,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Ingredient entity.
     *
     */
    public function deleteAction(Request $request, Ingredient $ingredient)
    {
        $form = $this->createDeleteForm($ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ingredient);
            $em->flush();
        }

        return $this->redirectToRoute('ingredient_index');
    }

    /**
     * Creates a form to delete a Ingredient entity.
     *
     * @param Ingredient $ingredient The Ingredient entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Ingredient $ingredient)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ingredient_delete', array('id' => $ingredient->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
