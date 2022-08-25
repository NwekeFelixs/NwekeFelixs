<?php include("header.inc.php");?>
<!doctype html>
<html lang="zxx">
    
<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap Min CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!-- Animate Min CSS -->
        <link rel="stylesheet" href="assets/css/animate.min.css">
        <!-- Font Awesome Min CSS -->
        <link rel="stylesheet" href="assets/css/fontawesome.min.css">
        <!-- FlatIcon CSS -->
        <link rel="stylesheet" href="assets/css/flaticon.css">
        <!-- Magnific Popup Min CSS -->
        <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
        <!-- NiceSelect CSS -->
        <link rel="stylesheet" href="assets/css/nice-select.css">
        <!-- Slick Min CSS -->
        <link rel="stylesheet" href="assets/css/slick.min.css">
        <!-- MeanMenu CSS -->
        <link rel="stylesheet" href="assets/css/meanmenu.css">
        <!-- Odometer CSS -->
		<link rel="stylesheet" href="assets/css/odometer.min.css">
        <!-- Style CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="assets/css/responsive.css">
		
		<style> 
input[type=button], input[type=submit] {
  background-color: #f42a50;
  border: none;
  color: white;
  padding: 16px 32px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 4px;
}
</style>

        <title>Log in - Requital Finance</title>

        <link rel="icon" type="image/png" href="assets/img/favicon.png">
        
    </head>

        <!-- Preloader -->
        <div class="preloader">
            <div class="loader">
                <div class="shadow"></div>
                <div class="box"></div>
            </div>
        </div>
        <!-- End Preloader -->

        <!-- Start Login Area -->
        <section class="login-area">
            <div class="row m-0">
                
                <div class="col-lg-12 col-md-12 p-0">
                    <div class="login-content">
                        <div class="d-table">
                            <div class="d-table-cell">
                                <div class="login-form">
                                    <div class="logo">
                                        <a href="index.php"><img src="assets/img/black-logo.png" alt="image"></a>
                                    </div>

                                    <h3>Welcome back</h3>
                                    <p>New to Requital  finance? <a href="reg.php">Sign up</a></p>
						
									
<?php
$connection_mysql = new mysqli("localhost","root","","requital");

if ($connection_mysql->connect_error){
    
    die("Connection failed:" .$Conn->connect_error);
}

//Login Script
if (isset($_POST["user_login"]) && isset($_POST["password_login"])) {
	$user_login = strip_tags(@$_POST['user_login']);
    $password_login = strip_tags(@$_POST['password_login']);
	$md5password_login = md5($password_login);
    $sql = mysqli_query($connection_mysql, "SELECT refcode FROM db_users WHERE email='$user_login' AND password='$md5password_login' LIMIT 1"); // query the person
	//Check for their existance                                                                                           // formerly this was just closed ='no' but when a new user creates an account this is empty
	$userCount = mysqli_num_rows($sql); //Count the number of rows returned
	if ($userCount == 1) {
	    
	    $from = 'contact@delhaizecointrade.com'; 
$fromName = 'Requital Finance'; 
 
$subject = "Log in Check"; 
 
$htmlContent = " 
    <html> 
    <head>
        <title>Successful Sign In</title>
			 <style>
      .img-container {
        text-align: center;
      }
    </style>
    </head> 
    <body> 
		<div class='img-container'> <!-- Block parent element -->
      <img src='https://delhaizecointrade.com/sgtlogo.png' alt='Delhaizecoin'>
    </div>
        <h3>You just logged in.</h3>
		<p>If you think you did not initiate this process, kindly contact us to change your password</p>
		
        
            
        <footer>
		Requital Finance<br/>
		contact@delhaizecointrade.com<br/>
		<a href='https://delhaizecointrade.com'>www.delhaizecointrade.com        
        </footer>   
        
    </body> 
    </html>"; 
 
// Set content-type header for sending HTML email 
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
 
// Additional headers 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 

 
// Send email 
mail($user_login, $subject, $htmlContent, $headers);
	    
		while($row = mysqli_fetch_array($sql)){
             $id = $row["id"];
	}
                 $_SESSION["id"] = $id;
		 $_SESSION["user_login"] = $user_login;
		 $_SESSION["password_login"] = $password_login;
		 
		 header("location:  dashboard.php");
         exit();
		} else {
		echo "<span style='color:red; font-size: 25px; line-height: 30px; margin: 10px;'>Wrong log in details,try again </span>";

		
	}

}
?>

                                    <form method="POST" >
                                        <div class="form-group">
                                            <input type="email" name="user_login" placeholder="Your email address" class="form-control" required="">
                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="password_login" placeholder="Your password" class="form-control" required="">
                                        </div>

                                        <div class="form-group">
											<input type="submit" class="" name="login" value="Log in">
										</div>	
										
                                        
                                        <div class="forgot-password">
                                            <a href="clogin.php">Forgot Password?</a>
                                        </div>

                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
		
		<div class="language-switcher-language-url" id="google_translate_element" role="navigation"></div>
        <!-- End Login Area -->

        <!-- jQuery Min JS -->
        <script src="assets/js/jquery.min.js"></script>
        <!-- Popper Min JS -->
        <script src="assets/js/popper.min.js"></script>
        <!-- Bootstrap Min JS -->
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- Mean Menu JS -->
        <script src="assets/js/jquery.meanmenu.js"></script>
        <!-- NiceSelect Min JS -->
        <script src="assets/js/jquery.nice-select.min.js"></script>
        <!-- Slick Min JS -->
        <script src="assets/js/slick.min.js"></script>
        <!-- Magnific Popup Min JS -->
        <script src="assets/js/jquery.magnific-popup.min.js"></script>
        <!-- Appear Min JS -->
		<script src="assets/js/jquery.appear.min.js"></script>
        <!-- Odometer Min JS -->
        <script src="assets/js/odometer.min.js"></script>
        <!-- Parallax Min JS -->
        <script src="assets/js/parallax.min.js"></script>
        <!-- WOW Min JS -->
        <script src="assets/js/wow.min.js"></script>
        <!-- Form Validator Min JS -->
        <script src="assets/js/form-validator.min.js"></script>
        <!-- Contact Form Min JS -->
        <script src="assets/js/contact-form-script.js"></script>
        <!-- Main JS -->
        <script src="assets/js/main.js"></script>
		<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		<script type="text/javascript">
		function googleTranslateElementInit() {
		  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
		}
		</script>
		<script src="//code.tidio.co/ntjvqb8dbmfyhik3dknejkrzk3m67u7v.js" async></script>
    </body>

</html>