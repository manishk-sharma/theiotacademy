<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SubjectAndMessageModel extends CI_Model{
    
    public function getSubMsgForSendEmail()
    {
      	$query = $this->db->query("SELECT * FROM subject_and_message ORDER BY sub_msg_id DESC LIMIT 1");
		$result = $query->result_array();

		$data=array();

		foreach ($result as $row) {

		$data=array(
				'subject'=>$row['subject'],
				'message'=>$row['message']
				);	
		}

		return $data;

    }

    
    public function insertData($subject,$message){

    	$data=array(
    		'subject'=>$subject,
    		'message'=>$message );

    	$insert = $this->db->insert('subject_and_message',$data);
    }

    public function truncateTable(){

        $status=$this->db->truncate('subject_and_message');

        return $status;
    }
    
}

?>