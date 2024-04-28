<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    session_start();
    $_SESSION = [];
    session_destroy();
    echo    '<script type="text/JavaScript">  
                    window.location.href = "/fresh/views/login.html";
            </script>';
    die;
}
?>
