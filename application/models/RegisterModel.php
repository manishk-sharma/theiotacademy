<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class RegisterModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
        $this->load->model('CourseModel') ;
        //$this->load->helper('url');
    }

    public function getRegistrationList()
    {
        $query = $this->db->get('registrations');
        return $query->result();
    }

    public function checkUniqueRegistrationForUpdate($reg_id = '', $course_id,$std_id) {
        $conditions=array('course_id'=>$course_id,'std_id'=>$std_id);
        $this->db->where($conditions);
        if($reg_id) {
            $this->db->where_not_in('reg_id', $reg_id);
        }
        return $this->db->get('registrations')->num_rows();
    }

    public function getBalanceFeeByRegId($id){
        $data=array() ;
        $this->db->where('reg_id',$id) ;
        $query = $this->db->get('registrations');
        $result=$query->result();
        foreach($result as $row){
            $data=array(
                'reg_id'=> $row->reg_id,
                'paid_fee'=> $row->paid_fee,
                'balance_fee'=> $row->balance_fee,
                'total_fee'=> $row->total_fee
            );
        }
        return $data ;
    }

    public function updateBalancePaidFeeByRegId($reg_id,$paid_fee,$balance_fee){
        $data=array(
                'paid_fee'=> $row->paid_fee,
                'balance_fee'=> $row->balance_fee
        );
        
        $this->db->where('reg_id',$reg_id);
        $ustatus=$this->db->update('registrations',$data);
        return $ustatus; 
    }

    public function insertRegistration($std_id,$course_id,$course_fee,$discount_amount,$total_fee,$admission_date,$course_start_date,$training_mode){
        $data = array(
            'std_id'=>$std_id,
            'course_id'=>$course_id,
            'course_fee'=>$course_fee,
            'discount_amount'=>$discount_amount,
            'total_fee'=>$total_fee,
            'balance_fee'=>$total_fee,
            'admission_date'=>$admission_date,
            'course_start_date'=>$course_start_date,
            'training_mode'=>$training_mode
        );
        $this->db->insert('registrations', $data);
        $regid=$this->db->insert_id();
        return $regid; 
    } 

    public function updateRegistration($reg_id,$course_id,$course_fee,$discount_amount,$total_fee,$admission_date,$course_start_date,$training_mode){
        $data = array(
            'course_id'=>$course_id,
            'course_fee'=>$course_fee,
            'discount_amount'=>$discount_amount,
            'total_fee'=>$total_fee,
            'balance_fee'=>$total_fee,
            'admission_date'=>$admission_date,
            'course_start_date'=>$course_start_date,
            'training_mode'=>$training_mode
        );
        $this->db->where('reg_id',$reg_id);
        $ustatus=$this->db->update('registrations',$data);
        return $ustatus; 
    }

    public function isStudentCourseRegisterExists($std_id,$course_id){
        $count=0 ;
        $conditions=array('std_id'=>$std_id,'course_id'=>$course_id) ;
        $this->db->where($conditions) ;
        $query = $this->db->get('registrations');
        $count=count($query->result()) ;
        if($count>0){
            return TRUE ;
        }else{
            return FALSE ;
        }
    }

    public function getRegisterInfoByStdId($id){
        $this->db->where('std_id',$id) ;
        $this->db->order_by('reg_id','desc') ;
        $query = $this->db->get('registrations');
        return $query->result() ;
    }

    public function getRegListByRegIdList($reg_id_list){
        $result=array();
        if(count($reg_id_list)>0){
            $this->db->where_in('reg_id',$reg_id_list) ;
            $query = $this->db->get('registrations');
            $result=$query->result() ;
        }
        return $result ;
    }

    public function getRegistrationById($id){
        $data=array() ;
        $this->db->where('reg_id',$id) ;
        $query = $this->db->get('registrations');
        $result=$query->result();
        foreach($result as $row){
            $data=array(
                'reg_id'=>$row->reg_id,
                'registration_id'=>$row->registration_id,
                'std_id'=>$row->std_id,
                'course_id'=>$row->course_id,
                'course_fee'=>$row->course_fee,
                'discount_amount'=>$row->discount_amount,
                'total_fee'=>$row->total_fee,
                'paid_fee'=>$row->paid_fee,
                'balance_fee'=>$row->balance_fee,
                'admission_date'=>$row->admission_date,
                'course_start_date'=>$row->course_start_date,
                'training_mode'=>$row->training_mode,
                'status'=>$row->status,
                'last_updated_on'=> date('d-m-Y',strtotime($row->last_updated_on)),
                'created_on'=> date('d-m-Y',strtotime($row->created_on))
            );
        }
        return $data ;
    }

    public function updateRegistrationId($reg_id){
    	$registration_id=$this->getRegisterIdString($reg_id) ;
        $data=array('registration_id'=>$registration_id);
        $this->db->where('reg_id',$reg_id);
        $ustatus=$this->db->update('registrations',$data);
        if($ustatus==1){
        	return $registration_id ;
        }else{
        	return $ustatus ;
        }
    }

    public function getRegisterIdString($id){
		$req_id_len=5 ;  //required id length
		$actual_id_len=strlen($id) ; //length of enq_id
		$len_diff=$req_id_len-$actual_id_len ;
		$req_id='' ;
		for($i=0; $i<$len_diff; $i++){
			$req_id.='0' ;
		}
		$registration_id="R".$req_id.$id ;
		return $registration_id ;
	}

    public function randomString($size){
      $alphabet = 'abdefgqrtABCDEFGHJKMNPQRSTUVWXYZ23456789';
      $password = array(); 
      $alpha_length = strlen($alphabet) - 1; 
      for ($i = 0; $i < $size; $i++) 
      {
          $n = rand(0, $alpha_length);
          $password[] = $alphabet[$n];
      }
      return implode($password); 
    }

}
?>