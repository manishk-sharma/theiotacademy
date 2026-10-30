<?php

class StudyMaterialcnt extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('StudyMaterial_model');
    }
    
    public function index(){
        $this->load->view('trainers/StudyMaterialList');
        
    }
    
     public function batchAssignmentList(){
        $this->load->view('trainers/BatchStudyMaterialList');
    }
    
    public function studentAssignmentList(){
        $this->load->view('trainers/StudentStudyMaterialList');
    }
    
    
    public function studymaterialForm(){
        $this->load->view('trainers/StudyMaterialForm');
    }
    
    public function studymaterialList(){
        $query=$this->StudyMaterial_model->studymaterialList();
        echo json_encode($query);
        //echo '1';
    }
    
    public function substudymaterialList(){
        $query=$this->StudyMaterial_model->substudymaterialList($_GET['topic_id']);
        echo json_encode($query);
     
    }
 
    
    public function studymaterialSave(){
        $this->StudyMaterial_model->studymaterialSave($this->input->post());
        redirect('StudyMaterialcnt?subject_id='.$this->input->post('subject_id').'&module_id='.$this->input->post('module_id').'&topic_id='.$this->input->post('topic_id'));
    }
    
    public function studymaterialDelete(){
        $query=$this->StudyMaterial_model->studymaterialDelete(filter_input(INPUT_GET,'studymaterial_id'));
        if($query){
            echo "true";
        }
        else{
            echo "false";
        }
    }
    
    
     public function batchAssign(){
      $query=$this->StudyMaterial_model->batchAssign(filter_input(INPUT_GET, 'studymaterial_id'),filter_input(INPUT_GET, 'batch_id'));
     
      if($query){
          echo "true";
      }
      else{
          echo "false";
      }
    }
    
    public function batchAssignList(){
        $query=$this->StudyMaterial_model->batchAssignList();
        echo json_encode($query);
        //echo "hello";
    }
    
    public function batchAssignDelete(){
        $query=$this->StudyMaterial_model->batchAssignDelete(filter_input(INPUT_GET, 'studymaterial_id'),filter_input(INPUT_GET, 'batch_id'));
        
        if($query){
          echo "true";
        }
        else{
            echo "false";
        }
    }
    
    
    public function studentAssign(){
      $query=$this->StudyMaterial_model->studentAssign(filter_input(INPUT_GET, 'studymaterial_id'),filter_input(INPUT_GET, 'student_id'));
      if($query){
          echo "true";
      }
      else{
          echo "false";
      }
    }
    
    public function studentAssignList(){
        $query=$this->StudyMaterial_model->studentAssignList();
        echo json_encode($query);
        //echo "hello";
    }
    
    public function studentAssignDelete(){
        $query=$this->StudyMaterial_model->studentAssignDelete(filter_input(INPUT_GET, 'studymaterial_id'),filter_input(INPUT_GET, 'student_id'));
        
        if($query){
          echo "true";
        }
        else{
            echo "false";
        }
    }
    
    
    
    
}
?>