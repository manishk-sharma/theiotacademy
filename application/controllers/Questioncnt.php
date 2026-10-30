<?php

class Questioncnt extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Question_model');
    }
    
    public function index(){
        $this->load->view('trainers/QuestionList');
        
    }
    
    public function questionForm(){
        $this->load->view('trainers/QuestionForm');
    }
    
    public function questionList(){
        $query=$this->Question_model->questionList();
        echo json_encode($query);
        //echo '1';
    }
    
    public function subquestionList(){
        $query=$this->Question_model->subquestionList($_GET['topic_id']);
        echo json_encode($query);
     
    }
    
    public function subTestQuestionList(){
        $query=$this->Question_model->subTestQuestionList($_GET['topic_id'],$_GET['test_id']);
        echo json_encode($query);
        
    }
    
    
    public function questionSave(){
        $this->Question_model->questionSave($this->input->post());
        redirect('Questioncnt?subject_id='.$this->input->post('subject_id').'&module_id='.$this->input->post('module_id').'&topic_id='.$this->input->post('topic_id'));
    }
    
    public function questionDelete(){
        $query=$this->Question_model->questionDelete(filter_input(INPUT_GET,'question_id'));
        if($query){
            echo "true";
        }
        else{
            echo "false";
        }
    }
    
    public function optionList(){
        $query=$this->Question_model->optionList($_GET['question_id']);
        echo json_encode($query);
        
    }
}
?>