<?php

namespace Administration\AdministrationBundle\Controller;

use Administration\AdministrationBundle\Entity\Album;
use Administration\AdministrationBundle\Entity\Media;
use Administration\AdministrationBundle\Entity\VisiteArticle;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Administration\AdministrationBundle\Entity\Article;
use Administration\AdministrationBundle\Form\ArticleType;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Article controller.
 *
 */
class ArticleController extends Controller
{
    public function addAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('AdministrationBundle:Article')->findAll();

        return $this->render('article/index.html.twig', array(
            'articles' => $articles
        ));
    }

    /**
     * Lists all Article entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('AdministrationBundle:Article')->findAll();

        return $this->render('article/index.html.twig', array(
            'articles' => $articles
        ));
    }

    /**
     * Creates a new Article entity.
     *
     */
    
    // hedi el methode eli te9bel w tsob fil base behi edhiya normalement wfina menha tawa 7achetna b method eli taffichi el article bech nzidouha en k ou post traitement w upload image ok ? ok
    public function newAction(Request $request)
    {
        $article = new Article();
        $form = $this->createForm('Administration\AdministrationBundle\Form\ArticleType', $article);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $articles = $em->getRepository('AdministrationBundle:Article')->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $article->setStatutArticle("desactive");
            $article->setDateArticle(new \DateTime());
            $article->setAuteur($user);
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('article_index');
        }

        return $this->render('article/new.html.twig', array(
            'article' => $article,
            'articles'=>$articles,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Article entity.
     *
     */
    

    public function showAction(Article $article,Request $request)
    {

        $album = new Album();
        $q = $this->getRequest();
        if($q->isMethod('POST'))
        {

            if($q->request->get('do') == 'get')
            {


                $albums=$article->getAlbum();
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

                    $article->removeAlbum($photo);
                    $em->persist($article);
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
                    $article->addAlbum($album);
                    $em->persist($article);

                    $em->flush();

                    //$ese->setLogo($photo);
                    //$em->persist($ese);
                    //$em->flush();

                    $res = array('ok'=>true);
                }

            }
            return new jsonResponse($res);

        }
        else{
            $em = $this->getDoctrine()->getManager();
            $deleteForm = $this->createDeleteForm($article);
            $nombreVisite = $em->getRepository('AdministrationBundle:VisiteArticle')->findNbrVisite($article);
            $visite = new VisiteArticle();
            $visite->setArticle($article);
            $visite->setDateVisiteArticle(new \DateTime());
            $em->persist($visite);
            $em->flush();
            return $this->render('article/show.html.twig', array(
                'article' => $article,
                'delete_form' => $deleteForm->createView(),
                'nombreVisite'=>$nombreVisite
            ));
        }

        //behi jib el code eli fel site te3i dropzone
        // nbadel el dropezone kima mte3ik ? el code eli fi west el object dropzone fih koooool chy eli fi siti fih initialement yejbed list d image deja ajout w y7othom fih en cas ou tenzel supprime tsuprimi mel server + ajout fhemt ? behi enabadelt el dropezone b wa7da azyen ama nafs kol chai att
    }

    /**
     * Displays a form to edit an existing Article entity.
     *
     */
    public function editAction(Request $request, Article $article)
    {
        $deleteForm = $this->createDeleteForm($article);
        $editForm = $this->createForm('Administration\AdministrationBundle\Form\ArticleType', $article);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('AdministrationBundle:Article')->findAll();
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('article_index');
        }

        return $this->render('article/edit.html.twig', array(
            'article' => $article,
            'articles'=>$articles,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Article entity.
     *
     */
    public function deleteAction(Request $request, Article $article)
    {
        $form = $this->createDeleteForm($article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();
        }

        return $this->redirectToRoute('article_index');
    }

    /**
     * Creates a form to delete a Article entity.
     *
     * @param Article $article The Article entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Article $article)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('article_delete', array('id' => $article->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function gridAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('AdministrationBundle:Article')->findAll();
        /*$data = array();
        foreach ($articles as $value){
            $nombreVisite = $em->getRepository('AdministrationBundle:VisiteArticle')->findNbrVisite($value);
            //$a = array($article['jour'], intval($value['nbrArticle']));
            //array_push($value);
        }

        dump($value);
        die;*/


        $nbr = $em->getRepository('AdministrationBundle:Article')->getNb();
        return $this->render('article/grid.html.twig', array(
            'articles' => $articles,
            'nbr'=>$nbr
        ));
    }
}
