<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "requital";
$dberror1 = "Could Not Connect to your Database";
$dberror2 = "Could Not Find your Table";

$Conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($Conn->connect_error){
    
    die("Connection failed:" .$Conn->connect_error);
    
}

// mysqli_connect($dbhost, $dbuser, $dbpass) or die ($dberror1);

// if($Conn == true){
//     echo "It works!";
// }

// sql to create table

$sql = "INSERT INTO serss (id, nm)
VALUES ('5', '$dberror1')";

function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
}
$h = generate_string('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 10);
echo $h;
if ($Conn->query($sql) === TRUE){
    echo 'Okay';
    }else{
        echo 'Error: ' .$sql. '<br>' .$Conn->error;
    }
?>