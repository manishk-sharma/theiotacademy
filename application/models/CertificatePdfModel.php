<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CertificatePdfModel extends CI_Model
{

    private $hasQrTokenColumn = null;

    function __construct()
    {
        // Set table name
        $this->table = 'certificate_pdf';
    }

    private function generate_qr_token()
    {
        try {
            return bin2hex(random_bytes(16));
        } catch (Exception $e) {
            return sha1(uniqid((string) mt_rand(), true));
        }
    }

    private function has_qr_token_column()
    {
        if ($this->hasQrTokenColumn === null) {
            $this->hasQrTokenColumn = $this->db->field_exists('qr_token', $this->table);
        }
        return $this->hasQrTokenColumn;
    }

    private function generate_unique_qr_token()
    {
        if (!$this->has_qr_token_column()) {
            return $this->generate_qr_token();
        }
        do {
            $token = $this->generate_qr_token();
            $exists = $this->db->where('qr_token', $token)->count_all_results($this->table);
        } while ($exists > 0);
        return $token;
    }

    public function ensure_qr_token($id)
    {
        if (!$this->has_qr_token_column()) {
            return false;
        }
        $row = $this->db->select('id, qr_token')
            ->where('id', $id)
            ->get($this->table)
            ->row_array();

        if (!$row) {
            return false;
        }
        if (!empty($row['qr_token'])) {
            return $row['qr_token'];
        }
        $token = $this->generate_unique_qr_token();
        $this->db->where('id', $id)->update($this->table, array('qr_token' => $token));
        return $token;
    }

    public function get_by_qr_token($qr_token)
    {
        if ($this->has_qr_token_column()) {
            $this->db->where('qr_token', $qr_token);
            $query = $this->db->get($this->table);
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
        }
        // Fallback: try certification_id
        $this->db->where('certification_id', $qr_token);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

    public function getVerifiedMember($certificate_id)
    {

        $this->db->where('certification_id', $certificate_id);
        $query = $this->db->get("certificate_pdf");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
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
        $query = $this->db->query("SELECT  * FROM certificate_pdf Where status = 1 ORDER BY id DESC");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }


    public function fetch_certificate_name($offerid)
    {

        $this->db->where('id', $offerid);
        $data = $this->db->get('certificate_pdf');
        foreach ($data->result() as $row) {

            $nameresult = $row;
        }

        return $nameresult;
    }


    public function fetch_single_details($offerid)
    {
        $this->db->where('id', $offerid);
        $data = $this->db->get('certificate_pdf');
        foreach ($data->result() as $row) {

            // Background template
            $bg_path = 'https://www.theiotacademy.co/assets/images/banners/aicte-certificate-template-custom_with_upskillcampus.png';
            $bg_data = file_get_contents($bg_path);
            $base64_bg = 'data:image/png;base64,' . base64_encode($bg_data);

            // Stamp image
            $stamp_path = 'https://www.theiotacademy.co/assets/images/stamp-logo-new.png';
            $stamp_data = file_get_contents($stamp_path);
            $base64_stamp = 'data:image/png;base64,' . base64_encode($stamp_data);

            // QR code
            $qr_token = $this->ensure_qr_token($row->id);
            if (empty($qr_token)) {
                $qr_token = !empty($row->qr_token) ? $row->qr_token : $row->certification_id;
            }
            $verify_url = 'https://www.theiotacademy.co/certificate-scan-verify/' . urlencode($qr_token);
            $qr_api_url = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . urlencode($verify_url);
            $qr_image   = @file_get_contents($qr_api_url);
            $base64_qr  = $qr_image ? 'data:image/png;base64,' . base64_encode($qr_image) : '';

            $output .= '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        @page {
            size: 1200px 849px;
            margin: 0;
        }
        html, body {
            width: 1200px;
            height: 849px;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
    </style>
</head>
<body>
<div style="position:relative;width:1200px;height:849px;background-image:url(\'' . $base64_bg . '\');background-size:100% 100%;background-repeat:no-repeat;">

    <!-- Cream masks -->
    <div style="position:absolute;left:168px;top:188px;width:765px;height:600px;background:#fcfaed;"></div>
    <div style="position:absolute;left:168px;top:188px;width:1015px;height:530px;background:#fcfaed;"></div>

    <!-- CERTIFICATE OF COMPLETION -->
    <div style="position:absolute;left:235px;top:205px;width:945px;font-weight:bold;font-size:46px;color:#1a2a6c;letter-spacing:1px;">CERTIFICATE OF COMPLETION</div>

    <!-- awarded to -->
    <div style="position:absolute;left:235px;top:265px;font-size:22px;color:#1a1a1a;">awarded to</div>

    <!-- Student Name -->
    <div style="position:absolute;left:235px;top:310px;width:900px;font-size:60px;color:#1a1a1a;line-height:1;">' . $row->name . '</div>

    <!-- Underline -->
    <div style="position:absolute;left:235px;top:418px;width:900px;height:2px;background:#1a2a6c;"></div>

    <!-- Dates -->
    <div style="position:absolute;left:235px;top:438px;width:900px;font-size:18px;color:#1a1a1a;">for successfully completing the Internship Program from <b>' . $row->course_start_date . '</b> to <b>' . $row->course_end_date . '</b>.</div>

    <!-- Domain paragraph -->
    <div style="position:absolute;left:235px;top:490px;width:900px;font-size:18px;color:#1a1a1a;line-height:1.6;">During this internship, the candidate actively participated in hands-on training and real industry project work in the domain of <b>' . $row->domain_name . '</b></div>

    <!-- AICTE collaboration -->
    <div style="position:absolute;left:235px;top:600px;width:900px;font-size:18px;color:#1a1a1a;line-height:1.6;">This program was conducted in collaboration with <b>All India Council for Technical Education (AICTE)</b> and <b>UniConverge Technologies</b> &amp; <b>upSkill Campus.</b></div>

    <!-- QR Code above Certificate ID -->
    ' . ($base64_qr ? '<div style="position:absolute;left:235px;top:695px;background:#fcfaed;padding:3px;border:1px solid #1a2a6c;border-radius:4px;">
        <img src="' . $base64_qr . '" style="width:72px;height:72px;display:block;" alt="Verify" />
    </div>' : '') . '

    <!-- Certificate ID mask -->
    <div style="position:absolute;left:215px;top:775px;width:620px;height:36px;background:#fcfaed;"></div>

    <!-- Certificate ID text -->
    <div style="position:absolute;left:235px;top:780px;font-size:15px;color:#111;"><b>Certificate ID:</b> ' . $row->certification_id . '</div>

    <!-- Stamp -->
    <img src="' . $base64_stamp . '" style="position:absolute;left:980px;top:615px;width:130px;height:130px;opacity:0.9;" />

    <!-- Signature line -->
    <div style="position:absolute;left:920px;top:752px;width:250px;height:1px;background:#333;"></div>

    <!-- Signatory Name -->
    <div style="position:absolute;left:920px;top:758px;width:250px;font-size:14px;font-weight:bold;color:#111;text-align:center;">Kaushlendra Singh Sisodia</div>

    <!-- Title Line 1 -->
    <div style="position:absolute;left:920px;top:778px;width:250px;font-size:11px;color:#333;text-align:center;">Chief Mentor, The IoT Academy</div>

    <!-- Title Line 2 -->
    <div style="position:absolute;left:920px;top:794px;width:250px;font-size:11px;color:#333;text-align:center;">Director, Uniconverge Technologies</div>

</div>
</body>
</html>';
        }
        return $output;
    }



    public function user_data()
    {
        $query = $this->db->query("SELECT  * FROM certificate_pdf Where status = 0");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }
    public function get_status_data()
    {
        $query = $this->db->query("SELECT  * FROM certificate_pdf Where status = 0");
        if ($query->num_rows() > 0)
            return true;
        else
            return false;
    }


    public function insert($data = array())
    {
        if (!empty($data)) {
            // Generate qr_token if column exists and not already set
            if ($this->has_qr_token_column() && (!array_key_exists('qr_token', $data) || empty($data['qr_token']))) {
                $data['qr_token'] = $this->generate_unique_qr_token();
            }
            // Add created and modified date if not included
            if (!array_key_exists("created", $data)) {
                $data['created'] = date("Y-m-d H:i:s");
            }
            if (!array_key_exists("updated", $data)) {
                $data['updated'] = date("Y-m-d H:i:s");
            }

            // Insert member data
            $insert = $this->db->insert($this->table, $data);

            // Return the status
            return $insert ? $this->db->insert_id() : false;
        }
        return false;
    }

    public function update($data, $condition = array())
    {
        if (!empty($data)) {
            // Add modified date if not included
            if (!array_key_exists("updated", $data)) {
                $data['updated'] = date("Y-m-d H:i:s");
            }

            // Update offerpdf data
            $update = $this->db->update($this->table, $data, $condition);

            // Return the status
            return $update ? true : false;
        }
        return false;
    }

    public function fetch_member_email($Ids)
    {
        $query = $this->db->query("SELECT * FROM `certificate_pdf` WHERE `id` IN ($Ids) LIMIT 30");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function user_mail_status($ID)
    {
        $query = $this->db->query("UPDATE `certificate_pdf` SET `mail_status`=1 WHERE `id` = '$ID'");
        if ($query) {
            return true;
        } else {
            return false;
        }
    }


    public function insert_manual_certificate_detail_for_verfication($data)
    {
        $this->db->insert('certificate_pdf', $data);
        return $this->db->insert_id();
    }

    public function isextis_certification_id($certification_id)
    {
        $this->db->where('certification_id', $certification_id);
        $query = $this->db->get("certificate_pdf");
        return $query->num_rows();
    }

    public function get_manual_data_Rows()
    {
        $query = $this->db->query("SELECT  * FROM certificate_pdf  ORDER BY id DESC");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }
}
