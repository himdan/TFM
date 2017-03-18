/**
 * Created by lotfidev on 18/06/16.
 */


var app = angular.module('myApp',[])
    .config(function($interpolateProvider){
        $interpolateProvider.startSymbol('#').endSymbol('#');




    })
    .directive('loading', function () {
        return {
            restrict: 'E',
            replace:true,
            template: '<div class="loading"><img src="http://www.nasa.gov/multimedia/videogallery/ajax-loader.gif" width="20" height="20" />LOADING...</div>',
            link: function (scope, element, attr) {
                scope.$watch('loading', function (val) {
                    if (val)
                        $(element).show();
                    else
                        $(element).hide();
                });
            }
        }
    });
app.controller('recetteController', function($scope,$http) {

    /*----+++  ATTENTION : 53 EST LE NOMBRE DES CHARACTERES DU DEBUT VERS DERNIERE CHAR DE DETAILS ++++------*/
    if(document.referrer.substring(0, 53) == "http://localhost/last/web/app_dev.php/recette/details"){
        //alert('jey mel detail kedhe');
        //hne:ne5o el idThemeMelLocalStorage w n7otto wa7do fil thmToFind , ncochi el checkBox mté3ha wndhaher les checkBox
        //wn3ayét lel database









    }



    $scope.addFavorie = function(idR){
        $http.post(Routing.generate('Addfavoris', { id: idR , type: "recette"}))
            .then(function(response) {
                //console.log('favorie c bon lel '+idR);
                $scope.callDatabase();

            });

    }



    $scope.usernameCo="mazelt fergha";

    $scope.ordre="recent";

    $scope.changeOrdre=function(quoi){
        
        $scope.pageNumber=1;
        $scope.ordre=quoi;
        $scope.callDatabase();
    }


    /*TEST MODAL*/
    $scope.openModalVote=function(idRV){
        $scope.idRecetteAvoter=idRV;
        $('#myModal').modal('show');

    }

    $scope.voter=function(NbrVote){
        document.getElementById("partieVote").style.display="none";
        document.getElementById("chargementPartieVote").style.display="block";
        document.getElementById("messagePartieVote").innerHTML="";
        $http.post(Routing.generate('Addrank', { id: $scope.idRecetteAvoter , type: "recette",nbr:NbrVote }))
            .then(function(response) {
                //console.log(response.data);
                document.getElementById("partieVote").style.display="block";
                document.getElementById("chargementPartieVote").style.display="none";
                document.getElementById("messagePartieVote").innerHTML=response.data.success;
                $scope.callDatabase();
            }).then(function(response){
            setTimeout(function(){
                $('#myModal').modal('hide');
            },2000);
            });


    }


    /*TEST MODAL*/




    $scope.idMenuPremier=0;
    /********RESULTAT DES FILTRES EXISTANTS*****************/
    $scope.subCat=[];

    $scope.recettes=[

    ];

    $scope.prixs=[

    ];

    $scope.nationalites=[

    ];


    $scope.themes=[];

    $scope.ingredients=[];

    $scope.saisons=[];

    $scope.couisTypes=[];

    $scope.menus=[];
    $scope.textTofind="";


    $scope.natToFind=[];
    $scope.prxToFind=[];
    $scope.diffToFind=[];
    $scope.thmToFind=[];
    $scope.ingToFind=[];
    $scope.saisToFind=[];
    $scope.couisTypeToFind=[];
    $scope.menuToFind=[];
    $scope.subCatToFind=[];




    $http.post(Routing.generate('filtreJSON'))
        .then(function(response) {
            $.each(response.data["subcategorie"], function (index, item) {

                $scope.subCat.push({
                    id:item.id,
                    subcategorie:item.subcategorie,
                    menu:item.menu
                });


            });


            /*****PARTIEE PRIX*********/


            $.each(response.data['prix'], function (index, item) {

                $scope.prixs.push({
                    id:item.id,
                    prix:item.prix

                });


            });

            $scope.difficultees=[];

            $.each(response.data['difficulte'], function (index, item) {

                $scope.difficultees.push({
                    id:item.id,
                    difficult:item.difficulte

                });


            });


            /*****PARTIEE PRIX*********/

            /*********PARTIE NATIONALITE******/



            $.each(response.data["nationalite"], function (index, item) {


                $scope.nationalites.push({
                    id:item.id,
                    nationalite:item.nationalite
                });


            });

            /*********PARTIE NATIONALITE******/

            /***********PARTIE THEMES********/


            $.each(response.data["theme"], function (index, item) {


                $scope.themes.push({
                    id:item.id,
                    theme:item.theme
                });


            });



            /***********PARTIE THEMES********/

            /*********PARTIE INGREDIENTS*************/



            $.each(response.data["ingredient"], function (index, item) {


                $scope.ingredients.push({
                    id:item.id,
                    ingredient:item.ingredient
                });


            });


            /*********PARTIE INGREDIENTS*************/

            /***********PARTIE SAISONS*********/



            $.each(response.data["saison"], function (index, item) {

                $scope.saisons.push({
                    id:item.id,
                    saison:item.saison
                });


            });



            /***********PARTIE SAISONS*********/

            /**********PARTIE TYPES CUISSONS**********/



            $.each(response.data["cuisson"], function (index, item) {

                $scope.couisTypes.push({
                    id:item.id,
                    couisson:item.couisson
                });


            });





            /**********PARTIE TYPES CUISSONS**********/

            /************PARTIE DES MENUS*****************/



            var nbrItMenu=0;

            $.each(response.data["menu"], function (index, item) {

                if(nbrItMenu>0){

                    $scope.menus.push({
                        id:item.id,
                        menu:item.menu,
                        checked:false
                    });

                }else{
                    $scope.menus.push({
                        id:item.id,
                        menu:item.menu,
                        checked:true
                    });

                    $scope.menuToFind=[];
                    $scope.idMenuPremier=item.id;
                    $scope.menuToFind.push(item.id);


                    $scope.subCatToShow=[];

                    for (ss = 0; ss < $scope.subCat.length; ss++) {

                        if ($scope.subCat[ss].menu == item.id ) {
                            $scope.subCatToShow.push($scope.subCat[ss]);
                        }
                    }

                    /*
                    console.log("||||||||||||||||||||||||||||||");
                    console.log("Nationa:"+$scope.natToFind);
                    console.log("Prix"+$scope.prxToFind);
                    console.log("Difficult"+$scope.diffToFind);
                    console.log("Themes :"+$scope.thmToFind);
                    console.log("Ingredients :"+$scope.ingToFind);
                    console.log("Saisons :"+$scope.saisToFind);
                    console.log("CouisType :"+$scope.couisTypeToFind);
                    console.log("Menus :"+$scope.menuToFind);
                    console.log("||||||||||||||||||||||||||||||");
                    */

                }



                nbrItMenu++;
            });




            /************PARTIE DES MENUS*****************/

            /*********FIN DU CHARGEMENT************/

                document.getElementById("page").style.display="block";
                document.getElementById("myCarousel").style.display="block";
                document.getElementById("chargementPage").style.display="none";

            /*********FIN DU CHARGEMENT************/

        }).then(function(response) {

        /**********ESPACE DE TEST**************/

        setTimeout(function(){
            if(document.referrer.substring(0, 53) == "http://localhost/last/web/app_dev.php/recette/details"){

                //hne:ne5o el idThemeMelLocalStorage w n7otto wa7do fil thmToFind , ncochi el checkBox mté3ha wndhaher les checkBox
                //wn3ayét lel database
                $scope.thmToFind=[];
                $scope.thmToFind.push(localStorage.getItem('thmToFind'));
                var idCbthm="thm"+localStorage.getItem('thmToFind');
                document.getElementById(idCbthm).checked=true;

                $scope.callDatabase();



            }


        }, 10);


        setTimeout(function(){
            document.getElementById("filterByTheme").style.display="block";
            document.getElementById("filterByTheme").style.position="relative";
            document.getElementById("filterByTheme").style.overflow="visible";

        },700);




        /**********ESPACE DE TEST**************/




        /**********ESPACE DE TEST**************/




        $scope.pageNumber= 1 ;
        //Appel pour le premier chargement de la page
        $scope.callDatabase();

        });



    /********RESULTAT DES FILTRES EXISTANTS*****************/
    
    /*
    $scope.isChecked=function (id,nom) {

        $scope.idIsCheck = nom + id;
        $scope.checkIsCheck = document.getElementById($scope.idIsCheck);

        if($scope.checkIsCheck.checked){
            return true;
        }else{
            return false;
        }


    }
    */


    $scope.filtreText=function(){
        $scope.textTofind=$scope.filtrText;
        if($scope.textTofind.length > -1){

            $scope.callDatabase();


        }


    }


    $scope.changePage=function(act){
        window.scrollTo(0, 315);
        if(act=="prec"){
            if($scope.pageNumber > 1){

                $scope.pageNumber= $scope.pageNumber - 1 ;

                $scope.callDatabase();


            }

        }


        if(act=="suivant"){
            if($scope.pageNumber < $scope.nombreDesPages){
                $scope.pageNumber= $scope.pageNumber + 1 ;

                $scope.callDatabase();


            }

        }

        if(act=="first"){
                $scope.pageNumber= 1 ;
                $scope.callDatabase();
        }


        if(act=="last"){
            $scope.pageNumber= $scope.nombreDesPages ;
            $scope.callDatabase();
        }


    }


/*************DEBUT DE FONCTION DE COLLECTE DES FILTRES*************/
    $scope.checkUncheckNat=function(id,grpFltr) {


        $scope.pageNumber= 1 ;


        var idCheck = grpFltr + id;

        if (grpFltr == "nation") {

            var checkCheck = document.getElementById(idCheck);
            if (checkCheck.checked) {
                $scope.natToFind.push(id);
                //alert('cochiiit el nationalite'+id);
            } else {
                var indexId = $scope.natToFind.indexOf(id);
                if (indexId > -1) {
                    $scope.natToFind.splice(indexId, 1);
                }
                //alert('decochiiit el nationalite'+id);
            }


        }


        if (grpFltr == "prxs") {

            var checkCheckp = document.getElementById(idCheck);

            //console.log(checkCheckp.checked);
            if (checkCheckp.checked) {

                var allCbPrix = document.getElementsByName("cbPrix");

                // ndécochi les checkboxPrix sauf eli nzelt aleha

                for (bi = 0; bi < allCbPrix.length; bi++) {

                    if (allCbPrix[bi] != checkCheckp) {
                        allCbPrix[bi].checked = false;

                    }

                }

                $scope.prxToFind = [];
                $scope.prxToFind.push(id);


            } else {

                var indexIdp = $scope.prxToFind.indexOf(id);
                if (indexIdp > -1) {
                    $scope.prxToFind.splice(indexIdp, 1);
                }
            }

        }


        if (grpFltr == "diffic") {

            var checkCheckd = document.getElementById(idCheck);
            if (checkCheckd.checked) {


                var allCbDif = document.getElementsByName("cbDif");

                // ndécochi les checkboxDiff sauf eli nzelt aleha

                for (di = 0; di < allCbDif.length; di++) {

                    if (allCbDif[di] != checkCheckd) {
                        allCbDif[di].checked = false;

                    }

                }

                $scope.diffToFind = [];
                $scope.diffToFind.push(id);

            } else {


                var indexIdd = $scope.diffToFind.indexOf(id);
                if (indexIdd > -1) {
                    $scope.diffToFind.splice(indexIdd, 1);
                }


            }


        }


        if (grpFltr == "thm") {

            var checkCheckth = document.getElementById(idCheck);
            //var containTh="containerThm"+id;
            //var ContainerTh = document.getElementById(containTh);

            if (checkCheckth.checked) {

                //ContainerTh.classList.add("checked");
                $scope.thmToFind.push(id);
            }
            else {
                var indexIdth = $scope.thmToFind.indexOf(id);
                if (indexIdth > -1) {
                    $scope.thmToFind.splice(indexIdth, 1);
                }
            }


        }


        if (grpFltr == "ingr") {

            var checkCheckIng = document.getElementById(idCheck);
            if (checkCheckIng.checked) {
                $scope.ingToFind.push(id);
            } else {
                var indexIding = $scope.ingToFind.indexOf(id);
                if (indexIding > -1) {
                    $scope.ingToFind.splice(indexIding, 1);
                }
            }


        }


        if (grpFltr == "sais") {

            var checkCheckSais = document.getElementById(idCheck);
            if (checkCheckSais.checked) {
                $scope.saisToFind.push(id);
            } else {
                var indexIdsais = $scope.saisToFind.indexOf(id);
                if (indexIdsais > -1) {
                    $scope.saisToFind.splice(indexIdsais, 1);
                }
            }


        }


        if (grpFltr == "couisType") {

            var checkCheckCT = document.getElementById(idCheck);
            if (checkCheckCT.checked) {
                $scope.couisTypeToFind.push(id);
            } else {
                var indexIdCT = $scope.couisTypeToFind.indexOf(id);
                if (indexIdCT > -1) {
                    $scope.couisTypeToFind.splice(indexIdCT, 1);
                }
            }


        }


        if (grpFltr == "menus") {


            $scope.subCatToFind = [];

            var checkCheckm = document.getElementById(idCheck);

            if (checkCheckm.checked) {

                var allCbMenu = document.getElementsByName("cbMenu");

                // ndécochi les checkboxPrix sauf eli nzelt aleha

                for (ci = 0; ci < allCbMenu.length; ci++) {

                    if (allCbMenu[ci] != checkCheckm) {
                        allCbMenu[ci].checked = false;
                    }
                }

                $scope.menuToFind = [];
                $scope.menuToFind.push(id);

                //n7adher les subCat mta3 el filtre eli bech yetafichew
                $scope.subCatToShow = [];

                for (s = 0; s < $scope.subCat.length; s++) {

                    if ($scope.subCat[s].menu == id) {
                        $scope.subCatToShow.push($scope.subCat[s]);
                    }
                }



                setTimeout(function(){

                    //icheck
                    /*$('.big-checkbox').iCheck({
                        checkboxClass: 'icheckbox_minimal-grey',
                        radioClass: 'iradio_minimal-grey'
                    });*/ //hedha howa



                }, 10);


                setTimeout(function(){





                }, 30);

            } else {
                /*var indexIdm= $scope.menuToFind.indexOf(id);
                 if (indexIdm > -1) {
                 $scope.menuToFind.splice(indexIdm, 1);
                 }*/
                checkCheckm.checked = true;
            }


        }


        if (grpFltr == "subcat") {

            var checkCheckSubC = document.getElementById(idCheck);
            if (checkCheckSubC.checked) {
                $scope.subCatToFind.push(id);
            } else {
                var indexIdSc = $scope.subCatToFind.indexOf(id);
                if (indexIdSc > -1) {
                    $scope.subCatToFind.splice(indexIdSc, 1);
                }
            }


        }



        $scope.callDatabase();

    }


    $scope.initialFiltre=function(){
        $scope.pageNumber=1;

        $scope.textTofind="";


        $scope.natToFind=[];
        $scope.prxToFind=[];
        $scope.diffToFind=[];
        $scope.thmToFind=[];
        $scope.ingToFind=[];
        $scope.saisToFind=[];
        $scope.couisTypeToFind=[];
        $scope.menuToFind=[$scope.idMenuPremier];

        $scope.subCatToFind=[];


        var CheckBMenuInit=document.getElementsByName("cbMenu");
        var idMenuPrm="menus"+$scope.idMenuPremier;
        for(var InitM=0;InitM<CheckBMenuInit.length;InitM++){
            if(CheckBMenuInit[InitM].id==idMenuPrm){
                CheckBMenuInit[InitM].checked=true;
            }else{
                CheckBMenuInit[InitM].checked=false;
            }
        }

        var CheckBPrixInit=document.getElementsByName("cbPrix");

        for(var InitP=0;InitP<CheckBPrixInit.length;InitP++){
            CheckBPrixInit[InitP].checked=false;
        }



        var CheckBDiffInit=document.getElementsByName("cbDif");

        for(var InitD=0;InitD<CheckBDiffInit.length;InitD++){
            CheckBDiffInit[InitD].checked=false;
        }

        var CheckBanswerInit=document.getElementsByName("answer");

        for(var InitA=0;InitA<CheckBanswerInit.length;InitA++){
            CheckBanswerInit[InitA].checked=false;
        }


        /*for(var InitM=1;InitM<=$scope.menus.length;InitM++){
            if($scope.menus[InitM].id==$scope.idMenuPremier){
                $scope.menus[InitM].checked=true;
                alert($scope.menus[InitM].checked+"--"+InitM);
            }else{
                $scope.menus[InitM].checked=false;
            }
        }*/



        $scope.callDatabase();


    }


    /**************FIN FONCTION DU COLLECTE DES FILTRES********************/

    /*********FONCTION APPELE BASE DE DONNES POUR LE RESULT****************/

        $scope.callDatabase=function(){

            document.getElementById('chargementBlockResult').style.display="block";
            document.getElementById('blockResult').style.display="none";


            var objToSend={
                pageNumber:$scope.pageNumber,
                textTofind:$scope.textTofind,
                natTofind:$scope.natToFind,
                prxToFind:$scope.prxToFind,
                diffToFind:$scope.diffToFind,
                thmToFind:$scope.thmToFind,
                ingToFind:$scope.ingToFind,
                saisToFind:$scope.saisToFind,
                couisTypeToFind:$scope.couisTypeToFind,
                menuToFind:$scope.menuToFind,
                subCatToFind:$scope.subCatToFind,
                ordre:$scope.ordre
            }

            //console.log("b3atht:");
            //console.dir(objToSend);


            $http.post(Routing.generate('filtredRecette'),objToSend)
                .then(function(response) {

                    //console.log("mel base");
                    //console.dir(response.data);

                    if(response.data.result==0){


                        document.getElementById('aucuneR7').style.display="block";
                        document.getElementById('existeR7').style.display="none";
                        document.getElementById('paginationResult').style.display="none";
                        document.getElementById('btnSort').style.display="none";



                    }else{
                        document.getElementById('paginationResult').style.display="block";
                        document.getElementById('aucuneR7').style.display="none";
                        document.getElementById('existeR7').style.display="block";
                        document.getElementById('btnSort').style.display="block";
                        $scope.recettesFilred=response.data.result;
                        $scope.nombreTotal=response.data.total;

                        $scope.nombreDesPages=Math.ceil($scope.nombreTotal/10);

                    }

                    document.getElementById('chargementBlockResult').style.display="none";
                    document.getElementById('blockResult').style.display="block";

                    //console.log($scope.nombreDesPages);


                });

        }


    /*********FONCTION APPELE BASE DE DONNES POUR LE RESULT****************/



});
