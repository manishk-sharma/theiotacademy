<?php



class Logincnt extends CI_Controller{

    public function __construct(){

        parent::__construct();

        $this->load->model('login_model');

    }

    public function index(){

        $this->load->view('trainers/login');

        

    }

    public function checkLogin(){

        $quesry=$this->login_model->checkLogin($this->input->post('user_log'), $this->input->post('user_pass'));

        if($query){

            echo "Sucess";

        }

        else{

            echo "Failed";

        }

    }

    

    

}











?>