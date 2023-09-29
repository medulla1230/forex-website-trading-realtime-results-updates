<?php
session_start();
include('database.inc.php');
include('function.inc.php');
include('constant.inc.php');
?>


<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="fxja.com - We Trade, You Profit !" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  

    <title><?php echo SITE_NAME." - ".FRONT_SITE_NAME;?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo FRONT_SITE_PATH?>images/favicon.ico" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Heebo:400,500,700%7CMontserrat:500,700&amp;display=swap" rel="stylesheet">

    <!-- CSS Global Compulsory (Do not remove)-->
    <link rel="stylesheet" href="<?php echo FRONT_SITE_PATH?>css/font-awesome/all.min.css" />
    <link rel="stylesheet" href="<?php echo FRONT_SITE_PATH?>css/flaticon/flaticon.css" />
    <link rel="stylesheet" href="<?php echo FRONT_SITE_PATH?>css/bootstrap/bootstrap.min.css" />

    <!-- Page CSS Implementing Plugins (Remove the plugin CSS here if site does not use that feature) -->
    <link rel="stylesheet" href="<?php echo FRONT_SITE_PATH?>css/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?php echo FRONT_SITE_PATH?>css/swiper/swiper.min.css" />
    <link rel="stylesheet" href="<?php echo FRONT_SITE_PATH?>css/animate/animate.min.css"/>
    <link rel="stylesheet" href="<?php echo FRONT_SITE_PATH?>css/magnific-popup/magnific-popup.css" />

    <!-- Template Style -->
    <link rel="stylesheet" href="<?php echo FRONT_SITE_PATH?>css/style.css" />

  </head>
  <body>
  
<style>
    * {
  font-family: sans-serif;
  box-sizing: border-box;
}

.introloader {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background: #fff;
}

.spinner {
  position: absolute;
  top: 50%;
  left: 50%;
  margin: -25px 0 0 -25px;
  width: 50px;
  height: 50px;
  border: 5px solid #efefef;
  border-radius: 50%;
}
.spinner-inner {
  position: absolute;
  top: -5px;
  right: -5px;
  bottom: -5px;
  left: -5px;
  border-radius: 50%;
  border-width: 5px;
  border-style: solid;
  border-color: #30b666 transparent transparent transparent;
  border-radius: 50%;
  animation: infinite-spinning 1s linear infinite;
}

@keyframes infinite-spinning {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}

@-webkit-keyframes infinite-spinning {
  from {
    -webkit-transform: rotate(0deg);
  }
  to {
    -webkit-transform: rotate(360deg);
  }
}
</style>

  <div style="z-index: 1000000;" id="introLoader" class="introloader">
  <div class="spinner">
    <div class="spinner-inner"></div>
  </div>
</div>



    <!--=================================
    Header -->
    <header class="header header-sticky default">
      <div class="topbar">
        <div class="container">
          <div class="topbar-inner">
            <div class="row">
              <div class="col-12">
                <div class="d-block d-md-flex align-items-center text-center">
                  <div class="mr-3 d-inline-block">
                    <a href="mailto:info@example.com"><i class="fas fa-envelope mr-2 fa-flip-horizontal"></i>support@fx9ja.com</a>
                  </div>
                  <div class="mr-auto d-inline-block">
                    <a href="tel:+2348042494650"><i class="fa fa-phone mr-2 fa fa-flip-horizontal"></i>VIP Clients Only</a>
                  </div>
                  <div class="social d-inline-block">
                    <ul class="list-unstyled">
                      <li><a href="#"> <i class="fab fa-facebook-f"></i> </a></li>
                      <li><a href="#"> <i class="fab fa-twitter"></i> </a></li>
                      <li><a href="#"> <i class="fab fa-pinterest-p"></i> </a></li>
                      <li><a href="#"> <i class="fab fa-linkedin-in"></i> </a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <nav class="navbar navbar-static-top navbar-expand-xl">
        <div class="container position-relative">
          <button type="button" class="navbar-toggler" data-toggle="collapse" data-target=".navbar-collapse"><i class="fas fa-align-left"></i></button>
          <a class="navbar-brand" href="<?php echo FRONT_SITE_PATH?>home">
            <img class="img-fluid" src="<?php echo FRONT_SITE_PATH?>images/logo.svg" alt="logo">
          </a>
          <div class="navbar-collapse collapse justify-content-center">
            <ul class="nav navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href="<?php echo FRONT_SITE_PATH?>" aria-expanded="false">Home</a>
                
            
              <li class="nav-item dropdown">
                <a class="nav-link" href="<?php echo FRONT_SITE_PATH?>faq" aria-expanded="false">FAQ</a>
                
                             
                            <li class="nav-item dropdown">
                <a class="nav-link" href="<?php echo FRONT_SITE_PATH?>login" aria-expanded="false">Login</a>
                
              </li>

               
              <li class="nav-item dropdown">
               <a class="nav-link" href="<?php echo FRONT_SITE_PATH?>sign_up" aria-expanded="false">Sign Up</a>
                
              </li>
          
             
                            <li class="nav-item dropdown">
                <a class="nav-link" href="<?php echo FRONT_SITE_PATH?>support" aria-expanded="false">Support</a>


                            <li class="nav-item dropdown">
                <a class="nav-link" href="<?php echo FRONT_SITE_PATH?>trades" aria-expanded="false">Trading
<i class="fas fa-arrow-up mr-2 fa-flip-horizontal" style="font-size: 12px; color: green;"></i>
                  </a>
                
              </li>
            </ul>
          </div>
          <div class="" style="
    display: -webkit-inline-box;
">            
              
               
              <a style="background: #291843;border-color: #291843; margin-right: 10px!important;" class="btn btn-primary btn-md mr-5 mr-xl-0 d-none d-sm-block" href="<?php echo FRONT_SITE_PATH?>sign_up"> Sign Up </a>
            
              
                
              <a class="btn btn-primary btn-md mr-5 mr-xl-0 d-none d-sm-block" href="<?php echo FRONT_SITE_PATH?>login"> Login </a>

               



       




          </div>
        </div>
      </nav>
    </header>
    <br> <br> <br>
    <!--=================================
    Header -->