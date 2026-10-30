<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

    public function __construct(){ 

        parent::__construct();

        error_reporting(0);

        $this->load->helper('utility_helper');

        $this->load->library('form_validation');

        $this->load->model('AppModel');

        $this->load->model('EmployeeModel');

        $this->load->model('CompanyModel');

        $this->load->library('session');

        //$this->load->database(); 

    }

    public function index(){ 
        $this->load->view('admin/company/companymanage');
    }

    public function add_company(){
        $this->load->view('admin/company/addcompany');
    }

    public function edit_company($id){
        $data=$this->CompanyModel->getCompanyById($id);
        $this->load->view('admin/company/editcompany',$data);

    }

    public function company_submit(){

          $emailerrmsg=array(
                        'required'=>'Email ID Cannot Be Empty.',
                        'valid_email'=>'Email ID Must Be A Valid Email Address.'

                        ) ;

          $this->form_validation->set_rules('emailid','Email ID','required|valid_email',$emailerrmsg);
        if($this->form_validation->run()){

            $comp_id=0 ;
            $ip=$_SERVER['REMOTE_ADDR']; 
            $company_name=$this->input->post('companyname');
            $pan_no=$this->input->post('panno');
            $gst_no=$this->input->post('gstno');
            $website=$this->input->post('website');
            $remark=$this->input->post('remark');
            $email_id=$this->input->post('emailid');
            $contact_no=$this->input->post('contactno');
            $alt_contact_no=$this->input->post('altcontactno');
            $company_addr=$this->input->post('compaddress');
            //Insert Company
            $comp_id=$this->CompanyModel->insertCompany($company_name,$pan_no,$gst_no,$website,$remark,$email_id,$contact_no,$alt_contact_no,$company_addr) ;
            if($comp_id>0){

                $message="Company Added Successfully with Id: ".$comp_id ;

                $this->session->set_flashdata('success',$message);

                redirect(base_url().'acompany');  

            }else{

                $message="Unable To Create The Company. Contact Administrator." ;

                $this->session->set_flashdata('error',$message);

                redirect(base_url().'add-company');

            }

        }else{

            $this->session->set_flashdata('error',validation_errors());

            redirect(base_url().'add-company');

        }

    }



    public function company_update(){

          $comp_id=$this->input->post('compid') ;

          //Validating the information

          //error messages

          $compnameerrmsg=array(

                            'required'=>'Company Name Cannot Be Empty.',

                            'alpha_numeric_spaces'=>'Company Name Must Contain Only Letters of English Alphabet and Spaces.'

                            ) ;

          $contacterrmsg=array(

                        'required'=>'Contact No. Cannot Be Empty.',

                        'numeric'=>'Contact No. Must Be Numeric.',

                        'max_length'=>'Contact No. Must Be 10-Digit Number.'

                        ) ;

          $altcontacterrmsg=array(

                        'required'=>'Alternate Contact No. Cannot Be Empty.',

                        'numeric'=>'Alternate Contact No. Must Be Numeric.',

                        'max_length'=>'Alternate Contact No. Must Be 10-Digit Number.'

                        ) ;

          $emailerrmsg=array(

                        'required'=>'Email ID Cannot Be Empty.',

                        'valid_email'=>'Email ID Must Be A Valid Email Address.'

                        ) ;

          $this->form_validation->set_rules('companyname','Company Name','required|alpha_numeric_spaces',$compnameerrmsg);

          $this->form_validation->set_rules('contactno','Contact No','required|numeric|max_length[10]',$contacterrmsg);

          $this->form_validation->set_rules('altcontactno','Alternate Contact No','required|numeric|max_length[10]',$altcontacterrmsg);

          $this->form_validation->set_rules('emailid','Email ID','required|valid_email',$$emailerrmsg);



        if($this->form_validation->run()){

            $ip=$_SERVER['REMOTE_ADDR']; 

            $company_name=$this->input->post('companyname');

            $pan_no=$this->input->post('panno');

            $gst_no=$this->input->post('gstno');

            $website=$this->input->post('website');

            $remark=$this->input->post('remark');

            $email_id=$this->input->post('emailid');

            $contact_no=$this->input->post('contactno');

            $alt_contact_no=$this->input->post('altcontactno');

            $company_addr=$this->input->post('compaddress');



            //Update Company Info

            $ustatus=$this->CompanyModel->updateCompany($comp_id,$company_name,$pan_no,$gst_no,$website,$remark,$email_id,$contact_no,$alt_contact_no,$company_addr) ;

                

            if($ustatus){

                $message="Company Information Updated Successfully." ;

                $this->session->set_flashdata('success',$message);

                redirect(base_url().'acompany');  

            }else{

                $message="Unable To Update The Company Info. Contact Administrator." ;

                $this->session->set_flashdata('error',$message);

                redirect(base_url().'acompany');

            }

        }else{

            $this->session->set_flashdata('error',validation_errors());

            redirect(base_url().'company/edit_company/'.$comp_id);

        }

    }



}