<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // echo "hiiii";
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
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass_word = $_POST['password'];
    $enc_password= password_hash($pass_word, PASSWORD_DEFAULT);
    //******************************************************************************************************* */
    if ($result->num_rows > 0) {
        // echo "Table '$tableName' exists in the database.";
        $sql = "SELECT username FROM ".$tableName." WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);// s for string
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo "Username exists in the database, login instead";
            $stmt->close();
            $conn->close();
            die;
        }
        $sql = "SELECT username FROM ".$tableName." WHERE email = ?";
        // $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);// s for string
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo "Same Email exists in the database, login instead";
            $stmt->close();
            $conn->close();
            die;
        }
        $stmt->close();
    } 
    else 
    {
        // echo "Table '$tableName' does not exist in the database.";
        // die;
        
        $sql = "CREATE TABLE  ".$tableName." (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        email VARCHAR(50) NOT NULL,
        password VARCHAR(255) NOT NULL
        )";
        if ($conn->query($sql) === TRUE){
            // echo "Table 'users' created successfully";
        } 
        else 
        {
            echo "Error creating table: " . $conn->error;
            $conn->close();
            die;
        }
    }
    // $sql = "INSERT INTO ".$tableName." (username, email, password) VALUES (".$username.",".$email.",".$enc_password.")";
    $sql = "INSERT INTO ".$tableName." (username, email, password) VALUES ('$username', '$email', '$enc_password')";
    if ($conn->query($sql) === TRUE) {
        echo "New record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    //******************************************************************************************************* */
    $conn->close();

}
?>
