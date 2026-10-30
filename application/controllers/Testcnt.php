<?php

class Testcnt extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Test_model');
    }
    
    public function index(){
        $this->load->view('trainers/TestList');
        
    }
    
    public function testForm(){
        $this->load->view('trainers/TestForm');
    }
    
    public function testQuestionHome(){
        $this->load->view('trainers/TestQuestionHome');
    }
    
    public function batchAssignmentList(){
        $this->load->view('trainers/BatchTestList');
    }
    
    public function studentAssignmentList(){
        $this->load->view('trainers/StudentTestList');
    }
    
    public function testList(){
        $query=$this->Test_model->testList();
        echo json_encode($query);
 
    }
    
    public function testSave(){
        $this->Test_model->testSave($this->input->post());
        redirect('Testcnt');
    }
    
     public function testDelete(){
        $query=$this->Test_model->testDelete(filter_input(INPUT_GET,'test_id'));
        if($query){
            echo "true";
        }
        else{
            echo "false";
        }
    }
    
    public function batchAssign(){
      $query=$this->Test_model->batchAssign(filter_input(INPUT_GET, 'test_id'),filter_input(INPUT_GET, 'batch_id'));
      
      if($query){
          echo "true";
      }
      else{
          echo "false";
      }
    }
    
    public function batchAssignList(){
        $query=$this->Test_model->batchAssignList();
        echo json_encode($query);
        //echo "hello";
    }
    
    public function batchAssignDelete(){
        $query=$this->Test_model->batchAssignDelete(filter_input(INPUT_GET, 'test_id'),filter_input(INPUT_GET, 'batch_id'));
        
        if($query){
          echo "true";
        }
        else{
            echo "false";
        }
    }
    
    
    
    public function studentAssign(){
      $query=$this->Test_model->studentAssign(filter_input(INPUT_GET, 'test_id'),filter_input(INPUT_GET, 'student_id'));
      
      if($query){
          echo "true";
      }
      else{
          echo "false";
      }
    }
    
    public function studentAssignList(){
        $query=$this->Test_model->studentAssignList();
        echo json_encode($query);
        //echo "hello";
    }
    
    public function studentAssignDelete(){
        $query=$this->Test_model->studentAssignDelete(filter_input(INPUT_GET, 'test_id'),filter_input(INPUT_GET, 'student_id'));
        
        if($query){
          echo "true";
        }
        else{
            echo "false";
        }
    }
    
}





?>