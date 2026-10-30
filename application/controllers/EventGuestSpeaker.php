<?php

ob_start();

defined('BASEPATH') OR exit('No direct script access allowed');

include_once(dirname(__FILE__).'/EventCreate.php');

class EventGuestSpeaker extends CI_Controller {  



	public function __construct(){ 

		parent::__construct(); 

		error_reporting(0); 

		$this->load->helper('utility_helper');

		$this->load->library('form_validation'); 

		$this->load->library('upload');

		$this->load->model('EventModel');

		$this->load->model('EventGuestSpeakerModel');

		$this->load->model('EventTypeModel');

		$this->load->model('EventScheduleModel');

		$this->load->model('EventLocationModel');

		$this->load->model('AppModel'); 

		$this->load->model('EmployeeModel'); 

		$this->load->model('UserTypeModel');

		$this->load->library('session'); 

		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');



	}  





	public function index(){ 	

		$this->load->view('admin/eventguestspeaker/eventguestspeakermanage');

	}

//-----------------add event guest speaker-------------

    public function add_guest_speaker(){    

        $this->load->view('admin/eventguestspeaker/addeventguestspeaker');

    }

    

//----------------------Edit event guest speaker ---------------  

    public function edit_guest_speaker($id){

    	$data=$this->EventGuestSpeakerModel->getSpeakerById($id); 

    	//print_r($data);

  		$this->load->view('admin/eventguestspeaker/updateeventguestspeaker',$data);

    }  

 

//---------------------------submit Guest Speaker------------------

	public function speaker_submit(){

		$speaker_id=0;

    	$first_name=$this->input->post('firstname');

		$last_name=$this->input->post('lastname');

		$gender=$this->input->post('gender');

		$birth_date=$this->input->post('birthdate');

		$mobile_no=$this->input->post('mobileno');

		$email_id=$this->input->post('emailid');

		$from_company=$this->input->post('fromcompany'); 

		$company=$this->input->post('company');

		$designation=$this->input->post('designation');

		$description=$this->input->post('description');

		$facebook_link=$this->input->post('facebook');

		$twitter_link=$this->input->post('twitter');

		$linkedin_link=$this->input->post('linkedin');

		if (strlen($facebook_link)<6) {

			$facebook_link='nil';

		}

		if (strlen($twitter_link)<6) {

			$twitter_link='nil';

		}

		if (strlen($linkedin_link)<6) {

			$linkedin_link='nil';

		}

		//-------------------------insert Speaker

		$speaker_id=$this->EventGuestSpeakerModel->insertSpeaker(

									$first_name,

									$last_name,

									$gender,

									$birth_date,

									$mobile_no,

									$email_id,

									$from_company,

									$company,

									$designation,

									$description,

									$facebook_link,

									$twitter_link,

									$linkedin_link);

		if($speaker_id>0){

				$picstatus=$this->uploadpicforguestspeaker($speaker_id);

	        	if ($picstatus) {

    				 $updateSpeakerImageNames=$this->EventGuestSpeakerModel->updateSpeakerImageNames($speaker_id);

    		    	 $message="Speaker Added Successfully with Id: ".$speaker_id ;

        	         $this->session->set_flashdata('success',$message);

                }

                else

                {	

                	$profileUplodaFailed=$this->EventGuestSpeakerModel->profileUplodaFailed($speaker_id);

                	$message="Profile Photo Not Uploadded <br> File Type Must be Png/PNG ,Please Upload Photo . Or Contact Administrator." ;

    	            $this->session->set_flashdata('error',$message);

    	       		redirect(base_url().'aspeaker');

                }

	}

}



//----------------------------------Update Speaker-----------------------------

