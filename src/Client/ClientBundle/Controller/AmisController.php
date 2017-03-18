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
class AmisController extends Controller
{
    /**
     * Lists all Client entities.
     *
     */

    public function pageAmisAction()
    {
        return $this->render('ClientBundle:Amis:amis.html.twig');

    }
    public function verifAmitieAction($idUser)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        //die($user->getId()."--".$idUser);
        //$existeAmitie= $em->getRepository('ClientBundle:Amitie')->checkFindByTous($idUser);
        $existeAmitieFromConnected= $em->getRepository('ClientBundle:Amitie')->findOneBy(array('toClient'=>$idUser, 'fromClient'=>$user->getId()));
        $existeAmitieToConnected= $em->getRepository('ClientBundle:Amitie')->findOneBy(array('toClient'=>$user->getId(), 'fromClient'=>$idUser));


        $relation=array();
        if(!$existeAmitieFromConnected and !$existeAmitieToConnected){
            $relation['idr']="0";
            $relation['btnContent']="Ajouter";
            //return new JsonResponse("Ajouter");

        }else{

            if($existeAmitieFromConnected){

                if($existeAmitieFromConnected->getAcceptAmitie()=="0"){

                    $relation['idr']=$existeAmitieFromConnected->getId();
                    $relation['btnContent']="annuler demande";

                    //return new JsonResponse("annuler demande");
                }else{
                    $relation['idr']=$existeAmitieFromConnected->getId();
                    $relation['btnContent']="supprimer";

                    //return new JsonResponse("supprimer");
                }



            }

            if($existeAmitieToConnected){


                if($existeAmitieToConnected->getAcceptAmitie()=="0"){


                    $relation['idr']=$existeAmitieToConnected->getId();
                    $relation['btnContent']="Accepter";


                    //return new JsonResponse("Accepter");
                }else{

                    $relation['idr']=$existeAmitieToConnected->getId();
                    $relation['btnContent']="supprimer";

                    //return new JsonResponse("supprimer");
                }

            }


        }

