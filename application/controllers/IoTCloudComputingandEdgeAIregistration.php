<?php 

defined('BASEPATH') OR exit('No direct script access allowed');  

class IoTCloudComputingandEdgeAIregistration extends CI_Controller{

	public function __construct(){ 

		parent::__construct();
	    error_reporting(0);
	    $this->load->helper('utility_helper');
	    $this->load->library('form_validation');
	    $this->load->model(['LiveLeadModel', 'AppliedMlIoTByeictIitGuwagatModel']);
	    $this->load->library('session');
	    $this->load->library('email'); 

	}

public function iot_cloud_computing_and_edge_ai_by_eict_iitg_registration(){
  $this->load->view('master-courses/iot_cloud_computing_and_edge_ai_registration');
}
       
 public function iot_cloud_computing_and_edge_ai_registration_submit_form(){
   
         $this->form_validation->set_rules('name','Name','trim|required|min_length[2]|max_length[100]');
    	 $this->form_validation->set_rules('mobile','Mobile Number','required|numeric|max_length[15]');
    	 $this->form_validation->set_rules('email','Email ID','required|valid_email');
    	 $this->form_validation->set_rules('degree','Degree','required');
    	 $this->form_validation->set_rules('university','College / University','required');
         $this->form_validation->set_rules('experience','Work Experience','required');
    	 $this->form_validation->set_rules('industry','Industry','required');
         $this->form_validation->set_rules('resume','Resume / CV','callback_file_check');
         $this->form_validation->set_rules('checkbox','Checkbox','required');
        if($this->form_validation->run()){
                     
        	        $applicant_name=$this->input->post('name');
			        $applicant_mobile=$this->input->post('mobile');
			        $applicant_email=$this->input->post('email');
			        $applicant_degree=$this->input->post('degree');
			        $applicant_university=$this->input->post('university');
			        $applicant_work_exp=$this->input->post('experience');
			        $applicant_industry=$this->input->post('industry');
			        $applicant_sop=$this->input->post('statement');
			        //$applicant_resume=$this->input->post('resume');
			        $applicant_came_from=$this->input->post('came_from_course');
			        $applicant_url_source=$this->input->post('url_ml_iot_name');

            $data=array(
                    'applicant_name'=>$applicant_name,
			        'applicant_mobile'=>$applicant_mobile,
			        'applicant_email'=>$applicant_email,
			        'applicant_degree'=>$applicant_degree,
			        'applicant_university'=>$applicant_university,
			        'applicant_work_exp'=>$applicant_work_exp,
			        'applicant_industry'=>$applicant_industry,
			        'applicant_sop'=>$applicant_sop ? $applicant_sop : " ",
			        //'applicant_resume'=>$applicant_resume,
			        'applicant_came_from'=>$applicant_came_from,
			        'applicant_url_source'=>$applicant_url_source,
            );

            $mliotiitg_id=$this->AppliedMlIoTByeictIitGuwagatModel->SubmitMlIotRegistrationForm($data);
            
            if($mliotiitg_id>0){

                $fileStatus=$this->upload_appicant_resume($mliotiitg_id,$applicant_name);
                if($fileStatus['status']==TRUE){

                    $data['resume_link'] = $fileStatus['file_name'];
                    $this->AppliedMlIoTByeictIitGuwagatModel->updateResumeByID($mliotiitg_id,$fileStatus['file_name']);
                    $regdata = $this->AppliedMlIoTByeictIitGuwagatModel->getRecordById($mliotiitg_id);
                    $admin_ml_iot_iitg_mail_status=$this->admin_ml_iot_iitg_Email($data);
                    //$user_ml_iot_iitg_mail_status=$this->user_ml_iot_iitg_Email($data);
                    //Send mail
                    if($admin_ml_iot_iitg_mail_status){

                        header('Content-Type: application/json');
                        print json_encode(array('message'=>'SUCCESS','response'=>"Your Application Requested Successfully."));
                    }else{

                        //header('HTTP/1.1 500 Internal Server');
                        header('Content-Type: application/json; charset=UTF-8');
                        die(json_encode(array('message' => 'SUCCESS', 'response'=>"Your Application Requested Successfully ."))); 
                    }
                }
                else{
                     header('HTTP/1.1 501 Internal Server');
                     header('Content-Type: application/json; charset=UTF-8');
                     print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 501 ,'response'=>'Please Upload resume pdf/docx.')));
                }
                  
            }
            else{
                header('HTTP/1.1 501 Internal Server');
                header('Content-Type: application/json; charset=UTF-8');
                print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 501 ,'response'=>'Application Failed! Try Again')));
            }   
                }
        else{
            header('HTTP/1.1 500 Internal Server');
            header('Content-Type: application/json; charset=UTF-8');
            print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 500,'response'=>validation_errors())));
        }
    }



    public function file_check()
    {
        if(isset($_FILES['resume'])){
            $errors= array();
            $file_name = $_FILES['resume']['name'];
            $file_size =$_FILES['resume']['size'];
            $file_tmp =$_FILES['resume']['tmp_name'];
            $file_type=$_FILES['resume']['type'];
            $temp=explode('.',$_FILES['resume']['name']);
            $file_ext=strtolower(end($temp));
          
            $expensions= array("doc","docx","pdf");
          
            if(in_array($file_ext,$expensions)=== false){
                $message=$errors[]="File format is not supported, Please choose PDF or Docx file only.";
            } 
            elseif($file_size > 2097152){ //size in biytes
                
                $message=$errors[]='File size should not be more than 2 MB';
            }
          
            if(empty($errors)==true){
                return TRUE;
            }else{
                $this->form_validation->set_message('file_check', $message);
                return FALSE;
            }
        }
    }
     //start ml with iot admin mail

    public function admin_ml_iot_iitg_Email($data){

  		//------Email Section-----
		$from_email = "info@theiotacademy.co";
		$to_email = "eictiitg.admissions@theiotacademy.co";

		$this->email->from($from_email,'Enquiry | The IoT Academy'); 
		$this->email->to($to_email);
		$this->email->subject('Application Request Received for ' .$data['applicant_came_from'].' through Website by ' .$data['applicant_name']);
		$this->email->message($this->load->view('mailFormat/admin_mlwithiot_iitg_reg_mail',$data,TRUE)); 
         // $this->email->attach(mliotresume_url().'applicantresume/'.$regdata['applicant_resume']);
        //Sending Email
        if($this->email->send()){
            $this->email->clear(TRUE);//Clear past attached file
        	return TRUE ;

        }else{

        	return FALSE ;
        }

  	}

  //end  mail

  //sending user ml with iot confirmation mail
    public function user_ml_iot_iitg_Email($data){
  		//------Email Section-----

		$from_email = "info@theiotacademy.co";
		$to_email = $data['applicant_email'];
		$this->email->from($from_email,'Enquiry | The IoT Academy'); 
		$this->email->to($to_email);
		$this->email->subject('Congratulations '.$data['applicant_name']. '! Your Application  Requested Successfully'); 
		$this->email->message($this->load->view('mailFormat/user_mlwithiot_iitg_reg_mail',$data,TRUE));
        //Sending Email
        if($this->email->send()){

        	return TRUE ;

        }else{

        	return FALSE ;

        }

    }

//end ml with iot registration form and send mail admin and user
public function upload_appicant_resume($mliotiitg_id,$applicant_name)
    {
        $fileStatus=array();
        $resume = '';
        $config['upload_path'] = './uploads/applicant_resume';
        $config['file_name']  = $applicant_name.'_Resume_'.$mliotiitg_id;
        $config['allowed_types']        = 'pdf|docx|doc';
        $config['max_size']             = 2050;//size in KB
        
         $this->load->library('upload', $config);
         $this->upload->initialize($config);

        if (!empty($_FILES['resume']['name'])){
            if ( ! $this->upload->do_upload('resume')) {

                $fileStatus['file_name'] = '';
                $fileStatus['status'] = FALSE;
                return $fileStatus;
            }   
            else{ 
                $data = $this->upload->data();
                $fileStatus['file_name'] = $data['file_name'];
                $fileStatus['status'] = TRUE;
                return $fileStatus;
            }               
        }
    }


}

?>



