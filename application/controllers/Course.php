<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller {

	public function __construct(){

		parent::__construct();

		error_reporting(0);

		$this->load->helper('utility_helper');

		$this->load->library('form_validation');

		$this->load->model('CourseModel');

		$this->load->model('CourseModuleModel');

		$this->load->model('AppModel');

		$this->load->model('EmployeeModel');

		$this->load->model('SubjectModel');

		$this->load->library('session');

		//$this->load->helper(array('form', 'url'));

		//$this->load->library('form_validation');

		

	}

	public function index(){	

		$this->load->view('admin/course/coursemanage');

	}



	//Function For Course Fee AJAX Output

	public function printCourseFeeById(){

		$course_id=$this->input->post('courseid') ;

		$data=$this->CourseModel->getCourseFeeById($course_id) ;

		if(count($data)>0){

			echo json_encode($data);

		}else{

			$data=array('course_id'=>$course_id,'course_fee'=>0);

			echo json_encode($data);

		}

	}



	public function add_course(){

		$this->load->view('admin/course/addcourse');

	}



	public function edit_course($id){

		$data=$this->CourseModel->getCourseById($id);

		$this->load->view('admin/course/editcourse',$data);

	}





	public function course_submit(){

		  //Validating the information

		  //error messages

		  $ctitleerrmsg=array(

		  					'required'=>'Course Title Cannot Be Empty.',

							'is_unique'=>'Course Title Already Exists. Choose Some Other Title.'

							) ;

		  $this->form_validation->set_rules('coursetitle','Course Title','required|is_unique[courses.course_title]',$ctitleerrmsg);



		if($this->form_validation->run()){

			$course_id=0 ;

			$cs_id=0 ;

			$ip=$_SERVER['REMOTE_ADDR']; 

			$course_title=$this->input->post('coursetitle');

		  	$project_work=$this->input->post('projectwork');

		  	$course_description=$this->input->post('coursedescription');

		  	$subject_id=$this->input->post('subject_id');



		  	//Insert Course

			$course_id=$this->CourseModel->insertCourse($subject_id,$course_title,$project_work,$course_description) ;



			//Updating Course CS_ID

			$cs_id=$this->CourseModel->updateCourseId($course_id) ;

				



			if(($course_id>0)&&is_string($cs_id)){

				$message="Course Created Successfully with Id: ".$cs_id ;

        		$this->session->set_flashdata('success',$message);

        		redirect(base_url().'acourse');  

        	}else{

        		$message="Unable To Create The Course. Contact Administrator." ;

                $this->session->set_flashdata('error',$message);

                redirect(base_url().'add-course');

        	}

		}else{

			$this->session->set_flashdata('error',validation_errors());

            redirect(base_url().'acourse');

		}

	}



	public function course_update(){

	   $course_id=$this->input->post('courseid');

	  //Validating the information

	  //error messages

	  $ctitleerrmsg=array('required'=>'Course Title Cannot Be Empty.') ;

	  $this->form_validation->set_rules('coursetitle','Course Title','required|callback_check_course_title_for_update',$ctitleerrmsg);



	if($this->form_validation->run()){

		$ip=$_SERVER['REMOTE_ADDR']; 

		$course_title=$this->input->post('coursetitle');

	  	$project_work=$this->input->post('projectwork');

	  	$course_description=$this->input->post('coursedescription');

		 $subject_id=$this->input->post('subject_id');



	  	//Update Course Info

		$ustatus=$this->CourseModel->updateCourse($course_id,$subject_id,$course_title,$project_work,$course_description) ;

			



		if($ustatus){

			$message="Course Information Updated Successfully." ;

    		$this->session->set_flashdata('success',$message);

    		redirect(base_url().'acourse');  

    	}else{

    		$message="Unable To Update The Course Info. Contact Administrator." ;

            $this->session->set_flashdata('error',$message);

            redirect(base_url().'acourse');

    	}

	}else{

		$this->session->set_flashdata('error',validation_errors());

        redirect(base_url().'course/edit_course/'.$course_id);

	}

} 



 //Callback Function For Validating Course Title

    public function check_course_title_for_update($course_title) {        

        if($this->input->post('courseid')){

            $course_id = $this->input->post('courseid');

        }else{

            $course_id = '';

        }

        $result = $this->CourseModel->checkUniqueCourseTitleForUpdate($course_id,$course_title);

        if($result == 0){

            $response = true;

        }else {

            $this->form_validation->set_message('check_course_title_for_update', 'Course Title Must Be Unique.');

            $response = false;

        }

        return $response;

    }







    //==================Enable and Disable Course================================



	public function enableDisableCourse($course_id,$status){



	  $ustatus=$this->CourseModel->updateCourseStatus($course_id,$status) ;



	  if($ustatus){ 

	   

	    if($status==1){



	      $this->session->set_flashdata('success', 'Course Enabled Successfully. Course_id : '.$course_id);



	    }else{



	      $this->session->set_flashdata('success', 'Course Disabled Successfully. Course_id : '.$course_id);



	    }



	  }else{



	    if($status==1){



	      $this->session->set_flashdata('error', 'Unable To Enable The Course. Try Later! Course_id : '.$course_id);



	    }else{


	      $this->session->set_flashdata('error', 'Unable To Disable The Course. Try Later! Course_id : '.$course_id);

	    }

	  }

	  redirect(base_url().'acourse');
	}

}