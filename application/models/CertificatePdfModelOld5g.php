<?php
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CertificatePdfModel extends CI_Model{
    
    function __construct() {
        // Set table name
        $this->table = 'certificate_pdf';
    }    

    public function getVerifiedMember($certificate_id){

        $this->db->where('certification_id',$certificate_id);
         $query = $this->db->get("certificate_pdf");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;   
    }

    
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
        $query = $this->db->query("SELECT  * FROM certificate_pdf Where status = 1 ORDER BY id DESC");
        if ($query->num_rows()>0) 
        {
            return $query->result_array();
        }
    }
    

    public function fetch_certificate_name($offerid){

           $this->db->where('id',$offerid);
         $data= $this->db->get('certificate_pdf');
         foreach($data->result() as $row){

              $nameresult=$row;
         }

         return $nameresult;    
       
    }
    public function fetch_single_details($offerid){
        $this->db->where('id',$offerid);
         $data= $this->db->get('certificate_pdf');
         foreach($data->result() as $row){
            
$path = base_url('assets/images/banners/certificate_top_banner_img-news.png');
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

$path1 = base_url('assets/images/banners/certificarelogo_for_ind_cert.png');
$type1 = pathinfo($path1, PATHINFO_EXTENSION);
$data1 = file_get_contents($path1);
$base641 = 'data:image/' . $type1 . ';base64,' . base64_encode($data1);

$path2 = base_url('assets/images/banners/kaushal-sir-new-sig-img.png');
$type2 = pathinfo($path2, PATHINFO_EXTENSION);
$data2 = file_get_contents($path2);
$base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data2);

$path3 = base_url('assets/images/banners/gaurav-trivedi-new-sig.png');
$type3 = pathinfo($path3, PATHINFO_EXTENSION);
$data3 = file_get_contents($path3);
$base643 = 'data:image/' . $type3 . ';base64,' . base64_encode($data3);

$output.='<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
            
    </style>
</head>

<body class="fstdnnn" style="padding-top:0; padding-bottom:30px;z-index:9999;margin:0;">
   <div>
      <div>
        <div>
          <div style="margin-bottom: 10px; margin-top:0;"><img style="height: 180px;width:100%;" src="'.$base64.'"/> </div>
        </div>
        <div style="text-align:center;"> <span style=" font-size:25px; font-weight:400;">This is to certify that Mr. / Mrs. / Ms.</span> <br> <br>
          <div style="padding-bottom:5px;"><span style="font-size:30px;font-weight:bold;color: #000;"><b>'.$row->name.'</b></span></div>
             
          <div style="margin-top:20px;line-height: 28px;"> <span style="font-size:24px;color: #000;">
               has participated in the online event "5G/6G Talks" held from 26/11/2023 to 17/12/2023.
              </span> </div><br> 

          <div style="position:relative; margin-top:50px;display:flex;width:100%;"> 
            <span style="line-height: 28px;margin-top:15px;width:350px;display:inline-block;float:left;">
                <span style="font-size:24px;color: #000;">Mr. Kaushlendra Singh Sisodia</span>
                <br/>
                <span style="font-size:23px;color: #4c4c51;">Chief Mentor</span><br/>
                <span style="font-size:23px;color: #4c4c51;">The IoT Academy</span>
                
            </span>
            <img style="height: 50px;width:100px;position:absolute;top:-40px;left:100px;" src="'.$base642.'"/>

            <span style="line-height: 28px;margin-top:100px;width:300px;display:inline-block;float:left;">
               <span style="background:#ffe600;padding:10px 15px;border-radius:6px;font-weight:700; font-size:24px;">Event Co-Organisers</span>
            </span>
            <span style="margin-top:30px;line-height: 28px;width:300px;display:inline-block;float:right;">
               <span style="font-size:24px;color: #000;">Dr. Gaurav Trivedi</span>
                <br/>
                <span style="font-size:23px;color: #4c4c51;">Associate Professor</span><br/>
                <span style="font-size:23px;color: #4c4c51;">EEE Department, IIT Guwahati</span>
            </span>
            <img style="height: 60px;width:120px;position:absolute;top:-30px;right:100px;" src="'.$base643.'"/>
          </div>
         
          <div style="display:flex;width: 100%;margin-top:145px;text-align:center;">
              
                <img style="height: 120px;width:100%;" src="'.$base641.'"/><br>
              
          </div>
        </div>
      </div>
    </div>
</body>

</html>';
 }
        return $output;    
}



    public function user_data()
    {
        $query = $this->db->query("SELECT  * FROM certificate_pdf Where status = 0");
        if ($query->num_rows()>0) 
        {
            return $query->result_array();
        }
    }
    public function get_status_data()
    {
        $query = $this->db->query("SELECT  * FROM certificate_pdf Where status = 0");
        if ($query->num_rows()>0) 
            return true;
        else
            return false;
    }
    

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
    
    public function update($data, $condition = array()) {
        if(!empty($data)){
            // Add modified date if not included
            if(!array_key_exists("updated", $data)){
                $data['updated'] = date("Y-m-d H:i:s");
            }
            
            // Update offerpdf data
            $update = $this->db->update($this->table, $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }
    
     public function fetch_member_email($Ids)
     {
        $query = $this->db->query("SELECT * FROM `certificate_pdf` WHERE `id` IN ($Ids) LIMIT 30");
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
        $query = $this->db->query("UPDATE `certificate_pdf` SET `mail_status`=1 WHERE `id` = '$ID'");
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