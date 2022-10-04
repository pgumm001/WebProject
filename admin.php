
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
            <span class="navbar-brand mb-0 h2" style="font-weight: bold;color: white;">Web Programming Milestone 1</span>
            <div style="float:right;">
               
                <button type="button" class="btn btn-primary" style="float:right ; background-color: #061162; color: white; border:none" onclick="logout()">Logout</button>
            </div>
        </div>
    </nav>
        
        <div class="dataTable">
            <h2>Registrations waiting for Approval</h2>
        <table>
            <tr>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th></th>
                   
            </tr>
            <?php
                session_start();
                ini_set('display_errors', '1');
                ini_set('display_startup_errors', '1');
                error_reporting(E_ALL); 
                include('config.php');
 
                $conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
                $user = $_SESSION['user'];
                // echo ($user);
                $sql = "select id, email , phone from USERS where approved = 0";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    echo "Wrong SQL Query: $sql";
                   
                    die;
                } else {
                    // print_r($sql);
                    //  print_r($result);
                }

            ?>
            <?php
                if (mysqli_num_rows($result) > 0) {
               
                    while($data = mysqli_fetch_assoc($result)) {
                       
                        echo "<tr>";
                        echo "<td>${data['email']}</td>";
                        echo "<td>${data['phone']}</td>";
                        echo "<td align:'center'><button onClick=approveFunction('{$data['id']}')>Approve</button></td>";
                        echo "</tr>";
                        
                    }
                }
               
                ?>
        </table>  
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js?ver=3.3.1"></script>
    
    </div>
        <script>
            function approveFunction(id) {
                console.log("approve called",id);
                var app = id;
                Swal.fire({
                    title: 'Do you want to Approve the user?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Approve',
                    denyButtonText: `Don't Approve`,
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        
                            $.ajax({

                                url : 'approve.php',
                                type : 'POST',
                                // dataType: 'json',
                                data:{id:app},
                                success : function (result) {
                                    console.log (result); // Here, you need to use response by PHP file.
                                },
                                error : function () {
                                    console.log ('error');
                                }

                            });
                        
               
                        Swal.fire('Approved!', '', 'success')
                       
                        location.reload();
                    } else if (result.isDenied) {
                        Swal.fire('User not Approved', '', 'info')
                    }
                })
               
                
            }

            
        </script>
       
     
</body>

</html>