<html>
   
<?php
    
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ERROR); 
    session_start();
    include('config.php');
    // include ("index.php");
    
    foreach($_POST['objectIdentified'] as $key => $value) {
        $object_correct[$key]=$value;
    // echo "text $key = $value";
    }
    foreach($_POST['subFig'] as $key => $value) {
        $subFig[$key]=$value;
    // echo "text $key = $value";
    }
    $id = $_SESSION["user"]->id;
    $l = sizeof($object_correct);
    $conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
    $complete = "false";
  
    for($i=0;$i<$l;$i++){

        $sql = "update annotated_tasks set annotated = 1 ,object_correct = '$object_correct[$i]' where subfigure_file = '$subFig[$i]' and email in (select email from USERS where id =$id)";
        $result = mysqli_query($conn, $sql);  
       
        echo $i;
        echo $l;
        if($i>=$l-1){
            $complete = "true";
        }
    }
    if ($complete=="true"){
        // echo "inside if";
        // header("Location:http://localhost:8888/WebPrograming/index.php?q=&page=1");
        // echo"calling search function";
        //searchAnnotatedtasks("perspective",1);
   
 
?> 

<script>
    console.log("calling replace function")
    //  location.replace("http://localhost:8888/WebPrograming/index.php?q=&page=1'"):
    window.location.replace("http://localhost:8888/WebPrograming/index.php?q=&page=1'").document.getElementById('btnSave').click();
    </script>
</html>
<?php 
    }
?>