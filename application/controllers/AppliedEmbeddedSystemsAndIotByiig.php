<?php 
defined('BASEPATH') OR exit('No direct script access allowed');  
class AppliedEmbeddedSystemsAndIotByiig extends CI_Controller{

	public function __construct(){ 

		parent::__construct();
	    error_reporting(0);
	    $this->load->helper('utility_helper');
	    $this->load->library('form_validation');
	    $this->load->model('AppliedModel');
	     $this->load->model(['LiveLeadModel', 'AppliedMlIoTByeictIitGuwagatModel']);
	    $this->load->library('session');
	    $this->load->library('email'); 

	}

public function embedded_systems_and_iot_by_eict_iitg(){
  redirect('https://www.theiotacademy.co',301);
}



//start download broucher form submitfun and send admin mail

    public function DownloadBroucherOfIotIig(){
			 $nameerrmsg=array(

	  					'required'=>'Name Cannot Be Empty.',
						'alpha_numeric_spaces'=>'Name Must Contain Only Letters of English Alphabet and Spaces.'

						) ;

			$mobileerrmsg=array(

						'required'=>'Mobile No. Can not Be Empty.',
						'numeric'=>'Mobile No. Must Be 10-Digit Number',
						'exact_length'=>'Mobile No. Must Be 10-Digit Number'

						) ;

			$emailmsg=array(

						'required'=>'Email Can not Be Empty.'

						) ;			

	   

       

	  	$this->form_validation->set_rules('fullname','Name','required|alpha_numeric_spaces',$nameerrmsg);

		$this->form_validation->set_rules('email','email','required',$emailmsg);

	  	$this->form_validation->set_rules('mobileno','Mobile No.','required|numeric',$mobileerrmsg);

    		

        if($this->form_validation->run()){ 	

        	    $name=$this->input->post('fullname');

				$mobile_no=$this->input->post('mobileno');

				$email_id=$this->input->post('email');

				$workexperience=$this->input->post('workexperience');

				$form_name=$this->input->post('form_name');

				$url_source=$this->input->post('url_source');

                $data=array(

				    'name'=>$name,

					'email_id'=>$email_id,

					'mobile_no'=>$mobile_no,

					'message'=>$workexperience ? $workexperience : " ",

					'came_from'=>$form_name,

					'url_source'=>$url_source

			    );

		 	 $isExistEmail=$this->AppliedMlIoTByeictIitGuwagatModel->isEmailExistsAppliedMlIotIIG($email);



		 	if(!$isExistEmail){

	 		$broucher_id=$this->AppliedMlIoTByeictIitGuwagatModel->DownloadMLWithIotBroucherForm($data);

	  		if($broucher_id>0){

		 		 $admin_Download_Broucher_mail_status=$this->admin_Download_Broucher_Email($data);

		 		//Send mail

			 	if($admin_Download_Broucher_mail_status){
	 		        print json_encode(array('message'=>'SUCCESS','response'=>" Brochure Downloaded Successfully."));
	            }else{

			        die(json_encode(array('message' => 'success', 'response'=>"Brochure Downloaded Successfully."))); 

				}

	        }

	        else{
		        print_r(json_encode(array('message' => 'sererror','response'=>'Brochure Downloaded Failed! Try Again')));

	        }   

    	}

    	else{
		    print_r(json_encode(array('message' => 'error','response'=>'You Have Already Downloded This Brochure !')));
		 	}

    	}else{
        	print_r(json_encode(array('message' => 'error','response'=>validation_errors())));

		}



    }   



     //start  admin mail

    public function admin_Download_Broucher_Email($data){

		$from_email = "enquiry@theiotacademy.co";

		$to_email = "info@theiotacademy.co";

		 

		$this->email->from($from_email,'Enquiry | The IoT Academy'); 

		$this->email->to($to_email);

		$this->email->subject('IIT-G Embedded Systems and IoT Broucher Downloded By '.$data['name'].' through Website'); 

		$this->email->message($this->load->view('mailFormat/adminmail_of_mlwithiot_iig_brochure',$data,TRUE)); 

        //Sending Email

        if($this->email->send()){

        	return TRUE ;

        }else{

        	return FALSE ;

        }

  	}



//end download broucher form submit

  	//start download Project list form submitfun and send admin mail

