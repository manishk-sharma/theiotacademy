<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class EnquiryModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
        //$this->load->helper('url');
    }

    public function getEnquiryList()
    {
        $query = $this->db->get('enquiry');
        return $query->result();
    }

    public function insertEnquiry($fname,$lname,$gender,$email_id,$mobile_no,$course_id,$source_id,$message){
        $data = array(
            'first_name'=>$fname,
            'last_name'=>$lname,
            'gender'=>$gender,
            'email_id'=>$email_id,
            'mobile_no'=>$mobile_no,
            'course_id'=>$course_id,
            'source_id'=>$source_id,
            'message'=>$message
        );
        $this->db->insert('enquiry', $data);
        $enqid=$this->db->insert_id();
        return $enqid; 
    } 

    public function updateEnquiry($enq_id,$fname,$lname,$gender,$email_id,$mobile_no,$course_id,$source_id,$message){
        $data = array(
            'first_name'=>$fname,
            'last_name'=>$lname,
            'gender'=>$gender,
            'email_id'=>$email_id,
            'mobile_no'=>$mobile_no,
            'course_id'=>$course_id,
            'source_id'=>$source_id,
            'message'=>$message
        );
        $this->db->where('enq_id',$enq_id);
        $ustatus=$this->db->update('enquiry', $data);
        return $ustatus; 
    } 

    public function getEnquiryById($id){
        $data=array() ;
        $this->db->where('enq_id',$id) ;
        $query = $this->db->get('enquiry');
        $result=$query->result();
        foreach($result as $row){
            $data=array(
                'enq_id'=> $row->enq_id,
                'enquiry_id'=> $row->enquiry_id,
                'first_name'=> $row->first_name,
                'last_name'=> $row->last_name,
                'gender'=> $row->gender,
                'email_id'=> $row->email_id,
                'mobile_no'=> $row->mobile_no,
                'course_id'=> $row->course_id,
                'source_id'=> $row->source_id,
                'message'=> $row->message,
                'reg_status'=>$row->reg_status,
                'created_on'=> date('d-m-Y',strtotime($row->created_on))
            );
        }
        return $data ;
    }

    public function updateRegStatus($enq_id,$reg_status){
        $data=array('reg_status'=>$reg_status);
        $this->db->where('enq_id',$enq_id);
        $ustatus=$this->db->update('enquiry',$data);
        return $ustatus ;
    }

    public function updateEnquiryId($enq_id){
    	$enquiry_id=$this->getEnquiryIdString($enq_id) ;
        $data=array('enquiry_id'=>$enquiry_id);
        $this->db->where('enq_id',$enq_id);
        $ustatus=$this->db->update('enquiry',$data);
        if($ustatus==1){
        	return $enquiry_id ;
        }else{
        	return $ustatus ;
        }
    }

    public function getEnquiryIdString($id){
		$req_id_len=5 ;  //required id length
		$actual_id_len=strlen($id) ; //length of enq_id
		$len_diff=$req_id_len-$actual_id_len ;
		$req_id='' ;
		for($i=0; $i<$len_diff; $i++){
			$req_id.='0' ;
		}
		$enquiry_id="E".$req_id.$id ;
		return $enquiry_id ;
	}

}
?>