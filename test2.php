
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
            <h1 class="breadcrumb-title mb-0">Register Account</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb d-flex justify-content-center justify-content-sm-end ml-auto">
              <li class="breadcrumb-item"><a href="<?php echo FRONT_SITE_PATH?>"><i class="fas fa-home mr-1"></i>Home</a></li>
              <li class="breadcrumb-item active"><span>Register Account</span></li>
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
              <a class="nav-link" href="<?php echo FRONT_SITE_PATH?>login" role="tab" aria-selected="false">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="true">Register</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="login-tab">
              <form class="form-row mt-4 align-items-center form-flat-style"><input type="hidden" name="form_id" value="16235843994939"><input type="hidden" name="form_token" value="16782fdbebcf6d5b5b0d022d13cd67a2">
                <div class="form-group col-sm-12">
                  <label>Username:</label>
                  <input type="text" class="form-control" placeholder="">
                </div>
                <div class="form-group col-sm-12">
                  <label>Password:</label>
                  <input type="Password" class="form-control" placeholder="">
                </div>
                <div class="col-sm-6">
                  <button type="submit" class="btn btn-primary btn-flat btn-block">Sign in</button>
                </div>
                <div class="col-sm-6">
                  <ul class="list-unstyled d-flex mb-1 mt-sm-0 mt-3 justify-content-sm-end">
                    <li class="mr-1"><a class="text-dark" href="#">Don't have an account? Click here</a></li>
                  </ul>
                </div>
              </form>
            </div>
            <div class="tab-pane fade active show" id="register" role="tabpanel" aria-labelledby="register-tab">
              <form class="form-row mt-4 mb-4 mb-sm-5 align-items-center form-flat-style" method="post" id="frmRegister">      

                <div id="form_msg" class="success_field"></div>
                
               
                <div class="form-group col-sm-12">
                  
                  <input type="text" name="name" value="" class="form-control" placeholder="Your Full Name:" required>
                 
                 </div>
                 <div id="name_error"  class="error_field"> </div>

                
                <div class="form-group col-sm-6">
                  <select  class="form-control" name="bank_name" required>
                 <option value="" selected="selected">Select Your Bank Name</option>
                  <?php include('bank_name.php'); ?>
                  </select>
                </div>
                 <div class="form-group col-sm-6">
                  
                  <input type=text name="account_no" value="" class="form-control" placeholder="Account Number"required>
                </div>
                 <div id="account_error"  class="error_field"> </div>
                 <div class="form-group col-sm-12" >
                
                  <input type="email" name="email" value="" class="form-control" placeholder="Your E-mail Address:" required >
                </div>

                <div id="email_invalid_error"  class="error_field"> </div>
                  <div id="email_error"  class="error_field"> </div>
                 

                <div class="form-group col-sm-6">
                
                  <input type=password name="password" value="" class="form-control" placeholder="Password:" required>
                </div>
                <div class="form-group col-sm-6">
                  
                  <input type=password name="password2" value="" class="form-control" placeholder="Confirm Password:" required>
                  
                </div>

                 <div id="password_error"  class="error_field"> </div>
         
                <div class="form-group col-sm-12">
                  
                  <input type=text name="mobile" value="" class="form-control" placeholder="Mobile Number (08033333333)" required>
                   <div id="mobile_error"  class="error_field"> </div>
                </div>
              
                  
                                                <div class="form-group col-sm-12">
                <img src="index358d.html?a=show_validation_image&amp;PHPSESSID=15v1bqugr1hjj92b49br4k3v60&amp;rand=1170868378">
                  <label>Captcha:</label>
                  <input type=text name=validation_number class="form-control" placeholder="">
                </div><div class="form-group col-sm-12">
                <tr>
 <td colspan=2><input type=checkbox name=agree value=1  > I agree with <a href="indexa972.html?a=rules">Terms and conditions</a></td>
</tr></div>

                <div class="col-sm-6">
                  <button type="submit" class="btn btn-primary btn-flat btn-block" id="register_submit">Sign up</button>
                </div>
                <input type="hidden" name="type" value="register"/>
               

                <div class="col-sm-6">
                  <ul class="list-unstyled d-flex mb-1 mt-sm-0 mt-3">
                    <li class="mr-1"><a href="indexc30b.html?a=login">Already Registered User? Click here to login</a></li>
                  </ul>
                </div>
              </form>
              
          </div>
        </div>
      </div>
    </div>
  </section>  <!--=================================
  Login -->


    <!--=================================
    footer-->
   <?php
    
    include('footer.php');


   ?>