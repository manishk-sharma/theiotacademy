<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Certificatepdf extends CI_Controller {

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
            $this->load->model('CertificatePdfModel');
            $this->load->model('NewCertificatePdfModel');
            $this->load->library('session');
            $this->load->library('email');
            $this->load->library('pdf');

            }

    public function iotoff_certificate_verify(){
          
        $this->load->view('iotuserverifycertificate');
        
    }

    public function scan_verify($token = '')
    {
        $data['token'] = $token;
        $viewPath = APPPATH . 'views/certificate_scan_verify.php';

        if (is_file($viewPath) && is_readable($viewPath) && trim((string) @file_get_contents($viewPath)) !== '') {
            $this->load->view('certificate_scan_verify', $data);
            return;
        }

        $safeToken = htmlspecialchars($token, ENT_QUOTES, 'UTF-8');
        $apiUrl = base_url('certificate-token-data');

        echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Certificate Verification | The IoT Academy</title><style>body{font-family:Segoe UI,sans-serif;background:#f4f6f9;margin:0;padding:20px} .card{max-width:560px;margin:40px auto;background:#fff;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.08);padding:24px} .row{display:flex;justify-content:space-between;border-bottom:1px solid #eee;padding:10px 0} .row:last-child{border-bottom:none} .error{color:#dc3545;font-weight:600}</style></head><body><div class="card"><h2 style="margin-top:0">Certificate Verification</h2><p id="loading">Verifying certificate...</p><div id="details" style="display:none"></div><p id="error" class="error" style="display:none">Certificate not found.</p></div><script>(function(){var token=' . json_encode($safeToken) . ';var apiUrl=' . json_encode($apiUrl) . ';function showError(){document.getElementById("loading").style.display="none";document.getElementById("error").style.display="block";}if(!token){showError();return;}fetch(apiUrl+"?token="+encodeURIComponent(token)).then(function(r){return r.json();}).then(function(data){document.getElementById("loading").style.display="none";if(data&&data.status==="success"){var rows=[["Name",data.name],["Certificate ID",data.certification_id],["Course / Domain",data.domain_name],["Issue Date",data.issue_date],["Course Duration",(data.course_start_date||"")+" - "+(data.course_end_date||"")]];var html="";for(var i=0;i<rows.length;i++){html+="<div class=\"row\"><span>"+rows[i][0]+"</span><strong>"+(rows[i][1]||"-")+"</strong></div>";}var details=document.getElementById("details");details.innerHTML=html;details.style.display="block";}else{showError();}}).catch(showError);})();</script></body></html>';
    }

    public function get_certificate_by_token()
{
    $token = trim($this->input->get('token', true));

    $this->output->set_content_type('application/json');

    if (empty($token)) {
        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'status' => 'error',
                'message' => 'Token is required'
            ]));
    }

    // First check normal certificate_pdf table
    $result = $this->CertificatePdfModel->get_by_qr_token($token);

    // Optional: if not found, check new_certificate_pdf also
    if (!$result) {
        $result = $this->NewCertificatePdfModel->get_by_qr_token($token);
    }

    if (!$result) {
        return $this->output
            ->set_status_header(404)
            ->set_output(json_encode([
                'status' => 'error',
                'message' => 'Certificate not found'
            ]));
    }

    return $this->output->set_output(json_encode([
        'status' => 'success',
        'name' => isset($result['name']) ? $result['name'] : '',
        'certification_id' => isset($result['certification_id']) ? $result['certification_id'] : '',
        'domain_name' => isset($result['domain_name']) ? $result['domain_name'] : '',
        'issue_date' => isset($result['issue_date']) ? $result['issue_date'] : '',
        'course_start_date' => isset($result['course_start_date']) ? $result['course_start_date'] : '',
        'course_end_date' => isset($result['course_end_date']) ? $result['course_end_date'] : ''
    ]));
}
    public function iotuser_verified_certimem(){
        $this->form_validation->set_rules('serialno','Certification ID','required');
        if($this->form_validation->run()){
            $certificate_id=$this->input->post('serialno');

        $data = $this->NewCertificatePdfModel->getVerifiedMember($certificate_id);


                 if ($data) {
            
        $output = '';
           $output.='<div class="row post mb-50 ">';
                foreach($data as $result){
                    $name = $result->name;
                    $certificate_id=$result->certification_id;
                    $domain_name=$result->domain_name;
                    $email=$result->email;
                    $issue_date=$result->issue_date;
                    $acronym = substr($name, 0, 1);


                    // Creating HTML structure 
                    
                    $output.='<div class="col-lg-12 text-center">
                        <div class="">
                            <div class="verif-ups-images">
                            <img src="'.base_url().'assets/images/the-iot-logo-new.webp">
                            </div>
                            <div class="blog-content p-3">
                               <h4 class="text-success">Validation Successful</h4>
                                <p class="mt-3 mb-3"> The certificate with Certification id <b>'.$certificate_id.'</b> has been issued to <b>'.$name.' </b>for the Domain Name <b>'.$domain_name.'</b> on <b>'.$issue_date.'</b> </p>
                                <div class="nameemb"><p class="fstppf"><span class="firstnamel">'.$acronym.'</span> </p><p>'.$name.'<br> '.$email.'</p></div>
                                
                            </div>
                        </div>
                    </div>';        
                }
       //echo $output.'</div>';
       $resrtd=$output.'</div>';
       print_r(json_encode(['message' => 'success','response'=>$resrtd]));
     }
     else{
        print_r(json_encode(['message' => 'notmatch','response'=>"<h2 class='text-center mt-4 mb-3'>Record Not Found!</h2>"]));
     }
        
       }
       else{
            print_r(json_encode(array('message' => 'error','response'=>validation_errors())));

        }
    }        

    public function verify_certificate(){

        $this->load->view('admin/certificatepdf/verifycertificate');
    }
    
    public function verified_member(){
        
        $this->form_validation->set_rules('serialno','Certification ID','required');
        if($this->form_validation->run()){
            $certificate_id=$this->input->post('serialno');

        $data = $this->NewCertificatePdfModel->getVerifiedMember($certificate_id);


                 if ($data) {
            
        $output = '';
           $output.='<div class="row post mb-50 ">';
                foreach($data as $result){
                    $name = $result->name;
                    $certificate_id=$result->certification_id;
                    $domain_name=$result->domain_name;
                    $email=$result->email;
                    $issue_date=$result->issue_date;
                    $acronym = substr($name, 0, 1);


                    // Creating HTML structure 
                    
                    $output.='<div class="col-lg-12 text-center">
                        <div class="">
                            <div class="verif-ups-images">
                            <img src="'.base_url().'assets/images/upskill-logo-new.png" >
                            </div>
                            <div class="blog-content p-3">
                               <h4 class="text-success">Validation Successful</h4>
                                <p class="mt-3 mb-3"> The certificate with Certification id <b>'.$certificate_id.'</b> has been issued to <b>'.$name.' </b>for the internship <b>'.$domain_name.'</b> on <b>'.$issue_date.'</b> </p>
                                <div class="nameemb"><p class="fstppf"><span class="firstnamel">'.$acronym.'</span> </p><p>'.$name.'<br> '.$email.'</p></div>
                                
                            </div>
                        </div>
                    </div>';        
                }
       //echo $output.'</div>';
       $resrtd=$output.'</div>';
       print_r(json_encode(['message' => 'success','response'=>$resrtd]));
     }
     else{
        print_r(json_encode(['message' => 'notmatch','response'=>"<h2 class='text-center mt-4 mb-3'>Record Not Found!</h2>"]));
     }
        
       }
       else{
            print_r(json_encode(array('message' => 'error','response'=>validation_errors())));

        }     
    }


    public function index(){
        try{
        $data = array();
        $data['members'] = $this->CertificatePdfModel->getRows();
     }
      catch(Exception $e){
        print_r($e);
      }
        $this->load->view('admin/certificatepdf/index', $data);


    }

    //new certificate pdf 
       public function new_index(){
        try{
        $data = array();
        $data['members'] = $this->NewCertificatePdfModel->getRows();
     }
      catch(Exception $e){
        print_r($e);
      }
        $this->load->view('admin/certificatepdf/new-index', $data);
    }


    public function new_import(){
        $this->CertificatePdfModel = $this->NewCertificatePdfModel;
        $this->import('new_certificate-pdf-home');

    }

    public function import($redirectRoute = 'certificate-pdf-home'){
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

                          $randmcer='USC'.rand(1000,1000000).'TIA';
                         if ($row['Name']=='' || $row['Email']=='' || $row['Mobile']=='' || $row['Domain']==''|| $row['Collegename']==''  || $row['Issuedate']=='' || $row['Startdate']=='' || $row['Enddate']=='') {
                             
                             $this->session->set_flashdata('success_msg', 'All Field Are Required');
                             redirect($redirectRoute);
                         }
                         else{
                         $rowCount++;
                       
                        $memData = array(
                            'name' => ucwords(strtolower($row['Name'])),
                            'email' => strtolower($row['Email']),
                            'mobile' => $row['Mobile'],
                            'domain_name' => ucwords(strtolower($row['Domain'])),
                            'college_name' => ucwords(strtolower($row['Collegename'])),
                            'certification_id' => $randmcer,
                            'issue_date' => $row['Issuedate'],
                            'course_start_date' => $row['Startdate'],
                            'course_end_date' => $row['Enddate']

                            );


                        $updaData = array(
                            'name' => ucwords(strtolower($row['Name'])),
                            'email' => strtolower($row['Email']),
                            'mobile' => $row['Mobile'],
                            'domain_name' => ucwords(strtolower($row['Domain'])),
                            'college_name' => ucwords(strtolower($row['Collegename'])),
                            'issue_date' => $row['Issuedate'],
                            'course_start_date' => $row['Startdate'],
                            'course_end_date' => $row['Enddate']

                            );



                            // Check whether email already exists in the database

                            $con = array(

                                'where' => array(
                                    'email' => $row['Email']
                                ),

                                'returnType' => 'count'

                            );

                            $prevCount = $this->CertificatePdfModel->getRows($con);
                            if($prevCount > 0){

                                // Update member data

                                $condition = array('email' => $row['Email']);
                                $update = $this->CertificatePdfModel->update($updaData, $condition);

                                if($update){
                                    $updateCount++;
                                }

                            }else{

                                // Insert member data

                                $insert = $this->CertificatePdfModel->insert($memData);
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

        redirect($redirectRoute);

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
        $data['members'] = $this->CertificatePdfModel->get_data();
        $this->load->view('admin/certificatepdf/result', $data);
    }

    public function new_view_result()
    {
        $data = array();
        $data['members'] = $this->NewCertificatePdfModel->get_data();
        $data['is_new_certificate_result'] = true;
        $this->load->view('admin/certificatepdf/result', $data);
    }

    public function new_certificatepdfdetails($ID)
    {
        $this->CertificatePdfModel = $this->NewCertificatePdfModel;
        $this->certificatepdfdetails($ID);
    }

    public function new_downloadpdfdetails($ID)
    {
        $this->CertificatePdfModel = $this->NewCertificatePdfModel;
        $this->downloadpdfdetails($ID);
    }


    public function store() {
        if($this->input->post('Submit'))
           {
            $data = array();
            $data = $this->CertificatePdfModel->get_status_data();
        }

        else
        {
            redirect('certificate-pdf-home');
        }
    }

    public function certificatepdfdetails($ID)
     {
        if($this->uri->segment(3)){

          $offerid=$this->uri->segment(3);
          $html_content =$this->CertificatePdfModel->fetch_single_details($offerid);
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
          $html_content =$this->CertificatePdfModel->fetch_single_details($offerid);
          $offer_name =$this->CertificatePdfModel->fetch_certificate_name($offerid);
          // echo $offer_name->name;exit;
             $this->dompdf->loadHtml($html_content);
             $this->dompdf->setPaper('A4', 'landscape');
             $this->dompdf->render();
             $this->dompdf->stream($offer_name->name, array("Attachment"=>1));
     }
  }

      public function add_details_for_verify_certificate()
    {   
        try {
            $data = array();
            $data['members'] = $this->CertificatePdfModel->get_manual_data_Rows();
        } catch (Exception $e) {
            print_r($e);
        }
        $this->load->view('admin/certificatepdf/add_details_for_verify_certificate', $data);
    }



    public function submit_certificate_function_add_certificate_details()
    {
        $this->form_validation->set_rules('name','Name','required');
	  	$this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('domain','Domain','required');
        $this->form_validation->set_rules('certification_id','Certification Id','required');
        $this->form_validation->set_rules('course_start_date','Course Start Date','required');
        $this->form_validation->set_rules('course_end_date','Course End Date','required');
        $this->form_validation->set_rules('issue_date','Issue Date','required');

        if($this->form_validation->run()){
			$name=$this->input->post('name');
		  	$email=$this->input->post('email');
		  	$mobile=$this->input->post('mobile');
		  	$domain=$this->input->post('domain');
		  	$certification_id=$this->input->post('certification_id');
		  	$course_start_date=$this->input->post('course_start_date');
		  	$course_end_date=$this->input->post('course_end_date');
		  	$issue_date=$this->input->post('issue_date');
		    $data=array(
			 	'name'=>$name,
                'email'=>$email,
				'mobile'=>$mobile,
                'domain_name'=>$domain,
				'certification_id'=>$certification_id,
                'course_start_date'=>$course_start_date,
                'course_end_date'=>$course_end_date,
                'issue_date'=>$issue_date,
                'manual_add'=>'true'

		 	);
              $isExist=$this->CertificatePdfModel->isextis_certification_id($certification_id);

			 if($isExist>0){
				print json_encode(array('message'=>'success','response'=>"This Certification Id is Already Exists"));
			 }
             else{
    		 $gcid=$this->CertificatePdfModel->insert_manual_certificate_detail_for_verfication($data);
    		if($gcid>0){
			   print_r(json_encode(['message'=>'success','response'=>"This Certificate Details Added Successfully"]));
	        }
	        else{
		        print_r(json_encode(['message' => 'sererror','response'=>'Insertion Faield! Try Again']));
	        }
           }

    	}else{
        	print_r(json_encode(['message' => 'error','response'=>validation_errors()]));

		}
    }


}