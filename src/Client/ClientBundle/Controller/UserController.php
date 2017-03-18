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
class UserController extends Controller
{
    /**
     * Lists all Client entities.
     *
     */
    public function indexAction()
    {

        $user = $this->get('security.token_storage')->getToken()->getUser()->getId();
        return $this->redirect($this->generateUrl('profile', array('userId'=>$user)));
    }


}
