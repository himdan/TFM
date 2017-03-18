<?php

namespace Client\ClientBundle\Controller;

use Client\ClientBundle\Entity\Amitie;
use Client\ClientBundle\Entity\SignalUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Client\ClientBundle\Entity\Client;
use Client\ClientBundle\Form\ClientType;

/**
 * Client controller.
 *
 */
class SettingsController extends Controller
{
    /**
     * Lists all Client entities.
     *
     */

    public function compteAction()
    {
        return $this->render('ClientBundle:Settings:compte.html.twig');

    }

    public function informationAction()
    {
        return $this->render('ClientBundle:Settings:information.html.twig');

    }

    public function saveCompteAction(Request $request)
    {

        $settingPays = $this->get('request')->request->get('settingPays');
        $settingGouv = $this->get('request')->request->get('settingGouv');
        $settingRegion = $this->get('request')->request->get('settingRegion');
        $settingWeb = $this->get('request')->request->get('settingWeb');
        $settingNum = $this->get('request')->request->get('settingNum');

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        $paysR = $em->getRepository('AdministrationBundle:Pays')->findOneBy(array('id'=>$settingPays));
        $gouvR = $em->getRepository('AdministrationBundle:Gouvernorat')->findOneBy(array('id'=>$settingGouv));
        $regionR = $em->getRepository('AdministrationBundle:Region')->findOneBy(array('id'=>$settingRegion));
        $compte = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$user));

        $compte->setGouvernorat($gouvR);
        $compte->setRegion($regionR);
        $compte->setPays($paysR);
        $compte->setSiteClient($settingWeb);
        $compte->setFixeClient($settingNum);

        $em->flush();

        return new JsonResponse('save ok');

    }

    public function saveInformationAction(Request $request)
    {

        $nom = $this->get('request')->request->get('nom');
        $prenom = $this->get('request')->request->get('prenom');
        $gender = $this->get('request')->request->get('gender');
        $naissance = $this->get('request')->request->get('naissance');
        $desc = $this->get('request')->request->get('desc');

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        $genderR = $em->getRepository('AdministrationBundle:Gender')->findOneBy(array('id'=>$gender));
        $compte = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$user));

        $compte->setNomClient($nom);
        $compte->setPrenomClient($prenom);
        $compte->setGender($genderR);
        $compte->setDateNaissanceClient($naissance);
        $compte->setDescriptionClient($desc);

        $em->flush();

        return new JsonResponse('save information ok');

    }

    public function getCompteInformationAction()
    {



        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $profiles = array();

        $compte = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$user));

        $profiles = array(
            'paysId'=>$compte->getPays()->getId(),
            'gouvId'=>$compte->getGouvernorat()->getId(),
            'regionId'=>$compte->getRegion()->getId(),
            'site'=>$compte->getSiteClient(),
            'num'=>$compte->getFixeClient()
        );


        return new JsonResponse($profiles);

    }

    public function getInformationAction()
    {



        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $profiles = array();

        $compte = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$user));


        $profiles = array(
            'nom'=>$compte->getNomClient(),
            'prenom'=>$compte->getPrenomClient(),
            'gender'=>$compte->getGender()->getId(),
            'naissance'=>$compte->getDateNaissanceClient(),
            'description'=>$compte->getDescriptionClient()
        );


        return new JsonResponse($profiles);

    }

    public function getGouvAction()
    {
        $em = $this->getDoctrine()->getManager();
        $gouvTab = array();
        $gouvs = $em->getRepository('AdministrationBundle:Gouvernorat')->findAll();

        foreach ($gouvs as $g){
            array_push($gouvTab, array(
                'id'=>$g->getId(),
                'nom'=>$g->getNomGouvernorat()
            ));
        }
        return new JsonResponse($gouvTab);

    }

    public function getGenderAction()
    {
        $em = $this->getDoctrine()->getManager();
        $genderTab = array();
        $genders = $em->getRepository('AdministrationBundle:Gender')->findAll();

        foreach ($genders as $gender){
            array_push($genderTab, array(
                'id'=>$gender->getId(),
                'nom'=>$gender->getNomGender()
            ));
        }
        return new JsonResponse($genderTab);

    }

    public function getPaysAction()
    {
        $em = $this->getDoctrine()->getManager();
        $paysTab = array();
        $pays = $em->getRepository('AdministrationBundle:Pays')->findAll();

        foreach ($pays as $pay){
            array_push($paysTab, array(
                'id'=>$pay->getId(),
                'nom'=>$pay->getNiceNamePays()
            ));
        }
        return new JsonResponse($paysTab);

    }

    public function getRegionAction()
    {
        $em = $this->getDoctrine()->getManager();
        $regionTab = array();
        $regions = $em->getRepository('AdministrationBundle:Region')->findAll();

        foreach ($regions as $r){
            array_push($regionTab, array(
                'id'=>$r->getId(),
                'nom'=>$r->getNomRegion()
            ));
        }
        return new JsonResponse($regionTab);

    }

    public function securiteAction()
    {
        return $this->render('ClientBundle:Settings:securite.html.twig');

    }



    public function delCompteAction(Request $request)
    {



        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        $compte = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$user));

        $compte->setLocked(true);

        $em->flush();

        return new JsonResponse('del ok');

    }




}
