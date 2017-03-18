<?php

namespace Client\ClientBundle\Controller;

use Client\ClientBundle\Entity\Commentaire;
use Client\ClientBundle\Entity\Notification;
use Client\ClientBundle\Entity\Photographe;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

use Client\ClientBundle\Entity\Client;
use Client\ClientBundle\Form\ClientType;

/**
 * Client controller.
 *
 */
class CommentaireController extends Controller
{
    /**
     * Lists all Client entities.
     *
     */
    public function commenterAction(Request $request)
    {
        if($request->getMethod()=="POST") {

            $dataA = json_decode($request->getContent(), true);

            $request->request->replace($dataA);

            $idPourCommenter = $request->request->get('id');
            $commentaireRecu = $request->request->get('commentaire');
            $type = $request->request->get('type');


            $em = $this->getDoctrine()->getManager();
            $commentaire = new Commentaire();
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $commentaire->setClient($user);
            $commentaire->setDateCommentaire(new \DateTime());
            $commentaire->setTexteCommentaire($commentaireRecu);

            if($type=="recette"){
                $commentaire->setTypeCommentaire("recette");
                $recette = $em->getRepository('AdministrationBundle:Recette')->find($idPourCommenter);
                $commentaire->setCommentaireRecette($recette);
            }

            if($type=="article"){
                $commentaire->setTypeCommentaire("article");
                $article = $em->getRepository('AdministrationBundle:Article')->find($idPourCommenter);
                $commentaire->setCommentaireArticle($article);
            }

            if($type=="publication"){
                $commentaire->setTypeCommentaire("publication");
                $publication = $em->getRepository('ClientBundle:Publication')->find($idPourCommenter);
                $commentaire->setCommentairePublication($publication);
                $notification = new Notification();
                $notification->setClient($user);
                $notification->setDateNotification(new \DateTime());
                $notification->setDescriptionNotification('a commenté votre publication');
                $notification->setPublication($publication);
                $notification->setLuNotification('#C95430');
                $em->persist($notification);
            }

            if($type=="etablissement"){
                $commentaire->setTypeCommentaire("etablissement");
                $etablissement = $em->getRepository('AdministrationBundle:Etablissement')->find($idPourCommenter);
                $commentaire->setCommentaireEtablissement($etablissement);
                $photographe = $em->getRepository('ClientBundle:Photographe')->findOneBy(array('client'=>$user,'typePhotographe'=>'ecrivain'));
                if($photographe){
                    $photographe->setNbrPoint($photographe->getNbrPoint() + 50);
                    $em->flush($photographe);
                }else{
                    $photographe = new Photographe();
                    $photographe->setClient($user);
                    $photographe->setNbrPoint(50);
                    $photographe->setTypePhotographe('ecrivain');
                    $em->persist($photographe);

                }
            }

            if($type=="photos"){
                $commentaire->setTypeCommentaire("photos");
                $photo = $em->getRepository('AdministrationBundle:Photos')->find($idPourCommenter);
                $commentaire->setCommentairePhoto($photo);
            }


            $em->persist($commentaire);
            $em->flush();


            $response = array('success'=>'commentaire c bon','type'=>$type);
            return new JsonResponse($response,200,array('Content-Type'=>'application/json'));

        }else{
            die("Vous avez pas le droit d'acceder a cet url");
        }
        //return $this->render('ClientBundle:Amis:amis.html.twig');




    }


