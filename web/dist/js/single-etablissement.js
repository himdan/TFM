$(document).ready(function(){

     $("#owl-demo").owlCarousel({

      autoPlay: 3000, //Set AutoPlay to 3 seconds
      navigation : true, // Show next and prev buttons
      items : 4,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3]

  });

    //carte prix modal
    /**/

     $("a.grouped_cartes").fancybox({

        padding: 0,
              helpers: {
                overlay: {
                  locked: false
                }
              }


            });


     //photos gallery
    /**/

    $("a.grouped_elements").fancybox({
     padding: 0,
              helpers: {
                overlay: {
                  locked: false
                }
              }


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


 /*   //ichack
     $('input').iCheck({
        checkboxClass: 'icheckbox_minimal-grey',
        radioClass: 'iradio_minimal-grey'
    });*/

  })



  //google map

