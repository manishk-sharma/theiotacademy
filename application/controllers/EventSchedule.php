<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(dirname(__FILE__).'/EventCreate.php');
class EventSchedule extends EventCreate {  

	public function __construct(){  
		parent::__construct(); 
		error_reporting(0); 
		$this->load->helper('utility_helper');
		$this->load->library('form_validation');
		$this->load->model('EventModel');
		$this->load->model('EventDaysModel');
		$this->load->model('EventGuestSpeakerModel');
		$this->load->model('EventScheduleModel');
		$this->load->model('EventTypeModel');
		$this->load->model('EventLocationModel');
		$this->load->model('AppModel');
		$this->load->model('EmployeeModel'); 
		$this->load->model('UserTypeModel');
		$this->load->library('session');  
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

	}
	public function schedule_submit(){
		$schd_id=0;
		$day_id=$this->input->post('dayid');
		$title=$this->input->post('title');
		$description=$this->input->post('description');
		$start_time=$this->input->post('starttime');
		$end_time=$this->input->post('endtime');
//----------------for event speaker schedule mapping 
		$event_id=$this->input->post('eventid');
		$speaker_type=$this->input->post('eventspeakertype');
		$speaker_id=$this->input->post('eventspeakerid');


	//---------------insert shedule-----------------
		$schd_id=$this->EventScheduleModel->insertSchedule(
							$day_id,
							$event_id,
							$title,
							$description,
							$start_time,
							$end_time,
							$speaker_id,
							$speaker_type);

		if ($schd_id>0) {
			$picstatus=$this->uploadpicforschedule($schd_id);
				if ($picstatus) {
					$updateSchdImageNames=$this->EventScheduleModel->updateSchdImageNames($schd_id);
					$message="Schedule Updated Successfully" ;
	        		$this->session->set_flashdata('success',$message);
	        			//redirect(base_url().'aevent'); 
				}
				else{
					//$picUplodaFailed=$this->EventScheduleModel->profileUplodaFailed($schd_id);
					$message=" Photo Not Uploadded <br> File Type Must be Png/PNG And Max Size shuld be 100px X 100px , . Or Contact Administrator." ;
	            	$this->session->set_flashdata('error',$message);
	            	//redirect(base_url().'aevent');
				}
//--------Pic Upload Start---------			
			
//------End----------
			$daystatus=1;
			$status=$this->EventDaysModel->updateDayScheduleStatus($day_id,$daystatus);
			$this->updatEventPageIfAnyChangesApply($event_id);
			$message="Schedule Added Successfully with Id: ".$schd_id."." ;
            $this->session->set_flashdata('success',$message);
            redirect(base_url().'aevent');
		}else{
			$message="Unable To Create The Schedule. Contact Administrator." ;
            $this->session->set_flashdata('error',$message);
            redirect(base_url().'aevent');
		}
	}
	public function schedule_update(){
		$event_id=$this->input->post('upeventid');
		$schd_id=$this->input->post('upscheduleid');
		$day_id=$this->input->post('updateid');
		$title=$this->input->post('uptitle');
		$description=$this->input->post('updescription');
		$start_time=$this->input->post('upstarttime');
		$end_time=$this->input->post('upendtime');
		$speaker_id=$this->input->post('upeventspeakerid');
		$speaker_type=$this->input->post('upeventspeakertype');
		$checkphoto=$this->input->post('checkphoto');
		$status=False ;
		echo "$day_id ,$start_time ";
		$status=$this->EventScheduleModel->updateSchedule(
						$schd_id,
						$day_id,
						$event_id,
						$event_id
						$title,
						$description,
						$start_time,
						$end_time,
						$speaker_id,
						$speaker_type);
	if($status) {
		//--------Pic Upload Start---------	
		if($checkphoto==1){
			$picstatus=$this->uploadpicforschedule($schd_id);
				if ($picstatus) {
					$updateSchdImageNames=$this->EventScheduleModel->updateSchdImageNames($schd_id);
					$message="Schedule Updated Successfully" ;
	        		$this->session->set_flashdata('success',$message);
	        			redirect(base_url().'aevent'); 
				}
				else{
					//$picUplodaFailed=$this->EventScheduleModel->profileUplodaFailed($schd_id);
					$message=" Photo Not Uploadded <br> File Type Must be Png/PNG And Max Size shuld be 100px X 100px , . Or Contact Administrator." ;
	            	$this->session->set_flashdata('error',$message);
	            	redirect(base_url().'aevent');
				}
		    
		}
//------End----------
		//
		$this->updatEventPageIfAnyChangesApply($event_id);
		$message="Schedule Updated Successfully." ;
        $this->session->set_flashdata('success',$message);
    	redirect(base_url().'aevent');
	}else{
		$message="Unable To Update The Schedule. Contact Administrator." ;
		$this->session->set_flashdata('error',$message);
        redirect(base_url().'aevent');
	}
}

//----------------Upload Photo for Schedule----------------------
public function uploadpicforschedule($schd_id,$schdpic)
	{
		  $uploadStatus=false ;
		  $picuploadstatus=false ;
		  //Uploading schd pic
		  $status=false ;
	        $error="no error" ;
	        $config2['file_name']      = 'schedulepic-'.$schd_id;
	        $config2['upload_path']    = './uploads/eventdata/scheduleimage/';
	        $config2['allowed_types']  = 'PNG|png';
	        $config2['overwrite'] = TRUE;
	        $config2['max_size']       = 1000; //1MB
	        $config2['max_width']      = 100;
	        $config2['max_height']     = 100;

	        $this->upload->initialize($config2);

	        if ( ! $this->upload->do_upload($schdpic))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            //echo "Upload Failed" ;
	           // print_r($error) ;
	            $status=false ;
	        }
	        else
	        {
	            $data = array('upload_data' => $this->upload->data());
	            //echo "File Uploaded Successfully" ;
	            //echo $data ;
	            $status=true ;
	        }
	        return $status;
	        //echo print_r($error) ;
	}
public  function enableDisableSchedule($schd_id,$status)
{
$ustatus=$this->EventScheduleModel->updateScheduleStatus($schd_id,$status) ;
  if($ustatus){ 
    if($status==1){
      $this->session->set_flashdata('success','Schedule Enabled Successfully of schd id '.$schd_id);
    }else{
      $this->session->set_flashdata('success','Schedule Disabled Successfully of schd id '.$schd_id);
    }
  }else{
    if($status==1){
      $this->session->set_flashdata('error', 'Unable To Enable The Schedule. =>'.$schd_id.' Try Later!');
    }else{
      $this->session->set_flashdata('error', 'Unable To Disable The Schedule. =>'.$schd_id.' Try Later!');
    }
  }
  redirect(base_url().'aevent');
}



}












