<!DOCTYPE html>
<html>
<head>
<style>
table {
  width: 100%;
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
  padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
session_start();
$q = strval($_GET['q']);
echo $q;
$data = explode(":",$q);

print_r($data);


$email = explode("=",$data[1]);
$group = explode("=",$data[0]);

$email= $email[1];

$group = $group[1];
echo "group is =".$group;

include('config.php');
// $id = $_SESSION["user"]->id;


$conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);

$sql2 = "insert into UserGroups (email,groupID,DateTime) values ('$email' ,'$group',NOW())";


$result2 = mysqli_query($conn, $sql2);  




if($result2 === false)
{
  echo "DATABASE ERROR: " . mysqli_error($conn) . "<br />\n";
}

// echo "<h2> Records Found is ".$num_rows."</h2>";
// echo "<table>
// <tr>
// <th>Compound Figure File</th>
// <th>Caption</th>
// <th>Compound Figure </th>
// <th>Object</th>
// <th>Group ID</th>
// </tr>";

// while($data = mysqli_fetch_assoc($result2)) {
//   $path = "compound_test2007/".$data['figure_file'];
//   echo "<tr>";
//   echo "<td>" . $data['figure_file'] . "</td>";
//   echo "<td>" . $data['caption'] . "</td>";
//   echo "<td><img style='width:40%;height:30%;' src= ".$path ." > </td>";
//   echo "<td>" . $data['object'] . "</td>";
//   echo "<td>" . $data['groupID'] . "</td>";
 
  
//   echo "</tr>";
// }
// echo "</table>";

?>
</body>
</html>