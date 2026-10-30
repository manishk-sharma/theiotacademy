<?php 
defined('BASEPATH') OR exit('No direct script access allowed');  
class AdvancedFullstackJavaIITGuwahati extends CI_Controller{

	public function __construct(){ 

		parent::__construct();
	    error_reporting(0);
	    $this->load->helper('utility_helper');
	    $this->load->library('form_validation');
	    $this->load->model('AppliedModel');
	     $this->load->model(['LiveLeadModel', 'AppliedMlIoTByeictIitGuwagatModel']);
	    $this->load->library('session');
	    $this->load->library('email'); 

	}

public function advanced_fullstack_java_by_eict_iitg(){
  $this->load->view('advanced_certification_program_in_full_stack_java_by_iit_guwahati');
}


}
?>