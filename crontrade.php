<?php 
include("connect.inc.php");
ob_start();
session_start();
?>

<?php
$ftrades = mysql_query("SELECT * FROM investments WHERE status='approved' && type='fast'");/*i can still put type here*/

while ($frow = mysql_fetch_assoc($ftrades)){
	$ftype = $frow['type'];
	$fuserid = $frow['user_id'];
	$fuseremail = $frow['user_email'];
	$fmultiplier = $frow['multiplier'];
	$famount = $frow['amount'];
	$ftid = $frow['ixid'];
	$ftoget = $frow['to_get'];
	$fgotten = $frow['gotten'];
	$femailstat = $frow['email'];
	$fplan = $frow['plan'];
	
	$ftot = $fmultiplier * $famount;
	$ftota = $ftot + $famount;
	$fdaily = $ftota / 2;
	
	$fquserr = mysql_query("SELECT * FROM users WHERE id='$fuserid'");
		$fquser = mysql_fetch_assoc($fquserr);
		$fque = $fquser['earnings'];
		$fquename = $fquser['name'];
		$fqueemail = $fquser['email'];
		
		$fnewearn = $fque + $fdaily;
		$fnewgot = $fgotten + $fdaily;
	
	if ($fgotten < $ftoget) {
		$fquery = mysql_query("UPDATE users SET earnings='$fnewearn' WHERE id='$fuserid'");
		$fquery = mysql_query("UPDATE investments SET gotten='$fnewgot' WHERE ixid='$ftid'");
		/*SEND email with the amount earned*/

$ffrom = 'contact@delhaizecointrade.com'; 
$ffromName = 'Requital Finance'; 
 
$fsubject = "Investment Update"; 
 
$fhtmlContent = " 
    <html> 
    <head>
        <title>Investment Update</title>
			 <style>
      .img-container {
        text-align: center;
      }
    </style>
    </head> 
    <body> 
		<div class='img-container'> <!-- Block parent element -->
      <img src='https://delhaizecointrade.com/sgtlogo.png' alt='DelhaizecoinTrade'>
    </div>
        <h2>Hello $fquename</h2>
		<h3>Investment Update</h3> 
		<p>Your $fplan investment plan has yielded $$fdaily</p>
		<p>Login to your dashboard to view your earnings</p><br/><br/>
        
            
        <footer>
		DelhaizecoinTrade<br/>
		contact@delhaizecointrade.com<br/>
		<a href='https://delhaizecointrade.com'>www.delhaizecointrade.com       
        </footer>   
        
    </body> 
    </html>"; 
 
// Set content-type header for sending HTML email 
$fheaders = "MIME-Version: 1.0" . "\r\n"; 
$fheaders .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
 
// Additional headers 
$fheaders .= 'From: '.$ffromName.'<'.$ffrom.'>' . "\r\n"; 

 
// Send email 
mail($fqueemail, $fsubject, $fhtmlContent, $fheaders);

	}
	
	if ($fgotten >= $ftoget && $femailstat == 'no'){
		$fquery = mysql_query("UPDATE investments SET status='completed', email='yes' WHERE ixid='$ftid'");
		$fquery = mysql_query("UPDATE transactions SET status='completed' WHERE txid='$ftid'");
		
		/*Send email you have received your complete earnings, re invest to continue earning*/

$ffrom2 = 'contact@delhaizecointrade.com'; 
$ffromName2 = 'DelhaizecoinTrade'; 
 
$fsubject2 = "Investment Update"; 
 
$fhtmlContent2 = " 
    <html> 
    <head> 
        <title>Investment Update</title>
			 <style>
      .img-container {
        text-align: center;
      }
    </style>
    </head> 
    <body> 
		<div class='img-container'> <!-- Block parent element -->
      <img src='https://delhaizecointrade.com/sgtlogo.png' alt='DelhaizecoinTrade'>
    </div>
        <h2>Hello $fquename</h2>
		<h3>Investment Update</h3> 
		<p>Your $fplan investment plan has expired, it yielded a total of $$ftota</p>
		<p>Login to your dashboard to re-invest and continue earning</p><br/><br/>
        
            
        <footer>
		DelhaizecoinTrade<br/>
		contact@delhaizecointrade.com<br/>
		<a href='https://delhaizecointrade.com'>www.delhaizecointrade.com       
        </footer>   
        
    </body> 
    </html>"; 
 
// Set content-type header for sending HTML email 
$fheaders2 = "MIME-Version: 1.0" . "\r\n"; 
$fheaders2 .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
 
// Additional headers 
$fheaders2 .= 'From: '.$ffromName2.'<'.$ffrom2.'>' . "\r\n"; 

 
// Send email 
mail($fqueemail, $fsubject2, $fhtmlContent2, $fheaders2);
		
	}
}
?>

