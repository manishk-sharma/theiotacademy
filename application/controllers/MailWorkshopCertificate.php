<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MailWorkshopCertificate extends CI_Controller{

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
            $this->load->model('EmployeeModel');

            $this->load->model('UserModel');
            $this->load->model('WorkshopModel');

            $this->load->model('RegisterModel');

            $this->load->model('StudentModel');
            $this->load->library('session');

             $this->load->library('email');

            }


    public function send_certificate()

    {

        //$checkid = $this->input->post("checkID");

        $checkid = [];

        foreach ($this->input->post("checkID") as $value) 
        {
          array_push($checkid, $value["id"]);
        }
        $data = $this->WorkshopModel->fetch_member_email(implode(',', $checkid));
        $sent_id = [];
        $failed_id = [];
        foreach ($data as $value) 

        {
            $name = $value->name;
            $email = $value->email;
            $topic = $value->topic;

            $subject = "Download Your Workshop Certificate | The IoT Academy";
             $lnk1 = base_url('WorkshopCertificateController/downloadpdfdetails/'.$value->id);
            $message="<!DOCTYPE html><html><head><meta name='viewport' content='width=device-width, initial-scale=1'><style>.btn {border: none;color: white;padding: 10% 25%;cursor: pointer;text-decoration:none;}.btn:hover {opacity:0.7}.bgi{background-image:url('".$lnk1."');background-size: 200px 120px;background-position:center;background-repeat:no-repeat;width:200px;height:120px;opacity:0.6;}</style></head><body><p style='font-size:17px; margin-top:20px;'> Dear ".$name.",<br><br>
            Congratulations on participating in our workshop ".$topic." with The IoT Academy. Your participation certificate is now available for download. Click the download button below to access it.<br><br>
                  <a style='background:blue;color:white;padding:15px 30px;' href='".$lnk1."'><b>Download</b></a><br><br>
                     
             </p><p style='font-size:17px;'>
            Thank you for attending our workshop. We hope for your participation in future events too.

                 </p>
                <br><br>
             <p><b>Best Regards,</b><br/><br>
              The IoT Academy<br/>
              Email: info@theiotacademy.co
             <br/>
              

             </p>
             </body></html>";

            $attach_file = $lnk1;

            $status = $this->userConfirmationMail($name,$email,$subject,$message,$attach_file);

            if ($status==true) 

            {

                $this->WorkshopModel->user_mail_status($value->id);

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



    public function userConfirmationMail($name,$email,$subject,$message,$file, $smtpConfig = 'default')

    {
     
        $from_email = "enquiry@theiotacademy.co";
        $to_email = $email;         
        $this->email->from($from_email,'The IoT Academy'); 
        $this->email->to($to_email);
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

