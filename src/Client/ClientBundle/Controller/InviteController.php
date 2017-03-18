<?php

namespace Client\ClientBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Client\ClientBundle\Entity\Client;
use Client\ClientBundle\Form\ClientType;

/**
 * Client controller.
 *
 */
class InviteController extends Controller
{
    /**
     * Lists all Client entities.
     *
     */
    public function indexAction()
    {


        return $this->render('ClientBundle:Invite:invite.html.twig');
    }


}
