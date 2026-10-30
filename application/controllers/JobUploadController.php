<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
 
class JobUploadController extends CI_Controller { 

 public function __construct(){ 
   parent::__construct();
  $this->load->helper('utility_helper');
   $this->load->library('form_validation');
   $this->load->helper("file");
   $this->load->library('upload');
   $this->load->model('AppModel');
   $this->load->model('EmployeeModel');
   $this->load->model('JobUploadModel');
   $this->load->model('UserModel');
   $this->load->model('DesigModel');
   $this->load->model('UserTypeModel');
   $this->load->library('session'); 
 }
 
public function add_job_page(){
    $this->load->view('admin/uploadjob/index');
 }

 public function insert_job(){
    
            $this->form_validation->set_rules('job_title','Job Title','required');
        $this->form_validation->set_rules('job_location','Job Location','required');
        $this->form_validation->set_rules('deadline','Job Deadline','required');
        $this->form_validation->set_rules('vacancyn','No. Of Vacancy','required');
         $this->form_validation->set_rules('jobdetails','Job Details','required');

        if($this->form_validation->run()==True){
            $jobtitle=$this->input->post('job_title');
            $jblocation=$this->input->post('job_location');
            $jbdeadline=$this->input->post('deadline');
            $jbvancy=$this->input->post('vacancyn');
            $jbdetails=$this->input->post('jobdetails');
            $data=array(
                'job_title'=>$jobtitle,
                'job_location'=>$jblocation,
                'deadline'=>$jbdeadline,
                'vacancy'=>$jbvancy,
                'job_details'=>$jbdetails,
            );

             $gcid=$this->JobUploadModel->Insertjobupload($data);
            if($gcid>0){
                    print json_encode(array('message'=>'success','response'=>"Job Uploaded Successfully."));
            }

            else{
                print_r(json_encode(array('message' => 'sererror', 'response'=>'Job Upload Faield! Try Again')));
            }
        }else{
            print_r(json_encode(array('message' => 'error','response'=>validation_errors())));
        }
 }
 
 public function jobs_seeing_user()
  { 
    $data['result']=$this->JobUploadModel->getAllJobForApply();
    $this->load->view('our_careers_page',$data);
  }


 public function our_jobs()
  { 
    $data['result']=$this->JobUploadModel->getAllJobForuser();
    $this->load->view('admin/uploadjob/result',$data);
  }
 
 public function DeleteJob($id){
    if ($id) {

   $delstatus=$this->JobUploadModel->deleteJobbyid($id);

  }

  if ($delstatus) {

   $this->session->set_flashdata('success', 'Job Deleted Successfully.');

  }

  else{
    $this->session->set_flashdata('error','Course Not Deleted Plz Try Again');
  }

  redirect(base_url().'JobUploadController/our_jobs');
 }

public function editmatjobdata(){
    $jid=$this->input->post('e_idupv');
  $data=$this->JobUploadModel->getJobuserbyid($jid);
  if ($data>0) {
      print_r(json_encode(['message'=>'success','response'=>$data]));
  }
  else{
       print_r(json_encode(['message'=>'sererror','response'=>'Please try again']));
  }
}


public function update_jobin(){
  
  $this->form_validation->set_rules('ujobtitle','Job Title','required');
        $this->form_validation->set_rules('ujjloction','Job Location','required');
        $this->form_validation->set_rules('ujdeadline','Job Deadline','required');
        $this->form_validation->set_rules('ujvacancy','No. Of Vacancy','required');
         $this->form_validation->set_rules('jobdetails','Job Details','required');

        if($this->form_validation->run()==True){
            $jobiid=$this->input->post('idofjob');
            $jobtitle=$this->input->post('ujobtitle');
            $jblocation=$this->input->post('ujjloction');
            $jbdeadline=$this->input->post('ujdeadline');
            $jbvancy=$this->input->post('ujvacancy');
            $jbdetails=$this->input->post('jobdetails');
            $data=array(
                'job_title'=>$jobtitle,
                'job_location'=>$jblocation,
                'deadline'=>$jbdeadline,
                'vacancy'=>$jbvancy,
                'job_details'=>$jbdetails,
            );

             $gcid=$this->JobUploadModel->updatevjobiot($data,$jobiid);
            if($gcid>0){
                    print json_encode(array('message'=>'success','response'=>"Job Updated Successfully."));
            }

            else{
                print_r(json_encode(array('message' => 'sererror', 'response'=>'Job Updation Faield! Try Again')));
            }
        }else{
            print_r(json_encode(array('message' => 'error','response'=>validation_errors())));
        }

}


}?> 
