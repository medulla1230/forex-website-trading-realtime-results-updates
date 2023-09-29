<?php
//Functions included in this file
//function to establish a connection to MySQL and selecting a database to work
function dbconnectold()
{
	global $siteadds,$dbhost,$dbname,$dbuser,$dbpwd;
	if($link = mysql_connect($dbhost,$dbuser,$dbpwd))
	{
		$res=mysql_select_db($dbname) or die(mysql_error());
		if($res)
			return $link;
	}
	else
		print "There is some internal error in retrieving the records. Sorry for the inconvinence.";
}

//function to establish a connection to MySQL and selecting a database to work
function dbconnect()
{
	global $siteadds,$dbhost,$dbname,$dbuser,$dbpwd;
	if($link = mysqli_connect($dbhost,$dbuser,$dbpwd,$dbname))
	{
		// Check connection
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			return;
		}
		return $link;
	}
	else
		print "There is some internal error in retrieving the records. Sorry for the inconvinence.";
}
//function  to close the opened link
function dbclose($link)
{
	global $link;
	if(mysqli_close($link))
	{}
}


//Show main page
function showMain()
{
	global $pagekeywords, $pagedesc, $pagetitle, $pagecontent, $sitename, $baseurl, $noreply_mail,$link;
	$pagekeywords = "";
	$pagedesc = "";
	$pagetitle = "Publish your forex reports on your website";

	
	$pagecontent .= <<<HTM
<table align="center" border="0" cellpadding="10" cellspacing="0" width="1200">
	
		
	<tr>
		<td align="center" valign="top" colspan="3">
			<p><b>Latest trades recorded:</b></p>
			<p>Here are some of the latest trades recorded:</p>
HTM;

			$pagecontent .= buildTradesTable("","",0,100,"closed");

	$pagecontent .= <<<HTM

		</td>
	</tr>
</table>	
HTM;

}


//Show users accounts
function userReports($uidvalue)
{
	global $pagekeywords, $pagedesc, $pagetitle, $pagecontent, $sitename, $baseurl, $noreply_mail, $link;
	$pagekeywords = "";
	$pagedesc = "";
	$pagetitle = "Reports for user - $uidvalue";

	$pagecontent .= "<p><b><a href=trades.php>Home</a> -> User - <i>$uidvalue</i></b></p>";

	//First find how many accounts are under this user ID
	$totalaccounts = 0;
	$q="SELECT DISTINCT(uacc) FROM fxrp_trades WHERE uid = '$uidvalue'";
	if($r=mysqli_query($link,$q))
	{
		while($udata = mysqli_fetch_array($r))
		{
			$pagecontent .= "<p>User account - <a href=trades.php?a=userAccount&uid=$uidvalue&uacc=$udata[0]>$udata[0]</a>";
			$totalaccounts++;
		}
	}
	else
	{
		$pagecontent .= mysql_error();
	}

	if($totalaccounts == 0)
	{
		$pagecontent .= "<p>No accounts found. Make sure the EA is setup correctly as per the installation guide.</p>";
	}
}

