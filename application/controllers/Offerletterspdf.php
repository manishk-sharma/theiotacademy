<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;

class Offerletterspdf extends CI_Controller {

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
            $this->load->library('pdf');

            }

            

    public function index(){
        try{
        $data = array();
        $data['members'] = $this->Offerletterpdf->getRows();
     }
      catch(Exception $e){
        print_r($e);
      }
        $this->load->view('admin/offerletterpdf/index', $data);


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
                        foreach($csvData as $row)

                        { 

                         if ($row['Name']=='' || $row['Email']=='' || $row['Mobile']=='' || $row['Organization']=='' || $row['Startinternship']=='' || $row['Domain']=='' || $row['Offerissuedate']=='') {
                             
                             $this->session->set_flashdata('success_msg', 'All Field Are Required');
                             redirect('offer-pdf-home');
                         }
                         else{
                            $rowCount++;
                       
                        $memData = array(
                            'name' => ucwords(strtolower($row['Name'])),
                            'email' => strtolower($row['Email']),
                            'mobile' => $row['Mobile'],
                            'organization' => ucwords(strtolower($row['Organization'])),
                            'startinternship' => $row['Startinternship'],
                            'endinternship' => ' ',
                            'domain' => $row['Domain'],
                            'college_name' => '',
                            'offer_issue_date' => $row['Offerissuedate'],
                            'stipend' =>''

                            );

                            // Check whether email already exists in the database

                            $con = array(

                                'where' => array(
                                    'email' => $row['Email']
                                ),

                                'returnType' => 'count'

                            );

                            $prevCount = $this->Offerletterpdf->getRows($con);
                            if($prevCount > 0){

                                // Update member data

                                $condition = array('email' => $row['Email']);
                                $update = $this->Offerletterpdf->update($memData, $condition);

                                if($update){
                                    $updateCount++;
                                }

                            }else{

                                // Insert member data

                                $insert = $this->Offerletterpdf->insert($memData);
                                if($insert){
                                    $insertCount++;
                                }
                            }
                           $dynamic_no++;
                        }
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

        redirect('offer-pdf-home');

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
         
        $data['members'] = $this->Offerletterpdf->get_data();
        $this->load->view('admin/offerletterpdf/result', $data);
    }

    public function store() {

        if($this->input->post('Submit'))
           {
            $data = array();
            $data = $this->Offerletterpdf->get_status_data();
        }

        else
        {
            redirect('offer-pdf-home');
        }
    }

    public function offerpdfdetails($ID)
     {
        if($this->uri->segment(3)){
        
          $offerid=$this->uri->segment(3);
          $html_content =$this->Offerletterpdf->fetch_single_details($offerid);
             $this->dompdf->loadHtml($html_content);
             $this->dompdf->setPaper('A4', 'portrait');
             $this->dompdf->render();
             
             $this->dompdf->stream("offerletter.pdf", array("Attachment"=>0));
     }
  }

    public function downloadpdfdetails($ID)
    {
        if($this->uri->segment(3)) {
            $offerid=$this->uri->segment(3);
            $html_content =$this->Offerletterpdf->fetch_single_details($offerid);
            $offer_name =$this->Offerletterpdf->fetch_offerletter_name($offerid);
             $this->dompdf->loadHtml($html_content);
             $this->dompdf->setPaper('A4', 'portrait');
             $this->dompdf->render();

             $this->dompdf->stream($offer_name->name, array("Attachment"=>1));
        }
    }

    public function dwnselectedpdfdetails()
    {
        $folder = 'PDF_' . time();
        $path = APPPATH . '../uploads/pdf/';
        mkdir($path . $folder, 0777);

        $path = $path . $folder . '/';

        $checkid = $this->input->post("checkZip");

        $checkid = rtrim($checkid, ",");
        $data = $this->Offerletterpdf->fetch_member_email($checkid);
        
        foreach ($data as $value) 
        {
            $this->savePDF($value->id, $path);
        }

        $this->zipFiles($path, $folder);
    }

    // Save PDF into folder
    public function savePDF($offerid, $path)
    {
        require_once APPPATH . 'libraries/dompdf/autoload.inc.php';

        $dompdf = new DOMPDF();
        $html_content =$this->Offerletterpdf->fetch_single_details($offerid);
        $offer_name =$this->Offerletterpdf->fetch_offerletter_name($offerid);

        $dompdf->loadHtml($html_content);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        file_put_contents($path . $offer_name->name . time() . ".pdf", $dompdf->output());
    }

    
    public function zipFiles($path, $folder) {
        $absoluteFilePath = $path . $folder . '.zip';
        // Remove any trailing slashes from the path
        $path = rtrim($path, '\\/');

        // Get real path for our folder
        $rootPath = realpath($path);

        // Initialize archive object
        $zip = new ZipArchive();
        $zip->open($absoluteFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Create recursive directory iterator
        /** @var SplFileInfo[] $files */
        $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($rootPath),RecursiveIteratorIterator::LEAVES_ONLY);

        foreach ($files as $file)
        {
            // Skip directories (they would be added automatically)
            if (!$file->isDir())
            {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);

                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }

        // Zip archive will be created only after closing object
        $zip->close();

        echo json_encode(["message"=> 'success', "filename" => $folder . ".zip", "path" => $folder . '/' . $folder . '.zip']);
    }


    public function user_download_offer_letter(){
        $this->load->view('user-dwn-offer-letter/dwn_offer_letter');
     }
   
     public function Downloaduserofferlt(){
   
        $this->form_validation->set_rules('name','Name','required');
       $this->form_validation->set_rules('email','Email','required');
       $this->form_validation->set_rules('domain','Domain name (Course Name)','required');
         if($this->form_validation->run()==False){
            print_r(json_encode(array('message' => 'error','response'=>validation_errors())));  
          }
          else{
            
             $name=$this->input->post('name');
             $email=$this->input->post('email');
             $domain=$this->input->post('domain');
             $domaindfgfd=explode(',',$domain);
             $finaldmArray = [];
               foreach ($domaindfgfd as $item) {
                   $finaldmArray = array_merge($finaldmArray, explode(",", $item));
               }
               $html_content =$this->Offerletterpdf->fetch_single_student_offerlt($name,$email,$finaldmArray);
               print_r(json_encode(array('message' => 'success','response'=>$html_content))); 
   
          }
         }

}