<?php

class TestQuestion_model extends CI_Model{
    
    public function __construct(){
        parent::__construct();

        $this->db2 = $this->load->database('other_db', TRUE);
        
    }
    
    public function subTestQuestionHomeList($test_id){
            $query=$this->db2->select("tq.*,q.*")
                 ->from("testquestion as tq, question as q")
                 ->where("tq.test_id",$test_id)
                 ->where("tq.question_id=q.question_id")
                 ->get();
            return $query->result();
    }
    
    public function testQuestionSave($test){
       // print_r($test);
        for($i=0; $i<count($test['question_id']);$i++){
            if($test['questioncheck'][$i]=='Y'){
                    $this->db2->where('test_id',$test['test_id'])
                           ->where('question_id',$test['question_id'][$i])
                          ->delete('testquestion');
                    $this->db2->insert("testquestion",array('test_id'=>$test['test_id'], 'question_id'=>$test['question_id'][$i]));
                }
            else{
                   $this->db2->where('test_id',$test['test_id'])
                           ->where('question_id',$test['question_id'][$i])
                          ->delete('testquestion');
               }
        }
    }
    
    
    
    public function testQuestionDelete($testQuestion_id){
        $query1=$this->db2->where('testQuestion_id',$testQuestion_id)
                          ->delete('testQuestion');

        $query2=$this->db2->where('testQuestion_id',$testQuestion_id)
                          ->delete('options'); 
        
        if ($query1 && $query2){
          return true;
        }
        
        return false;
    }
    
    public function optionList($testQuestion_id){
        
        $query=$this->db2->select("o.*")
             ->from("options as o")
             ->where("o.testQuestion_id = $testQuestion_id")
             ->order_by("o.option_no")   
             ->get();
        
        return $query->result();
        
    }
    
    
}

?>
