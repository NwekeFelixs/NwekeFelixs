<?php include ('header.inc.php');
if ($user) {
	
}else{
      die   ("Only for logged in users <a href='login.php'>Log in</a>");
}
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

<?php  
  $url = "https://bitpay.com/api/rates";

  @$json = file_get_contents($url);
  @$data = json_decode($json, TRUE);

  @$rate = $data[2]["rate"];   //$data[1] is outdated now, they have updated their json order. This new number 2 now fetches USD price.
  ?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Deposit - Requital Finance
  </title>
  <!-- Favicon -->
  <link href="./assets2/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="./assets2/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="./assets2/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="./assets2/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />
  
  
</head>

<body class="bg-default">
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand" href="dashboard.php">
          <img src="./assets/img/logo.png" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
          <!-- Collapse header -->
          <div class="navbar-collapse-header d-md-none">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="dashboard.php">
                  <img src="./assets/img/logo.png">
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
          <!-- Navbar items -->
          <ul class="navbar-nav">
          <li class="nav-item  class=" active" ">
          <a class=" nav-link active " href=" ./dashboard.php"> <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="deposit.php">
              <i class="ni ni-credit-card text-blue"></i> Deposit
            </a>
          </li>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="withdraw.php">
              <i class="ni ni-briefcase-24 text-green"></i> Withdraw
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="transactions.php">
              <i class="ni ni-bullet-list-67 text-red"></i> Transactions
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profile.php">
              <i class="ni ni-single-02 text-yellow"></i> Profile
            </a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="logout.php">
              <i class="ni ni-key-25 text-info"></i> Log out
            </a>
          </li>
        </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 class="text-white">Deposit</h1>
              <p class="text-lead text-light"><h2 style="color:white;">Our Minimum Deposit amount is $100.00</h2></p>
			  <p class="text-lead text-light"> Deposit may take up to 3 hours to reflect in your account. Please exercise patience while your transaction is processed after successful deposit.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
		  <?php
$pay = @$_POST['pay'];
$usd = strip_tags(@$_POST['ci']);
$btc = strip_tags(@$_POST['bi']);
$ag = strip_tags(@$_POST['agree']);

$connection_mysql = new mysqli("localhost","root","","requital");

if ($connection_mysql->connect_error){
    
    die("Connection failed:" .$Conn->connect_error);
}

$userd = mysqli_query($connection_mysql, "SELECT * FROM db_users WHERE refcode='$user_id'");
$user_infod = mysqli_fetch_assoc($userd);
$user_email = $user_infod['email'];
$user_id = $user_infod['refcode'];
$user_na = $user_infod['name'];

$txid = $xid;
$status = 'pending';
$type = 'deposit';
$d = time();

