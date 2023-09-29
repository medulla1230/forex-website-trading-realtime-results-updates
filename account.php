<?php

 include('header_client.php');


?>



<section id="main-content" class=" ">
<div class="wrapper main-wrapper row" style=''>
<div class='col-xs-12'>
<div class="page-title">
<div class="">


<h1 class="title d-inline-block">Dashboard  </h1>

</div>

</div>
</div>
<div class="clearfix"></div>
<div class='col-xs-12'>
<div class="pull-left">


<h4 class="title boldy mb-5 mt-15">Balance</h4>

</div>
</div>
<div class="col-lg-12">
<section class="box nobox marginBottom0">
<div class="content-body">
<div class="row">
<div class="col-lg-4 col-sm-4 col-xs-12">
<div class="statistics-box">
<div class="mb-15">
<i class="pull-left ico-icon icon-md icon-primary">
<img src="data/crypto-dash/s1.png" class="ico-icon-o" alt="">
</i>
<div class="">
<div class="coin-box flex align-items-center">
<div class="coin-icon mr-10">
<img src="assets/image/ac-bals.svg" alt="">
</div>
<div class="coin-balance text-left">
<h5 class="coin-name boldy">Account Balance</h5>
<p class="mb-0" style="font-weight: bolder; color: green; font-size: 20px;"> $ <?php echo $getWalletAmt; ?>  <i class="complete fa fa-arrow-up ml-10"></i></p>
</div>

</div>


</div>
</div>
<span class="crypto2"><canvas width="374" height="60" style="display: inline-block; width: 374px; height: 60px; vertical-align: top;"></canvas></span>
</div>
</div>
<div class="col-lg-4 col-sm-4 col-xs-12">
<div class="statistics-box">
<div class="mb-15">
<i class="pull-left ico-icon icon-md icon-primary">
<img src="assets/image/s2.png" class="ico-icon-o" alt="">
</i>
<div class="">
<div class="coin-box flex align-items-center" >
<div class="coin-icon mr-10">
<img src="assets/image/e-wallet.svg" alt="">
</div>
<div class="coin-balance text-left">
<h5 class="coin-name boldy">Profit/Loss</h5>
<p class="mb-0" style="font-weight: bolder; color: green; font-size: 20px;"> $


	<?php
  
      echo $NetProfitLoss;

    ?>

  

    <i class="complete fa fa-arrow-up ml-10"></i></p>
</div>

</div>
      

</div>
 </div>
 <span class="crypto1"><canvas width="374" height="60" style="display: inline-block; width: 374px; height: 60px; vertical-align: top;"></canvas></span>


</div>
</div>
<div class="col-lg-4 col-sm-4 col-xs-12" >
<div class="statistics-box" >
<div class="mb-15">
<i class="pull-left ico-icon icon-md icon-primary">
<img src="assets/image/s2.png" class="ico-icon-o" alt="">
</i>
<div class="">
<div class="coin-box flex align-items-center" >
<div class="coin-icon mr-10">
<img src="assets/image/e-wallet.svg" alt="">
</div>
<div class="coin-balance text-left">
<h5 class="coin-name boldy">Percentage Growth</h5>
<p class="mb-0" style="font-weight: bolder; color: green; font-size: 20px;"> 


	<?php
  
     echo $pergrowth;

    ?>%





    <i class="complete fa fa-arrow-up ml-10"></i></p>
</div>

</div>


</div>
 </div>
<span class="crypto2"><canvas width="374" height="60" style="display: inline-block; width: 374px; height: 60px; vertical-align: top;"></canvas></span>

</div>
</div>
</div>

</div>
</section>
</div>


<div class="col-lg-12">
<section class="box nobox marginBottom0">
<div class="content-body">
<div class="row">
<div class="col-lg-3 col-sm-6 col-xs-12">
<div class="statistics-box">
<div class="mb-15">
<i class="pull-left ico-icon icon-md icon-primary">
<img src="assets/image/001-wealth.svg" class="ico-icon-o" alt="">
</i>
<div class="stats">
<h3 class="boldy mb-5" >Investment</h3>
<span>Invest Now</span>
</div>
<div class="inv-pr">
<a href="investments" class="btn btn-in" style="background: #30b666">Invest</a>
</div>
</div>
</div>
</div>
<div class="col-lg-3 col-sm-6 col-xs-12">
<div class="statistics-box">
<div class="mb-15">
<i class="pull-left ico-icon icon-md icon-primary">
<img src="assets/image/002-wallets.svg" class="ico-icon-o" alt="">
</i>
<div class="stats">
<h3 class="boldy mb-5">Add Fund</h3>
<span>Add Fund To Wallet</span>
</div>
</div>
<div class="inv-pr">
<a href="deposit-fund" class="btn btn-in" style="background: #30b666">Deposit</a>
</div>
</div>
</div>
<div class="col-lg-3 col-sm-6 col-xs-12">
<div class="statistics-box">
<div class="mb-15">
<i class="pull-left ico-icon icon-md icon-primary">
<img src="assets/image/003-charts.svg" class="ico-icon-o" alt="">
</i>
<div class="stats">
<h3 class="boldy mb-5">Reports</h3>
<span>Transaction Reports</span>
</div>
</div>
<div class="inv-pr">
<a href="transaction-report" class="btn btn-in" style="background: #30b666">View Report</a>
</div>
 </div>
