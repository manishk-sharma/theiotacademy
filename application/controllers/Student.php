<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

	public function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->helper('utility_helper');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('AppModel');
		$this->load->model('StudentModel');
		$this->load->model('RegisterModel');
		$this->load->model('EmployeeModel');
		$this->load->model('UserModel');
		$this->load->model('CourseModel');
		//$this->load->helper(array('form', 'url'));
		//$this->load->library('form_validation');
		
	}
	public function index(){	
		$this->load->view('admin/student/studentmanage');
	}

	public function edit_student($id){
		$data=$this->StudentModel->getStudentById($id);
		$data['email_id']=$this->UserModel->getEmailByUserId($data['user_id']) ;
		$this->load->view('admin/student/editstudent',$data);
	}

	public function student_update(){
		  $std_id=$this->input->post('stdid') ;
		  //Validating the information
		  //error messages
		  $nameerrmsg=array(
		  					'required'=>'First Name/Last Name Cannot Be Empty.',
							'alpha_numeric_spaces'=>'Last Name Must Contain Only Letters of English Alphabet and Spaces.',
							'alpha'=>'First Name Must Contain Only Letters of English Alphabet. And No Spaces.'
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
		  $gnameerrmsg=array(
		  					'required'=>'Guardian Name Cannot Be Empty.',
							'alpha_numeric_spaces'=>'Guardian Name Must Contain Only Letters of English Alphabet and Spaces.',
					  ) ;
		  $this->form_validation->set_rules('fname','First Name','required|alpha',$nameerrmsg);
		  $this->form_validation->set_rules('lname','Last Name','required|alpha_numeric_spaces',$nameerrmsg);
		  $this->form_validation->set_rules('gname','Guardian Name','required|alpha_numeric_spaces',$gnameerrmsg);
		  $this->form_validation->set_rules('mobileno','Mobile No.','required|numeric|exact_length[10]',$mobileerrmsg);
		  $this->form_validation->set_rules('newemailid','Email ID','required|valid_email',$emailerrmsg);

		if($this->form_validation->run()){
			$change_email=FALSE ;
			$ip=$_SERVER['REMOTE_ADDR']; 
			$fname=$this->input->post('fname');
		  	$lname=$this->input->post('lname');
		  	$gender=$this->input->post('gender');
		  	$old_email_id=$this->input->post('oldemailid');
		  	$new_email_id=$this->input->post('newemailid');
		  	$mobile_no=$this->input->post('mobileno');
		  	$guardian_name=$this->input->post('gname');
		  	$guardian_label=$this->input->post('glabel');
		  	$birth_date=$this->input->post('birthdate');
		  	$user_id=$this->input->post('userid');

		  	if($old_email_id!=$new_email_id){
		  		$change_email=TRUE ;
		  	}

		  	//Update Student Info
			$sustatus=$this->StudentModel->updateStudent($std_id,$fname,$lname,$gender,$mobile_no,$guardian_label,$guardian_name,$birth_date) ;

			if($change_email){
				//Checking For New Email Uniqueness in Users Table
		  		$new_email_exists=$this->AppModel->isEmailExistsInUsers($new_email_id) ;
		  		if(!$new_email_exists){
		  			//Update New Email
		  			$eustatus=$this->AppModel->updateEmailIdByUserId($user_id,$new_email_id);
		  		}else{
		  			$message="Student Information Updated Successfully Except Email ID. <strong style='color:red;'>Because New Email Id Provided By You Already Exists</strong>." ;
        			$this->session->set_flashdata('success',$message);
        			redirect(base_url().'astudent');
		  		}
			}else{
				$eustatus=TRUE ;
			}
				
			if($sustatus&&$eustatus){
				$message="Student Information Updated Successfully." ;
        		$this->session->set_flashdata('success',$message);
        		redirect(base_url().'astudent');  
        	}else{
        		$message="Unable To Update The Student Info. Contact Administrator." ;
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'astudent');
        	}
		}else{
			$this->session->set_flashdata('error',validation_errors());
            redirect(base_url().'student/edit_student/'.$std_id);
		}
	}

}