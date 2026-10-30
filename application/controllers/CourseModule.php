<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CourseModule extends CI_Controller {

    public function __construct(){
        parent::__construct();
        error_reporting(0);
        $this->load->helper('utility_helper');
        $this->load->library('form_validation');
        $this->load->model('CourseModuleModel');
        $this->load->model('CourseModel');
        $this->load->model('AppModel');
        $this->load->model('ModuleTopicModel');
        $this->load->model('EmployeeModel');
        $this->load->library('session');

        //$this->load->database();


    }

    public function index(){    

        $this->load->view('admin/coursemodule/cmodulemanage');

    }



    //-------------For Course-Module Mapping in course_modules table----

    public function submit_cmodule_to_batch(){

        $mapping_id=0 ;

        $exists=FALSE ;

        $cm_id=$this->input->post('cmid');

        $course_id=$this->input->post('courseid');

        $exists=$this->CourseModuleModel->isModuleAlreadyInCourse($cm_id,$course_id);

        if(!$exists){

             $mapping_id=$this->CourseModuleModel->insertModuleToCourse($cm_id,$course_id);

             if($mapping_id>0){

                //Updating Modules Quantity in Courses Table

                $mqstatus=$this->CourseModel->updateModuleQuantityByPlusOne($course_id);

             }

             if(($mapping_id>0)&&($mqstatus)){

                $message="Module Added To Course Successfully.";

                $this->session->set_flashdata('success',$message);

                redirect(base_url().'acoursemodule');

             }else{

                $message="Unable To Add Module To Course. Contact Administrator.";

                $this->session->set_flashdata('error',$message);

                redirect(base_url().'acoursemodule');

             }

        }else{

           $message="Module Already Exists In The Specified Course.";

           $this->session->set_flashdata('error',$message);

           redirect(base_url().'acoursemodule');

        }

        

    }



    //------------------------------------------------------------------

    public function add_cmodule(){

        $this->load->view('admin/coursemodule/addcmodule');

    }

    public function edit_cmodule($id){

        $data=$this->CourseModuleModel->getCourseModuleById($id);

        $this->load->view('admin/coursemodule/editcmodule',$data);

    }

    public function getAllModuleHourBycourse_id()

    {

        $course_id= $this->input->post('courselist');
        $totalDuration=0;
        $modulelist=$this->CourseModuleModel->getModulesByCourseId($course_id);

          foreach($modulelist as $mlist){
            $minfo=$this->CourseModuleModel->getCourseModuleById($mlist->cm_id);
            $totalDuration += $minfo['duration'];

        }

        echo(json_encode($totalDuration));

    }

    public function cmodule_submit(){

        //Validating the information

          //error messages

          $modnameerrmsg=array(

                            'required'=>'Module Name Cannot Be Empty.',

                            'alpha_numeric_spaces'=>'Module Name Must Contain Only Letters of English Alphabet and Spaces.',

                            'is_unique'=>'Module Name Already Exists. Choose Some Unique Name.'

                            ) ;

          $feeerrmsg=array(

                        'required'=>'Module Fee Cannot Be Empty.',

                        'numeric'=>'Module Fee Must Be Numeric.'

                        ) ;

          $descerrmsg=array(

                        'required'=>'Description Cannot Be Empty.'

                        ) ;

          $this->form_validation->set_rules('modulename','Module Name','required|alpha_numeric_spaces|is_unique[cmodules.module_name]',$modnameerrmsg);

          $this->form_validation->set_rules('modulefee','Module Fee','required|numeric',$feeerrmsg);

          $this->form_validation->set_rules('description','Description','required',$descerrmsg);



        if($this->form_validation->run()){

            $cm_id=0 ;

            $module_id=0 ;

            $ip=$_SERVER['REMOTE_ADDR']; 
            $module_name=$this->input->post('modulename');
            $module_fee=$this->input->post('modulefee');
            $description=$this->input->post('description');
            $duration=$this->input->post('duration');
            $countTopic=$this->input->post('countTopic');
            //Insert Course Module
            $cm_id=$this->CourseModuleModel->insertCourseModule($module_name,$module_fee,$description,$duration) ;
            //Updating Module ID
            $module_id=$this->CourseModuleModel->updateCourseModuleId($cm_id) ;
            if(($cm_id>0)&&is_string($module_id)){
                for ($i=1; $i <=$countTopic; $i++) { 
                   $insertFlag = $this->input->post('flag'.$i);
                   if($insertFlag){ 
                      $sequence = $this->input->post('sequence'.$i);
                      $topic_name = $this->input->post('topic_name'.$i);
                      $this->ModuleTopicModel->insertModuleTopic($cm_id,$sequence,$topic_name);
                   } 

                }
            }

            if(($cm_id>0)&&is_string($module_id)){

                $message="Course Module Created Successfully with Id: ".$module_id ;
                $this->session->set_flashdata('success',$message);
                redirect(base_url().'acoursemodule');  

            }else{

                $message="Unable To Create The Module. Contact Administrator." ;
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'add-course-module');

            }

        }else{

            $this->session->set_flashdata('error',validation_errors());
            redirect(base_url().'add-course-module');

        }

    }



    public function cmodule_update(){
          $cm_id=$this->input->post('cmid') ;
          //Validating the information
          //error messages
          $modnameerrmsg=array(

                            'required'=>'Module Name Cannot Be Empty.',
                            'alpha_numeric_spaces'=>'Module Name Must Contain Only Letters of English Alphabet and Spaces.'

                            ) ;

          $feeerrmsg=array(

                        'required'=>'Module Fee Cannot Be Empty.',
                        'numeric'=>'Module Fee Must Be Numeric.'

                        ) ;

          $descerrmsg=array(
                        'required'=>'Description Cannot Be Empty.'
                        ) ;

          $this->form_validation->set_rules('modulename','Module Name','required|alpha_numeric_spaces|callback_check_module_name_for_update',$modnameerrmsg);
          $this->form_validation->set_rules('modulefee','Module Fee','required|numeric',$feeerrmsg);
          $this->form_validation->set_rules('description','Description','required',$descerrmsg);
        if($this->form_validation->run()){
            $ip=$_SERVER['REMOTE_ADDR']; 
            $module_name=$this->input->post('modulename');
            $module_fee=$this->input->post('modulefee');
            $description=$this->input->post('description');
            $duration=$this->input->post('duration');
            $countTopic=$this->input->post('countTopic');
            //Update Module Info

            $cmustatus=$this->CourseModuleModel->updateCourseModule($cm_id,$module_name,$module_fee,$description,$duration) ;
            if($cmustatus){
                for ($i=1; $i <=$countTopic; $i++) { 
                    $flag=$this->input->post('flag'.$i);
                    $action=$this->input->post('action'.$i);
                    if($action=='insert'){
                        $this->insertToModuleTopic($i,$cm_id);
                    }

                    elseif($action=='update'){
                       $this->updateToModuleTopic($i,$cm_id);
                    }

                    elseif($action=='remove'){
                        $this->removeToModuleTopic($i,$cm_id);
                    }
                }
            }

            if($cmustatus){

                $message="Course Module Information Updated Successfully." ;
                $this->session->set_flashdata('success',$message);
                redirect(base_url().'acoursemodule');  

            }else{

                $message="Unable To Update The Module Info. Contact Administrator." ;
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'acoursemodule');
            }

        }else{

            $this->session->set_flashdata('error',validation_errors());
            redirect(base_url().'coursemodule/edit_cmodule/'.$cm_id);

        }

    }

    public function insertToModuleTopic($i,$cm_id)

    {
        $sequence=$this->input->post('sequence'.$i);
        $topic_name=$this->input->post('topic_name'.$i);
        $this->ModuleTopicModel->insertModuleTopic($cm_id,$sequence,$topic_name);
    }

    public function updateToModuleTopic($i,$cm_id)

    {

        $topic_id=$this->input->post('dbID'.$i);
        $topic_name=$this->input->post('topic_name'.$i);
        $sequence=$this->input->post('sequence'.$i);
        $this->ModuleTopicModel->updateModuleTopic($cm_id,$topic_id,$sequence,$topic_name);

    }

    public function removeToModuleTopic($i,$cm_id)

    {

        $topic_id=$this->input->post('dbID'.$i);
        $this->ModuleTopicModel->removeModuleTopic($topic_id);

    }

    //Callback Function For Validating Module Name
    public function check_module_name_for_update($module_name) {        
        if($this->input->post('cmid')){
            $cm_id = $this->input->post('cmid');
        }
        else{
            $cm_id = '';
        }

        $result = $this->CourseModuleModel->checkUniqueModuleNameForUpdate($cm_id,$module_name);
        if($result == 0){
            $response = true;
        }
        else {

            $this->form_validation->set_message('check_module_name_for_update', 'Module Name Must Be Unique.');

            $response = false;

        }

        return $response;

    }

}