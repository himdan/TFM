
  $(document).ready(function () {
    //show
     




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

  /*  //ichack
     $('input').iCheck({
        checkboxClass: 'icheckbox_minimal-grey',
        radioClass: 'iradio_minimal-grey'
    });*/


  })


  //google map
  function initMap() {
    var map = new google.maps.Map(document.getElementById('map-responsive'), {
      zoom: 12,
      center: {lat: 35.8293242, lng: 10.5504132},
      disableDefaultUI: true,
      width:818,
      height : 378
    });
    var point = new google.maps.LatLng(35.8236,10.5583);
    var marker = new google.maps.Marker({
      position:point,
      map:map,
      icon:'dist/img/maps.png'
    });
  }