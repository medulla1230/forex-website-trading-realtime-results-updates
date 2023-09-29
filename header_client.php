<?php
session_start();
include('database.inc.php');
include('function.inc.php');
include('constant.inc.php');


if(!isset($_SESSION['ACCOUNT_USER_ID'])){

  redirect('index');
}



$getWalletAmt = 0;
if(isset($_SESSION['ACCOUNT_USER_ID'])){
$getWalletAmt = getWalletAmt($_SESSION['ACCOUNT_USER_ID']);

}


$incomingpPL = 0;
$incomingpPL = incomingpPL();

$TotalWalletAmt = 0;
$TotalWalletAmt = TotalWalletAmt();

$CloseTime ;
$CloseTime = CloseTime();

$CloseT ;
$CloseT  = chktim($_SESSION['ACCOUNT_USER_ID']);

$NetProfitLoss = 0;
$NetProfitLoss  = chkprofitloss($_SESSION['ACCOUNT_USER_ID']);

//get profit or loss Amount
//$chkProfitLoss  = 0;
//$chkProfitLoss  = $TotaltradeAmt - $TotalWalletAmt;

//share profit or loss base on client account balance
$ProfitLoss  = 0;
$ProfitLoss  = ($incomingpPL/$TotalWalletAmt)*$getWalletAmt;
$ProfitLoss  = number_format($ProfitLoss,2);

//$netprofitloss = 0;
//$netprofitloss = $netprofitloss + $ProfitLoss;
if($CloseTime != $CloseT){
$money                          = $ProfitLoss;
$close_time                     = $CloseTime;
$msg                            = "tradesPL";
$_SESSION['ACCOUNT_USER_ID']    = get_safe_value($_SESSION['ACCOUNT_USER_ID']);

manageWallet($_SESSION['ACCOUNT_USER_ID'],$money,'in',$msg,$close_time);

}
//total account balance
//$updWallwtAmt   = 0;
//$updWallwtAmt   = $getWalletAmt + $newProfitLoss;
//$updWallwtAmt      = number_format($updWallwtAmt,2);


 


//$pergrowth;
$pergrowth      = ($NetProfitLoss/$getWalletAmt)*100;
$pergrowth      = number_format($pergrowth,2);



?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title><?php echo SITE_NAME." - ".FRONT_SITE_NAME;?></title>
<meta content="" name="description" />
<meta content="" name="author" />




<link href="<?php echo FRONT_SITE_PATH?>assets/css/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo FRONT_SITE_PATH?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo FRONT_SITE_PATH?>assets/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo FRONT_SITE_PATH?>assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="<?php echo FRONT_SITE_PATH?>assets/css/cryptocoins.css" rel="stylesheet" type="text/css" />
<link href="<?php echo FRONT_SITE_PATH?>assets/css/animate.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo FRONT_SITE_PATH?>assets/css/perfect-scrollbar.css" rel="stylesheet" type="text/css" />
<link href="<?php echo FRONT_SITE_PATH?>assets/css/support.css" rel="stylesheet" type="text/css" />


<link href="<?php echo FRONT_SITE_PATH?>assets/css/jquery-jvectormap-2.0.1.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo FRONT_SITE_PATH?>assets/css/morris.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo FRONT_SITE_PATH?>assets/css/fullcalendar.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo FRONT_SITE_PATH?>assets/css/minimal.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo FRONT_SITE_PATH?>assets/swiper.css" rel="stylesheet" type="text/css">


<link href="<?php echo FRONT_SITE_PATH?>assets/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo FRONT_SITE_PATH?>assets/css/responsive.css" rel="stylesheet" type="text/css" />
<link href="<?php echo FRONT_SITE_PATH?>assets/css/responsive.min.css" rel="stylesheet" type="text/css" />


<style>
      #select option { color:#000; }
      .error_span { width:100%;margin-bottom:0px;color:red;}
    </style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" ></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
<script src="https://code.jquery.com/jquery-migrate-1.4.1.min.js" ></script>
<script async src='cdn-cgi/bm/cv/669835187/api.js'></script>







<body class=" ">

<div class="page-topbar" style="background:#30b666 !important;">
<script  src="js/displaybugs.js"></script>
<div class="logo-area crypto" style="background: #30b666">
</div>
<div class='quick-area'>
<div class="pull-left">
<ul class="info-menu left-links list-inline list-unstyled">
<li class="sidebar-toggle-wrap">
<a href="#" data-toggle="sidebar" class="sidebar_toggle">
<i class="fa fa-bars"></i>
</a>
</li>
<li class="topnav-item item1">
<a href="investment" class="w-text">Investment</a>
</li>
<li class="topnav-item item1">
<a href="withdrawal-report" class="w-text">
<i class="fa fa-area-chart mr-10"></i> Withdrawal Reports
</a>
</li>

