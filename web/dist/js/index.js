
  $(document).ready(function(){

    
    //nextSecondHalf
    /*
    $('.modal-content').on('click', '#nextSecondHalf' , function(e){
      e.preventDefault();
      //$('#oneHalfForm').hide();
      //$('#secondHalfForm').show();

      //$("#oneHalfForm").css("display", "none");
      //$("#secondHalfForm").css("display", "block");
    } );
    */

     $('#nextSecondHalf').click(function(){
      $(this).closest('section').hide().next('section').show();//openInscrit
      //$(this).next('section').show();
      //$("#secondHalfForm").css("display", "block");
    })

    // birthday
    $('#inputBirth').datepicker();

   /* //ichack
     $('input').iCheck({
        checkboxClass: 'icheckbox_minimal-grey',
        radioClass: 'iradio_minimal-grey'
    });*/

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
    //raty
    $('.raty').raty({score:5});

    //region filter//.the_res_search
    $(".act-recent").mCustomScrollbar({
        theme:"rounded-dark",
        scrollbarPosition: "inside"
    });

    /*open Inscrit modal*/
    $('#openInscrit').on('click',function(event) {

      event.preventDefault();

      $('#titleModal').text('Connexion');

      //
      
        $("section.oneHalfForm").show();
        $("section.secondHalfForm").hide();
      
      


      //open inscrit modal

      var titleModal = $('#titleModal');
      console.log(titleModal);
      
      var $inscri_modal = $('#inscription-modal');
      $inscri_modal.css({
        display: 'none'
      });
      //open connection modal
      var $cx_modal = $('#cx-modal-open');
      $cx_modal.css({
        display: 'block'
      });

      
    });



  
    /*open Connexion modal*/
    $('#openConnexion').on('click',function(event) {

      /* Act on the event */
      event.preventDefault();

      // $("#secondHalfForm").hide();
      // console.log('hihi');


      $('#titleModal').text('Inscription');

      
      //open connection modal

      $('.checkboxx').css({
        'color':'#828282'
      });

      var titleModal = $('#titleModal');
      //console.log(titleModal);
      
      var cx_modal = $('#cx-modal-open');
      cx_modal.css({
        display: 'none'
      });
      //open inscrit modal
      var inscri_modal = $('#inscription-modal');
      inscri_modal.css({
        display: 'block'
      });

      
      
    });



  })
  