    public function deleteCommentAction(Request $request)
    {
        if($request->getMethod()=="POST") {

            $dataA = json_decode($request->getContent(), true);

            $request->request->replace($dataA);

            $idToDelete = $request->request->get('id');
            $type = $request->request->get('type');

            $user = $this->get('security.token_storage')->getToken()->getUser();
            $em = $this->getDoctrine()->getManager();

            if($type=="recette"){
                $commentToDel=$this->getDoctrine()->getRepository('ClientBundle:Commentaire')->findOneBy(array('id'=>$idToDelete,'client'=>$user));

                if($commentToDel){
                    $em->remove($commentToDel);
                    $em->flush();

                    die('cbon');


                }else{
                    die('yé mahouch mawjoud ye 3andekch el 7a9');
                }

            }



            if($type=="article"){
                $commentToDel=$this->getDoctrine()->getRepository('ClientBundle:Commentaire')->findOneBy(array('id'=>$idToDelete,'client'=>$user));

                if($commentToDel){
                    $em->remove($commentToDel);
                    $em->flush();

                    die('cbon');


                }else{
                    die('yé mahouch mawjoud ye 3andekch el 7a9');
                }

            }


            if($type=="publication"){
                $commentToDel=$this->getDoctrine()->getRepository('ClientBundle:Commentaire')->findOneBy(array('id'=>$idToDelete,'client'=>$user));

                if($commentToDel){
                    $em->remove($commentToDel);
                    $em->flush();

                    die('cbon');


                }else{
                    die('yé mahouch mawjoud ye 3andekch el 7a9');
                }

            }



            if($type=="etablissement"){
                $commentToDel=$this->getDoctrine()->getRepository('ClientBundle:Commentaire')->findOneBy(array('id'=>$idToDelete,'client'=>$user));

                if($commentToDel){
                    $em->remove($commentToDel);
                    $em->flush();

                    die('cbon');


                }else{
                    die('yé mahouch mawjoud ye 3andekch el 7a9');
                }

            }

            if($type=="photos"){
                $commentToDel=$this->getDoctrine()->getRepository('ClientBundle:Commentaire')->findOneBy(array('id'=>$idToDelete,'client'=>$user));

                if($commentToDel){
                    $em->remove($commentToDel);
                    $em->flush();

                    die('cbon');


                }else{
                    die('yé mahouch mawjoud ye 3andekch el 7a9');
                }

            }


        }else{
            die('vous pouvez pas acceder a cet url');
        }


        }



