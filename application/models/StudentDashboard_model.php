<?php

class StudentDashboard_model extends CI_Model{
    
    public function __construct(){
        parent::__construct();
        $this->db2 = $this->load->database('other_db', TRUE);
    }
    
    public function studentDashboard($student_id,$subject_id){
        $query=$this->db2->select("s.student_name,count(distinct test_id) as total_tests")
                        ->select("m.module_name as module_name")
                        ->select("(select count(studenttest.question_id) from studenttest,question,topic,module,subject where attempt='C' AND studenttest.question_id = question.question_id AND question.topic_id = topic.topic_id AND topic.module_id=module.module_id AND module.subject_id=subject.subject_id AND subject.subject_id = $subject_id AND studenttest.student_id = $student_id) as correct_questions")
                        ->select("(select count(studenttest.question_id) from studenttest,question,topic,module,subject where attempt='I' AND studenttest.question_id = question.question_id AND question.topic_id = topic.topic_id AND topic.module_id=module.module_id AND module.subject_id=subject.subject_id AND subject.subject_id = $subject_id AND studenttest.student_id = $student_id) as incorrect_questions")
                        ->select("(select count(studenttest.question_id) from studenttest,question,topic,module,subject where attempt='U' AND studenttest.question_id = question.question_id AND question.topic_id = topic.topic_id AND topic.module_id=module.module_id AND module.subject_id=subject.subject_id AND subject.subject_id = $subject_id AND studenttest.student_id = $student_id) as unattempted_questions")
                        ->select("(select count(*) from studentassign as sa where sa.student_id=$student_id) as tests_assigned")
                        ->select("(select count(level_id) from studenttest,question,topic,module,subject where studenttest.question_id = question.question_id AND question.topic_id = topic.topic_id AND topic.module_id=module.module_id AND module.subject_id=subject.subject_id AND subject.subject_id = $subject_id AND studenttest.student_id = $student_id AND attempt not in('U') AND question.level_id=0) as unknown_level")
                        ->select("(select count(level_id) from studenttest,question,topic,module,subject where studenttest.question_id = question.question_id AND question.topic_id = topic.topic_id AND topic.module_id=module.module_id AND module.subject_id=subject.subject_id AND subject.subject_id = $subject_id AND studenttest.student_id = $student_id AND attempt not in('U') AND question.level_id=1) as easy_level")
                        ->select("(select count(level_id) from studenttest,question,topic,module,subject where studenttest.question_id = question.question_id AND question.topic_id = topic.topic_id AND topic.module_id=module.module_id AND module.subject_id=subject.subject_id AND subject.subject_id = $subject_id AND studenttest.student_id = $student_id AND attempt not in('U') AND question.level_id=2) as medium_level")
                        ->select("(select count(level_id) from studenttest,question,topic,module,subject where studenttest.question_id = question.question_id AND question.topic_id = topic.topic_id AND topic.module_id=module.module_id AND module.subject_id=subject.subject_id AND subject.subject_id = $subject_id AND studenttest.student_id = $student_id AND attempt not in('U') AND question.level_id=3) as hard_level")
                        ->select("(select count(test_id) from studenttest,question,topic,module,subject where studenttest.question_id = question.question_id AND question.topic_id = topic.topic_id AND topic.module_id=module.module_id AND module.subject_id=subject.subject_id AND subject.subject_id = $subject_id AND studenttest.student_id = $student_id AND attempt not in('U')) as subject_tests")
                        ->select("(select count(studenttest.question_id) from studenttest,question,topic,module,subject where studenttest.question_id = question.question_id AND question.topic_id = topic.topic_id AND topic.module_id=module.module_id AND module.subject_id=subject.subject_id AND subject.subject_id = $subject_id AND studenttest.student_id = $student_id) as total_questions")
                        ->select("(select count(studenttest.question_id) from studenttest,question,topic,module,subject where studenttest.question_id = question.question_id AND question.topic_id = topic.topic_id AND topic.module_id=module.module_id AND module.subject_id=subject.subject_id AND subject.subject_id = $subject_id AND studenttest.student_id = $student_id) as total_questions")
                        ->from("studenttest as st,student as s,module as m ,question as q,topic as t,subject as sb")
                        ->where("st.student_id = $student_id")
                        ->where("s.student_id = st.student_id")
                        ->where("st.question_id = q.question_id")
                        ->where("t.topic_id = q.topic_id")
                        ->where("m.module_id = t.module_id")
                        ->where("sb.subject_id = m.subject_id")
                        ->where("sb.subject_id = $subject_id")
                        ->get();
        return $query->result();
                
    }
    
}

?>