//Show report for an account
function userAccount($uidvalue, $uaccvalue)
{
	global $pagekeywords, $pagedesc, $pagetitle, $pagecontent, $sitename, $baseurl, $noreply_mail, $link;
	$pagekeywords = "";
	$pagedesc = "";
	$pagetitle = "Statement for account $uaccvalue for user - $uidvalue";

	
	//URL for the chart for account balance
	$accBalChartURLSmall = "trades.php?a=showChart&uid=$uidvalue&uacc=$uaccvalue&charttype=acc_bal&cw=600&ch=350";

	$accBalChartURLBig = "trades.php?a=showChart&uid=$uidvalue&uacc=$uaccvalue&charttype=acc_bal&cw=1200&ch=900";
	
	//Initialize variables
	$initdeposit = 0;
	$initdepositfont = "#009900";
	$currentBalance = 0;
	$total_open_pl = 0;
	$total_open_trades = 0;
	$total_net_profit = 0;
	$total_closed_trades = 0;
	$total_all_trades = 0;
	$total_winners = 0;
	$total_loosers = 0;
	$total_winnings = 0;
	$total_losses = 0;
	$total_trading_cost = 0;
	$tradingcostfont = "#FF3333";
	$avepertradefontcolor = "";
	$average_per_trade = 0;
	
	//Loop through the total trades history
	$q="SELECT * FROM fxrp_trades WHERE uid = '$uidvalue' AND uacc = '$uaccvalue' ORDER BY open_time ASC";
	if($r=mysqli_query($link,$q))
	{
		$loopcounter = 0;
		while($uaccdata = mysqli_fetch_array($r))
		{
			//Read the initial deposit
			if($loopcounter == 0) 
			{
				//$initdeposit = $uaccdata['acc_bal'];
				$firstdatestamp = $uaccdata['open_time'];
			}
			//Read current balance
			$currentBalance = $uaccdata['acc_bal'];
			//Last trade open date
			$lastdatestamp = $uaccdata['open_time'];
			//Currency
			$acurr = $uaccdata['curr'];
			//Last updated
			$lastupdatedtimestamp = $uaccdata['lastupd'];
			//Open P/L
			if($uaccdata['type'] == '0'
				OR $uaccdata['type'] == '1'
				OR $uaccdata['type'] == '2'
				OR $uaccdata['type'] == '3'
				OR $uaccdata['type'] == '4'
				OR $uaccdata['type'] == '5' 
			)
			{
				$total_all_trades++;
				if($uaccdata['status'] == 'open')
				{
					$total_open_pl = $total_open_pl + $uaccdata['net_profit'];
					$total_open_trades++;
				}
				
				if($uaccdata['status'] == 'closed')
				{
					$total_net_profit = $total_net_profit + $uaccdata['net_profit'];
					$total_closed_trades++;
					//Winners
					if($uaccdata['net_profit'] > 0) 
					{
						$total_winners++;
						$total_winnings = $total_winnings + $uaccdata['net_profit'];
					}
					else 
					{
						$total_loosers++;
						$total_losses = $total_losses + $uaccdata['net_profit'];
					}
				}
			}
			else
			{
				$total_trading_cost = $total_trading_cost + $uaccdata['net_profit'];

			}
			$loopcounter++;
		}
		
		// Starting balance
		$initdeposit = $currentBalance - $total_net_profit - $total_trading_cost;
		
		if($total_open_pl >= 0) { $openprofitfontcolor = "#009900"; }
		else { $openprofitfontcolor = "#FF3333"; }		
		
		if($total_net_profit >= 0) { $profitfontcolor = "#009900"; }
		else { $profitfontcolor = "#FF3333"; }		

		if($total_all_trades >= 0) { $pointfontcolor = "#009900"; }
		else { $pointfontcolor = "#FF3333"; }	
		
		$datediff = time() - strtotime($firstdatestamp);
		$datediffdays = floor($datediff/(60*60*24));
		$datediffhours = $datediff - $datediffdays * (60*60*24);
		$datediffhours = floor($datediffhours/(60*60));
		$datediffmins = $datediff - $datediffdays * (60*60*24) - $datediffhours * (60*60);
		$datediffmins = floor($datediffmins/60);

		//if($total_trading_cost != 0)
		//{
		//	$total_trading_cost = $total_trading_cost - $initdeposit;
		//}
		if($total_closed_trades > 0)
		{
			$percent_winners = ($total_winners / $total_closed_trades) * 100;
			$percent_winners = number_format($percent_winners,2);
			if($percent_winners >= 50) { $winnersfontcolor = "#009900"; }
			else { $winnersfontcolor = "#FF3333"; }	
		}
		else
		{
			$percent_winners = "-";
			$winnersfontcolor = "#000000";
		}
		//Calculate average win
		$average_win = 0;
		$ave_win_fontcolor = "#009900"; 
		if($total_winners > 0)
		{
			$average_win = $total_winnings / $total_winners;
			$average_win = number_format($average_win,3);
		}

		//Calculate average loss
		$average_loss = 0;
		$ave_loss_fontcolor = "#FF3333"; 
		if($total_loosers > 0)
		{
			$average_loss = $total_losses / $total_loosers;
			$average_loss = number_format($average_loss,3);
		}
		//Average per trade 
		if($total_closed_trades > 0)
		{
			$average_per_trade = $total_net_profit / $total_closed_trades;
			$average_per_trade = number_format($average_per_trade,3);
		}
	 
		if($average_per_trade >= 0) { $avepertradefontcolor = "#009900"; }
		else { $avepertradefontcolor = "#FF3333"; }

	}
	//Get the timezone
	$timezone_server = date_default_timezone_get();
	
	

	$pagecontent .= <<<HTM
		<p><a href=trades.php>Home</a> -> User - <a href=trades.php?a=userReports&uid=$uidvalue>$uidvalue</a> -> Account - <b>$uaccvalue</b></p>
		<p>Last updated: <b>$lastupdatedtimestamp</b> (Timezone: <b>$timezone_server</b>)</p>
		<table border="0" align="center" cellpadding=2 cellspacing=2>
			<tr>
				<td align="center" >
					<h6>Current balance</h6>
					<h3><font color="$initdepositfont">$currentBalance </font> $acurr</h3>
					<img src="images/question_mark_small.png" alt="This is the initial deposit made during account opening." title="This is the initial deposit made during account opening." height="15">
				</td>
				<td bgcolor="#0099FF">
					&nbsp;
				</td>
				<td align="center">
					<h6>Open P/L</h6>
					<h3><font color="$openprofitfontcolor">$total_open_pl </font> $acurr</h3>
					<img src="images/question_mark_small.png" alt="This is the total open profit or loss in the account currency." title="This is the total open profit or loss in the account currency." height="15">
					
				</td>
				<td bgcolor="#0099FF">
					&nbsp;
				</td>
				<td align="center">
					<h6>Closed Net P/L</h6>
					<h3><font color="$profitfontcolor">$total_net_profit </font> $acurr</h3>
					<img src="images/question_mark_small.png" alt="This is the total closed profit or loss in the account currency." title="This is the total closed profit or loss in the account currency." height="15">
					<p>Cost of trading: $total_trading_cost $acurr <img src="images/question_mark_small.png" alt="This is the amount you pay to the broker in commissions, rollovers, etc." title="This is the amount you pay to the broker in commissions, rollovers, etc." height="15"></p>
				</td>
				<td bgcolor="#0099FF">
					&nbsp;
				</td>
				<td align="center">
					<h6>Total trades</h6>
					<h3><font color="$pointfontcolor">$total_all_trades</font></h3>
					<img src="images/question_mark_small.png" alt="Total trades recorded in the database under this user account. These may include rollovers also." title="Total trades recorded in the database under this user account. These may include rollovers also." height="15">
					<p><a href="#ct">Closed</a> - $total_closed_trades || <p><a href="#ot">Open</a> - $total_open_trades</p>
				</td>
				
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" colspan="7">
					<hr size="2" color="#0099FF">
				</td>
			</tr>
			<tr>
				<td align="center">
					<h6>Winners %</h6>
					<h3><font color="$winnersfontcolor">$percent_winners %</font></h3>
					<img src="images/question_mark_small.png" alt="Percentage of trades that have resulted in positive net profit. If net profit is zero or less, it is counted as a loser trade." title="Percentage of trades that have resulted in positive net profit. If net profit is zero or less, it is counted as a loser trade." height="15">
					<p>Won - $total_winners || Lost - $total_loosers</p>
				</td>
				<td bgcolor="#0099FF">
					&nbsp;
				</td>
				<td align="center">
					<h6>Average per trade</h6>
					<h3><font color="$avepertradefontcolor">$average_per_trade</font> $acurr</h3>
					<img src="images/question_mark_small.png" alt="This is the average profit made per trade." title="This is the average profit made per trade." height="15">
					
				</td>	
				<td bgcolor="#0099FF">
					&nbsp;
				</td>
				<td align="center">
					<h5>Average win per trade</5>
					<h3><font color="$ave_win_fontcolor">$average_win</font> $acurr</h3>
					<img src="images/question_mark_small.png" alt="This is the average profit made per winning trade." title="This is the average profit made per winning trade." height="15">
					
				</td>	
				<td bgcolor="#0099FF">
					&nbsp;
				</td>
				<td align="center">
					<h6>Average loss per trade</h6>
					<h3><font color="$ave_loss_fontcolor">$average_loss</font> $acurr</h3>
					<img src="images/question_mark_small.png" alt="This is the average loss made per trade." title="This is the average loss made per trade." height="15">
					
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" colspan="7">
					<hr size="2" color="#0099FF">
				</td>
			</tr>	
		</table>
		<table width="100%" cellpadding="5" cellspacing="5" border="0">
			<tr>
				<td valign="top" align="center">					
					<p>Chart type: <a href=trades.php?a=userAccount&uid=$uidvalue&uacc=$uaccvalue&chart=acc_bal target=_top>Balance</a> : <a href=trades.php?a=userAccount&uid=$uidvalue&uacc=$uaccvalue&chart=acc_gro target=_top>Growth</a></p>
HTM;

	$ctt = "";
	if(isset($_GET['chart']))
	{
		$ctt = $_GET['chart'];
	}
	if($ctt == "")
	{
		$ctt = "acc_gro";
	}
	
	$pagecontent .= showChart($uidvalue, $uaccvalue, $ctt, 600, 350,"");
	

	$pagecontent .= <<<HTM
				</td>
			</tr>
		</table>

		<a name="ot"><hr size="2" color="#0099FF" width="50%">
		<p><b>Open trades:</b></p>
		<p>(Click on the ticket number to see all details)</p>
		<p>&nbsp;</p>
HTM;

	$pagecontent .= buildTradesTable($uidvalue,$uaccvalue,0,1000,"open");
	
	$pagecontent .= <<<HTM
		<a name="ct"><a name="ot"><hr size="2" color="#0099FF" width="50%">
		<p><b>Closed trades:</b></p>
		<p>(Click on the ticket number to see all details. Showing only upto last 1000 trades for performance reasons.)</p>
		<p>&nbsp;</p>


HTM;


	$pagecontent .= buildTradesTable($uidvalue,$uaccvalue,0,1000,"closed");



}