</div>
<div class="col-lg-3 col-sm-6 col-xs-12">
<div class="statistics-box">
<div class="mb-15">
<i class="pull-left ico-icon icon-md icon-primary">
<img src="assets/image/004-payments.svg" class="ico-icon-o" alt="">
</i>
<div class="stats">
<h3 class="boldy mb-5">Profile</h3>
<span>Edit Profile</span>
</div>
</div>
<div class="inv-pr">
<a href="edit-profile" class="btn btn-in" style="background: #30b666">Update Profile</a>
</div>
</div>
</div>
</div>

</div>
</section>
</div>
<div class="clearfix"></div>

<div class="clearfix"></div>



































<div class="clearfix"></div>

<div class="col-lg-4 col-md-6 col-xs-12">
<section class="box" style="overflow:hidden">
<header class="panel_header">
<h2 class="title pull-left">Profile</h2>
<div class="actions panel_actions pull-right">
<a class="box_toggle fa fa-chevron-down"></a>
<a class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></a>
<a class="box_close fa fa-times"></a>
</div>
</header>
<div class="content-body">
<div class="uprofile-image mt-30">
<div class="prof-contain relative">
<img alt="" src="assets/image/user1.png" class="img-responsive">
<span class="prof-check fa fa-check"></span>
</div>
</div>
<div class="uprofile-name">
<h3>
<a href="#">Are alec</a>



<span class="uprofile-status online"></span>
</h3>
<p class="uprofile-title">Crypto Trader</p>
</div>
<div class="uprofile-info v2">
<ul class="list-unstyled mb-0">
<li class="pt0"><h5 class="mt-0 mb-0"> Member ID:</h5><span><strong>RNF1001838</strong></span></li>
<li><h5 class="mt-0 mb-0"> Total Earned:</h5><span><strong>$0.00</strong></span></li>
<li><h5 class="mt-0 mb-0"> Total Investment:</h5><span><strong>$0.00</strong></span></li>
<li><h5 class="mt-0 mb-0"> Total Withdrawal:</h5><span><strong>$0.00</strong></span></li>
<li><h5 class="mt-0 mb-0"> Date of Joining:</h5><span><strong> 13 Jun, 2021 07:03:20 AM</strong></span></li>
<li><h5 class="mt-0 mb-0"> Total Active Referrals:</h5><span><strong>0</strong></span></li>
<li><h5 class="mt-0 mb-0"> Total Inactive Referrals:</h5><span><strong>0</strong></span></li>
</ul>
</div>
</div>
</section>
</div>

<div class="col-xs-12 col-md-6 col-lg-8">
<section class="box ">
<header class="panel_header">
<h2 class="title pull-left">Last 5 Transactions</h2>
<div class="actions panel_actions pull-right">
<a class="box_toggle fa fa-chevron-down"></a>
<a class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></a>
<a class="box_close fa fa-times"></a>
</div>
</header>
<div class="content-body">
<div class="row">
<div class="col-xs-12">
<div class="table-responsive" data-pattern="priority-columns">
<table id="tech-companies-1" class="table vm trans table-small-font no-mb table-bordered table-striped">
<thead>
<tr>
<th>Trans.</th>

<th>Trans. No.</th>
<th>Trans. Date</th>
<th>Description</th>
<th>Amount</th>
<th>Type</th>
<th>Balance</th>
</tr>
</thead>
<tbody>
<tr><td colspan=7 align="center">No Transactions Exist</td></tr>
</tbody>
</table>
</div>
</div>
</div> 
</div>
</section>
<div class="">
<section class="box" style="overflow:hidden">
<header class="panel_header">
<h2 class="title pull-left">Crypto Balance Statistics</h2>
<div class="actions panel_actions pull-right">
<a class="box_toggle fa fa-chevron-down"></a>
<a class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></a>
<a class="box_close fa fa-times"></a>
</div>
</header>
<div class="content-body">
<div class="row">
<div class="col-xs-12">
<div id="crypto-chart">
<div id="demoarea-container" style="width: 100%;height:380px; text-align: center; margin:0 auto;"></div>
</div>
</div>
</div>
</div>
</section>
</div>
</div>
<div class="clearfix"></div>
<div class="col-xs-12 col-md-6">
<section class="box link-hdr">
<header class="panel_header aff-link-hdr">
<h2 class="title pull-left">Left Referral Link</h2>
<p>
Please copy and paste left referral link
</p>
</header>
<div class="content-body pb10">
<div class="text-center text-affl">
<h4 class="aff-link">
<h4 class="aff-link" ><input type="text" class="form-control" id="leftRefferal" value="https://richnetfunds.com/register/RNF1001838/left" readonly=""></h4>

<input style="background: #30b666" type="text" class="btn btn-block btn-primary" style="margin-top: 0;" onclick="if (!window.__cfRLUnblockHandlers) return false; copyleft()" value="Copy Link" data-cf-modified-3d0912f381653dbb9764bd95-="">
</div>
</div>
</section>
</div>
<div class="col-xs-12 col-md-6">
<section class="box link-hdr">
<header class="panel_header aff-link-hdr">
<h2 class="title pull-left">Right Referral Link</h2>
<p>
Please copy and paste right referral link
</p>
</header>
<div class="content-body pb10">
<div class="text-center text-affl">
<h4 class="aff-link"><input type="text" class="form-control" id="rightRefferal" value="https://richnetfunds.com/register/RNF1001838/right" readonly=""></h4>
<input style="background: #30b666" type="text" class="btn btn-block btn-primary" style="margin-top: 0;" onclick="if (!window.__cfRLUnblockHandlers) return false; copyright()" value="Copy Link" data-cf-modified-3d0912f381653dbb9764bd95-="">
</div>
</div>
</section>
</div>
<div class="clearfix"></div>


<div class="chatapi-windows ">
</div>
</div>



 <?php

 include('footer_client.php');

?>























