<?php
ob_start(); 
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class TrainerDetailsModel extends CI_Model { 

    public function __construct(){ 
        parent::__construct();
    //error_reporting(0);
     $this->load->library('session');
    }

  public function getTrainerList()
    { 
        $query = $this->db->get('trainer_details');
        return $query->result();
    }
    public function getTrainerByUserId($user_id)
    { 
        
        $this->db->where('user_id',$user_id);
        $query=$this->db->get('trainer_details');
        $result=$query->result_array();
        return $result;
    }
    public function getTrainerTitleById($id)
    {   
        $data=array() ;
        $this->db->where('trainer_id',$id);
        $query=$this->db->get('trainer_details');
        $result=$query->result();
        foreach ($result as $row) {
           $data=array(
            'location_title'=>$row->location_title,
            'house_no'=>$row->house_no,
            'area'=>$row->area,
            'city'=>$row->city,
            'district'=>$row->district,
            'state'=>$row->state,
            'pin_code'=>$row->pin_code,
            'map_link'=>$row->map_link,
            'country'=>$row->country
           );
        }
        return $data;
    }
    
    public function getActiveTrainerList() 
    {   $this->db->where('status',1) ;
        //$this->db->order_by('created_on,desc');
        $query = $this->db->get('trainer_details');
        return $query->result();
    }

    public function getTrainerFirstNameByUserId($id){
        $first_name="nil" ;
        $this->db->where('user_id',$id);
        $query = $this->db->get('trainer_details');
        $result=$query->result();
        foreach($result as $row){
          $first_name=$row->first_name ;
        }
        return $first_name ;
    }

    public function insertTrainer($first_name,$last_name,$birth_date,$gender,$course_id){
        $trainer_id=0;
        $data=array(
            'user_id'=>$this->session->userdata("user_id"),
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'birth_date'=>$birth_date,
            'gender'=>$gender,
            'course_id'=>$course_id,
            
        );
        $this->db->insert('trainer_details',$data);
        $trainer_id=$this->db->insert_id();
        return $trainer_id;
    }

    public function updateTrainer($trainer_id,$first_name,$last_name,$birth_date,$gender,$course_id){
        $ustatus=false;
        $data=array(
            'user_id'=>$this->session->userdata("user_id"),
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'birth_date'=>$birth_date,
            'gender'=>$gender,
            'course_id'=>$course_id,
           
        );
        $this->db->where('trainer_id',$trainer_id);
         $ustatus=$this->db->update('trainer_details',$data);
         if($ustatus){
             return $trainer_id;
         }
          return $ustatus;
        
    }

    public function updateTrainerStatus($trainer_id,$status){
        $data = array('status'=>$status);
        $this->db->where('trainer_id',$trainer_id);
        $ustatus=$this->db->update('trainer_details',$data);
        return $ustatus; 
    }


    public function updateTrainerProfile($trainer_id,$profileName){
        $data = array('photo'=>$profileName);
        $this->db->where('trainer_id',$trainer_id);
        $ustatus=$this->db->update('trainer_details',$data);
        return $ustatus; 
    }

}
?>