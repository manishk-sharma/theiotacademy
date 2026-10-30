<?php

class Student_model extends CI_Model{
    
    public function __construct(){
        parent::__construct();
        $this->db2 = $this->load->database('other_db', TRUE);
    }
    
    public function studentList($student_id=null){
        if($student_id==null){
            $query=$this->db2->select("s.*,b.batch_name")
                 ->from("student as s,batch as b")
                 ->where("s.batch_id = b.batch_id")
                 ->order_by("s.student_name")   
                 ->get();
            return $query->result();
        }
        else{
            $query=$this->db2->select("s.*,b.batch_name")
                 ->from("student as s,batch as b")
                 ->where("s.student_id = $student_id")
                 ->where("s.batch_id = b.batch_id")
                 ->order_by("s.student_name")   
                 ->get();
            return $query->row();
        }
    }
    
    public function substudentList($batch_id){
            $query=$this->db2->select("s.*")
                 ->from("student as s")
                 ->where("s.batch_id",$batch_id)
                 ->order_by("s.student_name")
                 ->get();
            return $query->result();
    }
    
    public function studentSave($student){
        if($student['student_id']==0){
            $arr=array('batch_id'=>$student['batch_id'],'student_name' => $student['student_name']);
            $this->db2->insert("student",$arr);
        }
        
        else{
            $query=$this->db2
                ->set('student_name',$student['student_name'])
                ->where('student_id',$student['student_id'])
                ->update("student");
        }
    }
    
    
    public function studentDelete($student_id){
        $query= $this->db2->where('student_id',$student_id)
                            ->delete('student');  
        if($query){
              return true;
        }  
          
        return false;
    }
    
    
}


?>
