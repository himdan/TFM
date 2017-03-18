<?php

namespace Projet\ProjetBundle\Controller;
use Administration\AdministrationBundle\Entity\Recette;
use Administration\AdministrationBundle\Entity\RecettePhotos;
use Client\ClientBundle\Entity\Photographe;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Component\HttpFoundation\File\UploadedFile;
class RecetteController extends Controller
{









    public function recetteAction()
    {

        return $this->render('ProjetBundle:recette:recette.html.twig');
    }

    public function detailsRecetteAction($recette,Request $request)
    {

        $recettePhotos = new RecettePhotos();
        $conn = $this->container->get('database_connection');
        $em = $this->getDoctrine()->getManager();
        $recetteFound = $em->getRepository('AdministrationBundle:Recette')->findOneBy(array('id'=>$recette));



        // upload image
        $q = $this->getRequest();
        if($q->isMethod('POST'))
        {

            if(($q->request->get('do') == 'get'))
            {


                $photoRecette=$recetteFound->getPhotos();
                $res=array();
                foreach($photoRecette as $image){

                    $url = $q->getScheme() . '://' . $q->getHttpHost() . $q->getBasePath().'/recettephotos/'.$image->getPath();
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
                    $photo = $em->getRepository('AdministrationBundle:RecettePhotos')->findOneBy(array('id'=>$q->request->get('id')));

                    $recetteFound->removePhoto($photo);
                    $em->persist($recetteFound);
                    $em->flush();
                    $res = array('ok'=>true);


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
                    $recettePhotos->setName('lotfi');
                    $recettePhotos->setFile($image);
                    $recettePhotos->setClient($user);
                    $recettePhotos->upload();
                    $em->persist($recettePhotos);
                    $recetteFound->addPhoto($recettePhotos);
                    $em->persist($recetteFound);

                    $em->flush();

                    //$ese->setLogo($photo);
                    //$em->persist($ese);
                    //$em->flush();

                    $res = array('ok'=>true);
                }

            }
            return new jsonResponse($res);

        }else{
            $sqlTheme = 'select theme_id from recette_theme where recette_id =' . $recette;

            $thisTheme=$conn->query($sqlTheme);

            $voirRecetteByTheme = array();
            foreach ($thisTheme as $themeRecette){
                array_push($voirRecetteByTheme, $themeRecette['theme_id']);
            }

            if(count($voirRecetteByTheme)==0){
                $condThm="1=1";
                $tblThm="";
            }else{

                $condThm="(recette.id = recette_theme.recette_id) and
            (recette_theme.theme_id in (".implode(",",$voirRecetteByTheme)."))";
                $tblThm=",recette_theme";

            }

            $sqlRecettesThisTheme=" select DISTINCT recette.id ,recette.nom_recette,recette.visite_recette,media.url, media.id as mediaImage from recette,media".$tblThm." where ((recette.image_id = media.id)) and ".$condThm." order by visite_recette desc LIMIT 0,20";

            $RecettesThisTheme=$conn->query($sqlRecettesThisTheme);

            $tblRecettesThisTheme=array();
            foreach ($RecettesThisTheme as $RecetteThisTheme){
                $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$RecetteThisTheme['mediaImage'].'.'.$RecetteThisTheme['url'];

                array_push($tblRecettesThisTheme, array('id'=>$RecetteThisTheme['id'],'nom'=>$RecetteThisTheme['nom_recette'],'image'=>$img));
            }


            $recetteFound->setVisiteRecette((int)$recetteFound->getVisiteRecette() + 1);
            $em->flush();


            $sqlRank="select SUM(nbr_rank)/count(id) as note,count(id) as nbrVotes from rank where rank_recette_id=".$recette;
            $noteRank =$conn->query($sqlRank);

            foreach($noteRank as $nr){
                $nbrVotes=$nr['nbrVotes'];
                $note=$nr['note'];

            }
            return $this->render('ProjetBundle:recette:details.html.twig',array('recette'=>$recetteFound,'nbrVotes'=>$nbrVotes,'note'=>$note, 'voirRecetteByTheme'=>$tblRecettesThisTheme));
        }


    }






