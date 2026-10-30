<?php
//ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Hire_From_Us_Controller extends CI_Controller { 
	public function __construct(){ 
	parent::__construct();
    //error_reporting(0);
    $this->load->library('session');
    $this->load->helper('utility_helper');
    $this->load->library('form_validation');
     $this->load->model('Hire_From_Us_Model');
     $this->load->library('email');
	}

public function hire_from_us_cnt_fun()
{
  $this->load->view('hire_from_us');
}


  //iit download brochure, curriculum,project list and talk to cousellor
  public function submit_hire_from_us(){

    $cid=0;
$this->form_validation->set_rules('fullname','Name','required|alpha_numeric_spaces');
$this->form_validation->set_rules('mobileno','Mobile No.','required|numeric|min_length[10]');
$this->form_validation->set_rules('email','Email ID','required|valid_email');

if($this->form_validation->run()){
  $name=$this->input->post('fullname');
  $mobile_no=$this->input->post('mobileno');
  $email_id=$this->input->post('email');
  $subject=$this->input->post('subject');
  $came_from=$this->input->post('form_name');
  $message=$this->input->post('message');
 $url_source=$this->input->post('url_source');

 $data = array(
    'name'=>$name,
    'mobile_no'=>$mobile_no,
    'email_id'=>$email_id,
    'came_from'=>$came_from,
    'subject'=>$subject,
    'message'=>$message,
    'url_source'=>$url_source,
 );

$cid = $this->Hire_From_Us_Model->insert_hire_from_us($data);
if($cid>0){
     $this->hire_from_us_admin_mail($data);
      print_r(json_encode(array('message'=>'success','response'=>'Enquiry Submitted Successfully!')));
}
else{
    print_r(json_encode(array('message' => 'sererror','response'=>'Enquiry Failed! Try Again')));
}

}else{
print_r(json_encode(array('message' => 'error','response'=>validation_errors())));
}
}


public function hire_from_us_admin_mail($data){



    //------Email Section-----

    $from_email = "enquiry@theiotacademy.co";

    $to_email = "info@theiotacademy.co";



    $this->email->from($from_email,'Enquiry | The IoT Academy');

    $this->email->to($to_email);

    $this->email->subject('Hire From Us - Enquiry Recived Through The IoT Academy By '.$data['name']);

    $this->email->message($this->load->view('mailFormat/hire_from_us_admin_mail',$data,TRUE));

    //Sending Email

    if($this->email->send()){

    return TRUE ;

    }else{

    return FALSE ;

    }

    }




}

