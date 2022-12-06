

<!DOCTYPE html>
<html>
<title>WebProject</title>
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
        
                    
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
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
                <a href="update_profile.php" style=" background-color: #061162; color: white; border:none" class="btn btn-primary">Update Profile</a> 
                <a href="index.php" style=" background-color: #061162; color: white; border:none" class="btn btn-primary">Home</a> 
                <button type="button" class="btn btn-primary" style="float:right ; background-color: #061162; color: white; border:none" onclick="logout()">Logout</button>
            </div>
        </div>
    </nav>
        
        <div class="dataTable">
            <h2>My Profile</h2>
            <?php
                session_start();
                ini_set('display_errors', '1');
                ini_set('display_startup_errors', '1');
                error_reporting(E_ALL); 
                include('config.php');
                
                
                $conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
                $user = $_SESSION["user"]->id;

                $sql="SELECT id,First_name ,Last_name,email ,phone FROM USERS where id='$user'";
                $result = mysqli_query($conn, $sql);
                
                if (!$result) {
                    echo "Wrong SQL Query: $result";
                   
                    die;
                } else {
                    // print_r($sql);
                    // echo "connected";
                }
               
                if (mysqli_num_rows($result) > 0) {
               
                    while($data = mysqli_fetch_assoc($result)) {
                       echo "<table>";
                        echo "<tr>";
                        echo "<th>First Name</th>";
                        echo "<td>${data['First_name']}</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<th>Last Name</th>";
                        echo "<td>${data['Last_name']}</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<th>Email Id</th>";
                        echo "<td>${data['email']}</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<th>Phone</th>";
                        echo "<td>${data['phone']}</td>";  
                        echo "</tr>";
                        echo "</table>";
                    }
                } 

            ?>
   
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js?ver=3.3.1"></script>
    
    </div>
    <form  method="get" autocomplete="off">
        <input type="text"  name="search" placeholder="Search.." style ="margin-top:10vh;margin-left:40%">
        <button type="button" value="search" onClick="searchCaption(document.getElementsByName('search')[0].value)">Search</button>

        <button type="button" id="searchAnnotationTasks" value="searchAnnotation" onClick="setSearchAnnotatedTasksVar();searchAnnotatedtasks(document.getElementsByName('search')[0].value);" >Search Annotation Tasks</button>
        <!-- searchAnnotatedtasks(document.getElementsByName('search')[0].value) -->
    </form>
        
   <div style="min-height:50%;" id="dataTable"></div>

                <!-- Footer -->
<footer style="background:#7ba0c6;margin-top:68px"class="page-footer font-small blue pt-4">

<!-- Footer Links -->
<div class="container-fluid text-center text-md-left">

  <!-- Grid row -->
  <div class="row">

    <!-- Grid column -->
    <div class="col-md-6 mt-md-0 mt-3">

      <!-- Content -->
      <p class="text-uppercase">Figure Annotation Project</p>
      <img src="icon.png" style="    height: 32px; width: 31px;"/>

    </div>
    <!-- Grid column -->

    <hr class="clearfix w-100 d-md-none pb-3">

    <!-- Grid column -->
    <div class="col-md-3 mb-md-0 mb-3">

      <!-- Links -->
      <!-- <h5 class="text-uppercase">Links</h5> -->

      <ul class="list-unstyled">
        <li>
          <a href="update_profile.php">Update Profile</a>
        </li>
       
      </ul>

    </div>


  </div>
  <!-- Grid row -->

</div>
<!-- Footer Links -->

<!-- Copyright -->
<div class="footer-copyright text-center py-3">© 2022 Copyright:WebProject
</div>
<!-- Copyright -->

</footer>
<!-- Footer -->
    <!-- <footer class="page-footer bottom font-small blue">
        
        <div style= "background:#d2d4f0;"class="footer-copyright text-center py-3">© 2022 Copyright:Figure Annotation Task (Milestone 3)
  
        </div>
    </footer> -->

     
</body>

</html>




