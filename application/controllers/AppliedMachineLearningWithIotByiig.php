<?php


defined('BASEPATH') or exit('No direct script access allowed');

class AppliedMachineLearningWithIotByiig extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		error_reporting(0);
		$this->load->helper('utility_helper');
		$this->load->library('form_validation');
		$this->load->model(['LiveLeadModel', 'AppliedMlIoTByeictIitGuwagatModel']);
		$this->load->library('session');
		$this->load->library('email');
	}

	public function advanced_generative_ai_course()
	{
		$this->load->view('advanced_generative_ai');
	}
	public function advanced_9m_ds_ml_ai()
	{
		$this->load->view('ds_ml_and_ai_9m_eict_iitg');
	}
	//start Roorkee
	public function roorkee_ds_ml_9m_iot_certification()
	{
		$this->load->view('iitroorkee_ds_ml_and_ai_9m_eict');
	}
	public function advanced_generative_ai_course_iitr()
	{
		$this->load->view('advanced_generative_ai_iitr');
	}
	// end Roorkee

	public function professional_data_analytics_crs_by_iitg()
	{
		$this->load->view('professional_data_analytics_program_by_iit_guwahati');
	}

	public function online_certification_in_basic_embedded_system_and_iot_by_eict_academy_iit_guwahati()
	{
		$this->load->view('online_certification_in_basic_embedded_system_and_iot_by_eict_academy_iit_guwahati');
	}

	public function online_certification_in_iot_cloud_computing_and_edge_ai_by_eict_academy_iit_guwahati()
	{
		$this->load->view('online_certification_in_iot_cloud_computing_and_edge_ai_by_eict_academy_iit_guwahati');
	}
	public function online_data_science_machine_learning_and_edge_ai_with_python_by_eict_iit_guwahati()
	{
		$this->load->view('online_data_science_machine_learning_and_edge_ai_with_python_by_eict_iit_guwahati');
	}

	public function datascience_machine_learning_and_iot_in_middle_east()
	{
		$this->load->view('data_science_machine_learning_iot_in_middle_east');
	}

	public function datascience_and_machine_learning_in_africa()
	{
		$this->load->view('data_science_and_machine_learning_in_africa');
	}

	public function machine_learning_with_iot_by_eict_iitg()
	{
		//$this->load->view('data_science_machine_learning_and_iot_by_eict_iitg');
		header("Location: https://www.theiotacademy.co/advanced-certification-in-data-science-machine-learning-and-ai-by-eict-iitg", true, 301);
	}


	//start download broucher form submitfun and send admin mail

	public function DownloadBroucherOfIotIig()
	{


		$nameerrmsg = array(

			'required' => 'Name Cannot Be Empty.',
			'alpha_numeric_spaces' => 'Name Must Contain Only Letters of English Alphabet and Spaces.'

		);

		$mobileerrmsg = array(

			'required' => 'Mobile No. Can not Be Empty.',

			'numeric' => 'Mobile No. Must Be 10-Digit Number',

			'exact_length' => 'Mobile No. Must Be 10-Digit Number'

		);

		$emailmsg = array(

			'required' => 'Email Can not Be Empty.'

		);



		$this->form_validation->set_rules('fullname', 'Name', 'required|alpha_numeric_spaces', $nameerrmsg);

		$this->form_validation->set_rules('email', 'email', 'required', $emailmsg);

		$this->form_validation->set_rules('mobileno', 'Mobile No.', 'required|numeric', $mobileerrmsg);



		if ($this->form_validation->run()) {

			$name = $this->input->post('fullname');

			$mobile_no = $this->input->post('mobileno');

			$email_id = $this->input->post('email');

			$workexperience = $this->input->post('workexperience');

			$form_name = $this->input->post('form_name');

			$url_source = $this->input->post('url_source');

			$data = array(

				'name' => $name,

				'email_id' => $email_id,

				'mobile_no' => $mobile_no,

				'message' => $workexperience ? $workexperience : " ",

				'came_from' => $form_name,

				'url_source' => $url_source

			);

			$isExistEmail = $this->AppliedMlIoTByeictIitGuwagatModel->isEmailExistsAppliedMlIotIIG($email);



			if (!$isExistEmail) {

				$broucher_id = $this->AppliedMlIoTByeictIitGuwagatModel->DownloadMLWithIotBroucherForm($data);

				if ($broucher_id > 0) {

					$admin_Download_Broucher_mail_status = $this->admin_Download_Broucher_Email($data);

					//Send mail

					if ($admin_Download_Broucher_mail_status) {



						header('Content-Type: application/json');

						print json_encode(array('message' => 'SUCCESS', 'response' => " Brochure Downloaded Successfully."));
					} else {



						//header('HTTP/1.1 500 Internal Server');

						header('Content-Type: application/json; charset=UTF-8');

						die(json_encode(array('message' => 'SUCCESS', 'response' => " Brochure Downloaded Successfully.")));
					}
				} else {

					header('HTTP/1.1 501 Internal Server');

					header('Content-Type: application/json; charset=UTF-8');

					print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 501, 'response' => 'Download Brochure Failed! Try Again')));
				}
			} else {

				header('HTTP/1.1 501 Internal Server');

				header('Content-Type: application/json; charset=UTF-8');

				print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 501, 'response' => 'You Have Already Downloded This Brochure !')));
			}
		} else {

			header('HTTP/1.1 500 Internal Server');

			header('Content-Type: application/json; charset=UTF-8');

			print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 500, 'response' => validation_errors())));
		}
	}



	//start  admin mail

	public function admin_Download_Broucher_Email($data)
	{



		$from_email = "enquiry@theiotacademy.co";

		$to_email = "info@theiotacademy.co";



		$this->email->from($from_email, 'Enquiry | The IoT Academy');

		$this->email->to($to_email);

		$this->email->subject('IIT-G Machine Learning With IoT Broucher Downloded By ' . $data['name'] . ' through Website');

		$this->email->message($this->load->view('mailFormat/adminmail_of_mlwithiot_iig_brochure', $data, TRUE));

		//Sending Email

		if ($this->email->send()) {

			return TRUE;
		} else {

			return FALSE;
		}
	}



	//end download broucher form submit




	//start download Project list form submitfun and send admin mail

	public function DownloadProjectListOfMlIotIig()
	{



		$nameerrmsg = array(

			'required' => 'Name Cannot Be Empty.',

			'alpha_numeric_spaces' => 'Name Must Contain Only Letters of English Alphabet and Spaces.'

		);

		$mobileerrmsg = array(

			'required' => 'Mobile No. Can not Be Empty.',

			'numeric' => 'Mobile No. Must Be 10-Digit Number',

			'exact_length' => 'Mobile No. Must Be 10-Digit Number'

		);

		$emailmsg = array(

			'required' => 'Email Can not Be Empty.'

		);





		$this->form_validation->set_rules('fullname', 'Name', 'required|alpha_numeric_spaces', $nameerrmsg);

		$this->form_validation->set_rules('email', 'email', 'required', $emailmsg);

		$this->form_validation->set_rules('mobileno', 'Mobile No.', 'required|numeric', $mobileerrmsg);



		if ($this->form_validation->run()) {

			$name = $this->input->post('fullname');

			$mobile_no = $this->input->post('mobileno');

			$email_id = $this->input->post('email');

			$workexperience = $this->input->post('workexperience');

			$form_name = $this->input->post('form_name');

			$url_source = $this->input->post('url_source');

			$data = array(

				'name' => $name,

				'email_id' => $email_id,

				'mobile_no' => $mobile_no,

				'message' => $workexperience ? $workexperience : " ",

				'came_from' => $form_name,

				'url_source' => $url_source

			);

			$isExistEmail = $this->AppliedMlIoTByeictIitGuwagatModel->isEmailExistsAppliedMlIotIIG($email);



			if (!$isExistEmail) {

				$project_id = $this->AppliedMlIoTByeictIitGuwagatModel->DownloadMLWithIotBroucherForm($data);

				if ($project_id > 0) {

					$admin_Download_Projectlist_mail_status = $this->admin_Download_Projectlist_Email($data);

					//Send mail

					if ($admin_Download_Projectlist_mail_status) {



						header('Content-Type: application/json');

						print json_encode(array('message' => 'SUCCESS', 'response' => " Project List Downloaded Successfully."));
					} else {



						//header('HTTP/1.1 500 Internal Server');

						header('Content-Type: application/json; charset=UTF-8');

						die(json_encode(array('message' => 'SUCCESS', 'response' => " Project List Downloaded Successfully.")));
					}
				} else {

					header('HTTP/1.1 501 Internal Server');

					header('Content-Type: application/json; charset=UTF-8');

					print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 501, 'response' => 'Download Project List Failed! Try Again')));
				}
			} else {

				header('HTTP/1.1 501 Internal Server');

				header('Content-Type: application/json; charset=UTF-8');

				print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 501, 'response' => 'You Have Already Downloded This Project List !')));
			}
		} else {

			header('HTTP/1.1 500 Internal Server');

			header('Content-Type: application/json; charset=UTF-8');

			print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 500, 'response' => validation_errors())));
		}
	}



	//start admin mail

	public function admin_Download_Projectlist_Email($data)
	{



		$from_email = "enquiry@theiotacademy.co";

		$to_email = "info@theiotacademy.co";



		$this->email->from($from_email, 'Enquiry | The IoT Academy');

		$this->email->to($to_email);

		$this->email->subject('IIT-G Data Science ,Machine Learning and IoT Project List Downloded By ' . $data['name'] . ' through Website');

		$this->email->message($this->load->view('mailFormat/adminmail_of_mlwithiot_iig_Projectlist', $data, TRUE));

		//Sending Email

		if ($this->email->send()) {

			return TRUE;
		} else {

			return FALSE;
		}
	}



	//end download project list form submit



	//start download Curriculum list form submit and send admin mail

	public function DownloadCurriculumListOfMlIotIig()
	{



		$nameerrmsg = array(

			'required' => 'Name Cannot Be Empty.',

			'alpha_numeric_spaces' => 'Name Must Contain Only Letters of English Alphabet and Spaces.'

		);

		$mobileerrmsg = array(

			'required' => 'Mobile No. Can not Be Empty.',

			'numeric' => 'Mobile No. Must Be 10-Digit Number',

			'exact_length' => 'Mobile No. Must Be 10-Digit Number'

		);

		$emailmsg = array(

			'required' => 'Email Can not Be Empty.'

		);





		$this->form_validation->set_rules('fullname', 'Name', 'required|alpha_numeric_spaces', $nameerrmsg);

		$this->form_validation->set_rules('email', 'email', 'required', $emailmsg);

		$this->form_validation->set_rules('mobileno', 'Mobile No.', 'required|numeric', $mobileerrmsg);



		if ($this->form_validation->run()) {

			$name = $this->input->post('fullname');

			$mobile_no = $this->input->post('mobileno');

			$email_id = $this->input->post('email');

			$workexperience = $this->input->post('workexperience');

			$form_name = $this->input->post('form_name');

			$url_source = $this->input->post('url_source');

			$data = array(

				'name' => $name,

				'email_id' => $email_id,

				'mobile_no' => $mobile_no,

				'message' => $workexperience ? $workexperience : " ",

				'came_from' => $form_name,

				'url_source' => $url_source

			);

			$isExistEmail = $this->AppliedMlIoTByeictIitGuwagatModel->isEmailExistsAppliedMlIotIIG($email);



			if (!$isExistEmail) {

				$curriculum_id = $this->AppliedMlIoTByeictIitGuwagatModel->DownloadMLWithIotBroucherForm($data);

				if ($curriculum_id > 0) {

					$admin_Download_Curriculumlist_mail_status = $this->admin_Download_Curriculumlist_Email($data);

					//Send mail

					if ($admin_Download_Curriculumlist_mail_status) {



						header('Content-Type: application/json');

						print json_encode(array('message' => 'SUCCESS', 'response' => " Curriculum List Downloaded Successfully."));
					} else {



						//header('HTTP/1.1 500 Internal Server');

						header('Content-Type: application/json; charset=UTF-8');

						die(json_encode(array('message' => 'SUCCESS', 'response' => " Curriculum List Downloaded Successfully.")));
					}
				} else {

					header('HTTP/1.1 501 Internal Server');

					header('Content-Type: application/json; charset=UTF-8');

					print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 501, 'response' => 'Download Curriculum List Failed! Try Again')));
				}
			} else {

				header('HTTP/1.1 501 Internal Server');

				header('Content-Type: application/json; charset=UTF-8');

				print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 501, 'response' => 'You Have Already Downloded This Curriculum List !')));
			}
		} else {

			header('HTTP/1.1 500 Internal Server');

			header('Content-Type: application/json; charset=UTF-8');

			print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 500, 'response' => validation_errors())));
		}
	}



	//start  admin mail

	public function admin_Download_Curriculumlist_Email($data)
	{



		$from_email = "enquiry@theiotacademy.co";

		$to_email = "info@theiotacademy.co";



		$this->email->from($from_email, 'Enquiry | The IoT Academy');

		$this->email->to($to_email);

		$this->email->subject('IIT-G Data Science, Machine Learning and IoT Curriculum List Downloded By ' . $data['name'] . ' through Website');

		$this->email->message($this->load->view('mailFormat/adminmail_of_mlwithiot_iig_Curriculumlist', $data, TRUE));

		//Sending Email

		if ($this->email->send()) {

			return TRUE;
		} else {

			return FALSE;
		}
	}



	//end download Curriculum list form submit

	//start Talk To Counselor  form submitfun and send admin mail

	public function TalkToCounselorSubmitForm()
	{



		$nameerrmsg = array(

			'required' => 'Name Cannot Be Empty.',

			'alpha_numeric_spaces' => 'Name Must Contain Only Letters of English Alphabet and Spaces.'

		);

		$mobileerrmsg = array(

			'required' => 'Mobile No. Can not Be Empty.',

			'numeric' => 'Mobile No. Must Be 10-Digit Number',

			'exact_length' => 'Mobile No. Must Be 10-Digit Number'

		);

		$emailmsg = array(

			'required' => 'Email Can not Be Empty.'

		);





		$this->form_validation->set_rules('fullname', 'Name', 'required|alpha_numeric_spaces', $nameerrmsg);

		$this->form_validation->set_rules('email', 'email', 'required', $emailmsg);

		$this->form_validation->set_rules('mobileno', 'Mobile No.', 'required|numeric', $mobileerrmsg);



		if ($this->form_validation->run()) {

			$name = $this->input->post('fullname');

			$mobile_no = $this->input->post('mobileno');

			$email_id = $this->input->post('email');

			$workexperience = $this->input->post('workexperience');

			$form_name = $this->input->post('form_name');

			$url_source = $this->input->post('url_source');

			$data = array(

				'name' => $name,

				'email_id' => $email_id,

				'mobile_no' => $mobile_no,

				'message' => $workexperience ? $workexperience : " ",

				'came_from' => $form_name,

				'url_source' => $url_source

			);

			$isExistEmail = $this->AppliedMlIoTByeictIitGuwagatModel->isEmailExistsAppliedMlIotIIG($email);



			if (!$isExistEmail) {

				$Talk_id = $this->AppliedMlIoTByeictIitGuwagatModel->DownloadMLWithIotBroucherForm($data);

				if ($Talk_id > 0) {

					$admin_Talk_TO_Counselor_mail_status = $this->admin_Talk_To_Counselor_Email($data);

					//Send mail

					if ($admin_Talk_TO_Counselor_mail_status) {



						header('Content-Type: application/json');

						print json_encode(array('message' => 'SUCCESS', 'response' => "&#x2714; You have Submitted Successfully Details."));
					} else {



						//header('HTTP/1.1 500 Internal Server');

						header('Content-Type: application/json; charset=UTF-8');

						die(json_encode(array('message' => 'SUCCESS', 'response' => "&#x2714;You have Submitted Successfully Details.")));
					}
				} else {

					header('HTTP/1.1 501 Internal Server');

					header('Content-Type: application/json; charset=UTF-8');

					print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 501, 'response' => 'Detalis Submission Failed! Try Again')));
				}
			} else {

				header('HTTP/1.1 501 Internal Server');

				header('Content-Type: application/json; charset=UTF-8');

				print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 501, 'response' => 'You Have Already Submitted Your Details!')));
			}
		} else {

			header('HTTP/1.1 500 Internal Server');

			header('Content-Type: application/json; charset=UTF-8');

			print_r(json_encode(array('message' => 'ERROR', 'statusCode' => 500, 'response' => validation_errors())));
		}
	}



	//start talk to counselor  admin mail

	public function admin_Talk_To_Counselor_Email($data)
	{



		$from_email = "enquiry@theiotacademy.co";

		$to_email = "info@theiotacademy.co";



		$this->email->from($from_email, 'Talk TO Counselor Enquiry | The IoT Academy');

		$this->email->to($to_email);

		$this->email->subject('Talk To Counselor Detalis Submitted By ' . $data['name'] . ' through Website');

		$this->email->message($this->load->view('mailFormat/adminmail_of_talk_to_counselor', $data, TRUE));

		//Sending Email

		if ($this->email->send()) {

			return TRUE;
		} else {

			return FALSE;
		}
	}





	//end talk to counselor form submit





}
