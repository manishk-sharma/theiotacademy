<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends CI_Controller {

	public function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->helper('utility_helper');
		$this->load->library('form_validation');
		$this->load->model('CourseModel');
		$this->load->model('SubjectModel');
		$this->load->model('CourseModuleModel');
		$this->load->model('AppModel');
		$this->load->model('EmployeeModel');
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		
	}
	public function index(){	
		
		$data['subjectData']=$this->SubjectModel->getSubjectsList();
		
		$this->load->view('admin/subject/subjectmanage',$data);
	}


	public function add_subject(){
		$this->load->view('admin/subject/addsubject');
	}

	public function edit_subject($id){

		//$data=$this->SubjectModel->getSubjectById($id);
		$this->load->view('admin/subject/editsubject');
	}


	public function subject_submit(){

		   $user_id=$this->session->user_id;
		  //Validating the information
		  //error messages
		  $stitleerrmsg=array(
		  					'required'=>'Subject Title Cannot Be Empty.',
							'is_unique'=>'Subject Title Already Exists. Choose Some Other Title.'
							) ;
		  $this->form_validation->set_rules('subjecttitle','Subject Title','required|is_unique[subject_details.subject_title]',$stitleerrmsg);

		if($this->form_validation->run()){
			$subject_id=0 ;
			$ip=$_SERVER['REMOTE_ADDR']; 
			$subject_title=$this->input->post('subjecttitle');

		  	//Insert Subject
			$subject_id=$this->SubjectModel->insertSubject($subject_title,$user_id) ;	

			if($subject_id>0){
				$message="Subject Created Successfully with Id: ".$subject_id ;
        		$this->session->set_flashdata('success',$message);
        		redirect(base_url().'asubject');  
        	}else{
        		$message="Unable To Create The Subject. Contact Administrator." ;
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'asubject');
        	}
		}else{
			$this->session->set_flashdata('error',validation_errors());
            redirect(base_url().'asubject');
		}
	}

	public function update_subject(){

	   $subject_id=$this->input->post('subjectid');
	   $user_id=$this->session->user_id;
	  //Validating the information
	  //error messages
	  $stitleerrmsg=array('required'=>'Subject Title Cannot Be Empty.') ;
	  $this->form_validation->set_rules('subjecttitle','Subject Title','required|callback_check_subject_title_for_update',$stitleerrmsg);

	if($this->form_validation->run()){

		$ip=$_SERVER['REMOTE_ADDR']; 
		$subject_title=$this->input->post('subjecttitle');

	  	//Update Subject Info
	  	
		$ustatus=$this->SubjectModel->updateSubject($subject_id,$subject_title,$user_id) ;
			

		if($ustatus){
			$message="Subject Information Updated Successfully. Subject_id : ".$subject_id; 
    		$this->session->set_flashdata('success',$message);
    		redirect(base_url().'asubject');  
    	}else{
    		$message="Unable To Update The Subject Info. Contact Administrator. Subject_id : ".$subject_id;
            $this->session->set_flashdata('error',$message);
            redirect(base_url().'asubject');
    	}
	}else{
		$this->session->set_flashdata('error',validation_errors());
        redirect(base_url().'asubject');
	}
}

 //Callback Function For Validating Subject Title
    public function check_subject_title_for_update($subject_title) {        
        if($this->input->post('subjectid')){
            $subject_id = $this->input->post('subjectid');
        }else{
            $subject_id = '';
        }
        $result = $this->SubjectModel->checkUniqueSubjectTitleForUpdate($subject_id,$subject_title);
        if($result == 0){
            $response = true;
        }else {
            $this->form_validation->set_message('check_subject_title_for_update', 'Subject Title Must Be Unique. Subject_id : '.$subject_id);
            $response = false;
        }
        return $response;
    }



//==================Enable and Disable Subject================================

public function enableDisableSubject($subject_id,$status){

  $ustatus=$this->SubjectModel->updateSubjectStatus($subject_id,$status) ;

  if($ustatus){ 
   
    if($status==1){

      $this->session->set_flashdata('success', 'Subject Enabled Successfully. Subject_id : '.$subject_id);

    }else{

      $this->session->set_flashdata('success', 'Subject Disabled Successfully. Subject_id : '.$subject_id);

    }

  }else{

    if($status==1){

      $this->session->set_flashdata('error', 'Unable To Enable The Subject. Try Later! Subject_id : '.$subject_id);

    }else{

      $this->session->set_flashdata('error', 'Unable To Disable The Subject. Try Later! Subject_id : '.$subject_id);

    }

  }

  redirect(base_url().'asubject');

}


}