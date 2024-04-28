$(document).ready(function(){
    // alert("cought")
    $('#reg').submit(function(event){
        event.preventDefault();
        // alert("cought222222222");
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '/fresh/php/connect2.php',
            data: formData,
            success: function(response){
                $('#responselog').html(response);
                // if(response=="success"){
                //     response="";
                //     window.location.href = "/fresh/views/home.html";
                // }
            }
        });
    });
});
