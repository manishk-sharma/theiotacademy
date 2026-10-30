<?php

class Module_model extends CI_Model{
    
    public function __construct(){
        parent::__construct();

        $this->db2 = $this->load->database('other_db', TRUE);
        
    }
    
    public function moduleList($module_id=null){
        if($module_id==null){
            $query=$this->db2->select("m.*,s.subject_name")
                 ->from("module as m,subject as s")
                 ->where("m.subject_id = s.subject_id ")
                 ->order_by("s.subject_name,m.module_name")   
                 ->get();
            return $query->result();
        }
        else{
            $query=$this->db2->select("m.*,s.subject_name")
                 ->from("module as m,subject as s")
                 ->where("m.module_id = $module_id")
                 ->where("m.subject_id = s.subject_id ")
                 ->order_by("m.module_name")   
                 ->get();
            return $query->row();
        }
    }
    
    public function submoduleList($subject_id){
            $query=$this->db2->select("m.*")
                 ->from("module as m")
                 ->where("m.subject_id",$subject_id)
                 ->get();
            return $query->result();
    }
    
    public function moduleSave($module){
        if($module['module_id']==0){
            $arr=array('subject_id'=>$module['subject_id'],'module_name' => $module['module_name']);
            $this->db2->insert("module",$arr);
        }
        else{
            $query=$this->db2
                ->set('module_name',$module['module_name'])
                ->where('module_id',$module['module_id'])
                ->update("module");
        }
    }
    
    
    public function moduleDelete($module_id){

        $query=$this->db2->select("topic_id")
            ->from("topic")
            ->where("module_id=$module_id")   
            ->get()->result();

        if (count($query)==0){
          $query= $this->db2->where('module_id',$module_id)
                            ->delete('module');  
            return true;
        }
        
        return false;
    }
    
    
}


?>
