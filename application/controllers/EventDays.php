<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(dirname(__FILE__).'/EventCreate.php');
class EventDays extends EventCreate {   
 
	public function __construct(){ 
		parent::__construct(); 
		error_reporting(0); 
		$this->load->helper('utility_helper');
		$this->load->library('form_validation');
		$this->load->model('EventModel');
		$this->load->model('EventDaysModel');
		$this->load->model('EventGuestSpeakerModel');
		$this->load->model('EventScheduleModel');
		$this->load->model('EventTypeModel');
		$this->load->model('EventLocationModel');
		$this->load->model('AppModel');
		$this->load->model('EmployeeModel'); 
		$this->load->model('UserTypeModel');
		$this->load->library('session');  
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

	}



	public function enableDisableDate($event_id,$day_id,$status)
	{
		$ustatus=$this->EventDaysModel->updateEventDateStatus($day_id,$status);
		if($ustatus){ 
			$this->updatEventPageIfAnyChangesApply($event_id);
	    if($status==1){
	      $this->session->set_flashdata('success', 'Event Date Enabled Successfully.');
	    }else{
	      $this->session->set_flashdata('success', 'Event Date Disabled Successfully.');
	    }
	  }else{
	    if($status==1){
	      $this->session->set_flashdata('error', 'Unable To Enable The Event Date. Try Later!');
	    }else{
	      $this->session->set_flashdata('error', 'Unable To Disable The Event Date. Try Later!');
	    }
	  }
	  redirect(base_url().'aevent');
	}

}
