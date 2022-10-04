
<form method="POST" action="register.php">
    <input type ="text" name = "fname">
    <input type="text" name ="lname">
    <input type="email" name="email" placeholder="test">
    <input type="password" name="password">
    <input type="text" name="phone">
     
    <input type="submit" name="register">
</form>

<?php
   ini_set('display_errors', '1');
   ini_set('display_startup_errors', '1');
   error_reporting(E_ALL); 
    include('config.php');
    if (isset($_POST["register"]))
    {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $password = $_POST["password"];
        $password = password_hash($password, PASSWORD_DEFAULT);
 
        // $conn = mysqli_connect("handson-test.chwcqpod3cc6.us-east-2.rds.amazonaws.com", "handson", "handsonhandson", "WebTest");
        
            $sql = "select count(email) from USERS where email='$email'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_row($result);
            // echo $row[0];
            if($row[0]>0)
            {
                echo "email already inserted";
            }
            else
            {
                $sql = "INSERT INTO USERS (email, phone, password, is_tfa_enabled, pin,first_name,last_name,approved) VALUES ('$email', '$phone', '$password', 0, '','$fname','$lname',0)";
                echo "Thank you for Submitting. You will be able to login once the Admin approves your registration";
                echo "<a href='login.php'>Back to Login</a>";
            }
        
       
        // if(mysqli_num_rows($res) > 0){
        //     echo "email already exists . Please Login or register using a different email";
           
        // }
        // else {
        //     $sql = "INSERT INTO USERS (email, phone, password, is_tfa_enabled, pin,first_name,last_name,approved) VALUES ('$email', '$phone', '$password', 0, '','$fname','$lname',0)";
        //     $res = mysqli_query($conn, $sql);

        // header("Location: login.php");
        // // echo $res;
        // }
        
 
    }
 
?>