//Show chart image
function showChart($uidvalue, $uaccvalue, $uctvalue, $chartwidth, $chartheight, $cdiv)
{
	global $link;
	if($cdiv=="")
	{
		$cdiv = "chart_div";
	}
	switch($uctvalue)
	{
		case "acc_bal";
			$chart_title = "Account Balance for Acc # $uaccvalue";
			$col1_type = "string";
			$col2_type = "number";
			$col1_heading = "Time";
			$col2_heading = "Account Balance";

			$q="SELECT * FROM fxrp_trades WHERE uid = '$uidvalue' AND uacc = '$uaccvalue' AND status = 'closed' ORDER BY close_time";
			if($r=mysqli_query($link,$q))
			{
				$totalbal = 0;
				while($accdata = mysqli_fetch_array($r))
				{
					$totalbal = $totalbal + $accdata['net_profit'];
					$rowvalues[] = "['".$accdata['close_time']."', ".$totalbal."]";
				}
				$rowvaluestring = implode(",",$rowvalues);
			}
			
			

			break;
		case "cur_cha";
			$c=$_GET['curr'];
			$chart_title = "Currency pair chart $c";
			$col1_type = "string";
			$col2_type = "number";
			$col1_heading = "Time";
			$col2_heading = "Currency close P/L";

			$q="SELECT * FROM fxrp_trades WHERE uid = '$uidvalue' AND uacc = '$uaccvalue' AND symbol = '$c' AND status = 'closed' ORDER BY close_time";
			if($r=mysqli_query($link,$q))
			{
				$totalbal = 0;
				while($accdata = mysqli_fetch_array($r))
				{
					$totalbal = $totalbal + $accdata['net_profit'];
					$rowvalues[] = "['".$accdata['close_time']."', ".$totalbal."]";
				}
				$rowvaluestring = implode(",",$rowvalues);
			}
			
			

			break;
		case "acc_gro";
			$chart_title = "Account Growth for Acc # $uaccvalue";
			$col1_type = "string";
			$col2_type = "number";
			$col1_heading = "Time";
			$col2_heading = "Account Growth (%)";

			$q="SELECT * FROM fxrp_trades WHERE uid = '$uidvalue' AND uacc = '$uaccvalue' AND status = 'closed' AND type < 6 ORDER BY close_time";
			if($r=mysqli_query($link,$q))
			{
				$totalgro = 0;
				while($accdata = mysqli_fetch_array($r))
				{
					$totalgro = $totalgro + $accdata['growth'];
					$rowvalues[] = "['".$accdata['close_time']."', ".$totalgro."]";
				}
				$rowvaluestring = implode(",",$rowvalues);
			}
			
			

			break;
	}

	return <<<HTM
			<!--Load the AJAX API-->    
			<script type="text/javascript" src="https://www.google.com/jsapi"></script>    
			<script type="text/javascript">      
				// Load the Visualization API and the piechart package.      
				google.load('visualization', '1.0', {'packages':['corechart']});      
				// Set a callback to run when the Google Visualization API is loaded.      
				google.setOnLoadCallback(drawChart);      
				// Callback that creates and populates a data table,      
				// instantiates the pie chart, passes in the data and      /
				// draws it.      
				function drawChart() 
				{        
					// Create the data table.        
					var data = new google.visualization.DataTable();        
					data.addColumn('$col1_type', '$col1_heading');        
					data.addColumn('$col2_type', '$col2_heading');        
					data.addRows([          
						$rowvaluestring
					]);        
					// Set chart options        
					var options = {'title':'$chart_title',
									'width': $chartwidth,
									'height': $chartheight};        
					// Instantiate and draw our chart, passing in some options.        
					var chart = new google.visualization.LineChart(document.getElementById('$cdiv'));        
					chart.draw(data, options);      
				}    
			</script>  
			<!--Div that will hold the pie chart-->    
			<div id="$cdiv"></div>  


HTM;

	
//	echo <<<HTM
//	<html>
//		<head>
//		</head>
//		<body>
//			<!--Load the AJAX API-->    
//			<script type="text/javascript" src="https://www.google.com/jsapi"></script>    
//			<script type="text/javascript">      
//				// Load the Visualization API and the piechart package.      
//				google.load('visualization', '1.0', {'packages':['corechart']});      
//				// Set a callback to run when the Google Visualization API is loaded.      
//				google.setOnLoadCallback(drawChart);      
//				// Callback that creates and populates a data table,      
//				// instantiates the pie chart, passes in the data and      /
//				// draws it.      
//				function drawChart() 
//				{        
//					// Create the data table.        
//					var data = new google.visualization.DataTable();        
//					data.addColumn('$col1_type', '$col1_heading');        
//					data.addColumn('$col2_type', '$col2_heading');        
//					data.addRows([          
//						$rowvaluestring
//					]);        
//					// Set chart options        
//					var options = {'title':'$chart_title',
//									'width': $chartwidth,
//									'height': $chartheight};        
//					// Instantiate and draw our chart, passing in some options.        
//					var chart = new google.visualization.LineChart(document.getElementById('chart_div'));        
//					chart.draw(data, options);      
//				}    
//			</script>  
//		<!-- </head>  
//		<body> -->
//			<!-- Show the links for other charts at the top -->
//			$linkscode
//			<!--Div that will hold the pie chart-->    
//			<div id="chart_div"></div>  
//		</body>
//	</html>
//	
//HTM;

//exit;
}


