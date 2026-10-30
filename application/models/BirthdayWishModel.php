<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class BirthdayWishModel extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
        date_default_timezone_set('Asia/Kolkata');
    } 


    public function BirthdayDateRecord(){
        $query = $this->db->get('birthdaywishes');
        $result=$query->result();
        return array("all_data"=>$result);
    }

}?>