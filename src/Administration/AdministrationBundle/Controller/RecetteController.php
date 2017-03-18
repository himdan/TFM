<?php

namespace Administration\AdministrationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Administration\AdministrationBundle\Entity\Recette;
use Administration\AdministrationBundle\Form\RecetteType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Recette controller.
 *
 */
class RecetteController extends Controller
{

    public function recetterechercheAction($recherche)
    {

        $em = $this->getDoctrine()->getManager();

        $recettes = $em->getRepository('AdministrationBundle:Recette')->recherche($recherche);
        $ar=array();
        foreach($recettes as $ac){
            array_push($ar,array("id" => $ac->getId(),'nom'=>$ac->getNomRecette()));
        }
        return new JsonResponse($ar);

    }

    /**
     * Lists all Recette entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $cherche = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$user));
        if($cherche->hasRole('ROLE_ADMIN')){
            $recettes = $em->getRepository('AdministrationBundle:Recette')->findBy(array(),array('dateRecette'=>'DESC'));
            $nbrRecette = $em->getRepository('AdministrationBundle:Recette')->getNb();
            $nbrRecetteActive = count($em->getRepository('AdministrationBundle:Recette')->findBy(array('activeRecette'=>1)));
        }else{
            $recettes = $em->getRepository('AdministrationBundle:Recette')->findBy(array('auteur'=>$user));
            $nbrRecette = $em->getRepository('AdministrationBundle:Recette')->getNbByUser($user);
        }

        $entities = $this->get('knp_paginator')->paginate($recettes,$this->get('request')->query->get('page', 1), 50);
        return $this->render('recette/index.html.twig', array(
            'recettes' => $entities,
            'nb'=>$nbrRecette,
            'nbrActive'=>$nbrRecetteActive
        ));
    }

    public function activeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $cherche = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$user));
        if($cherche->hasRole('ROLE_ADMIN')){
            $recettes = $em->getRepository('AdministrationBundle:Recette')->findBy(array('activeRecette'=>1));
            $nbrRecette = $em->getRepository('AdministrationBundle:Recette')->getNb();
            $nbrRecetteActive = count($em->getRepository('AdministrationBundle:Recette')->findBy(array('activeRecette'=>1)));
        }else{
            $recettes = $em->getRepository('AdministrationBundle:Recette')->findBy(array('activeRecette'=>1,'auteurUpdate'=>$user));
            $nbrRecette = $em->getRepository('AdministrationBundle:Recette')->getNb();
            $nbrRecetteActive = count($em->getRepository('AdministrationBundle:Recette')->findBy(array('activeRecette'=>1,'auteurUpdate'=>$user)));
        }

        $entities = $this->get('knp_paginator')->paginate($recettes,$this->get('request')->query->get('page', 1), 50);
        return $this->render('recette/active.html.twig', array(
            'recettes' => $entities,
            'nb'=>$nbrRecette,
            'nbrActive'=>$nbrRecetteActive
        ));
    }



    /**
     * Creates a new Recette entity.
     *
     */
    public function newAction(Request $request)
    {
        $recette = new Recette();
        $form = $this->createForm('Administration\AdministrationBundle\Form\RecetteType', $recette);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $recettes = $em->getRepository('AdministrationBundle:Recette')->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $recette->setAuteur($user);
            $recette->setStatutRecette("desactive");
            $recette->setDateRecette(new \DateTime());
            $em->persist($recette);
            $em->flush();

            return $this->redirectToRoute('recette_index');
        }

        return $this->render('recette/new.html.twig', array(
            'recette' => $recette,
            'recettes'=>$recettes,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Recette entity.
     *
     */
    public function showAction(Recette $recette)
    {
        $deleteForm = $this->createDeleteForm($recette);

        return $this->render('recette/show.html.twig', array(
            'recette' => $recette,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Recette entity.
     *
     */
    public function editAction(Request $request, Recette $recette)
    {
        $deleteForm = $this->createDeleteForm($recette);
        $editForm = $this->createForm('Administration\AdministrationBundle\Form\RecetteType', $recette);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        $recettes = $em->getRepository('AdministrationBundle:Recette')->findAll();
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($recette);
            $em->flush();

            return $this->redirectToRoute('recette_index');
        }

        return $this->render('recette/edit.html.twig', array(
            'recette' => $recette,
            'recettes'=>$recettes,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Recette entity.
     *
     */
    public function deleteAction(Request $request, Recette $recette)
    {
        $form = $this->createDeleteForm($recette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($recette);
            $em->flush();
        }

        return $this->redirectToRoute('recette_index');
    }

    /**
     * Creates a form to delete a Recette entity.
     *
     * @param Recette $recette The Recette entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Recette $recette)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('recette_delete', array('id' => $recette->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function activeRecetteAction($id){

        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $recette = $em->getRepository('AdministrationBundle:Recette')->find($id);

        $recette->setActiveRecette(1);
        $recette->setAuteurUpdate($user);

        $em->flush();

        return $this->redirectToRoute('recette_index');

    }

    public function desactiveRecetteAction($id){

        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $recette = $em->getRepository('AdministrationBundle:Recette')->find($id);

        $recette->setActiveRecette(0);
        $recette->setAuteurUpdate($user);

        $em->flush();

        return $this->redirectToRoute('recette_index');

    }
}