<?php
$trades = mysql_query("SELECT * FROM investments WHERE status='approved' && type='trading'");/*i can still put type here*/

while ($row = mysql_fetch_assoc($trades)){
	$type = $row['type'];
	$userid = $row['user_id'];
	$useremail = $row['user_email'];
	$multiplier = $row['multiplier'];
	$amount = $row['amount'];
	$tid = $row['ixid'];
	$toget = $row['to_get'];
	$gotten = $row['gotten'];
	$emailstat = $row['email'];
	$plan = $row['plan'];
	
	$tot = $multiplier * $amount;
	$tota = $tot + $amount;
	$daily = $tota / 7;
	
	$quserr = mysql_query("SELECT * FROM users WHERE id='$userid'");
		$quser = mysql_fetch_assoc($quserr);
		$que = $quser['earnings'];
		$quename = $quser['name'];
		$queemail = $quser['email'];
		
		$newearn = $que + $daily;
		$newgot = $gotten + $daily;
	
	if ($gotten < $toget) {
		$query = mysql_query("UPDATE users SET earnings='$newearn' WHERE id='$userid'");
		$query = mysql_query("UPDATE investments SET gotten='$newgot' WHERE ixid='$tid'");
		/*SEND email with the amount earned*/

$from = 'contact@delhaizecointrade.com'; 
$fromName = 'Requital Finance'; 
 
$subject = "Investment Update"; 
 
$htmlContent = " 
    <html> 
    <head>
        <title>Investment Update</title>
			 <style>
      .img-container {
        text-align: center;
      }
    </style>
    </head> 
    <body> 
		<div class='img-container'> <!-- Block parent element -->
      <img src='https://delhaizecointrade.com/sgtlogo.png' alt='DelhaizecoinTrade'>
    </div>
        <h2>Hello $quename</h2>
		<h3>Investment Update</h3> 
		<p>Your $plan investment plan has yielded $$daily</p>
		<p>Login to your dashboard to view your earnings</p><br/><br/>
        
            
        <footer>
		DelhaizecoinTrade<br/>
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
mail($queemail, $subject, $htmlContent, $headers);

	}
	
	if ($gotten >= $toget && $emailstat == 'no'){
		$query = mysql_query("UPDATE investments SET status='completed', email='yes' WHERE ixid='$tid'");
		$query = mysql_query("UPDATE transactions SET status='completed' WHERE txid='$tid'");
		
		/*Send email you have received your complete earnings, re invest to continue earning*/

$from2 = 'contact@delhaizecointrade.com'; 
$fromName2 = 'DelhaizecoinTrade'; 
 
$subject2 = "Investment Update"; 
 
$htmlContent2 = " 
    <html> 
    <head> 
        <title>Investment Update</title>
			 <style>
      .img-container {
        text-align: center;
      }
    </style>
    </head> 
    <body> 
		<div class='img-container'> <!-- Block parent element -->
      <img src='https://delhaizecointrade.com/sgtlogo.png' alt='DelhaizecoinTrade'>
    </div>
        <h2>Hello $quename</h2>
		<h3>Investment Update</h3> 
		<p>Your $plan investment plan has expired, it yielded a total of $$tota</p>
		<p>Login to your dashboard to re-invest and continue earning</p><br/><br/>
        
            
        <footer>
		DelhaizecoinTrade<br/>
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
mail($queemail, $subject2, $htmlContent2, $headers2);
		
	}
}
?>

