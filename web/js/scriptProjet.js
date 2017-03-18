$(document).ready(function(){

    //hide all right block
    $('.filterByRegion').slideToggle();
    $('.filter-weather').slideToggle();


    //the overlay
    /**/

    setTimeout(function(){
        $(".select2-container").on('click',function (e) {
            if (!$('#overlay').length) {
                $('body').append('<div id="overlay"> </div>')
            }

        });


    }, 1000);
    $('body').on('click', '#overlay',function (e) {
        $(this).remove();
    });

    //select2 for search on top of page
    function addIcons(opt) {
        if (!opt.id) {
            return opt.text;
        }
        var optimage = $(opt.element).data('image');
        if(!optimage){
            return opt.text;
        } else {
            var $opt = $(
                '<span class="userName"><img src="' + optimage + '" class="userPic" /> ' + $(opt.element).text() + '</span>'
            );
            return $opt;
        }
    };
    //right select
    $("#inputSearch").select2({
        minimumResultsForSearch: Infinity,
        placeholder: "recherche de recette...",
        tags: false,
        templateResult: addIcons,
        emplateSelection: addIcons
    });

    //the second select
    $("#inputProximite").select2({
        minimumResultsForSearch: Infinity,
        placeholder: "à proximité de",
    });

    //expand-contract side filters
    $('.menu-left-heading').on('click', '#expandContractFilter0', function(event) {
        event.preventDefault();
        /* Act on the event */
        var $content = $('#filterByNAT');
        $content.slideToggle(500, function () {
            return $content.is(":visible") ? $('#expandContractFilter0').css('background-image', "url(asset('/web/dist/img/contract-filter.png')") : $('#expandContractFilter0').css('background-image', "url(dist/img/expand-filters.png)");
        });
    });

    //expand-contract side filters
    $('.menu-left-heading').on('click', '#expandContractFilter1', function(event) {
        event.preventDefault();
        /* Act on the event */
        var $content = $('#filterByIngredient');
        $content.slideToggle(500, function () {
            return $content.is(":visible") ? $('#expandContractFilter1').css('background-image', "url(asset('dist/img/contract-filter.png')") : $('#expandContractFilter1').css('background-image', "url(dist/img/expand-filters.png)");
        });
    });

    //expand-contract side filters
    $('.menu-left-heading').on('click', '#expandContractFilter2', function(event) {
        event.preventDefault();
        /* Act on the event */
        var $content = $('#filterByTheme');
        $content.slideToggle(500, function () {
            return $content.is(":visible") ? $('#expandContractFilter2').css('background-image', "url(asset('dist/img/contract-filter.png')") : $('#expandContractFilter2').css('background-image', "url(dist/img/expand-filters.png)");
        });
    });

    //expand-contract side filters


    //expand-contract side filters
    $('.menu-left-heading').on('click', '#expandContractFilter3', function(event) {
        event.preventDefault();
        /* Act on the event */
        var $content = $('#filterByCuisson');
        $content.slideToggle(500, function () {
            return $content.is(":visible") ? $('#expandContractFilter3').css('background-image', "url(asset('dist/img/contract-filter.png')") : $('#expandContractFilter3').css('background-image', "url(dist/img/expand-filters.png)");
        });
    });

    //expand-contract side filters
    $('.menu-left-heading').on('click', '#expandContractFilter4', function(event) {
        event.preventDefault();
        /* Act on the event */
        var $content = $('#filterByMenu');
        $content.slideToggle(500, function () {
            return $content.is(":visible") ? $('#expandContractFilter4').css('background-image', "url(asset('dist/img/contract-filter.png')") : $('#expandContractFilter4').css('background-image', "url(dist/img/expand-filters.png)");
        });
    });

    //expand-contract side filters
    $('.menu-left-heading').on('click', '#expandContractFilter5', function(event) {
        event.preventDefault();
        /* Act on the event */
        var $content = $('#filterBySaisson');
        $content.slideToggle(500, function () {
            return $content.is(":visible") ? $('#expandContractFilter5').css('background-image', "url(asset('dist/img/contract-filter.png')") : $('#expandContractFilter5').css('background-image', "url(dist/img/expand-filters.png)");
        });
    });



    ///////////////////////////////////xx
    //expand-contract side filters
    $('.menu-left-heading').on('click', '#expandNationnality', function(event) {
        event.preventDefault();
        /* Act on the event */
        var $content = $('#filterBymethodxx');
        $content.slideToggle(500, function () {
            return $content.is(":visible") ? $('#expandNationnality').css('background-image', "url(asset('dist/img/contract-filter.png')") : $('#expandNationnality').css('background-image', "url(asset('dist/img/expand-filters.png')");
        });
    });




    //raty
    $('.raty').raty({score:5});
    //scrollbar
    $(window).load(function(){

        /*
         $(".all-items").mCustomScrollbar({
         theme:"dark-3"
         });
         */
        //region filter
        $(".filterByRegion").mCustomScrollbar({
            theme:"rounded-dark",
            scrollbarPosition: "outside"
        });
        //slider

        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 100,
            values: [ 0, 100 ],
            slide: function (event, ui) {
                var value1 = $("#slider-range").slider("values", 0);
                var value2 = $("#slider-range").slider("values", 1);
                $("#rangeMin").text(value1);
                $("#rangeMax").text(value2);
            }
        });





    });

    //ichack
    $('input').iCheck({
        checkboxClass: 'icheckbox_minimal-grey',
        radioClass: 'iradio_minimal-grey'
    });


})