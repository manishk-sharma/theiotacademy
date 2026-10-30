<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class TrainerCertification extends CI_Controller { 

  public function __construct(){ 
    parent::__construct();
    //error_reporting(0);
    $this->load->helper('utility_helper');
    $this->load->library('form_validation');
    $this->load->model('AppModel');
    $this->load->model('EmployeeModel');
    $this->load->model('UserModel');
    $this->load->model('DesigModel');
    $this->load->model('UserTypeModel');
    $this->load->model('StudentModel');
    $this->load->model('EventModel');
    $this->load->model('BlogModel');
    $this->load->library('upload');
    $this->load->model('TrainerCertificationModel');
    $this->load->library('session');
  }
 
  
 public function insert_certificate(){
  
     //Validating the information
          //error messages
          
          
          $certificate_id=0;

          $bigData=array();

          $data=array();

          $count_row=$this->input->post('count-row');

          for ($i=1; $i <=$count_row; $i++) { 
          
            $certificate_id=$this->input->post("certificate_db_id".$i);

            $course=$this->input->post("course".$i);

            $institute=$this->input->post("institute".$i);

            $course_duration=$this->input->post("duration".$i);

            if($certificate_id>0){

                $status=$this->TrainerCertificationModel->updateTrainerCertificate($certificate_id,$course,$institute,$course_duration);

                if($status){

                    $filestatus = $this->uploadPdfFile($certificate_id,$i);

                    if ($filestatus) {

                      $fileName='certf-document'.$certificate_id.'pdf';

                      $this->TrainerCertificationModel->updateCertificateFileName($certificate_id,$fileName);
                       
                    }

                }

            }else{

              $data['key']='certificate_db_id'.$i;

              $data['value']=$certificate_id=$this->TrainerCertificationModel->insertTrainerCertificate($course,$institute,$course_duration);

              if($certificate_id){

                 $filestatus = $this->uploadPdfFile($certificate_id,$i);

                  if ($filestatus) {

                    $fileName='certf-document'.$certificate_id.'pdf';

                    $this->TrainerCertificationModel->updateCertificateFileName($certificate_id,$fileName);
                     
                  }

              }

              array_push($bigData, $data);

            }

            

            #[{key: "key1", value: "value1"}, {key: "key2", value: "value2"}];
                     
            
          }
          echo(json_encode($bigData));


          
  }


public function uploadPdfFile($certificate_id,$i)
{       //$filestatus=array();

        $filestatus=false ;
        $error="no error" ;
        $config2['file_name']      = 'certf-document'.$certificate_id;
        $config2['upload_path']    = './uploads/trainer/certf-document/';
        $config2['allowed_types']  = 'pdf|PDF';
        $config2['overwrite']      = TRUE;
        $config2['max_size']       = 5000; //5MB
        $config2['max_width']      = 3000;
        $config2['max_height']     = 2000;

        $this->upload->initialize($config2);

        if ( ! $this->upload->do_upload('certf_document'.$i))
        {
            $error = array('error' => $this->upload->display_errors());

            return "file not found";
            $filestatus=false ;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            
            $filestatus=true ;
        }

        //$filestatus['ext']=$this->upload->data('file_ext');
        
        return $filestatus ;
        
}


  public function updateCertificate(){
        //Validating the information
          //error messages
           $courseerrmsg=array(
            'required'=>'course Title Cannot be Empty.');

          $institutionerrmsg=array(
            'required'=>'institute Name Cannot be Empty.');
          $course_durationerrmsg=array(
            'required'=>'course_duration Name Cannot be Empty');
          
          $this->form_validation->set_rules('course','course',$courseerrmsg);

          $this->form_validation->set_rules('institute','institute','required',$institutionerrmsg);

          $this->form_validation->set_rules('course_duration','course_duration','required',$course_durationerrmsg);

         
          if($this->form_validation->run()){
          //$trainer_id=$this->input->post('trainer_id');
          $certification_id=$this->input->post('certificationid');
          $course=$this->input->post('course');
          $institute=$this->input->post('institute');
          $course_duration=$this->input->post('course_duration');
          $status=False ;
          
          $status=$this->TrainerCertificationModel->updateTrainerCertificate($certificate_id,$course,$institute,$course_duration);
          if($status){
            $message="certificate Updated Successfully." ;
            $this->session->set_flashdata('success',$message);
            redirect(base_url().'/'); 
        }else{
            $message="Unable To Update The certificate. Contact Administrator." ;
            $this->session->set_flashdata('error',$message);
            redirect(base_url().'/');
        }
        }else{
            $this->session->set_flashdata('error',validation_errors());
            redirect (base_url().'/');
          }
  }
  

}?>  