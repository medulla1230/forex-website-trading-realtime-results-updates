   <?php

   include('header.php');

   ?>
    <!--=================================
    Header -->


    <!--=================================
    Inner Header -->
    <div class="inner-header bg-light">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-sm-6 text-center text-sm-left mb-2 mb-sm-0">
            <h1 class="breadcrumb-title mb-0">Contact us</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb d-flex justify-content-center justify-content-sm-end ml-auto">
              <li class="breadcrumb-item"><a href="indexbc14.html?a=home"><i class="fas fa-home mr-1"></i>Home</a></li>
              <li class="breadcrumb-item active"><span>Contact us</span></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  <!--=================================
  Inner Header -->

  <!--=================================
  Contact Address -->
  <section class="space-ptb">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 pr-lg-5 border-right border-lg-none">
          <p class="mb-4 mb-lg-5">It would be great to hear from you! If you got any questions, please do not hesitate to send us a message. We are looking forward to hearing from you!</p>
          <div class="mb-4 mb-lg-5">
            <h6 class="mb-3">Headquarters</h6>
            <p class="mb-0">80 Wood Ln, London
United Kingdom, W12 0BZ</p>
            <div><strong>Telephone:</strong><span class="text-primary ml-1">VIP Clients Only</span></div>
            <div><strong>E-mail:</strong><span class="text-primary ml-1">support@hourget.com</span></div>
          </div>
          
        </div>
        <script language=javascript>

function checkform() {
  if (document.mainform.name.value == '') {
    alert("Please type your full name!");
    document.mainform.name.focus();
    return false;
  }
  if (document.mainform.email.value == '') {
    alert("Please enter your e-mail address!");
    document.mainform.email.focus();
    return false;
  }
  if (document.mainform.message.value == '') {
    alert("Please type your message!");
    document.mainform.message.focus();
    return false;
  }
  return true;
}

</script>



<div class="col-lg-7 pl-lg-5 mt-lg-0 mt-4">
          <h6 class="mb-4">Need Assistance? <br>Please Complete The Contact Form</h6>
          <form class="form-flat-style" method=post name=mainform onsubmit="return checkform()"><input type="hidden" name="form_id" value="16235844011337"><input type="hidden" name="form_token" value="f7a5320d2b142164b57918b80b3f73b1">
          <input type=hidden name=a value=support>
<input type=hidden name=action value=send>
            <div class="row">
              <div class="form-group col-md-4">
                <input name="name" value="" type="text" class="form-control" placeholder="Your Name">
              </div>
              <div class="form-group col-md-4">
                <input name="email" value="" type="email" class="form-control" placeholder="Your Email">
              </div>
              <div class="form-group col-md-4">
                <input type="text" class="form-control" placeholder="Subject">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <textarea name="message" rows="8" class="form-control" id="sector" placeholder="Your Message"></textarea>
              </div>
            </div>
                            <div style="padding-left: 0px;padding-right: 0px;" class="form-group col-sm-12">
                <img src="index09fc.html?a=show_validation_image&amp;PHPSESSID=15v1bqugr1hjj92b49br4k3v60&amp;rand=24278231">
                  <label>Captcha:</label>
                  <input type=text name=validation_number class="form-control" placeholder="">
                </div>            <button style="max-width: 170px;" type="submit" class="btn btn-primary btn-flat btn-block">Send Message</button>
          </form>
        </div>

      </div>
    </div>
  </section>
  <!--=================================
  Contact Address -->

  




    <!--=================================
    footer-->
   <?php

   include('footer.php');

   ?>