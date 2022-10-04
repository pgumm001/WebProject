<!DOCTYPE html>
<html>
<title>Home Page</title>
<head>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Style the list */
        
        h2{
            color: #17098f;
        }
        ul.tab {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }
       /* Style the links inside the list items */
        body{
          
        }
        
        ul.tab li {
            float: left;
        }
        /* Style the links inside the list items */
        
        ul.tab li a {
            display: inline-block;
            color: black;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            transition: 0.3s;
            font-size: 17px;
        }
        /* Change background color of links on hover */
        
        ul.tab li a:hover {
            background-color: #ddd;
        }
        /* Create an active/current tablink class */
        
        ul.tab li a:focus,
        .active {
            background-color: #ccc;
        }
        /* Style the tab content */
        
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
        .form{
            margin:1vh;
            padding:1vh;
        }
        .form-control{
            margin:1vh;
            width:200;
        }
        table {
        border-collapse: collapse;
        width: 100%;
        color: #4c66e0;
        font-family: monospace;
        font-size: 25px;
        text-align: left;
        }
        th {
        background-color: #4c66e0;
        color: white;
        }
        tr:nth-child(even) {background-color: #f2f2f2}
        .dataTable{
            margin-top:5vh;
            padding:5vh;

        }
        button{
            background:#4c66e0;
            border:none;
            padding:1vh;
            margin:1vh;
            color:white;
            font-weight:bold;
        }
        input{
            margin:5vh;
        }
        
                    
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <script>
        function logout(){
                window.location.href="login.php"
            }
      
    </script>

    <nav class="navbar fixed-top navbar-light " style="background-color: #4155e7;">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h2" style="font-weight: bold;color: white;">Milestone 1</span>
            <div style="float:right;">
                <a href="login.php" style=" background-color: #4155e7; color: white; border:none" class="btn btn-primary">Login</a> 
                <!-- <button type="button" class="btn btn-primary" style="float:right ; background-color: #4155e7; color: white; border:none" onclick="logout()">Logout</button> --> 
            </div>
        </div>
    </nav><br>
    <br>
    <br>
    <br><br><br>
    <form method="POST"  >
    <div id="email">
    <label for="exampleInputPassword1" style="margin-left:20%">Enter your Email</label>
        <input class="form-control" style=" width: 70%;margin-left:20%;" type="email" name="email">
    
        <button type="submit" name="forgot" style="margin-left:20%" placeholder="Submit">Submit</button>
    </div>
    
   
</form>
        </body>
        </html>

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
    $token = "9a4966c37c0375a3ce3cf5f5f92d9c37";
 
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
        
                            $client = new Client($sid, $token);
                            $client->messages->create(
                                $row->phone, array(
                                    "from" => "+18104420122",
                                    "body" => "Your  2-factor authentication code is: ". $pin
                                )
                            );
                            
                            header("Location: forgot_password_pin.php");
            }
        }
        else
        {
            echo "Not exists";    
        }
           
    }
 
?> 





