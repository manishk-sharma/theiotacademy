<?php 
defined('BASEPATH') OR exit('No direct script access allowed');  

class Assignment_User_Performance_Report extends CI_Controller{

	public function __construct(){ 
	 parent::__construct();
	 $this->load->library('session');
	$this->load->helper('utility_helper');
	$this->load->library('form_validation');
	$this->load->model(['CheckAssignmentModel','Assignment_User_Performance_Report_Model']);
	$this->load->library('email'); 
	$this->load->library('pagination');
}



public function assignment_user_attendace_report_show(){

     $user = $this->session->userdata('user');
     $email=$user['email'];
    if (!$user['is_login']) {
        redirect('assignment-login');
    }

    try{
        $data = array();
        $data['members'] = $this->Assignment_User_Performance_Report_Model->user_match_detail($email);
     }
      catch(Exception $e){
        print_r($e);
      }
  $this->load->view('assignment/userreport/attendance_report', $data);

}


public function assignment_user_live_test_report_show(){

     $user = $this->session->userdata('user');
     $email=$user['email'];
    if (!$user['is_login']) {
        redirect('assignment-login');
    }

    try{
        $data = array();
        $data['members'] = $this->Assignment_User_Performance_Report_Model->user_live_test_match_detail($email);
     }
      catch(Exception $e){
        print_r($e);
      }
  $this->load->view('assignment/userreport/assignment_user_live_test_report', $data);

}


public function assignment_user_project_report_show(){

     $user = $this->session->userdata('user');
     $email=$user['email'];
    if (!$user['is_login']) {
        redirect('assignment-login');
    }

    try{
        $data = array();
        $data['members'] = $this->Assignment_User_Performance_Report_Model->user_project_report_match_detail($email);
     }
      catch(Exception $e){
        print_r($e);
      }
  $this->load->view('assignment/userreport/assignment_user_project_report', $data);

}


}
?>



