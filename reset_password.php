<form method="POST" >
    <input type="password" name="pin"><br>
    <input type ="password" name="retype">
     
    <input type="submit" name="enter_pin">
</form>

<?php
     ini_set('display_errors', '1');
     ini_set('display_startup_errors', '1');
     error_reporting(E_ALL); 
     
    session_start();
    include('config.php');
    
    if (isset($_POST["enter_pin"]))
    {
        $password = $_POST["pin"];
        $retype = $_POST["retype"];
        $user_id = $_SESSION["user"]->id;
        $password = password_hash($password, PASSWORD_DEFAULT);
 
         
        $sql = "Update USERS set password = '$password' WHERE id = '$user_id' ";
        $result = mysqli_query($conn, $sql);
        $sql = "UPDATE USERS SET pin = '' WHERE id = '$user_id'";
        mysqli_query($conn, $sql);
 
        $_SESSION["user"]->is_verified = true;
        header("Location: login.php");
        
        
    }
 
?> 