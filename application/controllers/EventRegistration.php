<?php 
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class EventRegistration extends CI_Controller {  

  public function __construct(){
    parent::__construct(); 
    //error_reporting(0); 
     $this->load->helper('utility_helper');
     $this->load->library('form_validation');
     $this->load->library('email');
     $this->load->model('AppModel');
     $this->load->model('UserModel');
     $this->load->model('UserTypeModel'); 
     $this->load->library('session');
     $this->load->model('EventModel');
     $this->load->model('EventRegModel');
     
  }

  public function event_register()
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
              'numeric'=>'Mobile No. Min Length Must Be 10-Digit Number',
              'min_length'=>'Mobile No. Min Length Must Be 10-Digit Number'
              ) ;
      $emailerrmsg=array(
              'required'=>'Email Cannot Be Empty.',
              'valid_email'=>'Email Must Be A Valid Email.'
              ) ;
      $this->form_validation->set_rules('fullname','Name','required|alpha_numeric_spaces',$nameerrmsg);
      $this->form_validation->set_rules('mobileno','Mobile No.','required|numeric|min_length[10]',$mobileerrmsg);
      $this->form_validation->set_rules('email','Email ID','required|valid_email',$emailerrmsg);

    if($this->form_validation->run()){
        $name=$this->input->post('fullname');
        $email_id=$this->input->post('email');
        $mobile_no=$this->input->post('mobileno');
        $event_id=$this->input->post('event_id');
        $event_name=$this->input->post('event_name');
        $event_type=$this->input->post('event_type');
        $message=$this->input->post('message');
        $event_route=$this->input->post('event_route');
        $start_date=$this->input->post('start_date');
        $end_date=$this->input->post('end_date');
        echo "name : $name<br>";
        echo "email_id : $email_id<br>";
        echo "mobile_no : $mobile_no<br>";
        echo "event_id : $event_id<br>"; 
        echo "message : $message<br>";

          //---------Database Section---------------
          $cid=$this->EventRegModel->register_event($event_id,$name,$email_id,$mobile_no);
          if($cid>0)
          { 
       //------Email Section------------------
      $adminMailStatus=$this->adminConfirmationMail($email_id,$name,$mobile_no,$event_name,$message,$event_route);
      $userMailStatus=$this->userConfirmationMail($email_id,$name,$event_name,$event_type,$start_date,$end_date,$event_route);
       
       //Send mail
       if( $adminMailStatus || $userMailStatus){
         $this->session->set_flashdata("success","Your Query Has Been Sent To Admin Successfully.<br>Kindly Check Your Email (Inbox/Spam/Junk Folder) for confirmation"); 
       }else {
         $this->session->set_flashdata("success","Your Query Has Been Saved Successfully.<br>Kindly Check Your Email (Inbox/Spam/Junk Folder) for confirmation"); 
       }
           
        }else{
            $this->session->set_flashdata("error","Some Error Occured While Sending Your Details. Try Again Later!"); 
        }
    
  }else{
    $this->session->set_flashdata('error', validation_errors());
  }
    
   redirect($event_route);
  
} 
//=============Email confirmation For Admin=============

public function adminConfirmationMail($email_id,$name,$mobile_no,$event_name,$message,$event_route)
{
      $from_email = "info@theiotacademy.co";
      $to_email = "enquiry@theiotacademy.co";
       
       $this->email->from($from_email,'Enquiry | The IoT Academy'); 
       $this->email->to($to_email);
       $this->email->subject('Event Registration'); 
       $this->email->message('<strong>Event Title : <br> '.$event_name.'</strong><br> Email Id:- '.$email_id.
       '<br>Name:- '.$name.'<br>Mobile No.:- '.$mobile_no.'<br>Message:- '.$message.'<br><strong>Register Event For : </storng>'.$event_route); 
       if ($this->email->send()) {
            $status = true;
       }else{
            $status = false;
       }
  return $status;
}
//=============Email confirmation For User =============

public function userConfirmationMail($email_id,$name,$event_name,$event_type,$start_date,$end_date,$event_route)
{
  if($start_date!=$end_date)
  {
    $datemsg='The Event is scheduled for '.date('d-F-Y',strtotime($start_date)).' To '.date('d-F-Y',strtotime($end_date)).'from 10 AM to 6 PM.<br> ';
  }else{
    $datemsg='The Event is scheduled for '.date('d-F-Y',strtotime($start_date)).' from 10 AM to 6 PM. <br>';
  }
      $from_email = "enquiry@theiotacademy.co";
      $to_email = $email_id;
       
       $this->email->from($from_email,'The IoT Academy'); 
       $this->email->to($to_email);
       $this->email->subject('Registration Confirmation Message'); 
       $this->email->message(

        '<strong>Hello '.$name.' :</strong><br>'.
        ' Thank You For Registering For '.$event_type.':<strong>"'.$event_name.'".</strong><br>'.$datemsg.
        'The <strong>'.$event_type.'</strong> link will be shared with you shortly.<br>'.
        'Kindly add our email address to your safe mailer list to receive our notifications regarding the <strong>'.$event_type.'.</strong><br>'.
        '<br>With Best Regards,<br><br>'.
        'The IoT Academy<br>'.
        '<strong>Whatsapp</strong>- <a href="tel:+918178888979">+91 8178888979</a><br>'.
		'<strong>More Details Click Here</strong><br>'.$event_route

      ); 

       if ($this->email->send()) {
            $status = true;
       }else{
            $status = false;
       }
  return $status;
}



}?>