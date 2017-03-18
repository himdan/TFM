<?php

namespace Administration\AdministrationBundle\Controller\Member;

use Client\ClientBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MemberProfileController extends Controller
{
    public function profileAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $membreProfile = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$id));

        return $this->render('AdministrationBundle:Member:profile.html.twig', array('membreProfile'=>$membreProfile));
    }


}
