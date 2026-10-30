<?php

class Level_model extends CI_Model{
    
    public function __construct(){
        parent::__construct();

        $this->db2 = $this->load->database('other_db', TRUE);
        
    }
    
    public function levelList(){
        $query=$this->db2->select("l.*")
             ->from("level as l")
             ->order_by("l.level_id")   
             ->get();

        return $query->result();
    }
}
?>
