<?php include ('header.inc.php');
if ($user) {
	
}else{
      die   ("Only for logged in users <a href='login.php'>Log in</a>");
}
?>
<?php
$userp = mysql_query("SELECT * FROM users WHERE $user_id=id");
$user_info = mysql_fetch_assoc($userp);
$user_name = $user_info['name'];
$user_email = $user_info['email'];
$user_balance = $user_info['balance'];
$user_earnings = $user_info['earnings'];
$user_investments = $user_info['investments'];
$user_withdrawals = $user_info['withdrawals'];
$user_refb = $user_info['ref_bonus'];
$upliner = $user_info['upliner_id'];

$uplinep = mysql_query("SELECT * FROM users WHERE $upliner=id");
$upline_info = mysql_fetch_assoc($uplinep);
$upline_earnings = $upline_info['earnings'];
$upline_bal = $upline_info['balance'];
$upline_refb = $upline_info['ref_bonus'];

$totbal = $user_earnings + $user_balance;


?>

<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Invest - Requital Finance
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
          <img src="./assets2/img/brand/white.png" />
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
                  <img src="./assets2/img/brand/blue.png">
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
            <a class="nav-link " href="invest.php">
              <i class="ni ni-money-coins text-orange"></i> Invest
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
              <h1 class="text-white">Invest</h1>
              <p class="text-lead text-light"><h2 style="color:white;"><b>Your Balance is $<?php echo $user_balance;?></b></h2></p>
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
$invest = @$_POST['invest'];
$amt = strip_tags(@$_POST['amt']);
$ag = strip_tags(@$_POST['agree']);


$userinv = mysql_query("SELECT * FROM investments WHERE $user_id=user_id ORDER BY id DESC LIMIT 1");
$userin = mysql_fetch_assoc($userinv);
$d = $userin['time_created'];
$txid = $userin['ixid'];
$min = $userin['min'];
$max = $userin['max'];
$mul = $userin['multiplier'];


$ttype = 'investment';
$dd = time();
$status_c = 'approved';

if ($invest) {
	if ($amt <= $totbal){
		if($amt >= $min && $amt <= $max){
			if($ag){
				$tot = $mul * $amt;
				$totamt = $tot + $amt;
				$toget = $totamt - 0.5;
				$refamt = $amt * 0.10;
				$upbal = $upline_bal + $refamt;
				$upref = $upline_refb + $refamt;
				$ninv = $amt + $user_investments;
				$nearn = $user_earnings - $amt;
				if($nearn < 0){
					$nbal = $user_balance + $nearn;
					$nearn = 0;
				}else{
					$nearn = $nearn;
					$nbal = $user_balance;
				}
				$query = mysql_query("UPDATE investments SET amount='$amt', time_updated='$dd', status='$status_c', to_get='$toget' WHERE ixid='$txid'");
				$query = mysql_query("UPDATE users SET earnings='$nearn', balance='$nbal', investments='$ninv' WHERE id='$user_id'");
				$query = mysql_query("INSERT INTO transactions VALUES ('','$user_id','$txid','$user_email','$ttype','$amt','$d','$dd','$status_c')");
				
				echo "<span style='color:#0af87b; font-size: 25px; line-height: 40px; margin: 10px;'><b>Investment Successful</b><h2>Go to<a href='dashboard.php'> Dashboard</a></h2></span>";
			}else{
				echo "<span style='color:red; font-size: 20px; line-height: 30px; margin: 10px;'>You must agree to the terms of service</span>";
			}
		}else{
			echo "<span style='color:red; font-size: 20px; line-height: 30px; margin: 10px;'>Amount must be within $".$min." - $".$max."</span>";
		}
	}else{
		echo "<span style='color:red; font-size: 20px; line-height: 30px; margin: 10px;'>Amount must be less than or equal to $".$totbal." Deposit to increase your balance</span>";
	}
}
?>

            <!--<div class="card-header bg-transparent pb-5">
              <div class="text-muted text-center mt-2 mb-3"><small>Sign in with</small></div>
              <div class="btn-wrapper text-center">
                <a href="#" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--icon"><img src="./assets/img/icons/common/github.svg"></span>
                  <span class="btn-inner--text">Github</span>
                </a>
                <a href="#" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--icon"><img src="./assets/img/icons/common/google.svg"></span>
                  <span class="btn-inner--text">Google</span>
                </a>
              </div>
            </div>-->
<?php
$t_check = mysql_query("SELECT txid FROM transactions WHERE txid='$txid'");

$txid_check = mysql_num_rows($t_check);

 if ($txid_check == 0){
	 echo '<div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <big style="color:black;">Enter Amount to Invest</big><br/>
				<small style="color:black;">Minimum: $'.$min.'</small><br/>
				<small style="color:black;">Maximum: $'.$max.'</small>
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
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id=" customCheckLogin" type="checkbox" name="agree">
                  <label class="custom-control-label" for=" customCheckLogin">
                    <span style="color:black;" >By clicking, you agree to the <a href="terms.html">terms</a></span>
                  </label>
                </div>
                <div class="text-center">
                  <input type="submit" class="btn btn-primary my-4" name="invest" id="invest" value="Invest" />
                </div>
              </form>
            </div>';
 }else{
	 
 }
			
?>
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
              © 2020 <a href="https://delhaizecointrade.com" class="font-weight-bold ml-1" target="_blank">Requital Finance</a>
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
<script src="//code.tidio.co/zt3euwjuh7kotpuqzihd1xvpsxgvoqgz.js" async></script>
</body>

</html>