<?php
//  echo"inside delete"
    // header('Content-Type: application/json');
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL); 
    include('config.php');
     $id = $_POST['id'];
     echo ($id);
     echo "inside approve";
    $conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
    $sql = "update USERS set approved = 1 where id =$id";
    $result = mysqli_query($conn, $sql);

    
?>