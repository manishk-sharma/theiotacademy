<?php

//ob_start();

defined('BASEPATH') OR exit('No direct script access allowed');
class EnquirySource extends CI_Controller {
    public function __construct(){

        parent::__construct();

        error_reporting(0);

        $this->load->helper('utility_helper');

        $this->load->library('form_validation');

        $this->load->model('AppModel');

        $this->load->model('EmployeeModel');

        $this->load->model('EnquirySourceModel');

        $this->load->library('session');

    }



    public function index(){    

        $this->load->view('admin/enquirysource/enquirysourcemanage');

    }

    public function enquirysource_submit(){

        //Validating the information

          //error messages

          $titleerrmsg=array(

                            'required'=>'Source Title Cannot Be Empty.',
                            'alpha_numeric_spaces'=>'Source Title Must Contain Only Letters of English Alphabet and Spaces.',
                            'is_unique'=>'Source Title Already Exists. Choose Some Unique Name.'

                            ) ;

          $this->form_validation->set_rules('title','Source Title','required|alpha_numeric_spaces|is_unique[enquiry_sources.title]',$titleerrmsg);
        if($this->form_validation->run()){

            $source_id=0 ;

            $ip=$_SERVER['REMOTE_ADDR']; 

            $title=$this->input->post('title');
            //Insert Enquiry Source

            $source_id=$this->EnquirySourceModel->insertEnquirySource($title) ;

                

            if($source_id>0){

                $message="Enquiry Source Created Successfully with Id: ".$source_id ;

                    $this->session->set_flashdata('success',$message);

                    redirect(base_url().'aenquirysource'); 

            }else{

                $message="Unable To Create The Enquiry Source. Contact Administrator." ;

                $this->session->set_flashdata('error',$message);

                redirect(base_url().'aenquirysource');

            }

        }else{

            $this->session->set_flashdata('error',validation_errors());

            redirect(base_url().'aenquirysource');

        }

    }



    public function enquirysource_update(){

          $source_id=$this->input->post('sourceid') ;

          //Validating the information

          //error messages

          $titleerrmsg=array(

                            'required'=>'Source Title Cannot Be Empty.',

                            'alpha_numeric_spaces'=>'Source Title Must Contain Only Letters of English Alphabet and Spaces.'

                            ) ;

          $this->form_validation->set_rules('utitle','Source Title','required|alpha_numeric_spaces',$titleerrmsg);



        if($this->form_validation->run()){

            $ip=$_SERVER['REMOTE_ADDR']; 

            $title=$this->input->post('utitle');



            //Update Classroom Info

            $ustatus=$this->EnquirySourceModel->updateEnquirySource($source_id,$title) ;

                

            if($ustatus){

                $message="Source Information Updated Successfully." ;

                $this->session->set_flashdata('success',$message);

                redirect(base_url().'aenquirysource');  

            }else{

                $message="Unable To Update The Source Info. Contact Administrator." ;

                $this->session->set_flashdata('error',$message);

                redirect(base_url().'aenquirysource');

            }

        }else{

            $this->session->set_flashdata('error',validation_errors());

            redirect(base_url().'aenquirysource');

        }

    }



}