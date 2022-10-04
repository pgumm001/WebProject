<form method="POST" action="forgot_password_pin.php">
    <input type="text" name="pin">
     
    <input type="submit" name="enter_pin">
</form>

<?php
 
    session_start();
    include('config.php');
    
    if (isset($_POST["enter_pin"]))
    {
        $pin = $_POST["pin"];
        $user_id = $_SESSION["user"]->id;
 
         
        $sql = "SELECT * FROM USERS WHERE id = '$user_id' AND pin = '$pin'";
        $result = mysqli_query($conn, $sql);
 
        if (mysqli_num_rows($result) > 0)
        {
            $sql = "UPDATE USERS SET pin = '' WHERE id = '$user_id'";
            mysqli_query($conn, $sql);
 
            $_SESSION["user"]->is_verified = true;
            header("Location: reset_password.php");
        }
        else
        {
            echo "Wrong pin";
        }
    }
 
?>