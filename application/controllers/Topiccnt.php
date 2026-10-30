<?php

class Topiccnt extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Topic_model');
    }
    
    public function index(){
        $this->load->view('trainers/TopicList');
        
    }
    
    public function topicForm(){
        $this->load->view('trainers/TopicForm');
    }
    
    public function topicList(){
        $query=$this->Topic_model->topicList();
        echo json_encode($query);
        //echo '1';
    }
    
    public function subtopicList(){
        $query=$this->Topic_model->subtopicList($_GET['module_id']);
        echo json_encode($query);
        //echo '1';
    }
    
    
    public function topicSave(){
        $this->Topic_model->topicSave($this->input->post());
        redirect('Topiccnt?subject_id='.$this->input->post('subject_id').'&module_id='.$this->input->post('module_id'));
    }
    
    public function topicDelete(){
        $query=$this->Topic_model->topicDelete(filter_input(INPUT_GET,'topic_id'));
        if($query){
            echo "true";
        }
        else{
            echo "false";
        }
    }
    
    
    
}





?>