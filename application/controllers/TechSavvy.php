<?php defined('BASEPATH') OR exit('No direct script access allowed');
class TechSavvy extends CI_Controller
{
    function  __construct() {
        parent::__construct();
        $this->load->model('TeamModel');
        $this->load->model('CompTeamModel');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('session');

        $this->load->helper('utility_helper');
    }
    
     function index(){
     $this->load->view('techsavvy/index');
     }
     public function doPayment()
     {
         $this->load->view('techsavvy/make_payment');
     }

    function insert_team_member(){

        
                $team_name=trim($this->input->post('team_name'));
                $primary_email=trim($this->input->post('primary_email'));

                $extStatus=$this->CompTeamModel->isTeamNameExists($team_name);
                if(!$extStatus){

                    $teamId=$this->CompTeamModel->insertTeamName(
                        $data=array('team_name'=>$team_name,'primary_email'=>$primary_email)
                    );
                    if($teamId){

                        $teamStringId=($this->CompTeamModel->updateTeamNameString($teamId));

                        if($teamStringId){


                            for ($i = 1; $i <=4; $i++) {
                    
                                $first_name=trim($this->input->post('name'.$i));

                                $email_id=trim($this->input->post('email'.$i));

                                $mobile_no=trim($this->input->post('telephone'.$i));

                                $colg_name=trim($this->input->post('colg_name'.$i));

                                $graduation_year=trim($this->input->post('year'.$i));

                                if (strlen($first_name)>0 and strlen($email_id)>0 and strlen($mobile_no)>0 and strlen($colg_name)>0 and strlen($graduation_year)>0) {
                                    
                                    $userData = array(

                                    'tm_id'=>$teamStringId,

                                    'first_name' =>$first_name,

                                    'email_id' =>$email_id,

                                    'mobile_no' =>$mobile_no,

                                    'colg_name' =>$colg_name,

                                    'graduation_year'=>$graduation_year                   
                                    );

                                }

                            // Call model to save data one by one

                                if(isset($userData))
                                {
                                    $insertID = $this->TeamModel->insert($userData);
                                    //print_r($insertID);
                                    unset($userData);

                                    /*if($insertID>0)
                                    {
                                        $filestatus = $this->uploadImgFile($teamStringId,$insertID,$i);
                                        // print_r($filestatus);
                                        if ( $filestatus['status']) {

                                          $fileName=$teamStringId.'-member'.$insertID. $filestatus['ext'];

                                          $this->TeamModel->updateTeamFileName($insertID,$fileName);
                                        }
                                    }*/   

                                }
                            }
                            $mailstatus=$this->sendEmail($primary_email,$teamStringId);
                
               
                        }else{
                        echo "113";//Team Name Already Exist
                        }

            }else{
            echo "112";//Team Name Already Exist
            }
        }else{
            echo "111";//Team Name Already Exist
        }
                
}



    public function uploadImgFile($teamStringId,$insertID,$i){       

            $filestatus=array();

            $filestatus['status']=false ;
            $error="no error" ;
            $config2['file_name']      = $teamStringId.'-member'.$insertID;
            $config2['upload_path']    = './uploads/techsavvy2020/collegeid';
            $config2['allowed_types']  = 'png|jpg|jpeg|PNG|JPG|JPEG';
            $config2['overwrite']      = TRUE;
            $config2['max_size']       = 5000; //5MB
            $config2['max_width']      = 3000;
            $config2['max_height']     = 2000;
           $this->load->library('upload',$config2);
            $this->upload->initialize($config2);

            if ( ! $this->upload->do_upload('filename'.$i))
            {
                $error = array('error' => $this->upload->display_errors());

               // return "file not found";
                 $filestatus['status']=false ;
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                
                $filestatus['status']=true ;
            }

            $filestatus['ext']=$this->upload->data('file_ext');
            
            return $filestatus ;
            
    }


