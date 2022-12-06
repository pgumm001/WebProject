<!DOCTYPE html>
<html>
<title>User Groups</title>
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
        color: #061162;
        font-family: monospace;
        font-size: 25px;
        text-align: left;
        margin-left:20%
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
            <span class="navbar-brand mb-0 h2" style="font-weight: bold;color: white;">Web Programming Figure Annotation Task</span>
            <div style="float:right;">
            <a href="annotationTasks.php" style=" background-color: #061162; color: white; border:none" class="btn btn-primary">Annotation Tasks </a> 
            <a href="admin.php" style=" background-color: #061162; color: white; border:none" class="btn btn-primary">Home </a> 
                <button type="button" class="btn btn-primary" style="float:right ; background-color: #061162; color: white; border:none" onclick="logout()">Logout</button>
            </div>
        </div>
    </nav>
        </br>
        </br>
        </br>
        </br>
        <?php 
            include('config.php');
 
            $conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
            
            $sql2 = "select email from USERS";
            $sql = "select distinct(groupID) from figure_segmented_nipseval_test2007";
            
            $result = mysqli_query($conn, $sql);  
            $result2 = mysqli_query($conn, $sql2);  
            $num_rows = mysqli_num_rows($result2);
            // print_r($result2);
            $data = mysqli_fetch_assoc($result2)
        ?>
    <form method="POST" style="margin-left:20%;">

         <select id = "email" >  
         <?php 
            while($row = $result2->fetch_array()){
                ?>
                <option> <?php echo $row['email'] ?></option>
                <?php
            }  
         ?>
        </select>
        <select id = "group" >  
        <?php 
            while($row = $result->fetch_array()){
                ?>
                <option> <?php echo $row['groupID'] ?></option>
                <?php
            }  
         ?>
        </select>  

        <button type = "submit" onClick="assignUser(document.getElementById('email').value,document.getElementById('group').value)">Assign</button>
    </form>
        
    </br>
    </br>
    </br>
</body>
</html>
<script>
    function assignUser(email,group) {
        var email = email
        var group = group
        var param = 'group='+group+':email='+email;
        console.log(email,group)
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.open("GET","assignUser.php?q="+param,true);
        xmlhttp.send();
        xmlhttp.onreadystatechange=function() {
                console.log("response",this.responseText);
                // document.getElementById("dataTable").innerHTML=this.responseText;
        }
       
    }
</script>

<?php


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ERROR | E_PARSE);

include('config.php');

if($isset['POST']){
    $email = $_POST['email'];
    $grp = $_POST['group'];

    echo $email;
    echo $grp;
}

$conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);

$sql2 = "select email , groupID from UserGroups";

$result2 = mysqli_query($conn, $sql2);  
$num_rows = mysqli_num_rows($result2);



if($result2 === false)
{
  echo "DATABASE ERROR: " . mysqli_error($conn) . "<br />\n";
}

echo "<table>
<tr>
<th>Users</th>
<th>Group Assigned</th>

</tr>";

while($data = mysqli_fetch_assoc($result2)) {
  echo "<tr>";
  echo "<td>" . $data['email'] . "</td>";
  echo "<td>" . $data['groupID'] . "</td>"; 
  echo "</tr>";
}
echo "</table>";

?>