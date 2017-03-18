<?php

namespace Projet\ProjetBundle\Controller;
use Administration\AdministrationBundle\Entity\Carte;
use Administration\AdministrationBundle\Entity\Etablissement;
use Administration\AdministrationBundle\Entity\Gouvernorat;
use Administration\AdministrationBundle\Entity\Media;
use Projet\ProjetBundle\Entity\EtablissementSignal;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Component\HttpFoundation\File\UploadedFile;
class EtablissementController extends Controller
{

    public function etablissementAction()
    {

        return $this->render('ProjetBundle:etablissement:etablissement.html.twig');
    }

    public function detailsEtablissementAction($etablissement,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $carte = new Carte();
        $etablissement = $em->getRepository('AdministrationBundle:Etablissement')->findOneBy(array('id'=>$etablissement));
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




            $etablissementEntity = $em->getRepository('AdministrationBundle:Etablissement')->find($etablissement);
            $etablissementEntity->setVisiteEtablissement((int)$etablissementEntity->getVisiteEtablissement() + 1);
            $em->flush();
            $etablissementsSponsor = $em->getRepository('AdministrationBundle:Etablissement')->findBySponsor();
            return $this->render('ProjetBundle:etablissement:details.html.twig',array('etablissement'=>$etablissementEntity, 'etablissementSponsor'=>$etablissementsSponsor));
        }
    }



    public function filtreJSONAction()
    {

        $em = $this->getDoctrine()->getEntityManager();


        // gov
        $gov = $em->getRepository('AdministrationBundle:Gouvernorat')->findAll();
        $tableGov = array();
        foreach ($gov as $g){
            array_push($tableGov,array('id'=>$g->getId(),'nomgov'=>$g->getNomGouvernorat()

            ));
        }



        // Specialite
        $specialite = $em->getRepository('AdministrationBundle:Specialite')->findAll();
        $tableSpec = array();
        foreach ($specialite as $s){
            array_push($tableSpec,array('id'=>$s->getId(),'specialite'=>$s->getNomSpecialite()

            ));
        }

        // Ambiance
        $Ambiance = $em->getRepository('AdministrationBundle:Ambiance')->findAll();
        $tableAmbiance = array();
        foreach ($Ambiance as $a){
            array_push($tableAmbiance,array('id'=>$a->getId(),'ambiance'=>$a->getNomAmbiance()

            ));
        }


        // AutreFiltres
        $filtre = $em->getRepository('AdministrationBundle:Filtre')->findAll();
        $tableFiltre = array();
        foreach ($filtre as $f){
            array_push($tableFiltre,array('id'=>$f->getId(),'filtre'=>$f->getNomFiltre()

            ));
        }

        // result
        $res = array('specialite'=>$tableSpec,'ambiance'=>$tableAmbiance,'filtre'=>$tableFiltre,'gov'=>$tableGov);


        return new JsonResponse($res,200,array('Content-Type'=>'application/json'));

    }


    public function filtredJsonAction(Request $request){
        if($request->getMethod()=="POST"){

            $dataA = json_decode($request->getContent(), true);

            $request->request->replace($dataA);




            $em = $this->getDoctrine()->getEntityManager();
            $textTofind=$request->request->get('textTofind');

            $catToFind=$request->request->get('categorie');
            $specToFind=$request->request->get('specToFind');
            $ambToFind=$request->request->get('ambToFind');
            $filToFind=$request->request->get('filToFind');
            $govToFind=$request->request->get('govToFind');
            $regToFind=$request->request->get('regToFind');
            $minBudToFind=$request->request->get('minBudToFind');
            $maxBudToFind=$request->request->get('maxBudToFind');
            $pageNumber=$request->request->get('pageNumber');
            $ordre=$request->request->get('ordre');


            if($ordre=="recent"){
                $ord="etablissement.id desc";
            }
            if($ordre=="rank"){
                $ord="nvnote desc";
            }
            if($ordre=="visite"){
                $ord="etablissement.visite_etablissement desc";
            }


            if($ordre=="prixAsc"){
                $ord="etablissement.budget_etablissement asc";
            }

            if($ordre=="prixDesc"){
                $ord="etablissement.budget_etablissement desc";
            }



            if(count($catToFind)==0){
                $condCat="1=1";
                $tblCat="";
            }else{

                $condCat="(etablissement.id = etablissement_categorie.etablissement_id) and
            (etablissement_categorie.categorie_id in (".implode(",",$catToFind)."))";
                $tblCat=",etablissement_categorie";

            }


            if(count($specToFind)==0){
                $condSpec="1=1";
                $tblSpec="";
            }else{

                $condSpec="(etablissement.id = etablissement_specialite.etablissement_id) and
            (etablissement_specialite.specialite_id in (".implode(",",$specToFind)."))";
                $tblSpec=",etablissement_specialite";

            }


            if(count($ambToFind)==0){
                $condAmb="1=1";
                $tblAmb="";
            }else{

                $condAmb="(etablissement.id = etablissement_ambiance.etablissement_id) and
            (etablissement_ambiance.ambiance_id in (".implode(",",$ambToFind)."))";
                $tblAmb=",etablissement_ambiance";

            }

            if(count($filToFind)==0){
                $condFil="1=1";
                $tblFil="";
            }else{

                $condFil="(etablissement.id = etablissement_filtre.etablissement_id) and
            (etablissement_filtre.filtre_id in (".implode(",",$filToFind)."))";
                $tblFil=",etablissement_filtre";

            }



            $regions=array();
            if(count($govToFind)==0){
                $condGov="1=1";
            }else{

                $condGov="(etablissement.gouvernorat_id in (".implode(",",$govToFind)."))";

                $reg = $em->getRepository('AdministrationBundle:Region')->findBy(array('gouvernorat'=>$govToFind[0]));

                foreach ($reg as $r){
                    array_push($regions,array('id'=>$r->getId(),'nomreg'=>$r->getnomRegion()

                    ));
                }

            }



            if(count($regToFind)==0){
                $condReg="1=1";
            }else{

                $condReg="(etablissement.region_id in (".implode(",",$regToFind)."))";

            }


            if(strlen($textTofind)<2){
                $condText="1=1";
            }else{

                $condText="(etablissement.nom_etablissement like '%".$textTofind."%')";

            }


            $fromRow=10*($pageNumber - 1);




            $conn = $this->container->get('database_connection');



            $sqlNbr="select count(DISTINCT etablissement.id)
              from etablissement".$tblSpec.$tblAmb.$tblFil.$tblCat."
            WHERE (etablissement.autorisation_etablissement = 'active') and ".$condSpec." and ".$condCat." and ".$condAmb." and ".$condFil." and ".$condGov." and ".$condReg." and budget_etablissement between ".$minBudToFind." and ".$maxBudToFind." and ".$condText."";



            $test =$conn->query($sqlNbr)->fetchColumn();




            //hne
            $sql="select DISTINCT etablissement.id,etablissement.nom_etablissement,etablissement.visite_etablissement,etablissement.budget_etablissement,media.url,media.id as mediaImage
                  ,(select SUM(nbr_rank)/count(id) from rank where rank_etablissement_id=etablissement.id ) as nvnote ,
                  (select count(id) from rank where rank_etablissement_id=etablissement.id ) as nbrVote
              from etablissement,media".$tblSpec.$tblAmb.$tblFil.$tblCat."
            WHERE (etablissement.autorisation_etablissement = 'active') and (etablissement.image_id = media.id) and ".$condSpec." and ".$condCat." and ".$condAmb." and ".$condFil." and ".$condGov." and ".$condReg." and  budget_etablissement between ".$minBudToFind." and ".$maxBudToFind." and ".$condText." order by ".$ord." LIMIT ".$fromRow.",10";



            $rows = $conn->query($sql);


            $result=array();

            $user = $this->get('security.token_storage')->getToken()->getUser();

            $imgFavRouge = "icon-bookmark-red";
            $imgFavGris = "icon-bookmark-gris";

            foreach ($rows as $r){

                $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$r['mediaImage'].'.'.$r['url'];
                $testExistance = $em->getRepository('ClientBundle:Favoris')->findOneBy(array('client'=>$user,'favorisEtablissement'=>$r['id'],'typeFavoris'=>'etablissement'));
                if($testExistance){
                    array_push($result, array("img"=>$img,'fav'=>$imgFavRouge,'id'=>$r['id'], 'nom_etablissement'=>$r['nom_etablissement'],'budget_etablissement'=>$r['budget_etablissement'],'note'=>$r['nvnote'],'nbrVote'=>$r['nbrVote']));

                }else{
                    array_push($result, array("img"=>$img,'fav'=>$imgFavGris,'id'=>$r['id'], 'nom_etablissement'=>$r['nom_etablissement'],'budget_etablissement'=>$r['budget_etablissement'],'note'=>$r['nvnote'],'nbrVote'=>$r['nbrVote']));
                }


            }
            $data['total']=$test;
            $data['sql']=$sql;
            $data['result']=$result;
            $data['regions']=$regions;

            return new JsonResponse($data,200,array('Content-Type'=>'application/json'));




        }else{

            die("vous pouvez pas acceder a cet url");
        }
    }


    public function testFiltredJsonAction(){

        $em = $this->getDoctrine()->getEntityManager();

        $specToFind=array(19);
        $ambToFind=array();
        $filToFind=array();


        if(count($specToFind)==0){
            $condSpec="1=1";
            $tblSpec="";
        }else{

            $condSpec="(etablissement.id = etablissement_specialite.etablissement_id) and
            (etablissement_specialite.specialite_id in (".implode(",",$specToFind)."))";
            $tblSpec=",etablissement_specialite";

        }


        if(count($ambToFind)==0){
            $condAmb="1=1";
            $tblAmb="";
        }else{

            $condAmb="(etablissement.id = etablissement_ambiance.etablissement_id) and
            (etablissement_ambiance.ambiance_id in (".implode(",",$ambToFind)."))";
            $tblAmb=",etablissement_ambiance";

        }

        if(count($filToFind)==0){
            $condFil="1=1";
            $tblFil="";
        }else{

            $condFil="(etablissement.id = etablissement_filtre.etablissement_id) and
            (etablissement_filtre.filtre_id in (".implode(",",$filToFind)."))";
            $tblFil=",etablissement_filtre";

        }

        $conn = $this->container->get('database_connection');


        //hne
        $sql="select etablissement.id,etablissement.nom_etablissement
              from etablissement".$tblSpec.$tblAmb.$tblFil."
            WHERE "
            .$condSpec." and ".$condAmb." and ".$condFil."";


        $rows = $conn->query($sql);


        $result=array();

        foreach ($rows as $r){

            //$img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$r['mediaImage'].'.'.$r['url'];

            array_push($result, array('id'=>$r['id'], 'nom_etablissement'=>$r['nom_etablissement']));

        }
        //$data['total']="pasEncr";
        //$data['sql']=$sql;
        $data['result']=$result;

        return new JsonResponse($data,200,array('Content-Type'=>'application/json'));

    }

    public function locationAction()
    {




        $em = $this->getDoctrine()->getEntityManager();

        $query = $em->createQuery("SELECT (p.image) as imageLocation, p.id as idLocation, p.nomEtablissement as titreLocation, p.latEtablissement as latEtablissement , p.longEtablissement as longEtablissement, ( 6386 * ACOS( COS( radians(36.7581145) ) * COS( radians( p.latEtablissement ) ) * COS( radians( p.longEtablissement ) - radians(10.0169723) ) + sin( radians(36.7581145) ) * sin( radians( p.latEtablissement ) ) ) ) AS distance FROM AdministrationBundle:Etablissement p HAVING  (distance < 100)");
        $result = $query->getResult();
        $ar = array();

        foreach($result as $ac){
            $request = $this->getRequest();
            $img = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/uploads/'.$ac['imageLocation'];
            array_push($ar,array(
                "id" => $ac['idLocation'],
                'titre'=>$ac['titreLocation'],
                'image'=>$img,
                'distance'=>$ac['distance'],
                'lat'=>$ac['latEtablissement'],
                'long'=>$ac['longEtablissement']

            ));
        }
        return new JsonResponse($ar,200,array('Content-Type'=>'application/json'));
    }

    public function locationMapAction()
    {
        return $this->render('ProjetBundle:etablissement:location.html.twig');
    }





    public function rankOneEtabJSONAction(Request $request){

        if($request->getMethod()=="POST") {

            $dataA = json_decode($request->getContent(), true);


            $request->request->replace($dataA);


            $idR = $request->request->get('idr');

            $conn = $this->container->get('database_connection');
            $sqlrank = " select SUM(nbr_rank)/count(id) as rank , count(id) as nbrVote from rank where rank_etablissement_id=".$idR;

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





    public function nbrLikeDislikeEtabJSONAction(Request $request){

        if($request->getMethod()=="POST") {

            $dataA = json_decode($request->getContent(), true);


            $request->request->replace($dataA);


            $idR = $request->request->get('idr');

            $conn = $this->container->get('database_connection');
            $sqlLike = " select count(id) as nbrLike from appreciation where aime_appreciation=1 and appreciation_etablissement_id=".$idR;

            $likes =$conn->query($sqlLike)->fetchColumn();


            $sqlDisLike =  "select count(id) as nbrDisLike from appreciation where naimePasAppreciation=1 and appreciation_etablissement_id=".$idR;

            $dislikes =$conn->query($sqlDisLike)->fetchColumn();

            $data=array("likes"=>$likes,"dislikes"=>$dislikes);

            return new JsonResponse($data,200,array('Content-Type'=>'application/json'));


        }else{
            die('vous pouver pas acceder a cet url');
        }


    }


    public function getDataForAddEtabJsonAction(){

        $em = $this->getDoctrine()->getEntityManager();


        // gov
        $cat = $em->getRepository('AdministrationBundle:Categorie')->findAll();
        $tableCat = array();
        foreach ($cat as $c){
            array_push($tableCat,array('id'=>$c->getId(),'nomcat'=>$c->getNomCategorie()

            ));
        }



        // Specialite
        $specialite = $em->getRepository('AdministrationBundle:Specialite')->findAll();
        $tableSpec = array();
        foreach ($specialite as $s){
            array_push($tableSpec,array('id'=>$s->getId(),'specialite'=>$s->getNomSpecialite()

            ));
        }

        // Ambiance
        $Ambiance = $em->getRepository('AdministrationBundle:Ambiance')->findAll();
        $tableAmbiance = array();
        foreach ($Ambiance as $a){
            array_push($tableAmbiance,array('id'=>$a->getId(),'ambiance'=>$a->getNomAmbiance()

            ));
        }


        // AutreFiltres
        $filtre = $em->getRepository('AdministrationBundle:Filtre')->findAll();
        $tableFiltre = array();
        foreach ($filtre as $f){
            array_push($tableFiltre,array('id'=>$f->getId(),'filtre'=>$f->getNomFiltre()

            ));
        }


        $govs = $em->getRepository('AdministrationBundle:Gouvernorat')->findAll();
        $tableGovs = array();
        foreach ($govs as $g){
            array_push($tableGovs,array('id'=>$g->getId(),'nomGov'=>$g->getNomGouvernorat()

            ));
        }


        // result
        $res = array('specialite'=>$tableSpec,'ambiance'=>$tableAmbiance,'filtre'=>$tableFiltre,'cat'=>$tableCat,'govs'=>$tableGovs);


        return new JsonResponse($res,200,array('Content-Type'=>'application/json'));



    }



    public function getGovsJsonAction(){

        $em = $this->getDoctrine()->getEntityManager();

        $govs = $em->getRepository('AdministrationBundle:Gouvernorat')->findAll();
        $tableGovs = array();
        foreach ($govs as $g){
            array_push($tableGovs,array('id'=>$g->getId(),'nomGov'=>$g->getNomGouvernorat()

            ));
        }


        // result
        $res = array('govs'=>$tableGovs);


        return new JsonResponse($res,200,array('Content-Type'=>'application/json'));




    }


    public function getRegionSelonGovJsonAction($idGov){

        $conn = $this->container->get('database_connection');
        $sqlregion = " select id,nom_region as nomR from region WHERE gouvernorat_id=".$idGov;

        $rows = $conn->query($sqlregion);

        $data =array();
        foreach ($rows as $r){

            array_push($data, array('id'=>$r['id'],'nomRegion'=>$r['nomR']));

        }
        return new JsonResponse($data,200,array('Content-Type'=>'application/json'));

    }


    public function addEtablissementAction(Request $request){

        if($request->getMethod()=="POST"){
            $dataA = json_decode($request->getContent(), true);


            $request->request->replace($dataA);


            /*

            {
                    idcat:idCatSelected,
                    spec:specAdd,
                    amb:ambAdd,
                    fltr:fltrAdd,
                    nom:$scope.nomEtabAdd,
                    addr:$scope.addrEtabAdd,
                    codeEtab:$scope.codeEtabAdd,
                    tel1:$scope.tel1EtabAdd,
                    tel2:$scope.tel2EtabAdd,
                    tel3:$scope.tel3EtabAdd,
                    mail:$scope.mailEtabAdd,
                    site:$scope.siteEtabAdd,
                    page:$scope.pageFbEtabAdd,
                    ouv1:$scope.ouv1EtabAdd,
                    ferm1:$scope.ferm1EtabAdd,
                    ouv2:$scope.ouv2EtabAdd,
                    ferm2:$scope.ferm2EtabAdd,
                    longi:$scope.longiEtabAdd,
                    lati:$scope.latiEtabAdd,
                    gov:$("#selectGov").val(),
                    reg:$("#selectReg").val(),
                }



            */



            $idCat = $request->request->get('idcat');
            $tblSpec = $request->request->get('spec');
            $tblAmb = $request->request->get('amb');
            $tblFltr = $request->request->get('fltr');
            $nom = $request->request->get('nom');
            $addr = $request->request->get('addr');
            $codeEtab = $request->request->get('codeEtab');
            $tel1 = $request->request->get('tel1');
            $tel2 = $request->request->get('tel2');
            $tel3 = $request->request->get('tel3');
            $mail = $request->request->get('mail');
            $site = $request->request->get('site');
            $page = $request->request->get('page');
            $ouv1 = $request->request->get('ouv1');
            $ferm1 = $request->request->get('ferm1');
            $ouv2 = $request->request->get('ouv2');
            $ferm2 = $request->request->get('ferm2');
            $longi = $request->request->get('longi');
            $lati = $request->request->get('lati');
            $idGov = $request->request->get('gov');
            $idRegion = $request->request->get('reg');



            $em=$this->getDoctrine()->getEntityManager();

            $etablissement= new Etablissement();

            $cat=$em->getRepository('AdministrationBundle:Categorie')->findOneBy(array('id'=>$idCat));
            if($cat){
                $etablissement->addCategorie($cat);
            }
            $region=$em->getRepository('AdministrationBundle:Region')->findOneBy(array('id'=>$idRegion));
            if($region){
                $etablissement->setRegion($region);
            }
            $gouvernorat=$em->getRepository('AdministrationBundle:Gouvernorat')->findOneBy(array('id'=>$idGov));
            if($gouvernorat){
                $etablissement->setGouvernorat($gouvernorat);
            }



            foreach ($tblSpec as $s){
                $spec=$em->getRepository('AdministrationBundle:Specialite')->findOneBy(array('id'=>$s));
                $etablissement->addSpecialite($spec);
            }

            foreach ($tblAmb as $a){
                $ambi=$em->getRepository('AdministrationBundle:Ambiance')->findOneBy(array('id'=>$a));
                $etablissement->addAmbiance($ambi);
            }


            foreach ($tblFltr as $f){
                $filtre=$em->getRepository('AdministrationBundle:Filtre')->findOneBy(array('id'=>$f));
                $etablissement->addFiltre($filtre);
            }

            $etablissement->setNomEtablissement($nom)->setAdresseEtablissement($addr)->setPostaleEtablissement($codeEtab)
                        ->setEmailEtablissement($mail)->setWebEtablissement($site)->setFacebookEtablissement($page)
                        ->setTelOneEtablissement($tel1)->setTelTwoEtablissement($tel2)->setTelThreeEtablissement($tel3)
                        ->setHorraireFromFirstEtablissement($ouv1)->setHorraireToFirstEtablissement($ferm1)
                        ->setHorraireFromSecondEtablissement($ouv2)->setHorraireToSecondEtablissement($ferm2)
                        ->setLongEtablissement($longi)->setLatEtablissement($lati);


            /*MAHOMCH MAWJOUDIN FIL FORM*/

            $etablissement->setDescriptionEtablissement("aucune description");
            $etablissement->setBudgetEtablissement("30");
            $etablissement->setVisiteEtablissement(0);
            $image=new Media();
            $image->setUrl('jpeg');
            $image->setAlt("trois fourchettes.jpg");
            $em->persist($image);
            $em->flush();

            $etablissement->setImage($image);


            /*MAHOMCH MAWJOUDIN FIL FORM*/


            $em->persist($etablissement);
            $em->flush();

            die('tzed');


        }else{
            die('vous pouvez pas acceder a cet url');
        }



    }

    public function etablissementSignalAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();
        $signal = new EtablissementSignal();
        $texte = $request->get('texte');
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $etablissement = $em->getRepository('AdministrationBundle:Etablissement')->findOneBy(array('id'=>$id));
        $signal->setClient($user);
        $signal->setDateEtablissementSignal(new \DateTime);
        $signal->setEtablissement($etablissement);
        $signal->setTextEtablissementSignal($texte);

        $em->persist($signal);
        $em->flush();

        return new JsonResponse("ok");

    }

}
