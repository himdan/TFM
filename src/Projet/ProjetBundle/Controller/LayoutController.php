<?php

namespace Projet\ProjetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
class LayoutController extends Controller
{
    public function nombreAmisAction()
    {

        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();

        if($user){
            $nbrAmis = $em->getRepository('ClientBundle:Amitie')->getNbAmis($user);

            return new JsonResponse($nbrAmis);
        }else{
            return new JsonResponse('0');
        }


    }

    public function nombreMessageAction(){
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();

        if($user){
            $nbrMessage = $em->getRepository('ClientBundle:MessageRelation')->findNombreMessage($user);

            return new JsonResponse($nbrMessage);
        }else{
            return new JsonResponse('0');
        }
    }



    public function listCategoriesAction()
    {


        $em = $this->getDoctrine()->getEntityManager();

        $cats = $em->getRepository('AdministrationBundle:Categorie')->findAll();
        $tableCats = array();
        foreach ($cats as $c){
            array_push($tableCats,array('id'=>$c->getId(),'nomCat'=>$c->getNomCategorie()

            ));
        }


        return new JsonResponse($tableCats);


    }



}
