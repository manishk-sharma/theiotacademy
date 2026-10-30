<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class TrainerExperienceModel extends CI_Model { 

	  public function __construct(){ 
    parent::__construct();
    //error_reporting(0);
     $this->load->library('session');
  }

 
    public function getExperienceByUserId($user_id)
    { 
        
        $this->db->where('user_id',$user_id);
        $query=$this->db->get('trainer_experience_details');
        $result=$query->result();
        return $result;
    }

    public function getExperienceByExpId($id)
    { 
        
        $this->db->where('exp_id',$id);
        $query=$this->db->get('trainer_experience_details');
        $result=$query->result();
        return $result;
    }
    
    public function insertTrainerExperience($company,$designation,$start_date,$end_date,$still_working){
        $exp_id=0;
        $data=array(
            'user_id'=>$this->session->userdata("user_id"),
            'company'=>$company,
            'designation'=>$designation,
            'start_date'=>$start_date,
            'end_date'=>$end_date,
            'still_working'=>$still_working,
        );
        $this->db->insert('trainer_experience_details',$data);
        $exp_id=$this->db->insert_id();
        return $exp_id;
    }

    public function updateTrainerExperience($experience_id,$company,$designation,$start_date,$end_date,$still_working){
        $data=array(
            'user_id'=>$this->session->userdata("user_id"),
            'company'=>$company,
            'designation'=>$designation,
            'start_date'=>$start_date,
            'end_date'=>$end_date,
            'still_working'=>$still_working,
        );
        $this->db->where('experience_id',$experience_id);
         $ustatus=$this->db->update('trainer_experience_details',$data);
         return $ustatus;
    }


    public function updateExperienceCertfFileName($experience_id,$fileName){
        
        $data=array(
            'file_name'=>$fileName
        );

        $this->db->where('experience_id',$experience_id);
         $ustatus=$this->db->update('trainer_experience_details',$data);
         return $ustatus;

    }


}
?>