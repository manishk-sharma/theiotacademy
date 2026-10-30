<?php

class Subject_model extends CI_Model{
    
    public function __construct(){
        parent::__construct();

        $this->db2 = $this->load->database('other_db', TRUE);
        
    }

    //var $db2=$this->load->database('other_db', TRUE);

    public function subjectList($subject_id=null){

       

        if($subject_id==null){

            $query=$this->db2->select("s.*")
                 ->from("subject as s")
                 ->order_by("s.subject_name")   
                 ->get();
        
            return $query->result();
        }
        else{
            $query=$this->db2->select("s.*")
                 ->from("subject as s")
                 ->where("s.subject_id",$subject_id)
                 ->get();
        
            return $query->row();
        }
    }
    
    public function subjectSave($subject){

         
        if($subject['subject_id']==0){
            $arr=array('subject_name' => $subject['subject_name']);
            $this->db2->insert("subject",$arr);
        }
        else{
            $query=$this->db2
                ->set('subject_name',$subject['subject_name'])
                ->where('subject_id',$subject['subject_id'])
                ->update("subject");
        }
    }
    
    public function subjectDelete($subject_id){

    $query=$this->db2->select("subject_id")
        ->from("module")
        ->where("subject_id=$subject_id")   
        ->get()->result();

    if (count($query)==0){
      $query= $this->db2->where('subject_id',$subject_id)
                        ->delete('subject');  
        return true;
    }
       return false;
    }
    
}


?>
