<?php include ('adheader.inc.php');
if ($admin) {
	
}else{
      die   ("Only for logged in ads <a href='adlog.php'>Log in</a>");
}
?>
<?php

$connection_mysql = new mysqli("localhost","root","","requital");

if ($connection_mysql->connect_error){
    
    die("Connection failed:" .$Conn->connect_error);
}

$adminp = mysqli_query($connection_mysql, "SELECT * FROM administrator WHERE refcode = '$admin_id'");
$admin_info = mysqli_fetch_assoc($adminp);
// $admin_email = $admin_info['email'];




?>

<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Requital Finance - Ad
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
      <a class="navbar-brand pt-0" href="dashboard.php">
        <img src="./assets/img/logo.png" class="navbar-brand-img" alt="...">
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
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="dashboard.php">
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
          <a class=" nav-link active " href=" ./addash.php"> <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="addepos.php">
              <i class="ni ni-credit-card text-blue"></i> Deposits
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="adinvests.php">
              <i class="ni ni-money-coins text-orange"></i> Investments
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="adwithds.php">
              <i class="ni ni-briefcase-24 text-green"></i> Withdrawals
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="addash.php">
              <i class="ni ni-bullet-list-67 text-red"></i> Transactions
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="dashboard.php">Tables</a>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="./assets2/img/theme/team-4-800x800.jpg">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?php echo $admin_id;?></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="profile.html" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>
              <a href="profile.html" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>Settings</span>
              </a>
              <a href="profile.html" class="dropdown-item">
                <i class="ni ni-calendar-grid-58"></i>
                <span>Activity</span>
              </a>
              <a href="profile.html" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Support</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#!" class="dropdown-item">
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
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Balance</h5>
                      <span class="h2 font-weight-bold mb-0">USD <?php ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-wallet"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Investments</h5>
                      <span class="h2 font-weight-bold mb-0">USD <?php ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Earnings</h5>
                      <span class="h2 font-weight-bold mb-0">USD <?php ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fas fa-percent"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Withdrawals</h5>
                      <span class="h2 font-weight-bold mb-0">USD <?php ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                        <i class="fab fa-btc"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>-->
    <div class="container-fluid mt--7">
      <!-- Dark table -->
      <div class="row mt-5">
        <div class="col">
          <div class="card bg-default shadow">
            <div class="card-header bg-transparent border-0">
              <h3 class="text-white mb-0">Transactions</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-dark table-flush">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Type</th>
                    <th scope="col">Amount</th>
                    <th scope="col">ID</th>
					<th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
				<?php
