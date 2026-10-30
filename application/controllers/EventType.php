<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class EventType extends CI_Controller {

    public function __construct(){
        parent::__construct();
        error_reporting(0); 
        $this->load->helper('utility_helper');
        $this->load->library('form_validation');
        $this->load->model('EventTypeModel');
        $this->load->model('EmployeeModel');
        $this->load->model('UserTypeModel');
        $this->load->library('session'); 
        $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
        
    }
    public function index(){    
        $this->load->view('admin/eventtype/eventtypemanage');
    }
    //---------------------add event type--------------

    public function insertEventType(){
            $eventtypeerrmsg=array(
                                'required'=>'Event Type cannot be Empty,'
                                );
            $this->form_validation->set_rules('title','Title','required',$eventtypeerrmsg);
            if ($this->form_validation->run()) {
            $event_type_id=0 ; 
            $title=$this->input->post('title');

            //Insert Event type
            $event_type_id=$this->EventTypeModel->insertEventType($title) ;
                
            if($event_type_id>0){
                $message="Event Type Created Successfully with Id: ".$event_type_id ;
                    $this->session->set_flashdata('success',$message);
                    redirect(base_url().'aeventtype'); 
            }else{
                $message="Unable To Create The Event Type. Contact Administrator." ;
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'aeventtype');
            }
            }else{
                $this->session->set_flashdata('error',validation_errors());
                redirect(base_url().'aeventtype');
            }



    } 
    //----------------update event type------------------
    public function updateEventType(){
        $eventtypeerrmsg=array('required'=>'Event Type cannot be Empty,');
            $this->form_validation->set_rules('uptypetitle','Title','required',$eventtypeerrmsg);
            if ($this->form_validation->run()) {


        $type_id=$this->input->post("uptypeid") ;
        $type_title=$this->input->post("uptypetitle") ;
        $status=False ;
        $status=$this->EventTypeModel->updateEventType($type_id,$type_title) ;
        if($status){
            $message="Event Type Updated Successfully." ;
            $this->session->set_flashdata('success',$message);
            redirect(base_url().'aeventtype'); 
        }
        else{
            $message="Unable To Update The Event Type. Contact Administrator." ;
            $this->session->set_flashdata('error',$message);
            redirect(base_url().'aeventtype');
        }
    }else{
                $this->session->set_flashdata('error',validation_errors());
                redirect(base_url().'aeventtype');
            }

}
public function EnableDisableEventType($event_type_id,$status)
{
  $ustatus=$this->EventTypeModel->updateEventTypeStatus($event_type_id,$status);
    if ($ustatus) {
        if($status==1){
          $this->session->set_flashdata('success', 'Event Type Enabled Successfully.');
        }else{
          $this->session->set_flashdata('success', 'Event Type Disabled Successfully.');
        } 
        redirect(base_url().'aeventtype');
    }
    else{
        if($status==0){
          $this->session->set_flashdata('error', 'Unable To Enable The Event Type. Try Later!');
        }else{
          $this->session->set_flashdata('error', 'Unable To Disable The Event Type. Try Later!');
        }
        redirect(base_url().'aeventtype');
    }
}

    

}