<?php 

defined('BASEPATH') OR exit('No direct script access allowed');  

class CertificationDSMLwithPythonInternational extends CI_Controller{

	public function __construct(){ 

		parent::__construct();
	    error_reporting(0);
	    $this->load->helper('utility_helper');
	    $this->load->library('form_validation');
	    $this->load->model(['LiveLeadModel', 'AppliedMlIoTByeictIitGuwagatModel']);
	    $this->load->library('session');
	    $this->load->library('email'); 

	}
	
public function certification_in_ds_and_ml_with_python_in_africa(){
  $this->load->view('certification_in_ds_and_ml_with_python_in_africa');
}

public function certification_in_ds_and_ml_with_python_in_middle_east(){
  $this->load->view('certification_in_ds_and_ml_with_python_in_middle_east');
}


}

?>



