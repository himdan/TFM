<?php

namespace Client\ClientBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Client\ClientBundle\Entity\Client;
use Client\ClientBundle\Form\ClientType;

/**
 * Client controller.
 *
 */
class LieuxController extends Controller
{
    /**
     * Lists all Client entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $lieux = $em->getRepository('ClientBundle:SavedLieuUser')->findByLieu($user);
        return $this->render('ClientBundle:Lieux:lieux.html.twig', array('lieux'=>$lieux));
    }

    public function lieuxJsonAction(request $request){

        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $lieux = $em->getRepository('ClientBundle:SavedLieuUser')->findByLieu($user);

        $lieuxArray = array();
        foreach ($lieux as $lieu){
            $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$lieu->getEtablissement()->getImage()->getId().'.'.$lieu->getEtablissement()->getImage()->getUrl();
            array_push($lieuxArray,array(
                'id'=>$lieu->getId(),
                'nom'=>$lieu->getEtablissement()->getNomEtablissement(),
                'img'=>$img,
                'date'=>$lieu->getDateSavedLieuUser()->format('Y-m-d'),
                'description'=>$lieu->getEtablissement()->getDescriptionEtablissement(),
                'adresse' => $lieu->getEtablissement()->getAdresseEtablissement()
            ));
        }

        return new JsonResponse($lieuxArray);
    }


}