//Register new user
function register_new()
{
	global $pagekeywords, $pagedesc, $pagetitle, $pagecontent;
	$pagekeywords = "";
	$pagedesc = "Register a new account";
	$pagetitle = "Register a new account.";

	
	$pagecontent .= <<<HTM
		<p>&nbsp;</p>
		<p align="center"><font face="arial"><font size="2"><b>Create new account below:</b></font></font></p>
		
		<form action="trades.php?a=register_new1" method="post">
			<p align="center"><font face="arial" size="2">Select a User ID: <input type="text" name="cbid" size="20" maxlength="30"><br>
			(<font size="1">This is key to your account and cannot be changed later.</font>)</p>
			<p align="center"><font face="arial" size="2">Choose password: <input type="password" name="p" size="20" maxlength="30"></p>
			<p align="center"><font face="arial" size="2">Confirm password: <input type="password" name="pc" size="20" maxlength="30"></p>
			<p align="center"><font face="arial" size="2">Enter Email (confirmation link will be sent to your email): <input type="text" name="cbemail" size="50" maxlength="100"></p>
			<p align="center"><font face="arial" size="2">What is your first name? <input type="text" name="n" size="15" maxlength="20"></p>
			<p><input type="checkbox" name="tosflag"/> - I accept the terms of service.</p>
			<p>Security Code -> <img src="CaptchaSecurityImages.php" /><br>
			Enter Security Code: <input id="security_code" name="security_code" type="text" /></p>
			<p align="center"><input type="submit" value="Send confirmation link"></p>
		</font>
HTM;




}

//Send the confirmation link
function register_new1()
{
	global $pagekeywords, $pagedesc, $pagetitle, $pagecontent, $sitename, $baseurl, $noreply_mail, $link;
	
	$cbidvalue = $_POST['cbid'];
	$cbemlvalue = $_POST['cbemail'];
	$ptf = $_POST['tosflag'];
	$p = $_POST['p'];
	$pc = $_POST['pc'];
	$n = $_POST['n'];
	
	$pagekeywords = "";
	$pagedesc = "";
	$pagetitle = "registering new user account";
	$pagecontent = "";
	
	//Check security code
	//if(($_SESSION['security_code'] == $_POST['security_code']) && (!empty($_SESSION['security_code'])) ) 
	//{
	//	unset($_SESSION['security_code']);
	//}
	//else 
	//{
	//	$pagecontent .= "<p>ERROR! Security code is invalid. Try again.";
	//	return;
	//}

	if($cbidvalue == "" or $cbemlvalue == "" or $p == "" or $pc == "" or $n == "")
	{
		$pagecontent .= "<p>All fields must be entered. Please try again...</p>";
		return;
	}
	
	
	//User must accept tos
	if($ptf == "")
	{
		$pagecontent .= <<<HTM
			<p>&nbsp;</p>
			<p><b>ERROR!</b> You must accept the terms of service.</p>
HTM;

		return;
	}
	
	//CBID must not contain any special characters
	if(!ctype_alnum($cbidvalue))
	{
		$pagecontent .= "<p>Invalid user ID entered. It must be only digits and letters (alphanumeric). It must be less than 30 characters.</p>";
		return;
	}
	
	if($p != $pc)
	{
		$pagecontent .= "<br> Passwords are not matching. Try again.";
		return;
	}
	
	$addedon = time();
	$cbcode=rand(0,9);
	$cbcode.=rand(0,9);
	$cbcode.=rand(0,9);
	$cbcode.=rand(0,9);
	$cbcode.=rand(0,9);
	$cbcode.=rand(0,9);
	$cbcode.=rand(0,9);
	$cbcode.=rand(0,9);
	$cbcode.=rand(0,9);
	$cbcode.=rand(0,9);
	
	$q="INSERT INTO fxrpt_userstemp SET uid = '$cbidvalue', code='$cbcode', ueml= '$cbemlvalue', passw = '$p', fname = '$n'";
	if($r=mysqli_query($link,$q))
	{
		//Now send the mail with activation code
		$msgsub = $sitename . " - confirmation link for - " . $cbidvalue;
		$confurl = $baseurl . "trades.php?a=confirm_new&cbid=".$cbidvalue."&cbcode=".$cbcode."&cbeml=".$cbemlvalue;
		$msg = <<<TXT
THIS IS NOT SPAM
----------------
This is your confirmation link from $sitename

$confurl

If you don't find the link clickable, just copy and paste it in the browser window.

Thanks for your interest and welcome aboard!

Admin
$sitename
$baseurl
-----------------




TXT;



		if(send_mail_plain_new($cbemlvalue,$noreply_mail,$noreply_mail,$msgsub,$msg))
		{
			$pagecontent .= "<p>Confirmation link is sent in email. <b><font color='red'>Email may have gone to your spam/bulk folder! Check there also..</font></b></p>";
		}
		else
		{
			$pagecontent .= "<p>Error sending confirmation link. Try again.</p>";
		}
	}
	else
	{
		$pagecontent .= mysql_error();
	}

}

