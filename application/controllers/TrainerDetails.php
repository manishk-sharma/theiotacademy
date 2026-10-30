<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class TrainerDetails extends CI_Controller { 

  public function __construct(){ 
    parent::__construct();
    error_reporting(0);
    
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
    $this->load->model('EventLocationModel');
    $this->load->model('TrainerDetailsModel');
    $this->load->library('session');
    $this->load->library('upload');
   
  }

  public function index(){

    $this->load->view("trainer/index");
 
  }
 
public function insert_trainer(){
     //Validating the information
          //error messages
           //error messages
  //print_r("gfhgfihfgjihgfh");
  //die();
         /* $first_nameerrmsg=array(
            'required'=>'first_name Title Cannot be Empty.');

          $last_nameerrmsg=array(
            'required'=>'last_name Name Cannot be Empty.');

          $birth_dateerrmsg=array(
            'required'=>'birth_date Name Cannot be Empty');

          $mobile_noerrmsg=array(
            'required'=>'mobile_no Name Cannot be Empty');

         $email_iderrmsg=array(
            'required'=>'email_id Name Cannot be Empty');

          $descriptionerrmsg=array(
            'required'=>'description Cannot be Empty');*/

          //if($this->form_validation->run()){
         // $locatio_id=0; 
         //   $photo=$this->input->post('imglink');
          

          $first_name=$this->input->post('first_name');
          $last_name=$this->input->post('last_name');
          $birth_date=$this->input->post('birth_date');
          $gender=$this->input->post('radio_buttons_1_options');
          $course_id=$this->input->post('checkboxes_1_options');

       
            
          $trainer_id=$this->TrainerDetailsModel->insertTrainer($first_name,$last_name,$birth_date,$gender,$course_id);
          
          if($trainer_id>0){

              $fileStatus=$this->uploadProfile($trainer_id);

              if($fileStatus['status']){

                $profileName='trainer_profile'.$trainer_id.'.'.$fileStatus['ext'];

                $this->TrainerDetailsModel->updateTrainerProfile($trainer_id,$profileName);

              }
          }


        
         
        echo json_encode(array("key" => "trainer_id","value"=>$trainer_id));
         //$filestatus=uploadTrainerProfile($trainer_id);
        // echo(json_encode($filestatus));
         /* if($location_id>0){
                $message="Trainer Created Successfully with Id: ".$location_id ;
                    $this->session->set_flashdata('success',$message);
                    redirect(base_url().'/'); 
            }
            else if{
                $message="Unable To Create The Trainer . Contact 
                ." ;
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'/');
            }

          }else{
            $this->session->set_flashdata('error',validation_errors());
            redirect (ba*///se_url().'/');
         // }
    
  }

  public function uploadProfile($trainer_id)
  {       
          $filestatus=array();
          $filestatus['status']=false ;
          $error="no error" ;
          $config2['file_name']      = 'trainer_profile'.$trainer_id;
          $config2['upload_path']    = './uploads/trainer/profilepic/';
          $config2['allowed_types']  = 'PNG|png|JPG|jpg|JPEG|jpeg';
          $config2['overwrite']      = TRUE;
          $config2['max_size']       = 5000; //5MB
          $config2['max_width']      = 3000;
          $config2['max_height']     = 2000;

          $this->upload->initialize($config2);

          if ( ! $this->upload->do_upload('picture'))
          {
              $error = array('error' => $this->upload->display_errors());

              $filestatus['status']=false;
               
          }
          else
          {
              $data = array('upload_data' => $this->upload->data());
              
              $filestatus['status']=true ;
          }

          $filestatus['ext']=$this->upload->data('file_ext');
          
          return $filestatus ;
          
  }

  public function update_trainer(){
        //Validating the information
          //error messages
         /* $first_nameerrmsg=array(
            'required'=>'first_name Title Cannot be Empty.');

          $last_nameerrmsg=array(
            'required'=>'last_name Name Cannot be Empty.');

          $birth_dateerrmsg=array(
            'required'=>'birth_date Name Cannot be Empty');

          $mobile_noerrmsg=array(
            'required'=>'mobile_no Name Cannot be Empty');

         $email_iderrmsg=array(
            'required'=>'email_id Name Cannot be Empty');

          $descriptionerrmsg=array(
            'required'=>'description Cannot be Empty');
*/
            

        //  if($this->form_validation->run()){

          $trainer_id=$this->input->post('trainer_id');
         // print_r($trainer_id);
          //die();

          $first_name=$this->input->post('first_name');
          $last_name=$this->input->post('last_name');
          $birth_date=$this->input->post('birth_date');
          $gender=$this->input->post('radio_buttons_1_options');
          $course_id=$this->input->post('checkboxes_1_options');
         
          $status=$this->TrainerDetailsModel->updateTrainer($trainer_id,$first_name,$last_name,$birth_date,$gender,$course_id);

          $this->uploadProfile($trainer_id);

            echo(trim($status));
              //print_r($status);
        /*  if($status){
            $message="Trainer Updated Successfully." ;
            $this->session->set_flashdata('success',$message);
            redirect(base_url().'/'); 
        }else{
            $message="Unable To Update The Trainer. Contact Administrator." ;
            $this->session->set_flashdata('error',$message);
            redirect(base_url().'/');
        }
        }else{
            $this->session->set_flashdata('error',validation_errors());
            redirect (base_url().'/');
          }*/
  }
  public function enableDisableTrainer($trainer_id,$status)
  {
      $ustatus=$this->TrainerDetailsModel->updateTrainerStatus($trainer_id,$status);
      if ($ustatus) {
        if ($status==1) {
          $this->session->set_flashdata('success',"Trainer Enabled Successfully");
        }
        else{
          $this->session->set_flashdata('success',"Trainer Disabled Successfully");
        }
      }
      else{
        if ($status==1) {
          $this->session->set_flashdata('error',"Failed To Enable Trainer ");
        }
        else{
          $this->session->set_flashdata('error',"Failed To Disable Trainer ");
        }
      }
      redirect(base_url().'/');
  }


}?>  