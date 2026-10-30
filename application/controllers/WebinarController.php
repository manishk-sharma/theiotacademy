<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class WebinarController extends CI_Controller
{

    function __construct()
    {

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
        //$this->load->model('EnquiryModel');
        $this->load->model('WebinarModel');
        $this->load->library('session');
        $this->load->library('email');
        $this->load->library('pdf');
    }

    // public function iotoff_certificate_verify(){

    //     $this->load->view('iotuserverifycertificate');

    // }  
    public function iotuser_verified_certimem()
    {
        $this->form_validation->set_rules('serialno', 'Certification ID', 'required');
        if ($this->form_validation->run()) {
            $certificate_id = $this->input->post('serialno');

            $data = $this->WebinarModel->getVerifiedMember($certificate_id);


            if ($data) {

                $output = '';
                $output .= '<div class="row post mb-50 ">';
                foreach ($data as $result) {
                    $name = $result->name;
                    $certificate_id = $result->certification_id;
                    $domain_name = $result->domain_name;
                    $email = $result->email;
                    $issue_date = $result->issue_date;
                    $acronym = substr($name, 0, 1);


                    // Creating HTML structure 

                    $output .= '<div class="col-lg-12 text-center">
                        <div class="">
                            <div class="verif-ups-images">
                            <img src="' . base_url() . 'assets/images/the-iot-logo-new.webp">
                            </div>
                            <div class="blog-content p-3">
                               <h4 class="text-success">Validation Successful</h4>
                                <p class="mt-3 mb-3"> The certificate with Certification id <b>' . $certificate_id . '</b> has been issued to <b>' . $name . ' </b>for the Domain Name <b>' . $domain_name . '</b> on <b>' . $issue_date . '</b> </p>
                                <div class="nameemb"><p class="fstppf"><span class="firstnamel">' . $acronym . '</span> </p><p>' . $name . '<br> ' . $email . '</p></div>
                                
                            </div>
                        </div>
                    </div>';
                }
                //echo $output.'</div>';
                $resrtd = $output . '</div>';
                print_r(json_encode(['message' => 'success', 'response' => $resrtd]));
            } else {
                print_r(json_encode(['message' => 'notmatch', 'response' => "<h2 class='text-center mt-4 mb-3'>Record Not Found!</h2>"]));
            }
        } else {
            print_r(json_encode(array('message' => 'error', 'response' => validation_errors())));
        }
    }

    // public function verify_certificate(){

    //     $this->load->view('admin/certificatepdf/verifycertificate');
    // }

    // public function verified_member(){

    //     $this->form_validation->set_rules('serialno','Certification ID','required');
    //     if($this->form_validation->run()){
    //         $certificate_id=$this->input->post('serialno');

    //     $data = $this->WebinarModel->getVerifiedMember($certificate_id);


    //              if ($data) {

    //     $output = '';
    //        $output.='<div class="row post mb-50 ">';
    //             foreach($data as $result){
    //                 $name = $result->name;
    //                 $certificate_id=$result->certification_id;
    //                 $domain_name=$result->domain_name;
    //                 $email=$result->email;
    //                 $issue_date=$result->issue_date;
    //                 $acronym = substr($name, 0, 1);


    //                 // Creating HTML structure 

    //                 $output.='<div class="col-lg-12 text-center">
    //                     <div class="">
    //                         <div class="verif-ups-images">
    //                         <img src="'.base_url().'assets/images/upskill-logo-new.png" >
    //                         </div>
    //                         <div class="blog-content p-3">
    //                            <h4 class="text-success">Validation Successful</h4>
    //                             <p class="mt-3 mb-3"> The certificate with Certification id <b>'.$certificate_id.'</b> has been issued to <b>'.$name.' </b>for the internship <b>'.$domain_name.'</b> on <b>'.$issue_date.'</b> </p>
    //                             <div class="nameemb"><p class="fstppf"><span class="firstnamel">'.$acronym.'</span> </p><p>'.$name.'<br> '.$email.'</p></div>

    //                         </div>
    //                     </div>
    //                 </div>';        
    //             }
    //    $resrtd=$output.'</div>';
    //    print_r(json_encode(['message' => 'success','response'=>$resrtd]));
    //  }
    //  else{
    //     print_r(json_encode(['message' => 'notmatch','response'=>"<h2 class='text-center mt-4 mb-3'>Record Not Found!</h2>"]));
    //  }

    //    }
    //    else{
    //         print_r(json_encode(array('message' => 'error','response'=>validation_errors())));

    //     }     
    // }


    public function index()
    {
        try {
            $data = array();
            $data['members'] = $this->WebinarModel->getRows();
        } catch (Exception $e) {
            print_r($e);
        }
        $this->load->view('admin/webinarcertificate/index', $data);
    }

    public function import()
    {
        $data = array();
        $memData = array();

        if ($this->input->post('importSubmit')) {
            // Form field validation rules
            $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');

            // Validate submitted form data
            if ($this->form_validation->run() == true) {
                $insertCount = $updateCount = $rowCount = $notAddCount = 0;

                // Check if file is uploaded
                if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                    // Parse data from CSV file
                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);

                    // Check if CSV data is not empty
                    if (!empty($csvData)) {
                        foreach ($csvData as $row) {
                            $randmcer = 'TIA-LIVE-' . rand(1000, 1000000);

                            // Validate required fields
                            if (empty($row['Name']) || empty($row['Email']) || empty($row['Issuedate']) || empty($row['Topic'])) {
                                $this->session->set_flashdata('error_msg', 'All fields are required.');
                                redirect('webinar-pdf-home');
                                return;
                            }

                            $rowCount++;

                            // Prepare data for insertion or update
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

                            // Check whether email already exists in the database
                            $con = array(
                                'where' => array('email' => $row['Email']),
                                'returnType' => 'count'
                            );

                            $prevCount = $this->WebinarModel->getRows($con);

                            // Update or insert data based on existence
                            if ($prevCount > 0) {
                                $condition = array('email' => $row['Email']);
                                $update = $this->WebinarModel->update($updaData, $condition);

                                if ($update) {
                                    $updateCount++;
                                }
                            } else {
                                $insert = $this->WebinarModel->insert($memData);
                                if ($insert) {
                                    $insertCount++;
                                }
                            }
                        }

                        // Status message with import summary
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

        redirect('webinar-pdf-home');
    }




    /*

     * Callback function to check file value and type during validation

     */

    public function file_check($str)
    {

        $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {

            $mime = get_mime_by_extension($_FILES['file']['name']);

            $fileAr = explode('.', $_FILES['file']['name']);

            $ext = end($fileAr);

            if (($ext == 'csv') && in_array($mime, $allowed_mime_types)) {

                return true;
            } else {

                $this->form_validation->set_message('file_check', 'Please select only CSV file to upload.');

                return false;
            }
        } else {

            $this->form_validation->set_message('file_check', 'Please select a CSV file to upload.');
            return false;
        }
    }

    public function view_result()

    {
        $data = array();
        $data['members'] = $this->WebinarModel->get_data();
        $this->load->view('admin/webinarcertificate/result', $data);
    }

    public function store()
    {

        if ($this->input->post('Submit')) {
            $data = array();
            $data = $this->WebinarModel->get_status_data();
        } else {
            redirect('webinar-pdf-home');
        }
    }

    private function configure_certificate_pdf()
    {
        $options = $this->dompdf->getOptions();
        $options->set('dpi', 160);
        $options->set('isRemoteEnabled', true);
        $options->set('isFontSubsettingEnabled', true);
        $options->set('defaultFont', 'DejaVu Serif');
        $options->setChroot(FCPATH);
        $this->dompdf->setOptions($options);

        $fontFile = FCPATH . 'assets/fonts/Katibeh-Regular.ttf';
        if (is_file($fontFile)) {
            $this->dompdf->getFontMetrics()->registerFont(
                array('family' => 'Katibeh', 'style' => 'normal', 'weight' => 'normal'),
                $fontFile
            );
        }
    }

    public function certificatepdfdetails($ID)
    {
        if ($this->uri->segment(3)) {

            $offerid = $this->uri->segment(3);
            $html_content = $this->WebinarModel->fetch_single_details($offerid);
            $this->configure_certificate_pdf();
            $this->dompdf->loadHtml($html_content);
            $this->dompdf->setPaper('A4', 'landscape');
            $this->dompdf->render();
            $this->dompdf->stream("certificate.pdf", array("Attachment" => 0));
        }
    }

    public function downloadpdfdetails($ID)
    {
        if ($this->uri->segment(3)) {

            $offerid = $this->uri->segment(3);
            $html_content = $this->WebinarModel->fetch_single_details($offerid);
            $offer_name = $this->WebinarModel->fetch_certificate_name($offerid);
            $this->configure_certificate_pdf();
            $this->dompdf->loadHtml($html_content);
            $this->dompdf->setPaper('A4', 'landscape');
            $this->dompdf->render();
            $this->dompdf->stream($offer_name->name, array("Attachment" => 1));
        }
    }
}
