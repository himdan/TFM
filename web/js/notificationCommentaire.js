
var NotificationCommentaire =function () {


    $.ajax({
        url: Routing.generate('notificationCommentaire'),

        dataType: 'JSON',
        success:function(result){
            if(localStorage.getItem("nbrCommentaire") == null){
                localStorage.setItem("nbrCommentaire", result);
            }else{
                var nbr = localStorage.getItem("nbrCommentaire");
                if(result == nbr){
                    $('#nbrnotificationCommentaire').html(result);

                }else{
                    toastr.success('Nouveau commentaire');
                    $.playSound("http://www.soundjay.com/mechanical/sounds/clong-1");
                    $('#nbrnotificationCommentaire').html(result);
                    localStorage.setItem("nbrCommentaire", result);
                }
            }




        }
    });
};



setInterval(NotificationCommentaire,2000);
