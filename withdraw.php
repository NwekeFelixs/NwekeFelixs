<?php include ('header.inc.php');
/*if ($user) {
	
}else{
      die   ("Only for logged in users <a href='login.php'>Log in</a>");
}*/
?>
<?php

$connection_mysql = new mysqli("localhost","root","","requital");

if ($connection_mysql->connect_error){
    
    die("Connection failed:" .$Conn->connect_error);
}

$userp = mysqli_query($connection_mysql, "SELECT * FROM db_users WHERE refcode = '$user_id'");
$user_info = mysqli_fetch_assoc($userp);
$user_name = $user_info['name'];
$user_email = $user_info['email'];
$user_balance = $user_info['balance'];
$user_earnings = $user_info['earnings'];
$user_investments = $user_info['investments'];
$user_withdrawals = $user_info['withdrawals'];
$user_refb = $user_info['ref_bonus'];
$user_wal_type = $user_info['wallet_type'];
$user_wal_add = $user_info['wallet_address'];


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

<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Withdraw - Requital Finance
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
          <img src="./assets/img/logo2.png" />
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
              <h1 class="text-white">Withdraw</h1>
              <p class="text-lead text-light"><h2 style="color:white;"><b>Your Earnings are $<?php echo $user_earnings;?></b></h2></p>
			  <p class="text-lead text-light"></p>
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
$withd = @$_POST['withd'];
$amt = strip_tags(@$_POST['amt']);
$wtype =strip_tags(@$_POST['wtype']);
$wadd =strip_tags(@$_POST['wadd']);
$ag = strip_tags(@$_POST['agree']);



$ttype = 'withdrawal';
$d = time();
$status_p = 'pending';
$txid = $xid;

if ($withd) {
	if ($amt <= $user_earnings){
		if($amt&&$wtype&&$wadd){
			if($ag){
				$nwith = $amt + $user_withdrawals;
				$nearn = $user_earnings - $amt;
				$query = mysql_query("INSERT INTO withdrawals VALUES('', '$user_id', '$user_email', '$amt', '$wtype', '$wadd', '$status_p', '$d', '', '$txid')");
				$query = mysql_query("UPDATE users SET earnings='$nearn', wallet_type='$wtype', wallet_address='$wadd' WHERE id='$user_id'");
				$query = mysql_query("INSERT INTO transactions VALUES ('','$user_id','$txid','$user_email','$ttype','$amt','$d','','$status_p')");
				
$from = 'contact@delhaizecointrade.com'; 
$fromName = 'Requital Finance'; 
 
$subject = "Withdrawal"; 
 
$htmlContent = " 
    <html> 
    <head>
        <title>Withdrawal</title>
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
        <h2>Hello $user_name</h2>
		<h3>You have initiated a withdrawal of $$amt to the $user_wal_type wallet with the address $user_wal_add.</h3> 
		<p>Kindly be patient while the withdrawal is processed.</p>
		<p>Thanks</p><br/><br/>
        
            
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
mail($user_email, $subject, $htmlContent, $headers);

$toadmin ='jamesedm009@gmail.com';	
$from2 = 'contact@delhaizecointrade.com'; 
$fromName2 = 'Requital Finance'; 
 
$subject2 = "withdrawal"; 
 
$htmlContent2 = " 
    <html> 
    <head>
        <title>withdrawal</title>
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
        
		<h3>$user_name made a withdrawal of $$amt to $user_wal_type wallet with the address $user_wal_add.</h3> 
		
        
            
        <footer>
		Requital Finance<br/>
		contact@delhaizecointrade.com<br/>
		<a href='https://delhaizecointrade.com'>www.delhaizecointrade.com        
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
 
$subject3 = "Withdrawal"; 
 
$htmlContent3 = " 
    <html> 
    <head>
        <title>Withdrawal</title>
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
        
		<h3>$user_name made a withdrawal of $$amt to $user_wal_type wallet with the address $user_wal_add.</h3> 
		
        
            
        <footer>
		Requital Finance<br/>
		contact@delhaizecointrade.com<br/>
		<a href='https://delhaizecointrade.com'>www.delhaizecointrade.com        
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
				
				echo "<span style='color:#0af87b; font-size: 25px; line-height: 40px; margin: 10px;'><b>Successful Withdrawal</b><h2>Your withdrawal is awaiting approval</h2></span>";
			}else{
				echo "<span style='color:red; font-size: 20px; line-height: 30px; margin: 10px;'>You must agree to the terms of service</span>";
			}
		}else{
			echo "<span style='color:red; font-size: 20px; line-height: 30px; margin: 10px;'>Fill in all fields</span>";
		}
	}else{
		echo "<span style='color:red; font-size: 20px; line-height: 30px; margin: 10px;'>Amount must be less than or equal to $".$user_earnings."</span>";
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
                <big style="color:black;">Enter Amount to Withdraw</big><br/>
              </div>
              <form role="form" method="POST">
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                    </div>
                    <input style="color:black;" class="form-control" placeholder="Amount" type="number" name="amt" id="amt">
                  </div>
                </div>
				<div class="form-group">
                  <label class="form-control-label" for="input-wallet">Select Wallet Type:</label><br/>
						<select name="wtype" id="wtype" class="form-control form-control-alternative" placeholder="<?php echo $user_wal_type;?>">
						    <option value="<?php echo $user_wal_type;?>"><?php echo $user_wal_type;?></option>
							<option value="bitcoin">Bitcoin</option>	
							<option value="ethereum">Ethereum</option>
							<option value="litecoin">litecoin</option>
						</select>
                </div>
				<div class="form-group">
                  <div class="form-group">
                        <label class="form-control-label" for="input-address">Wallet Address:</label>
                        <input id="wadd" name="wadd" class="form-control form-control-alternative" placeholder="<?php echo $user_wal_add;?>" value="<?php echo $user_wal_add;?>" type="text">
                      </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id=" customCheckLogin" type="checkbox" name="agree">
                  <label class="custom-control-label" for=" customCheckLogin">
                    <span style="color:black;" >By clicking, you agree to the <a href="terms.html">terms</a></span>
                  </label>
                </div>
                <div class="text-center">
                  <input type="submit" class="btn btn-primary my-4" name="withd" id="withd" value="Withdraw" />
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
              © 2020 <a href="https://requitalfinance.com" class="font-weight-bold ml-1" target="_blank">Requital Finance </a>
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
   <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>
<script src="//code.tidio.co/ntjvqb8dbmfyhik3dknejkrzk3m67u7v.js" async></script>
</body>

</html>