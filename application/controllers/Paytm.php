<?php
ob_start();

defined('BASEPATH') OR exit('No direct script access allowed');

use dompdf\dompdf\Mpdf;

//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once(APPPATH.'libraries/encdec_paytm.php');

class Paytm extends CI_Controller {

	public function __construct(){ 
	   parent::__construct();
	   //error_reporting(0);
	   //$this->load->helper('utility_helper');
	   $this->load->library('form_validation');

	   $this->load->Model('PaytmModel');

	   $this->load->Model('CustomerModel');
	   
	   $this->load->model('CompTeamModel');

	   $this->load->library('session'); 

	   $this->load->helper('utility_helper');
     
     $this->load->library('form_validation');
     
     $this->load->library('email');
     
     $this->load->model('AppModel');

     $this->load->model('IndustrialInternshipModel');
     
     $this->load->model('UserModel');
     
     $this->load->model('UserTypeModel');
     
     $this->load->model('EventBatchregModel'); 

     $this->load->library('session');
     
     $this->load->model('EventModel');

     $this->load->model('DiscountModel');
     
     $this->load->model('EventRegModel');

 	}
	

	public function index()
	{
		$this->load->view('payment/index');
	}


	public function start_payment(){
		

		$first_name=$this->input->post('fname');

		$last_name=$this->input->post('lname');

		$batch_event_id=$this->input->post('event_id');

		$batch_event_type=$this->input->post('batch_event_type');

		$order_id=$this->input->post('ORDER_ID');
		
		$cust_id=$this->input->post('CUST_ID');
		
		$industry_type_id=$this->input->post('INDUSTRY_TYPE_ID');
		
		$mobile_num=$this->input->post('MOBILE_NUM');
		
		$email_id=$this->input->post('EMAIL_ID');
		
		$channel_id=$this->input->post('CHANNEL_ID');
		
		$txn_ammount=$this->input->post('TXN_AMOUNT');

		$discount_code=$this->input->post('discountCode');

		$quantity=$this->input->post('quantity');

		$discount_code=trim($discount_code);

		if(strlen($discount_code)<=1){

			$discount_code='nil';
		}


		$cust_id=$this->CustomerModel->saveCustmer($first_name,$last_name,$email_id,$mobile_num,$order_id,$quantity,$batch_event_type,$batch_event_id,$discount_code,$txn_ammount);
		
		
		
		

		

		$this->make_configuration($order_id,$cust_id,$industry_type_id,$channel_id,$txn_ammount,$email_id,$mobile_num);

	}


// strat payment for internship

	public function start_paymentForIntern(){
		

		$first_name=$this->input->post('first_name');

		$last_name=$this->input->post('last_name');

		$order_id=$this->input->post('ORDER_ID');
		
		$cust_id=$this->input->post('CUST_ID');
		
		$industry_type_id=$this->input->post('INDUSTRY_TYPE_ID');

		$email_id=$this->input->post('email_id');
				
		$mobile_num=$this->input->post('mobile_num');
		
		$channel_id=$this->input->post('CHANNEL_ID');

		$college_name=$this->input->post('college_name');

		$year=$this->input->post('year');

		$selected_technology=$this->input->post('selected_technology');

		$message=$this->input->post('message');

		$category=$this->input->post('category');

		$Base_ammount = $category;

		$GstAmmount = $Base_ammount*0.18; //Gst 18 %

		$txn_ammount= $Base_ammount+$GstAmmount;

		if($category==500)
			$category='BASIC';

		elseif($category==1000)
			$category='PREMIUM';

		else
			$category='ADVANCE';
		
		
		$enquiry_id=$this->IndustrialInternshipModel->saveEnquaryToDB($order_id,$first_name,$last_name,$email_id,$mobile_num,$college_name,$year,$selected_technology,$message,$category,$Base_ammount);		

		/*if($enquiry_id){

			$adminMailStatus=$this->adminConfirmationMailForIntern($first_name,$last_name,$email_id,$mobile_num,$college_name,$year,$selected_technology,$category,$message);
		
			$userMailStatus=$this->sendEnquiryConfirmEmailForIntern($enquiry_id,$first_name,$last_name,$email_id,$selected_technology,$category);
		    
		}
		*/
		$this->make_configuration($order_id,$cust_id,$industry_type_id,$channel_id,$txn_ammount,$email_id,$mobile_num);

	}
	
	
	public function start_techSavvyContestPayMent(){
		

		$tmId=$this->input->post('team_name');

		
		$order_id=$this->input->post('ORDER_ID');
		
		$cust_id=$tmId;
		
		$industry_type_id=$this->input->post('INDUSTRY_TYPE_ID');
		
		$channel_id=$this->input->post('CHANNEL_ID');	

		$email_id='';
		$mobile_num='';	
		$txn_ammount=500;//Five Hundreds Ruppes.

		$status=$this->CompTeamModel->isTeamExists($tmId);




		if($status){

			$this->CompTeamModel->saveOrderId($order_id,$tmId);

			$this->make_configuration($order_id,$cust_id,$industry_type_id,$channel_id,$txn_ammount,$email_id,$mobile_num);
		}
		else{

			$this->session->set_flashdata('error','Team Id Is Invalid!');
            redirect(base_url().'TechSavvy/doPayment');
		}

	}

//----------------------------------
 
