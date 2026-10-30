<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class EnquirySourceModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
        //$this->load->helper('url');
    }

    public function getEnquirySourcesList()
    {
        $query = $this->db->get('enquiry_sources');
        return $query->result();
    }

    public function getActiveEnquirySourcesList()
    {   $this->db->where('status',1) ;
        $query = $this->db->get('enquiry_sources');
        return $query->result();
    }

    public function getSourceTitleById($id){
        $title='nil' ;
        $this->db->where('source_id',$id) ;
        $query = $this->db->get('enquiry_sources');
        $result=$query->result();
        foreach($result as $row){
            $title=$row->title ;
        }
        return $title ;
    }

    public function getEnquirySourceById($id){
        $data=array() ;
        $this->db->where('source_id',$id) ;
        $query = $this->db->get('enquiry_sources');
        $result=$query->result();
        foreach($result as $row){
            $data=array(
                'source_id'=> $row->source_id,
                'title'=> $row->title,
                'status'=> $row->status,
                'last_updated_on'=> date('d-m-Y',strtotime($row->last_updated_on)),
                'created_on'=> date('d-m-Y',strtotime($row->created_on))
            );
        }
        return $data ;
    }

    public function insertEnquirySource($title){
        $sourceid=0 ;
        $data = array('title'=>$title);
        $this->db->insert('enquiry_sources', $data);
        $sourceid=$this->db->insert_id();
        return $sourceid; 
    }

    public function updateEnquirySource($source_id,$title){
        $data = array('title'=>$title);
        $this->db->where('source_id',$source_id);
        $ustatus=$this->db->update('enquiry_sources',$data);
        return $ustatus; 
    }
    
}
?>