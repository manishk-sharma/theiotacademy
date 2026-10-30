<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class Assignment_User_Performance_Report_Model extends CI_Model{
    
        public function __construct(){

        parent::__construct();

        $this->load->database();

        $this->load->library('session'); 

        date_default_timezone_set('Asia/Kolkata');

    } 
    
public function user_match_detail($email) {
    $this->db->where("email", $email);
    $query = $this->db->get('student_attendance');

    if ($query->num_rows() > 0) { 
        $data = $query->result_array(); // Fetch all matching rows
        return $data;
    } else {   
        return false;
    }   
}

public function user_live_test_match_detail($email){

     $this->db->where("email", $email);
    $query = $this->db->get('student_mini_live_assignment_test');

    if ($query->num_rows() > 0) { 
        $data = $query->result_array(); // Fetch all matching rows
        return $data;
    } else {   
        return false;
    }   

}

public function user_project_report_match_detail($email){

     $this->db->where("email", $email);
    $query = $this->db->get('student_assign_project_report');

    if ($query->num_rows() > 0) { 
        $data = $query->result_array(); // Fetch all matching rows
        return $data;
    } else {   
        return false;
    }   

}


}
?>    