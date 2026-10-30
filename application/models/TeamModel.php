<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class TeamModel extends CI_Model{
    function __construct() {
        $this->tableName = 'team_member';
        $this->primaryKey = 'id';
    }
    
    public function insert($data = array()){
       
        $insert = $this->db->insert($this->tableName,$data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;    
        }
    }
    public function updateTeamFileName($insertID,$fileName)
    {

        $data = array(
            'filname'=>$fileName,
            'upload_status'=>true,
           
        );
        $this->db->where('member_id',$insertID);
        $ustatus=$this->db->update('team_member', $data);
        return $ustatus; 
    } 


    public function getMembersBytmId($tm_id){
        
        $this->db->where('tm_id',$tm_id);

        $query=$this->db->get('team_member');
        $result=$query->result_array();

        $bigData=array();

        foreach ($result as $row) {

            array_push($bigData, $row['email_id']);
        }

        return $bigData ;
    }

   
}