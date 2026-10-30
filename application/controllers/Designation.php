<?php
//ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Designation extends CI_Controller {

	public function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->helper('utility_helper');
		$this->load->library('form_validation');
		$this->load->model('DesigModel');
		$this->load->model('AppModel');
		$this->load->model('EmployeeModel');
		$this->load->model('UserTypeModel');
		$this->load->library('session');
		//$this->load->helper(array('form', 'url'));
		//$this->load->library('form_validation');
	}

	public function index(){	
		$this->load->view('admin/designation/designationmanage');
	}

	//Function For Getting Designation List JSON AJAX Output
	public function printDesigListByUserTypeId(){
		$user_type_id=$this->input->post('usertypeid') ;
		$data=$this->DesigModel->getDesigListByUserType($user_type_id) ;
		if(count($data)>0){
			echo json_encode($data);
		}else{

			echo 'false' ;
		}
	}

	public function designation_submit(){

        //Validating the information
          //error messages
          $titleerrmsg=array(

                            'required'=>'Designation Title Cannot Be Empty.',
                            'alpha_numeric_spaces'=>'Designation Title Must Contain Only Letters of English Alphabet and Spaces.',
                            'is_unique'=>'Designation Title Already Exists. Choose Some Unique Name.'

                            ) ;

          $descerrmsg=array('required'=>'Description Cannot Be Empty.') ;
          $this->form_validation->set_rules('title','Designation Title','required|alpha_numeric_spaces|is_unique[designations.title]',$titleerrmsg);
          $this->form_validation->set_rules('description','Description','required',$descerrmsg);
        if($this->form_validation->run()){
            $desig_id=0 ;
            $ip=$_SERVER['REMOTE_ADDR']; 
            $title=$this->input->post('title');
            $description=$this->input->post('description');
            $user_type_id=$this->input->post('usertypeid');

            //Insert Designation
            $desig_id=$this->DesigModel->insertDesignation($title,$description,$user_type_id) ;

            if($desig_id>0){
                $message="Designation Created Successfully with Id: ".$desig_id ;
                    $this->session->set_flashdata('success',$message);
                    redirect(base_url().'adesignation'); 

            }else{

                $message="Unable To Create The Designation. Contact Administrator." ;
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'adesignation');
            }

        }else{

            $this->session->set_flashdata('error',validation_errors());
            redirect(base_url().'adesignation');
        }
    }

    public function designation_update(){
          $desig_id=$this->input->post('desigid') ;
        //Validating the information
          //error messages
          $titleerrmsg=array(

                            'required'=>'Designation Title Cannot Be Empty.',
                            'alpha_numeric_spaces'=>'Designation Title Must Contain Only Letters of English Alphabet and Spaces.'

                            ) ;

          $descerrmsg=array('required'=>'Description Cannot Be Empty.') ;

          $this->form_validation->set_rules('uptitle','Designation Title','required|alpha_numeric_spaces',$titleerrmsg);
          $this->form_validation->set_rules('updescription','Description','required',$descerrmsg);
        if($this->form_validation->run()){

            $ip=$_SERVER['REMOTE_ADDR']; 
            $title=$this->input->post('uptitle');
            $description=$this->input->post('updescription');
            $user_type_id=$this->input->post('upusertypeid');
            //Update Designation Info
            $ustatus=$this->DesigModel->updateDesignation($desig_id,$title,$description,$user_type_id) ;
            if($ustatus){
                $message="Designation Information Updated Successfully." ;
                $this->session->set_flashdata('success',$message);
                redirect(base_url().'adesignation');  

            }else{

                $message="Unable To Update The Designation Info. Contact Administrator." ;
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'adesignation');
            }

        }else{

            $this->session->set_flashdata('error',validation_errors());
            redirect(base_url().'adesignation');

        }
    }
}