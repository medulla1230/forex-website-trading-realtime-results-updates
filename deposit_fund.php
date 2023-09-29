<?php 

 include('header_client.php');


$err_msg='';

if(isset($_POST['add_money'])){
 $amt=get_safe_value($_POST['amt']);
 if($amt>0){



    

 }else{
    $err_msg="Please enter valid amount";
 }


}





?>

<style >
    
  .wallet_loop .in{
      color: green;
      font-weight: bold;
  }

    .wallet_loop .out{
      color: red;
      font-weight: bold;
  }

</style>

<section id="main-content" class="">
<div class="wrapper main-wrapper row" style="">
<div class="col-xs-12">
<div class="page-title">
<div class="pull-left">

<h1 class="title">Deposit</h1>

</div>
<div class="pull-right hidden-xs">
<ol class="breadcrumb">
<li>
<a href="account"><i class="fa fa-home"></i>Dashboard</a>
</li>
<li class="active">
<strong>Deposit</strong>
</li>
</ol>
</div>
</div>
</div>
<div class="clearfix"></div>

<div class="clearfix"></div>
<div class="deposit-tabs">
<div>




<div class="tab-content pad-45" >

<div role="tabpanel" class="tab-pane active" id="home" >
<p class="info-warning" style="background: #30b666">If funds does not reach account balance please contact live support or mail support@fx9ja.com</a></p>
<div class="row mt-35">
 <div class="col-lg-3 col-md-3">
<div class="pay-trend">

</div>
</div>
<div class="col-lg-6 col-md-6">
<div class="payment-tabs">
<div>

<ul class="nav nav-tabs" role="tablist">
<li role="presentation" class="active"><a href="#payer" aria-controls="payer" role="tab" data-toggle="tab">Payeer</a></li>
<li role="presentation"><a href="#pm" aria-controls="pm" role="tab" data-toggle="tab">Perfect Money</a></li>
</ul>

<div class="tab-content">
<form action="https://perfectmoney.is/api/step1.asp" method="POST" name="pm_form">

</form>

<div role="tabpanel" class="tab-pane pay-single-tab" id="pm">
<ul>
<li>Network Name: Perfect Money</li>
<li>Average Arrival Time: 1 Minute</li>
</ul>
<div class="pay-adrs">
<div class="pay-fiat">
<form class="input-group input-single" method="POST"  id="FrmAddMoney">

<input type="number" maxlength="3"  name="amt" class="form-control" placeholder="USD Amount" required>
<input type="submit" class="btn w150" name="add_money" style="background-color: #30b666;">
<p id="errfund_value_pm" class="error_span">
    <?php echo $err_msg ?>
</form>
</div>
</div>
<div class="pay-only">
<div class="pay-only__info">
<h4>Send ONLY Perfect Money to this deposit address</h4>
<p>Sending other the Perfect Money may result in the loss of your deposit</p>
</div>
<div class="pay-only__icon text-right">
<img src="/guest-assets/img/crypto/pm.png" class="coin-icon">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="reports-header mt-35">
<h3 class="weight-700">Recent Deposit History</h3>
</div>

<?php
$getWallet=getWallet($_SESSION['ACCOUNT_USER_ID']);
?>
<div class="table-responsive pay-report  mt-15">
<table class="table">
<thead class="thead-dark">
<tr>
<th>S.No</th>
<th>Amount</th>
<th>Message</th>
<th>Date</th>
</tr>
</thead>
<tbody>
<?php 
     $kk=1;
     foreach($getWallet as $list)
{?>
<tr class="wallet_loop">

    <td><?php echo $kk?></td>
    <td><?php echo $list['amt']?></td>
    <td>
        
        <span class="<?php echo $list['type'] ?>">
        <?php echo $list['msg']?>
            </span>


        </td>
    <td><?php echo $list['added_on']?></td>


</tr>
 <?php 
 $kk++;
 } ?>


</tbody>
</table>
</div>
</div>
</div>
</div>
<div class="clearfix"></div>

</div>
</section>

<?php 

 include('footer_client.php');

?>