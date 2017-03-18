<?php

namespace Administration\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Administration\AdministrationBundle\Controller\DiskStatus;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $diskStatus = new DiskStatus("/");
        $em = $this->getDoctrine()->getManager();
        $nbrUser = $em->getRepository('ClientBundle:Client')->findNbrUser();
        $nbrArticle = $em->getRepository('AdministrationBundle:Article')->getNb();
        $nbrRecette = $em->getRepository('AdministrationBundle:Recette')->getNb();
        $nbrEtablissement = count($em->getRepository('AdministrationBundle:Recette')->findAll());


        return $this->render('AdministrationBundle:Default:index.html.twig', array(
            'nbrUser'=>$nbrUser,
            'nbrArticle'=>$nbrArticle,
            'nbrRecette'=>$nbrRecette,
            'nbrEtablissement' => $nbrEtablissement
        ));
    }

    public function countHomePageAction(){

         $em = $this->getDoctrine()->getManager();
         $nbrAime = $em->getRepository('ClientBundle:Appreciation')->findAll();

    }
}
