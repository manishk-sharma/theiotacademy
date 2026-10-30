<?php

class Levelcnt extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Level_model');
    }
    

    public function levelList(){
        $query=$this->Level_model->levelList();
        echo json_encode($query);
        //echo '1';
    }
    
   
    
}





?>