//Send mail
function send_mail_plain_new($mailid,$fromid,$replyto,$sub,$msg)
{
	global $def_eml_ad, $email_adcode;
	//print "$mailid,$fromid,$sub,$msg";
  $headers  = "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
  /* additional headers */
  $headers .= "From: $fromid\r\n";
  $headers .= "Reply-To: $replyto\r\n";
	$msg="$msg".$def_eml_ad;
	//this will send mail to each person individually.
	$mailid=explode(",",$mailid);
  //Add email ad
	$msg = $msg . $email_adcode;

	for($i=0;$i<count($mailid);$i++)
	{
		//echo"Message : $msg";
		if(mail($mailid[$i], $sub, $msg,$headers))
		{
		}
		else
		{
			print "<br>Error sending email to $mailid[$i]";
			exit;
		}
 	}
  return 1;
}

function confirm_new()
{
	global $pagekeywords, $pagedesc, $pagetitle, $pagecontent, $sitename, $baseurl, $noreply_mail, $default_user, $link;
	
	$cbidvalue = $_GET['cbid'];
	$cbcodevalue = $_GET['cbcode'];
	$cbemlvalue = $_GET['cbeml'];
		
	$pagekeywords = "";
	$pagedesc = "";
	$pagetitle = "confirm id";
	$pagecontent .= "";
	$q="SELECT * FROM fxrpt_userstemp WHERE uid = '$cbidvalue' AND code = '$cbcodevalue' AND ueml = '$cbemlvalue' ORDER BY cnt DESC LIMIT 1";
	if($r=mysqli_query($link,$q))
	{
		$cbuserstempdata = mysqli_fetch_array($r);
		if($cbuserstempdata['cnt'] > 0)
		{
			$addedontime = time();
			//Create password for the user
			$cbcode=$cbuserstempdata['passw'];
			$fname =$cbuserstempdata['fname']; 
			
			
			$q1="INSERT INTO fxrpt_users SET uid = '$cbidvalue', addedon = '$addedontime', ueml = '$cbemlvalue', upass = '$cbcode', fname = '$fname'";
			if(mysqli_query($link,$q1))
			{
				$pagecontent .= "<p>User verified successfully.</p>";
				//Now send the mail with password
				$msgsub = $sitename . " - site credentials - " . $cbidvalue;

     		$msg = <<<TXT
THIS IS NOT SPAM
----------------
This is your site credentials for $sitename for your future reference.

Your Username - $cbidvalue
Your Password - $cbcode

Log in here - $baseurl



Admin
$sitename
$baseurl

TXT;


				if(send_mail_plain_new($cbemlvalue,$noreply_mail,$noreply_mail,$msgsub,$msg))
				{
					$pagecontent .= "<p>Your account is active and now you can log in!</p>";
					
				}
				else
				{
					$pagecontent .= "<p>Error sending password. Try again.</p>";
				}

			}
			else
			{
				$pagecontent .= mysqli_error($link);
			}
		}
	}
	else
	{
		$pagecontent .= mysqli_error($link);
	}

}

//Login
function login()
{
	global $pagekeywords, $pagedesc, $pagetitle, $pagecontent, $sitename, $baseurl, $noreply_mail;
	$pagekeywords = "";
	$pagedesc = "";
	$pagetitle = "login to members area";
	$pagecontent .= <<<HTM
		<p><font size="3"><b>Login Form</b></font></p>
		<form action="trades.php?a=login1" method="post">
			<p>Username - <input type="text" name="uname_new" size="20" maxlength="30"></p>
			<p>Password - <input type="password" name="upass_new" size="20" maxlength="30"></p>
			<p>Security Code -> <img src="CaptchaSecurityImages.php" /><br>
			Enter Security Code: <input id="security_code" name="security_code" type="text" /></p>
			
			<p><input type="submit" value="Continue"></p>
		</form>
		<p><a href="trades.php?a=retpass">Forgot password? Retrieve it here.</a></p>
HTM;


}

function login1($pu, $pp, $mode)
{
	global $pagecontent, $apoints_login, $loginhours, $logindailylimit, $loginrate, $link;
	//Check security code
	//if($mode == 0)
	//{	
	//	if(($_SESSION['security_code'] == $_POST['security_code']) && (!empty($_SESSION['security_code'])) )
	//	{
  	//		unset($_SESSION['security_code']);
  	//	}
  	//	else
  	//	{
  	//		$pagecontent .= "<p>ERROR! Security code is invalid. Try again.";
  	//		return;
	//	}
	//}

	$q="SELECT * FROM fxrpt_users WHERE uid = '$pu'";
	if($r=mysqli_query($link,$q))
	{
		$cbudata = mysqli_fetch_array($r);
		$cbstatus = $cbudata['status'];
		$cbpass = $cbudata['upass'];
		$cbref = $cbudata['cbref'];
		
		if($cbstatus != "active")
		{
			if($mode == 0)
			{
				$pagecontent .= "<p>ERROR! User account is not active or user has not registered yet successfully.";
			}
			if($mode == 1)
			{
				echo "ERROR! User account is not active or user has not registered.";
				exit;
			}
		}
		else
		{
			if($pp == $cbpass)
			{
				$_SESSION['uname'] = $pu;
				$_SESSION['refid'] = $cbref;
				
				
				if($mode == 0)
				{
					header("Location: trades.php?a=mem");
				}
				if($mode == 1)
				{
					//echo "OK";
				}
			}
			else
			{
				if($mode == 0)
				{
					$pagecontent .= "<p>ERROR! Username and/or password incorrect.";
				}
				if($mode == 1)
				{
					echo "ERROR! Username and/or password incorrect.";
					exit;
				}
			}
		}
	}
	else
	{
		if($mode == 0)
		{
			$pagecontent .= mysql_error();
		}
		if($mode == 1)
		{
			echo "SQL Error. Check website error log. Cannot proceed.";
			exit;
		}
	}
}

