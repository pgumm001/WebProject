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
        /* width: 60%;
        margin-left:20%; */
        color: #061162;
        font-family: monospace;
        font-size: 15px;
        text-align: left;
        caption-side: bottom;
            border-collapse: collapse;
            width: 100%;
            height: fit-content;
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
        .wrapper {
            display: grid;
            grid-template-columns: 30% 70%;
            width: 100vw;
            height: 100vh;
        }
        .box {
                /* background-color: #444; */
                color:black ;
                padding: 1%;
        }

        * {
            box-sizing: border-box;
        }
        .a {
            /* background-color: gray; */
        }
        .b {
            /* background-color: blue; */
        }
        body {
            margin: 2em;
            /* background-color: light-grey; */
        }

        /* .container {
            background-color: green;
            height: 100px;
        }                                                */
    </style>
     <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
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

$sql2 = "select * from  figure_segmented_nipseval_test2007 where figure_file = '$compoundFig' ";
$result2 = mysqli_query($conn, $sql2);  
$num_rows = mysqli_num_rows($result2);


echo "<h2> Records Found is ".$num_rows."</h2>";
?>
<div >
	<div class="wrapper">
		<div class="box a">
            <?php 
                $subPath = "compound_test2007/".$compoundFig;
                echo "<table>
                <tr>
    
                <th>Compound Figure</th>
                </tr>"; 
                echo "<tr>";
                echo "<td><img style='margin:10%;width:70%;height:30%;' src= ".$subPath ." ></td>";
                echo "</tr>";   
                echo "</table>";
            
            ?>
            <form  action="annotate.php" method="POST" >
                
                <p>Are the Original Figures Segmented correctly ?</p>
                    <input type="radio" id="yes" name="segmented" value="Yes"  required onChange="validateSegment('Yes')">
                    <label for="yes">Yes</label><br>
                    <input type="radio" id="no" name="segmented" value="No" onChange="validateSegment('No')">
                    <label for="no">No</label><br>
                    <input type="radio" id="unkonwn" name="segmented" value="unkonwn" onChange="validateSegment('unknown)">
                    <label for="unkonwn">Unknown</label>

                <br>  
                <br>

                    <label for="segmentedVal">How many sub figures must be segmented from the original figure?</label><br>
                    <input type="number" id="segmentedVal" name="segmentedVal" ><br><br>
                
    
        </div>
		<div class="box b">
        <?php
            echo "<table>
            <tr>

            <th>SubFigures</th>
            </tr>"; 
            while($data = mysqli_fetch_assoc($result2)) {
                $rows[] = $data;
            }
            for ($i=0;$i<$num_rows;$i++){
                $path = "segmented_test2007/".$rows[$i]['subfigure_file']; 
                echo "<tr>";
                echo "<td>";
                echo "<img style='margin:5%;width:30%;height:30%;' src= ".$path ." >";
                echo "<p> Object: ".$rows[$i]['object']."</p>";
                echo "<p> Aspect: ".$rows[$i]['aspect']."</p>";
                ?>
                <input type="text" style="display:none;" name="subFig[<?php echo $i ?>]" value = <?php echo $rows[$i]['subfigure_file'] ?>></input>
                <label for="objectIdentified[<?php echo $i ?>]">Is the object Identified correctly?</label>
                <select required className="objectIdentified" id="objectIdentified[<?php echo $i ?>]" name="objectIdentified[<?php echo $i ?>]" onChange = "validateObjIdentified(document.getElementById('objectIdentified[<?php echo $i ?>]').value,<?php echo $i ?>)" >
                    <option value="" selected disabled hidden>Choose</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                    <option value="Unknown">Unknown</option>
                </select>
               
                <br>

                <label for="objectIdentifiedText[<?php echo $i ?>]">What is the correct Object if you answered "no" above?</label><br>
                <input type="text" id="objectIdentifiedText[<?php echo $i ?>]" name="objectIdentifiedText[<?php echo $i ?>]" ><br><br>

                <label for="aspectIdentified[<?php echo $i ?>]">Is the aspect Identified correctly?</label>
                <select required id="aspectIdentified[<?php echo $i ?>]" name="aspectIdentified[<?php echo $i ?>]" onChange = "validateAspectIdentified(document.getElementById('aspectIdentified[<?php echo $i ?>]').value,<?php echo $i ?>)">
                    <option value="" selected disabled hidden>Choose</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                    <option value="Unknown">Unknown</option>
                </select>
               
                <br>

                <label for="aspectIdentifiedText[<?php echo $i ?>]">What is the correct Aspect if you answered "no" above?</label><br>
                <input type="text" id="aspectIdentifiedText[<?php echo $i ?>]" name="aspectIdentifiedText[<?php echo $i ?>]" ><br><br>

                <?php
                echo "</td>"; 
                echo "</tr>";                
                }
            echo "</table>";
            ?>

        </div>
        <div style="display: flex;justify-content: center;width: 100vw">
            <button  style="width: max-content;height: max-content;justify-content: center;" type='submit' onClick="validate(<?php echo $num_rows ?>)">Submit</button>
        </div> 
        </form>
	</div>
</div>

<script>
    function validateSegment(value){
        console.log("value",value);
        segmentedVal
        if (value=="No"){
            document.getElementById("segmentedVal").required=true;
        }
        else{
            document.getElementById("segmentedVal").required=false;
        }
    }
    function validateObjIdentified(value,id){
        // console.log("value",value)
        // console.log("id",id);
        if (value=="No"){
            document.getElementById("objectIdentifiedText["+id+"]").required=true;
        }
        else{
            document.getElementById("objectIdentifiedText["+id+"]").required=false;
        }
    }
    function validateAspectIdentified(value,id){
        console.log("value",value)
        console.log("id",id);
        if (value=="No"){
            console.log("inside if")
            document.getElementById("aspectIdentifiedText["+id+"]").required=true;
        }
        else{
            document.getElementById("aspectIdentifiedText["+id+"]").required=false;
        }
    }
</script>


</body>

</html>