<li class="hidden-sm hidden-xs searchform showopacity">
<form action="#" method="post">
<div class="input-group">
<span class="input-group-addon">
<i class="fa fa-search"></i>
</span>
<input type="text" class="form-control animated fadeIn" placeholder="Search &amp; Enter">
</div>
<input type="submit" value="">
</form>
</li>
</ul>
</div>

 <?php

 if(isset($_SESSION['ACCOUNT_USER_NAME']))

 {  ?> 

 <div class='pull-right'>
 <ul class="info-menu right-links list-inline list-unstyled">
 <li class="notify-toggle-wrapper spec">
 <span><i class="pull-right"></i> Welcome : </span>

</li>
<li class="profile">
<a href="#" data-toggle="dropdown" class="toggle">

<i class="fa fa-user"></i>
<span><?php echo $_SESSION['ACCOUNT_USER_NAME']; ?> <i class="fa fa-angle-down"></i></span>
</a>
<ul class="dropdown-menu profile animated fadeIn">





<li>
<a href="edit_profile">
<i class="fa fa-user"></i> Profile
</a>
</li>





<li class="last">
<a href="logout">
<i class="fa fa-lock"></i> Logout
</a>
</li>
</ul>
</li>
</ul>
</div>  ';

            <?php } ?>
</div>
</div>


<div class="page-container row-fluid container-fluid" >

<div class="page-sidebar fixedscroll">

<div class="page-sidebar-wrapper crypto" id="main-menu-wrapper">
<ul class='wraplist'>
<li class='menusection'>Main</li>
<li class="" id="dashboard">
<a href="<?php echo FRONT_SITE_PATH?>account">
<i class="img relative crypto-ic ">
<img src="assets/image/001-dashboard.svg" alt="" class="ic1 width-20">
</i>
<span class="title">Dashboard</span>
</a>
</li>
<li class="" id="deposit-fund">
<a href="<?php echo FRONT_SITE_PATH?>deposit_fund">
<i class="img">
<img src="assets/image/002-consultant.svg" alt="" class="width-20">
</i>
<span class="title">Deposit</span>
</a>
</li>
<li class="" id="investment">
<a href="javascript:">
<i class="img">
<img src="assets/image/008-filters.svg" alt="" class="width-20">
</i>
<span class="title">Investments</span>
<span class="arrow "></span>
</a>
<ul class="sub-menu">
<li>
<a class="" href="investment">Investment</a>
</li>
<li>
<a class="" href="investment-status">Investment Status</a>
</li>
<li>
<a class="" href="investment-return-report">Investment Returns</a>
</li>
</ul>
</li>
<li class="" id="withdrawal">
<a href="javascript:;">
<i class="img">
<img src="assets/image/009-ruless.svg" alt="" class="width-20">
</i>
<span class="title">Withdrawal</span>
<span class="arrow "></span>
</a>
<ul class="sub-menu">
<li>
<a class="" href="withdrawal-status/1">Withdrawal Funds</a>
</li>
<li>
<a class="" href="withdrawal-status/2">Withdrawal Status</a>
</li>
<li>
<a class="" href="withdrawal-report">Withdrawal Report</a>
</li>
</ul>
</li>
<li class="" id="history">
<a href="javascript:;">
<i class="img">
<img src="assets/image/010-statics.svg" alt="" class="width-20">
</i>
<span class="title">Income Status</span>
<span class="arrow "></span>
</a>
<ul class="sub-menu">
<li>
<a class="" href="income-report">Account Statements</a>
</li>
<li>
<a class="" href="referral-income-report">Referral Income</a>
</li>
<li>
<a class="" href="referrals_list">Referral Report</a>
</li>
<li>
<a class="" href="transaction-report">Transactions</a>
</li>
<li>
<a class="" href="binary-report">Matching Report</a>
</li>
<li>
<a class="" href="payeer-request-fund">Request Fund</a>
</li>
</ul>
</li>
<li class="" id="edit-profile">
<a href="edit-profile">
<i class="img">
<img src="assets/image/012-informations.svg" alt="" class="width-20">
</i>
<span class="title">Edit Profile</span>
</a>
</li>
<li class="" id="settings">
<a href="javascript:;">
<i class="img">
<img src="assets/image/014-gears.svg" alt="" class="width-20">
</i>
<span class="title">Settings</span>
<span class="arrow "></span>
</a>
<ul class="sub-menu">
<li>
<a class="" href="change-google-authenticator">Google Authenticator</a>
</li>
<li>
<a class="" href="change-login-password">Change Login Password</a>
</li>
</ul>
</li>
</ul>
</div>

</div>
<script language="javascript" type="3d0912f381653dbb9764bd95-text/javascript">
    $("#dashboard").addClass("open");
  </script>
<script >
   function copyleft() {
        var copyText = document.getElementById("leftRefferal");
        copyText.select();
        document.execCommand("copy");
        alert("Copied the text: " + copyText.value);
      }

      function copyright() {
        var copyText = document.getElementById("rightRefferal");
        copyText.select();
        document.execCommand("copy");
        alert("Copied the text: " + copyText.value);
      }

      function checkauth() {
        document.forms["frmauth"].formmsg.value = "YES"
        document.forms["frmauth"].submit();
      }
    </script>