    public function getCommentsAction(Request $request)
    {
        if($request->getMethod()=="POST") {

            $dataA = json_decode($request->getContent(), true);

            $request->request->replace($dataA);

            $idPourAfficher = $request->request->get('id');
            $type = $request->request->get('type');
            $tranche = $request->request->get('tranche');
            //$fromRow=5*($tranche - 1);
            $em = $this->getDoctrine()->getManager();
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $conn = $this->container->get('database_connection');

            if($type=="recette"){

                $sqlnbrComments="select count(commentaire.id) from commentaire
                    WHERE commentaire.commentaire_recette_id=".$idPourAfficher;

                $nbrComments =$conn->query($sqlnbrComments)->fetchColumn();


                $sql="select commentaire.id as commentId,media.id as mediaImage,media.url, commentaire.client_id as clientId,commentaire.date_commentaire as commentDate,
                      commentaire.commentaire_recette_id as recetteId,commentaire.texte_commentaire as commentText, client.username as nomClient
                      from commentaire,client,media
                    WHERE commentaire.client_id=client.id and client.image_id=media.id and commentaire.commentaire_recette_id=".$idPourAfficher." order by commentaire.id desc LIMIT 0,".$tranche*5;

                /*$sql="select commentaire.id as commentId, commentaire.client_id as clientId,commentaire.date_commentaire as commentDate,
                      commentaire.commentaire_recette_id as recetteId,commentaire.texte_commentaire as commentText, client.username as nomClient
                      ,media.id as mediaImage,media.url
                      from commentaire,client,media
                    WHERE (commentaire.client_id=client.id) and (client.image_id=media.id) and commentaire.commentaire_recette_id=".$idPourAfficher." order by commentaire.id desc LIMIT 0,".$tranche*5;*/


                $rows = $conn->query($sql);

                $result=array();
                foreach ($rows as $r){
                    $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$r['mediaImage'].'.'.$r['url'];
                    if($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')){
                        if($user->getId() == $r['clientId']){
                            array_push($result, array('commentId'=>$r['commentId'],'nomClient'=>$r['nomClient'],'deletable'=>true,'commentDate'=>$r['commentDate'],'commentText'=>$r['commentText'],"image"=>$img));


                        }else{
                            array_push($result, array('commentId'=>$r['commentId'],'nomClient'=>$r['nomClient'],'deletable'=>false,'commentDate'=>$r['commentDate'],'commentText'=>$r['commentText'],"image"=>$img));


                        }
                    }else{
                        array_push($result, array('commentId'=>$r['commentId'],'nomClient'=>$r['nomClient'],'deletable'=>false,'commentDate'=>$r['commentDate'],'commentText'=>$r['commentText'],"image"=>$img));
                    }


                }


            }



            /**************************ARTICLE*****************************/

            if($type=="article"){

                $sqlnbrComments="select count(commentaire.id) from commentaire
                    WHERE commentaire.commentaire_article_id=".$idPourAfficher;

                $nbrComments =$conn->query($sqlnbrComments)->fetchColumn();


                $sql="select commentaire.id as commentId,media.id as mediaImage,media.url, commentaire.client_id as clientId,commentaire.date_commentaire as commentDate,
                      commentaire.commentaire_article_id as articleId,commentaire.texte_commentaire as commentText, client.username as nomClient
                      from commentaire,client,media
                    WHERE commentaire.client_id=client.id and client.image_id=media.id and commentaire.commentaire_article_id=".$idPourAfficher." order by commentaire.id desc LIMIT 0,".$tranche*5;

                /*$sql="select commentaire.id as commentId, commentaire.client_id as clientId,commentaire.date_commentaire as commentDate,
                      commentaire.commentaire_recette_id as recetteId,commentaire.texte_commentaire as commentText, client.username as nomClient
                      ,media.id as mediaImage,media.url
                      from commentaire,client,media
                    WHERE (commentaire.client_id=client.id) and (client.image_id=media.id) and commentaire.commentaire_recette_id=".$idPourAfficher." order by commentaire.id desc LIMIT 0,".$tranche*5;*/


                $rows = $conn->query($sql);

                $result=array();
                foreach ($rows as $r){
                    $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$r['mediaImage'].'.'.$r['url'];
                    if($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')){
                        if($user->getId() == $r['clientId']){
                            array_push($result, array('commentId'=>$r['commentId'],'nomClient'=>$r['nomClient'],'deletable'=>true,'commentDate'=>$r['commentDate'],'commentText'=>$r['commentText'],"image"=>$img));


                        }else{
                            array_push($result, array('commentId'=>$r['commentId'],'nomClient'=>$r['nomClient'],'deletable'=>false,'commentDate'=>$r['commentDate'],'commentText'=>$r['commentText'],"image"=>$img));


                        }
                    }else{
                        array_push($result, array('commentId'=>$r['commentId'],'nomClient'=>$r['nomClient'],'deletable'=>false,'commentDate'=>$r['commentDate'],'commentText'=>$r['commentText'],"image"=>$img));
                    }


                }


            }





            /**************************ARTICLE*****************************/



            /**************************ETABLISSEMENT*****************************/

            if($type=="etablissement"){

                $sqlnbrComments="select count(commentaire.id) from commentaire
                    WHERE commentaire.commentaire_etablissement_id=".$idPourAfficher;

                $nbrComments =$conn->query($sqlnbrComments)->fetchColumn();


                $sql="select commentaire.id as commentId,media.id as mediaImage,media.url, commentaire.client_id as clientId,commentaire.date_commentaire as commentDate,
                      commentaire.commentaire_etablissement_id as articleId,commentaire.texte_commentaire as commentText, client.username as nomClient
                      from commentaire,client,media
                    WHERE commentaire.client_id=client.id and client.image_id=media.id and commentaire.commentaire_etablissement_id=".$idPourAfficher." order by commentaire.id desc LIMIT 0,".$tranche*5;

                /*$sql="select commentaire.id as commentId, commentaire.client_id as clientId,commentaire.date_commentaire as commentDate,
                      commentaire.commentaire_recette_id as recetteId,commentaire.texte_commentaire as commentText, client.username as nomClient
                      ,media.id as mediaImage,media.url
                      from commentaire,client,media
                    WHERE (commentaire.client_id=client.id) and (client.image_id=media.id) and commentaire.commentaire_recette_id=".$idPourAfficher." order by commentaire.id desc LIMIT 0,".$tranche*5;*/


                $rows = $conn->query($sql);

                $result=array();
                foreach ($rows as $r){
                    $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$r['mediaImage'].'.'.$r['url'];
                    if($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')){
                        if($user->getId() == $r['clientId']){
                            array_push($result, array('commentId'=>$r['commentId'],'nomClient'=>$r['nomClient'],'deletable'=>true,'commentDate'=>$r['commentDate'],'commentText'=>$r['commentText'],"image"=>$img));


                        }else{
                            array_push($result, array('commentId'=>$r['commentId'],'nomClient'=>$r['nomClient'],'deletable'=>false,'commentDate'=>$r['commentDate'],'commentText'=>$r['commentText'],"image"=>$img));


                        }
                    }else{
                        array_push($result, array('commentId'=>$r['commentId'],'nomClient'=>$r['nomClient'],'deletable'=>false,'commentDate'=>$r['commentDate'],'commentText'=>$r['commentText'],"image"=>$img));
                    }


                }


            }

            /***************PHOTOOOOS********************/


            if($type=="photos"){

                $sqlnbrComments="select count(commentaire.id) from commentaire
                    WHERE commentaire.commentaire_photo_id=".$idPourAfficher;

                $nbrComments =$conn->query($sqlnbrComments)->fetchColumn();


                $sql="select commentaire.id as commentId,media.id as mediaImage,media.url, commentaire.client_id as clientId,commentaire.date_commentaire as commentDate,
                      commentaire.commentaire_etablissement_id as articleId,commentaire.texte_commentaire as commentText, client.username as nomClient
                      from commentaire,client,media
                    WHERE commentaire.client_id=client.id and client.image_id=media.id and commentaire.commentaire_photo_id=".$idPourAfficher." order by commentaire.id desc LIMIT 0,".$tranche*5;

                /*$sql="select commentaire.id as commentId, commentaire.client_id as clientId,commentaire.date_commentaire as commentDate,
                      commentaire.commentaire_recette_id as recetteId,commentaire.texte_commentaire as commentText, client.username as nomClient
                      ,media.id as mediaImage,media.url
                      from commentaire,client,media
                    WHERE (commentaire.client_id=client.id) and (client.image_id=media.id) and commentaire.commentaire_recette_id=".$idPourAfficher." order by commentaire.id desc LIMIT 0,".$tranche*5;*/


                $rows = $conn->query($sql);

                $result=array();
                foreach ($rows as $r){
                    $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$r['mediaImage'].'.'.$r['url'];
                    if($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')){
                        if($user->getId() == $r['clientId']){
                            array_push($result, array('commentId'=>$r['commentId'],'nomClient'=>$r['nomClient'],'deletable'=>true,'commentDate'=>$r['commentDate'],'commentText'=>$r['commentText'],"image"=>$img));


                        }else{
                            array_push($result, array('commentId'=>$r['commentId'],'nomClient'=>$r['nomClient'],'deletable'=>false,'commentDate'=>$r['commentDate'],'commentText'=>$r['commentText'],"image"=>$img));


                        }
                    }else{
                        array_push($result, array('commentId'=>$r['commentId'],'nomClient'=>$r['nomClient'],'deletable'=>false,'commentDate'=>$r['commentDate'],'commentText'=>$r['commentText'],"image"=>$img));
                    }


                }


            }



            /***************PHOTOOOOS********************/




            $response['nbrTotal'] = $nbrComments;
            $response['comments'] = array_reverse($result);
            return new JsonResponse($response,200,array('Content-Type'=>'application/json'));

        }else{
            die("Vous avez pas le droit d'acceder a cet url");
        }
    }



}
