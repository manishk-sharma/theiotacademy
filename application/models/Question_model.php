<?php

class Question_model extends CI_Model{
    
    public function __construct(){
        parent::__construct();
        $this->db2 = $this->load->database('other_db', TRUE);
    }
    
    public function questionList($question_id){
        $query=$this->db2->select("q.*, t.topic_name, t.module_id, m.subject_id, m.module_name, s.subject_name")
             ->from("question as q,topic as t,module as m, subject as s")
             ->where("q.question_id = $question_id")
            ->where("t.topic_id = q.topic_id")
             ->where("m.module_id = t.module_id ")
             ->where("s.subject_id = m.subject_id ")
             ->get();
        return $query->row();
    }
    
    public function subquestionList($topic_id){
            $query=$this->db2->select("q.*,DATE_FORMAT(q.created_on,'%d-%m-%Y') as mcreated_on,DATE_FORMAT(q.updated_on,'%d-%m-%Y') as mupdated_on")
                 ->from("question as q")
                 ->where("q.topic_id",$topic_id)
                 ->order_by("q.question_no")
                ->get();
            return $query->result();
    }
    
    public function subTestQuestionList($topic_id,$test_id){
            $query=$this->db2->select("question.*,testquestion.test_id ,DATE_FORMAT(question.created_on,'%d-%m-%Y') as mcreated_on,DATE_FORMAT(question.updated_on,'%d-%m-%Y') as mupdated_on")
                 ->from("question")
                 ->where("question.topic_id",$topic_id)
                 //->join("testquestion","testquestion.test_id = 2","left outer")
                ->join("testquestion","testquestion.test_id = $test_id and testquestion.question_id = question.question_id","left outer")
                ->order_by("question.question_no")
                ->get();
            return $query->result();
    }
    
    public function questionSave($question){
        
        if($question['question_id']==0){
            $arr=array('topic_id'=>$question['topic_id'],'question_name' => $question['question_name'],'question_no' => $question['question_no'],'level_id' => $question['level_id'],'remark' => $question['remark']);
            $this->db2->insert("question",$arr);
            $question_id=$this->db2->insert_id();
        }
        else{
            $query=$this->db2
                ->set('question_name',$question['question_name'])
                ->set('question_no',$question['question_no'])
                ->set('remark',$question['remark'])
                ->set('level_id',$question['level_id'])
                ->where('question_id',$question['question_id'])
                ->update("question");
        
            $question_id = $question['question_id'];
        }
        
       
        for($i=0; $i<count($question['option_name']);$i++){
            if($question['option_name'][$i]){
//                if(isset($question['option_flag'][$i])){
//                    $option_flag=$question['option_flag'][$i];
//                }
//                else{
//                    $option_flag="";
//                }
                if($question['option_id'][$i]){
                    $this->db2
                    ->set('option_no',($i+1))
                    ->set('option_name',$question['option_name'][$i])
                    ->set('option_flag',$question['option_flag'][$i])
                    ->where('option_id',$question['option_id'][$i])
                    ->update("options");
                    
                }else{
                    $this->db2->insert("options",array('question_id'=>$question_id, 'option_no'=>$i+1,'option_name' => $question['option_name'][$i], 'option_flag' => $question['option_flag'][$i]));
                }
            }
            else{
                
               if($question['option_id'][$i]){
                   $this->db2->where('option_id',$question['option_id'][$i])
                          ->delete('options');
               }
            }
        }
    }
    
    
    public function questionDelete($question_id){
        
        $query=$this->db2->select("tq.*")
            ->from("testquestion as tq")
            ->where("tq.question_id=$question_id")   
            ->get()->result();
        
        if(count($query)==0){
            $query1=$this->db2->where('question_id',$question_id)
                              ->delete('question');

            $query2=$this->db2->where('question_id',$question_id)
                              ->delete('options'); 

            if ($query1 && $query2){
              return true;
            }
        }
        else{
            return false;
            
        }
        
        
    }
    
    public function optionList($question_id){
        
        $query=$this->db2->select("o.*")
             ->from("options as o")
             ->where("o.question_id = $question_id")
             ->order_by("o.option_no")   
             ->get();
        
        return $query->result();
        
    }
    
    
}

?>
