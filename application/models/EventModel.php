 <?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

class EventModel extends CI_Model{

    public function __construct(){
        
        parent::__construct();
        
        $this->load->database(); 
        
        $this->load->library('session'); 
        //$this->load->helper('url'); 
    }

    public function getEventList()
    {
        $query = $this->db->get('events'); 
        return $query->result();  
    }


    public function getEventShortList()
    {
        
        $this->db->where('status',1);
        
        $this->db->order_by('created_on','desc') ;
        
        $query = $this->db->get('events'); 
        
        $result=$query->result(); 
        
        $EventData=array();
        foreach ($result as $row) {
             
            $data=array(

                'event_id'=>$row->event_id,
                'event_title'=>$row->event_title,
            );
            array_push($EventData,$data);
         } 

        return $EventData;
    }

    public function getEventNameById($event_id)
    {
        $this->db->where('status',1);

        $this->db->where('event_id',$event_id);

        $query = $this->db->get('events');

        $result=$query->result(); 

        foreach ($result as $row) {
             
            return $row->event_title." (Event ID:".$row->event_id.")";

         } 
    }



    public function collectDataForReg($event_id)
    {
        $this->db->where('event_id',$event_id);

        $query=$this->db->get('events');

        $result=$query->result();

        foreach ($result as $row) {

           $data=array(

            'event_title'=>$row->event_title,

            );
        }

        return $result;

    }




    //=====================Start Use In Pagination==================

    public function record_count() {
        return $this->db->count_all("events");
    }

    public function last_N_events($n)
    {
        $query=$this->db->query('SELECT eve.event_title, eve.start_date, eve.end_date, eve.event_id, et.type_title, eve.route, eve.reg_start_dt,eve.reg_end_dt, eve.intro_image,eve.short_description, eve.event_location_id, Time_Format(Min(es.start_time), "%h:%i %p") as start_time, Time_Format(Max(es.end_time), "%h:%i %p") as end_time FROM event_schedule as es, events as eve, event_type as et WHERE es.event_id = eve.event_id AND et.type_id = eve.event_type_id AND eve.status=1 Group by eve.event_id order by eve.start_date DESC LIMIT '.$n);
         return $query->result();
    }
    
