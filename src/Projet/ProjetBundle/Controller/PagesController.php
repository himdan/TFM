<?php

namespace Projet\ProjetBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class PagesController extends Controller
{

    public function applicationAction()
    {
        return $this->render('ProjetBundle:pages:applications.html.twig');
    }

    public function aproposAction()
    {
        return $this->render('ProjetBundle:pages:apropos.html.twig');
    }

    public function contactAction()
    {
        return $this->render('ProjetBundle:pages:contact.html.twig');
    }

    public function pageAction($page)
    {
        return $this->render('ProjetBundle:pages:menu.html.twig', array('page'=>$page));
    }


}
