
/*function compile(element){
    var el = angular.element(element);
    $scope = el.scope();
    $injector = el.injector();
    $injector.invoke(function($compile){
        $compile(el)($scope)
    })
}*/


var appAmis = angular.module('myAppAmis',[])
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
appAmis.controller('amisController', function($scope,$http) {

    $scope.ami="nidhal mon ami";

    $scope.choixAffichage="";

    $scope.amisAffiche=[];




    $scope.checkUncheck= function(choix){

        var cbAmis=document.getElementById('cbttAmis');
        var cbrece=document.getElementById('cbrecent');
        var cbdem=document.getElementById('cbdemande');
        var cbrecu=document.getElementById('cbrecu');
        var cbblok=document.getElementById('cbblock');

        if(choix == "cbttAmis"){

            cbAmis.checked=true;
            cbrece.checked=false;
            cbdem.checked=false;
            cbrecu.checked=false;
            cbblok.checked=false;


            if(cbAmis.checked){
                $scope.choixAffichage="cbttAmis";

                $scope.calldatabaseAmis();
            }else{

                cbAmis.checked=true;

            }


        }



        if(choix == "cbrecent"){

            cbrece.checked=true;
            cbAmis.checked=false;
            cbdem.checked=false;
            cbrecu.checked=false;
            cbblok.checked=false;


            if(cbrece.checked){
                $scope.choixAffichage="cbrecent";

                $scope.calldatabaseAmis();


            }else{

                cbrece.checked=true;

            }


        }



        if(choix == "cbdemande"){

            cbdem.checked=true;
            cbAmis.checked=false;
            cbrece.checked=false;
            cbrecu.checked=false;
            cbblok.checked=false;



            if(cbdem.checked){
                $scope.choixAffichage="cbdemande";

                $scope.calldatabaseAmis();

            }else{

                cbdem.checked=true;

            }


        }


        if(choix == "cbrecu"){

            cbrecu.checked=true;
            cbAmis.checked=false;
            cbrece.checked=false;
            cbdem.checked=false;
            cbblok.checked=false;


            if(cbrecu.checked){
                $scope.choixAffichage="cbrecu";

                $scope.calldatabaseAmis();

            }else{

                cbrecu.checked=true;

            }



        }



        if(choix == "cbblock"){

            cbblok.checked=true;
            cbAmis.checked=false;
            cbrece.checked=false;
            cbdem.checked=false;
            cbrecu.checked=false;


            if(cbblok.checked){
                $scope.choixAffichage="cbblock";

                $scope.calldatabaseAmis();

            }else{

                cbblok.checked=true;

            }



        }



    }



    $scope.deleteAmis=function(id){
        document.getElementById("chargementAmis").style.display="block";
        document.getElementById("resultAmis").style.display="none";

        if($scope.choixAffichage=="cbblock"){
            console.log('bech na7iw block id mte3o '+id);

            $http.post(Routing.generate('bloqueSupprimer', { userSupprimer: id }))
        .then(function(response) {

                alert(response.data);
                $scope.calldatabaseAmis();
                });

        }else{
            console.log('bech na7iw amitie id '+id);

            $http.post(Routing.generate('amiSupprimer', { userSupprimer: id }))
                .then(function(response) {

                    alert(response.data);
                    $scope.calldatabaseAmis();
                });

        }


    }



    $scope.calldatabaseAmis=function(){

        document.getElementById("chargementAmis").style.display="block";
        document.getElementById("resultAmis").style.display="none";


        // debut chargement

        console.log($scope.choixAffichage);

        if($scope.choixAffichage=="cbttAmis"){

            $http.post(Routing.generate('amis'))
                .then(function(response) {
                    document.getElementById("notFound").style.display="none";
                    console.dir(response.data);
                    $scope.amisAffiche=response.data;
                    if($scope.amisAffiche.length == 0){
                        document.getElementById("notFound").style.display="block";

                    }

                }).then(function(response){

                document.getElementById("chargementAmis").style.display="none";
                document.getElementById("resultAmis").style.display="block";

                });


        }


        /**********kenha ajoute recent ******/

        if($scope.choixAffichage=="cbrecent"){

            $http.post(Routing.generate('amisRecent'))
                .then(function(response) {
                    document.getElementById("notFound").style.display="none";
                    console.dir(response.data);
                    $scope.amisAffiche=response.data;
                    if($scope.amisAffiche.length == 0){
                        document.getElementById("notFound").style.display="block";

                    }

                }).then(function(response){

                document.getElementById("chargementAmis").style.display="none";
                document.getElementById("resultAmis").style.display="block";

            });


        }


        /**********kenha envoyee ******/

        if($scope.choixAffichage=="cbdemande"){

            $http.post(Routing.generate('amisEnvoye'))
                .then(function(response) {

                    document.getElementById("notFound").style.display="none";
                    console.dir(response.data);
                    $scope.amisAffiche=response.data;
                    if($scope.amisAffiche.length == 0){
                        document.getElementById("notFound").style.display="block";

                    }

                }).then(function(response){

                document.getElementById("chargementAmis").style.display="none";
                document.getElementById("resultAmis").style.display="block";

            });


        }



        /**********kenha recuu ******/

        if($scope.choixAffichage=="cbrecu"){

            $http.post(Routing.generate('amisRecu'))
                .then(function(response) {
                    document.getElementById("notFound").style.display="none";
                    console.dir(response.data);
                    $scope.amisAffiche=response.data;
                    if($scope.amisAffiche.length == 0){
                        document.getElementById("notFound").style.display="block";

                    }

                }).then(function(response){

                document.getElementById("chargementAmis").style.display="none";
                document.getElementById("resultAmis").style.display="block";

            });


        }

        if($scope.choixAffichage=="cbblock"){

            $http.post(Routing.generate('amisBloque'))
                .then(function(response) {
                    document.getElementById("notFound").style.display="none";
                    console.dir(response.data);
                    $scope.amisAffiche=response.data;
                    if($scope.amisAffiche.length == 0){
                        document.getElementById("notFound").style.display="block";

                    }

                }).then(function(response){

                document.getElementById("chargementAmis").style.display="none";
                document.getElementById("resultAmis").style.display="block";

            });


        }






        // fin chargement

    }





    $scope.checkUncheck("cbttAmis");



});
