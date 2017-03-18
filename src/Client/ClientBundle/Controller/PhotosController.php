<?php

namespace Client\ClientBundle\Controller;

use Administration\AdministrationBundle\Entity\Photos;
use Client\ClientBundle\Entity\Photographe;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Client\ClientBundle\Entity\Client;
use Client\ClientBundle\Form\ClientType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Client controller.
 *
 */
class PhotosController extends Controller
{
    /**
     * Lists all Client entities.
     *
     */
    public function indexAction(Request $request)
    {

        $photoUser = new Photos();
        $em = $this->getDoctrine()->getManager();
        $userSession = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $user = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$userSession));
        $q = $this->getRequest();
        if($q->isMethod('POST'))
        {

            if(($q->request->get('do') == 'get'))
            {


                $photoUser=$user->getPhotos();
                $res=array();
                foreach($photoUser as $image){

                    $url = $q->getScheme() . '://' . $q->getHttpHost() . $q->getBasePath().'/photos/'.$image->getPath();
                    $res['mocks'][] = array("serverId" => $image->getId(),"name" => $image->getName(),'url'=>$url);

                }


            }
            elseif($q->request->get('do') == 'delete'){
                if(!filter_var($q->request->get('id'),FILTER_VALIDATE_INT))
                {
                    $res = array('ok'=>false);
                }
                //supression base de donné w ba3ed fichier si suppression ok
                else{
                    $em = $this->getDoctrine()->getManager();
                    $photo = $em->getRepository('AdministrationBundle:Photos')->findOneBy(array('id'=>$q->request->get('id')));

                    $user->removePhoto($photo);
                    $em->persist($user);
                    $em->flush();
                    $res = array('ok'=>true);
                    //$article->removeAlbum();
                    ///delet from media where id = id_p
                    // wi wi hehdika c bon aasma3Ni m najmouch nesta3mlou el class media b les fonciton smte3ha ? wlh no idea amma juste la7dha fel upload nthabet bech n9olek ech ta3mel

                }

            }
            else{

                $image = $request->files->get('file');


                if(!($image instanceof UploadedFile) ) {
                    $res = array('ok'=>'7ot image');


                }else{
                    $em = $this->getDoctrine()->getManager();
                    $user = $this->get('security.token_storage')->getToken()->getUser();
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
                    $photoUser->setName('lotfi');
                    $photoUser->setFile($image);
                    $photoUser->upload();
                    $em->persist($photoUser);
                    $user->addPhoto($photoUser);
                    $em->persist($user);

                    $em->flush();

                    $res = array('ok'=>true);
                }

            }
            return new jsonResponse($res);

        }else {




            return $this->render('ClientBundle:Photos:photos.html.twig',array('user'=>$user));
        }











































    }

    public function getPhotosAction(Request $request){

        $photoUser = new Photos();
        $em = $this->getDoctrine()->getManager();
        $userSession = $this->get('security.token_storage')->getToken()->getUser();
        $photo = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$userSession));
        $photoUser=$photo->getPhotos();
        $res=array();
        foreach($photoUser as $image){
            $url = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/photos/'.$image->getPath();
            array_push($res, array('id'=>$image->getId(),'url'=>$url));



        }

        return new JsonResponse($res);

    }


    public function getPhotosFbPhotoAction($idUser){

            $conn = $this->container->get('database_connection');


            $sqlPhotos="select DISTINCT photos.id as idPhoto,photos.name as nomPhoto,photos.path as pathPhoto from photos,client_photos where photos.id=client_photos.photos_id and client_photos.client_id=".$idUser;

            $photosRow = $conn->query($sqlPhotos);

            $photos=array();
            foreach ($photosRow as $p){

                array_push($photos,array('id'=>$p['idPhoto'],'nom'=>$p['nomPhoto'],'path'=>$p['pathPhoto']));
            }







            return new JsonResponse($photos,200,array('Content-Type'=>'application/json'));




    }



    public function supprimerPhotosAction($photo){

        $photoUser = new Photos();

        $em = $this->getDoctrine()->getManager();
        $userSession = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $user = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$userSession));
        $photoS = $em->getRepository('AdministrationBundle:Photos')->find($photo);

        $user->removePhoto($photoS);
        $em->flush();

        return new JsonResponse('ok');

        //return $photo;

    }

}
