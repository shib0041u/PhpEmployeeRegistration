$(document).ready(function(){
    $('#registrationForm').submit(function(event){
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '/fresh/php/connect.php',
            data: formData,
            success: function(response){
                $('#response').html(response);
            }
        });
    });
});
