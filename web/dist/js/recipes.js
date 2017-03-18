         $(document).ready(function(){
         
           //hide all right block
           $('.filterByinside').slideToggle();
           $('.filter-weather').slideToggle();
         
  
         
           //expand-contract side filters
           $('.menu-left-heading').on('click', '#expandContractFilter0', function(event) {
             event.preventDefault();
             /* Act on the event */
             var $content = $('#filterByNAT');
             $content.slideToggle(500, function () {
                 return $content.is(":visible") ? $('#expandContractFilter0').css('background-image', "url(dist/img/contract-filter.png)") : $('#expandContractFilter0').css('background-image', "url(dist/img/expand-filters.png)");
             });
           });

           
          //expand-contract side filters
           $('.menu-left-heading').on('click', '#expandContractFilter', function(event) {
             event.preventDefault();
             /* Act on the event */
             var $content = $('#filterByMore');
             $content.slideToggle(500, function () {
                 return $content.is(":visible") ? $('#expandContractFilter').css('background-image', "url(dist/img/contract-filter.png)") : $('#expandContractFilter').css('background-image', "url(dist/img/expand-filters.png)");
             });
           });

           //expand-contract side filters
           $('.menu-left-heading').on('click', '#expandContractFilter1', function(event) {
             event.preventDefault();
             /* Act on the event */
             var $content = $('#filterByIngredient');
             $content.slideToggle(500, function () {
                 return $content.is(":visible") ? $('#expandContractFilter1').css('background-image', "url(dist/img/contract-filter.png)") : $('#expandContractFilter1').css('background-image', "url(dist/img/expand-filters.png)");
             });
           });
         
           //expand-contract side filters
           $('.menu-left-heading').on('click', '#expandContractFilter2', function(event) {
             event.preventDefault();
             /* Act on the event */
             var $content = $('#filterByTheme');
             $content.slideToggle(500, function () {
                 return $content.is(":visible") ? $('#expandContractFilter2').css('background-image', "url(dist/img/contract-filter.png)") : $('#expandContractFilter2').css('background-image', "url(dist/img/expand-filters.png)");
             });
           });
         
             //expand-contract side filters
         
         
           //expand-contract side filters
           $('.menu-left-heading').on('click', '#expandContractFilter3', function(event) {
             event.preventDefault();
             /* Act on the event */
             var $content = $('#filterByCuisson');
             $content.slideToggle(500, function () {
                 return $content.is(":visible") ? $('#expandContractFilter3').css('background-image', "url(dist/img/contract-filter.png)") : $('#expandContractFilter3').css('background-image', "url(dist/img/expand-filters.png)");
             });
           });
         
           //expand-contract side filters
           $('.menu-left-heading').on('click', '#expandContractFilter4', function(event) {
             event.preventDefault();
             /* Act on the event */
             var $content = $('#filterByMenu');
             $content.slideToggle(500, function () {
                 return $content.is(":visible") ? $('#expandContractFilter4').css('background-image', "url(dist/img/contract-filter.png)") : $('#expandContractFilter4').css('background-image', "url(dist/img/expand-filters.png)");
             });
           });
         
           //expand-contract side filters
           $('.menu-left-heading').on('click', '#expandContractFilter5', function(event) {
             event.preventDefault();
             /* Act on the event */
             var $content = $('#filterBySaisson');
             $content.slideToggle(500, function () {
                 return $content.is(":visible") ? $('#expandContractFilter5').css('background-image', "url(dist/img/contract-filter.png)") : $('#expandContractFilter5').css('background-image', "url(dist/img/expand-filters.png)");
             });
           });
         
         
         
           ///////////////////////////////////xx
           //expand-contract side filters
           $('.menu-left-heading').on('click', '#expandNationnality', function(event) {
             event.preventDefault();
             /* Act on the event */
             var $content = $('#filterBymethodxx');
             $content.slideToggle(500, function () {
                 return $content.is(":visible") ? $('#expandNationnality').css('background-image', "url(dist/img/contract-filter.png)") : $('#expandNationnality').css('background-image', "url(dist/img/expand-filters.png)");
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
               $(".filterByinside").mCustomScrollbar({
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
         
          /* //icheck
            $('input').iCheck({
               checkboxClass: 'icheckbox_minimal-grey',
               radioClass: 'iradio_minimal-grey'
           });*/


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
/*
 function fixDiv() {
          var $cache = $('.recipes');
          if ($(window).scrollTop() > 500)
            $cache.css({
              'position': 'fixed',
              'top': '0px'
            });
          else
            $cache.css({
              'position': 'relative',
              'top': 'auto'
            });
        }
        $(window).scroll(fixDiv);
        fixDiv();
  */


         
         
 })
         
      