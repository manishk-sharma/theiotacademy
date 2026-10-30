<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class OtpModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
       
    }

    public function saveOTPtoDB($otp,$email){

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