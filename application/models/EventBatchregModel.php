<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class EventBatchregModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        //$this->load->model('RegisterModel');
        $this->load->library('session'); 
        //$this->load->helper('url');
    }

    public function register_event_batch($event_batch_id,$fullname,$email_id,$mobile_no){
        $data = array(
            'event_batch_id'=>$event_batch_id,
            'name'=>$fullname,
            'email_id'=>$email_id,
            'mobile_no'=>$mobile_no,
        );
        $this->db->insert('event_reg', $data);
        $reg_id=$this->db->insert_id();
        return $reg_id;
    }

    public function saveOTP($otp,$email){

        $data = array(
            'otp'=>$otp,
            'email_id'=>$email

        );

        $this->db->insert('otp_details',$data);

        $otpid=$this->db->insert_id();

        return $otpid;
    }


    

}
?>