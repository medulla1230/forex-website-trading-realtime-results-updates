<?php
include ("header.php");

$msg="";
//Email id verify
if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($_GET['id']);
	mysqli_query($con,"update user set email_verify=1 where rand_str='$id'");
	$msg="Email id verify";
	  



	
	/*$res=mysqli_query($con,"select from_referral_code,email from user where rand_str='$id'");
	if(mysqli_num_rows($res)>0){
		$row=mysqli_fetch_assoc($res);
		$email=$row['email'];
		$from_referral_code=$row['from_referral_code'];
		$row=mysqli_fetch_assoc(mysqli_query($con,"select id from user where referral_code='$from_referral_code'"));
		$uid=$row['id'];
		$msg1='Referral Amt from '.$email;
		manageWallet($uid,50,'in',$msg1);
	}*/
	
	
}else{
	redirect(FRONT_SITE_PATH);
}
?>










<style>
  
.error {background: #30b666;color: #fff;width: 100%;margin-bottom: 10px;padding: 15px;border-top-left-radius: 20px;border-bottom-right-radius: 20px;}

</style>







<!--=================================
    Inner Header -->
    <div class="inner-header bg-light">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-sm-6 text-center text-sm-left mb-2 mb-sm-0">
            <h1 class="breadcrumb-title mb-0"> Email Verification</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb d-flex justify-content-center justify-content-sm-end ml-auto">
              <li class="breadcrumb-item"><a href=" <?php echo FRONT_SITE_PATH?> "><i class="fas fa-home mr-1"></i>Home</a></li>
              <li class="breadcrumb-item active"><span> Email Verify</span></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  <!--=================================
  Inner Header -->

  <!--=================================
  Login -->
  <section class="space-ptb login">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-9 col-sm-11">
         
          <div class="tab-content" id="myTabContent">
            
            <?php
								echo $msg;
								?>
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--=================================
  Login -->























<?php
include("footer.php");
?>