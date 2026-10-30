<?php

class Subjectcnt extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        
        $this->load->model('Subject_model');

    }
    
    public function index(){
        $this->load->view('trainers/SubjectList');
        
    }
    
    public function subjectForm(){
        $this->load->view('trainers/SubjectForm');
    }
    
    public function subjectList(){
        $query=$this->Subject_model->subjectList();
        echo json_encode($query);
        //echo '1';
    }
    
    public function subjectSave(){
        $this->Subject_model->subjectSave($this->input->post());
        redirect('Subjectcnt');
    }
    
     public function subjectDelete(){
        $query=$this->Subject_model->subjectDelete(filter_input(INPUT_GET,'subject_id'));
        if($query){
            echo "true";
        }
        else{
            echo "false";
        }
    }
    
    
    
}





?>