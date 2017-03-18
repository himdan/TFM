<?php

namespace Client\ClientBundle\Controller;

use Client\ClientBundle\ClientBundle;
use Client\ClientBundle\Entity\Amitie;
use Client\ClientBundle\Entity\Photographe;
use Client\ClientBundle\Entity\Publication;
use Client\ClientBundle\Entity\PublicationPhotos;
use Client\ClientBundle\Entity\SavedLieuUser;
use Client\ClientBundle\Entity\SignalUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Client\ClientBundle\Entity\Client;
use Client\ClientBundle\Form\ClientType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * Client controller.
 *
 */
class PublicationController extends Controller
{
    /**
     * Lists all Client entities.
     *
     */

    public function addPublicationAction(Request $request)
    {
        if($request->getMethod()=="POST"){

            //$dataA = json_decode($request->getContent(), true);

            //$request->request->replace($dataA);

            //$textPub = $request->request->get('text');

            $image = $request->files->get('image');

            $texte=$request->request->get('text');

            $lieu=$request->request->get('lieu');

            $savedLieu = new SavedLieuUser();

            if(!($image instanceof UploadedFile) ) {


                $user = $this->get('security.token_storage')->getToken()->getUser();
                $em = $this->getDoctrine()->getEntityManager();




                $pub = new Publication();
                $pub->setClient($user);

                if($lieu !=0){
                    $lieuRecherche = $em->getRepository('AdministrationBundle:Etablissement')->find($lieu);
                    $pub->setEtablissement($lieuRecherche);
                    $savedLieu->setEtablissement($lieuRecherche);
                    $savedLieu->setClient($user);
                    $savedLieu->setDateSavedLieuUser(new \DateTime());
                    $em->persist($savedLieu);
                }

                $pub->setTextePublication($texte)->setDatePublication(new \DateTime());
                $em->persist($pub);

                $em->flush();
                return new JsonResponse(array("success"=>"1","msg"=>"Publication SANS IMAGE Ajouté avec succes"));



            }else {


                $publicationPhoto = new PublicationPhotos();



                $user = $this->get('security.token_storage')->getToken()->getUser();
                $em = $this->getDoctrine()->getEntityManager();

                $pub = new Publication();


                if($lieu !=0){
                    $lieuRecherche = $em->getRepository('AdministrationBundle:Etablissement')->find($lieu);
                    $pub->setEtablissement($lieuRecherche);
                    $savedLieu->setEtablissement($lieuRecherche);
                    $savedLieu->setClient($user);
                    $savedLieu->setDateSavedLieuUser(new \DateTime());
                    $em->persist($savedLieu);
                }


                $pub->setClient($user);
                $pub->setTextePublication($texte)->setDatePublication(new \DateTime());



                $alea=md5(uniqid(rand(), true));
                $publicationPhoto->setName($alea);
                $publicationPhoto->setFile($image);
                //$publicationPhoto->setPath($alea);
                $photographe = $em->getRepository('ClientBundle:Photographe')->findOneBy(array('client'=>$user,'typePhotographe'=>'photographe'));
                //$client = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$user));
                if($photographe){
                    $photographe->setNbrPoint($photographe->getNbrPoint() + 2);

                    $em->flush($photographe);
                }else{
                    $photographe = new Photographe();
                    $photographe->setClient($user);
                    $photographe->setNbrPoint(2);
                    $photographe->setTypePhotographe('photographe');


                    $em->persist($photographe);
                    $em->flush($photographe);
                }


                $publicationPhoto->upload();
                $em->persist($publicationPhoto);

                $pub->setImage($publicationPhoto);
                $em->persist($pub);


                $em->flush();
                return new JsonResponse(array("success"=>"1","msg"=>"Publication AVEC IMAGE Ajouté avec succes"));



            }


        }else{
            die('vous pouvez pas acceder a cet url');
        }


    }


