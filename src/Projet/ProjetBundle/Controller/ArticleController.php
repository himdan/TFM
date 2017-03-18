<?php

namespace Projet\ProjetBundle\Controller;
use DoctrineExtensions\Query\Mysql\Date;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ArticleController extends Controller
{

    public function articleAction()
    {

        return $this->render('ProjetBundle:Article:article.html.twig');

    }

    public function detailsArticleAction($article)
    {


        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('AdministrationBundle:Article')->find($article);
        $voirAutreArticles = $em->getRepository('AdministrationBundle:Article')->findBy(array('topic'=>$article->getTopic()));


        $article->setVisiteArticle((int)$article->getVisiteArticle() + 1);
        $em->flush();
        return $this->render('ProjetBundle:Article:details.html.twig',array('article'=>$article, 'voirAutreArticles'=>$voirAutreArticles));

    }

   /* public function articleJSONAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $articles = $em->getRepository('AdministrationBundle:Article')->findAll();
        $ar = array();
        foreach($articles as $ac){

            $th = array();
            $theme = $em->getRepository('AdministrationBundle:Theme')->findBy(array('id'=>$ac->getTheme()->toArray()));
            foreach ($theme as $t){
                array_push($th,$t->getId());
            }

            $request = $this->getRequest();
            $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$ac->getImage()->getId().'.'.$ac->getImage()->getUrl();

            array_push($ar,array(

                    "id" => $ac->getId(),
                    'titre'=>$ac->getNomArticle(),
                    'image'=>$img,
                    'description'=>$ac->getDescriptionArticle(),
                    'date'=>date_format($ac->getDateArticle(),"d-m-Y"),
                    'langue'=>$ac->getLangue()->getId(),
                    'topic'=>$ac->getTopic()->getId(),
                    'theme'=>$th

                )
            );

        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));

    }*/

    public function langueJSONAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $langues = $em->getRepository('AdministrationBundle:Langue')->findAll();
        $ar = array();
        foreach($langues as $ac){

            array_push($ar,array(
                "id" => $ac->getId(),
                'prix'=>$ac->getNomLangue()

            ));
        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));

    }


    public function articleJSONAction(Request $request){

        $data = array();

        $langue = array();
        if(count($langue)==0){
            array_push($langue,0);
            $boolLan=1;
        }else{
            $boolLan=0;
        }



        $conn = $this->container->get('database_connection');
        $test =$conn->query('select count(*) from article')->fetchColumn();

        $sql =
            "select * from article, langue, media
             WHERE
            
            
            (article.langue_id = langue.id) and
            ((langue.id in (".implode(",",$langue).")) or 1=".$boolLan." and
            ((article.image_id = media.id))
             
             )";



        $rows = $conn->query($sql);



        foreach ($rows as $r){
            $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$r['id'].'.'.$r['url'];

            array_push($data, array('image'=>$img,'article'=>$r['nom_article'],'date'=>$r['date_article'],'description'=>$r['description_article']));

        }

        $data['total']=$test;



        return new JsonResponse($data,200,array('Content-Type'=>'application/json'));
    }


    public function filtreJSONAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $langues = $em->getRepository('AdministrationBundle:Langue')->findAll();
        $retour = array();



        // langues
        $langues = $em->getRepository('AdministrationBundle:Langue')->findAll();
        $tableLangues = array();
        foreach ($langues as $l){
            array_push($tableLangues,array('id'=>$l->getId(),'langue'=>$l->getnomLangue()

            ));
        }
        $retour['langues']=$tableLangues;


        // topics  NES2EL LOTFI NRAJA3 TOPIC KOL WALA MANRAJA3CH EL DESACTIVE
        $topic = $em->getRepository('AdministrationBundle:Topic')->findAll();
        //$topic = $em->getRepository('AdministrationBundle:Topic')->findBy(array("statutTopic"=>1));
        $tableTopic = array();
        foreach ($topic as $t){
            array_push($tableTopic,array('id'=>$t->getId(),'topic'=>$t->getNomTopic()

            ));
        }
        $retour['topics']=$tableTopic;



        return new JsonResponse($retour,200,array('Content-Type'=>'application/json'));

    }




    public function filtredArticleAction(Request $request){

        if($request->getMethod()=="POST"){

            $em = $this->getDoctrine()->getEntityManager();

            $dataA = json_decode($request->getContent(), true);



            $request->request->replace($dataA);

            $data = array();

            $textTofind=$request->request->get('textTofind');
            $TblDateToFind = $request->request->get('dateToFind');
            $langueToFind = $request->request->get('lngToFind');
            $TypeToFind = $request->request->get('vidOrArt');
            $TopicsToFind = $request->request->get('tpcToFind');
            $pageNumber=$request->request->get('pageNumber');
            $ordre=$request->request->get('ordre');


            if($ordre=="recent"){
                $ord="article.id";
            }
            if($ordre=="rank"){
                $ord="nvnote";
            }



            if(strlen($textTofind)<2){
                $condText="1=1";
            }else{

                $condText="(article.nom_article like '%".$textTofind."%')";

            }


            if(count($langueToFind)==0){
                $condLng="1=1";
            }else{

                $condLng="(article.langue_id in (".implode(",",$langueToFind)."))";

            }


            if(count($TopicsToFind)==0){
                $condTPC="1=1";
            }else{

                $condTPC="(article.topic_id in (".implode(",",$TopicsToFind)."))";

            }

            if(count($TblDateToFind)==0){
                $condDate="1=1";
            }else{
                $dateTofind=str_replace("/","-",$TblDateToFind[0]);
                $condDate="(article.date_article like '%".$dateTofind."%')";

            }


            if(count($TypeToFind)==0){
                $condType="1=1";
            }else{
                $condType='(article.type_article ="'.$TypeToFind[0].'")';
            }

            //die($dateTofind);


            $fromRow=10*($pageNumber - 1);


            $conn = $this->container->get('database_connection');


            $sqlNbr="select count(DISTINCT article.id)
              from article,media
            WHERE ((article.image_id = media.id)) and "
                .$condType." and ".$condDate." and ".$condLng." and ". $condTPC." and ".$condText."";



            $test =$conn->query($sqlNbr)->fetchColumn();

            /*$sqlNbr="select nom_article
                  from article
                WHERE article.id=1";

            $test =$conn->query($sqlNbr)->fetchColumn();*/

            //die($test);

            $sql="select DISTINCT article.id, media.id as mediaImage,article.nom_article,article.date_article,
                  article.description_article,media.url,(select SUM(nbr_rank)/count(id) from rank where rank_article_id=article.id ) as nvnote,(select count(id) from rank where rank_article_id=article.id ) as nbrVote
            from article,media
            WHERE ((article.image_id = media.id)) and "
                .$condType." and ".$condDate." and ".$condLng." and ". $condTPC." and ".$condText." order by ".$ord." desc LIMIT ".$fromRow.",10";
            $rows = $conn->query($sql);


            $result=array();

            foreach ($rows as $r){

                $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$r['mediaImage'].'.'.$r['url'];

                array_push($result, array('id'=>$r['id'],'note'=>$r['nvnote'],'nbrVote'=>$r['nbrVote'], 'nom_article'=>$r['nom_article'],'date_article'=>$r['date_article'],'description_article'=>$r['description_article'],'image'=>$img));

            }

            $data['total']=$test;
            $data['sql']=$sql;
            $data['result']=$result;

            return new JsonResponse($data,200,array('Content-Type'=>'application/json'));




        }else{

            die('vous pouvez pas acceder a cet URL !');
        }


    }




    public function rankOneArticleJSONAction(Request $request){

        if($request->getMethod()=="POST") {

            $dataA = json_decode($request->getContent(), true);


            $request->request->replace($dataA);


            $idR = $request->request->get('idr');

            $conn = $this->container->get('database_connection');
            $sqlrank = " select SUM(nbr_rank)/count(id) as rank , count(id) as nbrVote from rank where rank_article_id=".$idR;

            $rows = $conn->query($sqlrank);

            $data =array();
            foreach ($rows as $r){

                array_push($data, array('note'=>$r['rank'],'nbrVote'=>$r['nbrVote']));

            }


            return new JsonResponse($data,200,array('Content-Type'=>'application/json'));


        }else{
            die('vous pouver pas acceder a cet url');
        }


    }






    public function nbrLikeDislikeJSONArticleAction(Request $request){

        if($request->getMethod()=="POST") {

            $dataA = json_decode($request->getContent(), true);


            $request->request->replace($dataA);


            $idR = $request->request->get('idr');

            $conn = $this->container->get('database_connection');
            $sqlLike = " select count(id) as nbrLike from appreciation where aime_appreciation=1 and appreciation_article_id=".$idR;

            $likes =$conn->query($sqlLike)->fetchColumn();


            $sqlDisLike =  "select count(id) as nbrDisLike from appreciation where naimePasAppreciation=1 and appreciation_article_id=".$idR;

            $dislikes =$conn->query($sqlDisLike)->fetchColumn();

            $data=array("likes"=>$likes,"dislikes"=>$dislikes);

            return new JsonResponse($data,200,array('Content-Type'=>'application/json'));


        }else{
            die('vous pouver pas acceder a cet url');
        }


    }




    public function mostRankedArticleJSONAction(Request $request)
    {
        $conn = $this->container->get('database_connection');

        $sql="select DISTINCT media.id as mediaImage,article.nom_article,media.url,
              (select SUM(nbr_rank)/count(id) from rank where rank_article_id=article.id ) as nvnote ,
              (select count(id) from rank where rank_article_id=article.id ) as nbrVote ,
              article.id
              from article,media
            WHERE (article.image_id = media.id)
            order by nvnote desc  LIMIT 0,5";

        $rows = $conn->query($sql);


        $result=array();

        foreach ($rows as $r){

            $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$r['mediaImage'].'.'.$r['url'];



            array_push($result, array('id'=>$r['id'],'note'=>$r['nvnote'],'nbrVote'=>$r['nbrVote'], 'article'=>$r['nom_article'],'image'=>$img));

        }

        $data['result']=$result;



        return new JsonResponse($data,200,array('Content-Type'=>'application/json'));




    }





}