    public function DownloadProjectListOfMlIotIig(){
			 $nameerrmsg=array(

	  					'required'=>'Name Cannot Be Empty.',

						'alpha_numeric_spaces'=>'Name Must Contain Only Letters of English Alphabet and Spaces.'

						) ;

			$mobileerrmsg=array(

						'required'=>'Mobile No. Can not Be Empty.',

						'numeric'=>'Mobile No. Must Be 10-Digit Number',

						'exact_length'=>'Mobile No. Must Be 10-Digit Number'

						) ;

			$emailmsg=array(

						'required'=>'Email Can not Be Empty.'

						) ;			

	  	$this->form_validation->set_rules('fullname','Name','required|alpha_numeric_spaces',$nameerrmsg);
		$this->form_validation->set_rules('email','email','required',$emailmsg);
	  	$this->form_validation->set_rules('mobileno','Mobile No.','required|numeric',$mobileerrmsg);
        if($this->form_validation->run()){ 	
        	    $name=$this->input->post('fullname');
				$mobile_no=$this->input->post('mobileno');
				$email_id=$this->input->post('email');
				$workexperience=$this->input->post('workexperience');
				$form_name=$this->input->post('form_name');
				$url_source=$this->input->post('url_source');

                $data=array(

				    'name'=>$name,

					'email_id'=>$email_id,

					'mobile_no'=>$mobile_no,

					'message'=>$workexperience ? $workexperience : " ",

					'came_from'=>$form_name,

					'url_source'=>$url_source

			    );

		 	 $isExistEmail=$this->AppliedMlIoTByeictIitGuwagatModel->isEmailExistsAppliedMlIotIIG($email);
		 	if(!$isExistEmail){

	 		$project_id=$this->AppliedMlIoTByeictIitGuwagatModel->DownloadMLWithIotBroucherForm($data);

	  		if($project_id>0){

		 		 $admin_Download_Projectlist_mail_status=$this->admin_Download_Projectlist_Email($data);

		 		//Send mail

			 	if($admin_Download_Projectlist_mail_status){
	 		        print json_encode(array('message'=>'success','response'=>" Project List Downloaded Successfully."));

	            }else{
			        die(json_encode(array('message' => 'success', 'response'=>" Project List Downloaded Successfully."))); 

				}

	        }

	        else{
		        print_r(json_encode(array('message' => 'sererror','response'=>'Download Project List Failed! Try Again')));

	        }   

    	}

    	else{
		    print_r(json_encode(array('message' => 'sererror','response'=>'You Have Already Downloded This Project List !')));

		 	}

    	}else{
        	print_r(json_encode(array('message' => 'error','response'=>validation_errors())));

		}



    }   



     //start admin mail

    public function admin_Download_Projectlist_Email($data){



		$from_email = "enquiry@theiotacademy.co";

		$to_email = "info@theiotacademy.co";

		 

		$this->email->from($from_email,'Enquiry | The IoT Academy'); 

		$this->email->to($to_email);

		$this->email->subject('IIT-G Embedded Systems and IoT Project List Downloded By '.$data['name'].' through Website'); 

		$this->email->message($this->load->view('mailFormat/adminmail_of_mlwithiot_iig_Projectlist',$data,TRUE)); 

        //Sending Email

        if($this->email->send()){

        	return TRUE ;

        }else{

        	return FALSE ;

        }

  	}



//end download project list form submit



//start download Curriculum list form submit and send admin mail

    public function DownloadCurriculumListOfMlIotIig(){

             

			 $nameerrmsg=array(

	  					'required'=>'Name Cannot Be Empty.',

						'alpha_numeric_spaces'=>'Name Must Contain Only Letters of English Alphabet and Spaces.'

						) ;

			$mobileerrmsg=array(

						'required'=>'Mobile No. Can not Be Empty.',

						'numeric'=>'Mobile No. Must Be 10-Digit Number',

						'exact_length'=>'Mobile No. Must Be 10-Digit Number'

						) ;

			$emailmsg=array(

						'required'=>'Email Can not Be Empty.'

						) ;			
	  	$this->form_validation->set_rules('fullname','Name','required|alpha_numeric_spaces',$nameerrmsg);

		$this->form_validation->set_rules('email','email','required',$emailmsg);

	  	$this->form_validation->set_rules('mobileno','Mobile No.','required|numeric',$mobileerrmsg);

    		

        if($this->form_validation->run()){ 	

        	    $name=$this->input->post('fullname');

				$mobile_no=$this->input->post('mobileno');

				$email_id=$this->input->post('email');

				$workexperience=$this->input->post('workexperience');

				$form_name=$this->input->post('form_name');

				$url_source=$this->input->post('url_source');

                $data=array(

				    'name'=>$name,

					'email_id'=>$email_id,

					'mobile_no'=>$mobile_no,

					'message'=>$workexperience ? $workexperience : " ",

					'came_from'=>$form_name,

					'url_source'=>$url_source

			    );

		 	 $isExistEmail=$this->AppliedMlIoTByeictIitGuwagatModel->isEmailExistsAppliedMlIotIIG($email);



		 	if(!$isExistEmail){

	 		$curriculum_id=$this->AppliedMlIoTByeictIitGuwagatModel->DownloadMLWithIotBroucherForm($data);

	  		if($curriculum_id>0){

		 		 $admin_Download_Curriculumlist_mail_status=$this->admin_Download_Curriculumlist_Email($data);

		 		//Send mail

			 	if($admin_Download_Curriculumlist_mail_status){
	 		        print json_encode(array('message'=>'success','response'=>" Curriculum List Downloaded Successfully."));

	            }else{
			        die(json_encode(array('message' => 'success', 'response'=>"Curriculum List Downloaded Successfully."))); 

				}

	        }

	        else{
		        print_r(json_encode(array('message' => 'sererror','response'=>'Download Curriculum List Failed! Try Again')));

	        }   

    	}

    	else{
		        print_r(json_encode(array('message' => 'sererror','response'=>'You Have Already Downloded This Curriculum List !')));

		 	}

    	}else{
        	print_r(json_encode(array('message' => 'error','response'=>validation_errors())));

		}



    }   



