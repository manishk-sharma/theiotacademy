<?php
//ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

	public function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->helper('utility_helper');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->model('AppModel');
		$this->load->model('StudentModel');
		$this->load->model('RegisterModel');
		$this->load->model('EnquiryModel');
		$this->load->model('EmployeeModel');
		$this->load->model('UserModel');
		$this->load->model('DesigModel');
		$this->load->model('UserTypeModel');
		$this->load->library('session');
	}

	public function index(){
		$this->load->view('admin/employee/empmanage') ;
	}

	public function add_employee(){
		$this->load->view('admin/employee/addemployee') ;
	}

	public function edit_employee($id){
		$data=$this->EmployeeModel->getEmployeeById($id);
		$userinfo=$this->UserModel->getUserShortInfoById($data['user_id']);
		$data['email_id']=$userinfo['email_id'] ;
		$data['user_type_id']=$userinfo['user_type_id'] ;
		$this->load->view('admin/employee/editemployee',$data) ;
	}

	public function employee_submit(){
	   //Validating the information
	  //error messages
	  $nameerrmsg=array(
	  					'required'=>'First Name/Last Name Cannot Be Empty.',
						'alpha_numeric_spaces'=>'Last Name Must Contain Only Letters of English Alphabet and Spaces.',
						'alpha'=>'First Name Must Contain Only Letters of English Alphabet.'
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

	  $this->form_validation->set_rules('fname','First Name','required',$nameerrmsg);
	  $this->form_validation->set_rules('lname','Last Name','required|alpha_numeric_spaces',$nameerrmsg);
	  $this->form_validation->set_rules('mobileno','Mobile No.','required|numeric|exact_length[10]',$mobileerrmsg);
	  $this->form_validation->set_rules('emailid','Email ID','required|valid_email',$emailerrmsg);

	if($this->form_validation->run()){
		$user_id=0 ;
		$emp_id=0 ;
		$employee_id=0 ;
		$ip=$_SERVER['REMOTE_ADDR']; 

		$fname=trim($this->input->post('fname'));
	  	$lname=trim($this->input->post('lname'));
	  	$gender=$this->input->post('gender');
	  	$birth_date=$this->input->post('birthdate');
	  	$desig_id=$this->input->post('desigid');
	  	$description=$this->input->post('description');
	  	$facebook_link=$this->input->post('facebooklink');
	  	$twitter_link=$this->input->post('twitterlink');
	  	$linkedin_link=$this->input->post('linkedinlink');
	  	$email_id=$this->input->post('emailid');
	  	$mobile_no=$this->input->post('mobileno');
	  	$user_type_id=$this->input->post('usertypeid');
	  	$password=$this->input->post('password');
	  	if (strlen($facebook_link)<6) {
			$facebook_link='nil';
		}
		if (strlen($twitter_link)<6) {
			$twitter_link='nil';
		}
		if (strlen($linkedin_link)<6) {
			$linkedin_link='nil';
		}
	  	//Generating Random Password
    	//$password=$this->RegisterModel->randomString(12);

    	//Insert User
        $user_id=$this->UserModel->insertUser($email_id,$password,$user_type_id) ;

        if($user_id>0){
        	
		  	//Insert Employee
			$emp_id=$this->EmployeeModel->insertEmployee($fname,$lname,$gender,$birth_date,$mobile_no,$desig_id,$description,$facebook_link,$twitter_link,$linkedin_link,$user_id) ;

			//Updating Employee ID
			if($emp_id>0){
				$employee_id=$this->EmployeeModel->updateEmployeeId($emp_id) ;
			}

			if(($emp_id>0)&&is_string($employee_id)){
				$picstatus=$this->uploadpicforemployee($emp_id);
				if ($picstatus) {
					$updateEmployeeImageNames=$this->EmployeeModel->updateEmployeeImageNames($emp_id);
					$message="Employee Created Successfully with Profile Photo And Employee Id : <strong>".$employee_id."</strong>" ;
	        		$this->session->set_flashdata('success',$message);
	        		redirect(base_url().'aemployee'); 
				}
				else{
					$profileUplodaFailed=$this->EmployeeModel->profileUplodaFailed($emp_id);
					$message=" Profile Photo Not Uploadded <br> File Type Must be Png/PNG ,Please Upload Photo . Or Contact Administrator." ;
	            	$this->session->set_flashdata('success',$message);
	            	redirect(base_url().'aemployee');
				}
            	$message="Employee Created Successfully with Employee Id: <strong>".$employee_id."</strong>" ;
        		$this->session->set_flashdata('success',$message);
        		redirect(base_url().'aemployee'); 
    		}else{
    			$message="Unable To  Created Employee Completely. Contact Administrator." ;
            	$this->session->set_flashdata('error',$message);
            	redirect(base_url().'aemployee');
    		} 
        }else{
           $this->session->set_flashdata('error','Unable To Create The User. Contact Admin.');
            redirect(base_url().'add-employee');
        }

	}else{
		$this->session->set_flashdata('error',validation_errors());
        redirect(base_url().'add-employee');
	}
}

//-----------------------------Update Employee----------------------------------
	public function employee_update(){
	   //Validating the information
	  //error messages
	  $nameerrmsg=array(
	  					'required'=>'First Name/Last Name Cannot Be Empty.',
						'alpha_numeric_spaces'=>'Last Name Must Contain Only Letters of English Alphabet and Spaces.',
						'alpha'=>'First Name Must Contain Only Letters of English Alphabet.'
						) ;
	  $mobileerrmsg=array(
	  				'required'=>'Mobile No. Cannot Be Empty.',
	  				'numeric'=>'Mobile No. Must Be 10-Digit Number',
	  				'exact_length'=>'Mobile No. Must Be 10-Digit Number'
	  				) ;

	  $this->form_validation->set_rules('fname','First Name','required',$nameerrmsg);
	  $this->form_validation->set_rules('lname','Last Name','required|alpha_numeric_spaces',$nameerrmsg);
	  $this->form_validation->set_rules('mobileno','Mobile No.','required|numeric|exact_length[10]',$mobileerrmsg);

	if($this->form_validation->run()){
		$emp_id=$this->input->post('empid');
		$employee_id=$this->input->post('employeeid');
		$ip=$_SERVER['REMOTE_ADDR']; 
		$fname=trim($this->input->post('fname'));
	  	$lname=trim($this->input->post('lname'));
	  	$gender=$this->input->post('gender');
	  	$birth_date=$this->input->post('birthdate');
	  	$desig_id=$this->input->post('desigid');
	  	$description=$this->input->post('description');
	  	$facebook_link=$this->input->post('facebooklink');
	  	$twitter_link=$this->input->post('twitterlink');
	  	$linkedin_link=$this->input->post('linkedinlink');
	  	$email_id=$this->input->post('emailid');
	  	$mobile_no=$this->input->post('mobileno');
	  	$user_type_id=$this->input->post('usertypeid');
	  	$checkphoto=$this->input->post('checkphoto');
	  	if (strlen($facebook_link)<6) {
			$facebook_link='nil';
		}
		if (strlen($twitter_link)<6) {
			$twitter_link='nil';
		}
		if (strlen($linkedin_link)<6) {
			$linkedin_link='nil';
		}
        $status=$this->EmployeeModel->updateEmployee(
        						$emp_id,
        						$fname,
								$lname,
								$gender,
								$birth_date,
								$mobile_no,
								$desig_id,
								$description,
								$facebook_link,
								$twitter_link,
								$linkedin_link);
        if ($status) {
             if($checkphoto==1){
            	$picstatus=$this->uploadpicforemployee($emp_id);
    				if ($picstatus) {
    					$updateEmployeeImageNames=$this->EmployeeModel->updateEmployeeImageNames($emp_id);
    					$message="Employee Created Successfully with Employee Id: <strong>".$employee_id."</strong>" ;
    	        		$this->session->set_flashdata('success',$message);
    	        		redirect(base_url().'aemployee'); 
    				}else{
    					$profileUplodaFailed=$this->EmployeeModel->profileUplodaFailed($emp_id);
    					$message="Profile Photo Not Uploadded <br> File Type Must be Png ,Please Upload Photo . Or Contact Administrator." ;
    	            	$this->session->set_flashdata('error',$message);
    	            	redirect(base_url().'aemployee');
    				}
             }		
			$message="Employee Created Successfully with Employee Id: <strong>".$employee_id."</strong>" ;
    		$this->session->set_flashdata('success',$message);
    		redirect(base_url().'aemployee');	
        }
		else{
    			$message="Unable To  Created Employee Completely. Contact Administrator." ;
            	$this->session->set_flashdata('error',$message);
            	redirect(base_url().'aemployee');
    		} 
        }
        else{
		$this->session->set_flashdata('error',validation_errors());
        redirect(base_url().'edit_employee'.$emp_id);
	}
}
//--------------------------Upload Employee profile Pic--------------------
public function uploadpicforemployee($emp_id)
	{
		  $uploadStatus=false ;
		  $profileuploadstatus=false ;
		  //Uploading profile pic
		  $status=false ;
	        $error="no error" ;
	        $config2['file_name']      = 'employeepic-'.$emp_id;
	        $config2['upload_path']    = './uploads/profilepic/employee/';
	        $config2['allowed_types']  = 'PNG|png';
	        $config2['overwrite'] = TRUE;
	        $config2['max_size']       = 3000; //3MB
	        $config2['max_width']      = 3000;
	        $config2['max_height']     = 2000;

	        $this->upload->initialize($config2);

	        if ( ! $this->upload->do_upload('photo'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            //echo "Upload Failed" ;
	           // print_r($error) ;
	            $status=false ;
	        }
	        else
	        {
	            $data = array('upload_data' => $this->upload->data());
	            //echo "File Uploaded Successfully" ;
	            //echo $data ;
	            $status=true ;
	        }
	        return $status;
	       // echo print_r($error) ;
	}	

		
}
?>