<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EmailSetupModel extends CI_Model{
    
    function __construct() {
        // Set table name
        $this->table = 'csv_email';
    }

    
    
    /*
     * Fetch csv_email data from the database
     * @param array filter data based on the passed parameters
     */
    function getRows($params = array()){
        $this->db->select('*');
        $this->db->from($this->table);
        
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



    public function getActiveidForSendEmail()
    {
       $this->db->where('status',0);
       $query = $this->db->get('csv_email');
       $result = $query->result_array();
       return $result;

    }

    public function changeUserStatus($id,$email,$name)
    {
        $where=array(
            'id'=>$id,
            'email'=>$email,
            'name'=>$name
        );
        $data=array(
            'status'=>1
        );

        $this->db->where($where);

        $status=$this->db->update('csv_email',$data);
    }
    

    public function truncateTable(){
        $status=false;

        $status1=$this->db->truncate('csv_email');
        $status2=$this->db->truncate('subject_and_message');

        if ($status1&&$status2) {
            $status=true;
        }
        
        return $status;
    }
    /*
     * Insert csv_email data into the database
     * @param $data data to be insert based on the passed parameters
     */
    public function insert($data = array()) {
        if(!empty($data)){
            // Add created and modified date if not included
            if(!array_key_exists("created_on", $data)){
                $data['created_on'] = date("Y-m-d H:i:s");
            }
            if(!array_key_exists("last_updated_on", $data)){
                $data['last_updated_on'] = date("Y-m-d H:i:s");
            }
            
            // Insert member data
            $insert = $this->db->insert($this->table, $data);
            
            // Return the status
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }
    
    /*
     * Update member data into the database
     * @param $data array to be update based on the passed parameters
     * @param $condition array filter data
     */
    public function update($data, $condition = array()) {
        if(!empty($data)){
            // Add modified date if not included
            if(!array_key_exists("last_updated_on", $data)){
                $data['last_updated_on'] = date("Y-m-d H:i:s");
            }
            
            // Update member data
            $update = $this->db->update($this->table, $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }
}