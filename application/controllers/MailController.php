<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MailController extends CI_Controller 

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

    public function index()

    {

      $this->load->view('sample_certificate');

    }

    public function send_certificate()

    {

        //$checkid = $this->input->post("checkID");

        $checkid = [];

        foreach ($this->input->post("checkID") as $value) 

        {

            array_push($checkid, $value["id"]);

        }

        $data = $this->member->fetch_member_email(implode(',', $checkid));

        $sent_id = [];

        $failed_id = [];

        foreach ($data as $value) 

        {

            $name = $value->name;

            $email = $value->email;

            $event_name = explode('/', $value->cert_image);
            //$coursename=$value->course;
            //$subject = $event_name[0]." ".$value->course." certificate";
            $subject = "Download your certificate | Thank you for attending the recent webinar at The IoT Academy";

            $lnk1 = base_url('assets/certificate/'.$value->cert_image);

            $lnk2 = base_url('assets/images/download-solid.svg');

            //$cert_link='<img src="'.$lnk1.'" width="150px" height="80px";>'."<br>";

            $message="<!DOCTYPE html><html><head><meta name='viewport' content='width=device-width, initial-scale=1'><style>.btn {border: none;color: white;padding: 10% 25%;cursor: pointer;text-decoration:none;}.btn:hover {opacity:0.7}.bgi{background-image:url('".$lnk1."');background-size: 200px 120px;background-position:center;background-repeat:no-repeat;width:200px;height:120px;opacity:0.6;}</style></head><body><p style='font-size:17px; margin-top:20px;'> Hi ".$name."<br>
            Thank you for attending the <b>".$value->course."</b><br/><br/> 
             Please download your certificate</p>&nbsp;&nbsp;&nbsp; <a href='".$lnk1."'><b>Download</b></a>

             <p><b>Regards,</b><br/>
              The IoT Academy<br/>
              ANUDAKSH Program Partner<br/>
              <b><i>(ANUDAKSH | An Initiative By IIT Guwahati & RFR Foundation)</i></b></p>
             </body></html>";

            $attach_file = $lnk1;

            $status = $this->userConfirmationMail($name,$email,$subject,$message,$attach_file);

            if ($status==true) 

            {

                $this->member->user_mail_status($value->id);

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



    public function userConfirmationMail($name,$email,$subject,$message,$file)

    {

        

        $from_email = "certificates@theiotacademy.co";

        $to_email = $email;         

        $this->email->from($from_email,'The IoT Academy'); 

        $this->email->to($to_email);

        $this->email->subject($subject); 

        $this->email->message($message);

        //$this->email->attach('https://www.theiotacademy.co/training-cum-internship/iit-guwahati-rfrf-and-the-iot-academy'); 

        if ($this->email->send()) 

        {

            $status = true;

        }

        else

        {

            $status = false;

        }    

        return $status;

    }

}