	public function update_speaker(){

		$speaker_id=$this->input->post('upspeakerid');

		$first_name=$this->input->post('upfirstname');

		$last_name=$this->input->post('uplastname');

		$gender=$this->input->post('upgender');

		$birth_date=$this->input->post('upbirthdate');

		$mobile_no=$this->input->post('upmobileno');

		$email_id=$this->input->post('upemailid');

		$from_company=$this->input->post('upfromcompany');

		$company=$this->input->post('upcompany');

		$designation=$this->input->post('updesignation');

		$description=$this->input->post('updescription');

		$facebook_link=$this->input->post('upfacebook');

		$twitter_link=$this->input->post('uptwitter');

		$linkedin_link=$this->input->post('uplinkedin');

		$checkphoto=$this->input->post('checkphoto');

		if (strlen($facebook_link)<6) {

			$facebook_link='nil';

		}

		if (strlen($twitter_link)<6) {

			$twitter_link='nil';

		}

		if (strlen($linkedin_link)<6) {

			$linkedin_link='nil';

		}

		$status=$this->EventGuestSpeakerModel->updateSpeaker(

									$speaker_id,

									$first_name,

									$last_name,

									$gender,

									$birth_date,

									$mobile_no,

									$email_id,

									$from_company,

									$company,

									$designation,

									$description,

									$facebook_link,

									$twitter_link,

									$linkedin_link);

		if ($status) {

		    if($checkphoto==1){

	        	$picstatus=$this->uploadpicforguestspeaker($speaker_id);

	        	if ($picstatus) {

    				 $updateSpeakerImageNames=$this->EventGuestSpeakerModel->updateSpeakerImageNames($speaker_id);

    		    	 $message="Speaker Added Successfully with Id: ".$speaker_id ;

        	         $this->session->set_flashdata('success',$message);

                }

                else

                {	

                	$profileUplodaFailed=$this->EventGuestSpeakerModel->profileUplodaFailed($speaker_id);

                	$message="Profile Photo Not Uploadded <br> File Type Must be Png/PNG ,Please Upload Photo . Or Contact Administrator." ;

    	            $this->session->set_flashdata('error',$message);

    	       		redirect(base_url().'aspeaker');

                }

		    }

			

    //-----------------Update event Page-- after Speaker Update-------

	          // $eventstatus=$this->updatEventPageIfAnyChangesApply($event_id);

	          //   if ($eventstatus) {

	          //   	$message="Event Updated Successfully." ;

	          //   	$this->session->set_flashdata('success',$message);

	          //   }	

	          //   else{

	          //   $message="Unable To Update The Speaker. Contact Administrator." ;

	          //   $this->session->set_flashdata('error',$message);	

	          //   }



			$message="Speaker Updated Successfully." ;

            $this->session->set_flashdata('success',$message);

            redirect(base_url().'aspeaker');

		}

		else{

			$message="Unable To Update The Speaker. Contact Administrator." ;

            $this->session->set_flashdata('error',$message);

            redirect(base_url().'aspeaker');

		}



	}

//------------------------Upload Pic For Guest Speaker-------------------------

    

    	public function uploadpicforguestspeaker($speaker_id)

    	{   

    	  

    	    

    		  $uploadStatus=false ;

    		  $profileuploadstatus=false ;

    		  //Uploading profile pic

    		  $status=false ;

    	        $error="no error" ;

    	        $config2['file_name']      = 'guestspeakerpic-'.$speaker_id;

    	        $config2['upload_path']    = './uploads/profilepic/guestspeaker/';

    	        //$config2['allowed_types']  = 'PNG|png|jpg|jpeg';
    	        $config2['allowed_types']  = 'png';

    	        $config2['overwrite'] = TRUE;

    	        $config2['max_size']       = 3000; //3MB

    	        $config2['max_width']      = 3000;

    	        $config2['max_height']     = 2000;

    

    	        $this->upload->initialize($config2);

    

    	        if ( ! $this->upload->do_upload('photo'))

    	        {

    	            $error = array('error' => $this->upload->display_errors());

    	           // echo "Upload Failed" ;

    	           // print_r($error) ;

    	            $status=false ;

    	        }

    	        else

    	        {

    	            $data = array('upload_data' => $this->upload->data());

    	           // echo "File Uploaded Successfully" ;

    	            //echo $data ;

    	            $status=true ;

    	        }

    	        return $status ;

    	        //echo print_r($error) ;

    }



    public function enableDisableSpeaker($speaker_id,$status)

    {

    	$ustatus=$this->EventGuestSpeakerModel->updateSpeakerStatus($speaker_id,$status);

    	 if ($ustatus) {

        if($status==1){

          $this->session->set_flashdata('success', 'Event Guest Speaker Enabled Successfully.');

        }else{

          $this->session->set_flashdata('success', 'Event Guest Speaker Disabled Successfully.');

        } 

        redirect(base_url().'aspeaker');

    }

    else{

        if($status==0){

          $this->session->set_flashdata('error', 'Unable To Enable The Event Guest Speaker. Try Later!');

        }else{

          $this->session->set_flashdata('error', 'Unable To Disable The Event Guest Speaker. Try Later!');

        }

        redirect(base_url().'aspeaker');

    }

    }

}







