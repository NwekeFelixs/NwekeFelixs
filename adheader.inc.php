<?php 
include("connect.inc.php");
ob_start();
session_start();

if (isset($_SESSION['ad_login'])) {
$admin = $_SESSION["ad_login"];
$admin_id = $_SESSION['id'];
}
else{
      $admin = "";
} 
?>