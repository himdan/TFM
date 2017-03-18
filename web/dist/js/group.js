$(document).ready(function(){
   //hide all right block
           $('.filterByPlus').slideToggle();

    //scrollbar
    $(window).load(function(){

        /*
        $(".all-items").mCustomScrollbar({
            theme:"dark-3"
        });
        */

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

   //hide all right block
           $('#filterBygroup').slideToggle();
           
 //expand-contract side filters
           $('.menu-left-heading').on('click', '#expandContractFilter', function(event) {
             event.preventDefault();
             /* Act on the event */
             var $content = $('#filterByPlus');
             $content.slideToggle(500, function () {
                 return $content.is(":visible") ? $('#expandContractFilter').css('background-image', "url(dist/img/contract-filter.png)") : $('#expandContractFilter').css('background-image', "url(dist/img/expand-filters.png)");
             });
           });


    //ichack
    /* $('input').iCheck({
        checkboxClass: 'icheckbox_minimal-grey',
        radioClass: 'iradio_minimal-grey'
    });*/


  })

  $('.button-checkbox').each(function () {

        // Settings
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            color = $button.data('color'),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };

        // Event Handlers
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $button.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$button.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $button
                    .removeClass('btn-default')
                    .addClass('btn-' + color + ' active');
            }
            else {
                $button
                    .removeClass('btn-' + color + ' active')
                    .addClass('btn-default');
            }
        }

          // Initialization
        function init() {

            updateDisplay();

            // Inject the icon if applicable
            if ($button.find('.state-icon').length == 0) {
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
            }
        }
        init();
    });


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
  