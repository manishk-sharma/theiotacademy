<?php

class SearchData extends CI_Controller{

    public function __construct(){

        parent::__construct();

        $this->load->model('SearchDataModel');

    }

    public function searchfunction()

    {

      $data='';

      $keyword=$this->input->post('keyValue');

      if(trim($keyword)!=''){

        $data=$this->SearchDataModel->GetSearchdata($keyword);

      }

      print_r(json_encode($data));      

    }             

}

?>