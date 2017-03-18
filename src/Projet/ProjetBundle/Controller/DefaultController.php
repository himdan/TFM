<?php

namespace Projet\ProjetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProjetBundle:Default:index.html.twig');
    }

    public function error403Action()
    {
        return $this->render('ProjetBundle:Default:403.html.twig');
    }

    public function error404Action()
    {
        return $this->render('ProjetBundle:Default:404.html.twig');
    }
}
