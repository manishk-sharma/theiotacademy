<?php

class StudyMaterial_model extends CI_Model{
    
    public function __construct(){
        parent::__construct();
        $this->db2 = $this->load->database('other_db', TRUE);
    }
    
    public function studymaterialList($studymaterial_id){
        $query=$this->db2->select("sm.*, t.topic_name, t.module_id, m.subject_id, m.module_name, s.subject_name")
             ->from("studymaterial as sm,topic as t,module as m, subject as s")
             ->where("sm.studymaterial_id = $studymaterial_id")
            ->where("t.topic_id = sm.topic_id")
             ->where("m.module_id = t.module_id ")
             ->where("s.subject_id = m.subject_id ")
             ->get();
        return $query->row();
    }
    
    public function substudymaterialList($topic_id){
            $query=$this->db2->select("sm.*")
                 ->from("studymaterial as sm")
                 ->where("sm.topic_id",$topic_id)
                 ->order_by("sm.studymaterial_title")
                ->get();
            return $query->result();
    }
   
    
    public function studymaterialSave($studymaterial){
        
        if($studymaterial['studymaterial_id']==0){
            $arr=array('topic_id'=>$studymaterial['topic_id'],'studymaterial_title' => $studymaterial['studymaterial_title']);
            $this->db2->insert("studymaterial",$arr);
            $studymaterial_id = $this->db2->insert_id();
            move_uploaded_file($_FILES['studymaterial_file']['tmp_name'], "uploads/".$studymaterial_id.".pdf");
        }
        else{
            $query=$this->db2
                ->set('studymaterial_title',$studymaterial['studymaterial_title'])
                ->where('studymaterial_id',$studymaterial['studymaterial_id'])
                ->update("studymaterial");
                move_uploaded_file($_FILES['studymaterial_file']['tmp_name'], "uploads/".$studymaterial['studymaterial_id'].".pdf");
        }
    }
    
    
    
    public function studymaterialDelete($studymaterial_id){
        
            $query1=$this->db2->where('studymaterial_id',$studymaterial_id)
                              ->delete('studymaterial');
            if ($query1){
                if(unlink("uploads/".$studymaterial_id.".pdf")){
                    return true;
                }
            }
            return false;
    }
    

    public function batchAssign($studymaterial_id,$batch_id){
            
        $query1=$this->db2->select("b.*")
                ->from("batchstudymaterial as b")
                ->where("studymaterial_id=$studymaterial_id")   
                ->where("batch_id=$batch_id")
                ->get()->result();
        
            if(count($query1)==0){
            
                $arr=array('studymaterial_id' => $studymaterial_id,'batch_id' => $batch_id);
                $query2=$this->db2->insert("batchstudymaterial",$arr);
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
        
        $query=$this->db2->select("sb.*, s.studymaterial_title,b.batch_name")
                ->from("batchstudymaterial as sb, studymaterial as s, batch as b")
                ->where("sb.studymaterial_id=s.studymaterial_id")   
                ->where("sb.batch_id=b.batch_id")
                ->get();
        return $query->result();
        
    }
    
    public function batchAssignDelete($studymaterial_id,$batch_id){
        
          $query= $this->db2->where('studymaterial_id',$studymaterial_id)
                            ->where('batch_id',$batch_id)
                            ->delete('batchstudymaterial');  
          if($query){
            return true;
          }  
          return false;
        
    }
    
    
    public function studentAssign($studymaterial_id,$student_id){
            
        $query1=$this->db2->select("ss.*")
                ->from("studentstudymaterial as ss")
                ->where("studymaterial_id=$studymaterial_id")   
                ->where("student_id=$student_id")
                ->get()->result();
        
            if(count($query1)==0){
            
                $arr=array('studymaterial_id' => $studymaterial_id,'student_id' => $student_id);
                $query2=$this->db2->insert("studentstudymaterial",$arr);
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
        
        $query=$this->db2->select("ss.*,s.*, sm.studymaterial_title,b.batch_name")
                ->from("studentstudymaterial as ss,student as s, studymaterial as sm, batch as b")
                ->where("ss.studymaterial_id=sm.studymaterial_id")   
                ->where("ss.student_id=s.student_id")
                ->where("s.batch_id=b.batch_id")
                ->order_by("s.student_name")
                ->get();
        return $query->result();
        
    }
    
    public function studentAssignDelete($studymaterial_id,$student_id){
        
          $query= $this->db2->where('studymaterial_id',$studymaterial_id)
                            ->where('student_id',$student_id)
                            ->delete('studentstudymaterial');  
          if($query){
            return true;
          }  
          return false;
        
    }    
    
    
}

?>
