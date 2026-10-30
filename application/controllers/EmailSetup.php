<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EmailSetup extends CI_Controller {

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

        public function index(){
            $data = array();
            // Get messages from the session
            if($this->session->userdata('success_msg')){
                $data['success_msg'] = $this->session->userdata('success_msg');
                $this->session->unset_userdata('success_msg');
            }

            if($this->session->userdata('error_msg')){
                $data['error_msg'] = $this->session->userdata('error_msg');
                $this->session->unset_userdata('error_msg');
            }

            // Get rows
            $data['CsvRecords'] = $this->EmailSetupModel->getRows();
            $data['ActiveRecord']=$this->EmailSetupModel->getActiveidForSendEmail();

            // Load the list page view
            $this->load->view('admin/emailsetup/emailmanage', $data);
        }

        public function csvMsgFile()

        {

           $this->load->view('admin/emailsetup/csvMsgFile');

        }

        public function import(){

            $data = array();
            $memData = array();

            // If import request is submitted
            if($this->input->post('importSubmit')){
                $subjecterrmsg=array(
                        'required'=>'Subject Cannot Be Empty.') ;
                $messageerrmsg=array(
                        'required'=>'Message Cannot Be Empty.') ;
                $fileerrormsg=array(
                    'callback_file_check'=>'Invalid file, please select only CSV file.');
                // Form field validation rules
                $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check',$fileerrormsg);
                $this->form_validation->set_rules('subject','Subject','required',$subjecterrmsg);
                $this->form_validation->set_rules('message','Message','required',$messageerrmsg);
                // Validate submitted form data

                if($this->form_validation->run() == true){
                    $subject=$this->input->post('subject');
                    $message=$this->input->post('message');
                    $this->SubjectAndMessageModel->insertData($subject,$message);
                    $insertCount = $updateCount = $rowCount = $notAddCount = 0;
                    if(is_uploaded_file($_FILES['file']['tmp_name'])){
                        // Load CSV reader library
                        $this->load->library('CSVReader');
                        // Parse data from CSV file
                        $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                        if(!empty($csvData)){
                            foreach($csvData as $row){ $rowCount++;
                                $memData = array(
                                    'name' => $row['Name'],
                                    'email' => $row['Email'], 
                                );

                                // Check whether email already exists in the database

                                $con = array(
                                    'where' => array(
                                        'email' => 'abc@gmail.com'
                                    ),

                                    'returnType' => 'count'

                                );

                                $prevCount = $this->EmailSetupModel->getRows($con);

                                if($prevCount > 0){

                                    $condition = array('email' => $row['Email']);
                                    $update = $this->EmailSetupModel->update($memData, $condition);

                                    if($update){

                                        $updateCount++;

                                    }

                                }else{

                                    $insert = $this->EmailSetupModel->insert($memData);

                                    if($insert){
                                        $insertCount++;
                                    }
                                }
                            }

                            // Status message with imported data count
                            $notAddCount = ($rowCount - ($insertCount + $updateCount));
                            $successMsg = 'Members imported successfully. Total Rows ('.$rowCount.') | Inserted ('.$insertCount.') | Updated ('.$updateCount.') | Not Inserted ('.$notAddCount.')';
                            $this->session->set_userdata('success_msg', $successMsg);

                        }

                    }else{

                        $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');

                    }

                }else{

                    $this->session->set_userdata('error_msg',validation_errors());

                }

            }

            redirect('aemail');

        }


    /*

     * Callback function to check file value and type during validation

     */

    public function file_check($str){

        $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $fileAr = explode('.', $_FILES['file']['name']);
            $ext = end($fileAr);
            if(($ext == 'csv') && in_array($mime, $allowed_mime_types)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only CSV file to upload.');
                return false;

            }

        }else{
            $this->form_validation->set_message('file_check', 'Please select a CSV file to upload.');
            return false;

        }

    }

    public function userConfirmationMail($email,$name,$subject,$message){

        $from_email = "enquiry@theiotacademy.co";

        $to_email = $email;
        $this->email->from($from_email,'The IoT Academy'); 
        $this->email->to($to_email);

        $this->email->subject($subject); 
        $message="<p style='font-size:17px; margin-top:-20px;'> Hello ".$name.",
        <br>".$message;
        $this->email->message($message); 
           if ($this->email->send()) {
                $status = true;
           }else{

                $status = false;

           }    
      return $status;

    }

    public function sendMail(){

      $csvData=$this->EmailSetupModel->getActiveidForSendEmail();
      $subAndMsgData=$this->SubjectAndMessageModel->getSubMsgForSendEmail();

      $subject=$subAndMsgData['subject'];
      $message=$subAndMsgData['message'];
      if(count($csvData)>0){

        $counter=0;
        foreach ($csvData as $row) {
          $email=$row['email'];
          $name=$row['name'];
          $id=$row['id'];
          $mailStatus=$this->userConfirmationMail($email,$name,$subject,$message); 
          if($mailStatus){
            $status=$this->EmailSetupModel->changeUserStatus($id,$email,$name);

          }
          $counter++;
        }

        $this->session->set_userdata('success_msg','Email send To '.$counter.' Email IDs');

      }else{

        $this->session->set_userdata('error_msg', 'Email Id Not Found.');
        echo false;

      }
       // redirect('aemail');

    }

    public function deleteTableRecord()

    {

       $count=$this->EmailSetupModel->getRows();

       if($count && count($count)>0){

            $status=$this->EmailSetupModel->truncateTable();

            if($status){

                $this->session->set_userdata('success_msg','record deleted');

            }else{



                $this->session->set_userdata('error_msg', 'record not deleted try again!');

              }

        }else{

              $this->session->set_userdata('error_msg', 'no record exist!');

        }

       redirect('aemail');

    } 

    public function upload_ckeditor_img()

    {

        if ($_FILES['upload']['name']) 

        {

            $addr =  base_url();

            $file = $_FILES['upload']['tmp_name'];

            $file_name = $_FILES['upload']['name'];

            $file_name_arr = explode('.', $file_name);

            $extension = end($file_name_arr);

            $new_img_name = rand().'.'.$extension;

            $allowed_extension = array('jpg','gif','png');

            if (in_array($extension, $allowed_extension)) 

            {

                move_uploaded_file($file,upload_path().'/emaildata/'.$new_img_name);

                $function_number = $_GET['CKEditorFuncNum'];

                $url = $addr.upload_path().'/emaildata/'.$new_img_name;

                $message = '';

                echo "<script>window.parent.CKEDITOR.tools.callFunction('".$function_number."','".$url."','".$message."');</script>";



            }

        }

    }   


}