<?php

namespace Administration\AdministrationBundle\Controller;

use Administration\AdministrationBundle\Form\CommentaireSignalType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Administration\AdministrationBundle\Entity\SignalRecette;
use Administration\AdministrationBundle\Form\SignalRecetteType;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * SignalRecette controller.
 *
 */
class SignalRecetteController extends Controller
{
    /**
     * Lists all SignalRecette entities.
     *
     */

    public function notificationAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $cherche = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$user));
        if($cherche->hasRole('ROLE_ADMIN')) {
            $nbrSignal = $em->getRepository('AdministrationBundle:SignalRecette')->getNbNotificationAdmin();
        }else{
            $nbrSignal = $em->getRepository('AdministrationBundle:SignalRecette')->getNbNotificationUser($user);
        }

        return new JsonResponse($nbrSignal);
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $signalRecettes = $em->getRepository('AdministrationBundle:SignalRecette')->findAll();
        $nbrSignal = $em->getRepository('AdministrationBundle:SignalRecette')->getNbAll();

        $users = $em->getRepository('ClientBundle:Client')->findAll();
        return $this->render('signalrecette/index.html.twig', array(
            'signalRecettes' => $signalRecettes,'nbrSignal'=>$nbrSignal,'users'=>$users
        ));
    }

    /**
     * Creates a new SignalRecette entity.
     *
     */
    public function newAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $signalRecette = new SignalRecette();
        $form = $this->createForm('Administration\AdministrationBundle\Form\SignalRecetteType', $signalRecette);
        $form->handleRequest($request);
        $recette = $em->getRepository('AdministrationBundle:Recette')->findOneBy(array('id'=>$id));
        if ($form->isSubmitted() && $form->isValid()) {
            $signalRecette->setDateSignalRecette(new \DateTime());
            $signalRecette->setRecette($recette);
            $em->persist($signalRecette);
            $em->flush();

            return $this->redirectToRoute('signalrecette_show', array('id' => $signalRecette->getId()));
        }

        return $this->render('signalrecette/new.html.twig', array(
            'signalRecette' => $signalRecette,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SignalRecette entity.
     *
     */
    public function showAction(SignalRecette $signalRecette)
    {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($signalRecette);
        $form = $this->createForm(new CommentaireSignalType());
        $commentSignals = $em->getRepository('AdministrationBundle:CommentaireSignal')->findBy(array('signalRecette'=>$signalRecette),array('id' => 'DESC'));
        $nbrCommentSignal = $em->getRepository('AdministrationBundle:CommentaireSignal')->getNb($signalRecette);
        return $this->render('signalrecette/show.html.twig', array(
            'signalRecette' => $signalRecette,
            'delete_form' => $deleteForm->createView(),
            'form'=>$form->createView(),
            'commentSignals'=>$commentSignals,
            'nbrCommentSignal'=>$nbrCommentSignal
        ));
    }

    /**
     * Displays a form to edit an existing SignalRecette entity.
     *
     */
    public function editAction(Request $request, SignalRecette $signalRecette)
    {
        $deleteForm = $this->createDeleteForm($signalRecette);
        $editForm = $this->createForm('Administration\AdministrationBundle\Form\SignalRecetteType', $signalRecette);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($signalRecette);
            $em->flush();

            return $this->redirectToRoute('signalrecette_edit', array('id' => $signalRecette->getId()));
        }

        return $this->render('signalrecette/edit.html.twig', array(
            'signalRecette' => $signalRecette,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SignalRecette entity.
     *
     */
    public function deleteAction(Request $request, SignalRecette $signalRecette)
    {
        $form = $this->createDeleteForm($signalRecette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($signalRecette);
            $em->flush();
        }

        return $this->redirectToRoute('signalrecette_index');
    }

    /**
     * Creates a form to delete a SignalRecette entity.
     *
     * @param SignalRecette $signalRecette The SignalRecette entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SignalRecette $signalRecette)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('signalrecette_delete', array('id' => $signalRecette->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
