<?php

class TestQuestioncnt extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('TestQuestion_model');
    }
    
    public function index(){
        $this->load->view('trainers/TestQuestionList');
        
    }
    
    public function testQuestionForm(){
        $this->load->view('trainers/testQuestionForm');
    }
    
    public function subTestQuestionHomeList(){
        $query=$this->TestQuestion_model->subTestQuestionHomeList(filter_input(INPUT_GET, 'test_id'));
        echo json_encode($query);
    }
    
    public function testQuestionSave(){
        $this->TestQuestion_model->testQuestionSave($this->input->post());
        redirect('TestQuestioncnt?test_id='.$this->input->post('test_id').'&subject_id='.$this->input->post('subject_id').'&module_id='.$this->input->post('module_id').'&topic_id='.$this->input->post('topic_id'));
    }
    
    public function testQuestionDelete(){
        $query=$this->TestQuestion_model->testQuestionDelete(filter_input(INPUT_GET,'testQuestion_id'));
        if($query){
            echo "true";
        }
        else{
            echo "false";
        }
    }
    
}
?>