<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class CourseModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
        //$this->load->helper('url');
    }

    public function getCoursesList(){
        $query = $this->db->get('courses');
        return $query->result();
    }

    public function getActiveCoursesList(){   
        $this->db->where('status',1) ;
        $query = $this->db->get('courses');
        return $query->result();
    }

    public function checkUniqueCourseTitleForUpdate($course_id = '', $course_title) {
        $this->db->where('course_title', $course_title);
        if($course_id) {
            $this->db->where_not_in('course_id', $course_id);
        }
        return $this->db->get('courses')->num_rows();
    }

    public function getCourseFeeById($id){
        $data=array() ;
        $this->db->where('course_id',$id) ;
        $query = $this->db->get('courses');
        $result=$query->result();
        foreach($result as $row){
            $data=array(
                'course_id'=> $row->course_id,
                'course_fee'=> $row->course_fee
            );
        }
        return $data ;
    }

    public function getCourseTitleById($id){
        $title='nil' ;
        $this->db->where('course_id',$id) ;
        $query = $this->db->get('courses');
        $result=$query->result();
        foreach($result as $row){
            $title=$row->course_title ;
        }
        return $title ;
    }

    public function insertCourse($subject_id,$course_title,$project_work,$course_description){
        $current_time_stamp = date("Y-m-d H:i:s");
        
        $data = array(
            'course_title'=>$course_title,
            'project_work'=>$project_work,
            'course_description'=>$course_description,
            'subject_id'=>$subject_id,
            'last_updated_on'=>$current_time_stamp

        );
         $this->db->insert('courses', $data);
        $courseid=$this->db->insert_id();
        return $courseid; 
    }

    public function updateCourse($course_id,$subject_id,$course_title,$project_work,$course_description){
        $current_time_stamp = date("Y-m-d H:i:s");
        $data = array(
            'course_title'=>$course_title,
            'project_work'=>$project_work,
            'course_description'=>$course_description,
            'subject_id'=>$subject_id,
           

        );
        $this->db->where('course_id',$course_id);
        $this->db->set('last_updated_on', 'NOW()', FALSE);
        $ustatus=$this->db->update('courses', $data);
        return $ustatus; 
    } 

    public function getCourseById($id){
        $data=array() ;
        $this->db->where('course_id',$id) ;
        $query = $this->db->get('courses');
        $result=$query->result();
        foreach($result as $row){
            $data=array(
                'course_id'=> $row->course_id,
                'cs_id'=> $row->cs_id,
                'course_title'=>$row->course_title,
                'subject_id'=>$row->subject_id,
                'project_work'=>$row->project_work,
                'course_description'=>$row->course_description,
                'modules_quantity'=>$row->modules_quantity,
                'status'=>$row->status,
                'last_updated_on'=> date('d-m-Y a',strtotime($row->last_updated_on)),
                'created_on'=> date('d-m-Y a',strtotime($row->created_on))
            );
        }
        return $data ;
    }

    public function updateModuleQuantityByPlusOne($course_id){
        $cdata=$this->getCourseById($course_id) ;
        $modules_quantity=$cdata['modules_quantity'] ;
        $modules_quantity++ ;
        $data=array('modules_quantity'=>$modules_quantity);
        $this->db->where('course_id',$course_id);
        $ustatus=$this->db->update('courses',$data);
        return $ustatus ;
    }

    public function updateCourseId($course_id){
    	$cs_id=$this->getCourseIdString($course_id) ;
        $data=array('cs_id'=>$cs_id);
        $this->db->where('course_id',$course_id);
        $ustatus=$this->db->update('courses',$data);
        if($ustatus==1){
        	return $cs_id ;
        }else{
        	return $ustatus ;
        }
    }

    public function getCourseIdString($id){
		$req_id_len=5 ;  //required id length
		$actual_id_len=strlen($id) ; //length of id
		$len_diff=$req_id_len-$actual_id_len ;
		$req_id='' ;
		for($i=0; $i<$len_diff; $i++){
			$req_id.='0' ;
		}
		$cs_id="C".$req_id.$id ;
		return $cs_id ;
	}


    public function updateCourseStatus($course_id,$status){
        
        $data = array('status'=>$status);
        
        $this->db->where('course_id',$course_id);
        $this->db->set('last_updated_on', 'NOW()', FALSE);
        $ustatus=$this->db->update('courses',$data);
        
        return $ustatus; 
    }   

}
?>