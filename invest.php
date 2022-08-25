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
$txid = $xid;

 
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
$d = time();




?>

<?php
$universal = @$_POST['universal'];
$status = 'pending';
$btype = 'trading';
$bplan = 'universal';
$bmul = 0.125;
$bmin = 3000;
$bmax = 5999;

if ($universal){
		$query = mysql_query("INSERT INTO investments VALUES ('','$user_id','$user_email','$btype','$bplan','$bmul','','$d','','pending','','$txid','$bmin','$bmax','','','no')");
		header("location:  inv.php");
}
?>

<?php
$standard = @$_POST['standard'];
$status = 'pending';
$ctype = 'trading';
$cplan = 'standard';
$cmul = 0.15;
$cmin = 6000;
$cmax = 29999;

if ($standard){
		$query = mysql_query("INSERT INTO investments VALUES ('','$user_id','$user_email','$ctype','$cplan','$cmul','','$d','','pending','','$txid','$cmin','$cmax','','','no')");
		header("location:  inv.php");
}

?>

<?php
$premium = @$_POST['premium'];
$status = 'pending';
$dtype = 'trading';
$dplan = 'premium';
$dmul = 0.175;
$dmin = 30000;
$dmax = 100000;

if ($premium){
		$query = mysql_query("INSERT INTO investments VALUES ('','$user_id','$user_email','$dtype','$dplan','$dmul','','$d','','pending','','$txid','$dmin','$dmax','','','no')");
		header("location:  inv.php");
}
?>

<?php
$clarke = @$_POST['clarke'];
$status = 'pending';
$etype = 'mining';
$eplan = 'clarke';
$emul = 1.3;
$emin = 6000;
$emax = 20000;

if ($clarke){
		$query = mysql_query("INSERT INTO investments VALUES ('','$user_id','$user_email','$etype','$eplan','$emul','','$d','','pending','','$txid','$emin','$emax','','','no')");
		header("location:  inv.php");
}
?>

<?php
$tardis = @$_POST['tardis'];
$status = 'pending';
$ftype = 'mining';
$fplan = 'tardis';
$fmul = 1.6;
$fmin = 20000;
$fmax = 50000;
if ($tardis){
		$query = mysql_query("INSERT INTO investments VALUES ('','$user_id','$user_email','$ftype','$fplan','$fmul','','$d','','pending','','$txid','$fmin','$fmax','','','no')");
		header("location:  inv.php");
}
?>

<?php
$hash = @$_POST['hash'];
$status = 'pending';
$gtype = 'mining';
$gplan = 'hash';
$gmul = 1.8;
$gmin = 50000;
$gmax = 100000;

if ($hash){
		$query = mysql_query("INSERT INTO investments VALUES ('','$user_id','$user_email','$gtype','$gplan','$gmul','','$d','','pending','','$txid','$gmin','$gmax','','','no')");
		header("location:  inv.php");
}
?>

<?php
$blackbox = @$_POST['blackbox'];
$status = 'pending';
$htype = 'mining';
$hplan = 'blackbox';
$hmul = 2;
$hmin = 100000;
$hmax = 250000;

if ($blackbox){
		$query = mysql_query("INSERT INTO investments VALUES ('','$user_id','$user_email','$htype','$hplan','$hmul','','$d','','pending','','$txid','$hmin','$hmax','','','no')");
		header("location:  inv.php");
}
?>
<!--

=========================================================
* Argon Dashboard - v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2019 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
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

<body class="">
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="./dashboard.php">
        <img src="./assets2/img/brand/blue.png" class="navbar-brand-img" alt="...">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="./assets2/img/theme/team-1-800x800.jpg
">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="profile.php" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>
            <a href="profile.php" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Settings</span>
            </a>
            <a href="transactions.php" class="dropdown-item">
              <i class="ni ni-calendar-grid-58"></i>
              <span>Transactions</span>
            </a>
            <a href="contact.php" class="dropdown-item">
              <i class="ni ni-support-16"></i>
              <span>Support</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="logout.php" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="./dashboard.php">
                <img src="./assets2/img/brand/blue.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Navigation -->
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
        <!-- Divider -->
        <hr class="my-3">
        <!-- Heading -->
        
      </div>
    </div>
  </nav>
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./dashboard.php">Dashboard</a>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="./assets2/img/theme/team-4-800x800.jpg">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?php echo ucwords($user_name);?></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="profile.php" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>
            <a href="profile.php" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Settings</span>
            </a>
            <a href="transactions.php" class="dropdown-item">
              <i class="ni ni-calendar-grid-58"></i>
              <span>Transactions</span>
            </a>
            <a href="contact.php" class="dropdown-item">
              <i class="ni ni-support-16"></i>
              <span>Support</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="logout.php" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
      </div>
    </nav>
    <!-- End Navbar -->
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
		<div class="text-center text-muted mb-4">
		<?php
$starter = @$_POST['starter'];
$status = 'pending';
$atype = 'fast';
$aplan = 'starter';
$amul = 0.10;
$amin = 100;
$amax = 2999;

