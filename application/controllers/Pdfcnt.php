<?php
class Pdfcnt extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        //$this->load->model('login_model');
    }
    
    public function index(){
        if(filter_input(INPUT_GET,'studymaterial_id')){
            $studymaterial_id = filter_input(INPUT_GET,'studymaterial_id');
            $this->load->view('trainers/pdfview',$studymaterial_id);
        }
        if(filter_input(INPUT_GET,'assignment_id')){
            $assignment_id = filter_input(INPUT_GET,'assignment_id');
            $this->load->view('trainers/pdfview',$assignment_id);
        }
    }
    

    
    
}
?>
