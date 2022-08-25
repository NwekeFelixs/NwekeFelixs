<?php include("header.inc.php");?>

<?php

$connection_mysql = new mysqli("localhost","root","","requital");

if ($connection_mysql->connect_error){
    
    die("Connection failed:" .$Conn->connect_error);
}

// $select_db = mysqli_select_db($connection_mysql, 'requital') or die ('Error');

  @$ref = $_GET['ref'];
	  $result = mysqli_query($connection_mysql, "SELECT refcode FROM db_users WHERE refcode='$ref'");
      if ($result === FALSE){
      die (mysqli_error($connection_mysql));}
	  $uplid = mysqli_fetch_assoc($result);
	  $upliner = $uplid['refcode'];
	  
   if ($ref == ''){
	  $ref = 1;
  }else{
	  $ref = $upliner;
  }
  
  $refinfo = mysqli_query($connection_mysql, "SELECT * FROM db_users WHERE refcode='$ref'");
  if ($refinfo === FALSE){
    die (mysqli_error($connection_mysql));}
	  $refinf = mysqli_fetch_assoc($refinfo);
      //print_r($uplid);
	//   $refname = $refinf['name'];
	//   $refemail = $refinf['email'];

?>

<?php
 
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 
function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
}
 

$xid = generate_string($permitted_chars, 10);


 
?>

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

        <title>Register - Requital Finance</title>

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

                                    <h3>Open up your Requital Finance Account now</h3>
                                    <p>Already signed up? <a href="login.php">Log in</a></p>
									<?php
$reg = @$_POST['reg'];
//declaring variables to prevent errors
$n = ""; //Full Name
$em = ""; //Email
$ag = ""; //agree term
$d = ""; // Sign up Date
$ph = ""; //Phone
$e_check = "";
$n = strip_tags(@$_POST['name']);
$em = strip_tags(@$_POST['email']);
$ag = strip_tags(@$_POST['agree']);
$pswd = strip_tags(@$_POST['password']);
$pswd2 = strip_tags(@$_POST['password2']);
$d = time(); // Year - Month - Day
$ph = strip_tags(@$_POST['phone']);
$refcode = $xid;

if ($reg) {
	//Check whether Email already exists in the database
$e_check = mysqli_query($connection_mysql, "SELECT email FROM db_users WHERE email='$em'");
//Count the number of rows returned
$email_check = mysqli_num_rows($e_check);

 if ($email_check == 0) {
//check all of the fields have been filed in
if ($n&&$em&&$pswd&&$pswd2&&$ph) {
// check that passwords match
if ($pswd==$pswd2) {
	if ($ag) {
// check the maximum length of username/first name/last name does not exceed 25 characters
if (strlen($n)>50) {
echo "<span style='color:red; font-size: 35px; line-height: 40px; margin: 10px;'>The maximum limit for Your name is 50 characters!</span>";
}
else
{
// check the maximum length of password does not exceed 25 characters and is not less than 5 characters
if (strlen($pswd)>30||strlen($pswd)<1) {
echo "<span style='color:red; font-size: 25px; line-height: 40px; margin: 10px;'>Your password must be between 1 and 30 characters long!</span>";
}
else
{
//encrypt password and password 2 using md5 before sending to database
$pswd = md5($pswd);
$pswd2 = md5($pswd2);
$query = "INSERT INTO db_users VALUES ('$refcode','$n','$em','$ag', '$d', '$ph', '$pswd', '', '', '', '', '', '', '', '', '' )";

// ('$ref','$n','$em','$ph','$pswd','$d','$refcode'))";
if ($connection_mysql->query($query) === TRUE){

    // }else{
    //     echo 'Error: ' .$query. '<br>' .$connection_mysql->error;
    }
/*Send email to new user, send email to the referral*/


$from = 'contact@delhaizecointrade.com'; 
$fromName = 'Requital Finance'; 
 
$subject = "Welcome to Requital Finance"; 
 
$htmlContent = " 
    <html> 
    <head>
        <title>Welcome to Requital Finance</title>
			 <style>
      .img-container {
        text-align: center;
      }
    </style>
    </head> 
    <body> 
		<div class='img-container'> <!-- Block parent element -->
      <img src='assets/img/logo.png' alt='Requital'>
    </div>
        <h3>Hello $n,</h3>
		<h4>Thank you for joining Requital Finance.</h4> 
		<p>We will help you achieve your dreams in Trading. We have the best trading experts who are ready to serve you.</p>
		<p>Simply Deposit, Choose an investment plan, Invest and Earn.</p><br/><br/>
        
            
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

$from2 = 'contact@delhaizecointrade.com'; 
$fromName2 = 'Requital Finance'; 
 
$subject2 = "New Referral"; 
 
$htmlContent2 = " 
    <html> 
    <head> 
        <title>New Referral</title>
			 <style>
      .img-container {
        text-align: center;
      }
    </style>
    </head> 
    <body> 
		<div class='img-container'> <!-- Block parent element -->
      <img src='https://delhaizecointrade.com/sgtlogo.png' alt='delhaizecoin'>
    </div>
        <h2>Hello $n</h2>
		<h3>$n just registered using your referral link.</h3> 
		<p>Guide your referral to success.</p>
		<p>Thanks for partnering with us.</p><br/><br/>
        
            
        <footer>
		Requital Finance<br/>
		contact@requitalfinance.com<br/>
		<a href='https://requitalfinance.com'>www.requitalfinance.com        
        </footer>   
        
    </body> 
    </html>"; 
 
// Set content-type header for sending HTML email 
$headers2 = "MIME-Version: 1.0" . "\r\n"; 
$headers2 .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
 
// Additional headers 
$headers2 .= 'From: '.$fromName2.'<'.$from2.'>' . "\r\n"; 

 
// Send email 
mail($em, $subject2, $htmlContent2, $headers2);

echo "<span style='color:#0af87b; font-size: 20px; line-height: 30px; margin: 10px;'>Welcome to Requital Finance.<a href='login.php'>Log in</a></span>";
}
}
}else{
echo "<span style='color:red; font-size: 25px; line-height: 40px; margin: 10px;'>You must agree to the terms of service</span>";	
}
}
else {
echo "<span style='color:red; font-size: 25px; line-height: 40px; margin: 10px;'>The passwords do not match</span>";
}
}
else
{
echo "<span style='color:red; font-size: 25px; line-height: 40px; margin: 10px;'>Please fill in all fields</span>";
}
}
else
{
 echo "<span style='color:red; font-size: 25px; line-height: 40px; margin: 10px;'>This email has been used</span>";
}
}

?>

                                    <form method="POST" id="form1">
										<div class="form-group">
                                            <input type="text" name="name" id="name" placeholder="Your full name" class="form-control" required="">
                                        </div>
										
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" placeholder="Your email address" class="form-control" required="">
                                        </div>
										
										<div class="form-group">
                                            <input type="text" name="phone" id="phone" placeholder="Your phone number" class="form-control" required="">
                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="password" id="password" placeholder="Create a password" class="form-control" required="">
                                        </div>
										
										<div class="form-group">
                                            <input type="password" name="password2" id="password2" placeholder="Confirm password" class="form-control" required="">
                                        </div>
										
										<div class="form-group">
											<input type="checkbox" name="agree" id="agree-term" class="agree-term" required=""/> I agree to all statements in  <a href="terms.html" class="term-service">Terms of service</a>
										</div>
										
										<div class="form-group">
											<input type="submit" name="reg"  value="Register" class=""/>
										</div>


                                        

                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div class="language-switcher-language-url" id="google_translate_element" role="navigation"></div>
        </section>
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