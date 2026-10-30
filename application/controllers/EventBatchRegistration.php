<?php 

date_default_timezone_set('Asia/Kolkata'); 
defined('BASEPATH') OR exit('No direct script access allowed');
class EventBatchRegistration extends CI_Controller {  

  public function __construct(){

     parent::__construct(); 

     //error_reporting(0); 
     $this->load->helper('utility_helper');
     $this->load->library('form_validation');
     $this->load->library('email');
     $this->load->model('AppModel');
     $this->load->model('UserModel');
     $this->load->model('UserTypeModel');
     $this->load->model('EventBatchregModel'); 
     $this->load->library('session');
     $this->load->model('EventModel');
     $this->load->model('DiscountModel');
     $this->load->model('EventRegModel');
  }

  public function reg_event($type,$id)

    {
      $autoDiscountData=$this->DiscountModel->getAutoDiscountEventBatchId($id);

      $allDiscountData=$this->DiscountModel->getAllDiscountEventBatchId($id);
      if($type=='batch'){  #  batch

        $batchData=$this->BatchModel->getBatchById($id);

        $data=array(
            'event_batch_title'=>'batch',

            #''=>,


        );



      } elseif($type=='event') {  #  event

        $eventData=$this->EventModel->getEventById($id);

        $data=array(
            'event_batch_title'=>'event',
            'eventData'=>$eventData,
            'autoDiscountData'=>$autoDiscountData,
            'allDiscountData'=>$allDiscountData

            );
      }

      $this->load->view('events/eve_regstration',$data);

    }

  /*public function event_batch_register()

{

  $cid=0 ;

      //Validating the information

      //error messages

      $nameerrmsg=array(

                'required'=>'Name Cannot Be Empty.',

              'alpha_numeric_spaces'=>'Name Must Contain Only Letters of English Alphabet and Spaces.'

              ) ;

      $mobileerrmsg=array(

              'required'=>'Mobile No. Cannot Be Empty.',

              'numeric'=>'Mobile No. Must Be 10-Digit Number',

              'exact_length'=>'Mobile No. Must Be 10-Digit Number'

              ) ;

      $emailerrmsg=array(

              'required'=>'Email Cannot Be Empty.',

              'valid_email'=>'Email Must Be A Valid Email.'

              ) ;

      $this->form_validation->set_rules('fullname','Name','required|alpha_numeric_spaces',$nameerrmsg);

      $this->form_validation->set_rules('mobileno','Mobile No.','required|numeric|exact_length[10]',$mobileerrmsg);

      $this->form_validation->set_rules('email','Email ID','required|valid_email',$emailerrmsg);



    if($this->form_validation->run()){

        $name=$this->input->post('fullname');

        $email_id=$this->input->post('email');

        $mobile_no=$this->input->post('mobileno');

        $event_id=$this->input->post('event_batch_id');



        $otp = mt_rand(100000,999999); 

          //---------Database Section---------------

          $cid=$this->EventBatchregModel->saveOTP($email_id,$mobile_no,$otp);

          if($cid>0)

          { 

       //------Email Section------------------

            $userMailStatus=$this->ConfirmationMail($email_id,$name,$otp);

       

             //Send mail

             if($userMailStatus){

               $this->session->set_flashdata("success","Check Your Email (Inbox/Spam/Junk Folder) for OTP"); 

             }else {

               $this->session->set_flashdata("success","Kindly Check Your Email (Inbox/Spam/Junk Folder) for confirmation"); 

             }

           

          }else{



            $this->session->set_flashdata("error","Some Error Occured While Sending Your Details. Try Again Later!"); 

        }

    

  }else{



    $this->session->set_flashdata('error', validation_errors());



  }

    

  redirect($event_batch_route);

  

} */









public function otp_auth()

{   

    //$date=date_create();
    $currentTime=date('D M d Y H:i:s O');
    $email=$this->input->post('email');
    $fname=$this->input->post('fname');
    $lname=$this->input->post('lname');
    $fullname=$fname.' '.$lname;
    $otp = mt_rand(100000,999999); 
    $data=array('email'=>$email,'otp'=>$otp,'timestamp'=>$currentTime);

   $this->ConfirmationMail($email,$otp);
   echo json_encode($data);

   $this->EventBatchregModel->saveOTP($otp,$email);
}





//=============Email confirmation For User =============

/* ============comment otp verification email by user=====

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

        '<strong>Whatsapp</strong>- <a href="tel:+91 8178888979">+91 8178888979</a>'

      ); 



       if ($this->email->send()) {

            $status = true;

       }else{

            $status = false;

			

       }

  return $status;

}



============comment otp verification email by user=====*/



}?>