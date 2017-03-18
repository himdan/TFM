
var Notification =function () {


    $.ajax({
        url: Routing.generate('notificationSignal'),

        dataType: 'JSON',
        success:function(result){
            if(localStorage.getItem("nbr") == null){
                localStorage.setItem("nbr", result);
            }else{
                var nbr = localStorage.getItem("nbr");
                if(result == nbr){
                    $('#nbrnotification').html(result);

                }else{
                    toastr.success('Nouveau Signal');
                    $.playSound("http://www.soundjay.com/misc/sounds/small-bell-ringing-01");
                    $('#nbrnotification').html(result);
                    localStorage.setItem("nbr", result);
                }
            }




        }
    });
};



setInterval(Notification,2000);
