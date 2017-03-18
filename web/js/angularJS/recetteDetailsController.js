/**
 * Created by lotfidev on 18/06/16.
 */


var appDetails = angular.module('myAppDetails',[])
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




appDetails.controller('recetteDetailsController', function($scope,$http) {


    var testAime = function(){

    };

    testAime();





    $scope.aime = function(id){

        $scope.loading = true;
        $http.post(Routing.generate('Addappreciation', { id: id , type: "recette" }))
            .then(function(response) {
                console.log(response.data);
            });

    };

    $scope.aimepas = function(id){

        $scope.loading = true;
        $http.post(Routing.generate('deleteappreciation', { id: id , type: "recette" }))
            .then(function(response) {
                console.log(response.data);
            });

    };












});
