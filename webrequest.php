<?php
include_once("fxrpt_config.php");
include_once("fxrpt_funs.php");

//See if this is a connection check only
$actiontoperform = $_GET['atp'];
if($actiontoperform == "ct")
{
	echo "Connection OK";
	exit;
}
$link=dbconnect();
//First check the username and password
$upstr = "";
foreach (getallheaders() as $name => $value) {
    if($name == "Ffpu") $upstr = $value;
}

if($upstr == "")
{
	echo "Credentials missing 1. Aborting...";
	exit;
}

//Separate username and password
$uparr=explode("|",$upstr);
if(count($uparr) != 2)
{
	echo "Credentials missing 2. Aborting...";
	exit;
}
//Check valid user account
$unameee=$uparr[0];
$upassss=$uparr[1];

//echo "Checking credentials for $unameee";
login1($unameee,$upassss,1);

$uid = $_GET['u'];
$uacc = $_GET['ua'];

$ticket=$_GET['t'];
$status=$_GET['s'];
$type=$_GET['ty'];
$lot_size=$_GET['l'];
$open_time_sent=$_GET['o'];
if($open_time_sent != "")
{
if(strstr($open_time_sent," "))
{
	$open_time = $open_time_sent;
}
else
{
	$open_time = date("Y-m-d H:i:s", $open_time_sent);
}
}
$close_time_sent=$_GET['c'];
if($close_time_sent != "")
{
if(strstr($close_time_sent," "))
{
	$close_time = $close_time_sent;
}
else
{
	$close_time = date("Y-m-d H:i:s", $close_time_sent);
}
}
$symbol=$_GET['sy'];
$magic_number=$_GET['m'];
$lots=$_GET['lo'];
$open=$_GET['op'];
$close=$_GET['cl'];
$stop_loss=$_GET['st'];
$take_profit=$_GET['ta'];
$profit=$_GET['pr'];
$swap=$_GET['sw'];
$commission=$_GET['co'];
if($commission == "") $commission = 0;
$abalance=$_GET['ab'];
if($abalance == "") $abalance = 0;
$comment=$_GET['com'];
$curr=$_GET['curr'];
$net_profit = 0;
$net_profit = $net_profit + $profit + $swap - abs($commission);
//Percent growth
$pgrowth = 0;
if($abalance > 0)
{
$pgrowth = $net_profit / $abalance ;
$pgrowth = $pgrowth * 100;
}

if($ticket != "")
{
	$lastupdate=date("Y-m-d H:i:s", time());
	$q="INSERT INTO fxrp_trades SET uid = '$uid', uacc = $uacc, ticket = $ticket, status = '$status', type='$type', lot_size = $lot_size, open_time = '$open_time', close_time = '$close_time', symbol = '$symbol', magic_number = $magic_number, lots = $lots, open = $open, close = $close, stop_loss = $stop_loss, take_profit = $take_profit, profit = $profit, swap = $swap, commission= $commission, net_profit = $net_profit, acc_bal = $abalance, comment = '$comment', curr = '$curr', growth = $pgrowth ON DUPLICATE KEY UPDATE status = '$status', type='$type', lot_size = $lot_size, open_time = '$open_time', close_time = '$close_time', symbol = '$symbol', magic_number = $magic_number, lots = $lots, open = $open, close = $close, stop_loss = $stop_loss, take_profit = $take_profit, profit = $profit, swap = $swap, commission= $commission, net_profit = $net_profit, acc_bal = $abalance, comment = '$comment', curr = '$curr', lastupd = '$lastupdate', growth = $pgrowth";

	if($r=mysqli_query($link,$q))
	{
		echo "SUCCESS! Data updated successfully...";
	}
	else
	{
		//echo mysql_error();
	}

}

//$q="SELECT * FROM fxrp_trades WHERE uid = '$uid' AND uacc = '$uacc' ORDER BY ticket DESC LIMIT 1";
//if($r=mysqli_query($link,$q))
//{
//	$udata=mysqli_fetch_array($r);
//	if($udata['ticket'] != "")
//	{
//		echo $udata['ticket'];
//	}
//	else
//	{
//		echo "-1";
//	}
//	
//}
//else
//{
//	echo "-1";
//}

dbclose($link);
?>