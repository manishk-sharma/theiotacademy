<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class BatchModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        //$this->load->model('RegisterModel');
        $this->load->library('session'); 
        //$this->load->helper('url');
    }

    public function getBatchList()
    {
        $query = $this->db->get('batches');
        return $query->result();
    }

    public function getBatchNameById($btc_id)
    {
        
        $this->db->where('status',1);

        $this->db->where('btc_id',$btc_id);

        $query = $this->db->get('batches');

        $result=$query->result();

        foreach ($result as $row) {

            return $row->batch_name.' (Batch Id:'.$btc_id.')';
        }
    }
    
    public function getActiveBatchList()
    {
        $this->db->where('status',1);

        $this->db->order_by('created_on','desc') ;
        
        $query = $this->db->get('batches');

        $result=$query->result();

        $BatchData=array();

        foreach ($result as $row) {

            $data=array(
                'batch_id'=>$row->btc_id,
                'batch_title'=>$row->batch_name.'('.$row->batch_id.')',
                );
            array_push($BatchData,$data);

        }
        return $BatchData; 
    }

    public function checkUniqueBatchNameForUpdate($btc_id = '', $batch_name) {
        $this->db->where('batch_name', $batch_name);
        if($btc_id) {
            $this->db->where_not_in('btc_id', $btc_id);
        }
        return $this->db->get('batches')->num_rows();
    }

    public function isBatchExists($cr_id,$start_date,$end_date,$lecture_start_time,$lecture_end_time,$monday,$tuesday,$wednesday,$thrusday,$friday,$saturday,$sunday){
        $batch_days_id=0 ;
        $this->db->where('cr_id', $cr_id);
        $this->db->where('start_date BETWEEN CAST("'.$start_date.'" AS DATE) and CAST("'.$end_date.'" AS DATE)');
        $this->db->where('end_date BETWEEN CAST("'.$start_date.'" AS DATE) and CAST("'.$end_date.'" AS DATE)');
        $this->db->where('lecture_start_time BETWEEN CONVERT("'.$lecture_start_time.'",TIME) and CONVERT("'.$lecture_end_time.'",TIME)');
        $this->db->where('lecture_end_time BETWEEN CONVERT("'.$lecture_start_time.'",TIME) and CONVERT("'.$lecture_end_time.'",TIME)');
        $query=$this->db->get('batches');
        $result=$query->result() ;
        $rowcount=count($result) ;
        if($rowcount>0){
            $dayscheck=0 ;
            foreach($result as $row){
                $batch_days_id=$row->batch_days_id ;
            }
            $batchdays=$this->BatchDaysModel->getBatchDaysById($batch_days_id) ;
             if($batchdays['monday']==$monday &&
                $batchdays['tuesday']==$tuesday &&
                $batchdays['wednesday']==$wednesday &&
                $batchdays['thrusday']==$thrusday &&
                $batchdays['friday']==$friday &&
                $batchdays['saturday']==$saturday &&
                $batchdays['sunday']==$sunday){
                    return TRUE ;
             }else{
                return FALSE ;
             }
        }else{
            return FALSE ;
        }

    }

    //Function To Check If Registration-Batch Mapping Already Exists in batch_reg Table.
    public function isRegAlreadyInBatch($btc_id,$reg_id){
        $status=FALSE ;
        $conditions=array('btc_id'=>$btc_id,'reg_id'=>$reg_id) ;
        $this->db->where($conditions) ;
        $query = $this->db->get('batch_reg');
        $result=$query->result();
        if(count($result)>0){
            $status=TRUE ;
        }
        return $status ;
    }

    public function getRegListByBatchId($btc_id){
        $reg_id_list=array() ;
        $conditions=array('btc_id'=>$btc_id) ;
        $this->db->where($conditions) ;
        $query = $this->db->get('batch_reg');
        $result=$query->result();
        foreach($result as $row){
            array_push($reg_id_list,$row->reg_id);
        }
        $reglist=$this->RegisterModel->getRegListByRegIdList($reg_id_list);
        return $reglist ;
    }

    //Function To Insert Batch-Registration Mapping To batch_reg Table.
    public function insertRegToBatch($btc_id,$reg_id){
        $brid=0 ;
        $data = array(
            'btc_id'=>$btc_id,
            'reg_id'=>$reg_id
        );
        $this->db->insert('batch_reg', $data);
        $brid=$this->db->insert_id();
        return $brid; 
    }

    public function updateStudentsEnrolled($btc_id,$available_seats,$std_enrolled){
        $data = array(
            'available_seats'=>$available_seats,
            'std_enrolled'=>$std_enrolled
        );

        $this->db->where('btc_id',$btc_id);
        $ustatus=$this->db->update('batches', $data);
        return $ustatus; 
    } 

    public function insertBatch($course_id,$faculty_id,$batch_name,$start_date,$end_date,$lecture_start_time,$lecture_end_time,$days_per_week,$batch_days_id,$cr_id,$available_seats,$total_seats,$std_enrolled,$training_mode,$days_quantity,$hours_per_day,$duration,$remark){

        $data = array(
            'course_id'=>$course_id,
            'faculty_id'=>$faculty_id,
            'batch_name'=>$batch_name,
            'start_date'=>$start_date,
            'end_date'=>$end_date,
            'lecture_start_time'=>$lecture_start_time,
            'lecture_end_time'=>$lecture_end_time,
            'days_per_week'=>$days_per_week,
            'batch_days_id'=>$batch_days_id,
            'cr_id'=>$cr_id,
            'available_seats'=>$available_seats,
            'total_seats'=>$total_seats,
            'std_enrolled'=>$std_enrolled,
            'training_mode'=>$training_mode,
            'days_quantity'=>$days_quantity,
            'hours_per_day'=>$hours_per_day,
            'duration'=>$duration,
            'remark'=>$remark
        );
        $this->db->insert('batches', $data);
        $btcid=$this->db->insert_id();
        return $btcid; 
    }

    public function updateBatch($btc_id,$course_id,$faculty_id,$batch_name,$start_date,$end_date,$lecture_start_time,$lecture_end_time,$days_per_week,$batch_days_id,$cr_id,$available_seats,$total_seats,$std_enrolled,$training_mode,$days_quantity,$hours_per_day,$duration,$remark){
        $data = array(
            'course_id'=>$course_id,
            'faculty_id'=>$faculty_id,
            'batch_name'=>$batch_name,
            'start_date'=>$start_date,
            'end_date'=>$end_date,
            'lecture_start_time'=>$lecture_start_time,
            'lecture_end_time'=>$lecture_end_time,
            'days_per_week'=>$days_per_week,
            'cr_id'=>$cr_id,
            'available_seats'=>$available_seats,
            'total_seats'=>$total_seats,
            'std_enrolled'=>$std_enrolled,
            'training_mode'=>$training_mode,
            'hours_per_day'=>$hours_per_day,
            'days_quantity'=>$days_quantity,
            'duration'=>$duration,
            'remark'=>$remark
        );

        $this->db->where('btc_id',$btc_id);
        $ustatus=$this->db->update('batches', $data);
        return $ustatus; 
    } 

    public function getBatchById($id){
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

    public function updateBatchId($btc_id){
    	$batch_id=$this->getBatchIdString($btc_id) ;
        $data=array('batch_id'=>$batch_id);
        $this->db->where('btc_id',$btc_id);
        $ustatus=$this->db->update('batches',$data);
        if($ustatus==1){
        	return $batch_id ;
        }else{
        	return $ustatus ;
        }
    }

    public function getBatchIdString($id){
		$req_id_len=5 ;  //required id length
		$actual_id_len=strlen($id) ; //length of enq_id
		$len_diff=$req_id_len-$actual_id_len ;
		$req_id='' ;
		for($i=0; $i<$len_diff; $i++){
			$req_id.='0' ;
		}
		$batch_id="B".$req_id.$id ;
		return $batch_id ;
	}


    public function updateBatchStatus($btc_id,$status){
        
        $data = array('status'=>$status);
        
        $this->db->where('btc_id',$btc_id);
        $this->db->set('last_updated_on', 'NOW()', FALSE);
        $ustatus=$this->db->update('batches',$data);
        
        return $ustatus; 
    }

}
?>