function mem()
{
	global $pagecontent, $pagetitle, $baseurl, $link;
	$uname = $_SESSION['uname'];
	$siteurltoadd = $baseurl . "webrequest.php";
	$pagecontent .= getMemMenu();
	
	//Show existing accounts
	$existingaccountstable = "";
	$existingaccountstable .= <<<HTM
	<table align="center" border="1" cellspacing="5" cellpadding="5">
		<tr>
			<td align="center">
				<b>Account number</b>
			</td>
			<td align="center">
				<b>Actions</b>
			</td>
		</tr>
		
HTM;

	//First find how many accounts are under this user ID
	$totalaccounts = 0;
	$q="SELECT DISTINCT(uacc) FROM fxrp_trades WHERE uid = '$uname'";
	if($r=mysqli_query($link,$q))
	{
		while($udata = mysqli_fetch_array($r))
		{
			$existingaccountstable .= <<<HTM
				<tr>
					<td align="center">
						$udata[0]
				</td>
				<td align="center">
					<a href=trades.php?a=getCodes&uid=$uname&uacc=$udata[0]>Get codes and widgets</a>
				</td>
			</tr>
		
HTM;

			$totalaccounts++;
		}
	}
	else
	{
		$existingaccountstable .= mysql_error();
	}


	$existingaccountstable .= <<<HTM
	</table>
		
HTM;


	$pagecontent .= <<<HTM
	<p><font size="3"><b>Existing Accounts</b></font></p>
	<p>Here are the accounts you are already publishing the MT4 statement for:</p>
	$existingaccountstable
HTM;


	//Show the main page for adding EA to the MT4 plantform
	$pagecontent .= <<<HTM
	<p><font size="3"><b>Setup instructions</b> (Read carefully)</font></p>
	<p>Here are the steps to add the EA to your MT4 platform and start publishing your trading activity. These steps need to be repeated for each account you wish to publish to your website.</p>
	<p><b>Step 1:</b> Donwload the EA file and save it to the Experts folder of your MT4: You will find the .EX4 file in the package you downloaded.</p>
	<p>&nbsp;</p>
	<p><b>Step 2:</b> Open a new chart (any chart will do) and add the EA to it. Best way is to drag and drop the EA onto the chart.</p>
	<p>&nbsp;</p>
	<p><b>Step 3:</b> Update the input parameters with the following values:</p>
	<p><font color=blue>userName</font> = $uname
	<p><font color=blue>updateFrequencyInSecs</font> = 60 (or any integer more than 60 seconds will work)
	<p><font color=blue>siteURL</font> = $siteurltoadd <br><font color=red><b><u>Most important:</u></b></font> Don't forget to add $siteurltoadd to the list of allowed URLs in your MT4. <br>You can learn how to do it by reading this post - <a href=http://www.fx9ja.trade/how-to-add-a-url-to-allowed-urls-list-in-mt4/ target=_blank>How to add a URL to list of allowed URLs in your MT4</a>.
	<p><font color=blue>passWord</font> = <i>your password you used to log in here</i>
	<center><img src=images/input_parameters.PNG></center>
	<p>&nbsp;</p>
	
HTM;

}

function check_login()
{
	$flag = false;
	if(isset($_SESSION['uname']))
	{
		$flag = true;
	}
	return $flag;
}

//Take visitor to the logoff screen
function logoff()
{
	header("Location: trades.php");
}

function retpass()
{
	global $pagekeywords, $pagedesc, $pagetitle, $pagecontent, $sitename;
	$pagekeywords = "retrieve password";
	$pagedesc = "Retrieve password";
	$pagetitle = "Retrieve password";
	$pagecontent .= <<<HTM
		<p><b>Retrieve Password</b></p>
		<form action="trades.php?a=retpass1" method="post">
			<p>Enter email: <input type="text" name="ueml" size=30></p>
			<p><input type="submit" value="Retrieve password"></p>
		</form>
HTM;


}

function retpass1($puemail)
{
	global $pagekeywords, $pagedesc, $pagetitle, $pagecontent, $sitename, $baseurl, $noreply_mail, $link;
	$pagekeywords = "retrieve password";
	$pagedesc = "Retrieve password";
	$pagetitle = "Retrieve password";
	if($puemail == "")
	{
		$pagecontent .= "<br> Email must be entered.";
	}
	else
	{
		$q="SELECT upass, status, uid FROM fxrpt_users WHERE ueml = '$puemail'";
		if($r=mysqli_query($link,$q))
		{
			$passdata = mysqli_fetch_array($r);
			if($passdata[1] == "active")
			{
				$cbid = $passdata[2];

				$msg = <<<TXT
THIS IS NOT SPAM
----------------
Your password for $sitename is $passdata[0]
Your username is - $cbid

Login here - $baseurl

Thanks
Admin
$baseurl
TXT;


				if(send_mail_plain_new($puemail, $noreply_mail, $noreply_mail, "$sitename - Password retrieval mail", $msg))
				{
					$pagecontent .= "<br> Email sent with password to $puemail";
				}
				else
				{
					$pagecontent .= "<br> Error sending mail.";
				}
			}
			else
			{
				$pagecontent .= "<br> This account is not active. Password cannot be retrieved.";
			}
		}
		else
		{
			$pagecontent .= "<br> Error reading the password. ".mysql_error();
		}
	}

}

function changepwd()
{
	global $pagecontent;
	$pagecontent .= "";
	
	$pagecontent .= getMemMenu();
	$pagecontent .= <<<HTM
		<p><font size="3"><b>Change Password</b></font></p>
		<form action="trades.php?a=changepwd1" method="post">
			<p>Old password: <input type="password" name="opwd" size="15"></p>
			<p>New password: <input type="password" name="npwd" size="15"></p>
			<p>New password confirm: <input type="password" name="npwd1" size="15"></p>
			<p><input type="submit" value="Change password"></p>
		</form>

HTM;

}

