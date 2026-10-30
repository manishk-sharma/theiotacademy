<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class UserTypeModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
        //$this->load->helper('url');
    }

    public function getUserTypeList(){
        $query = $this->db->get('user_types');
        return $query->result();
    }
    
    public function getUserTypeTitleById($id){
        $title='nil' ;
        $this->db->where('type_id',$id) ;
        $query = $this->db->get('user_types');
        $result=$query->result();
        foreach($result as $row){
            $title=$row->title ;
        }
        return $title ;
    }
}
?>