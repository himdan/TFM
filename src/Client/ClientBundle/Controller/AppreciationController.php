<?php

namespace Client\ClientBundle\Controller;

use Client\ClientBundle\Entity\Appreciation;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Client\ClientBundle\Entity\Client;
use Client\ClientBundle\Form\ClientType;

/**
 * Client controller.
 *
 */
class AppreciationController extends Controller
{
    
    // j'aime
    public function AddappreciationAction($id,$type)
    {
        $em = $this->getDoctrine()->getManager();
        $appreciation = new Appreciation();
        $user = $this->get('security.token_storage')->getToken()->getUser();




        if($type=="recette"){
            $existeRecette= $em->getRepository('ClientBundle:Appreciation')->findOneBy(array('appreciationRecette'=>$id, 'client'=>$user, 'typeAppreciation'=>$type));
        }
        if($type=="article"){
            $existeRecette= $em->getRepository('ClientBundle:Appreciation')->findOneBy(array('appreciationArticle'=>$id, 'client'=>$user, 'typeAppreciation'=>$type));

        }
        if($type=="publication"){
            $existeRecette= $em->getRepository('ClientBundle:Appreciation')->findOneBy(array('appreciationPublication'=>$id, 'client'=>$user, 'typeAppreciation'=>$type));

        }

        // cc , att nchoof


        if($type=="etablissement"){
            $existeRecette= $em->getRepository('ClientBundle:Appreciation')->findOneBy(array('appreciationEtablissement'=>$id, 'client'=>$user, 'typeAppreciation'=>$type));

        }
        //var_dump($existeRecette);


        if($type=="photos"){
            $existeRecette= $em->getRepository('ClientBundle:Appreciation')->findOneBy(array('appreciationPhoto'=>$id, 'client'=>$user, 'typeAppreciation'=>$type));

        }


        if($existeRecette){

            if ($existeRecette->getAimeAppreciation() == '1') {

                $existeRecette->setAimeAppreciation('0');
                $existeRecette->setNaimePasAppreciation('0');

            }else{
                $existeRecette->setAimeAppreciation('1');
                $existeRecette->setNaimePasAppreciation('0');
            }

            $em->flush();
            $response = array('success'=>'update jaime ok');

        }else{

            if ($type == 'recette') {

                $recette = $em->getRepository('AdministrationBundle:Recette')->find($id);
                $appreciation->setAppreciationRecette($recette);
                $appreciation->setTypeAppreciation($type);
                $appreciation->setAimeAppreciation('1');
                $appreciation->setNaimePasAppreciation('0');
            }

            if ($type == 'article') {

                $article = $em->getRepository('AdministrationBundle:Article')->find($id);
                $appreciation->setAppreciationArticle($article);
                $appreciation->setTypeAppreciation($type);
                $appreciation->setAimeAppreciation('1');
                $appreciation->setNaimePasAppreciation('0');
            }


            if ($type == 'publication') {

                $publication = $em->getRepository('ClientBundle:Publication')->find($id);
                $appreciation->setAppreciationPublication($publication);
                $appreciation->setTypeAppreciation($type);
                $appreciation->setAimeAppreciation('1');
                $appreciation->setNaimePasAppreciation('0');
            }
            if($type=="etablissement"){

                $etablissement = $em->getRepository('AdministrationBundle:Etablissement')->find($id);
                $appreciation->setAppreciationEtablissement($etablissement);
                $appreciation->setTypeAppreciation($type);
                $appreciation->setAimeAppreciation('1');
                $appreciation->setNaimePasAppreciation('0');

            }

            if($type=="photos"){

                $photo = $em->getRepository('AdministrationBundle:Photos')->find($id);
                $appreciation->setAppreciationPhoto($photo);
                $appreciation->setTypeAppreciation($type);
                $appreciation->setAimeAppreciation('1');
                $appreciation->setNaimePasAppreciation('0');

            }
            $appreciation->setClient($user);

            $em->persist($appreciation);
            $em->flush();
            $response = array('success'=>'ajout jaime ok');

        }
        return new JsonResponse($response,200,array('Content-Type'=>'application/json'));
    }




