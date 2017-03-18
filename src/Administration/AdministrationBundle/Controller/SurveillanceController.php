<?php

namespace Administration\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SurveillanceController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $aime = count($em->getRepository('ClientBundle:Appreciation')->findAll());
        return $this->render('AdministrationBundle:Surveillance:surveillance.html.twig', array(
            'aime'=>$aime
        ));
    }

    public function categorieSurveillanceAction()
    {
        $em = $this->getDoctrine()->getManager();

        $nbrRecette = $em->getRepository('AdministrationBundle:Recette')->getNb();
        $nbrArticle = $em->getRepository('AdministrationBundle:Article')->getNb();
        return $this->render('AdministrationBundle:Surveillance:categorieSurveillance.html.twig', array(
            'nbrRecette' => $nbrRecette,'nbrArticle'=>$nbrArticle
        ));
    }

    public function mediaArticleAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('AdministrationBundle:Article')->findAll();
        $nbrArticle = $em->getRepository('AdministrationBundle:Article')->getNb();
        return $this->render('AdministrationBundle:Surveillance:surveillanceMedia.html.twig', array(
            'articles' => $articles,'nbrArticle'=>$nbrArticle
        ));
    }

    public function mediaRecetteAction()
    {
        $em = $this->getDoctrine()->getManager();

        $recettes = $em->getRepository('AdministrationBundle:Recette')->findAll();
        $nbrRecette = $em->getRepository('AdministrationBundle:Recette')->getNb();
        return $this->render('AdministrationBundle:Surveillance:surveillanceMediaRecette.html.twig', array(
            'recettes' => $recettes,'nbrRecette'=>$nbrRecette
        ));
    }
}
