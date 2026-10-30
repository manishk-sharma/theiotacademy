<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class TrainerAccount extends CI_Controller { 

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
    $this->load->model('TrainerAccountModel');
    $this->load->library('session');
  }

  
 
public function insert_account(){
     //Validating the information
          //error messages
          
          //$education_id=0;
          
         // $trainer_id=$this->input->post('trainer_id');
          $bank_name=$this->input->post('bank_name');
          $branch =$this->input->post('branch');
          $account_number=$this->input->post('account_number');
          $ifsc_code=$this->input->post('ifsc_code');
         
          $bank_id=$this->TrainerAccountModel->insertTrainerAccount($bank_name,$branch,$account_number,$ifsc_code);
            echo json_encode(array("key" => "bank_id","value"=> $bank_id));
        /*  if($education_id>0){
                $message="Education Created Successfully with Id: ".$education_id ;
                    $this->session->set_flashdata('success',$message);
                    redirect(base_url().'alocation'); 
            }else{
                $message="Unable To Create The Education Type. Contact Administrator." ;
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'alocation');
            }*/

          
  }

  public function updateAccount(){
        //Validating the information
          //error messages
          $bank_id=$this->input->post('bank_id');
          $bank_name=$this->input->post('bank_name');
          $branch =$this->input->post('branch');
          $account_number=$this->input->post('account_number');
          $ifsc_code=$this->input->post('ifsc_code');

          $status=False ;
          
          $status=$this->TrainerAccountModel->updateTrainerAccount($bank_id,$bank_name,$branch,$account_number,$ifsc_code);
           echo(trim($status));
         /* if($status){
            $message="Education Updated Successfully." ;
            $this->session->set_flashdata('success',$message);
            redirect(base_url().'/'); 
        }else{
            $message="Unable To Update The Education. Contact Administrator." ;
            $this->session->set_flashdata('error',$message);
            redirect(base_url().'/');
        }*/
        
  }


}?>  