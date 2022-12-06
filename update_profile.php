

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
                <a href="update_profile.php" style=" background-color: #061162; color: white; border:none" class="btn btn-primary">Update Profile</a> 
                <a href="index.php" style=" background-color: #061162; color: white; border:none" class="btn btn-primary">Home</a> 
                <button type="button" class="btn btn-primary" style="float:right ; background-color: #061162; color: white; border:none" onclick="logout()">Logout</button>
            </div>
        </div>
    </nav>
        <form method="post">
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

                $sql="SELECT id,First_name ,Last_name,email ,phone ,password FROM USERS where id='$user'";
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
                        echo "<td><input value=${data['First_name']} name='fname'></td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<th>Last Name</th>";
                        echo "<td><input value=${data['Last_name']} name ='lname'></td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<th>Email Id</th>";
                        echo "<td><input value =${data['email']} name='email' readonly></td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<th>Phone</th>";
                        echo "<td><input value=${data['phone']} name='phone'></td>";  
                        echo "</tr>";

                        echo "<tr>";
                        echo "<th> Old Password</th>";
                        echo "<td><input type='password' value=${data['password']} name='old_password' readonly></td>";  
                        echo "</tr>";

                        echo "<tr>";
                        echo "<th> New Password</th>";
                        echo "<td><input type='password' name='new_password' ></td>";  
                        echo "</tr>";

                        echo "</table>";
                        
                    }
                }
               
                
               

            ?>
   
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js?ver=3.3.1"></script>
    
    </div>
    
    <button type="submit" name="update" style="margin-left:20%">Submit</button>
</form>   
    <?php
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL); 
            include('config.php');
            $user = $_SESSION["user"]->id;
           
            if (isset($_POST["update"]))
            {
               
                $fname = $_POST["fname"];
                $lname = $_POST["lname"];
                $email = $_POST["email"];
                $phone = $_POST["phone"];
                $old_password = $_POST['old_password'];
                $new_password = $_POST["new_password"];
                // $new_password = password_hash($new_password, PASSWORD_DEFAULT);

               if(empty($new_password)){
                $password = $old_password;
               }
               else{
                $password= $new_password;
                $password = password_hash($new_password, PASSWORD_DEFAULT);
               }
                   
                
                // $conn = mysqli_connect("handson-test.chwcqpod3cc6.us-east-2.rds.amazonaws.com", "handson", "handsonhandson", "WebTest");
                
                $sql = "Update USERS set phone = '$phone' , password = '$password',First_name = '$fname',Last_name='$lname' where id ='$user'";
          
                $res = mysqli_query($conn, $sql);
                
            }
 
    ?>
</body>

</html>