<?php 
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');  
class Industrialinternship extends CI_Controller{

	public function __construct(){ 
		parent::__construct();
	    error_reporting(0);
	    $this->load->helper('utility_helper');
        $this->load->library('form_validation');
        $this->load->model('EventTypeModel');
        $this->load->model('EmployeeModel');
        $this->load->model('UserTypeModel');
	    $this->load->model('IndustrialInternshipModel');
        $this->load->library('session'); 
        $this->load->helper(array('form', 'url'));
	    $this->load->model('FDPModel');
	    $this->load->library('email'); 
	}

	public function internship()
	{
		$this->load->view('internship');
	}

	public function enquaryForInternship()
	{
		$first_name=$this->input->post('first_name');

		$last_name=$this->input->post('last_name');

		$email_id=$this->input->post('email_id');

		$mobile_num=$this->input->post('mobile_num');

		$college_name=$this->input->post('college_name');

		$year=$this->input->post('year');

		$selected_technology=$this->input->post('selected_technology');

		$message=$this->input->post('message');

		$enquiry_id=$this->IndustrialInternshipModel->saveEnquaryToDB($first_name,$last_name,$email_id,$mobile_num,$college_name,$year,$selected_technology,$message);

		if($enquiry_id){

			$adminMailStatus=$this->adminConfirmationMailForIntern($first_name,$last_name,$email_id,$mobile_num,$college_name,$year,$selected_technology,$message);
		
			$userMailStatus=$this->sendEnquiryConfirmEmailForIntern($enquiry_id,$first_name,$last_name,$email_id,$selected_technology);

			if( $adminMailStatus || $userMailStatus){

         		$this->session->set_flashdata("Success","Your Query Has Been Sent To Admin Successfully.<br>Kindly Check Your Email (Inbox/Spam/Junk Folder) for confirmation"); 
         		
       		}else {

         		$this->session->set_flashdata("Success","Your Query Has Been Saved Successfully.<br>Kindly Check Your Email (Inbox/Spam/Junk Folder) for confirmation"); 
       		}

       		redirect(base_url().'work-from-home-internship-on-live-projects');

       }else{
       	

            $this->session->set_flashdata("Error","Some Error Occured While Sending Your Details. Try Again Later!"); 
            redirect(base_url().'work-from-home-internship-on-live-projects');
        }

	}


	





}
?>