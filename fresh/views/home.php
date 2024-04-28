<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="/fresh/js/script3.js"></script>
</head>
<body>
    <!-- <script>
        alert("reached")
    </script> -->
<?php
    // Start the PHP session
    session_start();
    
    // Check if the session variable is set
    if(!isset($_SESSION['session'])) {
        //valid login
        echo    '<script type="text/JavaScript">  
                    window.location.href = "/fresh/views/login.html";
            </script>';
    } 
    ?>
    <h1>Welcome to the Home Page</h1>
    <form id="logout">
    <button type="submit">Logout</button>

    </form>
    
</body>
</html>