	public function make_configuration($order_id,$cust_id,$industry_type_id,$channel_id,$txn_ammount,$email_id,$mobile_num){
		
		$data=array();
		
		$paramList = array(
    
		/* Find your MID in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys */
		"MID" => "ufHavW03406238789046",
	    
		/* Find your WEBSITE in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys */
		"WEBSITE" => "DEFAULT",
	    
		/* Find your INDUSTRY_TYPE_ID in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys */
		"INDUSTRY_TYPE_ID" => "Retail",
	    
		/* WEB for website and WAP for Mobile-websites or App */
		"CHANNEL_ID" => 'WEB',
	    
		/* Enter your unique order id */
		"ORDER_ID" => $order_id,
	    
		/* unique id that belongs to your customer */
		"CUST_ID" => $cust_id,
	    
		/* customer's mobile number */
		"MOBILE_NO" => $mobile_num,
	    
		/* customer's email */
		"EMAIL" => $email_id,
	    
		/**
		* Amount in INR that is payble by customer
		* this should be numeric with optionally having two decimal points
		*/
		"TXN_AMOUNT" => $txn_ammount,
	    
		"CALLBACK_URL" => base_url().'resopnse',
	);
		$data['paramList']=$paramList;

		$data['PAYTM_ENVIRONMENT']="PROD";  //  TEST/PROD

		$data['PAYTM_MERCHANT_KEY']="TA%nlxvBeLKUu6pR";

		$data['PAYTM_MERCHANT_MID']="ufHavW03406238789046";

		$data['PAYTM_MERCHANT_WEBSITE']="DEFAULT";

		$data['PAYTM_STATUS_QUERY_NEW_URL']="https://securegw-stage.paytm.in/merchant-status/getTxnStatus"; //For TEST only

		$data['PAYTM_TXN_URL']="https://securegw-stage.paytm.in/theia/processTransaction";   //For TEST only

		if ($data['PAYTM_ENVIRONMENT'] == 'PROD'){
		    
			$data['PAYTM_STATUS_QUERY_NEW_URL']='https://securegw.paytm.in/order/status';   //For PROD only
			$data['PAYTM_TXN_URL']='https://securegw.paytm.in/order/process';   //For PROD only
			
		}

		$data['PAYTM_REFUND_UR']="";

		$this->redirect_page($data);
	}

	public function redirect_page($data)
	{
		$data['checkSum']=getChecksumFromArray($data['paramList'],$data['PAYTM_MERCHANT_KEY']);
		$this->load->view('payment/pgRedirect',$data);
	}


	public function response_url()
	{


		//$cust_id=$this->getCustemerId();


		$paytmChecksum = "";
		$paramList = array();
		$isValidChecksum = "FALSE";

		$paramList = $_POST;
		$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

		//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
		$isValidChecksum = verifychecksum_e($paramList, 'TA%nlxvBeLKUu6pR', $paytmChecksum); //will return TRUE or FALSE string.


		if($isValidChecksum == "TRUE") {

			//echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";

			if ($_POST["STATUS"] == "TXN_SUCCESS") {

				//echo "<b>Transaction status is success</b>" . "<br/>";
				//Process your transaction here as success transaction.
				//Verify amount & order id received from Payment gateway with your application's order id and amount.		

			}

			else {

				//echo "<b>Transaction status is failure</b>" . "<br/>";
			}

			if (isset($_POST) && count($_POST)>0 )
			{ 
				$data=array();
				foreach($_POST as $paramName => $paramValue){
						//echo "<br/>" . $paramName . " = " . $paramValue;
						$data[$paramName]=$paramValue;
				}

				$this->PaytmModel->insertPaymentResopnse($data);				
			}

			if ($data["STATUS"] == "TXN_SUCCESS") {
				
			    if (strpos($data["ORDERID"], 'internship_ORD') !== false) {
		   
				   $this->load->view('payment/PaymentResponseIntern',$data);

				}elseif (strpos($data["ORDERID"], 'techsavvy_ORD') !== false) {

					$this->CompTeamModel->setTransationStatus($data["ORDERID"],true);

					$this->load->view('payment/paymentResponseTechSavvy',$data);
				
				}else{

					$this->load->view('payment/PaymentResponse',$data);

				}

				$this->generateEmail($data);
				
			}else{//faliure===========
			    

				if (strpos($data["ORDERID"], 'internship_ORD') !== false) {
		   
				   $this->load->view('payment/PaymentResponseIntern',$data);

				}elseif (strpos($data["ORDERID"], 'techsavvy_ORD') !== false) {

					$this->load->view('payment/paymentResponseTechSavvy',$data);

				}else{

					$this->load->view('payment/PaymentResponse',$data);

				}
				
			}

				

		}

		else {

		        if (strpos($data["ORDERID"], 'internship_ORD') !== false) {
		   
				   $this->load->view('payment/PaymentResponseIntern',$data);

				}elseif (strpos($data["ORDERID"], 'techsavvy_ORD') !== false) {

					$this->load->view('payment/paymentResponseTechSavvy',$data);

				}else{

					$this->load->view('payment/PaymentResponse',$data);

				}

			//Process transaction as suspicious.
		}	
	}


