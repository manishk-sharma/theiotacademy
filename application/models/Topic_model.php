<?php

class Topic_model extends CI_Model{
    
    public function __construct(){
        parent::__construct();

        $this->db2 = $this->load->database('other_db', TRUE);
        
    }
    
    public function topicList($topic_id){
        $query=$this->db2->select("t.*,m.subject_id,m.module_name,s.subject_name")
             ->from("topic as t,module as m, subject as s")
             ->where("t.topic_id = $topic_id")
             ->where("m.module_id = t.module_id ")
             ->where("s.subject_id = m.subject_id ")
             ->order_by("t.topic_name")   
             ->get();
        return $query->row();
    }
    
    public function subtopicList($module_id){
            $query=$this->db2->select("t.*,m.subject_id")
                 ->from("topic as t,module as m")
                 ->where("t.module_id",$module_id)
                 ->where("m.module_id = t.module_id")
                 ->get();
            return $query->result();
    }
    
    public function topicSave($topic){
        if($topic['topic_id']==0){
            $arr=array('module_id'=>$topic['module_id'],'topic_name' => $topic['topic_name']);
            $this->db2->insert("topic",$arr);
        }
        else{
            $query=$this->$this->db2
                ->set('topic_name',$topic['topic_name'])
                ->where('topic_id',$topic['topic_id'])
                ->update("topic");
        }
    }
    
    public function topicDelete($topic_id){

        $query=$this->$this->db2->select("question_id")
            ->from("question")
            ->where("topic_id=$module_id")   
            ->get()->result();

        if (count($query)==0){
          $query= $this->$this->db2->where('topic_id',$topic_id)
                            ->delete('topic');  
            return true;
        }
        
        return false;
    }
    
    
}

?>
