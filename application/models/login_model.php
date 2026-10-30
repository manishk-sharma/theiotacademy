<?php

class login_model extends CI_Model{
    
    public function __construct(){
        parent::__construct();

        $this->db2 = $this->load->database('other_db', TRUE);
        
    }
    
    public function checkLogin($user_log,$user_pass){
        $query=$this->db2->select("user_id,user_name")
                ->from("usermaster")
                ->where("user_log",$user_log)
                ->where("user_pass",$user_pass)
                ->get();
        
        if(count($query)==0){
            return false;
        }
        else{
            return $query->row();
        }
        
    }
    
}


?>