    public function get_all_events($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->order_by('created_on','desc') ;
        $query = $this->db->get("events");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
//======================End Use In Pagination======================


    public function getEventListByEventId($event_id)
    {
        $this->db->where('event_id',$event_id);
        $this->db->order_by('start_date','desc') ;
        $query = $this->db->get('events'); 
        return $query->result();  
    }

    public function getEventById($id){
        
        $data=array();
        
        $this->db->where('event_id',$id);
        
        $query=$this->db->get('events');
        
        $result=$query->result();
        
        foreach ($result as $row) {

            $data=array( 
                
                'event_id'=>$row->event_id,
                
                'route_name'=>$row->route,
                
                'event_type_id'=>$row->event_type_id,
                
                'event_title'=>$row->event_title,
                
                'event_location_id'=>$row->event_location_id,
                
                'short_description'=>$row->short_description,
                
                'long_description'=>$row->long_description, 
                
                'keywords'=>$row->keywords,           
                
                'multi_day'=>$row->multi_day,
                
                'event_open'=>$row->event_open,
                
                'reg_open'=>$row->reg_open,

                'reg_link'=>$row->reg_link,
                
                'reg_start_dt'=>$row->reg_start_dt,
                
                'reg_end_dt'=>$row->reg_end_dt,
                
                'start_date'=>$row->start_date,
                
                'end_date'=>$row->end_date,
                
                'days_quantity'=>$row->days_quantity,
                
                'payment_type'=>$row->payment_type,
                
                'price'=>$row->price
            );
        }

        return $data;
    }


    public function getEventImagesName($id){  
        
        $data=array();
        
        $this->db->where('event_id',$id);
        
        $query=$this->db->get('events');
        
        $result=$query->result();
        
        foreach ($result as $row) {

            $data=array( 

                    'intro_image'=>$row->intro_image,

                    'main_image'=>$row->main_image

                        );
        }

        return $data;
    }

    public function getEventsDates($id){  
        
        $data=array();
        
        $this->db->where('event_id',$id);
        
        $query=$this->db->get('events');
        
        $result=$query->result();
        
        foreach ($result as $row) {

            $data=array( 

                    
                    'reg_start_dt'=>$row->reg_start_dt,
                    
                    'reg_end_dt'=>$row->reg_end_dt,
                    
                    'start_date'=>$row->start_date,
                    
                    'end_date'=>$row->end_date

                    );
        }

        return $data;
    } 

    public function getActiveEventsList(){

        $this->db->where('status',1);
        
        $query = $this->db->get('events');

        return $query->result();
    }
    
    public function getUpcomingEventsList(){

        $this->db->where('event_flag',1);
        
        $this->db->where('status',1);
        
        $query = $this->db->get('events');

        return $query->result();
    }
    
    public function getOngoingEventsList(){
        
        $this->db->where('event_flag',2);
        
        $this->db->where('status',1);
        
        $query = $this->db->get('events');
        
        return $query->result(); 
    }

    public function getPastEventsList(){   
        
        $this->db->where('event_flag',3);
        
        $this->db->where('status',1);
        
        $query = $this->db->get('events');
        
        return $query->result();
    }
    
    
    public function insertEvent($route,$event_type_id,$event_title,$event_location_id,$short_description,$long_description,$keywords,$multi_day,$start_date,$end_date,$days_quantity,$event_open,$reg_open,$reg_link,$reg_start_dt,$reg_end_dt,$payment_type,$price){
        
        $data = array(
        
            'route'=>$route,
        
            'event_type_id'=>$event_type_id,
        
            'event_title'=>$event_title,
        
            'event_location_id'=>$event_location_id,
        
            'short_description'=>$short_description,
        
            'long_description'=>$long_description,
        
            'keywords'=>$keywords,
        
            'multi_day'=>$multi_day,
        
            'start_date'=>$start_date,
        
            'end_date'=>$end_date,
        
            'days_quantity'=>$days_quantity,
        
            'event_open'=>$event_open,
        
            'reg_open'=>$reg_open,

            'reg_link'=>$reg_link,
        
            'reg_start_dt'=>$reg_start_dt,
        
            'reg_end_dt'=>$reg_end_dt, 
        
            'payment_type'=>$payment_type, 
        
            'price'=>$price
        );

        
        $this->db->insert('events', $data);
        
        $eventid=$this->db->insert_id();
        
        return $eventid;
    }
//============================Update Events==========================
   public function updateEvent( $event_id,$route,$event_type_id,$event_title,$event_location_id,$short_description,$long_description,$keywords,$multi_day,$start_date,$end_date,$days_quantity,$event_open,$reg_open,$reg_link,$reg_start_dt,$reg_end_dt,$payment_type,$price){
         
         $data=array(
         
            'route'=>$route,
         
            'event_type_id'=>$event_type_id,
         
            'event_title'=>$event_title,
         
            'event_location_id'=>$event_location_id,
         
            'short_description'=>$short_description,
         
            'long_description'=>$long_description,
         
            'keywords'=>$keywords,
         
            'multi_day'=>$multi_day,
         
            'start_date'=>$start_date,
         
            'end_date'=>$end_date,
         
            'days_quantity'=>$days_quantity,
         
            'event_open'=>$event_open,
         
            'reg_open'=>$reg_open,

            'reg_link'=>$reg_link,
         
            'reg_start_dt'=>$reg_start_dt,
         
            'reg_end_dt'=>$reg_end_dt, 
         
            'payment_type'=>$payment_type, 
         
            'price'=>$price

        );
         
         $this->db->where('event_id',$event_id);
         
         $ustatus=$this->db->update('events',$data);
         
         return $ustatus;
    }

//---------------Speaker Schedule Mapping-------------------------
    public function getSpeakerInfoByScheduleId($schd_id){
        
        $data=array();
        
        $this->db->where('schd_id',$schd_id);
        
        $query=$this->db->get('event_speaker_schedule_mapping');
        
        $result=$query->result();
        
        foreach ($result as $row) {
            
            $data=array( 
            
                'event_id'=>$row->event_id,
            
                'route_name'=>$row->route,
            
                'event_type_id'=>$row->event_type_id,
            
                'event_title'=>$row->event_title,
            
                'event_location_id'=>$row->event_location_id,
            
                'short_description'=>$row->short_description,
            
                'long_description'=>$row->long_description, 
            
                'keywords'=>$row->keywords,           
            
                'multi_day'=>$row->multi_day,
            
                'event_open'=>$row->event_open,
            
                'reg_open'=>$row->reg_open,

                'reg_link'=>$row->reg_link,
            
                'reg_start_dt'=>$row->reg_start_dt,
            
                'reg_end_dt'=>$row->reg_end_dt,
            
                'start_date'=>$row->start_date,
            
                'end_date'=>$row->end_date,
            
                'days_quantity'=>$row->days_quantity,
            
                'payment_type'=>$row->payment_type,
            
                'price'=>$row->price
            );
        }

        return $data;
    }

//====================Update Event Images Name=========== 
    
    public function updateEventIntroImageName($event_id,$introimgstatus){
        
        $filetype=$introimgstatus['ext'];
        
        $data = array(
                    'intro_image'=>'introimage-'.$event_id.$filetype
                );
        
        $this->db->where('event_id',$event_id);
        
        $ustatus=$this->db->update('events',$data);
        
        return $ustatus; 
    }


    public function updateEventMainImageName($event_id,$mainimgstatus){
        
        $filetype=$mainimgstatus['ext'];
        
        $data = array(
                    'main_image'=>'mainimage-'.$event_id.$filetype
                );
        
        $this->db->where('event_id',$event_id);
        
        $ustatus=$this->db->update('events',$data);
        
        return $ustatus; 
    }


    public function updateEventStatus($event_id,$status){
        
        $data = array('status'=>$status);
        
        $this->db->where('event_id',$event_id);
        
        $ustatus=$this->db->update('events',$data);
        
        return $ustatus; 
    }

//----------------Update event status Upcomin/Ongoing/Past------------    
    public function updateEventFlag($event_id,$event_flag){
        
        $data=array('event_flag'=>$event_flag);
        
        $this->db->where('event_id',$event_id);
        
        $ustatus=$this->db->update('events',$data);
        
        return $ustatus;
    }
//-------------------Delete Event Data From DB----------------
    public function deleteEventData($event_id){
        
        $dayid=$this->EventDaysModel->getDaysIdByEventId($event_id);
        
        $schedulestatus=$this->EventScheduleModel->deletScheduleByDayId($dayid);//delete Schedule
        $daytatus=$this->EventDaysModel->deleteEventDaysId($event_id);//delete Event Days
        
        $this->db->where('event_id',$event_id);
        
        $eventstatus=$this->db->delete('events');//delete Events
        
        return $status=true;
    }

    public function copyEvent($event_id){
        
        $status=array();
        
        $eventsql='call create_duplicate_events(?)';
        
        $daysql='call create_duplicate_date(?,?)';
        
        if ($this->db->query($eventsql,array($event_id)))
        {
            $query = $this->db->query("SELECT * FROM events ORDER BY event_id DESC LIMIT 1");
            
            $result = $query->result();
            
            $data=array();
            
            $new_created_event_id="nil";
            
            $route_name="nil";
            
            foreach ($result as $row) {
                
                $data=array('event_id'=>$row->event_id);
                
                $new_created_event_id=$data['event_id'];
                
                $route=$row->route;
                
                $status[0]=$new_created_event_id;
            }

            $ruotestatus=$this->newCreatedEventRoute($new_created_event_id,$route);
            
            if ($this->db->query($daysql,array($event_id,$new_created_event_id))){
                $query = $this->db->query("SELECT * FROM event_days where event_id=".$new_created_event_id);
                
                $result=$query->result();
                
                $dateIdArr=array();
                
                foreach ($result as $row) {
                    $dateIdArr[]=$row->day_id;  
                }
                
                $dateIdArr = implode(', ', $dateIdArr); 
                
                $status[1]=true;
            }
        }
        else
        {
            $status[1]=false;
        }
     return $status;
   }

   public function newCreatedEventRoute($new_created_event_id,$route){
        $route=$route.$new_created_event_id;
        $data=array('route'=>$route,
                    'intro_image'=>"nil",
                    'main_image'=>"nil");
        $this->db->where('event_id',$new_created_event_id);
        $ustatus=$this->db->update('events',$data);
        return $ustatus; 
   }


   public function backupEventData($event_id){   
        
        $schd_id="nil";
        
        $days_id="nil";
        
        $day_backup_sql='call backup_date(?)';
        
        $schd_backup_sql='call backup_schedule(?)';

        if ($this->db->query($day_backup_sql,array($event_id))){
            $status=true;
            
        }
        else{
            $status=false;
        }

        
        $days_id=$this->EventDaysModel->getDaysIdByEventId($event_id);
        
        foreach ($days_id as $row => $day_id) {
            
            if ($this->db->query($schd_backup_sql,array($day_id)))
            {
                $status=true;

            }
            else
            {
                $status=false;
            }
            //$schd_id=$this->EventScheduleModel->getEventScheduleIdByDayId($day_id);
        }

    return $status;
   }


//==============Getting schedule By Event Id======================

public function getScheduleByEventId($event_id){

   $daysid=$this->EventDaysModel->getDaysIdByEventId($event_id);

    $schddataArr=array();

   foreach ($daysid as $row => $dayid) {

     $schddata=$this->EventScheduleModel->getEventScheduleByDayId($dayid);
     //print_r($schddata);
     array_push($schddataArr,$schddata);

    }

    return $schddataArr;
}





public function getActiveEventsData(){
 
    
    $this->db->where('status',1);
    
    $this->db->order_by('start_date','asc');
    
    $query = $this->db->get('events');

    $result=$query->result(); 

    $activeEventsData=array();//store all Active Events From DB 

    $eventsData=array();//single Event pushing one by one

    $data=array();

    for ($i=0; $i <count($result) ; $i++) { 

       array_push($eventsData, $result[$i]);

       foreach ($eventsData as $row) {

        $schdTiming=$this->EventScheduleModel->getEventTimeByEventID($row->event_id);

        

        //echo($schdTiming['start_time']);

         $locationData=$this->EventLocationModel->getLocationTitleById($row->event_location_id);

            $data=array( 
            
                'event_id'=>$row->event_id,
            
                'route'=>$row->route,
            
                'event_type_id'=>$row->event_type_id,
            
                'event_title'=>$row->event_title,
            
                'intro_image'=>$row->intro_image,
            
                'location'=>$locationData,
            
                'short_description'=>$row->short_description,
            
                'long_description'=>$row->long_description, 
            
                'keywords'=>$row->keywords,           
            
                'multi_day'=>$row->multi_day,
            
                'event_open'=>$row->event_open,
            
                'reg_open'=>$row->reg_open,

                'reg_link'=>$row->reg_link,
            
                'reg_start_dt'=>$row->reg_start_dt,
            
                'reg_end_dt'=>$row->reg_end_dt,
            
                'start_date'=>$row->start_date,
            
                'end_date'=>$row->end_date,
    
                'start_time'=>date('H:i',strtotime($schdTiming['start_time'])),

                'end_time'=>date('H:i',strtotime($schdTiming['end_time'])),
            
                'days_quantity'=>$row->days_quantity,
            
                'payment_type'=>$row->payment_type,
            
                'price'=>$row->price

            );

        }
        array_push($activeEventsData, $data);
    }
    return $activeEventsData;
    }   
}
?>