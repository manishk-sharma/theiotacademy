<?php 
defined('BASEPATH') OR exit('No direct script access allowed');  
class CampusAmbassador extends CI_Controller{

	public function __construct(){ 
		parent::__construct();
	    error_reporting(0);
	    $this->load->helper('utility_helper');
	    $this->load->library('form_validation');
	    $this->load->model('AppModel');
	    $this->load->model('EmployeeModel');
	    $this->load->model('UserModel');
	    $this->load->model('DesigModel');
	    $this->load->model('UserTypeModel');
	    $this->load->model('StudentModel');
	    $this->load->model('CAModel');
	    $this->load->library('session');
	    $this->load->library('email'); 
	}

   public function campus_ambassador()
    {  
      $this->load->view('campus_ambassador'); 
    }

	public function liveCADataSubmit(){
         $this->form_validation->set_rules('fname','First Name','trim|required|min_length[2]|max_length[40]');
	 	 $this->form_validation->set_rules('lname','Last Name','trim|required|min_length[2]|max_length[40]');
    	 $this->form_validation->set_rules('email','Email ID','required|valid_email|is_unique[ca_details.email_id]');
    	 $this->form_validation->set_rules('mobile','Mobile Number','required|numeric|max_length[15]');
    	 $this->form_validation->set_rules('collegename','College Name','required');
    	 $this->form_validation->set_rules('year','Year','required');
    	 
    	 
    		
        if($this->form_validation->run()){
                $data=array(
		    	      'ca_fname'=>$this->input->post('fname'),
					  'ca_lname'=>$this->input->post('lname'),
					  'email_id'=>$this->input->post('email'),
					  'mobile_no'=>$this->input->post('mobile'),
					  'college_name'=>$this->input->post('collegename'),
					  'year'=>$this->input->post('year'),
			    );
		 	
	 		$campus_ambassador_id=$this->CAModel->insertLiveCampusAmbassador($data);
	 		
	  		if($campus_ambassador_id>0){

		 		 $admin_CampusAmbassador_mail_status=$this->admin_CampusAmbassador_Email($data);
		 		$user_CampusAmbassador_mail_status=$this->user_CampusAmbassador_ConfirmEmail($data);
		 		//Send mail
			 	if($admin_CampusAmbassador_mail_status){

	 			 	header('Content-Type: application/json');
	 		        print json_encode(array('message'=>'SUCCESS','response'=>"&#x2714; You Are Successfully Registered For CAMPUS AMBASSADOR PROGRAM."));
	            }else{

	 		        //header('HTTP/1.1 500 Internal Server');
	 		        header('Content-Type: application/json; charset=UTF-8');
			        die(json_encode(array('message' => 'SUCCESS', 'response'=>"&#x2714;You Are Successfully Registered For CAMPUS AMBASSADOR PROGRAM."))); 
				}
	        }
	        else{
		        header('HTTP/1.1 501 Internal Server');
		        header('Content-Type: application/json; charset=UTF-8');
		        print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 501 ,'response'=>'AMBASSADOR PROGRAM Application Failed! Try Again')));
	        }   
    	}else{
        	header('HTTP/1.1 500 Internal Server');
        	header('Content-Type: application/json; charset=UTF-8');
        	print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 500,'response'=>validation_errors())));
		}

    }   

     //start faculty admin mail
    public function admin_CampusAmbassador_Email($data){

  		//------Email Section-----
		$from_email = "enquiry@theiotacademy.co";
		$to_email = "info@theiotacademy.co";
		 
		$this->email->from($from_email,'Enquiry | The IoT Academy'); 
		$this->email->to($to_email);
		$this->email->subject('Campus Ambassador Request Received through Website By ' .$data['ca_fname']); 
		$this->email->message($this->load->view('mailFormat/admin_campusambassador_mail',$data,TRUE)); 
        //Sending Email
        if($this->email->send()){
        	return TRUE ;
        }else{
        	return FALSE ;
        }
  	}
  //end  faculty admin mail

  //sending user faculty  confirmation mail
    public function user_CampusAmbassador_ConfirmEmail($data){

  		//------Email Section-----
		$from_email = "enquiry@theiotacademy.co";
		$to_email = $data['email_id'];
		$this->email->from($from_email,'Enquiry | The IoT Academy'); 
		$this->email->to($to_email);
		$this->email->subject('Congratulations '.$data['ca_fname']. '! Your Campus Ambassador Application  Requested Successfully'); 
		$this->email->message($this->load->view('mailFormat/user_campusambassador_mail',$data,TRUE));
        //Sending Email
        if($this->email->send()){
        	return TRUE ;
        }else{
        	return FALSE ;
        }
    }
//end faculty submit form and send mail admin and user
}
?>