<?php
$mines = mysql_query("SELECT * FROM investments WHERE status='approved' && type='mining'");/*i can still put type here*/

while ($mrow = mysql_fetch_assoc($mines)){
	$mtype = $mrow['type'];
	$muserid = $mrow['user_id'];
	$museremail = $mrow['user_email'];
	$mmultiplier = $mrow['multiplier'];
	$mamount = $mrow['amount'];
	$mtid = $mrow['ixid'];
	$mtoget = $mrow['to_get'];
	$mgotten = $mrow['gotten'];
	$memailstat = $mrow['email'];
	$mplan = $mrow['plan'];
	
	$mtot = $mmultiplier * $mamount;
	$mtota = $mtot + $mamount;
	$mdaily = $mtota / 30;
	
	$mquserr = mysql_query("SELECT * FROM users WHERE id='$muserid'");
		$mquser = mysql_fetch_assoc($mquserr);
		$mque = $mquser['earnings'];
		$mquename = $mquser['name'];
		$mqueemail = $mquser['email'];
		
		
		$mnewearn = $mque + $mdaily;
		$mnewgot = $mgotten + $mdaily;
	
	if ($mgotten < $mtoget) {
		$query = mysql_query("UPDATE users SET earnings='$mnewearn' WHERE id='$muserid'");
		$query = mysql_query("UPDATE investments SET gotten='$mnewgot' WHERE ixid='$mtid'");
		/*SEND email with the amount earned*/
		
$from3 = 'contact@delhaizecointrade.com'; 
$fromName3 = 'DelhaizecoinTrade'; 
 
$subject3 = "Investment Update"; 
 
$htmlContent3 = " 
    <html> 
    <head> 
        <title>Investment Update</title>
			 <style>
      .img-container {
        text-align: center;
      }
    </style>
    </head> 
    <body> 
		<div class='img-container'> <!-- Block parent element -->
      <img src='https://delhaizecointrade.com/sgtlogo.png' alt='DelhaizecoinTrade'>
    </div>
        <h2>Hello $mquename</h2>
		<h3>Investment Update</h3> 
		<p>Your $mplan investment plan has yielded $$mdaily</p>
		<p>Login to your dashboard to view your earnings</p><br/><br/>
        
            
        <footer>
		DelhaizecoinTrade<br/>
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
mail($mqueemail, $subject3, $htmlContent3, $headers3);
		
	}
	
	if ($mgotten >= $mtoget && $memailstat == 'no'){
		$query = mysql_query("UPDATE investments SET status='completed', email='yes' WHERE ixid='$mtid'");
		$query = mysql_query("UPDATE transactions SET status='completed' WHERE txid='$mtid'");
		
		/*Send email you have received your complete earnings, re invest to continue earning*/
		
$from4 = 'contact@delhaizecointrade.com'; 
$fromName4 = 'DelhaizecoinTrade'; 
 
$subject4 = "Investment Update"; 
 
$htmlContent4 = " 
    <html> 
    <head> 
        <title>Investment Update</title>
			 <style>
      .img-container {
        text-align: center;
      }
    </style>
    </head> 
    <body> 
		<div class='img-container'> <!-- Block parent element -->
      <img src='https://delhaizecointrade.com/sgtlogo.png' alt='DelhaizecoinTrade'>
    </div>
        <h2>Hello $mquename</h2>
		<h3>Investment Update</h3> 
		<p>Your $mplan investment plan has expired, it yielded a total of $$mtota</p>
		<p>Login to your dashboard to re-invest and continue earning</p><br/><br/>
        
            
        <footer>
		DelhaizecoinTradee<br/>
		contact@delhaizecointrade.com<br/>
		<a href='https://delhaizecointrade.com'>www.delhaizecointrade.com       
        </footer>   
        
    </body> 
    </html>"; 
 
// Set content-type header for sending HTML email 
$headers4 = "MIME-Version: 1.0" . "\r\n"; 
$headers4 .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
 
// Additional headers 
$headers4 .= 'From: '.$fromName4.'<'.$from4.'>' . "\r\n"; 

 
// Send email 
mail($mqueemail, $subject4, $htmlContent4, $headers4);
		
	}
}
?>