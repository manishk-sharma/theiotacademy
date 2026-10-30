<?php 

defined('BASEPATH') OR exit('No direct script access allowed');  

class NewsLetter extends CI_Controller{



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

	    //$this->load->model('StudentModel');

	    $this->load->model('NewsLetterModel');

	    $this->load->library('session');

	    $this->load->library('email'); 

	}



	public function subscribe()

	{	  $cid=0 ;

		  //Validating the information

		  //error messages

		  $emailerrmsg=array(

		  				'required'=>'Email Cannot Be Empty.',

		  				'valid_email'=>'Email Must Be A Valid Email.',

		  				'is_unique'=>'You Are Already Subscribed.'

		  				) ;

		  $this->form_validation->set_rules('email','Email ID','required|valid_email|is_unique[newsletters.email_id]',$emailerrmsg);



		if($this->form_validation->run()){

			  $email_id=$this->input->post('email');

			  $inserted_date=date('Y-m-d h:i:s');

		  	  //---------Database Section---------------

		      $cid=$this->NewsLetterModel->insertNewsLetterEmail($email_id,$inserted_date);

        	if($cid>0)

        	{

			 //------Email Section----------------------

			 $from_email = "enquiry@theiotacademy.co";

			 $to_email = "info@theiotacademy.co";

			 

			 $this->email->from($from_email,'The IOT Website'); 

			 $this->email->to($to_email);

			 $this->email->subject('TIA News Letter Subscription'); 

			 $this->email->message('<strong>New NewsLetter Subscription:</strong><br> Email Id:- '.$email_id.'<br>The above email has been subscribed successfully for newsletters.'); 

			 

			 //Send mail

			 if($this->email->send()){

				 $this->session->set_flashdata("success","You Have Been Subscribed For Our News Letters Successfully."); 

			 }else {

				 $this->session->set_flashdata("success","Unable To Subscribe This Time. Try Later!"); 

			 }

           

        }else{

            $this->session->set_flashdata("error","Some Error Occured While Subscribing. Try Again Later!"); 

        }

		

	}else{

		$this->session->set_flashdata('error', validation_errors());

	}

		

	 //redirect(base_url());

	}

}

?>