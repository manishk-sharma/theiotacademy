<?php
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hire_From_Us_Model extends CI_Model{
       
    public function insert_hire_from_us($data){
		$this->db->insert('leads', $data);
		$enqid=$this->db->insert_id();
		return $enqid;

	}
      
   
}

