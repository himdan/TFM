Date.prototype.yyyymmdd = function() {
    var mm = this.getMonth() + 1; // getMonth() is zero-based
    var dd = this.getDate();

    if( dd< 10){
        dd="0"+dd;
    }

    if(mm < 10){
        mm= "0"+mm;
    }

    var rslt=this.getFullYear()+"/"+mm+"/"+dd;

    return rslt;

    //return [this.getFullYear(), !mm[1] && '0', mm, !dd[1] && '0', dd].join(''); // padding
};



/*function compile(element){
    var el = angular.element(element);
    $scope = el.scope();
    $injector = el.injector();
    $injector.invoke(function($compile){
        $compile(el)($scope)
    })
}*/


var appArt = angular.module('myAppArticle',['ngSanitize'])
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
appArt.controller('articleController', function($scope,$http) {

    $scope.ordre="recent";

    $scope.changeOrdre=function(quoi){
        $scope.pageNumber=1;
        $scope.ordre=quoi;
        $scope.calldatabaseArt();
    }





    $scope.openModalVote=function(idRV){
        $scope.idRecetteAvoter=idRV;
        $('#myModal').modal('show');

    }

    $scope.voter=function(NbrVote){
        document.getElementById("partieVote").style.display="none";
        document.getElementById("chargementPartieVote").style.display="block";
        document.getElementById("messagePartieVote").innerHTML="";
        $http.post(Routing.generate('Addrank', { id: $scope.idRecetteAvoter , type: "article",nbr:NbrVote }))
            .then(function(response) {
                //console.log(response.data);
                document.getElementById("partieVote").style.display="block";
                document.getElementById("chargementPartieVote").style.display="none";
                document.getElementById("messagePartieVote").innerHTML=response.data.success;
                $scope.calldatabaseArt();
            }).then(function(response){
            setTimeout(function(){
                $('#myModal').modal('hide');
            },2000);
        });


    }






    $scope.langues=[];
    $scope.topics=[];

    //$scope.lyoom=new Date();
    //$scope.dateToFind=$scope.lyoom.yyyymmdd();

    //console.log($scope.dateToFind);
    $scope.lngToFind=[];
    $scope.tpcToFind=[];
    $scope.vidOrArt=[];
    $scope.dateToFind=[];


    $scope.ancienDate=0;


    $scope.nbrExecCallDB=0;
    $scope.calldatabaseArt=function(){
        $scope.nbrExecCallDB++;
        if($scope.nbrExecCallDB==1){

        $scope.initalizeFilter(false);


        }


        //console.log($scope.nbrExecCallDB+" fois");

        document.getElementById('chargementBlockResult').style.display="block";
        document.getElementById('blockResult').style.display="none";
        document.getElementById('paginationResult').style.display="none";

        if($scope.dateToFind[0]=="NaN/NaN/NaN"){
            $scope.dateToFind=[];
        }

        var objToSend={
            dateToFind:$scope.dateToFind,
            lngToFind:$scope.lngToFind,
            vidOrArt:$scope.vidOrArt,
            tpcToFind:$scope.tpcToFind,
            textTofind:$scope.textTofind,
            pageNumber:$scope.pageNumber,
            ordre:$scope.ordre
        }






        $http.post(Routing.generate('filtredArticle'),objToSend)
            .then(function(response) {

                if(response.data.result==0){


                    document.getElementById('aucuneR7').style.display="block";
                    document.getElementById('existeR7').style.display="none";
                    document.getElementById('paginationResult').style.display="none";



                }else{
                    document.getElementById('paginationResult').style.display="block";
                    document.getElementById('aucuneR7').style.display="none";
                    document.getElementById('existeR7').style.display="block";
                    $scope.articleFiltred=response.data.result;
                    $scope.nombreTotal=response.data.total;

                    $scope.nombreDesPages=Math.ceil($scope.nombreTotal/10);

                }

                document.getElementById('chargementBlockResult').style.display="none";
                document.getElementById('blockResult').style.display="block";



            });


    }




    $scope.filtreText=function(){
        $scope.textTofind=$scope.testNom;
        if($scope.textTofind.length > -1){

            $scope.calldatabaseArt();


        }


    }



    $scope.changePage=function(act){

        window.scrollTo(0, 0);

        if(act=="prec"){
            if($scope.pageNumber > 1){

                $scope.pageNumber= $scope.pageNumber - 1 ;

                $scope.calldatabaseArt();


            }

        }


        if(act=="suivant"){
            if($scope.pageNumber < $scope.nombreDesPages){
                $scope.pageNumber= $scope.pageNumber + 1 ;

                $scope.calldatabaseArt();


            }

        }

        if(act=="first"){
            $scope.pageNumber= 1 ;
            $scope.calldatabaseArt();
        }


        if(act=="last"){
            $scope.pageNumber= $scope.nombreDesPages ;
            $scope.calldatabaseArt();
        }


    }





    $scope.initalizeFilter=function(callDB){

        /************NAA77II EL LOUN MTA3 EL ACTIVE***********/
        /*
        $scope.yearBtns=document.getElementsByClassName('year');


        for (by = 0; by < $scope.yearBtns.length; by++) {

            if($scope.yearBtns[by].classList.contains("active")){
                alert('na77it el active mel years');
                $scope.yearBtns[by].classList.remove("active");
            }

        }


        $scope.monthBtns=document.getElementsByClassName('month');


        for (bm = 0; bm < $scope.monthBtns.length; bm++) {

            if($scope.monthBtns[bm].classList.contains("active")){
                alert('na77it el active mel month');
                $scope.monthBtns[bm].classList.remove("active");
            }

        }*/

        /*
        $scope.dayBtns=document.getElementsByClassName('day');

        for (i = 0; i < $scope.dayBtns.length; i++) {
            //$scope.dayBtns[i].setAttribute("onclick", "sansNgClick()");

            if($scope.dayBtns[i].classList.contains("active")){
                $scope.dayBtns[i].classList.remove("active");
            }


        }*/

        $(datePickerDate1).datepicker('remove');

        $scope.dateSelected = $(datePickerDate1).datepicker("getDate");
        //$scope.NvDate = $scope.dateSelected.yyyymmdd();

        $scope.ArtOrVid="";
        $scope.vidOrArt=[];



        $scope.TtBtnsLangue=document.getElementsByName('langue');

        for (tb = 0; tb < $scope.TtBtnsLangue.length; tb++) {

            $scope.TtBtnsLangue[tb].checked=false;

        }


        $scope.TtBtnsTopic=document.getElementsByName('topic');

        for (tt = 0; tt < $scope.TtBtnsTopic.length; tt++) {
            $scope.TtBtnsTopic[tt].checked=false;
        }


        $scope.CalenderBtns=document.getElementsByTagName('td');

        for (i = 0; i < $scope.CalenderBtns.length; i++) {

            if($scope.CalenderBtns[i].classList.contains("active")){
                $scope.CalenderBtns[i].classList.remove("active");
                $scope.CalenderBtns[i].setAttribute("style", "background:transparent;");

            }


        }

        /************NA77III LOUN MTA3 EL ACTIVE***********/





        $scope.dateToFind=[];
        $scope.tpcToFind=[];
        $scope.vidOrArt=[];
        $scope.lngToFind=[];
        $scope.pageNumber= 1 ;
        if(callDB==true){
            $scope.calldatabaseArt();
        }

    }



    $scope.checkuncheck=function(id,quoi){

        var idCheck = quoi + id;

        if(quoi=="lng"){

            var checkCheck = document.getElementById(idCheck);
            var indexId = $scope.lngToFind.indexOf(id);

            if (indexId > -1) {
                $scope.lngToFind.splice(indexId, 1);
                checkCheck.checked=false;
            } else {
                $scope.lngToFind=[];
                $scope.lngToFind.push(id);
            }


        }



        if(quoi=="tp"){

            var checkChecktp = document.getElementById(idCheck);

            if (checkChecktp.checked) {
                $scope.tpcToFind.push(id);

            } else {
                var indexIdTP = $scope.tpcToFind.indexOf(id);
                if (indexIdTP > -1) {
                    $scope.tpcToFind.splice(indexIdTP, 1);
                }
            }

        }

        $scope.pageNumber= 1 ;
        $scope.calldatabaseArt();





    }



    $scope.nbrExcFnctPrepDate=0;
    $scope.preparerClickDate=function(){
        $scope.nbrExcFnctPrepDate++;

        if($scope.nbrExcFnctPrepDate<=1){

            //datepicker
            var aujourdhui = new Date();
            var mm = aujourdhui.getMonth() + 1; // getMonth() is zero-based
            var dd = aujourdhui.getDate();
            var aa = aujourdhui.getFullYear();

            var dateInitial=mm+"-"+dd+"-"+aa;


            //var init = moment().format("mm-dd-yyyy");
            //$('.datepicker').datepicker('update', init);

        }


        setTimeout(function(){
            /************NRIGEL EL LOUN MTA3 EL ACTIVE***********/

            $scope.yearBtns=document.getElementsByClassName('year');


            for (by = 0; by < $scope.yearBtns.length; by++) {

                if($scope.yearBtns[by].classList.contains("active")){

                    $scope.yearBtns[by].setAttribute("style", "background:rgb(205, 83, 43);");
                    $scope.yearBtns[by].setAttribute("class", "active");
                    //compile($scope.yearBtns[by]);
                }

            }


            $scope.monthBtns=document.getElementsByClassName('month');


            for (bm = 0; bm < $scope.monthBtns.length; bm++) {

                if($scope.monthBtns[bm].classList.contains("active")){

                    $scope.monthBtns[bm].setAttribute("style", "background:rgb(205, 83, 43);");
                    $scope.monthBtns[bm].setAttribute("class", "active");
                    //compile($scope.monthBtns[bm]);
                }

            }


            $scope.dayBtns=document.getElementsByClassName('day');

            for (i = 0; i < $scope.dayBtns.length; i++) {
                //$scope.dayBtns[i].setAttribute("onclick", "sansNgClick()");

                if($scope.dayBtns[i].classList.contains("active")){

                    $scope.dayBtns[i].setAttribute("style", "background:rgb(205, 83, 43);");
                    $scope.dayBtns[i].setAttribute("class", "active");
                    //compile($scope.dayBtns[i]);
                }


            }

            /************NRIGEL EL LOUN MTA3 EL ACTIVE***********/


            /**************kol mara ymess el datePicker el kol iverifi ken el date tbadlét , si oui yab3éth lel DataBase*********/

                $scope.dateSelected = $(datePickerDate1).datepicker("getDate");
                $scope.NvDate = $scope.dateSelected.yyyymmdd();




            if($scope.dateSelected.getTime() != $scope.ancienDate){

                if(isNaN($scope.dateSelected.getTime())){

                    $scope.ancienDate=0;
                }else {
                    $scope.ancienDate=$scope.dateSelected.getTime();
                }





                $scope.dateToFind=[];

                $scope.dateToFind.push($scope.dateSelected.yyyymmdd());
                if($scope.ancienDate!=0 || $scope.nbrExcFnctPrepDate<=1 ){
                    $scope.pageNumber= 1 ;
                    $scope.calldatabaseArt();
                }

                //console.log("nv"+$scope.dateSelected.getTime());
                //console.log("ancien"+$scope.ancienDate);

            }

            /**************kol mara ymess el datePicker el kol iverifi ken el date tbadlét , si oui yab3éth lel DataBase*********/



        }, 20);

    }



    $scope.changeArtOrVid=function(quoi){
        if(quoi=='article'){

            var indexIdVA = $scope.vidOrArt.indexOf("article");

            if (indexIdVA > -1) {
                $scope.ArtOrVid="";
                $scope.vidOrArt=[];
            } else {
                $scope.ArtOrVid="article";
                $scope.vidOrArt=[];
                $scope.vidOrArt.push("article");
            }

        }

        if(quoi=='video'){

            var indexIdAV = $scope.vidOrArt.indexOf("video");

            if (indexIdAV > -1) {
                $scope.ArtOrVid="";
                $scope.vidOrArt=[];
            } else {
                $scope.ArtOrVid="video";
                $scope.vidOrArt=[];
                $scope.vidOrArt.push("video");
            }



        }
        $scope.pageNumber= 1 ;
        $scope.calldatabaseArt();

    }


    /*

     var idCheck = quoi + id;

     if(quoi=="lng"){

     var checkCheck = document.getElementById(idCheck);
     var indexId = $scope.lngToFind.indexOf(id);

     if (indexId > -1) {
     $scope.lngToFind.splice(indexId, 1);
     checkCheck.checked=false;
     } else {
     $scope.lngToFind=[];
     $scope.lngToFind.push(id);
     }

     $scope.calldatabaseArt();
     }
    */

    /*************************TEST RECUPERATION DATE******************/



    /*************************TEST RECUPERATION DATE******************/




    $http.post(Routing.generate('filtreArticleJSON'))
        .then(function(response) {

            /*********PARTIE Langues*************/

            //console.dir(response.data);

            $.each(response.data["langues"], function (index, item) {


                $scope.langues.push({
                    id:item.id,
                    langue:item.langue
                });


            });

            /*********PARTIE Langues*************/




            /*********PARTIE TOPICS*************/

            //console.dir(response.data);

            $.each(response.data["topics"], function (index, item) {


                $scope.topics.push({
                    id:item.id,
                    topic:item.topic
                });


            });

            /*********PARTIE TOPICS*************/





            $scope.preparerClickDate();
            /*********FIN DU CHARGEMENT************/

            document.getElementById("chargementPage").style.display="none";
            document.getElementById("page").style.display="block";

            /*********FIN DU CHARGEMENT************/

        }).then(function(response) {



    });







});
