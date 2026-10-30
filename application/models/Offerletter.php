<?php
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Offerletter extends CI_Model{
    
    function __construct() {
        // Set table name
        $this->table = 'offer_letters';
    }    
    /*
     * Fetch members data from the database
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
    public function get_data()
    {
        $query = $this->db->query("SELECT  * FROM offer_letters Where status = 1 ORDER BY id DESC");
        if ($query->num_rows()>0) 
        {
            return $query->result_array();
        }
    }
    public function user_data()
    {
        $query = $this->db->query("SELECT  * FROM offer_letters Where status = 0");
        if ($query->num_rows()>0) 
        {
            return $query->result_array();
        }
    }
    public function get_status_data()
    {
        $query = $this->db->query("SELECT  * FROM offer_letters Where status = 0");
        if ($query->num_rows()>0) 
            return true;
        else
            return false;
    }
    public function font_data($fontname,$font_cate)
    {
        $query = $this->db->query("SELECT `fontValue` FROM `fonts` WHERE `fontName` = '$fontname' AND fontCategory = '$font_cate'");
        if ($query->num_rows()>0) 
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }
    public function fetch_fontData()
    {
        $query = $this->db->query("SELECT DISTINCT `fontName` FROM `fonts`");
        if ($query->num_rows()>0) 
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
    /*
     * Insert members data into the database
     * @param $data data to be insert based on the passed parameters
     */
    public function insert($data = array()) {
        if(!empty($data)){
            // Add created and modified date if not included
            if(!array_key_exists("created", $data)){
                $data['created'] = date("Y-m-d H:i:s");
            }
            if(!array_key_exists("updated", $data)){
                $data['updated'] = date("Y-m-d H:i:s");
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
    public function update_status($ID,$imgname)
    {
        $data = array(
            'status' => 1,
            'offer_image' =>$imgname
        );
        $this->db->where('id', $ID);
        $update = $this->db->update($this->table,$data);
        return $update?true:false;
    }
    public function update($data, $condition = array()) {
        if(!empty($data)){
            // Add modified date if not included
            if(!array_key_exists("updated", $data)){
                $data['updated'] = date("Y-m-d H:i:s");
            }
            
            // Update member data
            $update = $this->db->update($this->table, $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }
    public function store_template_data($fontName,$fontType,$fontColor,$fontSize,$fontCase,$x,$y,$file_name,$eventName)
    {
        $data = array(
            'template_name'=> $eventName,
            'template_image' => $file_name,
            'font_name'=>$fontName,
            'x_pos'=>$x,
            'y_pos' =>$y,
            'font_size' => $fontSize,
            'font_case'=> $fontCase,
            'font_color' => $fontColor,
            'font_type' => $fontType
        );
        $this->db->insert('certificate_template',$data);
    }
    public function get_template_data()
    {
        $query = $this->db->query("SELECT  * FROM `certificate_template`");
        if ($query->num_rows()>0) 
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
    public function fetch_theme_data($id)
    {
        $query = $this->db->query("SELECT  * FROM `certificate_template` WHERE `id` = '$id'");
        if ($query->num_rows()>0) 
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
    public function fetch_search_data($query)
    {
        $this->db->select("*");
        $this->db->from("offer_letters");
        if($query != '')
        {
            $this->db->like('name', $query);
            $this->db->or_like('email', $query);
            $this->db->or_like('domain', $query);
            $this->db->or_like('offer_image', $query);
            $this->db->or_like('id', $query);
        }
        $this->db->order_by('CustomerID', 'DESC');
        return $this->db->get();
     }
     public function fetch_member_email($Ids)
     {
        $query = $this->db->query("SELECT * FROM `offer_letters` WHERE `id` IN ($Ids) LIMIT 30");
        if ($query->num_rows()>0) 
        {
            return $query->result();
        }
        else
        {
            return false;
        }
     }
     public function user_mail_status($ID)
     {
        $query = $this->db->query("UPDATE `offer_letters` SET `mail_status`=1 WHERE `id` = '$ID'");
         if ($query) 
        {
            return true;
        }
        else
        {
            return false;
        }
     }
     
}