	public function generateEmail($data)
	{
		$ORDERID=$data['ORDERID'];


		if (strpos($ORDERID, 'internship_ORD') !== false) {
		   
		   $cust_details=$this->IndustrialInternshipModel->getInternByOrderId($ORDERID);

		   $message=$this->load->view('payment/mailformatInternship',$data,TRUE);

		    $ORDERID = $cust_details['ORDERID'];

			$first_name = $cust_details['first_name'];

			$last_name = $cust_details['last_name'];

			$email_id = $cust_details['email_id'];

			$mobile_num = $cust_details['mobile_num'];

			$college_name = $cust_details['college_name'];

			$year = $cust_details['year'];

			$selected_technology = $cust_details['technology'];

			$category = $cust_details['category'];

			$user_message = $cust_details['message'];

			$txn_ammount = $cust_details['txn_ammount'];

		  $this->adminConfirmationMailForIntern($first_name,$last_name,$email_id,$mobile_num,$college_name,$year,$selected_technology,$category,$user_message);

		  
		  $this->sendEnquiryConfirmEmailForIntern($first_name,$last_name,$email_id,$selected_technology,$category);


		}elseif(strpos($data["ORDERID"], 'techsavvy_ORD') !== false) {

			$message=$this->load->view('payment/mailformatTechSavvy',$data,TRUE);

			$cust_details = $this->CompTeamModel->getTeamByOrderId($ORDERID);



		}else{

			$cust_details = $this->CustomerModel->getCustmerByOrderId($ORDERID);

			$message=$this->load->view('payment/mailformat',$data,TRUE);

		}
		
		$this->PaymentSuccessMail($cust_details,$message);

		

	}





	public function PaymentSuccessMail($cust_details,$message)
	{
		


		$email_id = $cust_details['email_id'];

		if(isset($cust_details['batch_event_type'])){

			$subjectName =$cust_details['batch_event_type'];

		}elseif(isset($cust_details['contest_name'])){

			$subjectName=$cust_details['contest_name'];
			//$email_id='mishrayogesh017@gmail.com';

		}else{

			$subjectName='Work From Home InternShip';
		}
		 

		$from_email = "enquiry@theiotacademy.co";

     	$to_email = $email_id;
       
       $this->email->from($from_email,'The IOT Academy'); 
       $this->email->to($to_email.',abhishek@uniconvergetech.in,prabha@theiotacademy.co');
       $this->email->subject('Payment For Registration To '.$subjectName); 

       $this->email->message($message); 

       if ($this->email->send()) {

            $status = true;

       }else{

            $status = false;

       }

    return $status;

	}

		//Function For Sending Enquiry Received Email 
	public function adminConfirmationMailForIntern($first_name,$last_name,$email_id,$mobile_num,$college_name,$year,$selected_technology,$category,$message)
	{

		  $full_name=$first_name." ".$last_name;

	      $from_email = "enquiry@theiotacademy.co";

	       $email_message='<strong>New Internship Registration for : <br> '.
		  			$selected_technology.'('.$category.')'.'</strong><br> Email Id: '.
		  			$email_id.'<br>Name:- '.$full_name.'<br>Mobile No: '.
		  			$mobile_num.'<br>college Name: '.$college_name.
		  			'<br>Year: '.$year.'<br>Message:- '.$message.'<br><strong>';

	      $to_email = "abhishek@uniconvergetech.in";
	       
	       $this->email->from($from_email,'The IOT Website');

	       $this->email->to($to_email);

	       $this->email->subject('Internship application'); 

	       $this->email->message($email_message); 

	       if ($this->email->send()) {
	            $status = true;
	       }else{
	            $status = false;
	       }
	  return $status;
	}
	


	//Function For Sending Enquiry Received Email 
  	public function sendEnquiryConfirmEmailForIntern($first_name,$last_name,$email_id,$selected_technology,$category){

  		$full_name=$first_name." ".$last_name;

  		//$to_email="yogesh@uniconvergetech.in" ;

  		$from_email="enquiry@theiotacademy.co" ;

		$message="Hi <strong>".$full_name."</strong>,<br>We have received your Registration for the internship: <strong>".$selected_technology." (".$category.")</strong>.<br> We will get back to you soon.<br><br>Thanks.<br>The IoT Academy<br>Ground Floor, NIMS Building, C-56/11, Sector-62, Noida, U.P" ;
  		
   		$this->email->from($from_email, 'The IoT Academy'); 
        $this->email->to($email_id);
        $this->email->subject('Enquiry Received'); 
        $this->email->message($message);

        //Sending Email
        if($this->email->send()){
        	return TRUE ;
        }else{
        	return FALSE ;
        }
  	}

}

