<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class TrainerAccountModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
       
        $this->load->library('session'); 
        
    }

    
    public function getTrainerAccountByUserId($user_id){ 
          
        $this->db->where('user_id',$user_id);
        $query=$this->db->get('trainer_account_details');
        $result=$query->result();
        return $result;
    }
    
    

    public function insertTrainerAccount($bank_name,$branch,$account_number,$ifsc_code){

        $data = array(
            'user_id'=>$this->session->userdata("user_id"),
            'bank_name'=>$bank_name,
            'branch'=>$branch,
            'account_number '=>$account_number,
            'ifsc_code '=>$ifsc_code,
          
        );
      //  print_r($data);
       // die();
        $this->db->insert('trainer_account_details',$data);
        $btcid=$this->db->insert_id();
        return $btcid; 
    }

    public function updateTrainerAccount($bank_id,$bank_name,$branch,$account_number,$ifsc_code){
        $data = array(
            'user_id'=>$this->session->userdata("user_id"), 
            'bank_name'=>$bank_name,
            'branch'=>$branch,
            'account_number '=>$account_number,
            'ifsc_code '=>$ifsc_code,
        );

        $this->db->where('trainer_acc_id',$bank_id);
        $ustatus=$this->db->update('trainer_account_details', $data);
        return $ustatus; 
    } 

    public function getTrainerAaccountById($id){
        $data=array() ;
        $this->db->where('btc_id',$id) ;
        $query = $this->db->get('batches');
        $result=$query->result();
        foreach($result as $row){
            $data = array(
                'btc_id'=>$row->btc_id,
                'batch_id'=>$row->batch_id,
                'course_id'=>$row->course_id,
                'faculty_id'=>$row->faculty_id,
                'batch_days_id'=>$row->batch_days_id,
                'batch_name'=>$row->batch_name,
                'start_date'=>$row->start_date,
                'end_date'=>$row->end_date,
                'lecture_start_time'=>$row->lecture_start_time,
                'lecture_end_time'=>$row->lecture_end_time,
                'days_per_week'=>$row->days_per_week,
                'cr_id'=>$row->cr_id,
                'available_seats'=>$row->available_seats,
                'total_seats'=>$row->total_seats,
                'std_enrolled'=>$row->std_enrolled,
                'training_mode'=>$row->training_mode,
                'hours_per_day'=>$row->hours_per_day,
                'days_quantity'=>$row->days_quantity,
                'duration'=>$row->duration,
                'remark'=>$row->remark,
                'status'=>$row->status,
                'last_updated_on'=>$row->last_updated_on,
                'created_on'=>$row->created_on
            );
        }
        return $data ;
    }

   

}
?>