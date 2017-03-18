$(document).ready(function(){

    
    //progressbar
    $( "#progressbar" ).progressbar({
      value: 37
    });
    $( "#progressbar" ).height(18);


           //scroll- inside
    $(".act-recent").mCustomScrollbar({
        theme:"rounded-dark",
        scrollbarPosition: "inside"
    });

           //scroll- inside
    $(".memberArea").mCustomScrollbar({
        theme:"rounded-dark",
        scrollbarPosition: "inside"
    });

    //slider-range2
    $("#slider-range2").slider({
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
     
     
           //raty
           $('.raty').raty({score:5});


    //lightbox
    lightbox.option({
      'alwaysShowNavOnTouchDevices':true
    })




    $('.fb-lb-g').click(function(e){
        e.preventDefault();
    });


    var html = $('#fbphotoboxContainer').html();
    //////////////////////////////////////////////////////////////////////////////////////////////////

    //facebook lightbox


    $("a.fb-lb-g").find('img').fbPhotoBox({
      rightWidth: 360,
      leftBgColor: "black",
      rightBgColor: "white",
      footerBgColor: "black",
      overlayBgColor: "#1D1D1D",
      onImageShow: function() {

        $('#fbphotoboxContainer').css('');

        $(".fbphotobox-image-content").html(html);

        $(".all-cmt").mCustomScrollbar({
            theme:"dark",
            scrollbarPosition: "inside"
        });

      },
      hide: function() {
        $('#fbphotoboxContainer').css('display','none');
      }
      
    });



  })
  