<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller{

	public function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->helper('utility_helper');
		$this->load->library('form_validation');
		$this->load->model('CourseModel');
		$this->load->model('CourseModuleModel');
		$this->load->model('AppModel');
		$this->load->model('EmployeeModel');
		$this->load->model('PaymentModel');
		$this->load->model('RegisterModel');
		$this->load->model('StudentModel');
		$this->load->model('CompanyModel');
		$this->load->model('UserModel');
		$this->load->library('session');
	}
	public function index(){	
		$this->load->view('admin/payment/paymentmanage');
	}

	public function add_payment(){
		$this->load->view('admin/payment/addpayment');
	}

	public function payment_receipt($id){
		$payinfo=$this->PaymentModel->getPaymentById($id);
		$reginfo=$this->RegisterModel->getRegistrationById($payinfo['reg_id']);
		$stdinfo=$this->StudentModel->getStudentById($reginfo['std_id']);
		$email_id=$this->UserModel->getEmailByUserId($stdinfo['user_id']) ;
		$stdinfo['email_id']=$email_id ;
		$courseinfo=$this->CourseModel->getCourseById($reginfo['course_id']);
		$compinfo=$this->CompanyModel->getCompanyById(1) ;
		$data=array('payinfo'=>$payinfo,'reginfo'=>$reginfo,'stdinfo'=>$stdinfo,'courseinfo'=>$courseinfo,'compinfo'=>$compinfo);
		$this->load->view('admin/payment/paymentreceipt',$data);
	}


	public function payment_submit(){
		  $ustatus=FALSE ;
		  //Validating the information
		  //error messages
		  $paidamterrmsg=array('required'=>'Amount Cannot Be Empty.','numeric'=>'Amount Must Be Numeric.') ;
		  $taxamterrmsg=array('required'=>'Tax Amount Cannot Be Empty.','numeric'=>'Tax Amount Must Be Numeric.') ;
		  $netamterrmsg=array('required'=>'Net Amount Cannot Be Empty.','numeric'=>'Net Amount Must Be Numeric.') ;
		  $this->form_validation->set_rules('feeamount','Amount','required|numeric',$paidamterrmsg);
		  $this->form_validation->set_rules('taxamount','Tax Amount','required|numeric',$taxamterrmsg);
		  $this->form_validation->set_rules('netamount','Net Amount','required|numeric',$netamterrmsg);

		if($this->form_validation->run()){
			$pay_id=0 ;
			$payment_id=0 ;
			$ip=$_SERVER['REMOTE_ADDR']; 
			$reg_id=$this->input->post('regid');
		  	$fee_amount=$this->input->post('feeamount');
		  	$tax_amount=$this->input->post('taxamount');
		  	$net_amount=$this->input->post('netamount');
		  	$payment_mode=$this->input->post('paymentmode');
		  	$payment_type=$this->input->post('paymenttype');
		  	$trans_date=$this->input->post('transdate');
		  	$trans_status=$this->input->post('transstatus');
		  	$inst_number=$this->input->post('instnumber');
		  	$inst_date=$this->input->post('instdate');
		  	$inst_amount=$this->input->post('instamount');
		  	$inst_bank=$this->input->post('instbank');
		  	$remarks=$this->input->post('remarks');

		  	$total_fee=$this->input->post('totalfee');
		  	$paid_fee=$this->input->post('paidfee');
		  	$balance_fee=$this->input->post('balancefee');

		  	$new_paid_fee=$paid_fee+$fee_amount ;
		  	$new_balance_fee=$balance_fee-$fee_amount ;

		  	//Insert Payment
			$pay_id=$this->PaymentModel->insertPayment($reg_id,$fee_amount,$tax_amount,$net_amount,$payment_mode,$payment_type,$trans_date,$trans_status,$inst_number,$inst_date,$inst_amount,$inst_bank,$remarks) ;

			//Updating Payment ID
			$payment_id=$this->PaymentModel->updatePaymentId($pay_id) ;

			//Updating Paid Fee and Balance Fee in Registrations Table
			$ustatus=$this->RegisterModel->updateBalancePaidFeeByRegId($reg_id,$new_paid_fee,$new_balance_fee) ;
				

			if(($pay_id>0)&&is_string($payment_id)&&$ustatus){
				$message="Payment Created Successfully with Id: ".$payment_id ;
        		$this->session->set_flashdata('success',$message);
        		redirect(base_url().'apayment');  
        	}else{
        		$message="Unable To Create The Payment. Contact Administrator." ;
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'add-payment');
        	}
		}else{
			$this->session->set_flashdata('error',validation_errors());
            redirect(base_url().'apayment');
		}
	}

	public function course_update(){
	   $course_id=$this->input->post('courseid');
	  //Validating the information
	  //error messages
	  $ctitleerrmsg=array('required'=>'Course Title Cannot Be Empty.') ;
	  $this->form_validation->set_rules('coursetitle','Course Title','required|callback_check_course_title_for_update',$ctitleerrmsg);

	if($this->form_validation->run()){
		$ip=$_SERVER['REMOTE_ADDR']; 
		$course_title=$this->input->post('coursetitle');
	  	$course_fee=$this->input->post('coursefee');
	  	$old_course_fee=$this->input->post('oldcoursefee');
	  	$swt_course_fee=$this->input->post('swtcoursefee');
	  	$training_mode=$this->input->post('trainingmode');
	  	$duration_months=$this->input->post('durationmonths');
	  	$swt_duration=$this->input->post('swtduration');
	  	$hours_per_day=$this->input->post('hoursperday');
	  	$days_quantity=$this->input->post('daysquantity');
	  	$project_work=$this->input->post('projectwork');

	  	//Update Course Info
		$ustatus=$this->CourseModel->updateCourse($course_id,$course_title,$course_fee,$old_course_fee,$swt_course_fee,$training_mode,$duration_months,$swt_duration,$hours_per_day,$days_quantity,$project_work) ;
			

		if($ustatus){
			$message="Course Information Updated Successfully." ;
    		$this->session->set_flashdata('success',$message);
    		redirect(base_url().'acourse');  
    	}else{
    		$message="Unable To Update The Course Info. Contact Administrator." ;
            $this->session->set_flashdata('error',$message);
            redirect(base_url().'acourse');
    	}
	}else{
		$this->session->set_flashdata('error',validation_errors());
        redirect(base_url().'course/edit_course/'.$course_id);
	}
}

 //Callback Function For Validating Course Title
    public function check_course_title_for_update($course_title) {        
        if($this->input->post('courseid')){
            $course_id = $this->input->post('courseid');
        }else{
            $course_id = '';
        }
        $result = $this->CourseModel->checkUniqueCourseTitleForUpdate($course_id,$course_title);
        if($result == 0){
            $response = true;
        }else {
            $this->form_validation->set_message('check_course_title_for_update', 'Course Title Must Be Unique.');
            $response = false;
        }
        return $response;
    }

  //Function For Generating PDF Receipt
   public function generate_pdf_receipt(){

   }

}