<?php
 /**
  * 
  */
 class EventScheduleModel extends CI_model
 {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
        //$this->load->helper('url');
    }
//---------------------------Read data from event schedule table  -------------  
    public function getScheduleList(){
        $query=$this->db->get('event_schedule'); 
        return $query->result();
    }

    public function getActiveEventScheduleByDayId($id){
        $data=array() ;
        $this->db->where('day_id',$id) ;
        $this->db->where('status',1) ;
        $query = $this->db->get('event_schedule');
        $result=$query->result();
        return $result ;
    }

    public function getEventScheduleByDayId($id){
        $data=array();
        $this->db->where('day_id',$id) ;
        $query = $this->db->get('event_schedule');
        $result=$query->result();
        return $result ;
    }
     public function getEventScheduleIdByDayId($day_id)
    {   $data=array() ;
        $this->db->where('day_id',$day_id) ;
        $this->db->select('schd_id');
        $this->db->from('event_schedule');
        $query = $this->db->get();
        $result=$query->result();
        foreach ($result as $row) {
            $data[]=$row->schd_id;
        }
        return $data;
    }

    //-----------Extract Schedule By ScheduleID-----------------------------
    public function getEventScheduleById($id){
        $data=array() ;
        $this->db->where('schd_id',$id) ;
        $query = $this->db->get('event_schedule');
        $result=$query->result();
        foreach($result as $row){
            $data=array(
                'schd_id'=> $row->schd_id,
                'day_id'=> $row->day_id,
                'title'=>$row->title,
                'description'=>$row->description,
                'start_time'=>$row->start_time,
                'end_time'=>$row->end_time,
                'speaker_id'=>$row->speaker_id,
                'speaker_type'=>$row->speaker_type,
                'schd_photo'=>$row->schd_photo,
                'status'=>$row->status,
                'last_updated_on'=>$row->last_updated_on,
                'created_on'=>$row->created_on
            );
        }
        return $data ;
    }


//------------------------insert data into event schedule table--------------
    public function insertSchedule($day_id,$event_id,$title,$description,$start_time,$end_time,$speaker_id,$speaker_type)
    {   
        
        $data=array(
                    'day_id'=>$day_id,
                    'event_id'=>$event_id,
                    'title'=>$title,
                    'description'=>$description,
                    'start_time'=>$start_time,
                    'end_time'=>$end_time,
                    'speaker_id'=>$speaker_id,
                    'speaker_type'=>$speaker_type
                );
                $this->db->insert('event_schedule',$data);
                $schd_id=$this->db->insert_id();
                return $schd_id;
    }
    //------------------------Update data into event schedule table--------------

    public function updateSchedule($schd_id,$day_id,$event_id,$title,$description,$start_time,$end_time,$speaker_id,$speaker_type){

        $data=array(
                    #'schd_id'=>$schd_id,
                    'day_id'=>$day_id,
                    'event_id'=>$event_id,
                    'title'=>$title,
                    'description'=>$description,
                    'start_time'=>$start_time,
                    'end_time'=>$end_time,
                    'speaker_id'=>$speaker_id,
                    'speaker_type'=>$speaker_type
                );
        $this->db->where('schd_id',$schd_id);
        $ustatus=$this->db->update('event_schedule',$data);
        return $ustatus; 
    }
//------------if Upload Sucess--------
    public function updateSchdImageNames($schd_id){
            $data = array(
                        'schd_photo'=>'schedulepic-'.$schd_id.'.png',
                    );
            $this->db->where('schd_id',$schd_id);
            $ustatus=$this->db->update('event_schedule',$data);
            //print_r($ustatus);
            return $ustatus; 
        }       

public function deletScheduleByDayId($day_id)
{   
    foreach ($day_id as $row => $day_id) {
        $this->db->where('day_id',$day_id);
        $schdtatus=$this->db->delete('event_schedule');//delete Event Schedule
    }
    return $schdtatus;  
}

public function deletScheduleBySchdId($schd_id)
    {  

        $this->db->where('schd_id',$schd_id);
        $status=$this->db->delete('event_schedule');
        return $status;
    }

//------------------if pic not Uploaded-----------
    /*public function updateSchdImageNames($schd_id){
            $data = array(
                        'photo'=>'nil',
                    );
            $this->db->where('schd_id',$schd_id);
            $ustatus=$this->db->update('event_schedule',$data);
            //print_r($ustatus);
            return $ustatus; 
    } */ 
   public function updateScheduleStatus($schd_id,$status)
    {
        $data = array('status'=>$status);
        $this->db->where('schd_id',$schd_id);
        $ustatus=$this->db->update('event_schedule',$data);
        return $ustatus;
    }

// event start time and end time by Event Id
    public function getEventTimeByEventID($event_id)
    {

    $sql="SELECT IFNULL(MIN(start_time), '10:00:00') as start_time, IFNULL(MAX(end_time), '18:00:00') as end_time FROM event_schedule WHERE event_id=".$event_id;


        $query=$this->db->query($sql);

        $result = $query->result();

        $data=array();

        foreach ($result as $row) {
           
           $data=array(

            'start_time'=>$row->start_time,
            'end_time'=>$row->end_time

           );
           
        }

        return $data;

    }



 }