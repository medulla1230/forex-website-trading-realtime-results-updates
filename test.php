<?php
session_start();
include('database.inc.php');
include('function.inc.php');
include('constant.inc.php');
//include('smtp/PHPMailerAutoload.php');
     
    $type=get_safe_value($_POST['type']);
    $added_on=date('Y-m-d h:i:s');
    if($type=='register'){
    $name=get_safe_value($_POST['name']);
    $bank_name=get_safe_value($_POST['bank_name']);
    $account_no=get_safe_value($_POST['account_no']);
    $email=get_safe_value($_POST['email']);
    $mobile=get_safe_value($_POST['mobile']);
    $password=get_safe_value($_POST['password']);
    $password2=get_safe_value($_POST['password2']);
    

    $pattern_fn = "/^[a-z A-Z]{7,}$/";
    if(preg_match($pattern_fn,$name)){
      if($password == $password2){
             //mobile validation
            $pattern_fn = "/^[0-9]{11}$/";
            if(preg_match($pattern_fn,$mobile)){
                   //account_no validation
            $pattern_fn = "/^[0-9]{10}$/";
            if(preg_match($pattern_fn,$account_no)){
                //email verification
            //filter_var($reg_email, FILTER_VALIDATE_EMAIL);
            $pattern_email = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/";
            if(preg_match($pattern_email, $email)){

            $check=mysqli_num_rows(mysqli_query($con,"select * from user where email='$email'"));
            if(!$check>0){
                 
                  mysqli_query($con,"insert into user(name,bank_name,account_no,email,mobile,password,status,email_verify,added_on) values('$name','$bank_name','$account_no','$email','$mobile','$password','0','0','$added_on')");

                 $arr=array('status'=>'success','msg'=>'Thank you for register. Please check your email, to verify your account','field'=>'form_msg');
     
           
            }else{
                  $arr=array('status'=>'error','msg'=>'Email is already registered','field'=>'email_error');
            
            }     
                  
            }else{
                $arr=array('status'=>'error','msg'=>'Invalid email format','field'=>'email_invalid_error');
                 
            }
                  
                 
            }else{
                 $arr=array('status'=>'error','msg'=>'Please enter correct account number','field'=>'account_error');
            }

                
            }else{
                $arr=array('status'=>'error','msg'=>'Please enter correct mobile number','field'=>'mobile_error');
            }
      
            }else{
                 $arr=array('status'=>'error','msg'=>'Password does not Matched','field'=>'password_error');
            
            }


     } else{

         $arr=array('status'=>'error','msg'=>'Please enter your full name','field'=>'name_error');
        
     }



        echo json_encode($arr);
   }
?>

