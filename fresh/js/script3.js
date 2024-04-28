$(document).ready(function(){
    $('#logout').submit(function(event){
        // event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '/fresh/php/connect3.php',
            data: formData,
            success: function(response){
                //no response required, don't know how it will work if i remove callback function
            }
        });
    });
});