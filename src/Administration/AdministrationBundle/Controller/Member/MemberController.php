<?php

namespace Administration\AdministrationBundle\Controller\Member;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MemberController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $membres = $em->getRepository('ClientBundle:Client')->findAll();

        return $this->render('AdministrationBundle:Member:gestion.html.twig', array('membres'=>$membres));
    }

    public function nouveauAction()
    {
        $em = $this->getDoctrine()->getManager();

        $membres = $em->getRepository('ClientBundle:Client')->findBy(array(), array('dateAjoutClient' => 'DESC'),100);

        return $this->render('AdministrationBundle:Member:nouveau.html.twig', array('membres'=>$membres));
    }

    public function premiumAction()
    {
        $em = $this->getDoctrine()->getManager();

        $membres = $em->getRepository('ClientBundle:Client')->findByPremium();

        return $this->render('AdministrationBundle:Member:premium.html.twig', array('membres'=>$membres));
    }

    public function bloqueAction()
    {
        $em = $this->getDoctrine()->getManager();

        $membres = $em->getRepository('ClientBundle:Client')->findByBloque();

        return $this->render('AdministrationBundle:Member:bloque.html.twig', array('membres'=>$membres));
    }

    public function AdminAction()
    {
        $em = $this->getDoctrine()->getManager();

        $membres = $em->getRepository('ClientBundle:Client')->findByAdmin('ROLE_ADMIN');

        return $this->render('AdministrationBundle:Member:admin.html.twig', array('membres'=>$membres));
    }

    public function RedacteurAction()
    {
        $em = $this->getDoctrine()->getManager();

        $membres = $em->getRepository('ClientBundle:Client')->findByAdmin('ROLE_REDACTEUR');

        return $this->render('AdministrationBundle:Member:redacteur.html.twig', array('membres'=>$membres));
    }

    public function supprimerAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $membres = $em->getRepository('ClientBundle:Client')->findAll();
        $membreProfile = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$id));
        $membreProfile->setEnabled(false);

        $em->flush();


        return $this->redirectToRoute('memberGestion', array('membres' => $membres));
    }

    public function activerAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $membres = $em->getRepository('ClientBundle:Client')->findAll();
        $membreProfile = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$id));
        $membreProfile->setEnabled(true);

        $em->flush();


        return $this->redirectToRoute('memberGestion', array('membres' => $membres));
    }

    public function premiumActiveAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $membres = $em->getRepository('ClientBundle:Client')->findAll();
        $membreProfile = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$id));
        $membreProfile->setPremiumClient('active');

        $em->flush();


        return $this->redirectToRoute('memberGestion', array('membres' => $membres));
    }


}
