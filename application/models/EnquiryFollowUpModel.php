<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class EnquiryFollowUpModel extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
    }

    public function getEnquiryFollowUpList(){
        $query = $this->db->get('enquiry_followup');
        return $query->result();
    }

    public function getActiveEnquiryFollowUpList(){   
        $this->db->where('status',1) ;
        $query = $this->db->get('enquiry_followup');
        return $query->result();
    }

    public function checkForLastPendingFollowUpForEnquiry($enq_id) {
        $fup_id=0 ;
        $this->db->where('enq_id',$enq_id);
        $this->db->order_by('fup_date','desc') ;
        $query=$this->db->get('enquiry_followup');
        $result=$query->result() ;
        if($query->num_rows()>0){
            foreach($result as $row){
                if($row->fup_status==0){
                    $fup_id=$row->fup_id ;
                }
                break ;
            }
        }
        return $fup_id ;
    }

    public function checkUniqueFUPDateForEnquiry($enq_id,$fup_date) {
        $conditions=array('fup_date'=>$fup_date,'enq_id'=>$enq_id);
        $this->db->where($conditions);
        return $this->db->get('enquiry_followup')->num_rows();
    }

    public function checkUniqueFollowUpForEnquiryForUpdate($fup_id,$enq_id,$fup_date){
        $conditions=array('fup_date'=>$fup_date,'enq_id'=>$enq_id);
        $this->db->where($conditions);
        $this->db->where_not_in('fup_id', $fup_id);
        return $this->db->get('enquiry_followup')->num_rows();
    }

    public function getEnquiryFollowUpListByEnqId($id){
        $this->db->where('enq_id',$id) ;
        $query = $this->db->get('enquiry_followup');
        return $query->result();
    }

    public function getEnquiryFollowUpById($id){
        $data=array() ;
        $this->db->where('fup_id',$id) ;
        $query = $this->db->get('enquiry_followup');
        $result=$query->result();
        foreach($result as $row){
            $data=array(
                'fup_id'=> $row->fup_id,
                'enq_id'=> $row->enq_id,
                'fup_date'=> $row->fup_date,
                'fup_status'=> $row->fup_status,
                'remark'=> $row->remark,
                'status'=> $row->status,
                'last_updated_on'=> date('d-m-Y',strtotime($row->last_updated_on)),
                'created_on'=> date('d-m-Y',strtotime($row->created_on))
            );
        }
        return $data ;
    }

    public function insertEnquiryFollowUp($enq_id,$fup_date){
        $desigid=0 ;
        $data = array(
                    'enq_id'=>$enq_id,
                    'fup_date'=>$fup_date
                );
        $this->db->insert('enquiry_followup', $data);
        $fupid=$this->db->insert_id();
        return $fupid; 
    }

    public function updateEnquiryFollowUp($fup_id,$fup_date,$fup_status,$remark){
        $data = array(
                    'fup_date'=>$fup_date,
                    'fup_status'=>$fup_status,
                    'remark'=>$remark
                );
        $this->db->where('fup_id',$fup_id);
        $ustatus=$this->db->update('enquiry_followup',$data);
        return $ustatus; 
    }

    public function updateEnquiryFollowUpStatusAndRemark($fup_id,$remark){
        $data = array(
                    'fup_status'=>1,
                    'remark'=>$remark
                );
        $this->db->where('fup_id',$fup_id);
        $ustatus=$this->db->update('enquiry_followup',$data);
        return $ustatus; 
    }

    public function updatePendingEnquiryFollowUpByEnqId($fup_id,$new_fup_date){
        $remark="Follow Up Required On ".date('d-m-Y',strtotime($new_fup_date)) ;
        $data = array('fup_status'=>1,'remark'=>$remark);
        $this->db->where('fup_id',$fup_id);
        $ustatus=$this->db->update('enquiry_followup',$data);
        return $ustatus; 
    }

    public function updateEnquiryFollowUpFUPStatus($fup_id,$fup_status){
        $data = array('fup_status'=>$fup_status);
        $this->db->where('fup_id',$fup_id);
        $ustatus=$this->db->update('enquiry_followup',$data);
        return $ustatus; 
    }
}
?>