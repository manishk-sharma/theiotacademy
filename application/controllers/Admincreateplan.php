<?php 

// ob_start();

defined('BASEPATH') OR exit('No direct script access allowed');  

class Admincreateplan extends CI_Controller{
	public function __construct(){ 
		parent::__construct();

	    // error_reporting(0);

	    $this->load->helper('utility_helper');
	    $this->load->library('form_validation');

	    $this->load->model(['LiveLeadModel', 'AdmincreatePlanModel']);

	    $this->load->library('session');

	    $this->load->library('email'); 

	}

public function createplanloginview(){
	if($this->session->userdata('user')==''){
			$this->load->view('admin/sellsdepartment/createplanlogin');
		}
		else{
			redirect(base_url('admin-create-plan'));
		}

}

public function admincreateplanview(){

	if($this->session->userdata('user')){
			$this->load->view('admin/sellsdepartment/createplan');
		}
		else{
			redirect(base_url('admin-create-plan-login'));
		}

}

public function admincreateplandetails(){

	if($this->session->userdata('user')){
			$this->load->view('admin/sellsdepartment/createplandetails');
		}
		else{
			redirect(base_url('admin-create-plan-login'));
		}


}


    //start new login logout function
      
      public function admin_create_plan_login_form()
	{   
		$post = $this->input->post();
	    if (isset($post) && !empty($post)) {

	    	$email = $this->input->post('username');
	    	$password = $this->input->post('password');
	    	$row = $this->AdmincreatePlanModel->check_user($email);
	    	if (!empty($row) && $row['user_password']==(md5($password)))
	    	{  
	    		$data = array(

	    				'email'=>$row['user_email'],
	    				'password'=>$row['user_password'],
	    				'is_login'=>true,
	    		);

	    		//$this->session->set_userdata($data);
	    		$this->session->set_userdata('user', $data);
	    		redirect(base_url('admin-create-plan'));
	    			
	    	}else{
				$this->session->set_flashdata("class","danger");
	    		$this->session->set_flashdata('msg', 'Invalid email and password!');
	    		redirect(base_url('admin-create-plan-login'));	
	    	}		
	    	
	       }   
		$this->load->view('admin/sellsdepartment/createplanlogin',$data);
	}

	public function logout()
	{
		//print_r('logout');die();
		$this->session->sess_destroy();
		// $this->session->unset_userdata('user');
		  $data['title'] = 'Login';
		redirect(base_url('admin-create-plan-login'),$data['title']);

	}

    //end new login logout function


//start create plan 

