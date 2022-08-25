<?php
$connection_mysql = mysqli_connect("localhost","root","","requital");
   
if (mysqli_connect_errno($connection_mysql)){
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

mysqli_select_db($connection_mysql,"requital");
mysqli_close($connection_mysql);

// mysql_connect("localhost", "delhcigl", "AXw578G00%P{") or die("Couldn't connect to database");
// mysql_select_db("delhcigl_delhaize") or die("Couldn't select db");
//  $con = mysqli_connect("localhost","delhcigl","AXw578G00%P{","delhcigl_delhaize");
 ?>
 

