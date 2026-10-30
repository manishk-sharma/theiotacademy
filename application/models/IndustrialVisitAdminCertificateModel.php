<?php
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class IndustrialVisitAdminCertificateModel extends CI_Model{
    
    function __construct() {
        $this->table = 'industrial_visit_admin_certificate';
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
        $query = $this->db->query("SELECT  * FROM industrial_visit_admin_certificate Where status = 1 ORDER BY id DESC");
        if ($query->num_rows()>0) 
        {
            return $query->result_array();
        }
    }
    

    public function fetch_certificate_name($offerid){

           $this->db->where('id',$offerid);
         $data= $this->db->get('industrial_visit_admin_certificate');
         foreach($data->result() as $row){

              $nameresult=$row;
         }

         return $nameresult;    
       
    }
public function fetch_single_details($offerid){
    $this->db->where('id',$offerid);
    $data= $this->db->get('industrial_visit_admin_certificate');
    foreach($data->result() as $row){
    $path = base_url('assets/images/industrial-visit-admin-ser-bg-img.png');
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

    $path1 = base_url('assets/images/the-iot-logo-new.webp');
    $type1 = pathinfo($path1, PATHINFO_EXTENSION);
    $data1 = file_get_contents($path1);
    $base641 = 'data:image/' . $type1 . ';base64,' . base64_encode($data1);

    $path3 = base_url('assets/images/industrial-visit-stamp.png');
    $type3 = pathinfo($path3, PATHINFO_EXTENSION);
    $data3 = file_get_contents($path3);
    $base643 = 'data:image/' . $type3 . ';base64,' . base64_encode($data3);

    $uct_path = base_url('assets/images/uct_logo_file.png');
    $uct_path_type = pathinfo($uct_path, PATHINFO_EXTENSION);
    $uct_path_data = file_get_contents($uct_path);
    $uctlogo_base = 'data:image/' . $uct_path_type . ';base64,' . base64_encode($uct_path_data);

    $upskill_path = base_url('assets/images/upskill-campus-logo-new.png');
    $upskill_path_type = pathinfo($upskill_path, PATHINFO_EXTENSION);
    $upskill_path_data = file_get_contents($upskill_path);
    $upskillogo_base = 'data:image/' . $upskill_path_type . ';base64,' . base64_encode($upskill_path_data);

    $bgad_path = base_url('assets/images/background-certification-bg.png');
    $cert_path_type = pathinfo($bgad_path, PATHINFO_EXTENSION);
    $cert_path_data = file_get_contents($bgad_path);
    $certificate_bgf_base = 'data:image/' . $cert_path_type . ';base64,' . base64_encode($cert_path_data);

    $arrow_path = base_url('assets/images/newadmin-cert-arrow.png');
    $arrow_path_type = pathinfo($arrow_path, PATHINFO_EXTENSION);
    $arrow_path_data = file_get_contents($arrow_path);
    $arrow_bgf_base = 'data:image/' . $arrow_path_type . ';base64,' . base64_encode($arrow_path_data);

     $formatted_date =$row->issue_date;

$output.='<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .fstdnnn{
            background-repeat: no-repeat;
            background-size: cover;
            background-position-x:center center;
            background-origin: inherit;
            width:100%;
            background-image:url("'.$base64.'");
        }
        .bg-of-cert-head{
          position:absolute;
          top:10px;
          color:#fff;
          font-size:35px;
          left:30%;
        }   
        
        .styled-line {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        .diamond {
            width: 10px;
            height: 10px;
            position:absolute;
             margin-top:-5px;
            background-color: #1a1a50;
            transform: rotate(45deg);
        }
            .diamond1{
            position:absolute;
            width: 10px;
            height: 10px;
            margin-top:-7px;
            right:55%;
            background-color: #1a1a50;
            transform: rotate(45deg);
        }

        .line {
            flex-grow: 1;
            height: 3px;
            background-color: #f4a42f;
        }

    </style>
</head>

<body class="fstdnnn" style="padding-bottom:30px;z-index:9999;">
   <div>
        <div style="margin-top:55px;padding:10px 75px;">
           <table width="100%">
            <tr>
            <td align="left" style="width:33.33%;"><img style="height:4.8rem;" src="'.$uctlogo_base.'"/></td>
            <td align="center" style="width:33.33%;"><img style="height:4.8rem;" src="'.$base641.'"/></td>
                <td align="right" style="width:33.33%;"><img style="height:4.8rem;" src="'.$upskillogo_base.'"/></td>
            </tr>
           </table>
           
          
        </div>
        <div style="padding-top:10px;text-align:center;"> <span style="font-size:20px;font-weight:500;color:rgb(0, 0, 0);">An Upskilling Partner with</span> <span style="font-size:25px;font-weight:bold;color:rgb(0, 0, 0);">E&ICT Academy, IIT Guwahati</span> 
         
        <div style="position:relative;margin-top:20px;"><img src="'.$certificate_bgf_base.'" style="height:65px;display:flex;width:490px;"><span class="bg-of-cert-head">Certification Of Appreciation</span></div>

        <br><div style="font-size:30px; margin-top:-13px;color:rgb(52, 49, 49);">This Certificate is awarded to</div> <br>
          <div style="margin: 0px 26%;padding-bottom:5px;"><span style="font-size:30px;font-weight:bold;color: #000;"><b>'.$row->name.'</b></span></div>
            
        <div class="styled-line" style="margin-left:30%;position:relative;"><div class="diamond"></div><div class="line" style="width:460px;"></div><div class="diamond1"></div></div>
          <div style="line-height: 28px;margin-top:14px;padding:0 90px;"> <span style="font-size:20px;color:rgb(52, 49, 49);">In recognition of his/her efforts and dedication as a Co-ordinator at <b>'.$row->college_name.'</b> for conducting <b>'.$row->duration.'</b> training on
"<b>'.$row->domain.'</b>" from <b>'.$row->from_date.' to '.$row->end_date.'</b>. </span> </div><br><br> 
          
          <div style="display:flex;margin: auto;width: 100%;padding-top:0px;padding-bottom:10px;">
            <div style="position:absolute;bottom:50px;left:205px;font-size: 18px;">'.$formatted_date.'<span style="color: #000;display:block;margin-top:12px;font-size:20px;">Date</span></div>
           <hr style="position: absolute; bottom: 67px; left: 180px; 
            background-color: #000; width: 120px; height: 2px; border: none;">
              <div style="position:absolute;bottom:50px;right:20%;margin: 0px;">
                  <img style="height: 100px;" src="'.$base643.'"/><br>
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
        $query = $this->db->query("SELECT  * FROM industrial_visit_admin_certificate Where status = 0");
        if ($query->num_rows()>0) 
        {
            return $query->result_array();
        }
    }
    public function get_status_data()
    {
        $query = $this->db->query("SELECT  * FROM industrial_visit_admin_certificate Where status = 0");
        if ($query->num_rows()>0) 
            return true;
        else
            return false;
    }
    

    public function insert($data = array()) {
        if(!empty($data)){
            $insert = $this->db->insert($this->table, $data);
            
            // Return the status
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }
    
    public function update($data, $condition = array()) {
        if(!empty($data)){
            // Update offerpdf data
            $update = $this->db->update($this->table, $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }
    
     public function fetch_member_email($Ids)
     {
        $query = $this->db->query("SELECT * FROM `industrial_visit_admin_certificate` WHERE `id` IN ($Ids) LIMIT 30");
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
        $query = $this->db->query("UPDATE `industrial_visit_admin_certificate` SET `mail_status`=1 WHERE `id` = '$ID'");
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