    public function getPublicationsAction($idu,$tranche,Request $request){


        $conn = $this->container->get('database_connection');

        $sqlNbrPub="select count(id) from publication where client_id=".$idu;
        $nbrPub =$conn->query($sqlNbrPub)->fetchColumn();

        if($tranche==-1){
            $sqlPubs="select id,texte_publication,date_publication,client_id as clientId,image_id as imgPub, etablissement_id as id_etab from publication where client_id=".$idu." order by id desc";
        }else{
            $sqlPubs="select id,texte_publication,date_publication,client_id as clientId,image_id as imgPub, etablissement_id as id_etab from publication where client_id=".$idu." order by id desc LIMIT 0,".$tranche*4;
        }




        $pubs = $conn->query($sqlPubs);
        $em = $this->getDoctrine()->getEntityManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $result=array();
        foreach ($pubs as $p){

            /*VERIFICATION KEN FEHA PHOTO IZIDHA*/
            if($p['imgPub'] == null){

                $nomTof=false;

            }else{

                $sqlGetTof="select path from publication_photos where id=".$p['imgPub'];
                $nomPhoto =$conn->query($sqlGetTof)->fetchColumn();

                $nomTof=$request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/publicationphotos/'.$nomPhoto;
            }

            if($p['id_etab'] == null){
                $id_etab = false;
            }else{
                $id_etab = $p['id_etab'];
                $sqlGetLieu="select nom_etablissement as nomLieu from etablissement where id=".$p['id_etab'];
                $nomLieu =$conn->query($sqlGetLieu)->fetchColumn();


            }


            /*VERIFICATION KEN FEHA PHOTO IZIDHA*/



            if($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')){
                if($user->getId() == $p['clientId']){
                    $deletable=true;
                }else{
                    $deletable=false;
                }

            }else{
                $deletable=false;
            }

            $sqlnbrComments="select count(commentaire.id) from commentaire
                    WHERE commentaire_publication_id=".$p['id'];

            $nbrComments =$conn->query($sqlnbrComments)->fetchColumn();



            $sqlComments="select commentaire.id as commentId,texte_commentaire,client_id as clientId,media.id as mediaImage,media.url,client.username as nomClient from commentaire,client,media
                        where commentaire.client_id=client.id and client.image_id=media.id and commentaire_publication_id=".$p['id']." order by commentaire.id desc LIMIT 0,4";

            $commentsSql = $conn->query($sqlComments);
            $comments=array();
            foreach ($commentsSql as $c){
                $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$c['mediaImage'].'.'.$c['url'];



                if($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')){
                    if($user->getId() == $c['clientId']){
                        $deletableComment=true;
                    }else{
                        $deletableComment=false;
                    }

                }else{
                    $deletableComment=false;
                }





                array_push($comments,array('id'=>$c['commentId'],'deletable'=>$deletableComment,'texte'=>$c['texte_commentaire'],'nomClient'=>$c['nomClient'],'imgUser'=>$img));
            }


            //hne bech na3mel les operations ellezmin béch ne5o el nbrJaime w aimePas el kol publicaiton


            //nbrAime
            $sqlnbrAime="select count(appreciation.id) from appreciation
                    WHERE aime_appreciation=1 and type_appreciation='publication' and appreciation_publication_id=".$p['id'];

            $nbrAime =$conn->query($sqlnbrAime)->fetchColumn();


            //nbrAimePas
            $sqlnbrAimePas="select count(appreciation.id) from appreciation
                    WHERE naimePasAppreciation=1 and type_appreciation='publication' and appreciation_publication_id=".$p['id'];

            $nbrAimePas =$conn->query($sqlnbrAimePas)->fetchColumn();










            if(isset($nomLieu)){
                $nomLieuS=$nomLieu;
            }else{
                $nomLieuS=false;
            }

            $appreciation=$em->getRepository('ClientBundle:Appreciation')->findOneBy(array('appreciationPublication'=>$p['id'], 'client'=>$user, 'typeAppreciation'=>"publication"));

            if(!$appreciation){
                array_push($result, array('id'=>$p['id'], 'idLieu'=>$id_etab,'nomLieu'=>$nomLieuS,'imgPub'=>$nomTof,'nbrAimePas'=>$nbrAimePas,'nbrAime'=>$nbrAime,'nbrComments'=>$nbrComments,'comments'=>array_reverse($comments),'deletable'=>$deletable,'appr'=>'aucune','imgAime'=>'../../../dist/img/online-likeBtn.png','imgAimePas'=>'../../../dist/img/pnline-dislikeBtn.png','texte'=>$p['texte_publication'],'date'=>$p['date_publication']));
            }else{
                if($appreciation->getAimeAppreciation()=="1"){
                    array_push($result, array('id'=>$p['id'], 'idLieu'=>$id_etab,'nomLieu'=>$nomLieuS,'imgPub'=>$nomTof,'nbrAimePas'=>$nbrAimePas,'nbrAime'=>$nbrAime,'nbrComments'=>$nbrComments,'comments'=>array_reverse($comments),'deletable'=>$deletable,'appr'=>"aime",'imgAime'=>'../../../dist/img/likerouge.png','imgAimePas'=>'../../../dist/img/pnline-dislikeBtn.png','texte'=>$p['texte_publication'],'date'=>$p['date_publication']));

                }elseif ($appreciation->getNaimePasAppreciation()=="1"){
                    array_push($result, array('id'=>$p['id'], 'idLieu'=>$id_etab,'nomLieu'=>$nomLieuS,'imgPub'=>$nomTof,'nbrAimePas'=>$nbrAimePas,'nbrAime'=>$nbrAime,'nbrComments'=>$nbrComments,'comments'=>array_reverse($comments),'deletable'=>$deletable,'appr'=>"aimepas",'imgAime'=>'../../../dist/img/online-likeBtn.png','imgAimePas'=>'../../../dist/img/deslikerouge.png','texte'=>$p['texte_publication'],'date'=>$p['date_publication']));

                }else{
                    array_push($result, array('id'=>$p['id'], 'idLieu'=>$id_etab,'nomLieu'=>$nomLieuS,'imgPub'=>$nomTof,'nbrAimePas'=>$nbrAimePas,'nbrAime'=>$nbrAime,'nbrComments'=>$nbrComments,'comments'=>array_reverse($comments),'deletable'=>$deletable,'appr'=>'aucune','imgAime'=>'../../../dist/img/online-likeBtn.png','imgAimePas'=>'../../../dist/img/pnline-dislikeBtn.png','texte'=>$p['texte_publication'],'date'=>$p['date_publication']));

                }
            }










        }

        $rep['result']=$result;
        $rep['nbr']=$nbrPub;



        return new JsonResponse($rep,200,array('Content-Type'=>'application/json'));




    }


