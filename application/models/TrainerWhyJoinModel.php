<?php
ob_start(); 
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class TrainerWhyJoinModel extends CI_Model { 

  public function __construct(){ 
    parent::__construct();
    //error_reporting(0);
    $this->load->library('session');
  }

 
    public function getWhyJoinByUserId($user_id){ 
          
        $this->db->where('user_id',$user_id);
        $query=$this->db->get('trainer_why_join');
        $result=$query->result();
        return $result;
    }
  
    
   
    public function insertTrainerWhyJoin($why_join){
      //  $trainer_id=0;
        $data=array(
            'user_id'=>$this->session->userdata("user_id"),
            'why_join'=>$why_join,
            
        );
        $this->db->insert('trainer_why_join',$data);
        $why_join_id=$this->db->insert_id();
        return $why_join_id;
    }

    public function updateTrainerWhyJoin($why_you_join_id,$why_join){
        $data=array(
            'user_id'=>$this->session->userdata("user_id"),
            'why_join_id'=>$why_you_join_id,
            'why_join'=>$why_join,
           );
        $this->db->where('why_join_id',$why_you_join_id);
         $ustatus=$this->db->update('trainer_why_join',$data);
         return $ustatus;
    }

}
?>