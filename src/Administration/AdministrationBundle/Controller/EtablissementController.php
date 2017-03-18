<?php

namespace Administration\AdministrationBundle\Controller;

use Administration\AdministrationBundle\Entity\Album;
use Administration\AdministrationBundle\Entity\Carte;
use Administration\AdministrationBundle\Entity\Media;
use Symfony\Bundle\SecurityBundle\Tests\Functional\Bundle\AclBundle\Entity\Car;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Administration\AdministrationBundle\Entity\Etablissement;
use Administration\AdministrationBundle\Form\EtablissementType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Etablissement controller.
 *
 */
class EtablissementController extends Controller
{
    /**
     * Lists all Etablissement entities.
     *
     */

    public function etablissement_getAllAction()
    {

        $result = array();

        $em = $this->getDoctrine()->getEntityManager();

        $lieuxAuto = $this->get('request')->request->get('lieuxAuto');

        $affaires = $em->getRepository('AdministrationBundle:Etablissement')->recherche($lieuxAuto);

        foreach ($affaires as $affaire){
            array_push($result, array(
                'id'=>$affaire->getId(),
                'nom'=>$affaire->getNomEtablissement()
            ));
        }


        return new JsonResponse($result);

    }

    public function autorisationAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $etablissement = $em->getRepository('AdministrationBundle:Etablissement')->findOneBy(array('id'=>$id));
        $etablissement->setAutorisationEtablissement('active');
        $em->persist($etablissement);
        $em->flush();
        $etablissements = $em->getRepository('AdministrationBundle:Etablissement')->findAll();
        $entities = $this->get('knp_paginator')->paginate($etablissements,$this->get('request')->query->get('page', 1), 50);
        return $this->render('etablissement/index.html.twig', array(
            'etablissements' => $entities,
        ));
    }

    public function sponsorAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $etablissement = $em->getRepository('AdministrationBundle:Etablissement')->findOneBy(array('id'=>$id));
        $etablissement->setSponsorEtablissement('active');
        $em->persist($etablissement);
        $em->flush();
        $etablissements = $em->getRepository('AdministrationBundle:Etablissement')->findAll();
        $entities = $this->get('knp_paginator')->paginate($etablissements,$this->get('request')->query->get('page', 1), 50);
        return $this->render('etablissement/index.html.twig', array(
            'etablissements' => $entities,
        ));
    }

    public function nonsponsorAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $etablissement = $em->getRepository('AdministrationBundle:Etablissement')->findOneBy(array('id'=>$id));
        $etablissement->setSponsorEtablissement('desactive');
        $em->persist($etablissement);
        $em->flush();
        $etablissements = $em->getRepository('AdministrationBundle:Etablissement')->findAll();
        $entities = $this->get('knp_paginator')->paginate($etablissements,$this->get('request')->query->get('page', 1), 50);
        return $this->render('etablissement/index.html.twig', array(
            'etablissements' => $entities,
        ));
    }

    public function nonautorisationAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $etablissement = $em->getRepository('AdministrationBundle:Etablissement')->findOneBy(array('id'=>$id));
        $etablissement->setAutorisationEtablissement('desactive');
        $em->persist($etablissement);
        $em->flush();
        $etablissements = $em->getRepository('AdministrationBundle:Etablissement')->findAll();
        $entities = $this->get('knp_paginator')->paginate($etablissements,$this->get('request')->query->get('page', 1), 50);
        return $this->render('etablissement/index.html.twig', array(
            'etablissements' => $entities,
        ));
    }


    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $etablissements = $em->getRepository('AdministrationBundle:Etablissement')->findAll();
        $entities = $this->get('knp_paginator')->paginate($etablissements,$this->get('request')->query->get('page', 1), 50);
        return $this->render('etablissement/index.html.twig', array(
            'etablissements' => $entities,
        ));
    }

    public function demandeAction()
    {
        $em = $this->getDoctrine()->getManager();

        $etablissements = $em->getRepository('AdministrationBundle:Etablissement')->findByDemande();

        return $this->render('etablissement/demande.html.twig', array(
            'etablissements' => $etablissements,
        ));
    }

    public function sponsorPageAction()
    {
        $em = $this->getDoctrine()->getManager();

        $etablissements = $em->getRepository('AdministrationBundle:Etablissement')->findBySponsor();

        return $this->render('etablissement/sponsor.html.twig', array(
            'etablissements' => $etablissements,
        ));
    }

    public function etablissementalbumAction($id, Request $request)
    {

        $album = new Album();
        $em = $this->getDoctrine()->getManager();
        $etablissement = $em->getRepository('AdministrationBundle:Etablissement')->findOneBy(array('id'=>$id));

        $q = $this->getRequest();
        if($q->isMethod('POST'))
        {

            if(($q->request->get('do') == 'get'))
            {


                $albums=$etablissement->getAlbum();
                $res=array();
                foreach($albums as $image){

                    $url = $q->getScheme() . '://' . $q->getHttpHost() . $q->getBasePath().'/album/'.$image->getPath();
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
                    $photo = $em->getRepository('AdministrationBundle:Album')->findOneBy(array('id'=>$q->request->get('id')));

                    $etablissement->removeAlbum($photo);
                    $em->persist($etablissement);
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
                    $album->setName('lotfi');
                    $album->setFile($image);
                    $album->upload();
                    $em->persist($album);
                    $etablissement->addAlbum($album);
                    $em->persist($etablissement);

                    $em->flush();

                    //$ese->setLogo($photo);
                    //$em->persist($ese);
                    //$em->flush();

                    $res = array('ok'=>true);
                }

            }
            return new jsonResponse($res);

        }else {




            return $this->render('etablissement/album.html.twig', array('etablissement'=>$etablissement));
        }

    }


    // carte

    public function etablissementcarteAction($id, Request $request)
    {

        $carte = new Carte();
        $em = $this->getDoctrine()->getManager();
        $etablissement = $em->getRepository('AdministrationBundle:Etablissement')->findOneBy(array('id'=>$id));

        $q = $this->getRequest();
        if($q->isMethod('POST'))
        {

            if(($q->request->get('do') == 'get'))
            {


                $carte=$etablissement->getCarte();
                $res=array();
                foreach($carte as $image){

                    $url = $q->getScheme() . '://' . $q->getHttpHost() . $q->getBasePath().'/carte/'.$image->getPath();
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
                    $photo = $em->getRepository('AdministrationBundle:Carte')->findOneBy(array('id'=>$q->request->get('id')));

                    $etablissement->removeCarte($photo);
                    $em->persist($etablissement);
                    $em->flush();
                    $res = array('ok'=>true);
                    //$article->removeAlbum();
                    ///delet from media where id = id_p
                    // wi wi hehdika c bon aasma3Ni m najmouch nesta3mlou el class media b les fonciton smte3ha ? wlh no idea amma juste la7dha fel upload nthabet bech n9olek ech ta3mel

                }

            }
            else{

                $image = $request->files->get('file');
                $user = $this->get('security.token_storage')->getToken()->getUser();

                if(!($image instanceof UploadedFile) ) {
                    $res = array('ok'=>'7ot image');


                }else{
                    $em = $this->getDoctrine()->getManager();
                    $carte->setName('lotfi');
                    $carte->setFile($image);
                    $carte->setClient($user);
                    $carte->upload();
                    $em->persist($carte);
                    $etablissement->addCarte($carte);
                    $em->persist($etablissement);

                    $em->flush();

                    //$ese->setLogo($photo);
                    //$em->persist($ese);
                    //$em->flush();

                    $res = array('ok'=>true);
                }

            }
            return new jsonResponse($res);

        }else {




            return $this->render('etablissement/carte.html.twig', array('etablissement'=>$etablissement));
        }

    }



    /**
     * Creates a new Etablissement entity.
     *
     */
    public function newAction(Request $request)
    {
        $etablissement = new Etablissement();
        $form = $this->createForm('Administration\AdministrationBundle\Form\EtablissementType', $etablissement);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        $etablissements = $em->getRepository('AdministrationBundle:Etablissement')->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($etablissement);
            $em->flush();

            return $this->redirectToRoute('etablissement_index');
        }

        return $this->render('etablissement/new.html.twig', array(
            'etablissement' => $etablissement,
            'etablissements'=>$etablissements,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Etablissement entity.
     *
     */
    public function showAction(Etablissement $etablissement,Request $request)
    {

        $carte = new Carte();
        $album = new Album();
        $q = $this->getRequest();
        if($q->isMethod('POST'))
        {

            if($q->request->get('do') == 'get')
            {

                if($q->request->get('action') == 'album'){

                    $albums=$etablissement->getAlbum();
                    $res=array();
                    foreach($albums as $image){

                        $url = $q->getScheme() . '://' . $q->getHttpHost() . $q->getBasePath().'/album/'.$image->getPath();
                        $res['mocks'][] = array("serverId" => $image->getId(),"name" => $image->getName(),'url'=>$url);

                    }
                }


                if($q->request->get('action') == 'carte'){

                    $cartes=$etablissement->getCarte();
                    $res=array();
                    foreach($cartes as $image){

                        $url = $q->getScheme() . '://' . $q->getHttpHost() . $q->getBasePath().'/album/'.$image->getPath();
                        $res['mocksCarte'][] = array("serverId" => $image->getId(),"name" => $image->getName(),'url'=>$url);

                    }

                }




            }
            else{

                $image = $request->files->get('file');


                if(!($image instanceof UploadedFile) ) {
                    $res = array('ok'=>'7ot image');


                }else{
                    $em = $this->getDoctrine()->getManager();
                    $album->setName('lotfi');
                    $album->setFile($image);
                    $album->upload();
                    $em->persist($album);
                    $etablissement->addAlbum($album);
                    $em->persist($etablissement);

                    $em->flush();

                    //$ese->setLogo($photo);
                    //$em->persist($ese);
                    //$em->flush();

                    $res = array('ok'=>true);
                }

            }


            return new jsonResponse($res);

        }else {


            $deleteForm = $this->createDeleteForm($etablissement);

            return $this->render('etablissement/show.html.twig', array(
                'etablissement' => $etablissement,
                'delete_form' => $deleteForm->createView(),
            ));

        }
    }

    /**
     * Displays a form to edit an existing Etablissement entity.
     *
     */
    public function editAction(Request $request, Etablissement $etablissement)
    {
        $deleteForm = $this->createDeleteForm($etablissement);
        $editForm = $this->createForm('Administration\AdministrationBundle\Form\EtablissementType', $etablissement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($etablissement);
            $em->flush();

            return $this->redirectToRoute('etablissement_index');
        }

        return $this->render('etablissement/edit.html.twig', array(
            'etablissement' => $etablissement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Etablissement entity.
     *
     */
    public function deleteAction(Request $request, Etablissement $etablissement)
    {
        $form = $this->createDeleteForm($etablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($etablissement);
            $em->flush();
        }

        return $this->redirectToRoute('etablissement_index');
    }

    /**
     * Creates a form to delete a Etablissement entity.
     *
     * @param Etablissement $etablissement The Etablissement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Etablissement $etablissement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('etablissement_delete', array('id' => $etablissement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
