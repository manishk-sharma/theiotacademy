<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class TrainerAboutYou extends CI_Controller { 

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
    $this->load->model('TrainerAboutYouModel');
    $this->load->library('session');
  }

  
 public function insert_trainerAboutYou(){
     //Validating the information
          //error messages
         
         /* $areaerrmsg=array(
            'required'=>'Area Name Cannot be Empty',);

          $cityerrmsg=array(
            'required'=>'City Name Cannot be Empty',);

          $districterrmsg=array(
            'required'=>'districtr Name Cannot be Empty',);

          $stateerrmsg=array(
            'required'=>'State Name Cannot be Empty',);

          $pincodeerrmsg=array(
            'required'=>'Pincode Cannot be Empty',
            'numeric'=>'Pin code. Must Be Numeric.',
            'max_length'=>'Pincode Must Be 6-Digit Only',);

          $countryerrmsg=array(
            'required'=>'country Name Cannot be Empty',);

          $this->form_validation->set_rules('area','area','required',$areaerrmsg);

          $this->form_validation->set_rules('city','City','required',$cityerrmsg);

          $this->form_validation->set_rules('district','district','required',$districterrmsg);
          $this->form_validation->set_rules('state','State','required',$stateerrmsg);
          $this->form_validation->set_rules('pin_code','pincode','required|numeric|max_length[6]',$pincodeerrmsg);
          
          $this->form_validation->set_rules('country','Country','required',$countryerrmsg);
          if($this->form_validation->run()){*/
          $locatio_id=0;
          //$trainer_id=$this->input->post('trainer_id');

          //print_r($trainer_id);
          //die();
          $about_you=$this->input->post('about_you');
          

          $about_you_id=$this->TrainerAboutYouModel->insertTrainerAboutYou($about_you);

            echo json_encode(array("key" => "aboutYou_id","value"=>$about_you_id));
          // if($address_id>0){
          //       $message="Address Created Successfully with Id: ".$address_id ;
          //           $this->session->set_flashdata('success',$message);
          //           redirect(base_url().'/'); 
          //   }else{
          //       $message="Unable To Create The Address Type. Contact Administrator." ;
          //       $this->session->set_flashdata('error',$message);
          //       redirect(base_url().'/');
          //   }

          // }else{
          //   $this->session->set_flashdata('error',validation_errors());
          //   redirect (base_url().'/');
          // }
    
  }
 
  public function editTrainerAboutYou(){
        

           $aboutYou_id=$this->input->post('aboutYou_id');

          //print_r($trainer_id);
          //die();
          $about_you=$this->input->post('about_you');
          

          $status=False ;
          
          $status=$this->TrainerAboutYouModel->updateTrainerAboutYou($aboutYou_id,$about_you);
            echo(trim($status));
         /* if($status){
            $message="Address Updated Successfully." ;
            $this->session->set_flashdata('success',$message);
            redirect(base_url().'/'); 
        }else{
            $message="Unable To Update The Address. Contact Administrator." ;
            $this->session->set_flashdata('error',$message);
            redirect(base_url().'/');
        }
        }else{
            $this->session->set_flashdata('error',validation_errors());
            redirect (base_url().'/');
          }*/
  }
 

}?>  