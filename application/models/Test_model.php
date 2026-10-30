<?php

class Test_model extends CI_Model{
    
    public function __construct(){
        parent::__construct();

        $this->db2 = $this->load->database('other_db', TRUE);
        
    }
    
    public function testList($test_id=null){
        if($test_id==null){
            $query=$this->db2->select("te.*")
                 ->from("test as te")
                 ->order_by("te.test_name")   
                 ->get();
        
            return $query->result();
        }
        else{
            $query=$this->db2->select("te.*")
                 ->from("test as te")
                 ->where("te.test_id",$test_id)
                 ->get();
        
            return $query->row();
        }
    }
    
    public function testSave($test){
        if($test['test_id']==0){
            $arr=array('test_name' => $test['test_name'],'test_marks' => $test['test_marks'],'test_duration' => $test['test_duration'],'test_author' => $test['test_author']);
            $this->db2->insert("test",$arr);
        }
        else{
            $query=$this->db
                ->set('test_name',$test['test_name'])
                ->set('test_marks',$test['test_marks'])
                ->set('test_duration',$test['test_duration'])
                ->set('test_author',$test['test_author'])
                ->where('test_id',$test['test_id'])
                ->update("test");
        }
    }
    
    public function testDelete($test_id){

        $query=$this->db2->select("test_id")
            ->from("module")
            ->where("test_id=$test_id")   
            ->get()->result();

        if (count($query)==0){
          $query= $this->db2->where('test_id',$test_id)
                            ->delete('test');  
            return true;
        }
           return false;
    }
    
    
    public function batchAssign($test_id,$batch_id){
            
        $query1=$this->db2->select("ba.*")
                ->from("batchassign as ba")
                ->where("test_id=$test_id")   
                ->where("batch_id=$batch_id")
                ->get()->result();
        
            if(count($query1)==0){
            
                $arr=array('test_id' => $test_id,'batch_id' => $batch_id);
                $query2=$this->db2->insert("batchassign",$arr);
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
        
        $query=$this->db2->select("ba.*, t.test_name,b.batch_name")
                ->from("batchassign as ba, test as t, batch as b")
                ->where("ba.test_id=t.test_id")   
                ->where("ba.batch_id=b.batch_id")
                ->get();
        return $query->result();
        
    }
    
    public function batchAssignDelete($test_id,$batch_id){
        
          $query= $this->db2->where('test_id',$test_id)
                            ->where('batch_id',$batch_id)
                            ->delete('batchassign');  
          if($query){
            return true;
          }  
          return false;
        
    }
    
    
    public function studentAssign($test_id,$student_id){
            
        $query1=$this->db2->select("sa.*")
                ->from("studentassign as sa")
                ->where("test_id=$test_id")   
                ->where("student_id=$student_id")
                ->get()->result();
        
            if(count($query1)==0){
            
                $arr=array('test_id' => $test_id,'student_id' => $student_id);
                $query2=$this->db2->insert("studentassign",$arr);
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
        
        $query=$this->db2->select("sa.*,s.*, t.test_name,b.batch_name")
                ->from("studentassign as sa,student as s, test as t, batch as b")
                ->where("sa.test_id=t.test_id")   
                ->where("sa.student_id=s.student_id")
                ->where("s.batch_id=b.batch_id")
                ->order_by("s.student_name")
                ->get();
        return $query->result();
        
    }
    
    public function studentAssignDelete($test_id,$student_id){
        
          $query= $this->db2->where('test_id',$test_id)
                            ->where('student_id',$student_id)
                            ->delete('studentassign');  
          if($query){
            return true;
          }  
          return false;
        
    }
}
?>
