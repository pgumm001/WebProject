<!DOCTYPE html>
<html>
<title>Admin Page</title>
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
        body{
          
        }
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
        width: 60%;
        margin-left:20%;
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
            <span class="navbar-brand mb-0 h2" style="font-weight: bold;color: white;">Web Programming Milestone 1</span>
            <div style="float:right;">
            <!-- <a href="userGroups.php" style=" background-color: #061162; color: white; border:none" class="btn btn-primary">User Groups </a>  -->
            <!-- <a href="assignUser.php" style=" background-color: #061162; color: white; border:none" class="btn btn-primary">Assign User </a>  -->
                <!-- <button type="button" class="btn btn-primary" style="float:right ; background-color: #061162; color: white; border:none" onclick="logout()">Logout</button> -->
            </div>
        </div>
    </nav>
    
    </br>
    </br>
    </br>
   


<?php

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
$url = "https://";   
else  
$url = "http://";   
// Append the host(domain name, ip) to the URL.   
$url.= $_SERVER['HTTP_HOST'];   

// Append the requested resource location to the URL   
$url.= $_SERVER['REQUEST_URI'];    

 

// $url = 'https://www.geeksforgeeks.org?name=Tonny';
     

$url_components = parse_url($url);
 
// Use parse_str() function to parse the
// string passed via URL
parse_str($url_components['query'], $params);
     
// Display result
$compoundFig = $params['fig'];

include('config.php');
$conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);

$sql2 = "select subfigure_file from  figure_segmented_nipseval_test2007 where figure_file = '$compoundFig' ";
$result2 = mysqli_query($conn, $sql2);  
$num_rows = mysqli_num_rows($result2);

echo "<h2> Records Found is ".$num_rows."</h2>";
echo "<table>
<tr>
<th>Compound Figure File</th>
<th>SubFigures</th>
</tr>"; 
while($data = mysqli_fetch_assoc($result2)) {

    $path = "segmented_test2007/".$data['subfigure_file'];
    echo "<tr>";
    echo "<td>".$compoundFig."</td>";
    echo "<td><img style='margin-left:20%;margin-top:20px;width:40%;height:30%;' src= ".$path ." ></td>";
  
    echo "</tr>";
    }
echo "</table>";
?>

</body>

</html>