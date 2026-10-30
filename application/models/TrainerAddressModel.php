<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');  
 
class TrainerAddressModel extends CI_Model {

  public function __construct(){
    parent::__construct();
    //error_reporting(0);
    $this->load->library('session');
  }

  public function getTrainerAddressList()
    {
        $query = $this->db->get('trainer_communication');
        return $query->result();
    }


    public function getTrainerAddressByUserId($user_id)
    {
        $this->db->where('user_id',$user_id);
        $query=$this->db->get('trainer_communication');
        $result=$query->result_array();
        return $result;
    }
   
   
    public function insertTrainerAddress($address,$address_city,$address_state,$address_country,$address_postal_code,$telephone,$mobile_phone,$email){
      //  $trainer_id=0;
        $data=array(
            'user_id'=>$this->session->userdata("user_id"),
            'address'=>$address,
            'city'=>$address_city,
            'state'=>$address_state,
           
            'country'=>$address_country,
            'postal_code'=>$address_postal_code,
            'telephone'=>$telephone,
            'mobile'=>$mobile_phone,
            'email'=>$email,
        );
        $this->db->insert('trainer_communication',$data);
        $communication_id=$this->db->insert_id();
        return $communication_id;
    }

    public function updateTrainerAddress($communication_id,$address,$address_city,$address_state,$address_country,$address_postal_code,$telephone,$mobile_phone,$email){
        $data=array(
            'user_id'=>$this->session->userdata("user_id"),
            
            'address'=>$address,
            'city'=>$address_city,
            'state'=>$address_state,
           
            'country'=>$address_country,
            'postal_code'=>$address_postal_code,
            'telephone'=>$telephone,
            'mobile'=>$mobile_phone,
            'email'=>$email,
        );
        $this->db->where('communication_id',$communication_id);
         $ustatus=$this->db->update('trainer_communication',$data);
         return $ustatus;
    }

}
?>