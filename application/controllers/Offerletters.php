<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Offerletters extends CI_Controller {



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
        try{
        $data = array();
        $data['members'] = $this->Offerletter->getRows();
        $data['status'] = $this->Offerletter->get_status_data();
        $data['template'] = $this->Offerletter->get_template_data();
     }
      catch(Exception $e){
        print_r($e);
      }
        $this->load->view('admin/offerletters/index', $data);


    }

    public function import(){

        $data = array(); 

        $memData = array();

        if($this->input->post('importSubmit')){

            // Form field validation rules

            $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');

            

            // Validate submitted form data

            if($this->form_validation->run() == true){

                $insertCount = $updateCount = $rowCount = $notAddCount = 0;

                

                // If file uploaded

                if(is_uploaded_file($_FILES['file']['tmp_name'])){

                    // Load CSV reader library

                    //$this->load->library('CSVReader');

                    

                    // Parse data from CSV file

                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);

                    

                    // Insert/update CSV data into database

                    if(!empty($csvData)){
                        $dynamic_no=1;
                        // $gencervalue="TIA-LIVE-20220800";
                        foreach($csvData as $row)

                        { $rowCount++;
                           // $gencertificateid=$gencervalue.$dynamic_no;
                            //Prepare data for DB insertion

                        $memData = array(

                            'name' => ucwords(strtolower($row['Name'])),
                            'email' => strtolower($row['Email']),
                            'mobile' => $row['Mobile'],
                            'organization' => ucwords(strtolower($row['Organization'])),
                            'start_internship' => $row['Startinternship'],
                            'end_internship' => ' ',
                            'domain' => $row['Domain'],
                            'offer_issue_date' => $row['Offerissuedate'],
                            'stipend' => ' '

                            );

                            // Check whether email already exists in the database

                            $con = array(

                                'where' => array(
                                    'email' => $row['Email']
                                ),

                                'returnType' => 'count'

                            );

                            $prevCount = $this->Offerletter->getRows($con);

                            if($prevCount > 0){

                                // Update member data

                                $condition = array('email' => $row['Email']);
                                $update = $this->Offerletter->update($memData, $condition);

                                

                                if($update){

                                    $updateCount++;

                                }

                            }else{

                                // Insert member data

                                $insert = $this->Offerletter->insert($memData);

                                

                                if($insert){

                                    $insertCount++;

                                }

                            }
                           $dynamic_no++;
                        }

                        

                        // Status message with imported data count

                        $notAddCount = ($rowCount - ($insertCount + $updateCount));

                        $successMsg = 'Members imported successfully. Total Rows ('.$rowCount.') | Inserted ('.$insertCount.') | Updated ('.$updateCount.') | Not Inserted ('.$notAddCount.')';

                        $this->session->set_flashdata('success_msg', $successMsg);

                    }

                }else{

                    $this->session->set_flashdata('error_msg', 'Error on file upload, please try again.');

                }

            }else{

                $this->session->set_flashdata('error_msg', 'Invalid file, please select only CSV file.');

            }

        }

        redirect('offer-home');

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

    

}