     //start  admin mail

    public function admin_Download_Curriculumlist_Email($data){



		$from_email = "enquiry@theiotacademy.co";

		$to_email = "info@theiotacademy.co";

		 

		$this->email->from($from_email,'Enquiry | The IoT Academy'); 

		$this->email->to($to_email);

		$this->email->subject('IIT-G Embedded Systems and IoT Curriculum List Downloded By '.$data['name'].' through Website'); 

		$this->email->message($this->load->view('mailFormat/adminmail_of_mlwithiot_iig_Curriculumlist',$data,TRUE)); 

        //Sending Email

        if($this->email->send()){

        	return TRUE ;

        }else{

        	return FALSE ;

        }

  	}



//end download Curriculum list form submit


  	//start Talk To Counselor  form submitfun and send admin mail

    public function TalkToCounselorSubmitForm(){

       			 $nameerrmsg=array(
	  					'required'=>'Name Cannot Be Empty.',
						'alpha_numeric_spaces'=>'Name Must Contain Only Letters of English Alphabet and Spaces.'
						) ;

			$mobileerrmsg=array(
						'required'=>'Mobile No. Can not Be Empty.',
						'numeric'=>'Mobile No. Must Be 10-Digit Number',
						'exact_length'=>'Mobile No. Must Be 10-Digit Number'
						);

			$emailmsg=array(
						'required'=>'Email Can not Be Empty.'
						) ;			
	  	$this->form_validation->set_rules('fullname','Name','required|alpha_numeric_spaces',$nameerrmsg);
		$this->form_validation->set_rules('email','email','required',$emailmsg);
	  	$this->form_validation->set_rules('mobileno','Mobile No.','required|numeric',$mobileerrmsg);

    		

        if($this->form_validation->run()){ 	

        	    $name=$this->input->post('fullname');
				$mobile_no=$this->input->post('mobileno');
				$email_id=$this->input->post('email');
				$workexperience=$this->input->post('workexperience');
				$form_name=$this->input->post('form_name');
				$url_source=$this->input->post('url_source');
                $data=array(
				    'name'=>$name,
					'email_id'=>$email_id,
					'mobile_no'=>$mobile_no,
					'message'=>$workexperience ? $workexperience : " ",
					'came_from'=>$form_name,
					'url_source'=>$url_source
			    );

		 	 $isExistEmail=$this->AppliedMlIoTByeictIitGuwagatModel->isEmailExistsAppliedMlIotIIG($email);



		 	if(!$isExistEmail){

	 		$Talk_id=$this->AppliedMlIoTByeictIitGuwagatModel->DownloadMLWithIotBroucherForm($data);

	  		if($Talk_id>0){

		 		 $admin_Talk_TO_Counselor_mail_status=$this->admin_Talk_To_Counselor_Email($data);

		 		//Send mail

			 	if($admin_Talk_TO_Counselor_mail_status){
	 		        print json_encode(array('message'=>'success','response'=>"You have Submitted Successfully Details."));

	            }else{
			        die(json_encode(array('message' => 'success', 'response'=>"You have Submitted Successfully Details."))); 

				}
	        }

	        else{
		        print_r(json_encode(array('message' => 'error','response'=>'Detalis Submission Failed! Try Again')));

	        }   

    	}

    	else{
		        print_r(json_encode(array('message' => 'error','response'=>'You Have Already Submitted Your Details!')));

		 	}

    	}
		else{
        	print_r(json_encode(array('message' => 'error','response'=>validation_errors())));

		}


    }   

	

     //start talk to counselor  admin mail

    public function admin_Talk_To_Counselor_Email($data){



		$from_email = "enquiry@theiotacademy.co";

		$to_email = "info@theiotacademy.co";

		 

		$this->email->from($from_email,'Talk TO Counselor Enquiry | The IoT Academy'); 

		$this->email->to($to_email);

		$this->email->subject('Talk To Counselor Detalis Submitted By '.$data['name'].' through Website'); 

		$this->email->message($this->load->view('mailFormat/adminmail_of_talk_to_counselor',$data,TRUE)); 

        //Sending Email

        if($this->email->send()){

        	return TRUE ;

        }else{

        	return FALSE ;

        }

  	}

//end talk to counselor form submit
 

}

?>



