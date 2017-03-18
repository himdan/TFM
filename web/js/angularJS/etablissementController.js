var appEtab = angular.module('myAppEtab',['ui-rangeSlider'])
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
appEtab.controller('etablissementController', function($scope,$http) {

    $scope.latt=36.7605422;
    $scope.longg=10.0127649;
    $scope.filtrePret=false;

    $scope.demo1 = {
        min: 0,
        max: 100
    };





    $scope.tester=function(){
        //setTimeout(function(){
        alert('hey');
        //},100);
    }

    $scope.$watch("demo1.min", function(newValue, oldValue){
        $scope.minBudget=newValue;

        $scope.calldatabaseEtab();
        console.log("Minimum:"+newValue);
    });

    $scope.$watch("demo1.max", function(newValue, oldValue){
        $scope.maxBudget=newValue;

        $scope.calldatabaseEtab();
        console.log("Maximum:"+newValue);
    });


    //$scope.$watch($scope.demo1.min, $scope.tester);

    $scope.specialite=[];
    $scope.ambiance=[];
    $scope.filtre=[];
    $scope.govs=[];
    $scope.pageNumber= 1 ;


    $scope.specToFind=[];
    $scope.ambToFind=[];
    $scope.filToFind=[];
    $scope.regToFind=[];


    /******HEDHI TETBADEL APRES KI TWALLI BEL GEOLOCALISATION*******/
    $scope.govToFind=[1];

    $scope.initalizeFilter=function(){
        $scope.specToFind=[];
        $scope.ambToFind=[];
        $scope.filToFind=[];
        $scope.regToFind=[];
        $scope.pageNumber= 1 ;

        /*HEDHI NORMALEMENT TET3ABA SELON GEOLOCALISATION*/
        /*HEDHI NORMALEMENT TET3ABA SELON GEOLOCALISATION*/
        /*************/ $scope.govToFind=[]; /************/


        var ElementsGouv=document.getElementsByName("govCB");

        for(var egi=0;egi< ElementsGouv.length ; egi++){
            ElementsGouv[egi].checked=false;

        }

        $scope.govToFind=[1];
        var CBTunisGov=document.getElementById('g1');
        CBTunisGov.checked=true;


        /*HEDHI NORMALEMENT TET3ABA SELON GEOLOCALISATION*/
        /*HEDHI NORMALEMENT TET3ABA SELON GEOLOCALISATION*/



        var ElementsFiltre=document.getElementsByName("answer");

        for(var i=0;i< ElementsFiltre.length ; i++){
            ElementsFiltre[i].checked=false;

        }



        $scope.calldatabaseEtab();
    }






    $scope.changePage=function(act){
        if(act=="prec"){
            if($scope.pageNumber > 1){

                $scope.pageNumber= $scope.pageNumber - 1 ;

                $scope.calldatabaseEtab();


            }

        }


        if(act=="suivant"){
            if($scope.pageNumber < $scope.nombreDesPages){
                $scope.pageNumber= $scope.pageNumber + 1 ;

                $scope.calldatabaseEtab();


            }

        }

        if(act=="first"){
            $scope.pageNumber= 1 ;
            $scope.calldatabaseEtab();
        }


        if(act=="last"){
            $scope.pageNumber= $scope.nombreDesPages ;
            $scope.calldatabaseEtab();
        }


    }


    $scope.nbrExcCallDataBase = 0;


    $scope.calldatabaseEtab=function(){

        if($scope.filtrePret==true){
            $scope.nbrExcCallDataBase++;
            if($scope.nbrExcCallDataBase == 1){
                alert('ok');
                $scope.initalizeFilter();
            }
            document.getElementById('chargementBlockResult').style.display="block";
            document.getElementById('blockResult').style.display="none";

            var objToSend={
                specToFind:$scope.specToFind,
                ambToFind:$scope.ambToFind,
                filToFind:$scope.filToFind,
                govToFind:$scope.govToFind,
                regToFind:$scope.regToFind,
                minBudToFind:$scope.minBudget,
                maxBudToFind:$scope.maxBudget,
                pageNumber:$scope.pageNumber
            }


            console.log("b3atht:");
            console.dir(objToSend);

            //$scope.routeFiltred="http://localhost/last/web/app_dev.php/etablissement/eJson/EtablissementFiltredJson";
            $http.post(Routing.generate('EtablissementFiltredJson'),objToSend)
                .then(function(response) {

                    console.log("mel base");
                    console.dir(response.data);
                    $scope.regionsAff=response.data.regions;
                    if(response.data.result==0){


                        document.getElementById('aucuneR7').style.display="block";
                        //document.getElementById('existeR7').style.display="none"; //name="tebaaResult"

                        var DivsResult=document.getElementsByName("tebaaResult");
                        for(dvi=0;dvi<DivsResult.length;dvi++){
                            DivsResult[dvi].style.display="none";
                        }



                    }else{
                        document.getElementById('aucuneR7').style.display="none";
                        //document.getElementById('existeR7').style.display="block";

                        var DivsResult=document.getElementsByName("tebaaResult");
                        for(dvi=0;dvi<DivsResult.length;dvi++){
                            DivsResult[dvi].style.display="block";
                        }


                        $scope.etablissementFiltred=response.data.result;
                        $scope.nombreTotal=response.data.total;

                        $scope.nombreDesPages=Math.ceil($scope.nombreTotal/10);

                    }

                    document.getElementById('chargementBlockResult').style.display="none";
                    document.getElementById('blockResult').style.display="block";

                    console.log($scope.nombreDesPages);


                });


        }



    }

    $scope.calldatabaseEtab();

    $scope.checkRegion=function(id,quoi) {

        var idCheckReg = quoi + id;
        var checkCheckReg = document.getElementById(idCheckReg);

        if (checkCheckReg.checked) {
            $scope.regToFind.push(id);

        } else {
            var indexIdReg = $scope.regToFind.indexOf(id);
            if (indexIdReg > -1) {
                $scope.regToFind.splice(indexIdReg, 1);
            }
        }

        $scope.calldatabaseEtab();



    }


    $scope.ischeckedReg=function(id){
        var indexIdRegIsChecked = $scope.regToFind.indexOf(id);

        if(indexIdRegIsChecked> -1){
            return true;
        }else{
            return false;
        }

    }




    $scope.checkuncheck=function(id,quoi) {
        var idCheck = quoi + id;



        /*********MTA3 EL GOVERNERAT*****************/



        if(quoi=="g"){

            /*NFARAGH LES REGIONS W NDECOCHEHOM*/
            $scope.regToFind=[];
            //regionCB
            var regionsCBToDec=document.getElementsByName("regionCB");
            for(var ri=0;ri<regionsCBToDec.length;ri++ ){
                regionsCBToDec[ri].checked=false;
            }

            /*NFARAGH LES REGIONS W NDECOCHEHOM*/




            var checkCheckG = document.getElementById(idCheck);
            var indexIdG = $scope.govToFind.indexOf(id);

            if (indexIdG > -1) {
                $scope.govToFind.splice(indexIdG, 1);
                checkCheckG.checked=false;
            } else {
                $scope.govToFind=[];
                $scope.govToFind.push(id);
            }






        }

        /*********MTA3 EL GOVERNERAT*****************/





        if(quoi=="sp"){

            var checkChecksp = document.getElementById(idCheck);

            if (checkChecksp.checked) {
                $scope.specToFind.push(id);

            } else {
                var indexIdSP = $scope.specToFind.indexOf(id);
                if (indexIdSP > -1) {
                    $scope.specToFind.splice(indexIdSP, 1);
                }
            }

        }

        if(quoi=="am"){

            var checkCheckam = document.getElementById(idCheck);

            if (checkCheckam.checked) {
                $scope.ambToFind.push(id);

            } else {
                var indexIdAM = $scope.ambToFind.indexOf(id);
                if (indexIdAM > -1) {
                    $scope.ambToFind.splice(indexIdAM, 1);
                }
            }

        }

        if(quoi=="fl"){

            var checkCheckfl = document.getElementById(idCheck);

            if (checkCheckfl.checked) {
                $scope.filToFind.push(id);

            } else {
                var indexIdFL = $scope.filToFind.indexOf(id);
                if (indexIdFL > -1) {
                    $scope.filToFind.splice(indexIdFL, 1);
                }
            }

        }


        $scope.pageNumber= 1 ;

        $scope.calldatabaseEtab();

    }

    //$scope.pathFilre="http://localhost/last/web/app_dev.php/etablissement/eJson/EtablissementfiltreJSON";
    $http.post(Routing.generate('EtablissementfiltreJSON'))
        .then(function(response) {

            /*********PARTIE Langues*************/

            //console.dir(response.data);

            $.each(response.data["specialite"], function (index, item) {


                $scope.specialite.push({
                    id:item.id,
                    specialite:item.specialite
                });


            });

            $.each(response.data["ambiance"], function (index, item) {


                $scope.ambiance.push({
                    id:item.id,
                    ambiance:item.ambiance
                });


            });


            $.each(response.data["filtre"], function (index, item) {


                $scope.filtre.push({
                    id:item.id,
                    filtre:item.filtre
                });


            });



            $.each(response.data["gov"], function (index, item) {


                $scope.govs.push({
                    id:item.id,
                    nomgov:item.nomgov
                });


            });

            setTimeout(function(){
                var CBTunisGov=document.getElementById('g1');
                CBTunisGov.checked=true;

            },10)



            /*********FIN DU CHARGEMENT************/
            $scope.filtrePret=true;
            alert('el filtre jé');
            document.getElementById("chargementPage").style.display="none";
            document.getElementById("page").style.display="block";

            /*********FIN DU CHARGEMENT************/

        }).then(function(response) {

        /*HEDHI NORMALEMENT TET3ABA SELON GEOLOCALISATION*/
        /*HEDHI NORMALEMENT TET3ABA SELON GEOLOCALISATION*/

        /*HEDHI NORMALEMENT TET3ABA SELON GEOLOCALISATION*/
        /*HEDHI NORMALEMENT TET3ABA SELON GEOLOCALISATION*/


        /*console.log($scope.specialite);
         console.log($scope.ambiance);
         console.log($scope.filtre);*/

    });







});