$transact = mysqli_query($connection_mysql, "SELECT * FROM transactions WHERE type='investment' ORDER BY refcode DESC");
$numrows = mysqli_num_rows($transact);
if ($numrows >= 1) {
	

		while ($row = mysqli_fetch_assoc($transact)) {
	$dtt = $row['time_created'];
	$ttyp = $row['type'];	
	$amt = $row['amount'];
	$tid = $row['txid'];
	$status = $row['status'];
	$tmail = $row['user_email'];
	$utid = $row['user_id'];
	
	$tttname= mysqli_query($connection_mysql, "SELECT * FROM db_users WHERE refcode ='$utid'");
		$ttname = mysqli_fetch_assoc($tttname);
		$tname = $ttname['name'];
	
	@$dt = date('d M Y @ H:i:s', $dtt);
	$nd = time();
	
	if (isset($_POST['complete'.$tid])) {
		
		$tuser = mysqli_query($connection_mysql, "SELECT * FROM transactions WHERE txid='$tid'");
		$ttuser = mysqli_fetch_assoc($tuser);
		$tuserid = $ttuser['user_id'];
		$tamt = $ttuser['amount'];
		
		$quserr = mysqli_query($connection_mysql, "SELECT * FROM db_users WHERE refcode ='$tuserid'");
		$quser = mysqli_fetch_assoc($quserr);
		$qub = $quser['balance'];
		$quw = $quser['withdrawals'];
		$que = $quser['earnings'];
		$qui = $quser['investments'];
		
		$newearnings = $que - $tamt;
		$newwith = $quw + $tamt;
		$newinv = $qui - $tamt;
		
		$query = mysqli_query($connection_mysql,  "UPDATE investments SET status='completed', time_updated='$nd' WHERE ixid='$tid'");
		$query = mysqli_query($connection_mysql, "UPDATE transactions SET status='completed', time_updated='$nd' WHERE txid='$tid'");
		$query = mysqli_query($connection_mysql, "UPDATE db_users SET investments='$newinv' WHERE id='$tuserid'");
		/*put email code*/
		header ("location: adinvests.php");
	}
	
		if (isset($_POST['decline'.$tid])) {
		
		$duser = mysqli_query($connection_mysql, "SELECT * FROM transactions WHERE txid='$tid'");
		$dtuser = mysqli_fetch_assoc($duser);
		$duserid = $dtuser['user_id'];
		$damt = $dtuser['amount'];
		
		$duserr = mysqli_query($connection_mysql, "SELECT * FROM db_users WHERE refcode='$duserid'");
		$duser = mysqli_fetch_assoc($duserr);
		$dub = $duser['balance'];
		$duw = $duser['withdrawals'];
		$due = $duser['earnings'];
		$dui = $duser['investments'];
		$duena = $duser['name'];
		$dueem = $duser['email'];
		
		$dnewearnings = $due + $damt;
		$dnewwith = $duw + $damt;
		$dnewbal = $dub + $damt;
		
		$query = mysqli_query($connection_mysql, "UPDATE investments SET status='declined', time_updated='$nd' WHERE ixid='$tid'");
		$query = mysqli_query($connection_mysql, "UPDATE transactions SET status='declined', time_updated='$nd' WHERE txid='$tid'");
		$query = mysqli_query($connection_mysql, "UPDATE db_users SET balance='$dnewbal' WHERE refcode ='$duserid'");
		/*put email code your withdrawal was declined and the amount has been added to your earnings*/
		
		$from2 = 'contact@delhaizecointrade.com'; 
$fromName2 = 'Delhaizecoin Trade '; 
 
$subject2 = "Deposit Update"; 
 
$htmlContent2 = " 
    <html> 
    <head>
        <title>Deposit Update</title>
			 <style>
      .img-container {
        text-align: center;
      }
    </style>
    </head> 
    <body> 
		<div class='img-container'> <!-- Block parent element -->
      <img src='https://delhaizecointrade.com/sgtlogo.png' alt='Delhaizecoin Trade'>
    </div>
        <h2>Hello $duena</h2>
		<h3>Your investment of $$damt was declined.</h3> 
		<p>Contact us to find out why.</p>
		<p>Sorry for any inconveniences this may have caused.</p><br/><br/>
        
            
        <footer>
		Delhaizecoin Trade <br/>
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
mail($dueem, $subject2, $htmlContent2, $headers2);
		
		header ("location: adinvests.php");
	}
	
	
	if ($status == 'pending'){
		$nstat = '<span class="badge badge-dot mr-4">
                        <i class="bg-warning"></i> pending
                      </span>';
	}elseif ($status == 'approved'){
		$nstat = '<span class="badge badge-dot">
                        <i class="bg-success"></i> approved
                      </span>';
	}elseif ($status == 'completed'){
		$nstat = '<span class="badge badge-dot">
                        <i class="bg-info"></i> completed
                      </span>';
	}elseif ($status == 'declined'){
		$nstat = '<span class="badge badge-dot mr-4">
                        <i class="bg-danger"></i> declined
                      </span>';
	}
echo '<tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="mb-0 text-sm">'.$dt.'</span>
                        </div>
                      </div>
                    </th>
                    <td>
                      '.$ttyp.'
                    </td>
                    <td>
                      '.$amt.'
                    </td>
                    <td>
                      '.$tid.'
                    </td>
					<td>
                      '.$tname.'
                    </td>
                    <td>
                      '.$nstat.'
                    </td>
					   <td class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
						<form action="adinvests.php" method="POST">
                          <input type="submit" name="complete'.$tid.'" value="Complete"/><br/>
                          <input type="submit" name="decline'.$tid.'" value="Decline"/>
						</form>
                        </div>
                      </div>
                    </td>
                  </tr>';	
}
}else{
	
}

?>
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      
    </div>
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
</body>

</html>