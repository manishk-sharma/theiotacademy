<?php
ob_start(); 
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class TrainerCertificationModel extends CI_Model { 

	public function __construct(){ 
		parent::__construct();
    //error_reporting(0);
    $this->load->library('session');
	}

public function getCertificateByUserId($user_id)
    { 
        
        $this->db->where('user_id',$user_id);
        $query=$this->db->get('trainer_certification');
        $result=$query->result();
        return $result;
    }

    public function getCertificateBycertificateId($id)
    { 
        
        $this->db->where('certificate_id',$id);
        $query=$this->db->get('trainer_certification');
        $result=$query->result();
        return $result;
    }
    
    public function insertTrainerCertificate($course,$institute,$course_duration){
        $certificate_id=0;
        $data=array(
            'user_id'=>$this->session->userdata("user_id"),
            'course'=>$course,
            'institute'=>$institute,
            'course_duration'=>$course_duration
        );
        $this->db->insert('trainer_certification',$data);
        $certificate_id=$this->db->insert_id();
        return $certificate_id;
    }

    public function updateTrainerCertificate($certificate_id,$course,$institute,$course_duration){
        $data=array(
            'user_id'=>$this->session->userdata("user_id"),
            'course'=>$course,
            'institute'=>$institute,
            'course_duration'=>$course_duration
        );
        $this->db->where('certificate_id',$certificate_id);
         $ustatus=$this->db->update('trainer_certification',$data);
         return $ustatus;
    }


    public function updateCertificateFileName($certificate_id,$fileName){
        
        $data=array(
            'file_name'=>$fileName
        );

        $this->db->where('certificate_id',$certificate_id);
         $ustatus=$this->db->update('trainer_certification',$data);
         return $ustatus;

    }


}
?>