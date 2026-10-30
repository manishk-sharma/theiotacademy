<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MailindustrialCertificate extends CI_Controller{

    function __construct() {

            parent::__construct();
            // Load member model

            $this->load->model('EmailSetupModel');
            $this->load->model('SubjectAndMessageModel');
            $this->load->library('form_validation');
            $this->load->helper('file');
            $this->load->helper('utility_helper');
            $this->load->library('form_validation');
            $this->load->model('EmployeeModel');
            $this->load->model('UserModel');
            $this->load->model('IndustrialVisitCertificateModel');
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
        $data = $this->IndustrialVisitCertificateModel->fetch_member_email(implode(',', $checkid));
        $sent_id = [];
        $failed_id = [];
        foreach ($data as $value) 

        {
            $name = $value->name;
            $email = $value->email;
            $topic = $value->college_name;

            $subject = "Download Your Industrial Visit Certificate | The IoT Academy";
             $lnk1 = base_url('IndustrialVisitCertificate/downloadpdfdetails/'.$value->id);
            $message="<!DOCTYPE html><html><head><meta name='viewport' content='width=device-width, initial-scale=1'><style>.btn {border: none;color: white;padding: 10% 25%;cursor: pointer;text-decoration:none;}.btn:hover {opacity:0.7}.bgi{background-image:url('".$lnk1."');background-size: 200px 120px;background-position:center;background-repeat:no-repeat;width:200px;height:120px;opacity:0.6;}</style></head><body><p style='font-size:17px; margin-top:20px;'> Dear ".$name.",<br><br>
            Congratulations on successfully participating in our Industrial Visit with The IoT Academy! Your certificate of participation is now available for download.</p><br><br>
                  <a style='background:blue;color:white;padding:15px 30px;' href='".$lnk1."'><b>Download</b></a><br><br>
                     
             <p style='font-size:17px;'>
            We’d love to celebrate your achievement with you! Share your certificate on <a href='https://www.linkedin.com/school/theiotacademy/'>LinkedIn</a>, tag us <a href='https://www.linkedin.com/school/theiotacademy/'>@The IoT Academy</a>, and inspire your network. Who knows? Your post might open new opportunities!<br><br> Stay connected with us for more updates, tech insights, and future events:
            </p>
              <p>
                <b>-Follow us on:</b><br>
                <a href='https://www.instagram.com/the_iot_academy/'>Instagram : https://www.instagram.com/the_iot_academy/</a><br>
                <a href='https://www.facebook.com/academyforiot'>Facebook: https://www.facebook.com/academyforiot</a><br>
                <a href='https://www.linkedin.com/school/theiotacademy/'>LinkedIn : https://www.linkedin.com/school/theiotacademy/</a>

              </p>
              <p style='font-size:17px;'>We look forward to seeing your post and welcoming you to more exciting events!</p>
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

                $this->IndustrialVisitCertificateModel->user_mail_status($value->id);

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