    public function admin_create_plan_submit_form(){

             
	  	$this->form_validation->set_rules('planname','Plan Name','required');
	  	$this->form_validation->set_rules('plandescription','Plan Created By','required');
		  $this->form_validation->set_rules('everyname','Every Name','required');
	  	$this->form_validation->set_rules('selectplan','Select Plan','required');
	  	$this->form_validation->set_rules('amount','Amount','required');
	  	
        if($this->form_validation->run()){ 	

        	   $planname=$this->input->post('planname');
				     $plandescription=$this->input->post('plandescription');
				     $everyname=$this->input->post('everyname');
				     $selectplan=$this->input->post('selectplan');
				     $amount=$this->input->post('amount');

				     $apidata = json_encode([
				         "period"=> $selectplan,
						     "interval"=> $everyname,
						    "item"=> [
						    "name"=> $planname,
						    "amount"=> $amount*100,
						    "currency"=> "INR",
						    "description"=> $plandescription
						  ]
			  ]);

    //razorpay plan creation

					$curl = curl_init();

					curl_setopt_array($curl, array(
					  CURLOPT_URL => 'https://api.razorpay.com/v1/plans',
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => '',
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 0,
					  CURLOPT_FOLLOWLOCATION => true,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => 'POST',
					  CURLOPT_POSTFIELDS =>$apidata,
					  CURLOPT_HTTPHEADER => array(
					    'Authorization: Basic cnpwX2xpdmVfdDlhZXRYVkhyQmlmeHE6bFl2akxjaHNDWWNxV3J5UjhZaUZRY0Ns',
					    'Content-Type: application/json'
					  ),
					));

					$response = curl_exec($curl);

					curl_close($curl);
					//echo $response;

					$res = array();
    //end razor pay plan creation
        if($response !=''){

        		$res['status'] = 'success';
        		$res['response'] = json_decode($response);
        		$res['msg'] = 'Plan Created successfully.';
             echo json_encode($res);
        	   
        }else{

        		$res['status'] = 'success';
        		$res['msg'] = 'Plan Created Failed.';
        	  echo json_encode($res);
        	 
        }
    	}
    	else{
          
    				$errors = validation_errors();
    				$res['status'] = 'error';
        		$res['msg'] =$errors;
          echo json_encode($res);

		}

    }
 //end  create  function


//create subscription plan function

public function create_subscription_plan_submit_form(){

             
	  	$this->form_validation->set_rules('selectplan','Plan Id','required');
		  $this->form_validation->set_rules('totalcount','Total Count','required');
	  	$this->form_validation->set_rules('custemail','Customer Email','required');
	  	$this->form_validation->set_rules('custmobile','Customer Mobile','required');
	  	
        if($this->form_validation->run()){ 	

	        	     $selectplanid=$this->input->post('selectplan');
	        	     $checkstartbox=$this->input->post('checkstartbox');
	        	     $checkstartdate=$this->input->post('checkstartdate');
	        	     $checkstarttime=$this->input->post('checkstarttime');
				     $totalcount=$this->input->post('totalcount');
				     $custemail=$this->input->post('custemail');
				     $custmobile=$this->input->post('custmobile');
				     $checknotifybox=$this->input->post('checknotifybox');
				     $linkexpirebox=$this->input->post('linkexpirebox');
				     $chooselinkexdate=$this->input->post('chooselinkexdate');
				     $chooselinkexptime=$this->input->post('chooselinkexptime');
				     

             $subsdata='';
             if($checkstartbox && $linkexpirebox){
						     	   $subsdata = json_encode([

									  "plan_id"=> $selectplanid,
								     "total_count"=> $totalcount,
					                 "quantity"=>1,
					                 "customer_notify"=>1,
					                 "notify_info"=>[
								            "notify_phone"=>$custmobile,
								            "notify_email"=>$custemail
								          ]
			               ]);
						     }
						     elseif(!$checkstartbox && $linkexpirebox){

						     	  date_default_timezone_set('Asia/Kolkata'); 
                     $choosedatetim = $checkstartdate .' '. $checkstarttime;
                     $stamp = strtotime($choosedatetim);
                     $time_in_ms = $stamp;
                     echo  $time_in_ms;
                     $subsdata = json_encode([

									  "plan_id"=> $selectplanid,
									 "total_count"=> $totalcount,
									 "start_at"=>$time_in_ms,
					                 "quantity"=>1,
					                 "customer_notify"=>1,
					                 "notify_info"=>[
								            "notify_phone"=>$custmobile,
								            "notify_email"=>$custemail
								          ]
			               ]);

						     }

						     elseif($checkstartbox && !$linkexpirebox){

						     	  date_default_timezone_set('Asia/Kolkata'); 
			                     $chooselinkdatetime = $chooselinkexdate .' '. $chooselinkexptime;
			                     $stamp = strtotime($chooselinkdatetime);
			                     $link_time_in_ms = $stamp;
			                     //echo  $time_in_ms;
                     
                     $subsdata = json_encode([

									 "plan_id"=> $selectplanid,
									 "total_count"=> $totalcount,
								     "expire_by"=>$link_time_in_ms,
					                 "quantity"=>1,
					                 "customer_notify"=>1,
					                 "notify_info"=>[
								            "notify_phone"=>$custmobile,
								            "notify_email"=>$custemail
								          ]
			               ]);

						     }

						     else{

						     	  date_default_timezone_set('Asia/Kolkata');
						     	  $choosedatetim = $checkstartdate .' '. $checkstarttime;
			                     $stamp = strtotime($choosedatetim);
			                     $time_in_ms = $stamp; 
			                     $chooselinkdatetime = $chooselinkexdate .' '. $chooselinkexptime;
			                     $stamp = strtotime($chooselinkdatetime);
			                     $link_time_in_ms = $stamp;
			                     //echo  $time_in_ms;
                     
                     $subsdata = json_encode([

									 "plan_id"=> $selectplanid,
									 "total_count"=> $totalcount,
									 "start_at"=>$time_in_ms,
								     "expire_by"=>$link_time_in_ms,
					                 "quantity"=>1,
					                 "customer_notify"=>1,
					                 "notify_info"=>[
								            "notify_phone"=>$custmobile,
								            "notify_email"=>$custemail
								          ]
			               ]);

						     }
				     
    //razorpay creation plan

					$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://api.razorpay.com/v1/subscriptions',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS =>$subsdata,
			  CURLOPT_HTTPHEADER => array(
			    'Authorization: Basic cnpwX2xpdmVfdDlhZXRYVkhyQmlmeHE6bFl2akxjaHNDWWNxV3J5UjhZaUZRY0Ns',
			    'Content-Type: application/json'
			  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			// echo $response;

					$res = array();
					
    //end razor creation subscription
        if($response!=''){
        		$res['status'] = 'success';
        		// $res['response'] = json_decode($response);
        		$res['msg'] = 'Plan Subscription Created successfully.';
             echo json_encode($res);
        	   
        }else{

        		$res['status'] = 'success';
        		$res['msg'] = 'Plan Subscription Failed.';
        	    echo json_encode($res);
        	 
        }
    	}
    	else{
          
    			$errors = validation_errors();
    			$res['status'] = 'error';
        		$res['msg'] =$errors;
                echo json_encode($res);

		}

    }
//end create subscription plan function    
 

}

?>



