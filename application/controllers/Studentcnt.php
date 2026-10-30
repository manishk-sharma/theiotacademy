<?php

class Studentcnt extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Student_model');
    }
    
    public function index(){
        $this->load->view('trainers/StudentList');
        
    }
    
    public function studentForm(){
        $this->load->view('trainers/StudentForm');
    }
    
    public function studentList(){
        $query=$this->Student_model->studentList();
        echo json_encode($query);
    }
    
    public function substudentList(){
        $query=$this->Student_model->substudentList($_GET['batch_id']);
        echo json_encode($query);
        //echo '1';
    }
    
    
    public function studentSave(){
        $this->Student_model->studentSave($this->input->post());
        redirect('Studentcnt?batch_id='.$this->input->post('batch_id'));
    }
    
    public function studentDelete(){
        $query=$this->Student_model->studentDelete(filter_input(INPUT_GET,'student_id'));
        if($query){
            echo "true";
        }
        else{
            echo "false";
        }
    }
    
    
    
}





?>