<form method="POST" action="login.php" >
    <input type="email" name="email">
    <input type="password" name="password">
     
    <input type="submit" name="login">
    <br>
    <a href="forgot_password.php">Forgot Password? Reset Here</a>
    <br>
    <a href="register.php">New User? Register Here</a>
</form>

<?php
    
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL); 
    session_start();
    include('config.php');
    require_once "vendor/autoload.php";
    use Twilio\Rest\Client;
   
 
   $conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
  



    $sid = "AC7f7fa9bd5fe0c3b2169498125b4fcb0f";
    $token = "de90f868b0db91de6298536c79d91ba8";
 
    if (isset($_POST["login"]))
    {
        
        $email = $_POST["email"];
        $password = $_POST["password"];
 
   
         
        $sql = "SELECT * FROM USERS WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        
       
        if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_object($result);
            if($row->approved==1){
                if (password_verify($password, $row->password))
                {
                    if($row->isadmin == 1){
                        $row->is_verified = true;
                        $_SESSION["user"] = $row;

                        header("Location: admin.php");
                    }
                    else
                    {
                        if ($row->is_tfa_enabled)
                        {
                            $row->is_verified = false;
                            $_SESSION["user"] = $row;
        
                            $pin = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
                            
                            $sql = "UPDATE USERS SET pin = '$pin'  WHERE id = '" . $row->id . "'";
                            mysqli_query($conn, $sql);
        
                            $client = new Client($sid, $token);
                            $client->messages->create(
                                $row->phone, array(
                                    "from" => "+18104420122",
                                    "body" => "Your fkn 2-factor authentication code is: ". $pin
                                )
                            );
        
                            header("Location: enter-pin.php");
                        }
                        else
                        {
                            $row->is_verified = true;
                            $_SESSION["user"] = $row;
        
                            header("Location: index.php");
                        }

                    }
                    
                }
                else
                {
                    echo "Wrong password";
                }
            }
            else
            {
                echo "Please wait for the admin to approve your account";
                
            }

        }
        else
        {
            echo "Not exists";    
        }
           
    }
 
?> 