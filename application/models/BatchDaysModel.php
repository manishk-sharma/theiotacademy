<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class BatchDaysModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        //$this->load->model('RegisterModel');
        $this->load->library('session'); 
        //$this->load->helper('url');
    }

    public function getBatchDaysList()
    {
        $query = $this->db->get('batches');
        return $query->result();
    }

    public function insertBatchDays($monday,$tuesday,$wednesday,$thrusday,$friday,$saturday,$sunday){
        $daysid=0 ;
        $data = array(
            'monday'=>$monday,
            'tuesday'=>$tuesday,
            'wednesday'=>$wednesday,
            'thrusday'=>$thrusday,
            'friday'=>$friday,
            'saturday'=>$saturday,
            'sunday'=>$sunday
        );
        $this->db->insert('batch_days', $data);
        $daysid=$this->db->insert_id();
        return $daysid; 
    }

    public function updateBatchDays($batch_days_id,$monday,$tuesday,$wednesday,$thrusday,$friday,$saturday,$sunday){
        $data = array(
            'monday'=>$monday,
            'tuesday'=>$tuesday,
            'wednesday'=>$wednesday,
            'thrusday'=>$thrusday,
            'friday'=>$friday,
            'saturday'=>$saturday,
            'sunday'=>$sunday
        );
        $this->db->where('days_id',$batch_days_id);
        $ustatus=$this->db->update('batch_days', $data);
        return $ustatus; 
    } 

    public function getBatchDaysTextById($id){
        $text='' ;
        $batchdays=$this->getBatchDaysById($id) ;
        if($batchdays['monday']==1){
            $text.="Monday," ;
        }
        if($batchdays['tuesday']==1){
            $text.=" Tuesday," ;
        }
        if($batchdays['wednesday']==1){
            $text.=" Wednesday," ;
        }
        if($batchdays['thrusday']==1){
            $text.=" Thrusday," ;
        }
        if($batchdays['friday']==1){
            $text.=" Friday," ;
        }
        if($batchdays['saturday']==1){
            $text.=" Saturday," ;
        }
        if($batchdays['sunday']==1){
            $text.=" Sunday," ;
        }
        return substr($text,0,-1) ;
    }

    public function getBatchDaysById($id){
        $data=array() ;
        $this->db->where('days_id',$id) ;
        $query = $this->db->get('batch_days');
        $result=$query->result();
        foreach($result as $row){
            $data = array(
                'days_id'=>$row->days_id,
                'monday'=>$row->monday,
                'tuesday'=>$row->tuesday,
                'wednesday'=>$row->wednesday,
                'thrusday'=>$row->thrusday,
                'friday'=>$row->friday,
                'saturday'=>$row->saturday,
                'sunday'=>$row->sunday,
                'last_updated_on'=>$row->last_updated_on,
                'created_on'=>$row->created_on
            );
        }
        return $data ;
    }

}
?>