
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
        color: #061162;
        font-family: monospace;
        font-size: 25px;
        text-align: left;
        }
        th {
        background-color: #061162;
        color: white;
        }
        tr:nth-child(even) {background-color: #f2f2f2}
        .dataTable{
            margin-top:5vh;
            padding:5vh;

        }
        button{
            background:#061162;
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

    <nav class="navbar fixed-top navbar-light " style="background-color: #061162;">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h2" style="font-weight: bold;color: white;">Milestone 1</span>
            <div style="float:right;">
                <a href="login.php" style=" background-color: #061162; color: white; border:none" class="btn btn-primary">Login</a> 
                <!-- <button type="button" class="btn btn-primary" style="float:right ; background-color: #061162; color: white; border:none" onclick="logout()">Logout</button> --> 
            </div>
        </div>
    </nav><br>
    <br>
    <br>
    <br><br><br>
    <form method="POST" action="register.php" style="justify-content: center;display: flex;">
        <div id="formDiv" style=" width: 70%;">
        <label for="exampleInputPassword1">First Name</label>
        <input type ="text" class="form-control" name = "fname">
        <label for="exampleInputPassword1">Last Name</label>
        <input type="text" class="form-control" name ="lname">
        <label for="exampleInputPassword1">Email</label>
        <input type="email" class="form-control" name="email" >
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" name="password">
        <label for="exampleInputPassword1">Phone Number</label>
        <input type="text" class="form-control" name="phone">
        
        <button type="submit" name="register">Rregister</button>
        </div>
    </form>
        </body>
        </html
<?php
   ini_set('display_errors', '1');
   ini_set('display_startup_errors', '1');
   error_reporting(E_ALL); 
    include('config.php');
    
    if (isset($_POST["register"]))
    {
        echo "inside php";
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
                // echo '<script>alert("Email Already exists")</script>';
                echo '<script language="javascript">';
                echo 'alert("Email already Exists")';
                echo '</script>';
            }
            else
            {
                $sql = "INSERT INTO USERS (email, phone, password, is_tfa_enabled, pin,first_name,last_name,approved) VALUES ('$email', '$phone', '$password', 0, '','$fname','$lname',0)";
                $result = mysqli_query($conn,$sql);
                echo '<script language="javascript">';
                echo 'Please Go Back to Login';
                echo "Thank you for Submitting. You will be able to login once the Admin approves your registration";
                echo '</script>';
                // echo "Please Go Back to Login";
                // echo "Thank you for Submitting. You will be able to login once the Admin approves your registration";
            }
        
 
    }
 
?>