<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $servername = "localhost"; 
    $root = "root"; 
    $root_password = "ASDFGHJKL"; 
    $database = "php_test"; 
    
    $conn = new mysqli($servername, $root, $root_password, $database);
    if ($conn->connect_error) {
        $conn->close();
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Table name to check
    $tableName = "php_employee"; 
    
    $sql = "SHOW TABLES LIKE '$tableName'";
    $result = $conn->query($sql);
    //******************************************************************************************************* */
    //frontend data fetch
    // $username = $_POST['username'];
    $email = $_POST['email'];
    $pass_word = $_POST['password'];
    // $enc_password= password_hash($pass_word, PASSWORD_DEFAULT);//no need here
    //******************************************************************************************************* */
    if ($result->num_rows > 0) {
        $sql = "SELECT password FROM ".$tableName." WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        
        if ($result->num_rows > 0) {

            // User found, authentication successful
            // echo "login successfull";
            $user=$result->fetch_assoc();

            if(password_verify($pass_word,$user["password"])){
                $conn->close();
                session_start();
                $_SESSION["session"] = "active";
                // echo "success";
                echo    '<script type="text/JavaScript">  
                                window.location.href = "/fresh/views/home.php";
                        </script>';
                die;
                // header("Location: home.html");
                // exit();
            }else {
                
                echo "Invalid password.";
            }
        } else {
            // No user found with the given email and password, authentication failed
            echo "Invalid email or password.";
        }
        // $conn->close();
        // die;
    } 
    else 
    {
        echo "No record found";
    }
    $conn->close();

}
?>
