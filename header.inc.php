<?php 
include("connect.inc.php");
ob_start();
session_start();

if (isset($_SESSION['user_login'])) {
$user = $_SESSION["user_login"];
$user_id = $_SESSION['id'];
}
else{
      $user = "";
} 
?>