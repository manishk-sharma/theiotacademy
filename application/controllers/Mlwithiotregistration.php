<?php 

defined('BASEPATH') OR exit('No direct script access allowed');  

class Mlwithiotregistration extends CI_Controller{

	public function __construct(){ 

		parent::__construct();
	    error_reporting(0);
	    $this->load->helper('utility_helper');
	    $this->load->library('form_validation');
	    $this->load->model(['LiveLeadModel', 'AppliedMlIoTByeictIitGuwagatModel']);
	    $this->load->library('session');
	    $this->load->library('email'); 

	}
public function data_analyst_iitg_coursefun_registration(){
     $this->load->view('master-courses/data_analyst_iitg_course_registration');
}
public function ds_ml_and_ai_9m_by_eict_iitg_registration(){
    $this->load->view('master-courses/ds_ml_and_ai_9m_registration');
}
public function ds_ml_and_ai_9m_by_eict_iitr_registration(){
    $this->load->view('master-courses/ds_ml_and_ai_9m_registration_iitr');
}
public function ds_ml_6m_by_eict_iitr_registration(){
    $this->load->view('master-courses/ds_ml_6m_registration_iitr');
}
// New 3 form Pages
public function data_analytics_and_gen_ai_by_eict_iitr_registration(){
    $this->load->view('master-courses/data_analytics_and_gen_ai_iitr_registration');
}
public function ai_powered_embedded_and_iot_program_registration(){
    $this->load->view('master-courses/ai_powered_embedded_and_iot_program_formpage');
}
public function da_with_genai_registration(){
    $this->load->view('master-courses/da_with_genai_formpage');
}    

public function advanced_generative_ai_registration(){
    $this->load->view('master-courses/advanced_generative_ai_register');
}    
public function da_ml_generative_ai_registration(){
        $this->load->view('master-courses/da_ml_generative_ai_registerv');
   }
public function data_analytics_crn_iitg_registration(){
     $this->load->view('master-courses/data_analyst_iitg_registration');
}

public function full_stack_java_development_by_eict_iitg_registration(){
     $this->load->view('master-courses/full_stack_java_development_iitg_registration');
}
public function ml_with_iot_by_eict_iitg_registration(){
  $this->load->view('master-courses/ml_with_iot_iitg_registration');
}

public function ds_ml_and_edge_ai_by_eict_iitg_registration(){
  $this->load->view('master-courses/ds_ml_and_edge_ai_iitg_registration');
}
public function basic_embedded_system_and_iot_by_eict_iitg_registration(){
  $this->load->view('master-courses/basic_embedded_system_and_iot_registration');
}
     
