<?php
if(!defined('BASEPATH')) exit('');

class EventLocationModel extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
        //$this->load->helper('url');
    }
 
    public function getLocationList()
    { 
        $query = $this->db->get('event_location');
        return $query->result();
    }
    public function getLocationByLocationId($id)
    { 
        $location='nil';
        $this->db->where('location_id',$id);
        $query=$this->db->get('event_location');
        $result=$query->result();
        return $result;
    }
    public function getLocationTitleById($id)
    {   
        $data=array() ;
        $this->db->where('location_id',$id);
        $query=$this->db->get('event_location');
        $result=$query->result();
        foreach ($result as $row) {
           $data=array(
            'location_title'=>$row->location_title,
            'house_no'=>$row->house_no,
            'area'=>$row->area,
            'city'=>$row->city,
            'district'=>$row->district,
            'state'=>$row->state,
            'pin_code'=>$row->pin_code,
            'map_link'=>$row->map_link,
            'country'=>$row->country
           );
        }
        return $data;
    }
    
    public function getActiveLocationList() 
    {   $this->db->where('status',1) ;
        //$this->db->order_by('created_on,desc');
        $query = $this->db->get('event_location');
        return $query->result();
    }

    public function insertLocation($location_title,$house_no,$area,$city,$district,$state,$pin_code,$map_link,$country){
        $location_id=0;
        $data=array(
            'location_title'=>$location_title,
            'house_no'=>$house_no,
            'area'=>$area,
            'city'=>$city,
            'district'=>$district,
            'state'=>$state,
            'pin_code'=>$pin_code,
            'map_link'=>$map_link,
            'country'=>$country
        );
        $this->db->insert('event_location',$data);
        $location_id=$this->db->insert_id();
        return $location_id;
    }

    public function updateLocation($location_id,$location_title,$house_no,$area,$city,$district,$state,$pin_code,$map_link,$country){
        $data=array(
            'location_title'=>$location_title,
            'house_no'=>$house_no,
            'area'=>$area,
            'city'=>$city,
            'district'=>$district,
            'state'=>$state,
            'pin_code'=>$pin_code,
            'map_link'=>$map_link,
            'country'=>$country
        );
        $this->db->where('location_id',$location_id);
         $ustatus=$this->db->update('event_location',$data);
         return $ustatus;
    }

    public function updateLocationStatus($location_id,$status){
        $data = array('status'=>$status);
        $this->db->where('location_id',$location_id);
        $ustatus=$this->db->update('event_location',$data);
        return $ustatus; 
    }

}
?>