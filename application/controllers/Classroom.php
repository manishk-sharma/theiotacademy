<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Classroom extends CI_Controller {
    public function __construct(){

        parent::__construct();

        error_reporting(0);

        $this->load->helper('utility_helper');

        $this->load->library('form_validation');

        $this->load->model('AppModel');

        $this->load->model('EmployeeModel');

        $this->load->model('ClassRoomModel');

        $this->load->library('session');

    }



    public function index(){    

        $this->load->view('admin/classroom/classroommanage');

    }



    public function classroom_submit(){

        //Validating the information

          //error messages

          $titleerrmsg=array(

                            'required'=>'ClassRoom Title Cannot Be Empty.',

                            'alpha_numeric_spaces'=>'ClassRoom Title Must Contain Only Letters of English Alphabet and Spaces.',

                            'is_unique'=>'ClassRoom Title Already Exists. Choose Some Unique Name.'

                            ) ;

          $this->form_validation->set_rules('title','ClassRoom Title','required|alpha_numeric_spaces|is_unique[classrooms.title]',$titleerrmsg);



        if($this->form_validation->run()){

            $cr_id=0 ;

            $classroom_id=0 ;

            $ip=$_SERVER['REMOTE_ADDR']; 

            $title=$this->input->post('title');



            //Insert Classroom

            $cr_id=$this->ClassRoomModel->insertClassRoom($title) ;



            //Updating Classroom ID

            $classroom_id=$this->ClassRoomModel->updateClassRoomId($cr_id) ;

                



            if(($cr_id>0)&&is_string($classroom_id)){

                $message="ClassRoom Created Successfully with Id: ".$classroom_id ;

                    $this->session->set_flashdata('success',$message);

                    redirect(base_url().'aclassroom'); 

            }else{

                $message="Unable To Create The ClassRoom. Contact Administrator." ;

                $this->session->set_flashdata('error',$message);

                redirect(base_url().'aclassroom');

            }

        }else{

            $this->session->set_flashdata('error',validation_errors());

            redirect(base_url().'aclassroom');

        }

    }



    public function classroom_update(){

          $cr_id=$this->input->post('crid') ;

          $classroom_id=$this->input->post('classroomid') ;

          //Validating the information

          //error messages

          $titleerrmsg=array(

                            'required'=>'ClassRoom Title Cannot Be Empty.',

                            'alpha_numeric_spaces'=>'ClassRoom Title Must Contain Only Letters of English Alphabet and Spaces.'

                            ) ;

          $this->form_validation->set_rules('utitle','ClassRoom Title','required|alpha_numeric_spaces',$titleerrmsg);



        if($this->form_validation->run()){

            $ip=$_SERVER['REMOTE_ADDR']; 

            $title=$this->input->post('utitle');



            //Update Classroom Info

            $ustatus=$this->ClassRoomModel->updateClassRoom($cr_id,$title) ;

                

            if($ustatus){

                $message="ClassRoom Information Updated Successfully." ;

                $this->session->set_flashdata('success',$message);

                redirect(base_url().'aclassroom');  

            }else{

                $message="Unable To Update The ClassRoom Info. Contact Administrator." ;

                $this->session->set_flashdata('error',$message);

                redirect(base_url().'aclassroom');

            }

        }else{

            $this->session->set_flashdata('error',validation_errors());

            redirect(base_url().'aclassroom');

        }

    }



}