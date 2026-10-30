 <?php
 if(!defined('BASEPATH')) exit('No direct script access allowed');

class AddAllCourseModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
        date_default_timezone_set('Asia/Kolkata');
    }
    
    public function getAllCourseForuser(){

        $this->db->where('course_type','instructor-paced');
        $this->db->order_by("course_deadline", "desc");
        $query = $this->db->get('all_instructors_led_courses');
        return $query->result();
    }

    public function admin_total_course(){
        $query = $this->db->get('all_instructors_led_courses');
        return $query->result();
    }

    public function InsertAllCourseForm($data){
        $this->db->set('created_on', 'NOW()', FALSE);
		$this->db->insert('all_instructors_led_courses', $data);
		$enqid=$this->db->insert_id();
		return $enqid;
    }

   public function UpdateAllCourseForm($data,$id){

         $this->db->where('id',$id);
        $updatedata=$this->db->update('all_instructors_led_courses',$data);
        return $updatedata; 
    }

   public function updateCourseimgByID($add_course_id,$courseimgtatus){
        $filetype=$courseimgtatus['ext'];
        $data = array('course_image'=>'courseimage-'.$add_course_id.$filetype);
        $this->db->where('id',$add_course_id); 
        $status=$this->db->update('all_instructors_led_courses',$data);
        return $status;
    }

  public function updatechangeCourseimgByID($id,$courseimgtatus){
        
        $filetype=$courseimgtatus['ext'];
        $data = array('course_image'=>'courseimage-'.$id.$filetype);
        $this->db->where('id',$id); 
        $status=$this->db->update('all_instructors_led_courses',$data);
        return $status;
  }


public function deleteCourseData($id){
    $this->db->where('id',$id);
    $status=$this->db->delete('all_instructors_led_courses');
    return $status;
}

public function getaddCourseById($id){
       $this->db->where('id',$id);
       $query = $this->db->get('all_instructors_led_courses');
        return $query->result();
}


public function get_search_all_course_by_keyword($searchkeyvalue){

        $this->db->like('course_title', $searchkeyvalue);
        $this->db->or_like('course_description', $searchkeyvalue);
        $this->db->or_like('course_duration', $searchkeyvalue);
        $this->db->order_by("course_deadline", "desc");
        $query = $this->db->get("all_instructors_led_courses");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
}
}?>