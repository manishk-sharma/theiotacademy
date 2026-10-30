<?php
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class IndustrialVisitCertificateModel extends CI_Model
{

    function __construct()
    {
        $this->table = 'industrial_visit_user_certificate';
    }

    function getRows($params = array())
    {
        $this->db->select('*');
        $this->db->from($this->table);

        if (array_key_exists("where", $params)) {
            foreach ($params['where'] as $key => $val) {
                $this->db->where($key, $val);
            }
        }

        if (array_key_exists("returnType", $params) && $params['returnType'] == 'count') {
            $result = $this->db->count_all_results();
        } else {
            if (array_key_exists("id", $params)) {
                $this->db->where('id', $params['id']);
                $query = $this->db->get();
                $result = $query->row_array();
            } else {
                $this->db->order_by('id', 'desc');
                if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                    $this->db->limit($params['limit'], $params['start']);
                } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                    $this->db->limit($params['limit']);
                }

                $query = $this->db->get();
                $result = ($query->num_rows() > 0) ? $query->result_array() : FALSE;
            }
        }

        // Return fetched data
        return $result;
    }
    public function get_data()
    {
        $query = $this->db->query("SELECT  * FROM industrial_visit_user_certificate Where status = 1 ORDER BY id DESC");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }


    public function fetch_certificate_name($offerid)
    {

        $this->db->where('id', $offerid);
        $data = $this->db->get('industrial_visit_user_certificate');
        foreach ($data->result() as $row) {

            $nameresult = $row;
        }

        return $nameresult;
    }
    public function fetch_single_details($offerid)
    {
        $this->db->where('id', $offerid);
        $data = $this->db->get('industrial_visit_user_certificate');
        foreach ($data->result() as $row) {
            $path = base_url('assets/images/industrial-visit-user-ser-bg-img.png');
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

            //$visit_date = DateTime::createFromFormat('d-m-y', $row->visit_date);
            $formatted_date = $row->visit_date;

            $output .= '<!DOCTYPE html>
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
            background-image:url("' . $base64 . '");
        }
    </style>
</head>

<body class="fstdnnn" style="padding-bottom:30px;z-index:9999;">
   <div>
        <div style="margin-top:21px;padding:10px 30px;">
           <table width="100%">
            <tr>
                <td align="left" style="width:33.33%;"><img style="height:4.8rem;" src="' . $base641 . '"/></td>
                <td align="center" style="width:33.33%;"><img style="height:4.8rem;" src="' . $uctlogo_base . '"/></td>
                <td align="right" style="width:33.33%;"><img style="height:4.8rem;" src="' . $upskillogo_base . '"/></td>
            </tr>
           </table>

          
        </div>
        <div style="padding-top:20px;text-align:center;"> <span style="letter-spacing:3px;font-size:65px;font-family: "Times New Roman", Times, serif; font-weight:bold;color:rgb(56, 52, 52);">Certificate of Participation</span> <br><div style="font-size:30px; padding-top:8px;color:rgb(52, 49, 49);">This is to certify that</div> <br>
          <div style="margin: 0px 26%;padding-bottom:5px;"><span style="font-size:30px;font-weight:bold;color: #000;"><b>' . $row->name . '</b></span></div>
          <hr style="position:absolute;top:320px;left:255px; color: #000;width:50%;background-color: #000; border:0;height:2px;">
          <div style="line-height: 28px;margin-top:14px;"> <span style="font-size:25px;color:rgb(52, 49, 49);">from <b>' . $row->college_name . '</b><br>has successfully participated in the </span> </div><br><br> 
          <div><p style="font-size:20px;color: rgb(52, 49, 49);margin:0;padding:0;">Industrial Visit At</p>
              <p style="font-size:25px;color: rgb(56, 52, 52);font-weight:700;margin:0;padding:0;">UniConverge Technologies Pvt. Ltd., Noida</p></div>
          
          <div style="display:flex;margin: auto;width: 100%;padding-top:0px;padding-bottom:10px;">
            <div style="position:absolute;bottom:50px;left:100px;font-size: 18px;">' . $formatted_date . '<span style="color: #000;display:block;margin-top:12px;font-size:20px;">Date</span></div>
           <hr style="position: absolute; bottom: 67px; left: 90px; 
            background-color: #000; width: 120px; height: 2px; border: none;">
              <div style="position:absolute;bottom:50px;right:8%;margin: 0px;">
                  <img style="height: 100px;" src="' . $base643 . '"/><br>
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
        $query = $this->db->query("SELECT  * FROM industrial_visit_user_certificate Where status = 0");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }
    public function get_status_data()
    {
        $query = $this->db->query("SELECT  * FROM industrial_visit_user_certificate Where status = 0");
        if ($query->num_rows() > 0)
            return true;
        else
            return false;
    }


    public function insert($data = array())
    {
        if (!empty($data)) {
            $insert = $this->db->insert($this->table, $data);

            // Return the status
            return $insert ? $this->db->insert_id() : false;
        }
        return false;
    }

    public function update($data, $condition = array())
    {
        if (!empty($data)) {
            // Update offerpdf data
            $update = $this->db->update($this->table, $data, $condition);

            // Return the status
            return $update ? true : false;
        }
        return false;
    }

    public function fetch_member_email($Ids)
    {
        $query = $this->db->query("SELECT * FROM `industrial_visit_user_certificate` WHERE `id` IN ($Ids) LIMIT 30");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function user_mail_status($ID)
    {
        $query = $this->db->query("UPDATE `industrial_visit_user_certificate` SET `mail_status`=1 WHERE `id` = '$ID'");
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}
