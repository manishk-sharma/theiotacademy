<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
 
class AddAllCourses extends CI_Controller { 

 public function __construct(){ 
   parent::__construct();
   //error_reporting(0);
  $this->load->helper('utility_helper');
   $this->load->library('form_validation');
   $this->load->helper("file");
   $this->load->library('upload');
   $this->load->model('AppModel');
   $this->load->model('EmployeeModel');
   $this->load->model('UserModel');
   $this->load->model('DesigModel');
   $this->load->model('UserTypeModel');
   $this->load->model('AddAllCourseModel');
   $this->load->library('session'); 
   $this->load->library("pagination");
 }
 
public function our_courses()
  { 
    $data['result']=$this->AddAllCourseModel->getAllCourseForuser();
    $this->load->view('ourcourses',$data);
  }

 

public function add_all_ins_course()  
 {
    $this->load->view('admin/allcourses/addcourse');
 }
 
public function show_all_ins_course()  
 {
    $data['data']=$this->AddAllCourseModel->admin_total_course();
    $this->load->view('admin/allcourses/showcourselist',$data);
 }


public function AllCourseInsert(){  

$urlerrormsg=array('required'=>'Url Cannot Be Empty.','is_unique'=>'Url Already Exists. Choose Other Unique Url.'); 

       $this->form_validation->set_rules('course_url','Course Url','required');
      $this->form_validation->set_rules('course_title','Course Title','required');
     $this->form_validation->set_rules('course_title','Course Title','required');
     $this->form_validation->set_rules('choose_course_type','Course Type','required');
    $this->form_validation->set_rules('course_description','Course Description','required');
    //$this->form_validation->set_rules('course_image','Course Image','required');


  if($this->form_validation->run()){

         $course_url=$this->input->post('course_url');
              $course_title=$this->input->post('course_title');
              $choose_course_type=$this->input->post('choose_course_type');
              $course_duration=$this->input->post('course_duration');
              $course_description=$this->input->post('course_description');
              $course_deadline_date=$this->input->post('course_deadline_date');
               //$course_image=$this->input->post('course_image');
            $data=array(
                'course_title'=>$course_title,
                'course_url'=>$course_url,
                'course_type'=>$choose_course_type,
                'course_duration'=>$course_duration,
                'course_description'=>$course_description,
                'course_deadline'=>$course_deadline_date,
            );
            $add_course_id=$this->AddAllCourseModel->InsertAllCourseForm($data);
      if($add_course_id)
         {  
         $courseimgtatus=$this->uploadCourseImageFile($add_course_id) ;
         if($courseimgtatus){

           $hstatus=$this->AddAllCourseModel->updateCourseimgByID($add_course_id,$courseimgtatus);//updating in db
           if($hstatus){ 

            $this->session->set_flashdata('success', 'Course Inserted Successfully. Course Id : '.$add_course_id);

            redirect(base_url().'all-instructors-course');

           }else{

            $headererrormsg=" ";

            if (!$hstatus) { 
              $headererrormsg=' Course Image Names Not Updated. Please Try <br> ';
            }

            $this->session->set_flashdata('error',$headererrormsg);
            redirect(base_url().'all-instructors-course');
           }
        }else{

          $this->session->set_flashdata('error', 'Error ! Course Images Not Uploaded.<br> Possible Reasons:<br>1.Max Size 1.5MB .<br>2. max. width of 3000 and max. height of 2000.<br>uPlease Try Again!');
          redirect(base_url().'all-instructors-course');
        }
      }else{

          $this->session->set_flashdata('error', 'Some Error Occured. Please Try Again!');
          redirect(base_url().'all-instructors-course');
      }

    }else{

        $this->session->set_flashdata('error',validation_errors());
        redirect(base_url().'all-instructors-course');

    }

 }


public function AllCoursefindbyId($id){

    $data['result']=$this->AddAllCourseModel->getaddCourseById($id);
    //print_r($data);exit();
   $this->load->view('admin/allcourses/editcourse',$data);

}

public function AllCourseUpdatebyId(){
 
    $this->form_validation->set_rules('course_url','Course Url','required');
    $this->form_validation->set_rules('course_title','Course Title','required');
    $this->form_validation->set_rules('choose_course_type','Course Type','required');
    $this->form_validation->set_rules('course_duration','Course Duration','required');
    $this->form_validation->set_rules('course_description','Course Description','required');
  if($this->form_validation->run()){
          $id=$this->input->post('courseid');
          $course_url=$this->input->post('course_url');
          $course_title=$this->input->post('course_title');
          $choose_course_type=$this->input->post('choose_course_type');
          $course_duration=$this->input->post('course_duration');
          $course_description=$this->input->post('course_description');
          $course_deadline_date=$this->input->post('course_deadline_date');
        $data=array(
            'course_title'=>$course_title,
            'course_url'=>$course_url,
            'course_type'=>$choose_course_type,
            'course_duration'=>$course_duration,
            'course_description'=>$course_description,
            'course_deadline'=>$course_deadline_date,
        );

         $updatecourseid=$this->AddAllCourseModel->UpdateAllCourseForm($data,$id);  
           if($updatecourseid){ 

            $this->session->set_flashdata('success', 'Course Update Successfully. Course Id : '.$id);

            redirect(base_url().'all-instructors-course');

           }else{
               $this->session->set_flashdata('error', 'Some Error Occured. Please Try Again!');
               redirect(base_url().'all-instructors-course');
           }


    }else{

        $this->session->set_flashdata('error',validation_errors());
        redirect(base_url().'all-instructors-course');

    }

}


public function uploadCourseImageFile($add_course_id){       

        $filestatus=array();
        $filestatus['status']=false ;
        $error="no error" ;
        $config['file_name']      = 'courseimage-'.$add_course_id;
        $config['upload_path']    = './uploads/allcourse/';
        $config['allowed_types']  = 'PNG|png|JPG|jpg|JPEG|jpeg|bmp|BMP|tiff|TIFF';

        $config['overwrite']      = TRUE; 
        $config['max_size']       =1500;
        $config['max_width']      = 3000;
        $config['max_height']     = 2000;

        $this->upload->initialize($config);
        $this->upload->do_upload('course_image');
         if ( ! $this->upload->do_upload('course_image'))
         { 
            $error = array('error' => $this->upload->display_errors());
            $filestatus['status']=false ;
         }
         else
         {
             $data = array('upload_data' => $this->upload->data());
             $filestatus['status']=true ;
         }

         $filestatus['ext']=$this->upload->data('file_ext');
         return $filestatus ;
         //return $error ;
}

public function uploadupdateCourseImageFile($id){
       $filestatus=array();
        $filestatus['status']=false ;
        $error="no error" ;
        $config['file_name']      = 'courseimage-'.$id;
        $config['upload_path']    = './uploads/allcourse/';
        $config['allowed_types']  = 'PNG|png|JPG|jpg|JPEG|jpeg|bmp|BMP|tiff|TIFF';

        $config['overwrite']      = TRUE; 
        $config['max_size']       =1500;
        $config['max_width']      = 3000;
        $config['max_height']     = 2000;

        $this->upload->initialize($config);
        $this->upload->do_upload('course_image');
         if ( ! $this->upload->do_upload('course_image'))
         { 
            $error = array('error' => $this->upload->display_errors());
            $filestatus['status']=false ;
         }
         else
         {
             $data = array('upload_data' => $this->upload->data());
             $filestatus['status']=true ;
         }

         $filestatus['ext']=$this->upload->data('file_ext');
         return $filestatus ;
         //return $error ;
}

public function DeleteCourse($id){

  if ($id) {

   $delstatus=$this->AddAllCourseModel->deleteCourseData($id);

  }

  if ($delstatus) {

   $this->session->set_flashdata('success', 'Course Deleted Successfully.Course Id: '.$id);

  }

  else{

    $this->session->set_flashdata('error','Course Not Deleted Plz Try Again Or Contact Admin');

  }

  redirect(base_url().'all-instructors-course');

}


public function search_course_by_keywords() {
         $searchkeyvalue=$this->input->post('searchinval');
         if(trim($searchkeyvalue)!=''){
         
        $data = $this->AddAllCourseModel->get_search_all_course_by_keyword($searchkeyvalue);
        if ($data) {
            
        $output = '';
           $output.='<div class="row mb-2 blog-inner">';
                foreach($data as $result){
                    $id = $result->id;
                    $route=$result->course_url;
                    $course_image=$result->course_image;
                    $course_title=$result->course_title;
                    $course_duration=$result->course_duration;
                    $course_deadline=date('d-m-Y',strtotime($result->course_deadline));
                    $description = substr($result->course_description, 0, 110);

                    // Creating HTML structure 
                    
                    $output.='<div class="col-lg-4 col-md-6 mt-4 mb-2">
                            <a href="'.$route.'">
                                <div class="blog-main-card-st pb-4" id="post_'.$id.'">
                                    <div class="blog-images">
                                    <img src="'.base_url().''.'uploads/allcourse/'.''.$course_image.'" alt="'.$course_title.'" width="100%">
                                    </div>
                                    <div class="blog-content p-3">
                                        <h5 class="mt-1 mb-4">'.$course_title.'</h5>
                                        <p class="text-justify" style="color:#000;">'.$description.'...</p>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <div class="duration_n-deadline">
                                                <div>Course Duration</div>
                                                <div>'.$course_duration.'</div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="duration_n-deadline">
                                                <div>Application Deadline</div>
                                                <div>'.$course_deadline.'</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>';        
                }
       echo $output.'</div>';
     }
     else{
        echo "<h2 class='text-center mt-4 mb-3'>Record Not Found!</h2>";
     }
 }
 else{
        $data = $this->AddAllCourseModel->getAllCourseForuser();
        $html = '';
           $html.='<div class="row mb-2 blog-inner">';
                 foreach($data as $result){
                    $id = $result->id;
                    $route=$result->course_url;
                    $course_image=$result->course_image;
                    $course_title=$result->course_title;
                    $course_duration=$result->course_duration;
                    $course_deadline=date('d-m-Y',strtotime($result->course_deadline));
                    $description = substr($result->course_description, 0, 110);

                    // Creating HTML structure 
                    
                    
                    $html.='<div class="col-lg-4 col-md-6 mt-4 mb-2">
                            <a href="'.$route.'">
                                <div class="blog-main-card-st pb-4" id="post_'.$id.'">
                                    <div class="blog-images">
                                    <img src="'.base_url().''.'uploads/allcourse/'.''.$course_image.'" alt="'.$course_title.'" width="100%">
                                    </div>
                                    <div class="blog-content p-3">
                                        <h5 class="mt-1 mb-4">'.$course_title.'</h5>
                                        <p class="text-justify" style="color:#000;">'.$description.'...</p>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <div class="duration_n-deadline">
                                                <div>Course Duration</div>
                                                <div>'.$course_duration.'</div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="duration_n-deadline">
                                                <div>Application Deadline</div>
                                                <div>'.$course_deadline.'</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>';        
                }
                 
       echo $html.'</div>';
 }
 
}

}?> 
