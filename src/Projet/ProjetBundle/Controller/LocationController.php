<?php

namespace Projet\ProjetBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class LocationController extends Controller
{



    public function locationAction()
    {




        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery("SELECT (p.image) as imageLocation, p.id as idLocation, p.nomRecette as titreLocation, p.latRecette as latLocation , p.longRecette as longLocation, ( 6386 * ACOS( COS( radians(36.7581145) ) * COS( radians( p.latRecette ) ) * COS( radians( p.longRecette ) - radians(10.0169723) ) + sin( radians(36.7581145) ) * sin( radians( p.latRecette ) ) ) / 2 ) AS distance FROM AdministrationBundle:Recette p WHERE (p.nomRecette LIKE '%tunis%' )");
        $result = $query->getResult();
        $ar = array();

        foreach($result as $ac){
            $request = $this->getRequest();
            $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$ac['imageLocation'];
            array_push($ar,array(
                "id" => $ac['idLocation'],
                'titre'=>$ac['titreLocation'],
                'image'=>$img,
                'distance'=>$ac['distance'],
                'lat'=>$ac['latLocation'],
                'long'=>$ac['longLocation']

            ));
        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));
    }
}