    // end filtre

    // par prix

    public function prixJSONAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $prixs = $em->getRepository('AdministrationBundle:Prix')->findAll();
        $ar = array();
        foreach($prixs as $ac){

            array_push($ar,array(
                "id" => $ac->getId(),
                'prix'=>$ac->getNomPrix()

            ));
        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));

    }




    // par nationalite

    public function nationaliteJSONAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $nationalites= $em->getRepository('AdministrationBundle:Nationalite')->findAll();
        $ar = array();
        foreach($nationalites as $ac){

            array_push($ar,array(
                "id" => $ac->getId(),
                'nationalite'=>$ac->getNomNationalite()

            ));
        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));

    }



    // par difficulte

    public function difficulteJSONAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $difficultes = $em->getRepository('AdministrationBundle:Difficulte')->findAll();
        $ar = array();
        foreach($difficultes as $ac){

            array_push($ar,array(
                "id" => $ac->getId(),
                'difficulte'=>$ac->getNomDifficulte()

            ));
        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));

    }




    // par menu

    public function menuJSONAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $menus = $em->getRepository('AdministrationBundle:Menu')->findAll();
        $ar = array();
        foreach($menus as $ac){

            array_push($ar,array(
                "id" => $ac->getId(),
                'menu'=>$ac->getNomMenu()

            ));
        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));

    }


    // par theme

    public function themeJSONAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $themes = $em->getRepository('AdministrationBundle:Theme')->findAll();
        $ar = array();
        foreach($themes as $ac){

            array_push($ar,array(
                "id" => $ac->getId(),
                'theme'=>$ac->getNomTheme()

            ));
        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));

    }



    // subcategorie

    public function subcategorieJSONAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $subcategories = $em->getRepository('AdministrationBundle:SubCategorie')->findAll();
        $ar = array();
        foreach($subcategories as $ac){

            array_push($ar,array(
                "id" => $ac->getId(),
                'subcategorie'=>$ac->getNomSubCategorie(),
                'menu'=>$ac->getMenu()->getId()

            ));
        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));

    }

    // par ingredient

    public function ingredientJSONAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $ingredients = $em->getRepository('AdministrationBundle:Ingredient')->findAll();
        $ar = array();
        foreach($ingredients as $ac){

            array_push($ar,array(
                "id" => $ac->getId(),
                'ingredient'=>$ac->getNomIngredient()

            ));
        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));

    }

    // par couisson

    public function couissonJSONAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $couissons = $em->getRepository('AdministrationBundle:TypeCuisson')->findAll();
        $ar = array();
        foreach($couissons as $ac){

            array_push($ar,array(
                "id" => $ac->getId(),
                'couisson'=>$ac->getNomTypeCuisson()

            ));
        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));

    }

    // par saison

    public function saisonJSONAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $couissons = $em->getRepository('AdministrationBundle:Saison')->findAll();
        $ar = array();
        foreach($couissons as $ac){

            array_push($ar,array(
                "id" => $ac->getId(),
                'saison'=>$ac->getNomSaison()

            ));
        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));

    }



    public function recetteJSONAction(Request $request){

        $data = array();

        $theme = array();
        $ingredient= array();
        $difficulte= array();
        if(count($theme)==0){
            array_push($theme,0);
            $boolTh=1;
        }else{
            $boolTh=0;
        }

        if(count($ingredient)==0){
            array_push($ingredient,0);
            $boolIng=1;
        }else{
            $boolIng=0;
        }

        if(count($difficulte)==0){
            array_push($difficulte,0);
            $boolDiff=1;
        }else{
            $boolDiff=0;
        }

        $prix= array();
        if(count($prix)==0){
            array_push($prix,0);
            $boolPrix=1;
        }else{
            $boolPrix=0;
        }



        $conn = $this->container->get('database_connection');
        $test =$conn->query('select count(*) from recette')->fetchColumn();
        //hne
        $sql =
            "select * from recette, recette_ingredient, recette_theme, difficulte,prix, media
             WHERE
            (recette.id = recette_ingredient.recette_id) and
            (recette.id = recette_theme.recette_id) and
            ((recette_theme.theme_id in (".implode(",",$theme).")) or 1=".$boolTh." ) and
            ((recette_ingredient.ingredient_id in(".implode(",",$ingredient).")) or 1=".$boolIng." ) and
            (recette.difficulte_id = difficulte.id) and
            ((difficulte.id in (".implode(",",$difficulte).")) or 1=".$boolDiff.") and
            (recette.prix_id = prix.id) and
            ((prix.id in (".implode(",",$prix).")) or 1=".$boolPrix." and
            ((recette.image_id = media.id))

             ) limit 50";



        $rows = $conn->query($sql);



        foreach ($rows as $r){
            $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$r['id'].'.'.$r['url'];
            array_push($data, array('image'=>$img,'preparation'=>$r['preparation_recette'],'cuisson'=>$r['cuisson_recette'],'recette'=>$r['nom_recette'],'difficulte'=>$r['nom_difficulte'],'prix'=>$r['nom_prix']));

        }

        $data['total']=$test;



        return new JsonResponse($data,200,array('Content-Type'=>'application/json'));
    }




    public function test2Action(Request $request){

        $data = array();
        $em = $this->getDoctrine()->getEntityManager();
        $theme = array();
        $ingredient= array();
        $saisons=array();
        $subCat=array();
        $typeCuis=array();
        $prix=array();
        $difficulte=array();
        $nationalite=array();
        $menu=array(1);

        //cbon: theme ingredient saison subcat typeCuis prix difficulte nationalite menu

        if(count($theme)==0){
            $condThm="1=1";
            $tblThm="";
        }else{

            $condThm="(recette.id = recette_theme.recette_id) and
            (recette_theme.theme_id in (".implode(",",$theme)."))";
            $tblThm=",recette_theme";

        }

        if(count($ingredient)==0){

            $condIng="1=1";
            $tblIng="";

        }else{

            $condIng="(recette.id = recette_ingredient.recette_id) and
            (recette_ingredient.ingredient_id in (".implode(",",$ingredient)."))";
            $tblIng=",recette_ingredient";


        }



        if(count($saisons)==0){

            $condSais="1=1";
            $tblSais="";

        }else{

            $condSais="(recette.id = recette_saison.recette_id) and
            (recette_saison.saison_id in (".implode(",",$saisons)."))";
            $tblSais=",recette_saison";


        }


        if(count($subCat)==0){

            $condSubCat="1=1";
            $tblSubCat="";

        }else{

            $condSubCat="(recette.id = recette_sub_categorie.recette_id) and
            (recette_sub_categorie.sub_categorie_id in (".implode(",",$subCat)."))";
            $tblSubCat=",recette_sub_categorie";


        }


        if(count($typeCuis)==0){

            $condTypeCuis="1=1";
            $tblTypeCuis="";

        }else{

            $condTypeCuis="(recette.id = recette_type_cuisson.recette_id) and
            (recette_type_cuisson.type_cuisson_id in (".implode(",",$typeCuis)."))";
            $tblTypeCuis=",recette_type_cuisson";


        }


        if(count($prix)==0){
            $condPrix="1=1";
        }else{

            $condPrix="(recette.prix_id in (".implode(",",$prix)."))";



        }


        if(count($difficulte)==0){
            $condDiff="1=1";
        }else{

            $condDiff="(recette.difficulte_id in (".implode(",",$difficulte)."))";

        }


        if(count($nationalite)==0){
            $condNat="1=1";
        }else{

            $condNat="(recette.nationalite_id in (".implode(",",$nationalite)."))";

        }



        if(count($menu)==0){
            $condMenu="1=1";
        }else{

            $condMenu="(recette.menu_id in (".implode(",",$menu)."))";

        }



        $conn = $this->container->get('database_connection');
        $sqlNbr="select count(DISTINCT recette.id)
              from recette,media,difficulte,prix".$tblThm.$tblIng.$tblSais.$tblSubCat.$tblTypeCuis."
            WHERE ((recette.image_id = media.id)) and ((recette.difficulte_id = difficulte.id)) and ((recette.prix_id = prix.id)) and "
            .$condThm." and ".$condIng." and ".$condSais." and ". $condSubCat." and ".$condTypeCuis." and ".$condPrix." and ".$condDiff." and ".$condNat." and ".$condMenu."";


        $test =$conn->query($sqlNbr)->fetchColumn();

        /*$sql =
            'select id,nom_recette from recette, recette_ingredient, recette_theme
             WHERE
            (recette.id = recette_ingredient.recette_id) and
            (recette.id = recette_theme.recette_id) and
            ((recette_theme.theme_id in ('.implode(",",$theme).')) or 1='.$boolTh.' ) and
            ((recette_ingredient.ingredient_id in('.implode(",",$ingredient).')) or 1='.$boolIng.' ) and
            (recette.difficulte_id = difficulte.id) and
            ((difficulte.id in ('.implode(",",$difficulte).')) or 1='.$boolDiff.' ) limit 10';*/

        $sql2="select recette.id,recette.nom_recette from recette, recette_ingredient, recette_theme
WHERE (recette.id = recette_ingredient.recette_id) and (recette.id = recette_theme.recette_id) and (recette_theme.theme_id = 5) and (recette_ingredient.ingredient_id =42 )";

        //hne
        $sql="select recette.id,recette.nom_recette,media.url,preparation_recette,cuisson_recette,nom_difficulte,nom_prix
              from recette,media,difficulte,prix".$tblThm.$tblIng.$tblSais.$tblSubCat.$tblTypeCuis."
            WHERE ((recette.image_id = media.id)) and ((recette.difficulte_id = difficulte.id)) and ((recette.prix_id = prix.id)) and "
            .$condThm." and ".$condIng." and ".$condSais." and ". $condSubCat." and ".$condTypeCuis." and ".$condPrix." and ".$condDiff." and ".$condNat." and ".$condMenu."";

        $rows = $conn->query($sql);


        $nbrRep=0;
        foreach ($rows as $r){

            $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$r['id'].'.'.$r['url'];

            array_push($data, array('id'=>$r['id'], 'recette'=>$r['nom_recette'],'image'=>$img,'preparation'=>$r['preparation_recette'],'cuisson'=>$r['cuisson_recette'],'difficulte'=>$r['nom_difficulte'],'prix'=>$r['nom_prix']));

            //            array_push($data, array('image'=>$img,'preparation'=>$r['preparation_recette'],'cuisson'=>$r['cuisson_recette'],'recette'=>$r['nom_recette'],'difficulte'=>$r['nom_difficulte'],'prix'=>$r['nom_prix']));


            $nbrRep++;

        }

        $data['total']=$test;



        return new JsonResponse($data,200,array('Content-Type'=>'application/json'));
    }



    /*****************HEDHI ELI BECH NKAMEL NE5DEM BEHA*********************/



    public function filtredRecetteAction(Request $request){

        if($request->getMethod()=="POST"){

            $dataA = json_decode($request->getContent(), true);



            $request->request->replace($dataA);

            $data = array();
            $em = $this->getDoctrine()->getEntityManager();
            $theme = $request->request->get('thmToFind');
            $ingredient= $request->request->get('ingToFind');
            $saisons=$request->request->get('saisToFind');
            $subCat=$request->request->get('subCatToFind');
            $typeCuis=$request->request->get('couisTypeToFind');
            $prix=$request->request->get('prxToFind');
            $difficulte=$request->request->get('diffToFind');
            $nationalite=$request->request->get('natTofind');
            $menu=$request->request->get('menuToFind');
            $pageNumber=$request->request->get('pageNumber');
            $textTofind=$request->request->get('textTofind');
            $ordre=$request->request->get('ordre');

            //cbon: theme ingredient saison subcat typeCuis prix difficulte nationalite menu

            if($ordre=="recent"){
                $ord="recette.id";
            }
            if($ordre=="rank"){
                $ord="nvnote";
            }
            if($ordre=="visite"){
                $ord="recette.visite_recette";
            }

            if(count($theme)==0){
                $condThm="1=1";
                $tblThm="";
            }else{

                $condThm="(recette.id = recette_theme.recette_id) and
            (recette_theme.theme_id in (".implode(",",$theme)."))";
                $tblThm=",recette_theme";

            }

            if(count($ingredient)==0){

                $condIng="1=1";
                $tblIng="";

            }else{

                $condIng="(recette.id = recette_ingredient.recette_id) and
            (recette_ingredient.ingredient_id in (".implode(",",$ingredient)."))";
                $tblIng=",recette_ingredient";


            }



            if(count($saisons)==0){

                $condSais="1=1";
                $tblSais="";

            }else{

                $condSais="(recette.id = recette_saison.recette_id) and
            (recette_saison.saison_id in (".implode(",",$saisons)."))";
                $tblSais=",recette_saison";


            }


            if(count($subCat)==0){

                $condSubCat="1=1";
                $tblSubCat="";

            }else{

                $condSubCat="(recette.id = recette_sub_categorie.recette_id) and
            (recette_sub_categorie.sub_categorie_id in (".implode(",",$subCat)."))";
                $tblSubCat=",recette_sub_categorie";


            }


            if(count($typeCuis)==0){

                $condTypeCuis="1=1";
                $tblTypeCuis="";

            }else{

                $condTypeCuis="(recette.id = recette_type_cuisson.recette_id) and
            (recette_type_cuisson.type_cuisson_id in (".implode(",",$typeCuis)."))";
                $tblTypeCuis=",recette_type_cuisson";


            }


            if(count($prix)==0){
                $condPrix="1=1";
            }else{

                $condPrix="(recette.prix_id in (".implode(",",$prix)."))";



            }


            if(count($difficulte)==0){
                $condDiff="1=1";
            }else{

                $condDiff="(recette.difficulte_id in (".implode(",",$difficulte)."))";

            }


            if(count($nationalite)==0){
                $condNat="1=1";
            }else{

                $condNat="(recette.nationalite_id in (".implode(",",$nationalite)."))";

            }



            if(count($menu)==0){
                $condMenu="1=1";
            }else{

                $condMenu="(recette.menu_id in (".implode(",",$menu)."))";

            }


            if(strlen($textTofind)<2){
                $condText="1=1";
            }else{

                $condText="(recette.nom_recette like '%".$textTofind."%')";

            }



            $fromRow=10*($pageNumber - 1);

            $conn = $this->container->get('database_connection');
            $sqlNbr="select count(DISTINCT recette.id)
              from recette,media,difficulte,prix".$tblThm.$tblIng.$tblSais.$tblSubCat.$tblTypeCuis."
            WHERE ((recette.active_recette = '1') and (recette.image_id = media.id)) and ((recette.difficulte_id = difficulte.id)) and ((recette.prix_id = prix.id)) and "
                .$condThm." and ".$condIng." and ".$condSais." and ". $condSubCat." and ".$condTypeCuis." and ".$condPrix." and ".$condDiff." and ".$condNat." and ".$condMenu." and ".$condText."";

            $test =$conn->query($sqlNbr)->fetchColumn();

            $sql="select DISTINCT recette.id ,recette.nom_recette,media.url,preparation_recette,cuisson_recette,
                  nom_difficulte,nom_prix,recette.visite_recette,(select SUM(nbr_rank)/count(id) from rank where rank_recette_id=recette.id ) as nvnote ,(select count(id) from rank where rank_recette_id=recette.id ) as nbrVote
              , media.id as mediaImage
              from recette,media,difficulte,prix".$tblThm.$tblIng.$tblSais.$tblSubCat.$tblTypeCuis."
            WHERE ((recette.active_recette = '1') and (recette.image_id = media.id)) and ((recette.difficulte_id = difficulte.id)) and ((recette.prix_id = prix.id)) and "
                .$condThm." and ".$condIng." and ".$condSais." and ". $condSubCat." and ".$condTypeCuis." and ".$condPrix." and ".$condDiff." and ".$condNat." and ".$condMenu." and ".$condText." order by ".$ord." desc  LIMIT ".$fromRow.",10";

            $rows = $conn->query($sql);


            $result=array();
            $user = $this->get('security.token_storage')->getToken()->getUser();

            $imgFavRouge = "icon-bookmark-red";
            $imgFavGris = "icon-bookmark-gris";

            foreach ($rows as $r){

                $testExistance = $em->getRepository('ClientBundle:Favoris')->findOneBy(array('client'=>$user,'favorisRecette'=>$r['id'],'typeFavoris'=>'recette'));
                $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$r['mediaImage'].'.'.$r['url'];

                if($testExistance){
                    array_push($result, array('fav'=>$imgFavRouge,'id'=>$r['id'],'note'=>$r['nvnote'],'nbrVote'=>$r['nbrVote'], 'recette'=>substr($r['nom_recette'],0,50),'image'=>$img,'preparation'=>$r['preparation_recette'],'cuisson'=>$r['cuisson_recette'],'difficulte'=>$r['nom_difficulte'],'prix'=>$r['nom_prix']));
                }else{
                    array_push($result, array('fav'=>$imgFavGris,'id'=>$r['id'],'note'=>$r['nvnote'],'nbrVote'=>$r['nbrVote'], 'recette'=>substr($r['nom_recette'],0,50),'image'=>$img,'preparation'=>$r['preparation_recette'],'cuisson'=>$r['cuisson_recette'],'difficulte'=>$r['nom_difficulte'],'prix'=>$r['nom_prix']));
                }






            }



            $data['total']=$test;
            $data['sql']=$sql;
            $data['result']=$result;



            return new JsonResponse($data,200,array('Content-Type'=>'application/json'));

        }else{

            die('vous pouvez pas acceder a cette url');
        }

    }


    /*****************HEDHI ELI BECH NKAMEL NE5DEM BEHA*********************/




    public function filtreJSONAction()
    {

        $em = $this->getDoctrine()->getEntityManager();

        // theme
        $theme = $em->getRepository('AdministrationBundle:Theme')->findAll();
        $tableTheme = array();
        foreach ($theme as $t){
            array_push($tableTheme,array('id'=>$t->getId(),'theme'=>$t->getNomTheme()

            ));
        }

        // difficulte
        $diff = $em->getRepository('AdministrationBundle:Difficulte')->findAll();
        $tableDiff = array();
        foreach ($diff as $d){
            array_push($tableDiff,array('id'=>$d->getId(),'difficulte'=>$d->getNomDifficulte()

            ));
        }

        // menu
        $menus = $em->getRepository('AdministrationBundle:Menu')->findAll();
        $tableMenu = array();
        foreach ($menus as $m){
            array_push($tableMenu,array('id'=>$m->getId(),'menu'=>$m->getNomMenu()

            ));
        }

        // prix
        $prixs = $em->getRepository('AdministrationBundle:Prix')->findAll();
        $tablePrix = array();
        foreach($prixs as $p){

            array_push($tablePrix,array('id'=>$p->getId(),'prix'=>$p->getNomPrix()

            ));
        }

        // subcategorie
        $subcategorie = $em->getRepository('AdministrationBundle:SubCategorie')->findAll();
        $tableSub = array();
        foreach($subcategorie as $s){

            array_push($tableSub,array('id'=>$s->getId(),'subcategorie'=>$s->getNomSubCategorie(),'menu'=>$s->getMenu()->getId()

            ));
        }

        // nationalite
        $nationalite = $em->getRepository('AdministrationBundle:Nationalite')->findAll();
        $tableNat = array();
        foreach($nationalite as $n){

            array_push($tableNat,array('id'=>$n->getId(),'nationalite'=>$n->getNomNationalite()

            ));
        }

        // ingredient
        $ingredient = $em->getRepository('AdministrationBundle:Ingredient')->findAll();
        $tableIng= array();
        foreach($ingredient as $i){

            array_push($tableIng,array('id'=>$i->getId(),'ingredient'=>$i->getNomIngredient()

            ));
        }

        // cuisson
        $cuisson = $em->getRepository('AdministrationBundle:TypeCuisson')->findAll();
        $tableCui= array();
        foreach($cuisson as $c){

            array_push($tableCui,array('id'=>$c->getId(),'couisson'=>$c->getNomTypeCuisson()

            ));
        }

        // saison
        $saison = $em->getRepository('AdministrationBundle:Saison')->findAll();
        $tableSai= array();
        foreach($saison as $sa){

            array_push($tableSai,array('id'=>$sa->getId(),'saison'=>$sa->getNomSaison()

            ));
        }

        // result
        $res = array('saison'=>$tableSai,'cuisson'=>$tableCui,'ingredient'=>$tableIng,'menu'=>$tableMenu,'prix'=>$tablePrix,'difficulte'=>$tableDiff,'theme'=>$tableTheme,'subcategorie'=>$tableSub,'nationalite'=>$tableNat);


        return new JsonResponse($res,200,array('Content-Type'=>'application/json'));

    }

    public function mostRankedJSONAction(Request $request)
    {
        $conn = $this->container->get('database_connection');

        $sql="select DISTINCT media.id as mediaImage,recette.nom_recette,media.url,
              (select SUM(nbr_rank)/count(id) from rank where rank_recette_id=recette.id ) as nvnote ,
              (select count(id) from rank where rank_recette_id=recette.id ) as nbrVote ,
              recette.id
              from recette,media
            WHERE (recette.image_id = media.id)
            order by nvnote desc  LIMIT 0,5";

        $rows = $conn->query($sql);


        $result=array();

        foreach ($rows as $r){

            $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$r['mediaImage'].'.'.$r['url'];



            array_push($result, array('id'=>$r['id'],'note'=>$r['nvnote'],'nbrVote'=>$r['nbrVote'], 'recette'=>$r['nom_recette'],'image'=>$img));

        }

        $data['result']=$result;



        return new JsonResponse($data,200,array('Content-Type'=>'application/json'));




    }


    public function rankOneRecetteJSONAction(Request $request){

        if($request->getMethod()=="POST") {

            $dataA = json_decode($request->getContent(), true);


            $request->request->replace($dataA);


            $idR = $request->request->get('idr');

            $conn = $this->container->get('database_connection');
            $sqlrank = " select SUM(nbr_rank)/count(id) as rank , count(id) as nbrVote from rank where rank_recette_id=".$idR;

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





    public function nbrLikeDislikeJSONAction(Request $request){

        if($request->getMethod()=="POST") {

            $dataA = json_decode($request->getContent(), true);


            $request->request->replace($dataA);


            $idR = $request->request->get('idr');

            $conn = $this->container->get('database_connection');
            $sqlLike = " select count(id) as nbrLike from appreciation where aime_appreciation=1 and appreciation_recette_id=".$idR;

            $likes =$conn->query($sqlLike)->fetchColumn();


            $sqlDisLike =  "select count(id) as nbrDisLike from appreciation where naimePasAppreciation=1 and appreciation_recette_id=".$idR;

            $dislikes =$conn->query($sqlDisLike)->fetchColumn();

            $data=array("likes"=>$likes,"dislikes"=>$dislikes);

            return new JsonResponse($data,200,array('Content-Type'=>'application/json'));


        }else{
            die('vous pouver pas acceder a cet url');
        }


    }


}
