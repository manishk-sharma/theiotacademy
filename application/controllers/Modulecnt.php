<?php

class Modulecnt extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Module_model');
    }
    
    public function index(){
        $this->load->view('trainers/ModuleList');
        
    }
    
    public function moduleForm(){
        $this->load->view('trainers/ModuleForm');
    }
    
    public function moduleList(){
        $query=$this->Module_model->moduleList();
        echo json_encode($query);
    }
    
    public function submoduleList(){
        $query=$this->Module_model->submoduleList($_GET['subject_id']);
        echo json_encode($query);
        //echo '1';
    }
    
    
    public function moduleSave(){
        $this->Module_model->moduleSave($this->input->post());
        redirect('Modulecnt?subject_id='.$this->input->post('subject_id'));
    }
    
    public function moduleDelete(){
        $query=$this->Module_model->moduleDelete(filter_input(INPUT_GET,'module_id'));
        if($query){
            echo "true";
        }
        else{
            echo "false";
        }
    }
    
    
    
}





?>