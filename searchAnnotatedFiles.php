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
  $sql2 = "select * from  figure_segmented_nipseval_test2007 where groupID in (select distinct(groupID) from UserGroups where email in (select email from USERS where id =$id))";
}
else{
  $sql2 = "select * from  figure_segmented_nipseval_test2007 where groupID in (select distinct(groupID) from UserGroups where email in (select email from USERS where id =$id)) And ((lower(object) like '%$q%')  or (lower(caption) like '%$q%') ) ";
}

$result2 = mysqli_query($conn, $sql2);  
$num_rows = mysqli_num_rows($result2);



if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
$url = "https://";   
else  
$url = "http://";   
$url.= $_SERVER['HTTP_HOST'];   
$url.= $_SERVER['REQUEST_URI'];    
$url_components = parse_url($url);

parse_str($url_components['query'], $params);

$results_per_page = 10;
$number_of_pages = ceil($num_rows/$results_per_page);
// determine which page number visitor is currently on
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $params['page'];
}


// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page-1)*$results_per_page;



// retrieve selected results from database and display them on page
if($q == null){
  $sql2 = "select * from  figure_segmented_nipseval_test2007 where groupID in (select distinct(groupID) from UserGroups where email in (select email from USERS where id =$id)) LIMIT  $this_page_first_result , $results_per_page";
}
else{
  $sql2 = "select * from  figure_segmented_nipseval_test2007 where groupID in (select distinct(groupID) from UserGroups where email in (select email from USERS where id =$id)) And ((lower(object) like '%$q%')  or (lower(caption) like '%$q%') ) LIMIT  $this_page_first_result , $results_per_page";
}

$result = mysqli_query($conn, $sql2);
// $num_rows = mysqli_num_rows($result);
// print_r($num_rows);


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

while($data = mysqli_fetch_assoc($result)) {
  $path = "compound_test2007/".$data['figure_file'];
  echo "<tr>";
  echo "<td> <a href='subFigures.php?fig=".$data['figure_file']."' target='_blank' >" . $data['figure_file'] . "</td>";
  echo "<td> ". $data['caption'] . "</td>";
  echo "<td><img style='width:40%;height:30%;' src= ".$path ." > </td>";
  echo "<td>" . $data['object'] . "</td>";
  echo "<td>" . $data['groupID'] . "</td>";
 
  
  echo "</tr>";
}
echo "</table>";

for ($pag=1;$pag<=$number_of_pages;$pag++) {
  if($pag == $page){
      
  echo '<a style="color:red;" class="close" href="index.php?q='.$q.'&page=' . $pag . '">' . $pag . '</a> ';
  echo"&nbsp";
  }
  else {
      echo '<a  class="close" href="index.php?q='.$q.'&page=' . $pag . '">' . $pag . '</a> ';
      echo"&nbsp";
  }
}


?>
</body>
</html>