 public function ml_with_iot_registration_submit_form(){
   
         $this->form_validation->set_rules('name','Name','trim|required|min_length[2]|max_length[100]');
    	 $this->form_validation->set_rules('mobile','Mobile Number','required|numeric|max_length[15]');
    	 $this->form_validation->set_rules('email','Email ID','required|valid_email');
    	 $this->form_validation->set_rules('degree','Degree','required');
    	//  $this->form_validation->set_rules('university','College / University','required');
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
			       'applicant_university' => $applicant_university ?? "",
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
                    if($data['applicant_came_from']=='Data Analytics, Machine Learning And Generative AI Course'){
                        $this->admin_ds_ml_genrativeai_mail($data);
                        echo json_encode(['message' => 'success', 'response' => 'Your Application Submitted Successfully!']);
                    }
                    elseif($data['applicant_came_from']=='Advanced-Generative-AI-Certification-Course'){
                        $this->admin_advanced_generative_ai_mail($data);
                        echo json_encode(['message' => 'success', 'response' => 'Your Application Submitted Successfully!']);
                    }
                    else{
                        $this->admin_ml_iot_iitg_Email($data);
                        echo json_encode(['message' => 'success', 'response' => 'Your Application Submitted Successfully!']);
                    }

                    //$user_ml_iot_iitg_mail_status=$this->user_ml_iot_iitg_Email($data);
                    //Send mail
                }
                else{
                    
                    echo json_encode(['message' => 'sererror', 'response'=>'Please Upload resume pdf/docx.']);
                }
                  
            }
            else{
                echo json_encode(['message' => 'failed','response'=>'Application Failed! Try Again']);
            }   
                }
        else{
            echo json_encode(['message' => 'error','response'=>validation_errors()]);
        }
    }


    public function advanced_genai_registration_submit_form(){
   
        $this->form_validation->set_rules('name','Name','trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('mobile','Mobile Number','required|numeric|max_length[15]');
        $this->form_validation->set_rules('email','Email ID','required|valid_email');
        $this->form_validation->set_rules('degree','Degree','required');
        //$this->form_validation->set_rules('university','College / University','required');
        $this->form_validation->set_rules('experience','Work Experience','required');
        $this->form_validation->set_rules('industry','Industry','required');
        $this->form_validation->set_rules('resume','Resume / CV','callback_file_check');
        //$this->form_validation->set_rules('checkbox','Checkbox','required');
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
                   
                       $this->admin_advanced_generative_ai_mail($data);
                       echo json_encode(['message' => 'success', 'response' => 'Your Application Submitted Successfully!']);

                   //$user_ml_iot_iitg_mail_status=$this->user_ml_iot_iitg_Email($data);
                   //Send mail
               }
               else{
                   
                   //echo json_encode(['message' => 'sererror', 'response'=>'Please Upload resume pdf/docx.']);
                   $this->admin_advanced_generative_ai_mail($data);
                    echo json_encode(['message' => 'success', 'response' => 'Your Application Submitted Successfully!']);
               }
                 
           }
           else{
               echo json_encode(['message' => 'failed','response'=>'Application Failed! Try Again']);
           }   
               }
       else{
           echo json_encode(['message' => 'error','response'=>validation_errors()]);
       }
   }



 public function ml_ai_analyst_inhouse_registration_submit_form(){
   
         $this->form_validation->set_rules('name','Name','trim|required|min_length[2]|max_length[100]');
    	 $this->form_validation->set_rules('mobile','Mobile Number','required|numeric|max_length[15]');
    	 $this->form_validation->set_rules('email','Email ID','required|valid_email');
    	 $this->form_validation->set_rules('degree','Degree','required');
    	//  $this->form_validation->set_rules('university','College / University','required');
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
			       'applicant_university' => $applicant_university ?? "",
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
                    $this->admin_ml_ai_inhouse_iitg_Email($data);
                    echo json_encode(['message' => 'success', 'response' => 'Your Application Submitted Successfully!']);

                    //$user_ml_iot_iitg_mail_status=$this->user_ml_iot_iitg_Email($data);
                    //Send mail
                }
                else{
                    
                    echo json_encode(['message' => 'sererror', 'response'=>'Please Upload resume pdf/docx.']);
                }
                  
            }
            else{
                echo json_encode(['message' => 'failed','response'=>'Application Failed! Try Again']);
            }   
                }
        else{
            echo json_encode(['message' => 'error','response'=>validation_errors()]);
        }
    }   

public function gen_ai_apply_form(){

    $this->form_validation->set_rules('name','Name','trim|required|min_length[2]|max_length[100]');
    $this->form_validation->set_rules('mobile','Mobile Number','required|numeric|max_length[15]');
    $this->form_validation->set_rules('email','Email ID','required|valid_email');
    $this->form_validation->set_rules('degree','Degree','required');
    $this->form_validation->set_rules('experience','Work Experience','required');
    $this->form_validation->set_rules('industry','Industry','required');
    $this->form_validation->set_rules('resume','Resume / CV','callback_file_check');
    $this->form_validation->set_rules('checkbox','Checkbox','required');

    if ($this->form_validation->run() == FALSE) {
        echo json_encode([
            'message'  => 'error',
            'response' => validation_errors()
        ]);
        return;
    }

    // ===== POST DATA =====
    $applicant_name       = $this->input->post('name');
    $applicant_mobile     = $this->input->post('mobile');
    $applicant_email      = $this->input->post('email');
    $applicant_degree     = $this->input->post('degree');
    $applicant_university = $this->input->post('university');
    $applicant_work_exp   = $this->input->post('experience');
    $applicant_industry   = $this->input->post('industry');
    $applicant_sop        = $this->input->post('statement');
    $applicant_came_from  = $this->input->post('came_from_course');
    $applicant_url_source = $this->input->post('url_ml_iot_name');

    // ===== DB DATA =====
    $data = array(
        'applicant_name'       => $applicant_name,
        'applicant_mobile'     => $applicant_mobile,
        'applicant_email'      => $applicant_email,
        'applicant_degree'     => $applicant_degree,
        'applicant_university' => $applicant_university ?? '',
        'applicant_work_exp'   => $applicant_work_exp,
        'applicant_industry'   => $applicant_industry,
        'applicant_sop'        => $applicant_sop ? $applicant_sop : '',
        'applicant_came_from'  => $applicant_came_from,
        'applicant_url_source' => $applicant_url_source,
    );

    // ===== INSERT =====
    $insertId = $this->AppliedMlIoTByeictIitGuwagatModel
                     ->SubmitMlIotRegistrationForm($data);

    if ($insertId <= 0) {
        echo json_encode([
            'message'  => 'failed',
            'response' => 'Application Failed! Try Again'
        ]);
        return;
    }

    // ===== RESUME UPLOAD (MANDATORY) =====
    $fileStatus = $this->upload_appicant_resume($insertId, $applicant_name);

    if ($fileStatus['status'] != TRUE) {
        echo json_encode([
            'message'  => 'sererror',
            'response' => 'Please Upload resume pdf/docx.'
        ]);
        return;
    }

    // ===== UPDATE RESUME =====
    $this->AppliedMlIoTByeictIitGuwagatModel
         ->updateResumeByID($insertId, $fileStatus['file_name']);

    // ===== MAIL DATA =====
    $mailData = $data;
    $mailData['resume_link'] = base_url(
        'uploads/applicant_resume/'.$fileStatus['file_name']
    );

    // ===== SEND MAIL (ALAG FUNCTION) =====
    $this->GenaiConfirmEmail($mailData);

    echo json_encode([
        'message'  => 'success',
        'response' => 'Your Application Submitted Successfully!'
    ]);
}

