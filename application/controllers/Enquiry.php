<?php

//ob_start();

defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Enquiry extends CI_Controller {

	public function __construct(){

		parent::__construct();

		error_reporting(0);

		$this->load->helper('utility_helper');
		$this->load->library('form_validation');
		$this->load->model('EnquiryModel');
		$this->load->model('EnquirySourceModel');
		$this->load->model('EnquiryFollowUpModel');
		$this->load->model('AppModel');
		$this->load->model('EmployeeModel');
		$this->load->model('CourseModel');
		$this->load->library('session');
		$this->load->library('email');

	}

	public function index(){	

		$this->load->view('admin/enquiry/enquirymanage');

	}

	public function add_enquiry(){

		$this->load->view('admin/enquiry/addenquiry');
	}

	public function edit_enquiry($id){

		$data=$this->EnquiryModel->getEnquiryById($id);
		$this->load->view('admin/enquiry/editenquiry',$data);

	}



	public function enquiry_submit(){

		  //Validating the information

		  //error messages

		  $nameerrmsg=array(

		  					'required'=>'First Name/Last Name Cannot Be Empty.',
							'alpha_numeric_spaces'=>'Last Name Must Contain Only Letters of English Alphabet and Spaces.',
							'alpha'=>'First Name Must Contain Only Letters of English Alphabet.'

							) ;

		  $mobileerrmsg=array(

		  				'required'=>'Mobile No. Cannot Be Empty.',
		  				'numeric'=>'Mobile No. Must Be 10-Digit Number',
		  				'exact_length'=>'Mobile No. Must Be 10-Digit Number'

		  				) ;

		  $emailerrmsg=array(

		  				'required'=>'Email Cannot Be Empty.',
		  				'valid_email'=>'Email Must Be A Valid Email.'

		  				) ;

		  $this->form_validation->set_rules('fname','First Name','required|alpha',$nameerrmsg);
		  $this->form_validation->set_rules('lname','Last Name','required|alpha_numeric_spaces',$nameerrmsg);
		  $this->form_validation->set_rules('mobileno','Mobile No.','required|numeric|exact_length[10]',$mobileerrmsg);
		  $this->form_validation->set_rules('emailid','Email ID','required|valid_email',$emailerrmsg);
		if($this->form_validation->run()){

			$enq_id=0 ;
			$enquiry_id=0 ;
			$ip=$_SERVER['REMOTE_ADDR']; 
			$fname=$this->input->post('fname');
		  	$lname=$this->input->post('lname');
		  	$gender=$this->input->post('gender');
		  	$email_id=$this->input->post('emailid');
		  	$mobile_no=$this->input->post('mobileno');
		  	$course_id=$this->input->post('courseid');
		  	$source_id=$this->input->post('sourceid');
		  	$message=$this->input->post('message');
		  	//Insert Enquiry

			$enq_id=$this->EnquiryModel->insertEnquiry($fname,$lname,$gender,$email_id,$mobile_no,$course_id,$source_id,$message) ;
			//Updating Enquiry ID

			$enquiry_id=$this->EnquiryModel->updateEnquiryId($enq_id) ;
			if(($enq_id>0)&&is_string($enquiry_id)){

				$emailstatus=$this->sendEnquiryConfirmEmail($enquiry_id,$fname,$course_id,$email_id);

				if($emailstatus){
					$message="Enquiry Created Successfully with Id: ".$enquiry_id.". Email Confirmation Sent." ;
	        		$this->session->set_flashdata('success',$message);
	        		redirect(base_url().'aenquiry'); 

        		}else{

        			$message="Enquiry Created Successfully with Id: ".$enquiry_id ;

	        		$this->session->set_flashdata('success',$message);

	        		redirect(base_url().'aenquiry'); 

        		} 

        	}else{

        		$message="Unable To Create The Enquiry. Contact Administrator." ;

                $this->session->set_flashdata('error',$message);

                redirect(base_url().'aenquiry');

        	}

		}else{

			$this->session->set_flashdata('error',validation_errors());

            redirect(base_url().'add-enquiry');

		}

	}

	public function enquiry_update(){

		  //Validating the information

			$enq_id=$this->input->post('enqid') ;

		  //error messages

		  $nameerrmsg=array(

		  					'required'=>'First Name/Last Name Cannot Be Empty.',
							'alpha_numeric_spaces'=>'Last Name Must Contain Only Letters of English Alphabet and Spaces.',
							'alpha'=>'First Name Must Contain Only Letters of English Alphabet. And No Spaces.'

							) ;

		  $mobileerrmsg=array(

		  				'required'=>'Mobile No. Cannot Be Empty.',

		  				'numeric'=>'Mobile No. Must Be 10-Digit Number',

		  				'exact_length'=>'Mobile No. Must Be 10-Digit Number'

		  				) ;

		  $emailerrmsg=array(

		  				'required'=>'Email Cannot Be Empty.',

		  				'valid_email'=>'Email Must Be A Valid Email.'

		  				) ;

		  $this->form_validation->set_rules('fname','First Name','required|alpha',$nameerrmsg);

		  $this->form_validation->set_rules('lname','Last Name','required|alpha_numeric_spaces',$nameerrmsg);

		  $this->form_validation->set_rules('mobileno','Mobile No.','required|numeric|exact_length[10]',$mobileerrmsg);

		  $this->form_validation->set_rules('emailid','Email ID','required|valid_email',$emailerrmsg);

		if($this->form_validation->run()){

			$ip=$_SERVER['REMOTE_ADDR']; 

			$fname=$this->input->post('fname');
		  	$lname=$this->input->post('lname');
		  	$gender=$this->input->post('gender');
		  	$email_id=$this->input->post('emailid');
		  	$mobile_no=$this->input->post('mobileno');
		  	$course_id=$this->input->post('courseid');
		  	$source_id=$this->input->post('sourceid');
		  	$message=$this->input->post('message');
		  	//Insert Enquiry

			$ustatus=$this->EnquiryModel->updateEnquiry($enq_id,$fname,$lname,$gender,$email_id,$mobile_no,$course_id,$source_id,$message) ;
			if($ustatus){

				$message="Enquiry Updated Successfully." ;
        		$this->session->set_flashdata('success',$message);
        		redirect(base_url().'aenquiry');  

        	}else{

        		$message="Unable To Update The Enquiry. Contact Administrator." ;

                $this->session->set_flashdata('error',$message);

                redirect(base_url().'aenquiry');

        	}

		}else{

			$this->session->set_flashdata('error',validation_errors());

            redirect(base_url().'enquiry/edit_enquiry/'.$enq_id);

		}

	}



	//Function For Sending Enquiry Received Email 

  	public function sendEnquiryConfirmEmail($enquiry_id,$first_name,$course_id,$to_email){

  		$to_email="info@theiotacademy.co" ;

  		$course=$this->CourseModel->getCourseById($course_id) ;

  		$from_email="enquiry@theiotacademy.co" ;

		$message="Hi <strong>".$first_name."</strong>,<br>We have received your enquiry for the Course: <strong>".$course['course_title']."(".$course['cs_id'].")</strong>.<br>Your Enquiry ID is <strong>".$enquiry_id."</strong>.<br>We will get back to you soon.<br><br>Thanks.<br>The IoT Academy<br>3rd Floor, NIMS Building, C-56/11, Sector-62, Noida, U.P" ;

  		

   		$this->email->from($from_email, 'The IoT Academy'); 

        $this->email->to($to_email.',info@theiotacademy.co');

        $this->email->subject('Enquiry Received'); 

        $this->email->message($message);
        //Sending Email

        if($this->email->send()){

        	return TRUE ;

        }else{

        	return FALSE ;

        }

  	}



  	public function exportExcelEnquiryList(){

  		$spreadsheet = new Spreadsheet(); // instantiate Spreadsheet
        $sheet = $spreadsheet->getActiveSheet();



        //Defining Table Column Titles

        $table_columns=array("ID","Enquiry ID","First Name","Last Name","Gender","Email ID","Mobile No.","Course","Source","Message","Reg. Status","Last Updated","Created On");
        $columnIndex=1 ;
        //Adding Table Columns To Sheet

        foreach($table_columns as $column_title){

        	$sheet->setCellValueByColumnAndRow($columnIndex,1,$column_title) ;

        	$columnIndex++ ;

        }



        //Adding Data To Sheet

        $enqlist=$this->EnquiryModel->getEnquiryList() ;

        $rowIndex=2 ; //Adding data from second row as first row already contains headers.

        foreach($enqlist as $row){

        	$sheet->setCellValueByColumnAndRow(1,$rowIndex,$row->enq_id) ;

        	$sheet->setCellValueByColumnAndRow(2,$rowIndex,$row->enquiry_id) ;

        	$sheet->setCellValueByColumnAndRow(3,$rowIndex,$row->first_name) ;

        	$sheet->setCellValueByColumnAndRow(4,$rowIndex,$row->last_name) ;

        	$sheet->setCellValueByColumnAndRow(5,$rowIndex,$row->gender) ;

        	$sheet->setCellValueByColumnAndRow(6,$rowIndex,$row->email_id) ;

        	$sheet->setCellValueByColumnAndRow(7,$rowIndex,$row->mobile_no) ;

        	$sheet->setCellValueByColumnAndRow(8,$rowIndex,$this->CourseModel->getCourseTitleById($row->course_id)) ;

        	$sheet->setCellValueByColumnAndRow(9,$rowIndex,$this->EnquirySourceModel->getSourceTitleById($row->source_id)) ;

        	$sheet->setCellValueByColumnAndRow(10,$rowIndex,$row->message) ;

        	if($row->reg_status==1){

        		$sheet->setCellValueByColumnAndRow(11,$rowIndex,'Registered') ;

        	}else{

        		$sheet->setCellValueByColumnAndRow(11,$rowIndex,'Waiting') ;

        	}

        	$sheet->setCellValueByColumnAndRow(12,$rowIndex,date('d-m-Y',strtotime($row->last_updated_on))) ;

        	$sheet->setCellValueByColumnAndRow(13,$rowIndex,date('d-m-Y',strtotime($row->created_on))) ;

        	$rowIndex++ ;

        }

        

        $writer = new Xlsx($spreadsheet); // instantiate Xlsx

 		ob_end_clean();

        $filename = 'enquirylist'; // set filename for excel file to be exported
        header('Content-Type: application/vnd.ms-excel'); // generate excel file
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"'); 
        header('Cache-Control: max-age=0');
        $writer->save('php://output');	// download file

  	}

public function sendEmailForWebinar()

{

$email_list1=array(	

"verma455r@gmail.com"
);

/*$email_list=array(

"vivek20m30@gmail.com");*/

$email_list2=array("verma455r@gmailcom","info@theiotacademy.co");

for ($i=0; $i < sizeof($email_list1); $i++) { 

		//$this->sendEnquiryEmail($email_list1[$i],$i);

		$count=$i+1;
		$from_email="enquiry@theiotacademy.co" ;
  		$to_email=$email_list1[$i];
		$message="Hi,"."<br>
		Greetings from The IoT Academy."."<br>

		Thanks for registering for the webinar on <strong>INDUSTRY 4.0: CONVERGENCE OF TECHNOLOGIES</strong> under the free FDP program conducted by The IoT Academy in collaboration with <strong>E&ICT Academy, IIT Guwahati</strong>. You must have got a webinar joining link. However, we have received a huge response to our webinar series and it might also create a problem for some attendees to join the webinar, as the platform we are using has a limitation of 250 people. In case you also face the problem in joining the webinar via the link you might receive from Zoho, please use the alternative link created below to accommodate as many people as possible by us. "."<br>

		<a href='https://meeting.zoho.in/joinWebinar?key=1331770728&digest=bc83c876ad1d1068eba5408d65f6223a70f4c8fc1d7127209acd0c8cac83fba7' target='_blank'>https://meeting.zoho.in/joinWebinar?key=1331770728&digest=bc83c876ad1d1068eba5408d65f6223a70f4c8fc1d7127209acd0c8cac83fba7</a>"."<br>



		Regards,"."<br>

		The IoT Academy";

  		

   		$this->email->from($from_email, 'The IoT Academy'); 

        $this->email->to($to_email);

        $this->email->subject('Webinar on INDUSTRY 4.0: CONVERGENCE OF TECHNOLOGIES'); 

        $this->email->message($message);



        //Sending Email

        if($this->email->send()){

        	echo "True $count<br>"; ;

        }else{

        	echo "false $count<br>";

        }

  		

  	}


}

  	//Function For Sending Enquiry Received Email 
  	public function sendEnquiryEmail($email_id,$count){

  		$from_email="enquiry@theiotacademy.co" ;

  		$to_email=$email_id;

		$message="Hi,"."<br>
		Greetings from The IoT Academy."."<br>
		Thanks for registering for the webinar on <strong>INDUSTRY 4.0: CONVERGENCE OF TECHNOLOGIES</strong> under the free FDP program conducted by The IoT Academy in collaboration with <strong>E&ICT Academy, IIT Guwahati</strong>. You must have got a webinar joining link. However, we have received a huge response to our webinar series and it might also create a problem for some attendees to join the webinar, as the platform we are using has a limitation of 250 people. In case you also face the problem in joining the webinar via the link you might receive from Zoho, please use the alternative link created below to accommodate as many people as possible by us. "."<br>
		<a href='https://meeting.zoho.in/joinWebinar?key=1331770728&digest=bc83c876ad1d1068eba5408d65f6223a70f4c8fc1d7127209acd0c8cac83fba7' target='_blank'>https://meeting.zoho.in/joinWebinar?key=1331770728&digest=bc83c876ad1d1068eba5408d65f6223a70f4c8fc1d7127209acd0c8cac83fba7</a>"."<br>



		Regards,"."<br>

		The IoT Academy";

   		$this->email->from($from_email, 'The IoT Academy'); 

        $this->email->to($to_email);

        $this->email->subject('Webinar on INDUSTRY 4.0: CONVERGENCE OF TECHNOLOGIES'); 

        $this->email->message($message);



        //Sending Email

        if($this->email->send()){

        	echo "True $count<br>"; ;

        }else{

        	echo "false $count<br>";

        }

  	}



}