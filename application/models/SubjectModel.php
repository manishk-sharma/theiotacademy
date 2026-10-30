 <?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
 
class SubjectModel extends CI_Model
{
     
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
        $this->load->helper('url');
    }

    public function getSubjectsList(){ 
        $query = $this->db->get('subject_details');
        return $query->result();
    }

    public function getActiveSubjectsList(){   
        $this->db->where('status',1) ;
        $query = $this->db->get('subject_details');
        return $query->result();
    }

    public function checkUniqueSubjectTitleForUpdate($subject_id = '', $subject_title) {
        $this->db->where('subject_title', $subject_title);
        if($subject_id) {
            $this->db->where_not_in('subject_id', $subject_id);
        }
        return $this->db->get('subject_details')->num_rows();
    }


    public function getSubjectTitleById($id){
        $title='nil' ;
        $this->db->where('subject_id',$id) ;
        $query = $this->db->get('subject_details');
        $result=$query->result();
        foreach($result as $row){
            $title=$row->subject_title ;
        }
        return $title ;
    }

    public function insertSubject($subject_title,$user_id){
    	$current_time_stamp = date("Y-m-d H:i:s");
        $data = array(
            'subject_title'=>$subject_title,
            'created_by'=>$user_id,
            'last_updated_on'=>$current_time_stamp
        );
        $this->db->insert('subject_details', $data);
        $subjectid=$this->db->insert_id();
        return $subjectid; 
    }

    public function updateSubject($subject_id,$subject_title,$user_id){
        $data = array(
            'subject_title'=>$subject_title,
            'created_by'=>$user_id,
            'last_updated_on'=>$current_time_stamp = date("Y-m-d H:i:s")
            
        );
        $this->db->where('subject_id',$subject_id);
        $ustatus=$this->db->update('subject_details', $data);
        return $ustatus; 
    } 

    public function getSubjectById($id){
        $data=array() ;
        $this->db->where('subject_id',$id) ;
        $query = $this->db->get('subject_details');
        $result=$query->result();
        foreach($result as $row){
            $data=array(
                'subject_id'=> $row->subject_id,
                'subject_title'=>$row->subject_title,
                'status'=>$row->status,
                'created_by'=>$row->created_by,
                'last_updated_on'=> date('d-m-Y',strtotime($row->last_updated_on)),
                'created_on'=> date('d-m-Y',strtotime($row->created_on))
            );
        }
        return $data ;
    }

    public function updateSubjectStatus($subject_id,$status){
        
        $data = array('status'=>$status);
        
        $this->db->where('subject_id',$subject_id);
        
        $ustatus=$this->db->update('subject_details',$data);
        
        return $ustatus; 
    }


}
?>