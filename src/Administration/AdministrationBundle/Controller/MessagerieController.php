<?php

namespace Administration\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MessagerieController extends Controller
{
    public function indexAction()
    {
        return $this->render('AdministrationBundle:Messagerie:messagerie.html.twig');
    }

    public function sendMailAction()
    {
        return $this->render('AdministrationBundle:Messagerie:sendmail.html.twig');
    }

    public function sendAction()
    {
        return $this->render('AdministrationBundle:Messagerie:messagerieSend.html.twig');
    }
    
    public function draftAction()
    {
        return $this->render('AdministrationBundle:Messagerie:messagerieDraft.html.twig');
    }

    public function trashAction()
    {
        return $this->render('AdministrationBundle:Messagerie:messagerieTrash.html.twig');
    }
}
