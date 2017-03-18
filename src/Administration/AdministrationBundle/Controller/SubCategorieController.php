<?php

namespace Administration\AdministrationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Administration\AdministrationBundle\Entity\SubCategorie;
use Administration\AdministrationBundle\Form\SubCategorieType;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * SubCategorie controller.
 *
 */
class SubCategorieController extends Controller
{

    
    public function menuSubCategorieAction($menu)
    {

        $em = $this->getDoctrine()->getManager();

        $menus = $em->getRepository('AdministrationBundle:SubCategorie')->findBy(array('menu'=>$menu));
        $ar=array();
        foreach($menus as $ac){
            array_push($ar,array("id" => $ac->getId(),'nom'=>$ac->getNomSubCategorie()));
        }
        return new JsonResponse($ar);
    }

    /**
     * Lists all SubCategorie entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $subCategories = $em->getRepository('AdministrationBundle:SubCategorie')->findAll();

        return $this->render('subcategorie/index.html.twig', array(
            'subCategories' => $subCategories,
        ));
    }

    /**
     * Creates a new SubCategorie entity.
     *
     */
    public function newAction(Request $request)
    {
        $subCategorie = new SubCategorie();
        $form = $this->createForm('Administration\AdministrationBundle\Form\SubCategorieType', $subCategorie);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $subCategories = $em->getRepository('AdministrationBundle:SubCategorie')->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $subCategorie->setDateSubCategorie(new \DateTime());
            $em->persist($subCategorie);
            $em->flush();

            return $this->redirectToRoute('subcategorie_index');
        }

        return $this->render('subcategorie/new.html.twig', array(
            'subCategorie' => $subCategorie,
            'subCategories'=>$subCategories,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SubCategorie entity.
     *
     */
    public function showAction(SubCategorie $subCategorie)
    {
        $deleteForm = $this->createDeleteForm($subCategorie);

        return $this->render('subcategorie/show.html.twig', array(
            'subCategorie' => $subCategorie,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SubCategorie entity.
     *
     */
    public function editAction(Request $request, SubCategorie $subCategorie)
    {
        $deleteForm = $this->createDeleteForm($subCategorie);
        $editForm = $this->createForm('Administration\AdministrationBundle\Form\SubCategorieType', $subCategorie);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $subCategories = $em->getRepository('AdministrationBundle:SubCategorie')->findAll();
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($subCategorie);
            $em->flush();

            return $this->redirectToRoute('subcategorie_index');
        }

        return $this->render('subcategorie/edit.html.twig', array(
            'subCategorie' => $subCategorie,
            'subCategories'=>$subCategories,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SubCategorie entity.
     *
     */
    public function deleteAction(Request $request, SubCategorie $subCategorie)
    {
        $form = $this->createDeleteForm($subCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($subCategorie);
            $em->flush();
        }

        return $this->redirectToRoute('subcategorie_index');
    }

    /**
     * Creates a form to delete a SubCategorie entity.
     *
     * @param SubCategorie $subCategorie The SubCategorie entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SubCategorie $subCategorie)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('subcategorie_delete', array('id' => $subCategorie->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
