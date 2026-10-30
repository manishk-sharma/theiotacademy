<?php
class ApplyForJob extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('ApplyForJobModel');
        $this->load->helper('utility_helper');

    }

    //start apply job submit form and send mail admin and user

    public function apply_job_submit_form(){
        $this->form_validation->set_rules('fullname','Employee Name','required');
        $this->form_validation->set_rules('phoneno','Employee Mobile No','required');
        $this->form_validation->set_rules('email','Employee Email','required');
        $this->form_validation->set_rules('select_job_category','Position','required');
        $this->form_validation->set_rules('resume','Resume','callback_file_check');
        if($this->form_validation->run()){
            $emp_name=$this->input->post('fullname');
            $emp_mobile=$this->input->post('phoneno');
            $emp_email=$this->input->post('email');
            $emp_job_category=$this->input->post('select_job_category');
            $form_name=$this->input->post('form_job_name');
            $url_sourcenm=$this->input->post('job_url_source_name');
            $data=array(
                'emp_name'=>$emp_name,
                'emp_mobile'=>$emp_mobile,
                'emp_email'=>$emp_email,
                'emp_job_category'=>$emp_job_category,
                'form_name'=> $form_name,
                'url_source'=>$url_sourcenm
            );

            $ismatchdtc=$this->ApplyForJobModel->isemployeedetailsmatch($emp_mobile,$emp_email,$emp_job_category);
            $crtdate = new DateTime('now');
             $crtdate =  $crtdate->format('Y-m-d h:i:s');
            $mdate = new DateTime($ismatchdtc['created_date']);
            $mdate->modify('+5 month');
            $mdate = $mdate->format('Y-m-d h:i:s');
            $onydtf=new DateTime($ismatchdtc['created_date']);
            $onydtf=$onydtf->format('Y-m-d');
            if ($mdate<=$crtdate ||  !$ismatchdtc) {
            $apply_job_id=$this->ApplyForJobModel->applyJobAapplicationRegister($data);

            if($apply_job_id>0){
                $fileStatus=$this->upload_emp_resume($apply_job_id,$emp_name);
                if($fileStatus['status']==TRUE){
                    $this->ApplyForJobModel->updateResumeByID($apply_job_id,$fileStatus['file_name']);
                    $empData = $this->ApplyForJobModel->getRecordById($apply_job_id);
                    $admin_apply_job_mail_status=$this->admin_apply_job_Email($empData);
                    $user_apply_job_mail_status=$this->user_apply_job_ConfirmEmail($empData);
                    //Send mail
                    if($admin_apply_job_mail_status){
                        print json_encode(array('message'=>'success','response'=>"Your Job Application Requested Successfully."));

                    }else{
                        die(json_encode(array('message' => 'success', 'response'=>"Your Job Application Requested Successfully ."))); 
                    }

                }

                else{
                     print_r(json_encode(array('message' => 'error','response'=>'Please Upload resume jpg/jpeg/png/pdf.')));

                }   

            }

            else{

                print_r(json_encode(array('message' => 'sererror','response'=>'Job Application Failed! Try Again')));
            }   

        }
        else{
            print_r(json_encode(array('message' => 'error','response'=>'We wanted to inform you that you applied for this job on ' .$onydtf. ' .You can reapply for this position six months from your application date.
')));
         } 

        }

        else{

            print_r(json_encode(array('message' => 'error','response'=>validation_errors())));

        }

    }   
    public function file_check(){

        if(isset($_FILES['resume'])){

            $errors= array();
            $file_name = $_FILES['resume']['name'];
            $file_size =$_FILES['resume']['size'];
            $file_tmp =$_FILES['resume']['tmp_name'];
            $file_type=$_FILES['resume']['type'];
            $temp=explode('.',$_FILES['resume']['name']);
            $file_ext=strtolower(end($temp));

            $expensions= array("doc","docx","pdf");

            if(in_array($file_ext,$expensions)=== false){
                $message=$errors[]="File format is not supported, Please choose PDF or Docx file only.";
            } 

            elseif($file_size > 2097152){ //size in biytes
                $message=$errors[]='File size should not be more than 2 MB';
            }

            if(empty($errors)==true){

                return TRUE;

            }else{

                $this->form_validation->set_message('file_check', $message);

                return FALSE;

            }

        }

    }

    //----end apply job  form-----

     //start apply job  admin mail

    public function admin_apply_job_Email($data){

        //------Email Section-----
        $from_email = "enquiry@theiotacademy.co";
        $to_email = "careers@uniconvergetech.in";

        $this->email->from($from_email,'Enquiry | The IoT Academy'); 
        $this->email->to($to_email);
        $this->email->subject('New Job Application Received for ' .$data['emp_job_category']. ' course through Website By ' .$data['emp_name']); 
        $this->email->message($this->load->view('mailFormat/admin_apply_job_mail',$data,TRUE)); 
        $this->email->attach(resume_url().'resume/'.$data['emp_resume']);
        //Sending Email 

        if($this->email->send()){
            $this->email->clear(TRUE);//Clear past attached file
            return TRUE ;
        }else{

            return FALSE ;
        }
    }

  //end  apply job admin mail
  //sending user apply job  confirmation mail

    public function user_apply_job_ConfirmEmail($data){
        //------Email Section-----

        $from_email = "enquiry@theiotacademy.co";
        $to_email = $data['emp_email'];
        $this->email->from($from_email,'Enquiry | The IoT Academy'); 
        $this->email->to($to_email);
        $this->email->subject('Congratulations '.$data['emp_name'].'! Your Job Application  Requested Successfully'); 
       $this->email->message($this->load->view('mailFormat/employee_apply_job_mail',$data,TRUE));

        //Sending Email

        if($this->email->send()){
            return TRUE ;
        }else{

            return FALSE ;
        }
    }

        //end apply job form submit form and send mail admin and user

    public function upload_emp_resume($apply_job_id,$student_name)

    {

        $fileStatus=array();
        $resume = '';
        $config['upload_path'] = './uploads/resume';
        $config['file_name']  = $student_name.'_Resume_'.$apply_job_id;
        $config['allowed_types']        = 'pdf|docx|doc';
        $config['max_size']             = 2050;//size in KB
         $this->load->library('upload', $config);
         $this->upload->initialize($config);
        if (!empty($_FILES['resume']['name'])){
            if ( ! $this->upload->do_upload('resume')) {

                $fileStatus['file_name'] = '';
                $fileStatus['status'] = FALSE;
                return $fileStatus;
            }   

            else{ 

                $data = $this->upload->data();
                $fileStatus['file_name'] = $data['file_name'];
                $fileStatus['status'] = TRUE;
                return $fileStatus;

            }               
        }
    } 

}?>