    // j'aime pas
    public function deleteappreciationAction($id,$type)
    {
        $em = $this->getDoctrine()->getManager();
        $appreciation = new Appreciation();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($type=="recette"){
            $existeRecette= $em->getRepository('ClientBundle:Appreciation')->findOneBy(array('appreciationRecette'=>$id, 'client'=>$user, 'typeAppreciation'=>$type));
        }
        if($type=="article"){
            $existeRecette= $em->getRepository('ClientBundle:Appreciation')->findOneBy(array('appreciationArticle'=>$id, 'client'=>$user, 'typeAppreciation'=>$type));
        }
        if($type=="publication"){
            $existeRecette= $em->getRepository('ClientBundle:Appreciation')->findOneBy(array('appreciationPublication'=>$id, 'client'=>$user, 'typeAppreciation'=>$type));

        }


        if($type=="etablissement"){
            $existeRecette= $em->getRepository('ClientBundle:Appreciation')->findOneBy(array('appreciationEtablissement'=>$id, 'client'=>$user, 'typeAppreciation'=>$type));

        }


        if($type=="photos"){
            $existeRecette= $em->getRepository('ClientBundle:Appreciation')->findOneBy(array('appreciationPhoto'=>$id, 'client'=>$user, 'typeAppreciation'=>$type));

        }


        if($existeRecette){

            if($existeRecette->getNaimePasAppreciation() == '1'){
                $existeRecette->setAimeAppreciation('0');
                $existeRecette->setNaimePasAppreciation('0');
            }else{
                $existeRecette->setNaimePasAppreciation('1');
                $existeRecette->setAimeAppreciation('0');
            }





            $em->flush();
            $response = array('success'=>'update jaime pas ok');

        }else{

            if ($type == 'recette') {

                $recette = $em->getRepository('AdministrationBundle:Recette')->find($id);
                $appreciation->setAppreciationRecette($recette);
                $appreciation->setTypeAppreciation($type);
                $appreciation->setAimeAppreciation('0');
                $appreciation->setNaimePasAppreciation('1');
            }

            if ($type == 'article') {

                $article = $em->getRepository('AdministrationBundle:Article')->find($id);
                $appreciation->setAppreciationArticle($article);
                $appreciation->setTypeAppreciation($type);
                $appreciation->setAimeAppreciation('0');
                $appreciation->setNaimePasAppreciation('1');
            }


            if ($type == 'publication') {

                $publication = $em->getRepository('ClientBundle:Publication')->find($id);
                $appreciation->setAppreciationPublication($publication);
                $appreciation->setTypeAppreciation($type);
                $appreciation->setAimeAppreciation('0');
                $appreciation->setNaimePasAppreciation('1');
            }
            if($type=="etablissement"){

                $etablissement = $em->getRepository('AdministrationBundle:Etablissement')->find($id);
                $appreciation->setAppreciationEtablissement($etablissement);
                $appreciation->setTypeAppreciation($type);
                $appreciation->setAimeAppreciation('0');
                $appreciation->setNaimePasAppreciation('1');

            }
            if($type=="photos"){

                $photo = $em->getRepository('AdministrationBundle:Photos')->find($id);
                $appreciation->setAppreciationPhoto($photo);
                $appreciation->setTypeAppreciation($type);
                $appreciation->setAimeAppreciation('0');
                $appreciation->setNaimePasAppreciation('1');

            }
            $appreciation->setClient($user);

            $em->persist($appreciation);
            $em->flush();
            $response = array('success'=>'ajout jaime pas ok');

        }
        return new JsonResponse($response,200,array('Content-Type'=>'application/json'));
    }



    // j'aime pas
    public function GetappreciationAction($id,$type)
    {
        $em = $this->getDoctrine()->getManager();
        $appreciation = new Appreciation();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($type=="recette"){
            $existeRecette= $em->getRepository('ClientBundle:Appreciation')->findOneBy(array('appreciationRecette'=>$id, 'client'=>$user, 'typeAppreciation'=>$type));

        }

        if($type=="article"){
            $existeRecette= $em->getRepository('ClientBundle:Appreciation')->findOneBy(array('appreciationArticle'=>$id, 'client'=>$user, 'typeAppreciation'=>$type));

        }


        if($type=="publication"){
            $existeRecette= $em->getRepository('ClientBundle:Appreciation')->findOneBy(array('appreciationPublication'=>$id, 'client'=>$user, 'typeAppreciation'=>$type));

        }

        if($type=="etablissement"){
            $existeRecette= $em->getRepository('ClientBundle:Appreciation')->findOneBy(array('appreciationEtablissement'=>$id, 'client'=>$user, 'typeAppreciation'=>$type));

        }
        if($type=="photos"){
            $existeRecette= $em->getRepository('ClientBundle:Appreciation')->findOneBy(array('appreciationPhoto'=>$id, 'client'=>$user, 'typeAppreciation'=>$type));

        }

        if($existeRecette){



            /*if($existeRecette->getNaimePasAppreciation() == '1'){
                $existeRecette->setAimeAppreciation('0');
                $existeRecette->setNaimePasAppreciation('0');
            }else{
                $existeRecette->setNaimePasAppreciation('1');
                $existeRecette->setAimeAppreciation('0');
            }


            $em->flush();
            $response = array('success'=>'update jaime pas ok');*/
            //JsonResponse($existeRecette,200,array('Content-Type'=>'application/json'));

            $apprec=array();
            $apprec['id']=$existeRecette->getId();
            $apprec['aime']=$existeRecette->getAimeAppreciation();
            $apprec['aimepas']=$existeRecette->getNaimePasAppreciation();
            $response=$apprec;
        }else{

            $apprec=array();
            $apprec['id']="";
            $apprec['aime']="";
            $apprec['aimepas']="";
            $response=$apprec;

        }
        return new JsonResponse($response,200,array('Content-Type'=>'application/json'));
    }




}
