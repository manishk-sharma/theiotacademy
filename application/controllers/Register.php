<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Register extends CI_Controller {



	public function __construct(){

		parent::__construct();

		error_reporting(0);

		$this->load->helper('utility_helper');

		$this->load->library('form_validation');

		$this->load->model('AppModel');

		$this->load->model('StudentModel');

		$this->load->model('RegisterModel');

		$this->load->model('EnquiryModel');

		$this->load->model('EmployeeModel');

		$this->load->model('UserModel');

		$this->load->model('PaymentModel');

		$this->load->model('CourseModel');

		$this->load->library('session');

		$this->load->library('email');

		

	}

	public function index(){	

		$this->load->view('admin/register/registermanage');

	}



	//Function For Balance Fee AJAX Output

	public function printBalanceFeeByRegId(){

		$reg_id=$this->input->post('regid') ;

		$data=$this->RegisterModel->getBalanceFeeByRegId($reg_id) ;

		if(count($data)>0){

			echo json_encode($data);

		}else{

			$data=array('reg_id'=>$reg_id,'balance_fee'=>0);

			echo json_encode($data);

		}

	}



	public function register_student($id){

		$data=$this->EnquiryModel->getEnquiryById($id) ;

		$this->load->view('admin/register/registerstudent',$data);

	}



	public function register_existing_student($id){

		$data=$this->StudentModel->getStudentById($id) ;

		$data['email_id']=$this->UserModel->getEmailByUserId($data['user_id']) ;

		$this->load->view('admin/register/regexistingstudent',$data);

	}



	public function edit_registration($id){

		$data=$this->RegisterModel->getRegistrationById($id) ;

		$sdata=$this->StudentModel->getStudentById($data['std_id']) ;

		$data['student_id']=$sdata['student_id'] ;

		$data['first_name']=$sdata['first_name'] ;

		$data['last_name']=$sdata['last_name'] ;

		$data['birth_date']=$sdata['birth_date'] ;

		$data['user_id']=$sdata['user_id'] ;

		$data['mobile_no']=$sdata['mobile_no'] ;

		$data['email_id']=$this->UserModel->getEmailByUserId($data['user_id']) ;

		$this->load->view('admin/register/editregistration',$data);

	}



	public function addNewRegistration(){

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

	  $courseiderrmsg=array('required'=>'Course ID is Required.',

	  					 	'numeric'=>'Course ID Must Be A Postive Integer.') ;

	  $coursefeeerrmsg=array('required'=>'Course Fee is Required.',

	  					 	'numeric'=>'Course Fee Must Be A Numeric Amount.') ;

	  $discounterrmsg=array('required'=>'Discount Amount is Required.',

	  					 	'numeric'=>'Discount Amount Must Be A Numeric Amount.') ;



	  $this->form_validation->set_rules('fname','First Name','required|alpha',$nameerrmsg);

	  $this->form_validation->set_rules('lname','Last Name','required|alpha_numeric_spaces',$nameerrmsg);

	  $this->form_validation->set_rules('mobileno','Mobile No.','required|numeric|exact_length[10]',$mobileerrmsg);

	  $this->form_validation->set_rules('emailid','Email ID','required|valid_email',$emailerrmsg);

	  $this->form_validation->set_rules('courseid','Course ID','required|numeric',$courseiderrmsg);

	  $this->form_validation->set_rules('coursefee','Course Fee','required|numeric',$coursefeeerrmsg);

	  $this->form_validation->set_rules('discountamount','Discount Amount','required|numeric',$discounterrmsg);



	if($this->form_validation->run()){

		$user_id=0 ;

		$std_id=0 ;

		$reg_id=0 ;

		$student_id=0 ;

		$registration_id=0 ;

		$regstatus=0 ;



		$ip=$_SERVER['REMOTE_ADDR']; 

		$enq_id=$this->input->post('enqid');

		$fname=$this->input->post('fname');

	  	$lname=$this->input->post('lname');

	  	$gender=$this->input->post('gender');

	  	$birth_date=$this->input->post('birthdate');

	  	$course_id=$this->input->post('courseid');

	  	$email_id=$this->input->post('emailid');

	  	$mobile_no=$this->input->post('mobileno');

	  	$user_type_id=4;  //For Student

	  	$course_fee=$this->input->post('coursefee');

	  	$discount_amount=$this->input->post('discountamount');

	  	$total_fee=$course_fee-$discount_amount ;

	  	$admission_date=$this->input->post('admissiondate');

	  	$course_start_date=$this->input->post('coursestartdate');

	  	$training_mode=$this->input->post('trainingmode');



	  	//Generating Random Password

    	$password=$this->RegisterModel->randomString(12) ;



    	//Insert User

        $user_id=$this->UserModel->insertUser($email_id,$password,$user_type_id) ;



        if($user_id>0){

        	

		  	//Insert Student

			$std_id=$this->StudentModel->insertStudent($fname,$lname,$gender,$birth_date,$mobile_no,$user_id,$user_type_id) ;



			//Updating Student ID

			if($std_id>0){

				$student_id=$this->StudentModel->updateStudentId($std_id) ;

			}



			if(($std_id>0)&&is_string($student_id)){



				//Registering Student with Specified Course

				$reg_id=$this->RegisterModel->insertRegistration($std_id,$course_id,$course_fee,$discount_amount,$total_fee,$admission_date,$course_start_date,$training_mode) ;



				//Updating Registration ID

				if($reg_id>0){

					$registration_id=$this->RegisterModel->updateRegistrationId($reg_id) ;



					//Updating Reg_Status of Enquiry Table

					$regstatus=$this->EnquiryModel->updateRegStatus($enq_id,1) ;

				}



				if(($reg_id>0)&&is_string($registration_id)&&($regstatus>0)){

					$emailstatus=$this->sendRegisterConfirmEmail($student_id,$registration_id,$fname,$course_id,$email_id,FALSE);

					if($emailstatus){

	            		$message="Student Registered Successfully with Student Id: <strong>".$student_id."</strong> and Registration Id: <strong>".$registration_id."</strong>. Email Confirmation Sent." ;

	            	}else{

	            		$message="Student Registered Successfully with Student Id: <strong>".$student_id."</strong> and Registration Id: <strong>".$registration_id."</strong>" ;

	            	}

	        		$this->session->set_flashdata('success',$message);

	        		redirect(base_url().'aenquiry'); 

        		}else{

        			$message="Unable To Register The Student Completely. Contact Administrator." ;

                	$this->session->set_flashdata('error',$message);

                	redirect(base_url().'aenquiry');

        		} 

        	}else{

            	$message="Unable To Register The Student. Contact Administrator." ;

                $this->session->set_flashdata('error',$message);

                redirect(base_url().'aenquiry');

        	}

        }else{

           $this->session->set_flashdata('error','Some Error Occured! Try Later.');

            redirect(base_url().'aenquiry');

        }



	}else{

		$this->session->set_flashdata('error',validation_errors());

        redirect(base_url().'aenquiry');

	}

}



public function newRegisterForExistingStudent(){

	  $std_id=$this->input->post('stdid');

	   //Validating the information

	  //error messages

	  $stdiderrmsg=array('required'=>'Unique Student ID is Required.',

	  					 'numeric'=>'Unique Student ID Must Be A Postive Integer.') ;

	  $studentiderrmsg=array('required'=>'Student ID is Required.',

	  				'alpha_numeric'=>'Student ID Must Be 6-Digit Alpha-Numeric Text.') ;

	  $courseiderrmsg=array('required'=>'Course ID is Required.',

	  					 	'numeric'=>'Course ID Must Be A Postive Integer.') ;

	  $coursefeeerrmsg=array('required'=>'Course Fee is Required.',

	  					 	'numeric'=>'Course Fee Must Be A Numeric Amount.') ;

	  $discounterrmsg=array('required'=>'Discount Amount is Required.',

	  					 	'numeric'=>'Discount Amount Must Be A Numeric Amount.') ;

	

	  $this->form_validation->set_rules('stdid','Unique Student ID','required|numeric',$stdiderrmsg);

	  $this->form_validation->set_rules('studentid','Student ID','required|alpha_numeric',$studentiderrmsg);

	  $this->form_validation->set_rules('courseid','Course ID','required|numeric',$courseiderrmsg);

	  $this->form_validation->set_rules('coursefee','Course Fee','required|numeric',$coursefeeerrmsg);

	  $this->form_validation->set_rules('discountamount','Discount Amount','required|numeric',$discounterrmsg);



	if($this->form_validation->run()){

		$reg_id=0 ;

		$student_id=0 ;

		$registration_id=0 ;



		$ip=$_SERVER['REMOTE_ADDR']; 

		$email_id=$this->input->post('emailid');

		$fname=$this->input->post('fname');

		$student_id=$this->input->post('studentid');

	  	$course_id=$this->input->post('courseid');

	  	$course_fee=$this->input->post('coursefee');

	  	$discount_amount=$this->input->post('discountamount');

	  	$total_fee=$course_fee-$discount_amount ;

	  	$admission_date=$this->input->post('admissiondate');

	  	$course_start_date=$this->input->post('coursestartdate');

	  	$training_mode=$this->input->post('trainingmode');



		//Registering Specified Student with Specified Course

		$reg_id=$this->RegisterModel->insertRegistration($std_id,$course_id,$course_fee,$discount_amount,$total_fee,$admission_date,$course_start_date,$training_mode) ;



		//Updating Registration ID

		if($reg_id>0){

			$registration_id=$this->RegisterModel->updateRegistrationId($reg_id) ;

		}



		if(($reg_id>0)&&is_string($registration_id)){

        	$emailstatus=$this->sendRegisterConfirmEmail($student_id,$registration_id,$fname,$course_id,$email_id,TRUE);

			if($emailstatus){

        		$message="Student Registered Successfully with Registration Id: <strong>".$registration_id."</strong>. Email Confirmation Sent." ;

        	}else{

        		$message="Student Registered Successfully with Registration Id: <strong>".$registration_id."</strong>." ;

        	}

    		$this->session->set_flashdata('success',$message);

    		redirect(base_url().'astudent'); 

		}else{

			$message="Unable To Register The Student. Contact Administrator." ;

        	$this->session->set_flashdata('error',$message);

        	redirect(base_url().'astudent');

		} 



	}else{

		$this->session->set_flashdata('error',validation_errors());

        redirect(base_url().'register/register_existing_student/'.$std_id);

	}

  }



  public function updateRegistration(){

	  $reg_id=$this->input->post('regid');

	   //Validating the information

	  //error messages



	  $courseiderrmsg=array('required'=>'Course ID is Required.',

	  					 	'numeric'=>'Course ID Must Be A Postive Integer.') ;

	  $coursefeeerrmsg=array('required'=>'Course Fee is Required.',

	  					 	'numeric'=>'Course Fee Must Be A Numeric Amount.') ;

	  $discounterrmsg=array('required'=>'Discount Amount is Required.',

	  					 	'numeric'=>'Discount Amount Must Be A Numeric Amount.') ;

	

	  $this->form_validation->set_rules('courseid','Course ID','required|numeric|callback_check_registration_for_update',$courseiderrmsg);

	  $this->form_validation->set_rules('coursefee','Course Fee','required|numeric',$coursefeeerrmsg);

	  $this->form_validation->set_rules('discountamount','Discount Amount','required|numeric',$discounterrmsg);



	if($this->form_validation->run()){

		$ip=$_SERVER['REMOTE_ADDR']; 

	  	$course_id=$this->input->post('courseid');

	  	$course_fee=$this->input->post('coursefee');

	  	$discount_amount=$this->input->post('discountamount');

	  	$total_fee=$course_fee-$discount_amount ;

	  	$admission_date=$this->input->post('admissiondate');

	  	$course_start_date=$this->input->post('coursestartdate');

	  	$training_mode=$this->input->post('trainingmode');



		//Updating the Registration

		$ustatus=$this->RegisterModel->updateRegistration($reg_id,$course_id,$course_fee,$discount_amount,$total_fee,$admission_date,$course_start_date,$training_mode) ;



		if($ustatus){

        	$message="Registration Information Updated Successfully." ;

    		$this->session->set_flashdata('success',$message);

    		redirect(base_url().'aregistration'); 

		}else{

			$message="Unable To Update The Registration Info. Contact Administrator." ;

        	$this->session->set_flashdata('error',$message);

        	redirect(base_url().'aregistration');

		} 



	}else{

		$this->session->set_flashdata('error',validation_errors());

        redirect(base_url().'register/edit_registration/'.$reg_id);

	}

  }



  	//Function For Sending Registration Confirmation Email 

  	public function sendRegisterConfirmEmail($student_id,$registration_id,$first_name,$course_id,$to_email,$std_exist){

  		$to_email="siddharth@uniconvergetech.in" ;

  		$course=$this->CourseModel->getCourseById($course_id) ;

  		$from_email="enquiry@theiotacademy.co" ;

  		if($std_exist){

  			$message="Hi <strong>".$first_name."</strong>,<br>You are successfully enrolled to the Course: <strong>".$course['course_title']."(".$course['cs_id'].")</strong> with Reg. ID: <strong>".$registration_id."</strong>.<br><br>Thanks.<br>The IoT Academy<br>3rd Floor, NIMS Building, C-56/11, Sector-62, Noida, U.P" ;

  		}else{

			$message="Hi <strong>".$first_name."</strong>,<br>You are successfully registered with us via Student ID: <strong>".$student_id."</strong>.<br>And You are successfully enrolled to the Course: <strong>".$course['course_title']."(".$course['cs_id'].")</strong> with Reg. ID: <strong>".$registration_id."</strong>.<br><br>Thanks.<br>The IoT Academy<br>3rd Floor, NIMS Building, C-56/11, Sector-62, Noida, U.P" ;

  		}

   		$this->email->from($from_email, 'The IoT Academy'); 

        $this->email->to($to_email);

        $this->email->subject('Registration Confirmation'); 

        $this->email->message($message);



        //Sending Email

        if($this->email->send()){

        	return TRUE ;

        }else{

        	return FALSE ;

        }

  	}



   //Callback Function For Validating Registration via Course ID and Student ID 

    public function check_registration_for_update($course_id) {  

    	$std_id=$this->input->post('stdid') ;      

        if($this->input->post('regid')){

            $reg_id = $this->input->post('regid');

        }else{

            $reg_id = '';

        }

        $result = $this->RegisterModel->checkUniqueRegistrationForUpdate($reg_id,$course_id,$std_id);

        if($result == 0){

            $response = true;

        }else {

            $this->form_validation->set_message('check_registration_for_update', 'Registration Already Exists For This Course and Student.');

            $response = false;

        }

        return $response;

    }



}

?>