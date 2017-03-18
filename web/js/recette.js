
var Recette =function () {


    $.ajax({

        url: Routing.generate('recetteJSON'),
        type: 'POST',
        dataType: 'JSON',
        success: function(result) {
        
            recette = "";
            $.each(result, function (index, item) {

                recette += "<img src='" +item.image+ "'>";
                
                

            });
            $('.recette').append(recette);
        }
    });
};


Recette();
//setInterval(Recette,2000);
