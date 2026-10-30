<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class EventTypeModel extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
        $this->load->helper('url');
    }

    public function getEventTypeList()
    {
        $query = $this->db->get('event_type');
        return $query->result();

    }

    //get event type by id-----------------------
    public function getEventTypeTitleById($id)
    {   $title='nill';
        $this->db->where('type_id',$id);
        $query=$this->db->get('event_type');  
        $result=$query->result();
        foreach ($result as $row) {
            $title=$row->type_title;
        }
        return $title; 
    }

    public function getActiveEventTypeList() 
    {   $this->db->where('status',1) ;
        //$this->db->order_by('created_on,desc');
        $query = $this->db->get('event_type');
        return $query->result();
    }

    public function insertEventType($type_title) 
    {   
        $type_id=0;
        $data =array('type_title'=>$type_title);
        $this->db->insert('event_type', $data);
        $type_id=$this->db->insert_id();
        return $type_id;
    
    }
    public function updateEventType($type_id,$type_title)
    {
        $data =array('type_title'=>$type_title);
        $this->db->where('type_id',$type_id);
        $type_status=$this->db->update('event_type',$data);
        return $type_status;
    
    }
    public function updateEventTypeStatus($type_id,$status)
    {
        $data=array('status'=>$status);
        $this->db->where('type_id',$type_id);
        $type_status=$this->db->update('event_type',$data);
        return $type_status;
    }

    
   

}
?>