<?php
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WebinarModel extends CI_Model
{

    function __construct()
    {
        // Set table name
        $this->table = 'webinar';
    }

    public function getVerifiedMember($certificate_id)
    {

        $this->db->where('certification_id', $certificate_id);
        $query = $this->db->get("webinar");
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
        $query = $this->db->query("SELECT  * FROM webinar Where status = 1 ORDER BY id DESC");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }


    public function fetch_certificate_name($offerid)
    {

        $this->db->where('id', $offerid);
        $data = $this->db->get('webinar');
        foreach ($data->result() as $row) {

            $nameresult = $row;
        }

        return $nameresult;
    }

    private function image_to_data_uri($relative_path)
    {
        $file = FCPATH . $relative_path;
        if (!is_file($file)) {
            return '';
        }
        $mime = function_exists('mime_content_type') ? mime_content_type($file) : '';
        if (!$mime) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $mime = ($ext === 'jpg' || $ext === 'jpeg') ? 'image/jpeg' : 'image/' . $ext;
        }
        return 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($file));
    }

    private function certificate_text($value, $placeholder)
    {
        $value = trim((string) $value);
        return $value !== '' ? htmlspecialchars($value, ENT_QUOTES, 'UTF-8') : $placeholder;
    }

    public function fetch_single_details($offerid)
    {
        $this->db->where('id', $offerid);
        $data = $this->db->get('webinar');
        $output = '';
        foreach ($data->result() as $row) {
            $top_banner = $this->image_to_data_uri('assets/images/banners/new-webinar-certificate-template.png');
            $stamp = $this->image_to_data_uri('assets/images/stamp-logo-certificate.png');
            if ($stamp === '') {
                $stamp = $this->image_to_data_uri('assets/images/stamp-logo-new.png');
            }

            $name = $this->certificate_text($row->name, '[RECIPIENT NAME]');
            $topic = $this->certificate_text($row->topic, '[WEBINAR / COURSE TITLE]');
            $issue_date = $this->certificate_text($row->issue_date, '[DATE]');
            $cert_id = $this->certificate_text($row->certification_id, '[CERTIFICATE ID]');
            $katibeh_src = 'file:///' . str_replace('\\', '/', FCPATH . 'assets/fonts/Katibeh-Regular.ttf');

            $output .= '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 0; size: A4 landscape; }
        @font-face {
            font-family: "Katibeh";
            font-style: normal;
            font-weight: 400;
            src: url("' . $katibeh_src . '") format("truetype");
        }
        * { box-sizing: border-box; }
        html, body {
            margin: 0;
            padding: 0;
            width: 297mm;
            height: 210mm;
            background: #ffffff;
            color: #12233a;
            font-family: DejaVu Serif, Times New Roman, serif;
        }
        .sheet {
            width: 297mm;
            height: 210mm;
            position: relative;
            overflow: hidden;
            background-color: #ffffff;
            background-image:
                linear-gradient(135deg, rgba(18, 58, 92, 0.03) 25%, transparent 25%),
                linear-gradient(225deg, rgba(18, 58, 92, 0.03) 25%, transparent 25%);
            background-size: 20px 20px;
        }
        .frame {
            position: absolute;
            top: 0mm;
            left: 0mm;
            right: 0mm;
            bottom:0mm;
        }
    
        .banner {
            display: block;
            width: 100%;
            height: auto;
            border: 0;
        }
        .content {
            padding: 2mm 12mm 52mm 12mm;
            text-align: center;
        }
        .title {
            margin: 0;
            font-family: Katibeh, DejaVu Serif, serif;
            font-size: 42pt;
            line-height: 1.05;
            letter-spacing: 0.4pt;
            color: #111111;
            font-weight: 400;
            text-transform: none;
        }

        .intro {
            margin: 0 0 1.8mm 0;
            font-family: DejaVu Sans, Helvetica, sans-serif;
            font-size: 12pt;
            color: #000;
        }
        .recipient {
            margin: 0;
            font-size: 22pt;
            line-height: 1.15;
            color: #000;
            font-weight: bold;
        }
        .name-rule {
            width: 110mm;
            height: 0.55pt;
            background: #16385f;
            border: 0;
            margin: 1.8mm auto 2.8mm auto;
        }
        .body-copy {
            margin: 0 0 2mm 0;
            font-family: DejaVu Sans, Helvetica, sans-serif;
            font-size: 12pt;
            color: #000;
        }
        .program {
            margin: 0 10mm 2mm 10mm;
            font-size: 20pt;
            line-height: 1.25;
            color: #000;
            font-weight: bold;
        }
        .org-line {
            margin: 0 14mm 0 14mm;
            font-family: DejaVu Sans, Helvetica, sans-serif;
            font-size: 12pt;
            color: #000;
        }
        .footer {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
        }
        .footer-inner {
            padding: 0 16mm 3mm 16mm;
        }
        .meta-table {
            width: 100%;
            border-collapse: collapse;
        }
        .meta-value {
            font-family: DejaVu Sans, Helvetica, sans-serif;
            font-size: 11pt;
            font-weight: bold;
            color: #111111;
            padding-bottom: 2mm;
        }
        .meta-label {
            font-family: DejaVu Sans, Helvetica, sans-serif;
            font-size: 10pt;
            font-weight: 400;
            letter-spacing: 0;
            text-transform: none;
            color: #111111;
            padding-top: 2mm;
        }
        .meta-line {
            width: 42mm;
            height: 0.7pt;
            background: #111111;
            border: 0;
            margin: 0 auto;
        }
        .stamp {
            height: 20mm;
            width: auto;
        }
        .brand {
            margin: 1.5mm 0 0 0;
            font-family: DejaVu Sans, Helvetica, sans-serif;
            font-size: 10pt;
            color: #111111;
            line-height: 1.35;
        }
        .footer-bar {
            height: 8mm;
            background: #161130;
            margin-top: 16mm;
        }
    </style>
</head>
<body>
    <div class="sheet">
        <div class="frame">
            <div class="frame-gold">
                <img class="banner" src="' . $top_banner . '" alt="The IoT Academy">
                <div class="content">
                    <h1 class="title">Certificate of Participation</h1>
                    <p class="intro">This is to certify that</p>
                    <p class="recipient">' . $name . '</p>
                    <div class="name-rule"></div>
                    <p class="body-copy">has successfully participated in the </p>
                    <p class="program">&ldquo;' . $topic . '&rdquo;</p>
                    <p class="org-line">Organized by The IoT Academy (Ed-tech partner of Uniconverge Technologies Pvt. Ltd., Noida).</p>
                </div>
                <div class="footer">
                    <div class="footer-inner">
                    <table class="meta-table">
                        <tr>
                            <td width="33%" align="center" valign="middle">
                                <div class="meta-value">' . $issue_date . '</div>
                                <div class="meta-line"></div>
                                <div class="meta-label">Issue Date</div>
                            </td>
                            <td width="34%" align="center" valign="middle" style="margin-top:-90px">
                                <img class="stamp" src="' . $stamp . '" alt="Official seal">
                                <p class="brand">The IoT Academy<br>(Uniconverge Technologies Pvt. Ltd.)</p>
                            </td>
                            <td width="33%" align="center" valign="middle">
                                <div class="meta-value">' . $cert_id . '</div>
                                <div class="meta-line"></div>
                                <div class="meta-label">Certification ID</div>
                            </td>
                        </tr>
                    </table>
                    </div>
                    <div class="footer-bar"></div>
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
        $query = $this->db->query("SELECT  * FROM webinar Where status = 0");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }
    public function get_status_data()
    {
        $query = $this->db->query("SELECT  * FROM webinar Where status = 0");
        if ($query->num_rows() > 0)
            return true;
        else
            return false;
    }


    public function insert($data = array())
    {
        if (!empty($data)) {
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
        $query = $this->db->query("SELECT * FROM `webinar` WHERE `id` IN ($Ids) LIMIT 30");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function user_mail_status($ID)
    {
        $query = $this->db->query("UPDATE `webinar` SET `mail_status`=1 WHERE `id` = '$ID'");
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}
