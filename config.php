<?php
   // Database configuration    
//    $hostname = "localhost"; 
//    $username = "root"; 
//    $password = ""; 
//    $dbname   = "webscodex";
    
   $server ="handson-test.chwcqpod3cc6.us-east-2.rds.amazonaws.com";
	$sqlUsername = "handson";
	$sqlPassword = "handsonhandson";
	$databaseName ="WebTest";
   
   // Create database connection 
//    $con = new mysqli($hostname, $username, $password, $dbname); 
   $conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
    
   // Check connection 
   if ($conn->connect_error) { 
       die("Connection failed: " . $conn->connect_error); 
   }
   
?>