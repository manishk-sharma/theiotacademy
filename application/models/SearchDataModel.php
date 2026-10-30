<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class SearchDataModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
        $this->load->helper('url');
    }
    public function GetSearchdata($keyword){
    $this->db->select('*'); 
	$this->db->from('search_data');
	$this->db->like('keyword', $keyword);
	$this->db->order_by("title", "asc");
	return $this->db->get()->result_array();
  }


}
?>