    //Function For Sending Enquiry Received Email 
    public function sendEmail($primary_email,$teamStringId){

        //$to_email="yogesh@uniconvergetech.in" ;

        $from_email="enquiry@theiotacademy.co" ;

        $message="Hi ,<br>We have received your Registration for the <strong>Tech Savvy 2020 Contest</strong>.<br><h3>Registration Id :".$teamStringId."</h3><br><br>Thanks.<br>The IoT Academy<br>Ground Floor, NIMS Building, C-56/11, Sector-62, Noida, U.P" ;
        
        $this->email->from($from_email, 'The IoT Academy'); 
        $this->email->to($primary_email);
        $this->email->subject('Enquiry Received'); 
        $this->email->message($message);

        //Sending Email
        if($this->email->send()){
            return TRUE ;
        }else{
            return FALSE ;
        }
    }


    public function uploadProject()
    {
        
       $this->load->library('session');

       $tm_id=$this->input->post('tmId');

       $status=$this->CompTeamModel->isTeamExists($tm_id);

       if($status){

         $paymentStatus=$this->CompTeamModel->checkPaymentStatus($tm_id);

              if($paymentStatus){

                  $this->form_validation->set_rules('file','callback_file_check','Only Pdf File Allowed');

                $this->load->library('upload');//Load library

                if($this->form_validation->run()){
                    //upload configuration
                    $config['file_name']      = $tm_id.'-file';
                    $config['upload_path']   = 'uploads/techsavvy2020/projectfile/';
                    $config['allowed_types'] = 'pdf|PDF';
                    $config['max_size']      = 10240;//10 mb
                    $config['overwrite']      = TRUE;

                    $this->upload->initialize($config);
                   
                    
                    //upload file to directory
                    if($this->upload->do_upload('file')){

                        $uploadData = $this->upload->data();

                        $uploadedFile = $uploadData['file_name'];

                        
                        $this->sendEmailWithProject($uploadedFile,$tm_id);

                        $data['success_msg'] = 'File has been uploaded successfully.';
                        $this->session->set_flashdata('success',$data['success_msg']);
                    }else{

                        $data['error_msg'] = $this->upload->display_errors();
                          echo ($data['error_msg']);
                        $this->session->set_flashdata('error',$data['error_msg']);
                    }

                }else{

                    $this->session->set_flashdata('error',validation_errors());

                }

              }else{

                $this->session->set_flashdata('error','Please Make Payment First.');

                redirect(base_url().'TechSavvy/doPayment');

              }

        }else{

        $this->session->set_flashdata('error','Please Enter Valid Team-Id Or Register First.');

    }
    redirect(base_url().'TechSavvy');
}


//Function For Sending Enquiry Received Email 
    public function sendEmailWithProject($fileName,$tmId){

        $teamData=$this->CompTeamModel->getTeamByTmId($tmId);

        $to_email="mishrayogesh017@gmail.com";

        $from_email="enquiry@theiotacademy.co";

        $file=techSavvyUploadUrl().'projectfile/'.$fileName;

        $message="<strong>Registration Id : ".$tmId." <br>
        Team Name : ".$teamData['team_name']."
        </strong> <br>Uploaded New File For <br>
                 <strong>Tech Savvy 2020 Contest</strong>.<br>
                 <a href=".$file." download>Download file</a>
                 <br>Thanks.<br>
                 The IoT Academy<br>Ground Floor, NIMS Building, C-56/11, Sector-62, Noida, U.P" ;

        $this->email->clear(TRUE);

        $this->email->from($from_email,'The IoT Academy'); 

        $this->email->to($to_email,'rabicwi@gmail.com');

        $this->email->subject('Enquiry Received'); 

        //$this->email->attach(upload_path().'techsavvy2020/projectfile/'.$fileName);

        $this->email->message($message);
       
        //Sending Email
        if($this->email->send()){
           
            return TRUE ;
        }else{
            
            return FALSE ;
        }
    }


    public function file_check($str){
        $allowed_mime_type_arr = array('application/pdf');
        $mime = get_mime_by_extension($_FILES['file']['name']);
        if(isset($_FILES['file']['name']) && $_FILES['file']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){

                 echo "true check";
                return true;

            }else{
                
                return false;
            }
        }else{
           
            return false;
        }
    }

}