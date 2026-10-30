<?php

//ob_start();

defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class EnquiryFollowUp extends CI_Controller {
	public function __construct(){

		parent::__construct();

		error_reporting(0);

		$this->load->helper('utility_helper');
		$this->load->library('form_validation');
		$this->load->model('EnquiryModel');
		$this->load->model('EnquirySourceModel');
		$this->load->model('EnquiryFollowUpModel');
		$this->load->model('AppModel');
		$this->load->model('EmployeeModel');
		$this->load->model('CourseModel');
		$this->load->library('session');
		$this->load->library('email');

	}

	public function index(){	

		$this->load->view('admin/enquiry/enquirymanage');

	}
	public function enquiry_followup_submit(){

		  //Validating the information
		  //error messages
		  $fupdateerrmsg=array('required'=>'Follow Up Date Cannot Be Empty.') ;
		  $this->form_validation->set_rules('fupdate','Follow Up Date','required|callback_check_for_existing_fup_date_for_enquiry',$fupdateerrmsg);

		if($this->form_validation->run()){

			$fup_id=0 ;

			$pendfupustatus=0 ;
			$ip=$_SERVER['REMOTE_ADDR']; 
			$enq_id=$this->input->post('enqid') ;
			$enquiry_id=$this->input->post('enquiryid') ;
		  	$fup_date=$this->input->post('fupdate');
			//Check for Any Pending Follow Ups For This Enquiry

			$last_pending_fup_id=$this->EnquiryFollowUpModel->checkForLastPendingFollowUpForEnquiry($enq_id);
			if($last_pending_fup_id>0){

				$remark="Follow Up Required On ".date('d-m-Y',strtotime($fup_date)) ;
				//Setting Status of other pending followups to Completed

				$pendfupustatus=$this->EnquiryFollowUpModel->updatePendingEnquiryFollowUpByEnqId($last_pending_fup_id,$fup_date) ;

			}else{

				$pendfupustatus=TRUE ;

			}

			if($pendfupustatus){

				//Insert Enquiry Follow Up

				$fup_id=$this->EnquiryFollowUpModel->insertEnquiryFollowUp($enq_id,$fup_date) ;

			}

			if($fup_id>0){

				$message="Enquiry FollowUp Created Successfully For Enquiry: ".$enquiry_id ;

	    		$this->session->set_flashdata('success',$message);

	    		redirect(base_url().'aenquiry'); 

        	}else{

        		$message="Unable To Create The Enquiry FollowUp. Contact Administrator." ;

                $this->session->set_flashdata('error',$message);

                redirect(base_url().'aenquiry');

        	}

		}else{

			$this->session->set_flashdata('error',validation_errors());

            redirect(base_url().'aenquiry');

		}

	}
	public function enquiry_followup_update(){

		$fup_id=$this->input->post('fupid') ;

		//Validating the information

		  //error messages

		  $fupdateerrmsg=array('required'=>'Follow Up Date Cannot Be Empty.') ;

		  $this->form_validation->set_rules('fupdate','Follow Up Date','required|callback_check_for_existing_fup_date_for_enquiry_for_update',$fupdateerrmsg);
		if($this->form_validation->run()){

			$ip=$_SERVER['REMOTE_ADDR']; 

			$enq_id=$this->input->post('enqid') ;

			$enquiry_id=$this->input->post('enquiryid') ;

		  	$fup_date=$this->input->post('fupdate');

		  	$remark=$this->input->post('fupremark');

		  	$fup_status=$this->input->post('fupstatus');
		  	//Update Enquiry FollowUp

			$ustatus=$this->EnquiryFollowUpModel->updateEnquiryFollowUp($fup_id,$fup_date,$fup_status,$remark) ;

			if($ustatus){

				$message="Enquiry FollowUp Updated Successfully." ;
        		$this->session->set_flashdata('success',$message);
        		redirect(base_url().'aenquiry');  

        	}else{

        		$message="Unable To Update The Enquiry FollowUp. Contact Administrator." ;
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'aenquiry');

        	}

		}else{

			$this->session->set_flashdata('error',validation_errors());

            redirect(base_url().'aenquiry');

		}

	}



	//Callback Function For Validating FollowUp Date via Enq ID and FUP Date 

    public function check_for_existing_fup_date_for_enquiry($fup_date) {  
    	$enq_id=$this->input->post('enqid') ;      
        $result = $this->EnquiryFollowUpModel->checkUniqueFUPDateForEnquiry($enq_id,$fup_date);
        if($result == 0){
            $response = true;

        }else {

            $this->form_validation->set_message('check_for_existing_fup_date_for_enquiry', 'Follow Up Already Exists On This Date For This Enquiry.');

            $response = false;
        }

        return $response;
    }



    //Callback Function For Validating FUP Date with Enq ID except Current Entry 

    public function check_for_existing_fup_date_for_enquiry_for_update($fup_date) {  

    	$enq_id=$this->input->post('enqid') ; 
    	$fup_id=$this->input->post('fupid') ;      
        $result = $this->EnquiryFollowUpModel->checkUniqueFollowUpForEnquiryForUpdate($fup_id,$enq_id,$fup_date);

        if($result == 0){

            $response = true;

        }else {

            $this->form_validation->set_message('check_for_existing_fup_date_for_enquiry_for_update', 'Follow Up Already Exists On This Date For This Enquiry. Can not Update This FollowUp With This Date.');

            $response = false;

        }

        return $response;

    }



}