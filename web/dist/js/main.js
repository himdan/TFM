$(document).ready(function() {


      $(function(){
    $(".dropdown-r").hover(            
            function() {
                $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");                
            },
            function() {
                $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");                
            });
    });

	$(document).scroll(function() {

      //Ratting simple
      $('.star1').starrr();
    
	  if ($(document).scrollTop() >= 150) {
	    $('#topcontrol').show();
	  } else {
	    $('#topcontrol').hide();
	  }
	});

    $("#topcontrol").click(function (){
        $('html, body').animate({
            scrollTop: $('html, body').offset().top
        }, 1000);
        return false;
    });


    
    //expand-contract side filters
    $('.menu-left-heading').on('click', '#expandNationnality', function(event) {
        event.preventDefault();
        /* Act on the event */
        var $content = $('#filterByNationnality');
        $content.slideToggle(500, function () {
            return $content.is(":visible") ? $('#expandNationnality').css('background-image', "url(../../dist/img/contract-filter.png)") : $('#expandNationnality').css('background-image', "url(../../dist/img/expand-filters.png)");
        });
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
      placeholder: "exemple : restaurant, café, recette...",
      tags: false,
      templateResult: addIcons,
      emplateSelection: addIcons
    });

    //the second select
    $("#inputProximite").select2({
      minimumResultsForSearch: Infinity,
      placeholder: "à proximité de",
    });

});