function changepwd1($pupwdold, $pupwdnew, $pupwdnew1)
{
	global $pagekeywords, $pagedesc, $pagetitle, $pagecontent, $sitename, $link;
	$pagekeywords = "members area, changing password";
	$pagedesc = "changing password";
	$pagetitle = "changing password";
	$uname = $_SESSION['uname'];
	$pagecontent .= getMemMenu();

	if($pupwdold == "" or $pupwdnew == "" or $pupwdnew1 == "")
	{
		$pagecontent .= "<br> Some or all the entries missing. Try again.";
	}
	else
	{
		if($pupwdnew != $pupwdnew1)
		{
			$pagecontent .= "<br> New passwords are not matching. Try again.";
		}
		else
		{
			//Select the current password of the user
			$q="SELECT upass FROM fxrpt_users WHERE uid = '$uname'";
			if($r=mysqli_query($link,$q))
			{
				$userdata = mysqli_fetch_array($r);
				if($userdata[0] != $pupwdold)
				{
					$pagecontent .= "<br>Old password is not matching. Try again.";
				}
				else
				{
					$q1="UPDATE fxrpt_users SET upass = '$pupwdnew' WHERE uid = '$uname'";
					if($r1=mysqli_query($link,$q1))
					{
						$pagecontent .= "<br> Password chage successful!";
					}
					else
					{
						$pagecontent .= "<br> Error updating user password. ".mysql_error();
					}
				}
			}
			else
			{
				$pagecontent .= "<br> Error in reading the user data. ".mysql_error();
			}
		}
	}

}


function getMemMenu()
{
	global $pagecontent, $pagetitle;
	$uname = $_SESSION['uname'];
	
	$codetoreturn = "";
	$codetoreturn .= "Welcome $uname to members area - <a href=trades.php?a=mem>Main menu</a> - <a href=trades.php?a=logoff>Log-off</a> - <a href=trades.php?a=changepwd>Change password</a> - <a href=http://fx9ja.trade target=_blank>Support (Request help here)</a><p align=center>-*-</p>";
	return $codetoreturn;
}

//Build table of trades
function buildTradesTable($uidtoshow,$uaccount,$startfrom,$totaltoshow,$statusoftrades)
{
	global $pagecontent, $pagetitle, $link;
	$tablecodetoreturn = "";
	$tablecodetoreturn .= <<<HTM



	    
<table class="table">
<thead class="thead" style="background-color:#30b666; color: #fff;">
<tr>
  
<th style="border-top-left-radius: 20px;"> User ID   </th>
<th>Account </th>
<th>Ticket #</th>
<th>Type</th>
<th>Open Time</th>
<th>Close Time</th>
<th>Symbol</th>
<th>Lot Size</th>
<th>Net profit</th>
<th>Comments</th>
</tr>
</thead>

HTM;


	//Build the query
	if($uidtoshow == "")
	{
		$q="SELECT * FROM fxrp_trades WHERE type < 6 AND status = '$statusoftrades' ORDER BY open_time DESC LIMIT $totaltoshow";
	}
	else
	{
		$q="SELECT * FROM fxrp_trades WHERE uid = '$uidtoshow' AND uacc = '$uaccount' AND status = '$statusoftrades' ORDER BY ticket DESC LIMIT $totaltoshow";
	}
	if($r=mysqli_query($link,$q))
	{
		while($tdata = mysqli_fetch_array($r))
		{
			$uidtoshow = $tdata['uid'];
			$uaccount = $tdata['uacc'];
			$tic = $tdata['ticket'];
			$typ = $tdata['type'];
			$typshow = "";
			switch($typ)
			{
				case "0";
					$typshow = "BUY";
					break;
				case "1";
					$typshow = "SELL";
					break;
				case "2";
					$typshow = "BUY LIMIT";
					break;
				case "3";
					$typshow = "BUY STOP";
					break;
				case "4";
					$typshow = "SELL LIMIT";
					break;
				case "5";
					$typshow = "SELL STOP";
					break;
				case "6";
					$typshow = "DEPOSIT/WITHDRAWAL";
					break;
				default;
					$typshow = "OTHER";
					break;
			}
			$ope = $tdata['open_time'];
			$clo = $tdata['close_time'];
			$sym = $tdata['symbol'];
			$lot = $tdata['lots'];
			$net = $tdata['net_profit'];
			$com = $tdata['comment'];


			$tablecodetoreturn .= <<<HTM

			<tbody>

			<tr>
				<td >
					<a href=trades.php?a=userReports&uid=$uidtoshow target=_blank>$uidtoshow</a>
				</td>
				
				<td >
					<a href=trades.php?a=userAccount&uid=$uidtoshow&uacc=$uaccount target=_blank>$uaccount</a>
				</td>
				
				<td >
					<a href=trades.php?a=showTicket&uid=$uidtoshow&uacc=$uaccount&tic=$tic target=_blank>$tic</a>
				</td>
			
				<td >
					$typshow
				</td>
			
				<td >
					$ope
				</td>
			
				<td >
					$clo
				</td>
			
				<td >
					$sym
				</td>
			
				<td >
					$lot
				</td>
				
				<td >
					$net
				</td>
				
				<td >
					$com
				</td>
			</tr>

HTM;


		}
	}
	else
	{
		$tablecodetoreturn .= mysqli_error($link);
	}

	$tablecodetoreturn .= <<<HTM
		</table>
	   

HTM;


	return $tablecodetoreturn;

}

