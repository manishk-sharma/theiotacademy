<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class AppliedModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
        date_default_timezone_set('Asia/Kolkata');
    }

    public function DataScienceForm($data){
    	$this->db->set('created_at', 'NOW()', FALSE);
		$this->db->insert('datascience_registration', $data);
		$scienceid=$this->db->insert_id();
		return $scienceid;
	}
    public function DownloadBroucherForm($data)
    {
       $this->db->set('created_at', 'NOW()', FALSE);
        $this->db->insert('datascience_registration', $data);
        $download_id=$this->db->insert_id();
        return $download_id;
    }
	public function isEmailExistsAppliedDataScience($new_email_id){
        $count=0 ;
        $this->db->where('email',$new_email_id);
        $query = $this->db->get('datascience_registration');
        $result=$query->result();
        $count=count($result) ;
        if($count>0){
            return TRUE ;
        }else{
            return FALSE ;
        }
    }

}
?>