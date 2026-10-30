<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class NewsLetterModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        //$this->load->model('RegisterModel');
        $this->load->library('session'); 
        //$this->load->helper('url');
    }

    public function getNewsLetterList()
    {
        $query = $this->db->get('newsletters');
        return $query->result();
    }

    public function insertNewsLetterEmail($email_id,$inserted_date){
        $crid=0 ;
        $data = array('email_id'=>$email_id,'inserted_date'=>$inserted_date);
        $this->db->insert('newsletters', $data);
        $nid=$this->db->insert_id();
        return $nid; 
    }

}
?>