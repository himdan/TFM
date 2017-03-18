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
class IncludeController extends Controller
{
    /**
     * Lists all Ambiance entities.
     *
     */
    public function sideBarAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $cherche = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$user));
        if($cherche->hasRole('ROLE_ADMIN')){
            $SignalRecette = $em->getRepository('AdministrationBundle:SignalRecette')->findAll();
            $nbSignalRecette = $em->getRepository('AdministrationBundle:SignalRecette')->getNbAdmin();
            $SignalComment = $em->getRepository('AdministrationBundle:CommentaireSignal')->findAll();
            $nbSignalComment = $em->getRepository('AdministrationBundle:CommentaireSignal')->getNbAdmin($user);
        }else{
            $SignalRecette = $em->getRepository('AdministrationBundle:SignalRecette')->findByUser($user);
            $nbSignalRecette = $em->getRepository('AdministrationBundle:SignalRecette')->getNb($user);
            $SignalComment = $em->getRepository('AdministrationBundle:CommentaireSignal')->findByUser($user);
            $nbSignalComment = $em->getRepository('AdministrationBundle:CommentaireSignal')->getNb($user);
        }



        $Recettes = $em->getRepository('AdministrationBundle:Recette')->findAllOrdre();
        $nbRecettes = $em->getRepository('AdministrationBundle:Recette')->getNb();

        return $this->render('@Administration/Include/sideBar.html.twig',
            array(
                'SignalRecette'=>$SignalRecette,
                'nbSignalRecette'=>$nbSignalRecette,
                'SignalComment'=>$SignalComment,
                'nbSignalComment'=>$nbSignalComment,
                'Recette'=>$Recettes,
                'nbRecette'=>$nbRecettes
            ));
    }


}
