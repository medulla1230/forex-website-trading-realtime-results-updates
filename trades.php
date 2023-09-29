<?php

include("fxrpt_config.php");
include("fxrpt_funs.php");
include("header.php");

$link = dbconnect();
if (isset($_GET['a']))
{
	$act=$_GET['a'];
}
else
{
	$act = "";
}

switch($act)
{
	case "";
		showMain();
		break;
	case "userReports";
		$uidvalue = $_GET['uid'];
		//loadData($uidvalue);
		userReports($uidvalue);
		break;
	case "userAccount";
		$uidvalue = $_GET['uid'];
		$uaccvalue = $_GET['uacc'];
		//loadData($uidvalue);
		userAccount($uidvalue, $uaccvalue);
		break;
	case "showChart";
		$uidvalue = $_GET['uid'];
		$uaccvalue = $_GET['uacc'];
		$uctvalue = $_GET['charttype'];
		$chartwidth = $_GET['cw'];
		$chartheight = $_GET['ch'];		
		showChart($uidvalue, $uaccvalue, $uctvalue, $chartwidth, $chartheight);
		break;
	case "register";
		register_new();
		break;
	case "register_new1";
		register_new1();
		break;
	case "confirm_new";
		confirm_new();
		break;
	case "login";
		login();
		break;
	case "login1";
		$ppuu = $_POST['uname_new'];
		$ppup = $_POST['upass_new'];
		login1($ppuu,$ppup,0);
		break;
	case "mem";
		//session_start();
		if(check_login())
		{
			mem();
		}
		else
		{
			login();
		}
		break;
	case "logoff";
		//session_start();
		session_destroy();
		//Select a site to send the visitor to 
		logoff();
	case "retpass";
		retpass();
		break;
	case "retpass1";
		$pe = $_POST['ueml'];
		retpass1($pe);
		break;
	case "changepwd";
		//session_start();
		if(check_login())
		{
			changepwd();
		}
		else
		{
			login();
		}
		break;
	case "changepwd1";
		if(check_login())
		{
			$upwdold = $_POST['opwd'];
			$upwdnew = $_POST['npwd'];
			$upwdnew1 = $_POST['npwd1'];

			changepwd1($upwdold, $upwdnew, $upwdnew1);
		}
		break;
	case "showTicket";
		$uidvalue = $_GET['uid'];
		$uaccvalue = $_GET['uacc'];
		$uticketvalue = $_GET['tic'];
		showTicket($uidvalue,$uaccvalue,$uticketvalue);
		break;
	case "javascript";
		$uid=$_GET['u'];
		$uac=$_GET['ac'];
		$cty=$_GET['t'];
		$cwi=$_GET['w'];
		$che=$_GET['h'];
		$cdiv=$_GET['cdiv'];
		showJavascript($uid,$uac,$cty,$cwi,$che,$cdiv);
		break;
	case "getCodes";
		if(check_login())
		{
			$ui = $_GET['uid'];
			$ua = $_GET['uacc'];
			getCodes($ui, $ua);
		}
		break;

			

}


?>
<html>
<head>
<title><?php echo $sitename." - ".$pagetitle;?></title>
<meta name="keywords" content="<? echo $pagekeywords; ?>">
<meta name="description" content="<? echo $pagedesc; ?>">



</head>
<body text="#000000" style="font-face:arial">
<!--Header-->


<!--Main-->
<div class="table-responsive pay-report  mt-15">
<table align="center" width="100%" cellpadding=0 cellspacing=0 border=0 bgcolor="#999999">
	<tr>
		<td valign=top align=center bgcolor="#ffffff">
						
								
<?php
echo $pagecontent;
?>
						
						
		</td>
	</tr>
</table>
</div>
<!--Menu-->
<table border="0" width="100%" cellpadding=0 cellspacing=0 align="center" bgcolor="#ffffff">
	<tr>
		<td bgcolor="#FFFFFF">
			<hr size="2" color="#0099FF" width="100%">
		</td>
	</tr>
	
</table>


<?php

include("footer.php");

?>