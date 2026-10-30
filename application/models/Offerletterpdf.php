<?php
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Offerletterpdf extends CI_Model
{

    function __construct()
    {
        // Set table name
        $this->table = 'offer_letter_pdf';
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
    $query = $this->db->query("
        SELECT *
        FROM offer_letter_pdf
        WHERE status = 1
        ORDER BY id DESC
        
    ");

    if ($query->num_rows() > 0) {
        return $query->result_array();
    }

    return [];
}

    public function fetch_offerletter_name($offerid)
    {

        $this->db->where('id', $offerid);
        $data = $this->db->get('offer_letter_pdf');
        foreach ($data->result() as $row) {

            $nameresult = $row;
        }

        return $nameresult;
    }

    public function fetch_single_details($offerid)
    {
        $this->db->where('id', $offerid);
        $data = $this->db->get('offer_letter_pdf');
        foreach ($data->result() as $row) {
            $output .= '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            display: block;
        }
        .iol-container {
            padding: 0.3% 2%;
        }
        .iol-header {
            width: 100%;
            position: relative;
        }
         .hesder-image{
            margin-top:-45px;
            margin-left:0px;
            padding-bottom:10px;
            width:30%;
         }
        .iolh-title {
            font-size: 35px;
            font-weight: bolder;
            text-align: center;
        }
        .iolh-address {
            font-size: 18px;
            text-align: center;
            margin: 2px auto;
        }
        .iolmc-title {
            font-size: 32px;
            font-weight: bolder;
            text-align: center;
            text-decoration: underline;
            margin: 15px auto 30px auto;
        }
         .heading-of-tppdd{
             font-size: 17px;
            line-height: 22px;
            margin-bottom:10px;
         }
         .heading-of-tpp{
             font-size: 17px;
            line-height: 25px;
         }
        .iolmc-attributes {
            font-size: 20px;
            font-weight: bolder;
            margin: 10px auto;
        }
        .iolmc-letter-body>div {
            font-size: 17px;
            line-height: 22px;
        }
        .iolmc-letter-body>ol>li {
            font-size: 17px;
        }
        /* InterShip Offer Letter Signature Section*/
        .iolmc-signature>div>img {
            width: 20%;
        }
        .iolmc-signature>div {
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="iol-container" id="content">
        <div class="iol-header">
            <div class="iolh-title"><img class="hesder-image" src="data:image/png;base64,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"/></div>
            <div>
                <div class="iolh-address">C-56/11, Ground floor, Near IT Stellar Park, Sector-62, Noida, U.P. - 201309
                </div>
                <div class="iolh-address">Email: <a
                        href="mailto:support@upskillcampus.com">support@upskillcampus.com</a>,
                    Ph. No. 9354068856 </div>
            </div>
            <hr style="border:1px solid rgb(89, 89, 89)">
        </div>
        <div class="iol-main-content">
            <div class="iolmc-title">Internship Offer Letter</div>
            <div class="iolmc-data">

                <div>
                    <div class="heading-of-tppdd">Date: <b id="iolmc-date"> ' . $row->offer_issue_date . '</b>
                    </div>
                </div>
                <div>
                    <div class="heading-of-tpp">Name: <b id="iolmc-name">' . $row->name . '</b>
                    </div>
                </div>
                <div>
                    <div class="heading-of-tpp">Email: <b> ' . $row->email . '</b>
                    </div>
                </div>
                 <div>
                    <div class="heading-of-tpp">Location: <b id="iolmc-email">Remote</b>
                    </div>
                </div>
                
                <div>
                  
                </div>
            </div>
            <br>
            <div class="iolmc-letter-body">
                <div>Dear <b class="iolmc-name"> ' . $row->name . '</b>,</div>
                <br>
                <div>We are pleased to inform you that <b>Upskill Campus</b> alongwith its industry Partner <b>UniConverge Technologies Pvt. Ltd.</b> has agreed to provide you  internship as <b
                            class="iolmc-domain"> ' . $row->domain . ' Intern</b> </div>
                            <div>Your appointment of service is based on the following terms and conditions.</div><br>
                <ol>
                    <li>
                        The internship shall start from <b class="iolmc-sd-ed">' . $row->startinternship . '</b>
                    </li>
                    <br>
                    <li>
                        <b>Internship: </b> The internship period will be 4 to 6 weeks, starting from the date of joining.
                    </li>
                    <br>
                    <li>
                        <b>Working Hours: </b>
                        The internship runs from 10:00 AM to 6:00 PM.
                    </li>
                    <br>
                </ol>

                <div>
                    On behalf of both the Company, we wish you every success in your position and trust that our
                    relationship will be long and mutually rewarding.
                </div>
                <br>
                <div>
                    Sincerely
                </div>
                <div><b>For Upskill Campus and UniConverge Technologies Pvt. Ltd.</b></div>
            </div>
            <div class="iolmc-signature">
                <div class="iolmc-stamp">
                    <img src="data:image/jpeg;base64,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EDckIDMsAAAACEuGW3GDcgAAAAAAAAcB29PuWIAAAAAAABM9eFMicAAAAAAADMR+0e0AAAAAAAAAADNrs2sUgAAAAABUL+iWmQgAAAAAAAAAABsbP0CMAAAAAAUSULss4cAAAB4gAAAAAHMMMtMAAAAAB0PMxREOg4AQF2gAAAAAAHvsEUAAAAADtIShfIiAB91P0PnrIAACml81WAAAAACsC8xf0kBtz1PYMRdoIAB8AiBYAAAAAA9GtV/sADAIJjsAKUGkACEU0AMAAAAARcPe9IcAAABAaAAAAAAACFBd1UAAABeauEUtZEAAAaJMAQcAAABMcjsicAAA8IAZu+vwu4w21GW1HAAAACtCcILMAAAAABMkLm9g2BON0IAAAAABH3Nj1cAAAAAAAdSv6UhMpQUIAAAAABsCwBCSMAAAAAADXOZlshycHsEAAABdvJpkxBGIAAAAAAC7DOgHm1cmiNGHGELkjlgFWIAAAAAAACQABANAtfw4AAAAAKXtQJHkAAAAAAABNMAAAKEBBWAAAAAAA+MBNIAAAAAAAAAAAAAAADOkYAAAAAAAANOAAAAAAAAAAAAAAAAAAABFNc0k0N9EAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD/8QAAv/aAAwDAQACAAMAAAAQ88888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888884CMiOwMGqu28888888888888888884Sccwy+fBa6km828888888888888886Q8wPzT884b5ZV8eo88888888888886o8JfdfR3rVdJ7xJc+k88888888888+gn087PM+yskyUV95J6qs8888888888Y8xpYoEk88888MEKYN3U4288888888a+ZQbk0e88888888g0b152c88888888I4vt9sc8888888888gwLAeoW888888Rc3sECa888888888888In/L84888888a8VOtoeb8884W88888844z9eg8888886GmhHTBh644cp+y8y8882Cswq888888Ix0yM+W8/dRFiVdPF888+llPsc88888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"/>
                </div>
                <div><b>Prabha Singh</b></div>
                <div><b>HR Manager</b></div>
            </div>
        </div>
    </div>
</body>
</html>';
        }
        return $output;
    }

    public function fetch_single_student_offerlt($name, $email, $finaldmArray)
    {
        $matchcary = array('name' => $name, 'email' => $email);
        $this->db->where($matchcary);
        $this->db->where_in('domain', $finaldmArray);
        $query = $this->db->get("offer_letter_pdf");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return "Your Data Does Not Match. Please Try Again.";
        }
        return false;
    }

    public function user_data()
    {
        $query = $this->db->query("SELECT  * FROM offer_letter_pdf Where status = 0");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }
    public function get_status_data()
    {
        $query = $this->db->query("SELECT  * FROM offer_letter_pdf Where status = 0");
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
        $query = $this->db->query("SELECT * FROM `offer_letter_pdf` WHERE `id` IN ($Ids) ");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }



    public function user_mail_status($ID)
    {
        $query = $this->db->query("UPDATE `offer_letter_pdf` SET `mail_status`=1 WHERE `id` = '$ID'");
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}
