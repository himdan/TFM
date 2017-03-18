/**
 * Created by lotfidev on 18/06/16.
 */
$(document).ready(function(){

    // skrollr
    var s = skrollr.init({
        // render: function(data) {
        //     $('#offset').text(data.curTop);
        // },
        forceHeight:false
    });

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
        placeholder: "Exemple : restaurant, café, recette...",
        tags: false,
        templateResult: addIcons,
        emplateSelection: addIcons
    });

    //the second select
    $("#inputProximite").select2({
        minimumResultsForSearch: Infinity,
        placeholder: "à proximité de",
    });

    //raty
    $('.raty').raty({score:5});


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


    //ichack
    $('input').iCheck({
        checkboxClass: 'icheckbox_minimal-grey',
        radioClass: 'iradio_minimal-grey'
    });

})