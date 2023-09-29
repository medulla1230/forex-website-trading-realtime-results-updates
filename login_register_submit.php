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
    
   

       
    

      $check=mysqli_num_rows(mysqli_query($con,"select * from user where email='$email'"));
            if($check>0){

                $arr=array('status'=>'error','msg'=>'Email is already registered','field'=>'email_error');

                
            }else{

                 $new_password=password_hash($password,PASSWORD_BCRYPT);
                 $rand_str=rand_str();
                 //$refferal_code=rand(11111,99999);
                 if(isset($_SESSION['FROM_REFERRAL_CODE']) && $_SESSION['FROM_REFERRAL_CODE']!=''){
            $from_referral_code=$_SESSION['FROM_REFERRAL_CODE'];
        }else{
            $from_referral_code=' ';
        }
                
                  mysqli_query($con,"insert into user(name,bank_name,account_no,email,mobile,password,status,email_verify,added_on,rand_str,from_referral_code) values ('$name','$bank_name','$account_no','$email','$mobile','$new_password','0','0','$added_on','$rand_str','$from_referral_code')");

                  $id=mysqli_insert_id($con);

                  $getSetting=getSetting();
                  $wallet_amt=$getSetting['wallet_amt'];
                  manageWallet($id,$wallet_amt,'in','Register');



                  unset($_SESSION['FROM_REFERRAL_CODE']);
                  //$html=FRONT_SITE_PATH."verify.php?id=".$rand_str;
                  //send_mail($email,$html,'verify your email id');



                 $arr=array('status'=>'success','msg'=>'Thank you for register. Please check your email, to verify your account','field'=>'form_msg');

            }
         echo json_encode($arr);
  }



  if($type=='login'){
    $email=get_safe_value($_POST['user_email']);
    $password=get_safe_value($_POST['user_password']);
    
    $res=mysqli_query($con,"select * from user where email='$email'  ");
    $check=mysqli_num_rows($res);
    if($check>0){   
        $row=mysqli_fetch_assoc($res);
        $status=$row['status'];
        $email_verify=$row['email_verify'];
        $dbpassword=$row['password'];
        if($email_verify==1){
            if($status==1){
                if(password_verify($password,$dbpassword)){
                    $_SESSION['ACCOUNT_USER_ID']=$row['id'];
                    $_SESSION['ACCOUNT_USER_NAME']=$row['name'];
                    $_SESSION['ACCOUNT_USER_EMAIL']=$row['email'];
                  
                    
                    $arr=array('status'=>'success','msg'=>'');
                    
                    

                    
                    
                }else{
                    $arr=array('status'=>'error','msg'=>'Please enter correct password',);
                }
            }else{
                $arr=array('status'=>'error','msg'=>'Your account has been deactivated.');
            }
        }else{
            $arr=array('status'=>'error','msg'=>'Please varify your email id');
        }
    }else{
        $arr=array('status'=>'error','msg'=>'Please enter valid email id'); 
    }
    echo json_encode($arr);
}








 if($type=='forgot'){
    $email=get_safe_value($_POST['user_email']);
   
    
    $res=mysqli_query($con,"select * from user where email='$email'  ");
    $check=mysqli_num_rows($res);
    if($check>0){   
        $row=mysqli_fetch_assoc($res);
        $status=$row['status'];
        $email_verify=$row['email_verify'];
        $id=$row['id'];
        if($email_verify==1){
            if($status==1){
                $rand_password=rand(11111,99999);
                $new_password=password_hash($rand_password,PASSWORD_BCRYPT);
                mysqli_query($con,"update user set password='$new_password' where id='$id'");
                //$html=$rand_password;
                //send_email($email,$html,'New Password');
                $arr=array('status'=>'success','msg'=>'Password has been reset and sent to your email ');
                
                    
                
            }else{
                $arr=array('status'=>'error','msg'=>'Your account has been deactivated.');
            }
        }else{
            $arr=array('status'=>'error','msg'=>'Please varify your email id');
        }
    }else{
        $arr=array('status'=>'error','msg'=>'Please enter valid email id'); 
    }
    echo json_encode($arr);
}




















?>

   