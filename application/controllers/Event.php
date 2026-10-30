<?php 
//ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {  

  public function __construct(){
    parent::__construct(); 
    //error_reporting(0); 
     $this->load->helper('utility_helper');
     $this->load->library('upload');
     $this->load->library('form_validation');
     $this->load->model('AppModel');
     $this->load->model('EmployeeModel');
     $this->load->model('UserModel');
     $this->load->model('DesigModel');
     $this->load->model('UserTypeModel'); 
     $this->load->library('session');
     $this->load->model('EventModel');
     $this->load->model('EventTypeModel');
     $this->load->model('EventDaysModel');
     $this->load->model('EventScheduleModel');
     $this->load->model('EventLocationModel');
     $this->load->model('EventGuestSpeakerModel');
     //$this->load->library('session'); 
     //$this->load->helper(array('form', 'url'));
     //$this->load->library('form_validation');
     
  } 
 
 
    public function event_list(){  
        $data['eventlist']=$this->EventModel->getEventList();
        $data['data']=$this->total_event();
        $this->load->view('admin/event/eventmanage',$data);
    }
//==========================Paginations===============================
public function total_event() {
    $this->load->library("pagination");
        $config = array();
        $config["base_url"] = base_url() . "Event/event_list";
        $config["total_rows"] = $this->EventModel->record_count();
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;
        //$config['use_page_numbers'] = TRUE;
        $config['cur_tag_open'] = '<a class="active" href="#">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->EventModel->get_all_events($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        return $data;
    }

//========================Pagination================================= 




//-----------------add event-------------
    public function add_event(){    
        $this->load->view('admin/event/addevent');
    }
    
    public function edit_event($id){
        $data=$this->EventModel->getEventById($id);
        $this->load->view('admin/event/updateevent',$data);
    }

    

//------------------changeEventStatus-------
    public function changeEventStatus(){
      $eventid=$this->input->post("eventflagid");
      $flagstatus=$this->input->post("eventflag");
      echo "event : $eventid";
      $status=$this->EventModel->updateEventFlag($eventid,$flagstatus);
      if ($status) {
            $this->session->set_flashdata('success', ' Event Status Changed Successfully For Event Id '.$eventid);
           redirect(base_url().'aevent');
           }else{
            $this->session->set_flashdata('error', 'Error ! Unable To Change Status. Please Try Again! Event Id '.$eventid);
           redirect(base_url().'aevent');
           }
      }


//Function For Getting Event  List By Event ID JSON AJAX Output 
public function printEventListByEventId(){
  $event_id=$this->input->post('eventid');
  $eventdata=$this->EventModel->getEventById($event_id);
  $daysdata=$this->EventDaysModel->getEventDaysListByEventId($event_id) ;
  
  $dayDataArr=array(); 
  $schdDataArr=array();

  foreach ($daysdata as $row) {
    $data=array(
      'day_id'=>$row->day_id, 
      'event_id'=>$row->event_id,
      'day_date'=>$row->day_date,
      'scheduled'=>$row->scheduled,
      'status'=>$row->status,
      'schd_data'=>$this->EventScheduleModel->getEventScheduleByDayId($row->day_id));
      array_push($schdDataArr, $data);
  }
  array_push($dayDataArr,$schdDataArr);
  $eventdata['days_data']=$dayDataArr;

      if(count($eventdata)>0){ 
          echo json_encode($eventdata);
      }else{
          echo 'false' ;
      }
}



//Function For Getting Event Days List By Event ID JSON AJAX Output FOR DROPDOWN 
   public function printEventDaysListByEventId(){
        $event_id=$this->input->post('eventid');

        $data=$this->EventDaysModel->getEventDaysListByEventId($event_id) ;

        if(count($data)>0){ 
            echo json_encode($data);
        }else{
            echo 'false' ;
        } 
    }
    

//Function For Getting event Speaker List By Type JSON AJAX Output
    public function printActiveEventSpeakerListByType(){
        $event_speaker_type=$this->input->post('eventspeakertype') ;

        if ($event_speaker_type=='employee') {
           $data=$this->EmployeeModel->getEmployeeList() ;
        }else if ($event_speaker_type=='guest') {
           $data=$this->EventGuestSpeakerModel->getActiveSpeakerList() ;
        }else{
            echo "false";
        }
       
        if(count($data)>0){ 
            echo json_encode($data);
        }else{ 
            echo 'false' ;
        }
    } 
//==========================================================

public function event_61()
{
	$this->load->view('events/event61.php');
}


public function event_62()
{
	$this->load->view('events/event62.php');
}


public function event_63()
{
	$this->load->view('events/event63.php');
}


public function event_64()
{
	$this->load->view('events/event64.php');
}


public function event_65()
{
	$this->load->view('events/event65.php');
}


public function event_66()
{
	$this->load->view('events/event66.php');
}


public function event_67()
{
	$this->load->view('events/event67.php');
}


public function event_68()
{
	$this->load->view('events/event68.php');
}


public function event_69()
{
	$this->load->view('events/event69.php');
}


public function event_70()
{
	$this->load->view('events/event70.php');
}


public function event_71()
{
	$this->load->view('events/event71.php');
}


public function event_72()
{
	$this->load->view('events/event72.php');
}


public function event_73()
{
	$this->load->view('events/event73.php');
}

}?>