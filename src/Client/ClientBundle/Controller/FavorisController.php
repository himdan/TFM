<?php

namespace Client\ClientBundle\Controller;

use Client\ClientBundle\Entity\Favoris;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Client\ClientBundle\Entity\Client;
use Client\ClientBundle\Form\ClientType;

/**
 * Client controller.
 *
 */
class FavorisController extends Controller
{
    /**
     * Lists all Client entities.
     *
     */
    public function indexAction($userId)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('ClientBundle:Client')->findOneBy(array('id'=>$userId));
        return $this->render('ClientBundle:Favoris:favoris.html.twig',array('user'=>$user));



    }




    public function favorisRecetteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $conn = $this->container->get('database_connection');
        $sqlRctFav="select favoris.id as idFavoris, recette.id as idRecette,recette.nom_recette as nomRecette,recette.cuisson_recette as cuissonRecette,recette.preparation_recette as preparationRecette,media.url,
                    (select SUM(nbr_rank)/count(id) from rank where rank_recette_id=recette.id ) as nvnote ,
                    (select count(id) from rank where rank_recette_id=recette.id ) as nbrVote, 
                    media.id as mediaImage,
                    difficulte.id as difficulte,
                    prix.id as prix
                    from recette,favoris,media,difficulte ,prix
                    where recette.prix_id = prix.id and recette.difficulte_id = difficulte.id and recette.image_id = media.id and recette.id=favoris.favoris_recette_id and favoris.client_id=".$user->getId();
        $rows = $conn->query($sqlRctFav);
        $result=array();
        foreach ($rows as $r){
            $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$r['mediaImage'].'.'.$r['url'];
            $difficulte = $em->getRepository('AdministrationBundle:Difficulte')->findOneBy(array('id'=>$r['difficulte']));
            $prix = $em->getRepository('AdministrationBundle:Prix')->findOneBy(array('id'=>$r['prix']));
                array_push($result,
                    array(
                        'prix'=>$prix->getNomPrix(),
                        'difficulte'=>$difficulte->getNomDifficulte(),
                        'preparation'=>$r['preparationRecette'],
                        'cuisson'=>$r['cuissonRecette'],
                        'id'=>$r['idRecette'],
                        'idFavoris'=>$r['idFavoris'],
                        'recette'=>$r['nomRecette'],
                        'note'=>$r['nvnote'],
                        'nbrVote'=>$r['nbrVote'],
                        'image'=>$img,
                    )
                );
        }
       return new JsonResponse($result);
    }

    public function favorisArticleAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $conn = $this->container->get('database_connection');
        $sqlRctFav="select favoris.id as idFavoris, article.id as idArticle,article.nom_article as nomArticle,media.url,
                    (select SUM(nbr_rank)/count(id) from rank where rank_article_id=article.id ) as nvnote ,
                    (select count(id) from rank where rank_article_id=article.id ) as nbrVote, 
                    media.id as mediaImage,
                    langue.id as langue,
                    topic.id as topic
                    from article,favoris,media,langue ,topic
                    where article.langue_id = langue.id and article.topic_id = topic.id and article.image_id = media.id and article.id=favoris.favoris_article_id and favoris.client_id=".$user->getId();
        $rows = $conn->query($sqlRctFav);
        $result=array();
        foreach ($rows as $r){
            $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$r['mediaImage'].'.'.$r['url'];
            $langue = $em->getRepository('AdministrationBundle:Langue')->findOneBy(array('id'=>$r['langue']));
            $topic = $em->getRepository('AdministrationBundle:Topic')->findOneBy(array('id'=>$r['topic']));
            array_push($result,
                array(
                    'langue'=>$langue->getNomLangue(),
                    'topic'=>$topic->getNomTopic(),
                    'id'=>$r['idArticle'],
                    'idFavoris'=>$r['idFavoris'],
                    'article'=>$r['nomArticle'],
                    'note'=>$r['nvnote'],
                    'nbrVote'=>$r['nbrVote'],
                    'image'=>$img,
                )
            );
        }
        return new JsonResponse($result);
    }

    public function favorisEtablissementAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $conn = $this->container->get('database_connection');
        $sqlRctFav="select favoris.id as idFavoris, etablissement.id as idEtablissement,etablissement.nom_etablissement as nomEtablissement,etablissement.budget_etablissement as budgetEtablissement,media.url,
                    (select SUM(nbr_rank)/count(id) from rank where rank_etablissement_id=etablissement.id ) as nvnote ,
                    (select count(id) from rank where rank_etablissement_id=etablissement.id ) as nbrVote, 
                    media.id as mediaImage,
                    gouvernorat.id as gouvernorat 
                    from etablissement,favoris,media,gouvernorat
                    where etablissement.gouvernorat_id = gouvernorat.id and etablissement.image_id = media.id and etablissement.id=favoris.favoris_etablissement_id and favoris.client_id=".$user->getId();
        $rows = $conn->query($sqlRctFav);
        $result=array();
        foreach ($rows as $r){
            $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$r['mediaImage'].'.'.$r['url'];
            $gouvernorat = $em->getRepository('AdministrationBundle:Gouvernorat')->findOneBy(array('id'=>$r['gouvernorat']));
            array_push($result,
                array(
                    'gouvernorat'=>$gouvernorat->getNomGouvernorat(),
                    'id'=>$r['idEtablissement'],
                    'idFavoris'=>$r['idFavoris'],
                    'etablissement'=>$r['nomEtablissement'],
                    'budget'=>$r['budgetEtablissement'],
                    'note'=>$r['nvnote'],
                    'nbrVote'=>$r['nbrVote'],
                    'image'=>$img,
                )
            );
        }
        return new JsonResponse($result);
    }

    public function favorisAction(){
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        return $this->render('ClientBundle:Favoris:favoris.html.twig',array('user'=>$user));
    }

    public function deletefavorisAction($idFavoris){
        $em = $this->getDoctrine()->getManager();
        $favoris = $em->getRepository('ClientBundle:Favoris')->findOneBy(array('id'=>$idFavoris));
        $em->remove($favoris);
        $em->flush();
        return new JsonResponse('delete ok');
    }


    public function AddfavorisAction($id,$type)
    {
        $em = $this->getDoctrine()->getManager();
        $favoris = new Favoris();
        $user = $this->get('security.token_storage')->getToken()->getUser();


        if($type == 'recette'){
            $testExistance = $em->getRepository('ClientBundle:Favoris')->findOneBy(array('client'=>$user,'favorisRecette'=>$id,'typeFavoris'=>'recette'));
            if($testExistance){
                $em->remove($testExistance);
                $em->flush();
            }else{
                $recette = $em->getRepository('AdministrationBundle:Recette')->find($id);
                $favoris->setFavorisRecette($recette);
                $favoris->setTypeFavoris($type);

                $favoris->setClient($user);

                $em->persist($favoris);
                $em->flush();
            }


        }elseif ($type == 'article'){
            $article= $em->getRepository('AdministrationBundle:Article')->find($id);
            $favoris->setFavorisArticle($article);
            $favoris->setTypeFavoris($type);

            $favoris->setClient($user);

            $em->persist($favoris);
            $em->flush();
        }elseif ($type == 'etablissement'){
            $etablissement= $em->getRepository('AdministrationBundle:Etablissement')->find($id);
            $favoris->setFavorisEtablissement($etablissement);
            $favoris->setTypeFavoris($type);

            $favoris->setClient($user);

            $em->persist($favoris);
            $em->flush();
        }


        return new JsonResponse(array('success'=>true),200,array('Content-Type'=>'application/json'));
    }


}
