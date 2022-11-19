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

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ERROR | E_PARSE);

include('config.php');
$id = $_SESSION["user"]->id;


$conn = new mysqli($server, $sqlUsername, $sqlPassword, $databaseName);
if($q == null){
  $sql2 = "select * from  figure_segmented_nipseval_test2007 where groupID in (select distinct(groupID) from USERS where id =$id)";
}
else{
  $sql2 = "select * from  figure_segmented_nipseval_test2007 where groupID in (select distinct(groupID) from USERS where id =$id) And ((lower(object) like '%$q%')  or (lower(caption) like '%$q%') )";
}

$result2 = mysqli_query($conn, $sql2);  
$num_rows = mysqli_num_rows($result2);



if($result2 === false)
{
  echo "DATABASE ERROR: " . mysqli_error($conn) . "<br />\n";
}

echo "<h2> Records Found is ".$num_rows."</h2>";
echo "<table>
<tr>
<th>Compound Figure File</th>
<th>Caption</th>
<th>Compound Figure </th>
<th>Object</th>
<th>Group ID</th>
</tr>";

while($data = mysqli_fetch_assoc($result2)) {
  $path = "compound_test2007/".$data['figure_file'];
  echo "<tr>";
  echo "<td>" . $data['figure_file'] . "</td>";
  echo "<td>" . $data['caption'] . "</td>";
  echo "<td><img style='width:40%;height:30%;' src= ".$path ." > </td>";
  echo "<td>" . $data['object'] . "</td>";
  echo "<td>" . $data['groupID'] . "</td>";
 
  
  echo "</tr>";
}
echo "</table>";

?>
</body>
</html>