        return new JsonResponse($relation);


    }

    public function indexAction(request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $tous = $em->getRepository('ClientBundle:Amitie')->findByTous($user);

        $ar = array();
        foreach($tous as $ac){
            if($ac->getToClient() != $user ){
                $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$ac->getFromClient()->getImage()->getId().'.'.$ac->getFromClient()->getImage()->getUrl();
                array_push($ar,array(
                    "id" => $ac->getId(),
                    "idClient" => $ac->getToClient()->getId(),
                    "nom" => $ac->getToClient()->getNomClient(),
                    "prenom" => $ac->getToClient()->getPrenomClient(),
                    "ville" => $ac->getToClient()->getRegion()->getNomRegion(),
                    "image" =>$img

                ));
            }else{
                $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$ac->getFromClient()->getImage()->getId().'.'.$ac->getFromClient()->getImage()->getUrl();
                array_push($ar,array(
                    "id" => $ac->getId(),
                    "idClient" => $ac->getFromClient()->getId(),
                    "nom" => $ac->getFromClient()->getNomClient(),
                    "prenom" => $ac->getFromClient()->getPrenomClient(),
                    "ville" => $ac->getFromClient()->getRegion()->getNomRegion(),
                    "image" =>$img

                ));
            }

        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));
    }

    public function amisRecentAction(request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $tous = $em->getRepository('ClientBundle:Amitie')->findByRecent($user);

        $ar = array();
        foreach($tous as $ac){

            if($ac->getToClient() != $user ){
                $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$ac->getFromClient()->getImage()->getId().'.'.$ac->getFromClient()->getImage()->getUrl();

                array_push($ar,array(
                    "id" => $ac->getId(),
                    "idClient" => $ac->getToClient()->getId(),
                    "nom" => $ac->getToClient()->getNomClient(),
                    "prenom" => $ac->getToClient()->getPrenomClient(),
                    "ville" => $ac->getToClient()->getRegion()->getNomRegion(),
                    "image" =>$img

                ));
            }else{
                $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$ac->getFromClient()->getImage()->getId().'.'.$ac->getFromClient()->getImage()->getUrl();

                array_push($ar,array(
                    "id" => $ac->getId(),
                    "idClient" => $ac->getFromClient()->getId(),
                    "nom" => $ac->getFromClient()->getNomClient(),
                    "prenom" => $ac->getFromClient()->getPrenomClient(),
                    "ville" => $ac->getFromClient()->getRegion()->getNomRegion(),
                    "image" =>$img

                ));
            }
        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));
    }

    public function amisEnvoyeAction(request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $tous = $em->getRepository('ClientBundle:Amitie')->findByEnvoye($user);

        $ar = array();
        foreach($tous as $ac){


            if($ac->getToClient() != $user ){
                $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$ac->getFromClient()->getImage()->getId().'.'.$ac->getFromClient()->getImage()->getUrl();

                array_push($ar,array(
                    "id" => $ac->getId(),
                    "idClient" => $ac->getToClient()->getId(),
                    "nom" => $ac->getToClient()->getNomClient(),
                    "prenom" => $ac->getToClient()->getPrenomClient(),
                    "ville" => $ac->getToClient()->getRegion()->getNomRegion(),
                    "image" =>$img

                ));
            }else{
                $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$ac->getFromClient()->getImage()->getId().'.'.$ac->getFromClient()->getImage()->getUrl();

                array_push($ar,array(
                    "id" => $ac->getId(),
                    "idClient" => $ac->getFromClient()->getId(),
                    "nom" => $ac->getFromClient()->getNomClient(),
                    "prenom" => $ac->getFromClient()->getPrenomClient(),
                    "ville" => $ac->getFromClient()->getRegion()->getNomRegion(),
                    "image" =>$img

                ));
            }

        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));
    }

    public function amisRecuAction(request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $tous = $em->getRepository('ClientBundle:Amitie')->findByRecu($user);

        $ar = array();
        foreach($tous as $ac){


            if($ac->getToClient() != $user ){
                $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$ac->getFromClient()->getImage()->getId().'.'.$ac->getFromClient()->getImage()->getUrl();

                array_push($ar,array(
                    "id" => $ac->getId(),
                    "idClient" => $ac->getToClient()->getId(),
                    "nom" => $ac->getToClient()->getNomClient(),
                    "prenom" => $ac->getToClient()->getPrenomClient(),
                    "ville" => $ac->getToClient()->getRegion()->getNomRegion(),
                    "image" =>$img

                ));
            }else{
                $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$ac->getFromClient()->getImage()->getId().'.'.$ac->getFromClient()->getImage()->getUrl();

                array_push($ar,array(
                    "id" => $ac->getId(),
                    "idClient" => $ac->getFromClient()->getId(),
                    "nom" => $ac->getFromClient()->getNomClient(),
                    "prenom" => $ac->getFromClient()->getPrenomClient(),
                    "ville" => $ac->getToClient()->getRegion()->getNomRegion(),
                    "image" =>$img

                ));
            }
        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));
    }

    public function amisBloqueAction(request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $tous = $em->getRepository('ClientBundle:Bloque')->findBy(array('fromClient'=>$user));

        $ar = array();
        foreach($tous as $ac){


            if($ac->getToClient() != $user ){
                $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$ac->getFromClient()->getImage()->getId().'.'.$ac->getFromClient()->getImage()->getUrl();

                array_push($ar,array(
                    "id" => $ac->getId(),
                    "idClient" => $ac->getToClient()->getId(),
                    "nom" => $ac->getToClient()->getNomClient(),
                    "prenom" => $ac->getToClient()->getPrenomClient(),
                    "ville" => $ac->getToClient()->getVilleClient(),
                    "image" =>$img

                ));
            }else{
                $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$ac->getFromClient()->getImage()->getId().'.'.$ac->getFromClient()->getImage()->getUrl();

                array_push($ar,array(
                    "id" => $ac->getId(),
                    "idClient" => $ac->getFromClient()->getId(),
                    "nom" => $ac->getFromClient()->getNomClient(),
                    "prenom" => $ac->getFromClient()->getPrenomClient(),
                    "ville" => $ac->getFromClient()->getVilleClient(),
                    "image" =>$img

                ));
            }
        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));
    }

    public function bloqueSupprimerAction($userSupprimer)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $suppr = $em->getRepository('ClientBundle:Bloque')->findOneBy(array('id'=>$userSupprimer,'fromClient'=>$user));
        if($suppr){
            $em->remove($suppr);
            $em->flush();

            return new JsonResponse('suppression ok');
        }else{
            return new JsonResponse('not found');
        }

    }

    public function amiSupprimerAction($userSupprimer)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $suppr = $em->getRepository('ClientBundle:Amitie')->findOneBy(array('id'=>$userSupprimer));
        //die($userSupprimer);
        if($suppr){
            $em->remove($suppr);
            $em->flush();

            return new JsonResponse('suppression ok');
        }else{
            return new JsonResponse('not found');
        }

    }

    public function amiSignalAction(Request $request)
    {
        if($request->getMethod()=="POST"){

            $dataA = json_decode($request->getContent(), true);

            $request->request->replace($dataA);

            $idPourSignaler = $request->request->get('ids');
            $textSignal = $request->request->get('text');


            $signal = new SignalUser();
            $em = $this->getDoctrine()->getEntityManager();
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $signalUserAdd = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$idPourSignaler ));
            $signalUserRecherche = $em->getRepository('ClientBundle:SignalUser')->findOneBy(array('toClient'=>$idPourSignaler ));

            if($signalUserRecherche){

                return new JsonResponse(array("success"=>"0","msg"=>"Déja Signalé"));

            }else if ($signalUserAdd){
                $signal->setTexteSignalUser($textSignal);
                $signal->setToClient($signalUserAdd);
                $signal->setFromClient($user);
                $signal->setDateSignalUser(new \DateTime());
                $em->persist($signal);
                $em->flush();

                return new JsonResponse(array("success"=>"1","msg"=>"Signalé avec success"));

            }else{

                return new JsonResponse('not found');

            }




        }else{

            die('vous pouvez pas acceder a cet url');

        }


    }

    public function amiAnnulerAction($userAnnuler)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $suppr = $em->getRepository('ClientBundle:Amitie')->findOneBy(array('toClient'=>$userAnnuler, 'fromClient'=>$user));

        if($suppr){
            $em->remove($suppr);
            $em->flush();

            return new JsonResponse('annulation ok');
        }else{
            return new JsonResponse('not found');
        }

    }

    public function amiAccepterAction($userAccepter)
    {

        $em = $this->getDoctrine()->getManager();
        $amitie = new Amitie();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $suppr = $em->getRepository('ClientBundle:Amitie')->findOneBy(array('toClient'=>$user, 'fromClient'=>$userAccepter, 'acceptAmitie'=>'0'));

        if($suppr){
            $suppr->setAcceptAmitie("1");
            $em->flush();

            return new JsonResponse('acceptation ok');
        }else{
            return new JsonResponse('not found');
        }

    }

    public function amiRefuserAction($userRefuser)
    {

        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $suppr = $em->getRepository('ClientBundle:Amitie')->findOneBy(array('toClient'=>$user, 'fromClient'=>$userRefuser, 'acceptAmitie'=>'0'));

        if($suppr){
            $em->remove($suppr);
            $em->flush();

            return new JsonResponse('refus ok');
        }else{
            return new JsonResponse('not found');
        }

    }



    /*******************⋅AJOUTER AMIS**********************/



    public function amiAjouterAction($iduser)
    {

        $amitie = new Amitie();
        $em = $this->getDoctrine()->getEntityManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $amitieExiste = $em->getRepository('ClientBundle:Amitie')->checkExisteAmi($iduser);

        if ($amitieExiste) {

            return new JsonResponse(array("success" => "0", "msg" => "Déja Signalé"));

        } else {
            $userTo = $em->getRepository('ClientBundle:Client')->findOneBy(array('id' => $iduser));
            $amitie->setFromClient($user);
            $amitie->setToClient($userTo);
            $amitie->setAcceptAmitie("0");
            $amitie->setDateAmitie(new \DateTime());

            $em->persist($amitie);
            $em->flush();
            return new JsonResponse(array("success" => "1", "msg" => "Demande envoyé avec succes"));

        }


    }


    public function getAmiTagAction(request $request)
    {

        $data = array();
        $chaine = $this->get('request')->request->get('chaine');
        $user = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $conn = $this->container->get('database_connection');
        $sql =
            "select * from amitie,client WHERE (
                ((amitie.to_client_id = client.id) OR 
                (amitie.from_client_id = client.id ))  AND 
                ( (accept_amitie = '1') and (client.nom_client = $chaine)) HAVING 
                (client.id = $user)
                
            ) limit 3";



        $rows = $conn->query($sql);

        foreach ($rows as $r){
            //$img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$r['id'].'.'.$r['url'];
            array_push($data, array('preparation'=>$r['nom_client']));

        }

        return new JsonResponse($data,200,array('Content-Type'=>'application/json'));
    }

    /*******************⋅AJOUTER AMIS**********************/




}