public function GenaiConfirmEmail($data){

    $from = "enquiry@theiotacademy.co";
    $to   = "admissions.genai.eictiitr@theiotacademy.co";

    $this->email->clear(TRUE);
    $this->email->from($from,'Enquiry | The IoT Academy');
    $this->email->to($to);

    $this->email->subject(
        'Application Received - '.$data['applicant_came_from']
    );

    $this->email->message(
        $this->load->view(
            'mailFormat/genai_application_admin',
            $data,
            TRUE
        )
    );

    $this->email->send();
}
public function ds_ml_ai_genai_eict_iitroorkee(){

    $this->form_validation->set_rules('name','Name','trim|required|min_length[2]|max_length[100]');
    $this->form_validation->set_rules('mobile','Mobile Number','required|numeric|max_length[15]');
    $this->form_validation->set_rules('email','Email ID','required|valid_email');
    $this->form_validation->set_rules('degree','Degree','required');
    $this->form_validation->set_rules('experience','Work Experience','required');
    $this->form_validation->set_rules('industry','Industry','required');
    $this->form_validation->set_rules('resume','Resume / CV','callback_file_check');
    $this->form_validation->set_rules('checkbox','Checkbox','required');

    if ($this->form_validation->run() == FALSE) {
        echo json_encode([
            'message'  => 'error',
            'response' => validation_errors()
        ]);
        return;
    }

    // ===== POST DATA =====
    $applicant_name       = $this->input->post('name');
    $applicant_mobile     = $this->input->post('mobile');
    $applicant_email      = $this->input->post('email');
    $applicant_degree     = $this->input->post('degree');
    $applicant_university = $this->input->post('university');
    $applicant_work_exp   = $this->input->post('experience');
    $applicant_industry   = $this->input->post('industry');
    $applicant_sop        = $this->input->post('statement');
    $applicant_came_from  = $this->input->post('came_from_course');
    $applicant_url_source = $this->input->post('url_ml_iot_name');

    // ===== DB DATA =====
    $data = array(
        'applicant_name'       => $applicant_name,
        'applicant_mobile'     => $applicant_mobile,
        'applicant_email'      => $applicant_email,
        'applicant_degree'     => $applicant_degree,
        'applicant_university' => $applicant_university ?? '',
        'applicant_work_exp'   => $applicant_work_exp,
        'applicant_industry'   => $applicant_industry,
        'applicant_sop'        => $applicant_sop ? $applicant_sop : '',
        'applicant_came_from'  => $applicant_came_from,
        'applicant_url_source' => $applicant_url_source,
    );

    // ===== INSERT =====
    $insertId = $this->AppliedMlIoTByeictIitGuwagatModel
                     ->SubmitMlIotRegistrationForm($data);

    if ($insertId <= 0) {
        echo json_encode([
            'message'  => 'failed',
            'response' => 'Application Failed! Try Again'
        ]);
        return;
    }

    // ===== RESUME UPLOAD (MANDATORY) =====
    $fileStatus = $this->upload_appicant_resume($insertId, $applicant_name);

    if ($fileStatus['status'] != TRUE) {
        echo json_encode([
            'message'  => 'sererror',
            'response' => 'Please Upload resume pdf/docx.'
        ]);
        return;
    }

    // ===== UPDATE RESUME =====
    $this->AppliedMlIoTByeictIitGuwagatModel
         ->updateResumeByID($insertId, $fileStatus['file_name']);

    // ===== MAIL DATA =====
    $mailData = $data;
    $mailData['resume_link'] = base_url(
        'uploads/applicant_resume/'.$fileStatus['file_name']
    );

    // ===== SEND MAIL (ALAG FUNCTION) =====
    $this->DsMlGenaiConfirmEmail($mailData);

    echo json_encode([
        'message'  => 'success',
        'response' => 'Your Application Submitted Successfully!'
    ]);
}



