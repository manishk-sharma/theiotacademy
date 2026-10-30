<?php 

defined('BASEPATH') OR exit('No direct script access allowed');  

class AppliedDataScienceCertification extends CI_Controller{



	public function __construct(){ 

		parent::__construct();

	    error_reporting(0);

	    $this->load->helper('utility_helper');

	    $this->load->library('form_validation');

	    $this->load->model('AppliedModel');

	    $this->load->library('session');

	    $this->load->library('email'); 

	}

public function data_science_and_ai_new_page(){
  $this->load->view('applied_data_science_with_python_certification_program');
  //redirect("https://www.theiotacademy.co/machine-learning-with-python-training-in-noida",302);
}

 public function data_scince_submit_form(){

         $this->form_validation->set_rules('name','Name','trim|required|min_length[2]|max_length[40]');

    	 $this->form_validation->set_rules('email','Email ID','required|valid_email');

    	 $this->form_validation->set_rules('mobile','Mobile Number','required|numeric|max_length[15]');

         $this->form_validation->set_rules('state','State','required');

    	 $this->form_validation->set_rules('city','City','required');

    		

        if($this->form_validation->run()){ 

                 $email=$this->input->post('email');	

                $data=array(

		    	    'name'=>$this->input->post('name'),

			        'email'=>$email,

			        'mobile'=>$this->input->post('mobile'),

			        'state'=>$this->input->post('state'),

			        'city'=>$this->input->post('city'),

			        'url_source'=>$this->input->post('url_data_name'),

			    );

		 	

		 	$isExist=$this->AppliedModel->isEmailExistsAppliedDataScience($email);



		 	if(!$isExist){

	 		$datascience_id=$this->AppliedModel->DataScienceForm($data);

	  		if($datascience_id>0){

		 		 $admin_datascience_mail_status=$this->admin_data_science_Email($data);

		 		$user_datascience_mail_status=$this->user_data_science_ConfirmEmail($data);

		 		//Send mail

			 	if($admin_datascience_mail_status){



	 			 	header('Content-Type: application/json');

	 		        print json_encode(array('message'=>'SUCCESS','response'=>"&#x2714; Your Application Requested Successfully."));

	            }else{



	 		        //header('HTTP/1.1 500 Internal Server');

	 		        header('Content-Type: application/json; charset=UTF-8');

			        die(json_encode(array('message' => 'SUCCESS', 'response'=>"&#x2714;Your Applocation Requested Successfully ."))); 

				}

	        }

	        else{

		        header('HTTP/1.1 501 Internal Server');

		        header('Content-Type: application/json; charset=UTF-8');

		        print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 501 ,'response'=>'data scienceApplication Failed! Try Again')));

	        }   

    	}

        else{

		 		header('HTTP/1.1 501 Internal Server');

		        header('Content-Type: application/json; charset=UTF-8');

		        print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 501 ,'response'=>'Your Application Already Submitted  !')));

		 	}

    	}else{

        	header('HTTP/1.1 500 Internal Server');

        	header('Content-Type: application/json; charset=UTF-8');

        	print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 500,'response'=>validation_errors())));

		}



    }   



     //start data science admin mail

    public function admin_data_science_Email($data){



  		//------Email Section-----

		$from_email = "programs.eictiitr@theiotacademy.co";

		$to_email = "enquiries.eictiitr@theiotacademy.co";

		 

		$this->email->from($from_email,'Enquiry | The IoT Academy'); 

		$this->email->to($to_email);

		$this->email->subject('IIT-R Data Science Application Request Received through Website By ' .$data['name']); 

		$this->email->message($this->load->view('mailFormat/admin_data_science_reg_mail',$data,TRUE)); 

        //Sending Email

        if($this->email->send()){

        	return TRUE ;

        }else{

        	return FALSE ;

        }

  	}

  //end  data scienceadmin mail



  //sending user data science confirmation mail

    public function user_data_science_ConfirmEmail($data){



  		//------Email Section-----

		$from_email = "programs.eictiitr@theiotacademy.co";

		$to_email = $data['email'];

		$this->email->from($from_email,'Enquiry | The IoT Academy'); 

		$this->email->to($to_email);

		$this->email->subject('Congratulations '.$data['name']. '! Your Application  Requested Successfully'); 

		$this->email->message($this->load->view('mailFormat/user_data_science_reg_mail',$data,TRUE));

        //Sending Email

        if($this->email->send()){

        	return TRUE ;

        }else{

        	return FALSE ;

        }

    }

//end data sciencesubmit form and send mail admin and user



//start download broucher form submitfun and send admin mail

    public function data_scince_download_broucher_form(){



         $this->form_validation->set_rules('bname','Name','trim|required|min_length[2]|max_length[40]');

    	 $this->form_validation->set_rules('bemail','Email ID','required|valid_email');

    	 $this->form_validation->set_rules('bmobile','Mobile Number','required|numeric|max_length[15]');

         //$this->form_validation->set_rules('bquery','Query','required');

    		

        if($this->form_validation->run()){ 	

        	    $email=$this->input->post('bemail');

                $data=array(

		    	    'name'=>$this->input->post('bname'),

			        'email'=>$email,

			        'mobile'=>$this->input->post('bmobile'),

			        'query'=>$this->input->post('bquery'),

			        'url_source'=>$this->input->post('url_broucher_name'),

			    );

		 	 $isExistEmail=$this->AppliedModel->isEmailExistsAppliedDataScience($email);



		 	if(!$isExistEmail){

	 		$broucher_id=$this->AppliedModel->DownloadBroucherForm($data);

	  		if($broucher_id>0){

		 		 $admin_Download_Broucher_mail_status=$this->admin_Download_Broucher_Email($data);

		 		//Send mail

			 	if($admin_Download_Broucher_mail_status){



	 			 	header('Content-Type: application/json');

	 		        print json_encode(array('message'=>'SUCCESS','response'=>"&#x2714; Your Application Requested Successfully."));

	            }else{



	 		        //header('HTTP/1.1 500 Internal Server');

	 		        header('Content-Type: application/json; charset=UTF-8');

			        die(json_encode(array('message' => 'SUCCESS', 'response'=>"&#x2714;Your Applocation Requested Successfully ."))); 

				}

	        }

	        else{

		        header('HTTP/1.1 501 Internal Server');

		        header('Content-Type: application/json; charset=UTF-8');

		        print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 501 ,'response'=>'Download Broucher Failed! Try Again')));

	        }   

    	}

    	else{

		 		header('HTTP/1.1 501 Internal Server');

		        header('Content-Type: application/json; charset=UTF-8');

		        print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 501 ,'response'=>'You Have Already Downloded This Syllalus !')));

		 	}

    	}else{

        	header('HTTP/1.1 500 Internal Server');

        	header('Content-Type: application/json; charset=UTF-8');

        	print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 500,'response'=>validation_errors())));

		}



    }   



     //start data science admin mail

    public function admin_Download_Broucher_Email($data){



  		//------Email Section-----

		$from_email = "programs.eictiitr@theiotacademy.co";

		$to_email = "enquiries.eictiitr@theiotacademy.co";

		 

		$this->email->from($from_email,'Enquiry | The IoT Academy'); 

		$this->email->to($to_email);

		$this->email->subject('IIT-R Data Science Broucher Downloded By '.$data['name'].' through Website'); 

		$this->email->message($this->load->view('mailFormat/admin_download_broucher_mail',$data,TRUE)); 

        //Sending Email

        if($this->email->send()){

        	return TRUE ;

        }else{

        	return FALSE ;

        }

  	}

  //end  download broucher mail



//end download broucher form submit

  

}

?>



