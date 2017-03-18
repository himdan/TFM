<?php

namespace Client\ClientBundle\Controller;



use Client\ClientBundle\Entity\Rank;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Client\ClientBundle\Entity\Client;
use Client\ClientBundle\Form\ClientType;

/**
 * Client controller.
 *
 */
class RankController extends Controller
{
    
    //rank
    public function AddrankAction($id,$type,$nbr)
    {
        $em = $this->getDoctrine()->getManager();
        $rank = new Rank();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($type=="recette"){
            $existeRank= $em->getRepository('ClientBundle:Rank')->findOneBy(array('rankRecette'=>$id, 'client'=>$user, 'typeRank'=>$type));
        }
        if($type=="article"){
            $existeRank= $em->getRepository('ClientBundle:Rank')->findOneBy(array('rankArticle'=>$id, 'client'=>$user, 'typeRank'=>$type));
        }
        if($type=="etablissement"){
            $existeRank= $em->getRepository('ClientBundle:Rank')->findOneBy(array('rankEtablissement'=>$id, 'client'=>$user, 'typeRank'=>$type));
        }
        if($existeRank){

            $existeRank->setNbrRank($nbr);

            $em->flush();
            $response = array('success'=>'Votre note a été changé avec succès');

        }else{

            if ($type == 'recette') {

                $recette = $em->getRepository('AdministrationBundle:Recette')->find($id);
                $rank->setRankRecette($recette);
                $rank->setTypeRank($type);
                $rank->setNbrRank($nbr);

            }
            if ($type == 'article') {

                $article = $em->getRepository('AdministrationBundle:Article')->find($id);
                $rank->setRankArticle($article);
                $rank->setTypeRank($type);
                $rank->setNbrRank($nbr);

            }

            if ($type == 'etablissement') {

                $etablissement = $em->getRepository('AdministrationBundle:Etablissement')->find($id);
                $rank->setRankEtablissement($etablissement);
                $rank->setTypeRank($type);
                $rank->setNbrRank($nbr);

            }



            $rank->setClient($user);

            $em->persist($rank);
            $em->flush();
            $response = array('success'=>'Votre note a été pris en considération');

        }
        return new JsonResponse($response,200,array('Content-Type'=>'application/json'));
    }








}