public function DsMlGenaiConfirmEmail($data){

    $from = "enquiry@theiotacademy.co";
    $to = "admissions.eictiitr@theiotacademy.co";

    $this->email->clear(TRUE);
    $this->email->from($from,'Enquiry | The IoT Academy');
    $this->email->to($to);

    $this->email->subject(
        'Application Received - '.$data['applicant_came_from']
    );

    $this->email->message(
        $this->load->view(
            'mailFormat/genai_application_admin',
            $data,
            TRUE
        )
    );

    $this->email->send();
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
                $message=$errors[]="File Field is Required and Please choose PDF or Docx file only.";
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
		$from_email = "enquiry@theiotacademy.co";
		$to_email = "admissions.eictiitg@theiotacademy.co";

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

      public function admin_advanced_generative_ai_mail($data){

        //------Email Section-----
      $from_email = "enquiry@theiotacademy.co";
      $to_email = "info.eict@theiotacademy.co";

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


      public function admin_ds_ml_genrativeai_mail($data){

        //------Email Section-----
      $from_email = "enquiry@theiotacademy.co";
      $to_email = "admissions.eictiitr@theiotacademy.co";

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

    public function admin_ml_ai_inhouse_iitg_Email($data){
         $from_email = "enquiry@theiotacademy.co";
      $to_email = "admissions@theiotacademy.co";

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

public function special_corporate_registration_form(){
         $this->form_validation->set_rules('name','Name','trim|required|min_length[2]|max_length[100]');
         $this->form_validation->set_rules('email','Email ID','required|valid_email');
         $this->form_validation->set_rules('company','Degree','required');
         $this->form_validation->set_rules('designation','designation','required');
         $this->form_validation->set_rules('mobile','Mobile Number','required|numeric|max_length[15]');
         $this->form_validation->set_rules('no_of_enroll','Number Of Enrollment','required');
         // $this->form_validation->set_rules('group_query','Query','required');
        if($this->form_validation->run()){
                     
                    $name=$this->input->post('name');
                    $email=$this->input->post('email');
                    $company=$this->input->post('company');
                    $designation=$this->input->post('designation');
                    $mobile=$this->input->post('mobile');
                    $no_of_enroll=$this->input->post('no_of_enroll');
                    $query=$this->input->post('group_query');
                    $page_url=$this->input->post('url_source');

            $data=array(
                    'name'=>$name,
                    'email'=>$email,
                    'company'=>$company,
                    'designation'=>$designation,
                    'mobile'=>$mobile,
                    'no_of_enrollment'=>$no_of_enroll,
                    'query'=>$query ? $query : " ",
                    'page_url'=>$page_url
            );
             $isExist=$this->AppliedMlIoTByeictIitGuwagatModel->isEmailExistspecialcorporate($email);
             if (!$isExist) {
            $corporate_id=$this->AppliedMlIoTByeictIitGuwagatModel->SpCorporateRegistrationForm($data);
            
            if($corporate_id>0){
                    $this->admin_special_corporate_Email($data);
                    //$user_ml_iot_iitg_mail_status=$this->user_ml_iot_iitg_Email($data);
                    //Send mail
                        print json_encode(array('message'=>'success','response'=>"Your Application Requested Successfully."));
                }
                  
            else{
                print_r(json_encode(array('message' => 'sererror','response'=>'Application Failed! Try Again')));
            }
            }
            else{
              print_r(json_encode(array('message' => 'sererror','response'=>'You Have Already Exists !')));
            }   
        }
        else{
            print_r(json_encode(array('message' => 'error','response'=>validation_errors())));
        }
    }

    //mail for special corporate admin
    public function admin_special_corporate_Email($data){

        //------Email Section-----
        $from_email = "enquiry@theiotacademy.co";
        $to_email = "admissions.eictiitg@theiotacademy.co";

        $this->email->from($from_email,'Enquiry | The IoT Academy'); 
        $this->email->to($to_email);
        $this->email->subject('Application Request Received for special discount through Website by ' .$data['name']);
        $this->email->message($this->load->view('mailFormat/special_discount_iitg_admin',$data,TRUE)); 
         // $this->email->attach(mliotresume_url().'applicantresume/'.$regdata['applicant_resume']);
        //Sending Email
        if($this->email->send()){
            $this->email->clear(TRUE);//Clear past attached file
            return TRUE ;

        }else{

            return FALSE ;
        }

    }
    //end special corporate admin

}

?>



