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
            <span class="navbar-brand mb-0 h2" style="font-weight: bold;color: white;">Figure Annotation Task</span>
            <div style="float:right;">
                <a href="login.php" style=" background-color: #061162; color: white; border:none" class="btn btn-primary">Login</a> 
                <!-- <button type="button" class="btn btn-primary" style="float:right ; background-color: #061162; color: white; border:none" onclick="logout()">Logout</button> --> 
            </div>
        </div>
    </nav><br>
    <br>
    <br>
    <br><br><br>
    <form method="POST" action="enter-pin.php">
    <label for="exampleInputPassword1" style="margin-left:20%">Enter your OTP sent to your registered mobile number</label>
    <input type="number" class="form-control" style=" width: 70%;margin-left:20%;"  name="pin">
     
    <button type="submit"  style="margin-left:20%" name="enter_pin">Submit</button>
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
            header("Location: index.php");
        }
        else
        {
            echo "Wrong pin";
        }
    }
 
?>