<script>
    var searchAnnotatedtasksVar = false;

    // $(document).ready(function(){
    //     //check if close element exists. If yes, execute the function
    //     if($('.close')){
    //         console.log("searchAnnotatedtasksVar from doc ready is ",searchAnnotatedtasksVar)
    //         $url = window.location.href;
    //         console.log("url is ",$url);
    //         const queryString = window.location.search;
    //         console.log("query string",queryString);
    //         const urlParams = new URLSearchParams(queryString);
    //         const product = urlParams.get('q');
    //         const pageNo = urlParams.get('page');
    //         console.log(product);
    //         searchAnnotatedtasksVar = true;
    //         searchAnnotatedtasks(product,pageNo);
            
    //     } 
    // });
    function initialise() { 
        $url = window.location.href;
            console.log("url is ",$url)
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const product = urlParams.get('q');
            const pageNo = urlParams.get('page');
            const functionToCall = urlParams.get('function');

        if( functionToCall == "searchCaption"){ 
            console.log("inside functionto call ",functionToCall)
            searchCaption(product,pageNo);
        }
        else{ 
           
            searchAnnotatedtasksVar = true;
            searchAnnotatedtasks(product,pageNo);
        }
    }

    $(document).ready(initialise);

    // $(document).ready(function(){
    //     //check if close element exists. If yes, execute the function
    //     if($('.second')){
    //         console.log("inside the search caption doc ready function")
    //         $url = window.location.href;
    //         console.log("url is ",$url)
    //         const queryString = window.location.search;
    //         const urlParams = new URLSearchParams(queryString);
    //         const product = urlParams.get('q');
    //         const pageNo = urlParams.get('page');
    //         console.log(product);
    //         console.log("calling search cap")
    //         searchCaption(product,pageNo);
    //     } 
    //     // if($('.close')){
    //     else{
    //         console.log("searchAnnotatedtasksVar from doc ready is ",searchAnnotatedtasksVar)
    //         $url = window.location.href;
    //         console.log("url is ",$url);
    //         const queryString = window.location.search;
    //         console.log("query string",queryString);
    //         const urlParams = new URLSearchParams(queryString);
    //         const product = urlParams.get('q');
    //         const pageNo = urlParams.get('page');
    //         console.log(product);
    //         searchAnnotatedtasksVar = true;
    //         searchAnnotatedtasks(product,pageNo);
            
    //     } 
        
    // });

    function setSearchAnnotatedTasksVar (){
        // console.log("inside set seach var variable" , id);
        searchAnnotatedtasksVar =true;
        // search= id;
        console.log("calling searchannotated tasks");
        // searchAnnotatedtasks(search);   
    }

    function searchCaption(id,page){
        console.log("the search param inside searchCaption is ",id)
        console.log("the page param inside searchCaption is ",page)

        if(page  == null ){
            page = 1
        }else{
            page = page;
        }
        console.log("console log page",page);
        var xmlhttp1=new XMLHttpRequest();
        xmlhttp1.open("GET","searchCaption.php?q="+id+"&page="+page,true);
        xmlhttp1.send();
        xmlhttp1.onreadystatechange=function() {
                
                // console.log("response",this.responseText);
                document.getElementById("dataTable").innerHTML=this.responseText;
        }
      
    }


     function searchAnnotatedtasks(id,page){
        console.log("inside setSearchAnnotatedTasks();")
        console.log("searchAnnotatedtasksVar",searchAnnotatedtasksVar);
        if(searchAnnotatedtasksVar == true){
            console.log("teh search param is ",id)
            if(page  == null ){
                page = 1
            }else{
                console.log("page number in else is =",page)
                page = page;
            }
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.open("GET","searchAnnotatedFiles.php?q="+id+"&page="+page,true);
            xmlhttp.send();
            xmlhttp.onreadystatechange=function() {
                    console.log("inside xmlhttp")
                    console.log("response",this.responseText);
                    document.getElementById("dataTable").innerHTML=this.responseText;
            }
            searchAnnotatedtasksVar = false;
        }
        
      
    }
    
</script>

           
         