//Show ticket details
function showTicket($ui,$ua,$ti)
{
	global $pagecontent, $pagetitle, $link;
	$pagetitle = "Showing ticket $ti";
	$$pagecontent = "";
	//Build the query
	$q="SELECT * FROM fxrp_trades WHERE uid = '$ui' AND uacc = '$ua' AND ticket = '$ti' LIMIT 1";
	if($r=mysqli_query($link,$q))
	{
		$tdata = mysqli_fetch_array($r);
		$sta = $tdata['status'];
		$typ = $tdata['type'];
		$typshow = "";
		switch($typ)
		{
			case "0";
				$typshow = "BUY";
				break;
			case "1";
				$typshow = "SELL";
				break;
			case "2";
				$typshow = "BUY LIMIT";
				break;
			case "3";
				$typshow = "BUY STOP";
				break;
			case "4";
				$typshow = "SELL LIMIT";
				break;
			case "5";
				$typshow = "SELL STOP";
				break;
			case "6";
				$typshow = "OTHER";
				break;
			default;
				$typshow = "OTHER";
				break;
		}
		$ot = $tdata['open_time'];
		$ct = $tdata['close_time'];
		$sy = $tdata['symbol'];
		$ma = $tdata['magic_number'];
		$lo = $tdata['lots'];
		$op = $tdata['open'];
		$cl = $tdata['close'];
		$st = $tdata['stop_loss'];
		$ta = $tdata['take_profit'];
		$po = $tdata['points_change'];
		$sw = $tdata['swap'];
		$co = $tdata['commission'];
		$ne = $tdata['net_profit'];
		$com = $tdata['comment'];
		$cu = $tdata['curr'];
		$la = $tdata['lastupd'];
		$gr = $tdata['growth'];
		

		$pagecontent .= <<<HTM
			<p><font size="3"><b>User: $ui | Account: $ua | Ticket: $ti</b></font></p>
			<table align="center" border="1" cellspacing="0" cellpadding="5">
				<tr>
					<td>
						Order type:
					</td>
					<td>
						$typshow
					</td>
				</tr>
				<tr>
					<td>
						Open time:
					</td>
					<td>
						$ot
					</td>
				</tr>
				<tr>
					<td>
						Close time (shown correctly only for closed orders):
					</td>
					<td>
						$ct
					</td>
				</tr>
				<tr>
					<td>
						Symbol:
					</td>
					<td>
						$sy
					</td>
				</tr>
				<tr>
					<td>
						Magic number:
					</td>
					<td>
						$ma
					</td>
				</tr>
				<tr>
					<td>
						Lots:
					</td>
					<td>
						$lo
					</td>
				</tr>
				<tr>
					<td>
						Open:
					</td>
					<td>
						$op
					</td>
				</tr>
				<tr>
					<td>
						Close:
					</td>
					<td>
						$cl
					</td>
				</tr>
				<tr>
					<td>
						Stop loss:
					</td>
					<td>
						$st
					</td>
				</tr>
				<tr>
					<td>
						Take profit:
					</td>
					<td>
						$ta
					</td>
				</tr>
				<tr>
					<td>
						Points change:
					</td>
					<td>
						$po
					</td>
				</tr>
				<tr>
					<td>
						Swap:
					</td>
					<td>
						$sw
					</td>
				</tr>
				<tr>
					<td>
						Commission:
					</td>
					<td>
						$co
					</td>
				</tr>
				<tr>
					<td>
						Net profit:
					</td>
					<td>
						$ne $cu
					</td>
				</tr>
				<tr>
					<td>
						Comments:
					</td>
					<td>
						$com
					</td>
				</tr>
				<tr>
					<td>
						Last update:
					</td>
					<td>
						$la
					</td>
				</tr>
				<tr>
					<td>
						Growth:
					</td>
					<td>
						$gr %
					</td>
				</tr>

			</table>
			
HTM;
	


	}
	else
	{
		$pagecontent .= mysqli_error($link);
	}

	
}

//Show javascript code
function showJavascript($uid,$uac,$cty,$cwi,$che,$cdiv)
{
	global $baseurl;
	$urltouse = $baseurl . "trades.php?a=userAccount&uid=$uid&uacc=$uac";
	header("Content-Type: text/javascript");


	$codetoshow = <<<HTM

	<a href=$urltouse target=_blank> 
HTM;

	$codetoshow .= showChart($uid,$uac,$cty,$cwi,$che,$cdiv);
	$codetoshow .= " </a><center><a href=http://www.fightforex.info/free-software-to-publish-mt4-forex-statement-on-your-website/?r=graph_bottom target=_blank><font size=1>Graph powered by FightForex.info</font></a></center>";

	$codefinal = "";
	$codefinal = bin2hex($codetoshow);
	$codetoreturn = "var hexi = '" . $codefinal . "';";
	$codetoreturn .= <<<TXT
var    bytes = [],
    str;

for(var i=0; i< hexi.length-1; i+=2){
    bytes.push(parseInt(hexi.substr(i, 2), 16));
}

str = String.fromCharCode.apply(String, bytes);

document.write(str);
TXT;

	echo $codetoreturn;
	exit;
}

function getCodes($ui, $ua)
{
	global $pagecontent, $pagetitle, $baseurl, $link;
	$uname = $_SESSION['uname'];
	$pagecontent .= getMemMenu();
	//Build links
	$linktoallaccounts = $baseurl . "trades.php?a=userReports&uid=$ui";
	$linktothisaccount = $baseurl . "trades.php?a=userAccount&uid=$ui&uacc=$ua";
	$linktobalgraph = $baseurl . "trades.php?a=javascript&u=$ui&ac=$ua&t=acc_bal&w=450&h=350&cdiv=" . $ua . "acc_bal";
	$textareabalancegraph = <<<TXT
<script src="$linktobalgraph"></script>
TXT;

	$linktogrograph = $baseurl . "trades.php?a=javascript&u=$ui&ac=$ua&t=acc_gro&w=450&h=350&cdiv=" . $ua . "acc_gro";
	$textareagrowthgraph = <<<TXT
<script src="$linktogrograph"></script>
TXT;

	$pagecontent .= <<<HTM
	<p><font size="3"><b>Get codes and widgets</b></font></p>
	<p>Here are the links and HTML widget codes you can use on your website:</p>
	<p>Link to show all your accounts: <input type="text" size="100" value="$linktoallaccounts" disabled>
	<p>Link to show report for account $ua: <input type="text" size="100" value="$linktothisaccount" disabled>
	<p>Widget 1: Show account balance graph:<br>Cut and paste following HTML on the page where you want to show only the account balance graph.<br>You can manipulate variables "w" and "h" in the code below to define the width and height of the graph.<br>Graph will automatically link to the account report.
	<p><textarea cols="100" rows="5" disabled>$textareabalancegraph</textarea>
	<p>Widget 2: Show account growth graph:<br>Cut and paste following HTML on the page where you want to show only the account growth graph.<br>You can manipulate variables "w" and "h" in the code below to define the width and height of the graph.<br>Graph will automatically link to the account report.
	<p><textarea cols="100" rows="5" disabled>$textareagrowthgraph</textarea>
HTM;


}


?>