<?php 
ob_start(); 
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class TrainerEducationModel extends CI_Model { 

	public function __construct(){ 
		parent::__construct();
    //error_reporting(0);
    
    $this->load->library('session');

	}

 public function getEducationByEduId($id)
    { 
        
        $this->db->where('education_id',$id);
        $query=$this->db->get('trainer_education');
        $result=$query->result();
        return $result;
    }

    public function getEducationByUserId($user_id)
    { 
        
        $this->db->where('user_id',$user_id);
        $query=$this->db->get('trainer_education');
        $result=$query->result();
        return $result;
    }
    
    public function insertTrainerEducation($qualification,$collage_univercity,$passing_year){
        $education_id=0;
        $data=array(
            'user_id'=>$this->session->userdata("user_id"),
            'qualification'=>$qualification,
            'collage_univercity'=>$collage_univercity,
            'passing_year'=>$passing_year, 
        );
        $this->db->insert('trainer_education',$data);
        $education_id=$this->db->insert_id();
        return $education_id;
    }

    public function updateTrainerEducation($education_id,$qualification,$collage_univercity,$passing_year){
        $data=array(
            'user_id'=>$this->session->userdata("user_id"),
            'qualification'=>$qualification,
            'collage_univercity'=>$collage_univercity,
            'passing_year'=>$passing_year,
        );
        $this->db->where('education_id',$education_id);
         $ustatus=$this->db->update('trainer_education',$data);
         return $ustatus;
    }

    public function updateTrainerEducationFileName($education_id,$fileName){
        
        $data=array(
            'file_name'=>$fileName
        );

        $this->db->where('education_id',$education_id);
         $ustatus=$this->db->update('trainer_education',$data);
         return $ustatus;

    }


}
?>