<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class WorkshopCertificateController extends CI_Controller {

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
            $this->load->model('AppModel');
            $this->load->model('EmployeeModel');
            $this->load->model('UserModel');
            $this->load->model('StudentModel');
            $this->load->model('WorkshopModel');
            $this->load->library('session');
            $this->load->library('email');
            $this->load->library('pdf');

            }
       
    public function index(){
        try{
        $data = array();
        $data['members'] = $this->WorkshopModel->getRows();
     }
      catch(Exception $e){
        print_r($e);
      }
        $this->load->view('admin/workshopcertificate/index', $data);


    }

    public function import() {
        $data = array(); 
        $memData = array();
        
        if ($this->input->post('importSubmit')) {
            $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
            if ($this->form_validation->run() == true) {
                $insertCount = $updateCount = $rowCount = $notAddCount = 0;
                if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);

                    if (!empty($csvData)) {
                        foreach ($csvData as $row) {
                            $randmcer = 'TIA-WP-' . rand(1000, 1000000);
                            if (empty($row['Name']) || empty($row['Email']) || empty($row['Issuedate']) || empty($row['Topic'])) {
                                $this->session->set_flashdata('error_msg', 'All fields are required.');
                                redirect('workshop-pdf-home');
                                return;
                            }
    
                            $rowCount++;
                            $memData = array(
                                'name' => ucwords(strtolower($row['Name'])),
                                'email' => strtolower($row['Email']),
                                'mobile' => $row['Mobile'],
                                'topic' => $row['Topic'],
                                'college_name' => ucwords(strtolower($row['Collegename'])),
                                'certification_id' => $randmcer,
                                'issue_date' => $row['Issuedate']
                            );
    
                            $updaData = array(
                                'name' => ucwords(strtolower($row['Name'])),
                                'email' => strtolower($row['Email']),
                                'mobile' => $row['Mobile'],
                                'topic' => $row['Topic'],
                                'college_name' => ucwords(strtolower($row['Collegename'])),
                                'issue_date' => $row['Issuedate']
                            );
                            $con = array(
                                'where' => array('email' => $row['Email']),
                                'returnType' => 'count'
                            );
    
                            $prevCount = $this->WorkshopModel->getRows($con);
                            if ($prevCount > 0) {
                                $condition = array('email' => $row['Email']);
                                $update = $this->WorkshopModel->update($updaData, $condition);
    
                                if ($update) {
                                    $updateCount++;
                                }
                            } else {
                                $insert = $this->WorkshopModel->insert($memData);
                                if ($insert) {
                                    $insertCount++;
                                }
                            }
                        }
                        $notAddCount = ($rowCount - ($insertCount + $updateCount));
                        $successMsg = "User import completed. Total Rows: $rowCount | Inserted: $insertCount | Updated: $updateCount | Not Inserted: $notAddCount";
                        $this->session->set_flashdata('success_msg', $successMsg);
                    } else {
                        $this->session->set_flashdata('error_msg', 'CSV file is empty.');
                    }
                } else {
                    $this->session->set_flashdata('error_msg', 'Error on file upload. Please try again.');
                }
            } else {
                $this->session->set_flashdata('error_msg', 'Invalid file. Please upload only CSV files.');
            }
        }
    
        redirect('workshop-pdf-home');
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

    public function view_result()

    {
        $data = array();
        $data['members'] = $this->WorkshopModel->get_data();
        $this->load->view('admin/workshopcertificate/result', $data);
    }

    public function store() {

        if($this->input->post('Submit'))
           {
            $data = array();
            $data = $this->WorkshopModel->get_status_data();
        }

        else
        {
            redirect('workshop-pdf-home');
        }
    }

    public function certificatepdfdetails($ID)
     {
        if($this->uri->segment(3)){

          $offerid=$this->uri->segment(3);
          $html_content =$this->WorkshopModel->fetch_single_details($offerid);
             $this->dompdf->loadHtml($html_content);
              $this->dompdf->setPaper('A4', 'landscape');
             $this->dompdf->render();
             $this->dompdf->stream("certificate.pdf", array("Attachment"=>0));
     }
  }

  public function downloadpdfdetails($ID)
     {
        if($this->uri->segment(3)){

          $offerid=$this->uri->segment(3);
          $html_content =$this->WorkshopModel->fetch_single_details($offerid);
          $offer_name =$this->WorkshopModel->fetch_certificate_name($offerid);
          // echo $offer_name->name;exit;
             $this->dompdf->loadHtml($html_content);
             $this->dompdf->setPaper('A4', 'landscape');
             $this->dompdf->render();
             $this->dompdf->stream($offer_name->name, array("Attachment"=>1));
     }
  }
}  