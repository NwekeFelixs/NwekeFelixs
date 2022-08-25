<?php include ('adheader.inc.php');?>
<?php

//Login Script
if (isset($_POST["ad_login"]) && isset($_POST["password_login"])) {
	$ad_login = strip_tags(@$_POST['ad_login']);
    $password_login = strip_tags(@$_POST['password_login']);
	$md5password_login = md5($password_login);

	$connection_mysql = new mysqli("localhost","root","","requital");

if ($connection_mysql->connect_error){
    
    die("Connection failed:" .$Conn->connect_error);
}

    $sql = mysqli_query($connection_mysql, "SELECT refcode FROM administrator WHERE email='$ad_login' AND pass='$md5password_login' LIMIT 1"); // query the person
	//Check for their existance                                                                                           // formerly this was just closed ='no' but when a new user creates an account this is empty
	$adCount = mysqli_num_rows($sql); //Count the number of rows returned
	if ($adCount == 1) {
		while($row = mysqli_fetch_array($sql)){
             $id = $row["id"];
	}
                 $_SESSION["id"] = $id;
		 $_SESSION["ad_login"] = $ad_login;
		 $_SESSION["password_login"] = $password_login;
		 
		 header("location:  addash.php");
         exit();
		} else {
		echo "<span style='color:red; font-size: 25px; line-height: 40px; margin: 10px;'>Wrong log in details,try again </span>";

		
	}

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images1/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor1/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts1/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor1/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor1/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor1/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css1/util.css">
	<link rel="stylesheet" type="text/css" href="css1/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<a href="index.php" title="Delhaize" rel="home" class="header__logo"> <img src="assets/img/logo.png" alt="IMG"> </a>
				</div>

				<form class="login100-form validate-form" action="adlog.php" method="post">
					<span class="login100-form-title">
						Admin Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="ad_login" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password_login" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="login">
							Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor1/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor1/bootstrap/js/popper.js"></script>
	<script src="vendor1/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor1/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor1/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js1/main.js"></script>

</body>
</html>