if ($pay) {
	if ($usd >= 100 && $btc != 0){
		if ($ag){
			$query = mysqli_query($connection_mysql, "INSERT INTO deposits VALUES ('','$user_idd','$user_email','$usd','$btc','$d','','$status','$txid')");
			$query = mysqli_query($connection_mysql, "INSERT INTO transactions VALUES ('','$user_idd', '$user_email','$type','$usd', '$txid', '$d','','$status')");
			
$from = 'contact@delhaizecointrade.com'; 
$fromName = 'Requital Finance'; 
 
$subject = "Deposit"; 
 
$htmlContent = " 
    <html> 
    <head>
        <title>Deposit</title>
			 <style>
      .img-container {
        text-align: center;
      }
    </style>
    </head> 
    <body> 
		<div class='img-container'> <!-- Block parent element -->
      <img src='assets/img/logo.png' alt='Requital Finance'>
    </div>
        <h2>Hello $user_na</h2>
		<h3>You have initiated a deposit of $$usd.</h3> 
		<p>Kindly transfer $btc BTC to 1BCzLH5HxxafpJ4abxssFXU6ULWoKog1k4 to complete the deposit.</p>
    <p>Kindly transfer Ethereum to 0x6849a1d7e823edf2dcc635a3fa2fb76c814ad992  to complete the deposit.</p>
    <p>Kindly transfer USDt to TVAqbPtUvDyL5PddB2eL9LBSUqNzvVCmtp -TRC 20 to complete the deposit.</p>
    <p>Thanks</p>
        
            
        <footer>
		Requital Finance <br/>
		contact@delhaizecointrade.com<br/>
		<a href='https://requitalfinance.com'>www.requitalfinance.com        
        </footer>   
        
    </body> 
    </html>"; 
 
// Set content-type header for sending HTML email 
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
 
// Additional headers 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 

 
// Send email 
mail($user_email, $subject, $htmlContent, $headers);

$toadmin ='tcgraden342@gmail.com';			
$from2 = 'contact@delhaizecointrade.com'; 
$fromName2 = 'Requital Finance '; 
 
$subject2 = "Deposit"; 
 
$htmlContent2 = " 
    <html> 
    <head>
        <title>Deposit</title>
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
        
		<h3>$user_na made a deposit of $$usd.</h3> 
		
        
            
        <footer>
		Requital Finance <br/>
		contact@delhaizecointrade.com<br/>
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
mail($toadmin, $subject2, $htmlContent2, $headers2);

$toadmin2 ='tcgraden342@gmail.com';			
$from3 = 'contact@delhaizecointrade.com'; 
$fromName3 = 'Requital Finance'; 
 
$subject3 = "Deposit"; 
 
$htmlContent3 = " 
    <html> 
    <head>
        <title>Deposit</title>
			 <style>
      .img-container {
        text-align: center;
      }
    </style>
    </head> 
    <body> 
		<div class='img-container'> <!-- Block parent element -->
      <img src='assets/img/logo.png' alt='Requital Finance'>
    </div>
        
		<h3>$user_na made a deposit of $$usd.</h3> 
		
        
            
        <footer>
		Requital Finance<br/>
		contact@delhaizecointrade.com<br/>
		<a href='https://requitalfinance.com'>www.requitalfinance.com        
        </footer>   
        
    </body> 
    </html>"; 
 
// Set content-type header for sending HTML email 
$headers3 = "MIME-Version: 1.0" . "\r\n"; 
$headers3 .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
 
// Additional headers 
$headers3 .= 'From: '.$fromName3.'<'.$from3.'>' . "\r\n"; 

 
// Send email 
mail($toadmin2, $subject3, $htmlContent3, $headers3);
			
			header("location:  invoice.php");
echo "<span style='color:#0af87b; font-size: 25px; line-height: 40px; margin: 10px;'><b>Successful Deposit</b><h3>Awaiting Confirmation, <a href='contact.php'>Contact us</a> with the details</h3></span>";
		}else{
			echo "<span style='color:red; font-size: 20px; line-height: 30px; margin: 10px;'>You must agree to the terms of service</span>";	
		}
	}else {
		echo "<span style='color:red; font-size: 20px; line-height: 30px; margin: 10px;'>The minimum deposit is $500</span>";
	}
}
?>
            <!--<div class="card-header bg-transparent pb-5">
              <div class="text-muted text-center mt-2 mb-3"><small>Sign in with</small></div>
              <div class="btn-wrapper text-center">
                <a href="#" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--icon"><img src="./assets2/img/icons/common/github.svg"></span>
                  <span class="btn-inner--text">Github</span>
                </a>
                <a href="#" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--icon"><img src="./assets2/img/icons/common/google.svg"></span>
                  <span class="btn-inner--text">Google</span>
                </a>
              </div>
            </div>-->
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small style="color:black;">Enter Deposit Amount</small>
              </div>
              <form role="form" method="POST">
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                    </div>
                    <input style="color:black;" class="form-control" placeholder="USD" type="number" name="ci" id="ci" onchange="usdConvert(this);" onkeyup="usdConvert(this);">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fab fa-btc"></i></span>
                    </div>
                    <input style="color:black;" class="form-control" placeholder="Bitcoin" type="text" name="bi" id="bi" onchange="btcConvert(this);" onkeyup="btcConvert(this);">
                  </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id=" customCheckLogin" type="checkbox" name="agree">
                  <label class="custom-control-label" for=" customCheckLogin">
                    <span style="color:black;" >By clicking, you agree to the <a href="terms.html">terms</a></span>
                  </label>
                </div>
                <div class="text-center">
                  <input type="submit" class="btn btn-primary my-4" name="pay" id="pay" value="Pay" />
                </div>
              </form>
            </div>
          </div>
         <!-- <div class="row mt-3">
            <div class="col-6">
              <a href="#" class="text-light"><small>Forgot password?</small></a>
            </div>
            <div class="col-6 text-right">
              <a href="#" class="text-light"><small>Create new account</small></a>
            </div>
          </div>-->
        </div>
      </div>
    </div>
    <footer class="py-5">
      <div class="container">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              © 2020 <a href="https://requitalfinance.com" class="font-weight-bold ml-1" target="_blank">Requital Finance</a>
            </div>
            <div class="language-switcher-language-url" id="google_translate_element" role="navigation"></div>
          </div>
          </div>
          <!--<div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
              </li>
            </ul>
          </div>-->
        </div>
      </div>
    </footer>
  </div>
  <!--   Core   -->
  <script src="./assets2/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="./assets2/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--   Optional JS   -->
  <!--   Argon JS   -->
  <script src="./assets2/js/argon-dashboard.min.js?v=1.1.0"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script>
  <script>
function btcConvert(input){
	if (isNaN(input.value)){
	input.value = 0;
	}
	var price = "<?php echo $rate; ?>";
	var output = input.value * price;
	var co = document.getElementById('ci');
	ci.value=output.toFixed(2);
}
function usdConvert(input){
	if (isNaN(input.value)){
	input.value = 0;
	}
	var price2 = "<?php echo $rate; ?>";
	var output2 = input.value / price2;
	var co2 = document.getElementById('bi');
	bi.value=output2.toFixed(8);
}
</script>
 <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>
<script src="//code.tidio.co/ntjvqb8dbmfyhik3dknejkrzk3m67u7v.js" async></script>
</body>

</html>