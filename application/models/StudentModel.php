<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class StudentModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('RegisterModel');
        $this->load->library('session'); 
        //$this->load->helper('url');
    }

    public function getStudentList()
    {
        $query = $this->db->get('students');
        return $query->result();
    }

    public function insertStudent($fname,$lname,$gender,$birth_date,$mobile_no,$user_id,$user_type_id){
        $data = array(
            'first_name'=>$fname,
            'last_name'=>$lname,
            'gender'=>$gender,
            'birth_date'=>$birth_date,
            'mobile_no'=>$mobile_no,
            'user_id'=>$user_id
        );
        $this->db->insert('students', $data);
        $stdid=$this->db->insert_id();
        return $stdid; 
    }

    public function updateStudent($std_id,$fname,$lname,$gender,$mobile_no,$guardian_label,$guardian_name,$birth_date){
        $data = array(
            'first_name'=>$fname,
            'last_name'=>$lname,
            'gender'=>$gender,
            'mobile_no'=>$mobile_no,
            'guardian_label'=>$guardian_label,
            'guardian_name'=>$guardian_name,
            'birth_date'=>$birth_date
        );
        $this->db->where('std_id',$std_id);
        $ustatus=$this->db->update('students', $data);
        return $ustatus; 
    } 

    public function getStudentById($id){
        $data=array() ;
        $this->db->where('std_id',$id) ;
        $query = $this->db->get('students');
        $result=$query->result();
        foreach($result as $row){
            $data=array(
                'std_id'=> $row->std_id,
                'student_id'=> $row->student_id,
                'user_id'=>$row->user_id,
                'first_name'=> $row->first_name,
                'last_name'=> $row->last_name,
                'gender'=> $row->gender,
                'birth_date'=> $row->birth_date,
                'mobile_no'=> $row->mobile_no,
                'guardian_label'=> $row->guardian_label,
                'guardian_name'=> $row->guardian_name,
                'photo_file'=>$row->photo_file,
                'status'=>$row->status,
                'last_updated_on'=> date('d-m-Y',strtotime($row->last_updated_on)),
                'created_on'=> date('d-m-Y',strtotime($row->created_on))
            );
        }
        return $data ;
    }

    public function getStudentByUserId($id){
        $data=array() ;
        $this->db->where('user_id',$id) ;
        $query = $this->db->get('students');
        $result=$query->result();
        foreach($result as $row){
            $data=array(
                'std_id'=> $row->std_id,
                'student_id'=> $row->student_id,
                'user_id'=>$row->user_id,
                'first_name'=> $row->first_name,
                'last_name'=> $row->last_name,
                'gender'=> $row->gender,
                'birth_date'=> $row->birth_date,
                'mobile_no'=> $row->mobile_no,
                'guardian_label'=> $row->guardian_label,
                'guardian_name'=> $row->guardian_name,
                'photo_file'=>$row->photo_file,
                'status'=>$row->status,
                'last_updated_on'=> date('d-m-Y',strtotime($row->last_updated_on)),
                'created_on'=> date('d-m-Y',strtotime($row->created_on))
            );
        }
        return $data ;
    }

    public function updateStudentId($std_id){
    	$student_id=$this->getStudentIdString($std_id) ;
        $data=array('student_id'=>$student_id);
        $this->db->where('std_id',$std_id);
        $ustatus=$this->db->update('students',$data);
        if($ustatus==1){
        	return $student_id ;
        }else{
        	return $ustatus ;
        }
    }

    public function getStudentIdString($id){
		$req_id_len=5 ;  //required id length
		$actual_id_len=strlen($id) ; //length of enq_id
		$len_diff=$req_id_len-$actual_id_len ;
		$req_id='' ;
		for($i=0; $i<$len_diff; $i++){
			$req_id.='0' ;
		}
		$student_id="S".$req_id.$id ;
		return $student_id ;
	}

}
?>