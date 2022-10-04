<form method="POST"  >
    <div id="email">
        <input type="email" name="email">
    
        <input type="submit" name="forgot" placeholder="Submit">
    </div>
    
   
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
 
    if (isset($_POST["forgot"]))
    {
        
        $email = $_POST["email"];
       
         
        $sql = "SELECT * FROM USERS WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        
       
        if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_object($result);

            
            if($row->approved==1)
            {
                $_SESSION["user"] = $row;
        
                            $pin = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
                            
                            $sql = "UPDATE USERS SET pin = '$pin'  WHERE id = '" . $row->id . "'";
                            mysqli_query($conn, $sql);
        
                            // $client = new Client($sid, $token);
                            // $client->messages->create(
                            //     $row->phone, array(
                            //         "from" => "+18104420122",
                            //         "body" => "Your fkn 2-factor authentication code is: ". $pin
                            //     )
                            // );
                            
                            header("Location: forgot_password_pin.php");
            }
        }
        else
        {
            echo "Not exists";    
        }
           
    }
 
?> 





