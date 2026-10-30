<?php 
date_default_timezone_set('Asia/Kolkata'); 
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class GenerateOtp extends CI_Controller {  

  public function __construct(){

     parent::__construct(); 
     //error_reporting(0); 
     
     $this->load->helper('utility_helper');
     
     $this->load->library('form_validation');
     
     $this->load->library('email');
     
     $this->load->model('AppModel');
     
     $this->load->model('UserModel');
     
     $this->load->model('OtpModel');

     $this->load->model('UserTypeModel');

  }

  public function otp_auth()
  {   
    //$date=date_create();

    $currentTime=date('D M d Y H:i:s O');

    $email=$this->input->post('email');
    
    $otp = mt_rand(100000,999999); 

    $data=array('email'=>$email,'otp'=>$otp,'timestamp'=>$currentTime);

    $otp_id=$this->OtpModel->saveOTPtoDB($otp,$email);

    if($otp_id>0){

      $status=$this->ConfirmationMail($email,$otp);
      if($status){

        echo json_encode($data);

      }
      else{echo "nil";}

    }else{ echo "nil";}
}


//=============Email confirmation For User =============
/* ============comment otp verification code ========
public function ConfirmationMail($email_id,$otp)
{
  
      $from_email = "enquiry@theiotacademy.co";
      $to_email = $email_id;
       
       $this->email->from($from_email,'The IOT Academy'); 
       $this->email->to($to_email);
       $this->email->subject('Email Verification OTP'); 
       $this->email->message(

       'Your OTP For Registration is<br>'.'<a><h2>'.$otp.'</h2></a>'.
        '<br>Regards,<br>'.
        'The IoT Academy<br>'.
        '<strong>Whatsapp</strong>- <a href="tel:+91 8287096558">+91 8287096558</a>'
      ); 

       if ($this->email->send()) {
            $status = true;
       }else{
            $status = false;
       }
  return $status;
}


 ============comment otp verification code ========*/

}?>