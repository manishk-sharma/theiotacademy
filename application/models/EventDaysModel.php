<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class EventDaysModel extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
        $this->load->helper('url'); 
    }

    public function getEventDaysList()
    {
        $query = $this->db->get('event_days');
        return $query->result();
    } 

    public function getActiveEventDaysListByEventId($event_id)
    {   
        $this->db->where('event_id',$event_id) ;
        $this->db->where('scheduled',1) ;
        $this->db->where('status',1) ;
        $query = $this->db->get('event_days');
        return $query->result();
    }

    public function getEventDaysListByEventId($event_id){
        $this->db->where('event_id',$event_id) ;
        $query = $this->db->get('event_days');
        return $query->result();
    }

    public function getEventDaysByEventId($event_id)
    {   
        $data=array();
        $this->db->where('event_id',$event_id) ;
        $query = $this->db->get('event_days');
        $result=$query->result();
        foreach ($result as $row) {
            $data=array(
                    'day_id'=>$row->event_id, 
                    'event_id'=>$row->event_id,
                    'day_date'=>$row->day_date,
                    'scheduled'=>$row->scheduled,
                    'status'=>$row->status
                );
        } 
        return $data;
     }

    public function getScheduledEventDaysListByEventId($event_id){
        $this->db->where('event_id',$event_id) ;
        $this->db->where('scheduled',1) ;
        $query = $this->db->get('event_days');
        return $query->result();
    }

    public function insertEventDay($event_id,$daydate){
        $data=array(
            'event_id'=>$event_id,
            'day_date'=>$daydate
        ); 
        $this->db->insert('event_days',$data);
        $dayid=$this->db->insert_id();
        return $dayid;  
    } 
    public function updateEventDay($event_id,$db_daydate_id,$daydate){
        $data=array(
            'event_id'=>$event_id,
            'day_date'=>$daydate
        );
        $this->db->where('event_id',$event_id);
        $this->db->where('day_id',$db_daydate_id);
         $ustatus=$this->db->update('event_days',$data);
         return $ustatus;
    }

    /*public function insertEventDaysSet($daysSet){
        $status=0 ;
       $status= $this->db->insert_batch('event_days', $daysSet);
        return $status;  
    }

    public function updateEventDaysSet($dayset,$event_id){
        $data=$dayset;
        //$this->db->where('day_id',$day_id);
        //$ustatus=$this->db->update('event_days',$data);
         //$status=$this->db->update_batch('event_days', $data, 'event_id');
        return $status; 
    }*/

    public function updateDayScheduleStatus($day_id,$daystatus)
    {
        //echo($day_id);
       // echo "$daystatus";
        $data=array(
            'scheduled'=>$daystatus
        );
        $this->db->where('day_id',$day_id);
        $ustatus=$this->db->update('event_days',$data);
    }

    //get days id by event id========================
    public function getDaysIdByEventId($event_id)
    {   $data=array();
        $this->db->where('event_id',$event_id);
        $this->db->select('day_id');
        $this->db->from('event_days');
        $query = $this->db->get();
        $result=$query->result();
        foreach ($result as $row) {
            $data[]=$row->day_id;
        }
        return $data;
    }



    public function deleteEventDayByDayId($day_id)
    {  
        $this->db->where('day_id',$day_id);
        $status=$this->db->delete('event_days');
        return $status;
    }

    public function deleteEventDaysId($event_id)
    {  

        $this->db->where('event_id',$event_id);
        $status=$this->db->delete('event_days');
        return $status;
    }
    public function updateEventDateStatus($day_id,$status)
    {
        $data = array('status'=>$status);
        $this->db->where('day_id',$day_id);
        $ustatus=$this->db->update('event_days',$data);
        return $ustatus; 
    }
}
?>