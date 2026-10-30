<?php
ob_start(); 
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class TrainerAboutYouModel extends CI_Model { 

  public function __construct(){ 
    parent::__construct();
    //error_reporting(0);
    $this->load->library('session');
  }

 

    public function getAboutYouByUserId($user_id){ 
          
        $this->db->where('user_id',$user_id);
        $query=$this->db->get('trainer_about_you');
        $result=$query->result();
        return $result;
    }
    
   
    public function insertTrainerAboutYou($about_you){
      //  $trainer_id=0;
        $data=array(
            'user_id'=>$this->session->userdata("user_id"),
            'about_you'=>$about_you,
            
        );
        $this->db->insert('trainer_about_you',$data);
        $about_you_id=$this->db->insert_id();
        return $about_you_id;
    }

    public function updateTrainerAboutYou($aboutYou_id,$about_you){
        $data=array(
            'user_id'=>$this->session->userdata("user_id"),
            'about_you'=>$about_you,
           
        );
        $this->db->where('about_you_id',$aboutYou_id);
         $ustatus=$this->db->update('trainer_about_you',$data);
         return $ustatus;
    }

}
?>