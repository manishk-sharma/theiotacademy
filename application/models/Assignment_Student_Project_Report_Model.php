<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class Assignment_Student_Project_Report_Model extends CI_Model{
    
        public function __construct(){

        parent::__construct();

        $this->load->database();

        $this->load->library('session'); 

        date_default_timezone_set('Asia/Kolkata');

    } 
    
public function userdetailsmatch($email){
	$this->db->where("email",$email);
	$query = $this->db->get('student_assign_project_report');
	if($query->num_rows() > 0)
	{ 
		$data = $query->row_array();
		return $data;
	}
	else
	{   
		return false;
	}   
}

public function insert($data = array()) {
        if(!empty($data)){
            
            // Insert member data
            $insert = $this->db->insert('student_assign_project_report', $data);
            return $insert?$this->db->insert_id():false;
        }
        return false;
}
    
public function update($data, $condition = array()) {
        if(!empty($data)){
            
            // Update offerpdf data
            $update = $this->db->update('student_assign_project_report', $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
}
    
public function fetch_member_email($Ids)
{
	$query = $this->db->query("SELECT * FROM `student_assign_project_report` WHERE `id` IN ($Ids) LIMIT 500");
	if ($query->num_rows()>0) 
	{
		return $query->result();
	}
	else
	{
		return false;
	}
}

public  function getRows($params = array()){
        $this->db->select('*');
        $this->db->from('student_assign_project_report');
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("id", $params)){
                $this->db->where('id', $params['id']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('id', 'desc');
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
                }
                
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        
        // Return fetched data
        return $result;
}


public function get_User_details() {
    $sql = "
        SELECT sa.*
        FROM student_assign_project_report sa
        INNER JOIN (
            SELECT email, MAX(created_at) as latest_created
            FROM student_assign_project_report
            GROUP BY email
        ) latest ON sa.email = latest.email AND sa.created_at = latest.latest_created
    ";

    $query = $this->db->query($sql);
    return $query->result_array();
}



public function get_data()
    {
        $query = $this->db->query("SELECT  * FROM student_assign_project_report ORDER BY id DESC");
        if ($query->num_rows()>0) 
        {
            return $query->result_array();
        }
    }

}
?>    