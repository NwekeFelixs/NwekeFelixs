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
input[type=submit] {
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

        <title>Password Recovery - Requital Finance </title>

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

        <!-- Start Signup Area -->
        <section class="signup-area">
            <div class="row m-0">
                

                <div class="col-lg-12 col-md-12 p-0">
                    <div class="signup-content">
                        <div class="d-table">
                            <div class="d-table-cell">
                                <div class="signup-form">
                                    <div class="logo">
                                        <a href="index.php"><img src="assets/img/black-logo.png" alt="image"></a>
                                    </div>

                                    <h3>Recover your Password</h3>
                                    <p>Already signed up? <a href="login.php">Log in</a></p>
									<?php

$connection_mysql = new mysqli("localhost","root","","requital");

if ($connection_mysql->connect_error){
    
    die("Connection failed:" .$Conn->connect_error);
}

//cLogin Script
$clogin = @$_POST['clogin'];

$em = "";
$ph = ""; //phone
$pswd = ""; //Password
$pswd2 = ""; // Password 2

$ph = strip_tags(@$_POST['phone']);
$em = strip_tags(@$_POST['email']);
$pswd = strip_tags(@$_POST['password']);
$pswd2 = strip_tags(@$_POST['password2']);

if ($clogin){
$u_check = mysqli_query($connection_mysql, "SELECT email FROM db_users WHERE phone='$ph' && email='$em'");
if ($u_check === FALSE){
    die (mysqli_error($connection_mysql));}
$gu = mysqli_fetch_assoc($u_check);
// $tid = $gu['email'];
$check = mysqli_num_rows($u_check);

if ($check != 0) {
	if ($ph&&$em&&$pswd&&$pswd2) {
		if ($pswd==$pswd2) {
$pswd = md5($pswd);
$pswd2 = md5($pswd2);
$query = mysqli_query($connection_mysql, "UPDATE db_users SET password='$pswd' WHERE email='$em'");

$from = 'contact@delhaizecointrade.com'; 
$fromName = 'Requital Finance'; 
 
$subject = "Password Change"; 
 
$htmlContent = " 
    <html> 
    <head>
        <title>Your Password has been Changed</title>
			 <style>
      .img-container {
        text-align: center;
      }
    </style>
    </head> 
    <body> 
		<div class='img-container'> <!-- Block parent element -->
      <img src='https://delhaizecointrade.com/sgtlogo.png' alt='Requital Finance'>
    </div>
        <h3>You just changed your password, you will have to log in to your account with the new password from now on.</h3>
		<p>If you think you did not initiate this process, kindly contact us to secure your account</p>
		
        
            
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
mail($em, $subject, $htmlContent, $headers);
echo "<span style='color:green; font-size: 25px; line-height: 30px; margin: 10px;'><h4>Password has been Changed</h4><a href='login.php'>Log in</a></span>";


}else
{
	echo "<span style='color:red; font-size: 25px; line-height: 40px; margin: 10px;'>Passwords do not match</span>";
}
}
else
{
		echo "<span style='color:red; font-size: 25px; line-height: 40px; margin: 10px;'>Fill in all fields</span>";
}
}else
{
	echo "<span style='color:red; font-size: 20px; line-height: 30px; margin: 10px;'>Account not found.</span>";
}
}

?>

                                    <form method="POST">
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" placeholder="Registered email address" class="form-control" required="">
                                        </div>
										
										<div class="form-group">
                                            <input type="text" name="phone" id="email" placeholder="Registered Phone Number" class="form-control" required="">
                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="password" id="password" placeholder="New password" class="form-control" required="">
                                        </div>
										
										<div class="form-group">
                                            <input type="password" name="password2" id="password" placeholder="Confirm password" class="form-control" required="">
                                        </div>

                                        <div class="form-group">
											<input type="submit" name="clogin"  value="Change Password" class=""/>
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
		<script src="//code.tidio.co/zt3euwjuh7kotpuqzihd1xvpsxgvoqgz.js" async></script>
    </body>

</html>