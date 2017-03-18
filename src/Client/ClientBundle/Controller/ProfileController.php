<?php

namespace Client\ClientBundle\Controller;

use Client\ClientBundle\Entity\Amitie;
use Client\ClientBundle\Entity\Bloque;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Client\ClientBundle\Entity\Client;
use Client\ClientBundle\Form\ClientType;

/**
 * Client controller.
 *
 */
class ProfileController extends Controller
{
    /**
     * Lists all Client entities.
     *
     */
    public function layoutRightAction($userId)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$userId));

        return $this->render('ClientBundle:Profile:layoutRight.html.twig', array('user'=>$user));


    }

    public function layoutLeftAction($userId, request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$userId));
        $tous = $em->getRepository('ClientBundle:Amitie')->findByTous($user);
        $lieux = $em->getRepository('ClientBundle:SavedLieuUser')->findByLieu($user);
        $ar = array();
        foreach($tous as $ac){
            if($ac->getToClient() != $user ){
                $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$ac->getToClient()->getImage()->getId().'.'.$ac->getFromClient()->getImage()->getUrl();
                array_push($ar,array(
                    "id" => $ac->getId(),
                    "idClient" => $ac->getToClient()->getId(),
                    "nom" => $ac->getToClient()->getNomClient(),
                    "prenom" => $ac->getToClient()->getPrenomClient(),
                    "ville" => $ac->getToClient()->getRegion(),
                    "image" =>$img

                ));
            }else{
                $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$ac->getFromClient()->getImage()->getId().'.'.$ac->getFromClient()->getImage()->getUrl();
                array_push($ar,array(
                    "id" => $ac->getId(),
                    "idClient" => $ac->getFromClient()->getId(),
                    "nom" => $ac->getFromClient()->getNomClient(),
                    "prenom" => $ac->getFromClient()->getPrenomClient(),
                    "ville" => $ac->getFromClient()->getRegion(),
                    "image" =>$img

                ));
            }

        }

        $lieuxArray = array();
        foreach ($lieux as $lieu){
            $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$lieu->getEtablissement()->getImage()->getId().'.'.$lieu->getEtablissement()->getImage()->getUrl();
            array_push($lieuxArray,array(
                'id'=>$lieu->getId(),
                'nom'=>$lieu->getEtablissement()->getNomEtablissement(),
                'img'=>$img,
                'date'=>$lieu->getDateSavedLieuUser()->format('Y-m-d'),
                'description'=>$lieu->getEtablissement()->getDescriptionEtablissement()
            ));
        }
        $avis = $em->getRepository('ClientBundle:Rank')->findRankByUser($userId);
        $favoris = $em->getRepository('ClientBundle:Favoris')->findFavorisByUser($user);
        return $this->render('ClientBundle:Profile:layoutLeft.html.twig',
            array(
                'user'=>$user,
                'nbrAvis'=>$avis,
                'amis'=>$ar,
                'nbrfavoris'=>$favoris,
                'lieux'=>$lieuxArray
            ));


    }

    public function indexAction($userId)
    {


        $em = $this->getDoctrine()->getManager();
        $userConnexion = $this->get('security.token_storage')->getToken()->getUser();
        $existeBloque= $em->getRepository('ClientBundle:Bloque')->findByBloque($userId);
        $avis = $em->getRepository('ClientBundle:Rank')->findRankByUser($userId);
        $user = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$userId));
        if(($existeBloque) && ($userId != $userConnexion->getId())){

            return $this->render('ProjetBundle:Default:404.html.twig');

        }else{


            //$user->setVisiteClient((int)$user->getVisiteClient() + 1);
            $em->flush();
            return $this->render('ClientBundle:Profile:profile.html.twig', array('user'=>$user));

        }


    }

    public function demandeAmitieAction($to)
    {

        $em = $this->getDoctrine()->getManager();
        $amitie = new Amitie();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $toClient = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$to));
        $existeAmitie= $em->getRepository('ClientBundle:Amitie')->findOneBy(array('toClient'=>$toClient, 'fromClient'=>$user));

        if($existeAmitie){

            if($existeAmitie->getAcceptAmitie() == '0'){

                $response = array('success'=>'demande en attente');

            }else{

                $response = array('success'=>'deja amis');

            }

        }else{

            if($user == $toClient){
                $response = array('success'=>'echec d\'envoie');
            }else{
                $amitie->setAcceptAmitie('0');
                $amitie->setDateAmitie(new \DateTime());
                $amitie->setToClient($toClient);
                $amitie->setFromClient($user);
                $em->persist($amitie);
                $em->flush();


                $response = array('success'=>'demande ajoute');
            }


        }


        return new JsonResponse($response,200,array('Content-Type'=>'application/json'));
    }

    public function communAction(){

        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $existeCommun = $em->getRepository('ClientBundle:Amitie')->findByCommun($user);
        dump($existeCommun);
        die;
        $reqponse = array('commun'=>array('user'=>$existeCommun->get));
        return new JsonResponse('ok',200,array('Content-Type'=>'application/json'));
    }


    public function bloqueAmitieAction($to)
    {

        $em = $this->getDoctrine()->getManager();
        $bloque = new Bloque();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $toClient = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$to));
        $existeBloque= $em->getRepository('ClientBundle:Bloque')->findOneBy(array('toClient'=>$toClient, 'fromClient'=>$user));
        if($existeBloque){
            $response = array('success'=>'deja bloque');
        }else{
            $bloque->setFromClient($user);
            $bloque->setToClient($toClient);
            $bloque->setDateBloque(new \DateTime());
            $em->persist($bloque);
            $em->flush();
            $response = array('success'=>'bloque ok');
        }


        return new JsonResponse($response,200,array('Content-Type'=>'application/json'));
    }






    public function filtredUsersAction(Request $request){

        if($request->getMethod()=="POST"){

            $dataA = json_decode($request->getContent(), true);



            $request->request->replace($dataA);

            $data = array();
            $em = $this->getDoctrine()->getEntityManager();
            $nom = $request->request->get('nom');
            $minAge = $request->request->get('minAge');
            $maxAge = $request->request->get('maxAge');
            $gov = $request->request->get('gov');
            $reg = $request->request->get('reg');
            $sex = $request->request->get('sex');
            $sit = $request->request->get('sit');


            function reverse_birthday( $years ){
                return date('Y-m-d', strtotime($years . ' years ago'));
            }


            if(($minAge == 0) and ($maxAge == 100)){
                $condAge="1=1";
            }else{
                $condAge="(client.date_naissance_client BETWEEN '".reverse_birthday($maxAge)."' and '".reverse_birthday($minAge)."')";

            }


            if(strlen($nom)<2){
                $condText="1=1";
            }else{

                $condText="((client.nom_client like '%".$nom."%') or (client.username like '%".$nom."%') or (client.prenom_client like '%".$nom."%'))";

            }
            if(strlen($gov) == 0){
                $condGov="1=1";
            }else{

                $condGov="(client.gouvernorat_id =".$gov.")";

            }

            if(strlen($reg) == 0){
                $condReg="1=1";
            }else{

                $condReg="(client.region_id =".$reg.")";

            }

            if(strlen($sex)==0){
                $condSex="1=1";
            }else{
                $condSex="(client.sexe_client ='".$sex."')";
            }

            if(strlen($sit)==0){
                $condSit="1=1";
            }else{
                $condSit="(client.situation_client ='".$sit."')";
            }



            $conn = $this->container->get('database_connection');

            $requeteSqlClient="select DISTINCT client.id,client.username,client.nom_client,client.prenom_client,client.date_naissance_client as ddn,media.url,media.id as mediaImage from client,media where ((client.image_id = media.id)) and "
                .$condText." and ".$condGov." and ".$condReg." and ".$condSex." and ".$condSit." and ".$condAge;

            $rows = $conn->query($requeteSqlClient);
            $result=array();


            foreach ($rows as $r){
                $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$r['mediaImage'].'.'.$r['url'];
                    array_push($result, array('id'=>$r['id'],'image'=>$img,'age'=>(date('Y') - date('Y',strtotime($r['ddn']))),'username'=>$r['username'],'nom'=>$r['nom_client'],'prenom'=>$r['prenom_client']));

            }
            $data['sql']=$requeteSqlClient;
            $data['result']=$result;
            return new JsonResponse($data,200,array('Content-Type'=>'application/json'));



            //return new JsonResponse($data,200,array('Content-Type'=>'application/json'));

        }else{

            die('vous pouvez pas acceder a cette url');
        }

    }



    public function testDDNAction($age){


        function reverse_birthday( $years ){
            return date('Y-m-d', strtotime($years . ' years ago'));
        }

        $bd = reverse_birthday($age);
        // 1993-04-16


        die('ouii hne el age: '.$bd);
    }


    public function userNearAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $client = $em->getRepository('ClientBundle:Client')->find($user);
        $query = $em->createQuery("SELECT (p.image) as imageClient,(m.url) as urlMedia, p.id as idClient, p.prenomClient as prenomClient,p.nomClient as nomClient, p.latClient as latClient , p.longClient as longClient, ( 6386 * ACOS( COS( radians(36.7581145) ) * COS( radians( p.latClient ) ) * COS( radians( p.longClient ) - radians(10.0169723) ) + sin( radians(36.7581145) ) * sin( radians( p.latClient ) ) ) ) AS distance FROM ClientBundle:Client p,AdministrationBundle:Media m WHERE (m.id = p.image) HAVING  (distance < 100) ");
        $query->setMaxResults(3);
        $result = $query->getResult();
        $ar = array();

        foreach($result as $ac){
            $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$ac['imageClient'].'.'.$ac['urlMedia'];

            array_push($ar,array(
                "id" => $ac['idClient'],
                'nom'=>$ac['nomClient'],
                'prenom'=>$ac['prenomClient'],
                'image'=>$img,
                'distance'=>$ac['distance'],
                'lat'=>$ac['latClient'],
                'long'=>$ac['longClient']

            ));
        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));
    }


}
