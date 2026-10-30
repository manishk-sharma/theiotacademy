<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NewCertificatePdfModel extends CertificatePdfModel
{
    
    private $hasQrTokenColumn = null;

    function __construct()
    {
        // Set table name
        $this->table = 'new_certificate_pdf';
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

    

    private function certificate_image_data($relativePath)
    {
        $filePath = FCPATH . ltrim(str_replace('/', DIRECTORY_SEPARATOR, $relativePath), DIRECTORY_SEPARATOR);
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        if ($extension === 'webp' && function_exists('imagecreatefromwebp')) {
            $image = @imagecreatefromwebp($filePath);
            if ($image) {
                ob_start();
                imagepng($image);
                $imageData = ob_get_clean();
                imagedestroy($image);
                return 'data:image/png;base64,' . base64_encode($imageData);
            }
        }

        $imageData = @file_get_contents($filePath);
        return $imageData === false ? '' : 'data:image/' . $extension . ';base64,' . base64_encode($imageData);
    }
    public function get_data()
    {
        $query = $this->db
            ->where('status', 1)
            ->order_by('id', 'DESC')
            ->get($this->table);

        return $query->num_rows() > 0 ? $query->result_array() : false;
    }
    // New certificates use the Training cum Internship PDF design supplied for this module.
    public function fetch_single_details($offerid)
    {
        $this->db->where('id', $offerid);
        $data = $this->db->get($this->table);

        // ── Images base64 (loop se bahar — ek baar load ho) ──────────────────

        // Use local files and convert WEBP assets to PNG for DOMPDF compatibility.
        $base64 = $this->certificate_image_data('assets/dit/images/certificate_templates/training-cum-internship-template.webp');
        $base_svg = $this->certificate_image_data('assets/dit/images/certificate_templates/flipsvg.png');
        $base_svg3 = $this->certificate_image_data('assets/dit/images/certificate_templates/neeli-patti.png');
        $base_signature1 = $this->certificate_image_data('assets/dit/images/certificate_templates/signature1.webp');
        $base_signature2 = $this->certificate_image_data('assets/dit/images/certificate_templates/signature2.webp');

        $output = '';
        foreach ($data->result() as $row) {

            $name       = htmlspecialchars($row->name);
            $domain     = htmlspecialchars($row->domain_name);
            $start_date = htmlspecialchars($row->course_start_date);
            $end_date   = htmlspecialchars($row->course_end_date);
            $issue_date = htmlspecialchars($row->issue_date);
            $certificateno = htmlspecialchars($row->certification_id);

           // Dynamic QR code pointing to certificate-scan-verify/{qr_token}
            $qr_token   = $this->ensure_qr_token($row->id);
            if (empty($qr_token)) {
                $qr_token = !empty($row->qr_token) ? $row->qr_token : $row->certification_id;
            }
            $verify_url = 'https://www.theiotacademy.co/certificate-scan-verify/' . urlencode($qr_token);
            $qr_api_url = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . urlencode($verify_url);
            $qr_image   = @file_get_contents($qr_api_url);
            $base644    = $qr_image ? 'data:image/png;base64,' . base64_encode($qr_image) : '';

            $output .= <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Abhaya+Libre:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

html {
    margin: 0;
    padding: 0;
    width: 297mm;
    height: 210mm;
    overflow: hidden;
}

body {
    margin: 0 !important;
    padding: 0 !important;
    width: 297mm;
    height: 210mm;
    overflow: hidden;
    background: white;
    font-family: "Abhaya Libre", Georgia, serif;
}

@page {
    margin: 0;
    padding: 0;
    size: 297mm 210mm;  /* A4 landscape exact size */
}
        p, h1, h2, h3, h4, h5, h6 { padding: 0; margin: 0; }

        /* ── Container ── */
        .certificate-container {
            position: relative;
            width: 297mm;
    height: 210mm;
            margin: 0 !important;
             overflow: hidden;  
        }
        .certificate-container img.template {
            width: 100%;
             height: 210mm;  /* auto ki jagah exact height */
            display: block;
        }
        .certificate-content {
            position: absolute;
            left: -50px;
            top: 15px;
            padding: 120px 50px 80px 50px;
            width: 100%;
            height: auto;
            text-align: center;
        }

        /* ── Title ── */
        h1 {
            margin-bottom: 8px;
            font-size: 40px;
            font-family: "Abhaya Libre", Georgia, serif;
        }

        /* ── h3 arrow row: TABLE (flex PDF mein nahi chalta) ── */
        .h3-table {
            margin: 0 auto 17px auto;
        }
        .h3-table td {
            vertical-align: middle;
        }
        .h3-table .arrow-img {
            height: 15px;
            width: auto;
            display: block;
        }
        .h3-table .h3-text {
            font-size: 20px;
            font-weight: 400;
            padding: 0 10px 2px 10px;
            white-space: nowrap;
            font-family: "Abhaya Libre", Georgia, serif;
        }

        /* ── "This is to certify that" ── */
        .tocertify-text {
            position: relative;
            display: inline-block;
        }
        .tocertify-text img {
            height: 24px;
            width: auto;
            display: block;
        }
        .tocertify-text span {
            position: absolute;
            top:0;
            left:0;
            transform: translate(25% , -25%);
            color: #ffffff;
            font-weight: 400;
            font-size: 17px;
            white-space: nowrap;
            font-family: "Abhaya Libre", Georgia, serif;
        }

        /* ── Name ── */
        .name-of-candidate {
            margin-top: 8px;
            font-size: 40px;
            font-weight: 800;
            font-family: "Abhaya Libre", Georgia, serif;
        }
        .underline-lg {
            display: inline-block;
            margin: 8px auto 0 auto;
            width: 447px;
            height: 2px;
            background: #696464;
        }
        .underline-sm {
            width: 220px;
            height: 2px;
            background: #696464;
            margin: 0 auto;
        }

        /* ── Body text ── */
        .certification-main-text {
            margin: 8px auto 0 auto;
            text-align: center;
            font-size: 15px;
            max-width: 600px;
            line-height: 1.6;
            font-family: "Abhaya Libre", Georgia, serif;
        }

        /* ── Footer: TABLE (flex PDF mein nahi chalta) ── */
        .footer-table {
            margin: 8px auto 0 auto;
            padding: 0px 200px;
            width: 100%;
            max-width: 600px;
            text-align: center; 

        }
        .footer-table td {
            vertical-align: bottom;
            text-align: center;
            padding: 0 6px;
        }
        .issue-date-val {
            font-size: 15px;
            font-weight: 800;
            font-family: "Abhaya Libre", Georgia, serif;
        }
        .issue-date-label {
            display: block;
            font-size: 12px;
            margin-top: 4px;
            font-family: "Abhaya Libre", Georgia, serif;
        }
        .signature1 { height: 96px; width: auto; }
        .signature2 { height: 70px; width: auto; }
        .designation {
            font-size: 12px;
            margin-top: 4px;
            font-family: "Abhaya Libre", Georgia, serif;
        }
        .designation strong {
            font-size: 14px;
            font-weight: 800;
            display: block;
        }

        /* ── QR ── */
        
        .verify-qr {
            position: absolute;
            left: 50px;
            bottom:70px;
            border: 1px solid #323D90;
            border-radius: 5px;
            background: #f7f7f7;
            text-align: center;
            
        }

        .verify-qr img {
            height: 70px;
            width: auto;
            vertical-align: middle;
        }
        .certificate-code{
            position:absolute;
            left: 50px;
            bottom: 50px;
        }
        /* flip utility */
        .flip { transform: scaleX(-1); }

    </style>
</head>

<body style="margin:0; padding:0; width:297mm; height:210mm; overflow:hidden;">
    <div class="certificate-container" style="position:relative; width:100%; height:100%; page-break-inside:avoid; display:block;">

        <img src="$base64" alt="Certificate" class="template" />

        <div class="certificate-content">

            <h1>CERTIFICATE OF TRAINING</h1>

            <!-- Arrow row: TABLE not flex -->
            <table class="h3-table" cellpadding="0" cellspacing="0" align="center">
                <tr>
                    <td align="right">
                        <img src="$base_svg" class="arrow-img flip" alt="" />
                    </td>
                    <td class="h3-text">Training cum Internship Program</td>
                    <td align="left">
                        <img src="$base_svg" class="arrow-img" alt="" />
                    </td>
                </tr>
            </table>

            <!-- "This is to certify that" banner -->
            <p class="tocertify-text">
                <img src="$base_svg3" alt="" />
                <span>This is to certify that</span>
            </p>

            <!-- Name -->
            <div class="name-of-candidate">$name</div>
            <div class="underline-lg"></div>

            <!-- Body text -->
            <div class="certification-main-text">
                has successfully completed a <strong>6 Weeks Training cum Internship</strong> in $domain
                at <strong>"UniConverge Technologies Pvt. Ltd."</strong> from
                <strong>$start_date to $end_date.</strong>
                <br /><br />
                During this period, the candidate demonstrated dedication, enthusiasm, and a keen interest in
                developing practical knowledge and industry-relevant skills in the field of
                <strong>$domain.</strong>
                We wish them all the best for their future endeavors.
            </div>

            <!-- Footer: TABLE not flex -->
            <table class="footer-table" cellpadding="" cellspacing="0">
                <tr>
                    <td style="width:33%; vertical-align:bottom; position:relative; bottom:60px; margin-top:-20px; padding: 0 0 28px 0;">
                        <div class="issue-date-val">$issue_date</div>
                        <div class="underline-sm"></div>
                        <span class="issue-date-label">Issue Date</span>
                    </td>
                    <td style="width:33%; vertical-align:middle;">
                        <img class="signature1" src="$base_signature1" alt="Signature" />
                    </td>
                    <td style="width:33%; vertical-align:bottom;">
                        <img class="signature2" src="$base_signature2" alt="Signature" /><br/>
                        <div class="underline-sm"></div>
                        <div class="designation">
                            <strong>Kaushlendra Singh Sisodia</strong>
                            Director, UniConverge Technologies Pvt. Ltd.<br/>
                            Chief Mentor, The IoT Academy
                        </div>
                    </td>
                </tr>
            </table>

        </div>

        <!-- QR Code -->
        <div class="verify-qr" style="display:flex; justify-content:center; align-items:center; padding:10px; ">
            <img src="$base644" alt="Verify" style="margin:auto;" />
        </div>
        <p class="certificate-code">$certificateno</p>

    </div>
</body>
</html>
HTML;
        }
        return $output;
    }

    public function user_data()
    {
        $query = $this->db->query("SELECT * FROM new_certificate_pdf Where status = 0");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    public function get_status_data()
    {
        $query = $this->db->query("SELECT * FROM new_certificate_pdf Where status = 0");
        if ($query->num_rows() > 0)
            return true;
        else
            return false;
    }

    public function insert($data = array())
    {
        if (!empty($data)) {
            if ($this->has_qr_token_column() && (!array_key_exists('qr_token', $data) || empty($data['qr_token']))) {
                $data['qr_token'] = $this->generate_unique_qr_token();
            }
            if (!array_key_exists("created", $data)) {
                $data['created'] = date("Y-m-d H:i:s");
            }
            if (!array_key_exists("updated", $data)) {
                $data['updated'] = date("Y-m-d H:i:s");
            }
            $insert = $this->db->insert($this->table, $data);
            return $insert ? $this->db->insert_id() : false;
        }
        return false;
    }
public function getVerifiedMember($certificate_id)
{
    return $this->db
        ->where('certification_id', trim($certificate_id))
        ->where('status', 1)
        ->get('certificate_pdf')
        ->result();
}

    public function update($data, $condition = array())
    {
        if (!empty($data)) {
            if ($this->has_qr_token_column() && (!array_key_exists('qr_token', $data) || empty($data['qr_token'])) && !empty($condition)) {
                $existing = $this->db->select('id, qr_token')
                    ->where($condition)
                    ->limit(1)
                    ->get($this->table)
                    ->row_array();

                if (!empty($existing) && empty($existing['qr_token'])) {
                    $data['qr_token'] = $this->generate_unique_qr_token();
                }
            }
            if (!array_key_exists("updated", $data)) {
                $data['updated'] = date("Y-m-d H:i:s");
            }
            $update = $this->db->update($this->table, $data, $condition);
            return $update ? true : false;
        }
        return false;
    }

    public function fetch_member_email($Ids)
    {
        $query = $this->db->query("SELECT * FROM `new_certificate_pdf` WHERE `id` IN ($Ids) LIMIT 30");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function user_mail_status($ID)
    {
        $query = $this->db->query("UPDATE `new_certificate_pdf` SET `mail_status`=1 WHERE `id` = '$ID'");
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function insert_manual_certificate_detail_for_verfication($data)
    {
        if ($this->has_qr_token_column() && (!array_key_exists('qr_token', $data) || empty($data['qr_token']))) {
            $data['qr_token'] = $this->generate_unique_qr_token();
        }
        $this->db->insert('new_certificate_pdf', $data);
        return $this->db->insert_id();
    }

    public function isextis_certification_id($certification_id)
    {
        $this->db->where('certification_id', $certification_id);
        $query = $this->db->get("new_certificate_pdf");
        return $query->num_rows();
    }

    public function get_manual_data_Rows()
    {
        $this->db->where('manual_add', 'true');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('new_certificate_pdf');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    public function get_by_qr_token($qr_token)
    {
        if ($this->has_qr_token_column()) {
            $this->db->where('qr_token', $qr_token);
            $query = $this->db->get('new_certificate_pdf');
            if ($query->num_rows() > 0) {
                return $query->row_array();
            }
        }

        $this->db->where('certification_id', $qr_token);
        $query = $this->db->get('new_certificate_pdf');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }

        return false;
    }
}