    public function deletePublicationAction($idPub){

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();

        $pubToDel=$this->getDoctrine()->getRepository('ClientBundle:Publication')->findOneBy(array('id'=>$idPub,'client'=>$user));
        $result=array();
        if($pubToDel){
            $em->remove($pubToDel);
            $em->flush();
            $result['message']="publication effacé avec succes";
            $result['success']="1";
            return new JsonResponse($result,200,array('Content-Type'=>'application/json'));

        }else{


            $result['message']="publication effacé avec succes";
            $result['success']="0";
            return new JsonResponse($result,200,array('Content-Type'=>'application/json'));


        }



    }





    public function getMoreCommentsPublicationAction(Request $request){

        if($request->getMethod()=="POST"){

            $dataA = json_decode($request->getContent(), true);

            $request->request->replace($dataA);

            $idPourAfficher = $request->request->get('id');
            $tranche = $request->request->get('tranche');

            $em = $this->getDoctrine()->getEntityManager();

            $user = $this->get('security.token_storage')->getToken()->getUser();

            $conn = $this->container->get('database_connection');


            $sqlnbrComments="select count(commentaire.id) from commentaire
                    WHERE commentaire_publication_id=".$idPourAfficher;

            $nbrComments =$conn->query($sqlnbrComments)->fetchColumn();


            $sqlComments="select commentaire.id as commentId,texte_commentaire,client_id as clientId,media.id as mediaImage,media.url,client.username as nomClient from commentaire,client,media
                        where commentaire.client_id=client.id and client.image_id=media.id and commentaire_publication_id=".$idPourAfficher." order by commentaire.id desc LIMIT 0,".$tranche*4;

            $commentsSql = $conn->query($sqlComments);
            $comments=array();

            foreach ($commentsSql as $c){
                $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$c['mediaImage'].'.'.$c['url'];



                if($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')){
                    if($user->getId() == $c['clientId']){
                        $deletableComment=true;
                    }else{
                        $deletableComment=false;
                    }

                }else{
                    $deletableComment=false;
                }





                array_push($comments,array('id'=>$c['commentId'],'deletable'=>$deletableComment,'texte'=>$c['texte_commentaire'],'nomClient'=>$c['nomClient'],'imgUser'=>$img));
            }

            $result['nbr']=$nbrComments;
            $result['comments']=array_reverse($comments);


            return new JsonResponse(array_reverse($result),200,array('Content-Type'=>'application/json'));



        }else{
            die('vous pouvez pas acceder a cet url');
        }


    }




}