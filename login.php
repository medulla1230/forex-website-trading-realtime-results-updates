<?php
 include('header.php'); 
?>


<style>
  
.error_field{background:red;  color: #fff; width: 100%;margin-bottom: 10px; font-weight: bolder;
  font-size: 20px;
  border-top-left-radius: 20px;border-bottom-right-radius: 20px; text-align: center;}

.success_field {background:#30b666;  color: #fff; width: 100%;margin-bottom: 10px; font-weight: bolder;
  font-size: 20px;
  border-top-left-radius: 20px;border-bottom-right-radius: 20px; text-align: center;}

</style>






<!--=================================
    Inner Header -->
    <div class="inner-header bg-light">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-sm-6 text-center text-sm-left mb-2 mb-sm-0">
            <h1 class="breadcrumb-title mb-0">Login</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb d-flex justify-content-center justify-content-sm-end ml-auto">
              <li class="breadcrumb-item"><a href=" <?php echo FRONT_SITE_PATH?> "><i class="fas fa-home mr-1"></i>Home</a></li>
              <li class="breadcrumb-item active"><span>Login</span></li>
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
          <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="false">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="" href="<?php echo FRONT_SITE_PATH?>sign_up" aria-selected="true">Register</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
              <form class="form-row mt-4 align-items-center form-flat-style" method="post" id="frmLogin">
                <div id="form_login_msg" class="success_field"></div>
                <div class="form-group col-sm-12">
                  
                  <input name="user_email" type="email" class="form-control" placeholder="Your E-mail Address:">
                </div>
                <div class="form-group col-sm-12">
                 
                  <input type="Password" name="user_password"  class="form-control" placeholder="Password:">
                </div>
                                <div class="form-group col-sm-12">
                <img src="index26c0.html?a=show_validation_image&amp;PHPSESSID=15v1bqugr1hjj92b49br4k3v60&amp;rand=2568913">
                  <label>Captcha:</label>
                  <input type=text name=validation_number class="form-control" placeholder="">
                </div>               

                 <div class="col-sm-6">
                <button type="submit" class="btn btn-primary btn-flat btn-block" id="login_submit">Sign in</button>
                          <input type="hidden" name="type" value="login"/>
                          <input type="hidden" name="is_checkout" id="is_checkout" value=""/>
                           <div id="form_login_msg" class="success_field"></div>
                </div>
                <div class="col-sm-6">
                  <ul class="list-unstyled d-flex mb-1 mt-sm-0 mt-3 justify-content-sm-end">
                    <li class="mr-1"><a class="text-dark" href="<?php echo FRONT_SITE_PATH?>forgot">Forgot your password? Click here</a></li>
                  </ul>
                </div>
              </form>
            </div>
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--=================================
  Login -->




    <?php

 include('footer.php');
  
?>