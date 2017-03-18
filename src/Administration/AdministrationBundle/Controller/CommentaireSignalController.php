<?php

namespace Administration\AdministrationBundle\Controller;

use Administration\AdministrationBundle\Entity\CommentaireSignal;
use Administration\AdministrationBundle\Form\CommentaireSignalType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Ambiance controller.
 *
 */
class CommentaireSignalController extends Controller
{

    public function commentaireAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $cherche = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$user));
        if($cherche->hasRole('ROLE_ADMIN')) {
            $nbrCommentaire = $em->getRepository('AdministrationBundle:CommentaireSignal')->getNbNotificationAdmin();
        }else{
            $nbrCommentaire = $em->getRepository('AdministrationBundle:CommentaireSignal')->getNbNotificationUser($user);
        }

        return new JsonResponse($nbrCommentaire);
    }

    public function commentaireSignalAjoutAction($id) {

        $form = $this->createForm(new CommentaireSignalType());
        $commentSignal = new CommentaireSignal();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $signalRecette = $em->getRepository('AdministrationBundle:SignalRecette')->findOneBy(array('id'=>$id));

        if ($this->get('request')->getMethod() == 'POST') {
            $form->bind($this->get('request'));
            $commentSignal->setTexteCommentaireSignal($form['texteCommentaireSignal']->getData());
            $commentSignal->setUser($user);
            $commentSignal->setVueCommentaireSignal('non');
            $commentSignal->setSignalRecette($signalRecette);
            $commentSignal->setDateCommentaireSignal(new \DateTime());
            $em->persist($commentSignal);
            $em->flush();

        }

        return $this->redirectToRoute('signalrecette_show', array('id' => $signalRecette->getId()));
    }


}
