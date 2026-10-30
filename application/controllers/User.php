<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
		$this->load->library('session');
		$this->load->library('email');
	}
	
	public function index()
	{	
		$this->load->view('admin/users/usermanage');
	}


	public function resetUserPassword()
	{
		$emailerrmsg=array(
  					'required'=>'Email cannot Be Empty.',
					);

		$passerrmsg=array(
  					'required'=>'Password cannot Be Empty.',
					'alpha_numeric'=>'Password Shuold Only alpha_numeric',
					'min_length'=>'Minium 6 Character Required'
					);
		$this->form_validation->set_rules('emailid', 'Email', 'required',$emailerrmsg);
		$this->form_validation->set_rules('password', 'password', 'required|min_length[6]|max_length[15]|alpha_numeric',$passerrmsg);

		if($this->form_validation->run()){

			$email_id=$this->input->post('emailid');
			$password=$this->input->post('password');

			$staus=$this->UserModel->resetPassword($email_id,$password);
			$emailStatus=$this->passChangeMail($email_id,$password);
				
			if($staus&&$emailStatus){
				$this->session->set_flashdata('success','Password Changed Sucecssfully.');
            	redirect(base_url().'auserportal');
			}else{
				$this->session->set_flashdata('error','Some Error Occured! Try Again');
	            redirect(base_url().'auserportal');
			}

		}else{
			$this->session->set_flashdata('error',validation_errors());
            redirect(base_url().'auserportal');
		}
	}


	public function forgotPassword()
	{
		$emailerrmsg=array(
  					'required'=>'Email cannot Be Empty.',
					);

		$passerrmsg=array(
  					'required'=>'Password cannot Be Empty.',
					'alpha_numeric'=>'Password Shuold Only alpha_numeric',
					'min_length'=>'Minium 6 Character Required'
					);
		$this->form_validation->set_rules('newemail', 'Email', 'required',$emailerrmsg);
		$this->form_validation->set_rules('newpassword', 'password', 'required|min_length[6]|max_length[20]|alpha_numeric',$passerrmsg);

		if($this->form_validation->run()){

			$email_id=$this->input->post('newemail');
			$password=$this->input->post('newpassword');
			echo($email_id);
			echo($password);

			$existstatus=$this->UserModel->isEmailExistsInUsers($email_id,$password);

			if($existstatus){

				$staus=$this->UserModel->resetPassword($email_id,$password);
				$emailStatus=$this->passChangeMail($email_id,$password);
				if($staus&&$emailStatus){

					$this->session->set_flashdata('success','Password Changed Sucecssfully.');
				}else{
					$this->session->set_flashdata('error','Some Error Occured! Try Again');
				}

			}
			else{
				$this->session->set_flashdata('error','Email id dose not exist !');
        	}
		
		}else{
			$this->session->set_flashdata('error',validation_errors());
            
		}
		redirect(base_url().'login');
	}


	public function passChangeMail($email_id,$password)
	{
	   		$from_email = "enquiry@theiotacademy.co";
	      $to_email = $email_id;
	       
	       $this->email->from($from_email,'The IOT Academy'); 
	       $this->email->to($to_email);
	       $this->email->subject('Password  Changes Confirmation '); 
	       $this->email->message(

	        'Your Password has been changed sucecssfully <br>'.
	        'New Password is: <h4>'.$password.
	        '</h4><br>Regards,<br><br>'.
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






}//----end-----