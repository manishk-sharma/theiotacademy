<?php

class StudentDashboardcnt extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('StudentDashboard_model');
    }
    
    public function index(){
        $this->load->view('trainers/StudentDashboard');
        
    }
    
    public function studentDashboard(){
        $query=$this->StudentDashboard_model->studentDashboard(filter_input(INPUT_GET, 'student_id'),filter_input(INPUT_GET, 'subject_id'));
        echo json_encode($query);
       
    }
    
   
    
    
}

?>