<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class CourseModuleModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
        //$this->load->helper('url');
    }

    public function getCourseModuleList()
    {
        $query = $this->db->get('cmodules');
        return $query->result();
    }

    public function checkUniqueModuleNameForUpdate($cm_id = '', $module_name) {
        $this->db->where('module_name', $module_name);
        if($cm_id) {
            $this->db->where_not_in('cm_id', $cm_id);
        }
        return $this->db->get('cmodules')->num_rows();
    }

    public function getCourseModuleFeeById($id){
        $data=array() ;
        $this->db->where('cm_id',$id) ;
        $query = $this->db->get('cmodules');
        $result=$query->result();
        foreach($result as $row){
            $data=array(
                'cm_id'=> $row->cm_id,
                'module_fee'=> $row->module_fee
            );
        }
        return $data ;
    }

    //Function To Check If Module of Batch Exists In  Module List of Course of Registration.
    public function isModuleExistsInCourseOfReg($cm_id,$reg_id){
        $exist=FALSE ;
        $reginfo=$this->RegisterModel->getRegistrationById($reg_id) ;
        $course_id=$reginfo['course_id'] ;
        $conditions=array('cm_id'=>$cm_id,'course_id'=>$course_id) ;
        $this->db->where($conditions) ;
        $query = $this->db->get('course_modules');
        $result=$query->result();
        if(count($result)>0){
            $exist=TRUE ;
        }
        return $exist ;
    }

    //Function To Check If Module-Course Mapping Already Exists in course_modules Table.
    public function isModuleAlreadyInCourse($cm_id,$course_id){
        $status=FALSE ;
        $conditions=array('cm_id'=>$cm_id,'course_id'=>$course_id) ;
        $this->db->where($conditions) ;
        $query = $this->db->get('course_modules');
        $result=$query->result();
        if(count($result)>0){
            $status=TRUE ;
        }
        return $status ;
    }

    //Function To Insert Module-Course Mapping To course_modules Table.
    public function insertModuleToCourse($cm_id,$course_id){
        $brid=0 ;
        $data = array(
            'cm_id'=>$cm_id,
            'course_id'=>$course_id
        );
        $this->db->insert('course_modules', $data);
        $mappingid=$this->db->insert_id();
        return $mappingid; 
    }

    //Fetching Module IDs By Course ID
    public function getModulesByCourseId($course_id){
        $this->db->where('course_id',$course_id) ;
        $query = $this->db->get('course_modules');
        $result=$query->result();
        return $result ;
    }

    public function insertCourseModule($module_name,$module_fee,$description,$duration){
        $data = array(
            'module_name'=>$module_name,
            'module_fee'=>$module_fee,
            'description'=>$description,
            'duration'=>$duration,
            
        );
        $this->db->insert('cmodules', $data);
        $cmid=$this->db->insert_id();
        return $cmid; 
    }

    public function updateCourseModule($cm_id,$module_name,$module_fee,$description,$duration){
        $data = array(
            'module_name'=>$module_name,
            'module_fee'=>$module_fee,
            'description'=>$description,
            'duration'=>$duration,
        );
        $this->db->where('cm_id',$cm_id);
        $ustatus=$this->db->update('cmodules', $data);
        return $ustatus; 
    } 

    public function getCourseModuleById($id){
        $data=array() ;
        $this->db->where('cm_id',$id) ;
        $query = $this->db->get('cmodules');
        $result=$query->result();
        foreach($result as $row){
            $data = array(
                'cm_id'=>$row->cm_id,
                'module_id'=>$row->module_id,
                'module_name'=>$row->module_name,
                'module_fee'=>$row->module_fee,
                'description'=>$row->description,
                'duration'=>$row->duration,
                'hours_per_day_stud'=>$row->hours_per_day_stud,
                'days_quantity_stud'=>$row->days_quantity_stud,
                'hours_per_day_prof'=>$row->hours_per_day_prof,
                'days_quantity_prof'=>$row->days_quantity_prof,
                'duration_offline_stud_hrs'=>$row->duration_offline_stud_hrs,
                'duration_offline_prof_hrs'=>$row->duration_offline_prof_hrs,
                'syllabus'=>$row->syllabus,
                'status'=>$row->status,
                'last_updated_on'=>$row->last_updated_on,
                'created_on'=>$row->created_on
            );
        }
        return $data ;
    }

    public function updateCourseModuleId($cm_id){
    	$module_id=$this->getCourseModuleIdString($cm_id) ;
        $data=array('module_id'=>$module_id);
        $this->db->where('cm_id',$cm_id);
        $ustatus=$this->db->update('cmodules',$data);
        if($ustatus==1){
        	return $module_id ;
        }else{
        	return $ustatus ;
        }
    }

    public function getCourseModuleIdString($id){
		$req_id_len=4 ;  //required id length
		$actual_id_len=strlen($id) ; //length of enq_id
		$len_diff=$req_id_len-$actual_id_len ;
		$req_id='' ;
		for($i=0; $i<$len_diff; $i++){
			$req_id.='0' ;
		}
		$module_id="CM".$req_id.$id ;
		return $module_id ;
	}

}
?>