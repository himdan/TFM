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
class TopMemberController extends Controller
{
    /**
     * Lists all Client entities.
     *
     */

    public function indexAction()
    {
        return $this->render('ClientBundle:TopMember:topmember.html.twig');

    }

    public function topPhotographeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $conn = $this->container->get('database_connection');
        $sqlRctFav="select photographe.id as idPhotographe, client.id as idClient,client.nom_client as nomClient,client.prenom_client as prenomClient,media.url,region.nom_region as regionClient,
                    photographe.nbr_point as nbrPoint ,
                    media.id as mediaImage
                    from region,photographe,media,client
                    where photographe.type_photographe like 'photographe' and client.region_id = region.id and client.image_id = media.id and client.id=photographe.client_id ORDER BY nbrPoint DESC LIMIT 3 ";

        $rows = $conn->query($sqlRctFav);
        $result=array();
        foreach ($rows as $r){
            $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$r['mediaImage'].'.'.$r['url'];
            //$gouvernorat = $em->getRepository('AdministrationBundle:Gouvernorat')->findOneBy(array('id'=>$r['gouvernorat']));
            array_push($result,
                array(
                    'region'=>$r['regionClient'],
                    'idClient'=>$r['idClient'],
                    'idPhotographe'=>$r['idPhotographe'],
                    'nom'=>$r['nomClient'],
                    'prenom'=>$r['prenomClient'],
                    'nbrpoint'=>$r['nbrPoint'],
                    'image'=>$img,
                )
            );
        }
        return new JsonResponse($result);
    }

    public function topEcrivainAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $conn = $this->container->get('database_connection');
        $sqlRctFav="select photographe.id as idPhotographe, client.id as idClient,client.nom_client as nomClient,client.prenom_client as prenomClient,media.url,region.nom_region as regionClient,
                    photographe.nbr_point as nbrPoint ,
                    media.id as mediaImage
                    from region,photographe,media,client
                    where photographe.type_photographe like 'ecrivain' and client.region_id = region.id and client.image_id = media.id and client.id=photographe.client_id ORDER BY nbrPoint DESC LIMIT 3 ";

        $rows = $conn->query($sqlRctFav);
        $result=array();
        foreach ($rows as $r){
            $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$r['mediaImage'].'.'.$r['url'];
            //$gouvernorat = $em->getRepository('AdministrationBundle:Gouvernorat')->findOneBy(array('id'=>$r['gouvernorat']));
            array_push($result,
                array(
                    'region'=>$r['regionClient'],
                    'idClient'=>$r['idClient'],
                    'idPhotographe'=>$r['idPhotographe'],
                    'nom'=>$r['nomClient'],
                    'prenom'=>$r['prenomClient'],
                    'nbrpoint'=>$r['nbrPoint'],
                    'image'=>$img,
                )
            );
        }
        return new JsonResponse($result);
    }

    public function topGourmandAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $conn = $this->container->get('database_connection');
        $sqlRctFav="select SUM(photographe.nbr_point) as somme ,photographe.id as idPhotographe, client.id as idClient,client.nom_client as nomClient,client.prenom_client as prenomClient,media.url,region.nom_region as regionClient,
                    photographe.nbr_point as nbrPoint ,
                    media.id as mediaImage
                    from region,photographe,media,client
                    where client.region_id = region.id and client.image_id = media.id and client.id=photographe.client_id GROUP BY photographe.client_id ORDER BY somme DESC LIMIT 3 ";

        $rows = $conn->query($sqlRctFav);
        $result=array();
        foreach ($rows as $r){
            $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$r['mediaImage'].'.'.$r['url'];
            //$gouvernorat = $em->getRepository('AdministrationBundle:Gouvernorat')->findOneBy(array('id'=>$r['gouvernorat']));
            array_push($result,
                array(
                    'region'=>$r['regionClient'],
                    'idClient'=>$r['idClient'],
                    'idPhotographe'=>$r['idPhotographe'],
                    'nom'=>$r['nomClient'],
                    'prenom'=>$r['prenomClient'],
                    'nbrpoint'=>$r['nbrPoint'],
                    'image'=>$img,
                    'somme'=>$r['somme'],
                )
            );
        }
        return new JsonResponse($result);
    }

    public function afficheBarreAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $conn = $this->container->get('database_connection');
        $sqlRctFav="select SUM(photographe.nbr_point) as somme
                    from photographe,client
                    where client.id=photographe.client_id and client.id =".$user->getId();

        $rows = $conn->fetchAssoc($sqlRctFav);

        return new JsonResponse(intval($rows['somme']));
    }

}
