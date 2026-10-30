<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class CAModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
        //$this->load->helper('url');
    }

    public function insertLiveCampusAmbassador($data){
    	
		$this->db->insert('ca_details',$data);
		$enqid=$this->db->insert_id();
		return $enqid;
	}
}
?>
