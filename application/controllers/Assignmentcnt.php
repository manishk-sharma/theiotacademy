<?php
class Assignmentcnt extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Assignment_model');
    }
    public function index(){
        $this->load->view('trainers/AssignmentList');
    }

     public function batchAssignmentList(){

        $this->load->view('trainers/BatchAssignmentList');

    }

    public function studentAssignmentList(){

        $this->load->view('trainers/StudentAssignmentList');

    }

    public function assignmentForm(){

        $this->load->view('trainers/AssigmentForm');

    }

    public function assignmentList(){
        $query=$this->Assignment_model->assignmentList();
        echo json_encode($query);
        //echo '1';

    }

    public function subassignmentList(){
        $query=$this->Assignment_model->subassignmentList($_GET['topic_id']);
        echo json_encode($query);

    }

    public function assignmentSave(){
        $this->Assignment_model->assignmentSave($this->input->post());
        redirect('Assignmentcnt?subject_id='.$this->input->post('subject_id').'&module_id='.$this->input->post('module_id').'&topic_id='.$this->input->post('topic_id'));

    }

    public function assignmentDelete(){
        $query=$this->Assignment_model->assignmentDelete(filter_input(INPUT_GET,'assignment_id'));
        if($query){
            echo "true";
        }

        else{

            echo "false";
        }
    }

     public function batchAssign(){
      $query=$this->Assignment_model->batchAssign(filter_input(INPUT_GET, 'assignment_id'),filter_input(INPUT_GET, 'batch_id'));

      if($query){

          echo "true";
      }

      else{

          echo "false";
      }

    }

    public function batchAssignList(){
        $query=$this->Assignment_model->batchAssignList();
        echo json_encode($query);
        //echo "hello";

    }

    public function batchAssignDelete(){
        $query=$this->Assignment_model->batchAssignDelete(filter_input(INPUT_GET, 'assignment_id'),filter_input(INPUT_GET, 'batch_id'));

        if($query){
          echo "true";
        }

        else{
            echo "false";
        }
    }

    public function studentAssign(){
      $query=$this->Assignment_model->studentAssign(filter_input(INPUT_GET, 'assignment_id'),filter_input(INPUT_GET, 'student_id'));
      if($query){
          echo "true";
      }

      else{
          echo "false";
      }
    }

    public function studentAssignList(){
        $query=$this->Assignment_model->studentAssignList();
        echo json_encode($query);
        //echo "hello";
    }

    public function studentAssignDelete(){
        $query=$this->Assignment_model->studentAssignDelete(filter_input(INPUT_GET, 'assignment_id'),filter_input(INPUT_GET, 'student_id'));

        if($query){

          echo "true";

        }

        else{

            echo "false";

        }

    }

}

?>