<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MailOfferletterinpdf extends CI_Controller 

{

    function __construct() {

            parent::__construct();
            // Load member model

            $this->load->model('EmailSetupModel');

            $this->load->model('SubjectAndMessageModel');

            // Load form validation library

            $this->load->library('form_validation');

            // Load file helper

            $this->load->helper('file');

            $this->load->helper('utility_helper');

            $this->load->library('form_validation');

            $this->load->model('BatchModel');

            $this->load->model('BatchDaysModel');

            $this->load->model('BatchModel');

            $this->load->model('BatchModel');

            $this->load->model('AppModel');

            $this->load->model('EmployeeModel');

            $this->load->model('UserModel');

            $this->load->model('RegisterModel');

            $this->load->model('StudentModel');

            //$this->load->model('EnquiryModel');

            $this->load->model('PaymentModel');

            $this->load->model('ClassRoomModel');

            $this->load->library('session');

             $this->load->library('email');

            }


    public function send_offerletter()

    {

        //$checkid = $this->input->post("checkID");

        $checkid = [];

        foreach ($this->input->post("checkID") as $value) 
        {
          array_push($checkid, $value["id"]);
        }
        $data = $this->Offerletterpdf->fetch_member_email(implode(',', $checkid));
        $sent_id = [];
        $failed_id = [];
        foreach ($data as $value) 

        {
            $name = $value->name;

            $email = $value->email;

            $event_name = explode('/', $value->offer_image);
            $subject = "Internship Offer Letter - Upskill Campus";

            $lnk1 = base_url('Offerletterspdf/downloadpdfdetails/'.$value->id);

            $message="<!DOCTYPE html><html><head><meta name='viewport' content='width=device-width, initial-scale=1'><style>.btn {border: none;color: white;padding: 10% 25%;cursor: pointer;text-decoration:none;}.btn:hover {opacity:0.7}.bgi{background-image:url('".$lnk1."');background-size: 200px 120px;background-position:center;background-repeat:no-repeat;width:200px;height:120px;opacity:0.6;}</style></head><body><p style='font-size:17px; margin-top:20px;'> Dear ".$name.",<br><br>
            Thank you for registering with upskill campus internship program <br/><br/> 
             Please find the attached internship offer letter.</p><p style='font-size:17px;'>
                 <br>
                 kindly share the offer letter on your Linkedin profile and do tag us at <a href='https://www.linkedin.com/company/upskillcampus/'>https://www.linkedin.com/company/upskillcampus/</a> and at <a href='https://www.linkedin.com/school/theiotacademy/'>https://www.linkedin.com/school/theiotacademy/</a> so that we can comment and give recommendations.</p><br></br>
                <a style='background:blue;color:white;padding:15px 30px;' href='".$lnk1."'><b>Download</b></a><br>
                <br><br>
                <P style='font-size:17px;'>After receiving the offer letter please click on the link below to proceed with the internship.</p><br>
                <a style='background:blue;color:white;padding:15px 30px;' href='https://learn.upskillcampus.com/s/dashboard'><b>start internship</b></a><br><br>
                
                <br><br>

                <br><br>
             <p><b>Regards,</b><br/><br>
              Upskill Campus<br/><br>
              Email: support@upskillcampus.com

             </p>
             </body></html>";
            $attach_file = $lnk1;

            $status = $this->userConfirmationMail($name,$email,$subject,$message,$attach_file);

            if ($status==true) 

            {

                $this->Offerletterpdf->user_mail_status($value->id);

                array_push($sent_id, $value->id);

            }

            else

            {

                array_push($failed_id, $value->id);

            }

        }        

        if (count($checkid) == count($sent_id)) 

        {

            echo "ok";

        }

        else

        {

            echo"fail";

        }

    }



    public function userConfirmationMail($name,$email,$subject,$message,$file,$smtpConfig = 'default')

    {
        
        // $smtpConfigs = [
        //     'default' => [
        //         'protocol'    => 'smtp',
        //         'smtp_host'   => 'mail.upskillcampus.com',
        //         'smtp_port'   => 465,
        //         'smtp_user'   => 'enquiry@upskillcampus.com',
        //         'smtp_pass'   => '!qZfD}w$FSvR',
        //         'smtp_crypto' => 'ssl',
        //         'mailtype'    => 'html',
        //         'charset'     => 'utf-8',
        //         'wordwrap'    => TRUE,
        //         'newline'     => "\r\n",
        //     ]];

        // $smtpConfigs = [
        //     'default' => [
        //         'protocol'    => 'smtp',
        //         'smtp_host'   => 'email-smtp.ap-south-1.amazonaws.com',
        //         'smtp_port'   => 465,
        //         'smtp_user'   => 'AKIAW3MEDUBBT62J34RC',
        //         'smtp_pass'   => 'BHUebWOGMpR1H9FGPudSWCpb+rRLRfvj+05ol37EdSak',
        //         'smtp_crypto' => 'ssl',
        //         'mailtype'    => 'html',
        //         'charset'     => 'utf-8',
        //         'wordwrap'    => TRUE,
        //         'newline'     => "\r\n",
        //     ]];
        
        //08-may-2026
                 
         $smtpConfigs = [
    'default' => [
        'protocol'    => 'smtp',
        'smtp_host'   => 'smtp-relay.brevo.com',
        'smtp_port'   => 587,
        'smtp_user'   => 'academyforiot@gmail.com',
        'smtp_pass'   => 'xsmtpsib-4752ed306632099a805083920ba2568617d4c0197e87879c761c12fe4b8d32ae-hSflzHmrePxMC02T',
        'smtp_crypto' => 'tls',
        'mailtype'    => 'html',
        'charset'     => 'utf-8',
        'wordwrap'    => TRUE,
        'newline'     => "\r\n",
        'crlf'        => "\r\n",
        'validate'    => FALSE,
    ]
];

            if (array_key_exists($smtpConfig, $smtpConfigs)) {
                $config = $smtpConfigs[$smtpConfig];
            } else {
                $config = $smtpConfigs['default'];
            }
    
            $this->email->initialize($config);
            //$from_email = $config['smtp_user'];
        $from_email = "enquiry@upskillcampus.com";
        $to_email = $email;         
        $this->email->from($from_email,'UpSkill Campus'); 
        $this->email->to($to_email);
        // $this->email->cc('placements@sscmrmba.in');
        $this->email->subject($subject); 
        $this->email->message($message);
        if ($this->email->send()) 
        {
            $status = true;
        }

        else{

            $status = false;
        }    

        return $status;

    }

}

