<?php

class Assignment_model extends CI_Model{
    
    public function __construct(){
        parent::__construct();

        $this->db2 = $this->load->database('other_db', TRUE);
        
    }
    
    public function assignmentList($assignment_id){
        $query=$this->db2->select("a.*, t.topic_name, t.module_id, m.subject_id, m.module_name, s.subject_name")
             ->from("assignment as a,topic as t,module as m, subject as s")
             ->where("a.assignment_id = $assignment_id")
            ->where("t.topic_id = a.topic_id")
             ->where("m.module_id = t.module_id ")
             ->where("s.subject_id = m.subject_id ")
             ->get();
        return $query->row();
    }
    
    public function subassignmentList($topic_id){
            $query=$this->db2->select("a.*")
                 ->from("assignment as a")
                 ->where("a.topic_id",$topic_id)
                 ->order_by("a.assignment_title")
                ->get();
            return $query->result();
    }
   
    
    public function assignmentSave($assignment){
        
        if($assignment['assignment_id']==0){
            $arr=array('topic_id'=>$assignment['topic_id'],'assignment_title' => $assignment['assignment_title']);
            $this->db2->insert("assignment",$arr);
            $assignment_id = $this->db2->insert_id();
            move_uploaded_file($_FILES['assignment_file']['tmp_name'], "uploads/assignment/".$assignment_id.".pdf");
        }
        else{
            $query=$this->db2
                ->set('assignment_title',$assignment['assignment_title'])
                ->where('assignment_id',$assignment['assignment_id'])
                ->update("assignment");
                move_uploaded_file($_FILES['assignment_file']['tmp_name'], "uploads/assignment/".$assignment['assignment_id'].".pdf");
        }
    }
    
    
    
    public function assignmentDelete($assignment_id){
        
            $query1=$this->db2->where('assignment_id',$assignment_id)
                              ->delete('assignment');
            if ($query1){
                if(unlink("uploads/".$assignment_id.".pdf")){
                    return true;
                }
            }
            return false;
    }
    

    public function batchAssign($assignment_id,$batch_id){
            
        $query1=$this->db2->select("b.*")
                ->from("batchassignment as b")
                ->where("assignment_id=$assignment_id")   
                ->where("batch_id=$batch_id")
                ->get()->result();
        
            if(count($query1)==0){
            
                $arr=array('assignment_id' => $assignment_id,'batch_id' => $batch_id);
                $query2=$this->db2->insert("batchassignment",$arr);
                if($query2){
                    return true;
                }
                else{
                    return false;
                }
            }
            
            return false;
            
    }
    
    public function batchAssignList(){
        
        $query=$this->db2->select("sb.*, s.assignment_title,b.batch_name")
                ->from("batchassignment as sb, assignment as s, batch as b")
                ->where("sb.assignment_id=s.assignment_id")   
                ->where("sb.batch_id=b.batch_id")
                ->get();
        return $query->result();
        
    }
    
    public function batchAssignDelete($assignment_id,$batch_id){
        
          $query= $this->db2->where('assignment_id',$assignment_id)
                            ->where('batch_id',$batch_id)
                            ->delete('batchassignment');  
          if($query){
            return true;
          }  
          return false;
        
    }
    
    
    public function studentAssign($assignment_id,$student_id){
            
        $query1=$this->db2->select("ss.*")
                ->from("studentassignment as ss")
                ->where("assignment_id=$assignment_id")   
                ->where("student_id=$student_id")
                ->get()->result();
        
            if(count($query1)==0){
            
                $arr=array('assignment_id' => $assignment_id,'student_id' => $student_id);
                $query2=$this->db2->insert("studentassignment",$arr);
                if($query2){
                    return true;
                }
                else{
                    return false;
                }
            }
            
            return false;
    }
    
    public function studentAssignList(){
        
        $query=$this->db2->select("ss.*,s.*, sm.assignment_title,b.batch_name")
                ->from("studentassignment as ss,student as s, assignment as sm, batch as b")
                ->where("ss.assignment_id=sm.assignment_id")   
                ->where("ss.student_id=s.student_id")
                ->where("s.batch_id=b.batch_id")
                ->order_by("s.student_name")
                ->get();
        return $query->result();
        
    }
    
    public function studentAssignDelete($assignment_id,$student_id){
        
          $query= $this->db2->where('assignment_id',$assignment_id)
                            ->where('student_id',$student_id)
                            ->delete('studentassignment');  
          if($query){
            return true;
          }  
          return false;
        
    }    
    
    
}

?>
