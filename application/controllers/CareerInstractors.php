<?php 

defined('BASEPATH') OR exit('No direct script access allowed');  

class CareerInstractors extends CI_Controller{



	public function __construct(){ 

		parent::__construct();

	    error_reporting(0);

	    $this->load->helper('utility_helper');

	    $this->load->library('form_validation');

	    $this->load->model('AppModel');

	    $this->load->model('EmployeeModel');

	    $this->load->model('UserModel');

	    $this->load->model('DesigModel');

	    $this->load->model('UserTypeModel');

	    $this->load->model('StudentModel');

	    $this->load->model('CareersInstractorsModel');

	    $this->load->library('session');

	    $this->load->library('email');

	}



   public function instructors()

    {  

      $this->load->view('instructors'); 

    }

   



	public function liveCIDataSubmit()

	{	

		  //Validating the information

		  //error messages

		  

		  $emailerrmsg=array(

		  				'required'=>'Email Cannot Be Empty.',

		  				'valid_email'=>'Email Must Be A Valid Email.'

		  				) ;

		  

		  $this->form_validation->set_rules('email','Email ID','required|valid_email',$emailerrmsg);



		if($this->form_validation->run()){



			$email_id=$this->input->post('email');

		  	$pass_key='tia'.mt_rand(100000, 999999);



		  	$user_type_id=3;//For Trainer



		  	$password="nil";

		  	  //---------Database Section---------------



		  	$existstatus=$this->UserModel->isEmailExistsInUsers($email_id);



		  	if(!$existstatus){

				 	

			$user_id=$this->UserModel->insertUser($email_id,$password,$user_type_id) ;



			if($user_id){



				$fdpdataid=$this->CareersInstractorsModel->insertLiveCareer($user_id,$email_id,$pass_key);



				if($fdpdataid){ 

					

					$status=$this->sendEmailtoInstructor($email_id,$fdpdataid,$pass_key);



					$emailMsg='Please contact to admin ';



					if($status){



						$emailMsg='<br>Confirmation mail has been send please check your e-mail !';

					}

				

				 	$this->session->set_flashdata("success","Successfully.".$emailMsg);



				}else{        

		                  $this->session->set_flashdata("error","Error Occured");

		                  

				}

		}else{



			$this->session->set_flashdata("error","Error Occured");

		}



		}else{



			 	$this->session->set_flashdata("error","This email is already exist try another one.<br> Or contact to Admin.");

		}

		

	}

	else{

		

			$this->session->set_flashdata('error',validation_errors());

    	}

       

        redirect(base_url()."instructors-apply");

    }



        // CareerInstractors/index

        function sendEmailtoInstructor($to_email,$Enqid,$pass_key)

			{



			    $pass_key=md5($pass_key);

			

			 //------Email Section----------------------

			 	$from_email = "enquiry@theiotacademy.co";

		 		

		 		$message='Hii  We have recived your Query.<br>'."</strong> with Reg. ID: <strong>".$Enqid."</strong>Click To Create Your Password 

		 			<a href='".base_url()."CareerInstractors/createPassword/".$pass_key."' target='_blank'>".base_url()."CareerInstractors/createPassword/".$pass_key."<a/>  



		 			<br><br>Thanks.<br>The IoT Academy<br>3rd Floor, NIMS Building, C-56/11, Sector-62, Noida, U.P" ;



				 $this->load->library('email');



	       		 $this->email->clear(true); 



				 $this->email->from($from_email,'The IOT Website'); 

				 $this->email->to($to_email);

				 $this->email->subject('Career Instractors Confirmation Email'); 

				 $this->email->message($message); 



				 echo "before send";			 

				 //Send mail

				 $status=false;



				 if($this->email->send()){



					 echo "send";



					$status=true;



				 }

					 

			return $status;

					

		}





		public function createPassword($key)

		{



			

			$data=$this->CheckPasswordStatus($key);



			if($data['status']){



				$this->load->view('instructor_login',$data);

				

			}else{



				echo "Invalid Url Link";

				$this->session->set_flashdata("error","Invalid Url Link");

				redirect(base_url());

			}



		}





		public function CheckPasswordStatus($id)

		{

			$status=$this->CareersInstractorsModel->CheckPasswordStatus($id);

			return $status;

		}







		public function createPass()

		{

		

			



			$passerrmsg=array(

	  					'required'=>'Password cannot Be Empty.',

						'min_length'=>'Minium 6 Character Required'

						);

			

			$this->form_validation->set_rules('password', 'password', 'required|min_length[6]|max_length[20]',$passerrmsg);



			if($this->form_validation->run()){



				$id=$this->input->post('id');

				$email_id=$this->input->post('email_id');

				$password=$this->input->post('password');

				//echo($email_id);

				//echo($password);

				$staus=$this->CareersInstractorsModel->resetPasswordInstructor($email_id,$password);



				$emailStatus=$this->passChangeMailInstructor($email_id,$password);

				if($staus&&$emailStatus){



					$this->session->set_flashdata('success','Password Updated Sucecssfully.<brAnd Password Has been Sent to Your Email.');

				}else{

					$this->session->set_flashdata('error','Some Error Occured! Try Again');

					redirect($actual_link);

				}



			}else{

				$this->session->set_flashdata('error',validation_errors());

				redirect($actual_link);

	            

			}

			redirect(base_url());

		}





	public function passChangeMailInstructor($email_id,$password)

	{

	   		$from_email = "enquiry@theiotacademy.co";

	      	$to_email = $email_id;

	       $this->email->from($from_email,'The IOT Academy'); 

	       $this->email->to($to_email);

	       $this->email->subject('Password  Changes Confirmation '); 

	       $this->email->message(



	        'Your password has been created successfully <br>'.

	        'Password : <h4>'.$password.

	        '</h4><br>Regards,<br><br>'.

	        'The IoT Academy<br>'.

	        '<strong>Whatsapp</strong>- <a href="tel:+91 8287096558">+91 8287096558</a>'

	    ); 



	       if ($this->email->send()) {

	            $status = true;

	       }else{

	            $status = false;

	       }

	  return $status;

	}



}



?>