if ($starter){
	$s_check = mysql_query("SELECT user_id FROM investments WHERE user_id = '$user_id' AND plan='starter' AND status='approved'");
	$sc_check = mysql_query("SELECT user_id FROM investments WHERE user_id = '$user_id' AND plan='starter' AND status='completed'");
	//Count the number of rows returned
	$starter_check = mysql_num_rows($s_check);
	$cstarter_check = mysql_num_rows($sc_check);
	$tstarter = $starter_check + $cstarter_check;
	
	if ($tstarter == 0) {
		$query = mysql_query("INSERT INTO investments VALUES ('','$user_id','$user_email','$atype','$aplan','$amul','','$d','','pending','','$txid','$amin','$amax','','','no')");
		header("location:  inv.php");
	}else{
		echo "<span style='color:red; font-size: 25px; line-height: 40px; margin: 10px;'>You can no longer invest in the Starter Plan. Please choose a higher plan to continue investing.</span>";
	}
}
?>
                <h2><big style="color:black;">Trading Plans</big></h2>
              </div>
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
		  <form role="form" method="POST">
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
						<span class="h2 font-weight-bold mb-0">Starter Plan</span>
                      <h4 ><br/>Min: $100<br/>Max: $2,999</h4>
                      
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <big><b><span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 10% after 48 hours</span></b></big><br/>
                    <span class="text-nowrap"> <input type="submit" class="btn btn-primary my-4" name="starter" id="starter" value="Invest Now" /><br/>Earn 5% Daily</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
						<span class="h2 font-weight-bold mb-0">Universal Plan</span>
						<h4 ><br/>Min: $3,000<br/>Max: $5,999</h4>
                      
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-blue text-white rounded-circle shadow">
                        <i class="fas fa-coins"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <big><b><span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 12.5% after 1 Week</span></b></big><br/>
                    <span class="text-nowrap"> <input type="submit" class="btn btn-primary my-4" name="universal" id="universal" value="Invest Now" /><br/>Earn 1.79% Daily</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
						<span class="h2 font-weight-bold mb-0">Standard Plan</span>
						<h4 ><br/>Min: $6,000<br/>Max: $29,999</h4>
                      
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-green text-white rounded-circle shadow">
                        <i class="fas fa-briefcase"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <big><b><span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 15% after 1 Week</span></b></big><br/>
                    <span class="text-nowrap"> <input type="submit" class="btn btn-primary my-4" name="standard" id="standard" value="Invest Now" /><br/>Earn 2.14% Daily</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
						<span class="h2 font-weight-bold mb-0">Premium Plan</span>
						<h4 ><br/>Min: $30,000<br/>Max: $100,000</h4>
                      
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fas fa-city"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <big><b><span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 17.5% after 1 Week</span></b></big><br/>
                    <span class="text-nowrap"> <input type="submit" class="btn btn-primary my-4" name="premium" id="premium" value="Invest Now" /><br/>Earn 2.5% Daily</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
		  </form>
        </div>
      </div>
    </div>
	<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
		<div class="text-center text-muted mb-4">
                <h2><big style="color:black;">Crypto Mining Plans</big></h2>
              </div>
       <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
		  <form role="form" method="POST">
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
						<span class="h2 font-weight-bold mb-0">BIT Clarke Mining</span>
                      <h4 ><br/>Min: $6,000<br/>Max: $20,000</h4>
                      
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-hand-holding"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <big><b><span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 130% after 30 days</span></b></big><br/>
                    <span class="text-nowrap"> <input type="submit" class="btn btn-primary my-4" name="clarke" id="clarke" value="Invest Now" /><br/>Hashing Power up to 300TH/s</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
						<span class="h2 font-weight-bold mb-0">BIT Tardis Mining</span>
						<h4 ><br/>Min: $20,000<br/>Max: $50,000</h4>
                      
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-blue text-white rounded-circle shadow">
                        <i class="fas fa-hand-holding-usd"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <big><b><span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 160% after 30 days</span></b></big><br/>
                    <span class="text-nowrap"> <input type="submit" class="btn btn-primary my-4" name="tardis" id="tardis" value="Invest Now" /><br/>Hashing Power up to 500TH/s</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
						<span class="h2 font-weight-bold mb-0">BIT Hash Mining</span>
						<h4 ><br/>Min: $50,000<br/>Max: $100,000</h4>
                      
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-green text-white rounded-circle shadow">
                        <i class="fab fa-bitcoin"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <big><b><span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 180% after 30 days</span></b></big><br/>
                    <span class="text-nowrap"> <input type="submit" class="btn btn-primary my-4" name="hash" id="hash" value="Invest Now" /><br/>Hashing Power up to 1000TH/s</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
						<span class="h2 font-weight-bold mb-0">BlackBox Mining</span>
						<h4 ><br/>Min: $100,000<br/>Max: $250,000</h4>
                      
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fab fa-btc"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <big><b><span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 200% after 30 days</span></b></big><br/>
                    <span class="text-nowrap"> <input type="submit" class="btn btn-primary my-4" name="blackbox" id="blackbox" value="Invest Now" /><br/>Hashing Power up to 1500TH/s</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
		  </form>
        </div>
      </div>
    </div>
    <div class="container-fluid mt--7">
      <!-- Footer -->
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2020 <a href="https://www.delhaizecointrade.com" class="font-weight-bold ml-1" target="_blank">DelhaizecoinTrade</a>
            </div>
            <div class="language-switcher-language-url" id="google_translate_element" role="navigation"></div>
          </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core   -->
  <script src="./assets2/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="./assets2/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--   Optional JS   -->
  <script src="./assets2/js/plugins/chart.js/dist/Chart.min.js"></script>
  <script src="./assets2/js/plugins/chart.js/dist/Chart.extension.js"></script>
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