


$(function(){
    $.ajax({
        url: Routing.generate('recetteJSON'),
        type: 'POST',
        dataType: 'JSON',
        success: function(result) {



            $.each(result, function (index, item) {

                //var contentString ="";
                var content = '<div id="iw-container">' +
                    '<div class="iw-title">'+item.titre+'</div>' +
                    '<div class="iw-content">' +
                    '<div class="iw-subTitle">History</div>' +
                    '<img src=' +item.image+ ' class="image">' +
                    '<p>Founded in 1824, the Porcelain Factory of Vista Alegre was the first industrial unit dedicated to porcelain production in Portugal. For the foundation and success of this risky industrial development was crucial the spirit of persistence of its founder, José Ferreira Pinto Basto. Leading figure in Portuguese society of the nineteenth century farm owner, daring dealer, wisely incorporated the liberal ideas of the century, having become "the first example of free enterprise" in Portugal.</p>' +
                    '<div class="iw-subTitle">Contacts</div>' +
                    '<p>VISTA ALEGRE ATLANTIS, SA<br>3830-292 Ílhavo - Portugal<br>'+
                    '<br>Phone. +351 234 320 600<br>e-mail: geral@vaa.pt<br>www: www.myvistaalegre.com</p>'+
                    '</div>' +
                    '<div class="iw-bottom-gradient"></div>' +
                    '</div>';

                var latLng = new google.maps.LatLng(item.lat, item.long);
                // Creating a marker and putting it on the map
                
                var marker = new google.maps.Marker({
                    position: latLng,
                    title: item.titre,
                    animation: google.maps.Animation.DROP
                });


                marker.setMap(map);

                var infowindow = new google.maps.InfoWindow({
                    content: content,
                    maxWidth: 350
                });

                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map,marker);
                });

                google.maps.event.addListener(map, 'click', function() {
                    infowindow.close();
                });

                google.maps.event.addListener(infowindow, 'domready', function() {

                    // Reference to the DIV that wraps the bottom of infowindow
                    var iwOuter = $('.gm-style-iw');

                    /* Since this div is in a position prior to .gm-div style-iw.
                     * We use jQuery and create a iwBackground variable,
                     * and took advantage of the existing reference .gm-style-iw for the previous div with .prev().
                     */
                    var iwBackground = iwOuter.prev();

                    // Removes background shadow DIV
                    iwBackground.children(':nth-child(2)').css({'display' : 'none'});

                    // Removes white background DIV
                    iwBackground.children(':nth-child(4)').css({'display' : 'none'});

                    // Moves the infowindow 115px to the right.
                    iwOuter.parent().parent().css({left: '115px'});

                    // Moves the shadow of the arrow 76px to the left margin.
                    iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

                    // Moves the arrow 76px to the left margin.
                    iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

                    // Changes the desired tail shadow color.
                    iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});

                    // Reference to the div that groups the close button elements.
                    var iwCloseBtn = iwOuter.next();

                    // Apply the desired effect to the close button
                    iwCloseBtn.css({opacity: '1', right: '38px', top: '3px', border: '7px solid #48b5e9', 'border-radius': '13px', 'box-shadow': '0 0 5px #3990B9'});

                    // If the content of infowindow not exceed the set maximum height, then the gradient is removed.
                    if($('.iw-content').height() < 140){
                        $('.iw-bottom-gradient').css({display: 'none'});
                    }

                    // The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
                    iwCloseBtn.mouseout(function(){
                        $(this).css({opacity: '1'});
                    });
                });

            });

        }
    });
});

