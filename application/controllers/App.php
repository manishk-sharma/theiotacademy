 <?php
  //ob_start();
  defined('BASEPATH') or exit('No direct script access allowed');

  class App extends CI_Controller
  {
    public function __construct()
    {
      parent::__construct();
      //error_reporting(0);
      $this->load->library('session');
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
      $this->load->model('TrainerAboutYouModel');
      $this->load->model('TrainerAccountModel');
      $this->load->model('TrainerAddressModel');
      $this->load->model('TrainerCertificationModel');
      $this->load->model('TrainerDetailsModel');
      $this->load->model('TrainerEducationModel');
      $this->load->model('TrainerExperienceModel');
      $this->load->model('TrainerWhyJoinModel');
    }

    public function index()
    {
      $this->load->view('index');
    }

    public function Error_404()
    {
      //$this->load->view('error404');
      $this->load->helper('url');
      redirect('https://www.theiotacademy.co', 301);
    }

    public function eventtemplate()
    {

      $this->load->view('events/eventtemplate');
    }

    public function our_courses_all()
    {
      $this->load->view('ourcourses-all');
    }

    //-------------------------------------------------------------------------------
    public function login_page()
    {
      $this->load->view('login');
    }

    public function dashboard()
    {
      $this->load->view('admin/dashboard');
    }


    public function do_login()
    {
      $this->form_validation->set_rules('loginemail', 'Email Address', 'required');
      $this->form_validation->set_rules('loginpass', 'Password', 'required');

      if ($this->form_validation->run()) {

        $ip = $_SERVER['REMOTE_ADDR'];
        $email_id = $this->input->post('loginemail');
        $password = $this->input->post('loginpass');
        $opstatus = $this->AppModel->authenticate($email_id, $password, $ip);
        if ($opstatus == 1) {

          $user_type_id = $this->session->userdata("user_type_id");

          if (($user_type_id == 1) || ($user_type_id == 2)) {

            redirect(base_url() . 'adashboard');
          } elseif ($user_type_id == 3) {

            $loginAccess = $this->session->userdata("login_access");

            if (!$loginAccess) {

              redirect(base_url() . 'instructor-reg');
            } else {

              redirect(base_url() . 'adashboard');
            }
          } elseif ($user_type_id == 5) {
            redirect(base_url() . 'show-leads');
          } else {
            redirect(base_url() . 'sign-out');
          }
        } else {

          $this->session->set_flashdata('error', 'Invalid! User Name or Password.');
          redirect(base_url() . 'login');
        }
      } else {

        $this->session->set_flashdata('error', 'User Name or Password Cannot Be Empty.');
        redirect(base_url() . 'login');
      }
    }

    public function logout()
    {
      $this->session->sess_destroy();
      redirect(base_url());
    }

    //-------Functions Linked To Course Menu Routes--------------------------
    public function seeds_funds_program_cnt()
    {
      $this->load->view('seeds_funds_program');
    }

    public function course_java_certification_noida()
    {
      $this->load->view('coursepages/course_java_certification_noida');
    }

    public function dsmliotaddcrt()
    {
      $this->load->view('addpages/ds_ml_iot_add_page');
    }
    public function dsmliotroorkee()
    {
      $this->load->view('addpages/ds_ml_ai_genai_by_eict_iitroorkee');
    }
    // landing page
    public function dsmliotroorkee_landing_page()
    {
      $this->load->view('addpages/ds_ml_ai_genai_by_eict_iitroorkee-landing-page');
    }
    public function thankyou_iitr_10m()
    {
      $this->load->view('addpages/thankyou_iitr_10m');
    }
    //------------------ Thank you page ------------------
    
    public function thankyou_page()
    {
      $brochure_key = $this->input->get('brochure', TRUE) ?: 'dsml';
      $title = $this->input->get('title', TRUE) ?: 'Professional Program In Data Science, Machine Learning, AI & GenAI';
      $type = $this->input->get('type', TRUE) ?: 'Program Brochure';
      $format = $this->input->get('format', TRUE) ?: 'PDF';

      $data = [
        'document_title'   => $title,
        'document_type'    => $type,
        'document_format'  => $format,
        'brochure_key'     => $brochure_key,
        'document_pages'   => 12,
        'download_url'     => site_url('download-brochure?brochure=' . urlencode($brochure_key)),
        'pdf_web_url'      => base_url('assets/pdf/dsml-10months/10_months_new_brochure.pdf'),
      ];

      $this->load->view('thankyou-pages/thankyou_page', $data);
    }

    public function thankyou_brochure_page()
    {
      $brochure_key = $this->input->get('brochure', TRUE) ?: 'dsml';
      $title = $this->input->get('title', TRUE) ?: 'Professional Program In Data Science, Machine Learning, AI & GenAI';
      $type = $this->input->get('type', TRUE) ?: 'Program Brochure';
      $format = $this->input->get('format', TRUE) ?: 'PDF';

      $data = [
        'document_title'   => $title,
        'document_type'    => $type,
        'document_format'  => $format,
        'brochure_key'     => $brochure_key,
        'document_pages'   => 12,
        'download_url'     => site_url('download-brochure?brochure=' . urlencode($brochure_key)),
        'pdf_web_url'      => base_url('assets/pdf/dsml-10months/10_months_new_brochure.pdf'),
      ];

      $this->load->view('thankyou-pages/thankyou_brochure_page', $data);
    }

    public function thankyou_curriculum_page()
    {
      $curriculum_key = $this->input->get('curriculum', TRUE) ?: 'dsml';
      $title = $this->input->get('title', TRUE) ?: 'Professional Program In Data Science, Machine Learning, AI & GenAI';
      $type = $this->input->get('type', TRUE) ?: 'Program Curriculum & Syllabus';
      $format = $this->input->get('format', TRUE) ?: 'PDF';

      $data = [
        'document_title'   => $title,
        'document_type'    => $type,
        'document_format'  => $format,
        'curriculum_key'   => $curriculum_key,
        'document_pages'   => 12,
        'download_url'     => site_url('download-curriculum?curriculum=' . urlencode($curriculum_key)),
        'pdf_web_url'      => base_url('assets/pdf/dsml-10months/10_months_new_curriculum.pdf'),
      ];

      $this->load->view('thankyou-pages/thankyou_curriculum_page', $data);
    }

    public function thankyou_projects_page()
    {
      $project_key = $this->input->get('project', TRUE) ?: 'dsml';
      $title = $this->input->get('title', TRUE) ?: ($this->input->get('project_title', TRUE) ?: 'Projects');
      $type  = $this->input->get('type', TRUE) ?: 'Project List';
      $format = $this->input->get('format', TRUE) ?: 'PDF';
      $track = $this->input->get('track', TRUE) ?: 'Applied AI, Machine Learning & Embedded IoT';
      $name  = $this->input->get('name', TRUE) ?: '';

      $data = [
        'project_key'     => $project_key,
        'project_title'   => $title,
        'document_title'  => $title,
        'document_type'   => $type,
        'document_format' => $format,
        'project_track'   => $track,
        'applicant_name'  => $name,
        'download_url'    => site_url('download-project?project=' . urlencode($project_key)),
        'pdf_web_url'     => base_url('assets/coursesyllabus/ds-ml-and-ai-by-eict-academy-iit-guwahati/dsmlai-project-list-9months.pdf'),
      ];

      $this->load->view('thankyou-pages/thankyou_projects_page', $data);
    }

    public function thankyou_simple_page()
    {
      $heading = $this->input->get('heading', TRUE) ?: 'Thank You for Your Interest!';
      $message = $this->input->get('message', TRUE) ?: '';
      $name    = $this->input->get('name', TRUE) ?: '';

      $data = [
        'page_heading'   => $heading,
        'page_message'   => $message,
        'applicant_name' => $name,
      ];

      $this->load->view('thankyou-pages/thankyou_simple_page', $data);
    }

    public function thank_you_page()
    {
      $this->thankyou_page();
    }

    public function download_brochure()
    {
      $allowed_brochures = [
        'dsml' => [
          'path' => FCPATH . 'assets/pdf/dsml-10months/10_months_new_brochure.pdf',
          'filename' => 'Data_Science_Machine_Learning_AI_GenAI_Brochure.pdf',
        ],
        'ds_iitr' => [
          'path' => FCPATH . 'assets/data-science-program-by-eict-academy-iit-roorkee/brochure.pdf',
          'filename' => 'Data_Science_Program_IIT_Roorkee_Brochure.pdf',
        ],
        'genai' => [
          'path' => FCPATH . 'assets/pdf/genai-6months/Data_Analytics_Generative_AI_Brochure.pdf',
          'filename' => 'Data_Analytics_Generative_AI_Brochure.pdf',
        ],
        'ds_iitg' => [
          'path' => FCPATH . 'assets/coursesyllabus/ds-ml-and-ai-by-eict-academy-iit-guwahati/dsmlai-brochure-9months.pdf',
          'filename' => 'DS_ML_AI_IIT_Guwahati_Brochure.pdf',
        ],
      ];

      $key = $this->input->get('brochure', TRUE) ?: 'dsml';
      if (!isset($allowed_brochures[$key])) {
        show_error('The requested brochure could not be found. Please return to the programs list or contact support.', 404, 'Brochure Not Found');
        return;
      }
      $target = $allowed_brochures[$key];

      $filepath = realpath($target['path']);
      $base_dir = realpath(FCPATH . 'assets');

      if (!$filepath || !file_exists($filepath) || strpos($filepath, $base_dir) !== 0) {
        show_error('The requested brochure file is temporarily unavailable. Please contact support.', 404, 'Brochure File Unavailable');
        return;
      }

      $filename = $target['filename'];
      $filesize = filesize($filepath);

      header('Content-Type: application/pdf');
      header('Content-Disposition: attachment; filename="' . $filename . '"');
      header('Content-Length: ' . $filesize);
      header('Cache-Control: private, max-age=0, must-revalidate');
      header('Pragma: public');
      header('Expires: 0');

      if (ob_get_level()) {
        ob_end_clean();
      }

      readfile($filepath);
      exit;
    }

    public function download_curriculum()
    {
      $allowed_curriculums = [
        'dsml' => [
          'path' => FCPATH . 'assets/pdf/dsml-10months/10_months_new_curriculum.pdf',
          'filename' => 'Data_Science_Machine_Learning_Curriculum_Syllabus.pdf',
        ],
        'genai' => [
          'path' => FCPATH . 'assets/pdf/genai-6months/Data_Analytics_Generative_AI_Curriculum.pdf',
          'filename' => 'Data_Analytics_Generative_AI_Curriculum.pdf',
        ],
        'ds_iitg' => [
          'path' => FCPATH . 'assets/coursesyllabus/ds-ml-and-ai-by-eict-academy-iit-guwahati/dsmlai-curriculum-9months.pdf',
          'filename' => 'DS_ML_AI_IIT_Guwahati_Curriculum.pdf',
        ],
        'embedded' => [
          'path' => FCPATH . 'assets/coursesyllabus/basic-embedded-system-and-iot-iitg/curriculum-of-basic-embedded-system-and-iot-by-eict-academy-iit-guwahati.pdf',
          'filename' => 'Embedded_System_IoT_Curriculum.pdf',
        ],
        'python' => [
          'path' => FCPATH . 'assets/coursesyllabus/machine-learning-with-python-curriculum-list.pdf',
          'filename' => 'ML_with_Python_Curriculum.pdf',
        ],
        'java' => [
          'path' => FCPATH . 'assets/coursesyllabus/full-stack-java-development-by-eict-academy-iitg/curriculum-of-full-stack-java-development.pdf',
          'filename' => 'Full_Stack_Java_Development_Curriculum.pdf',
        ],
      ];

      $key = $this->input->get('curriculum', TRUE) ?: 'dsml';
      if (!isset($allowed_curriculums[$key])) {
        show_error('The requested curriculum could not be found. Please return to the programs list or contact support.', 404, 'Curriculum Not Found');
        return;
      }
      $target = $allowed_curriculums[$key];

      $filepath = realpath($target['path']);
      $base_dir = realpath(FCPATH . 'assets');

      if (!$filepath || !file_exists($filepath) || strpos($filepath, $base_dir) !== 0) {
        show_error('The requested curriculum file is temporarily unavailable. Please contact support.', 404, 'Curriculum File Unavailable');
        return;
      }

      $filename = $target['filename'];
      $filesize = filesize($filepath);

      header('Content-Type: application/pdf');
      header('Content-Disposition: attachment; filename="' . $filename . '"');
      header('Content-Length: ' . $filesize);
      header('Cache-Control: private, max-age=0, must-revalidate');
      header('Pragma: public');
      header('Expires: 0');

      if (ob_get_level()) {
        ob_end_clean();
      }

      readfile($filepath);
      exit;
    }

    public function download_project()
    {
      $allowed_projects = [
        'dsml' => [
          'path' => FCPATH . 'assets/coursesyllabus/ds-ml-and-ai-by-eict-academy-iit-guwahati/dsmlai-project-list-9months.pdf',
          'filename' => 'Data_Science_AI_Capstone_Projects.pdf',
        ],
        'embedded' => [
          'path' => FCPATH . 'assets/coursesyllabus/basic-embedded-system-and-iot-iitg/projects-of-basic-embedded-system-and-iot-by-eict-academy-iit-guwahati.pdf',
          'filename' => 'Embedded_System_IoT_Projects.pdf',
        ],
        'java' => [
          'path' => FCPATH . 'assets/coursesyllabus/full-stack-java-development-by-eict-academy-iitg/project-of-full-stack-java-development.pdf',
          'filename' => 'Full_Stack_Java_Projects.pdf',
        ],
        'edge_ai' => [
          'path' => FCPATH . 'assets/coursesyllabus/ds-ml-and-edge-ai-by-eict-guwahati/projects-of-ds-ml-edge-ai-by-eict-academy-iit-guwahati.pdf',
          'filename' => 'DS_ML_Edge_AI_Projects.pdf',
        ],
      ];

      $key = $this->input->get('project', TRUE) ?: 'dsml';
      if (!isset($allowed_projects[$key])) {
        show_error('The requested project document could not be found. Please return to the programs list or contact support.', 404, 'Project Document Not Found');
        return;
      }
      $target = $allowed_projects[$key];

      $filepath = realpath($target['path']);
      $base_dir = realpath(FCPATH . 'assets');

      if (!$filepath || !file_exists($filepath) || strpos($filepath, $base_dir) !== 0) {
        show_error('The requested project document is temporarily unavailable. Please contact support.', 404, 'Project File Unavailable');
        return;
      }

      $filename = $target['filename'];
      $filesize = filesize($filepath);

      header('Content-Type: application/pdf');
      header('Content-Disposition: attachment; filename="' . $filename . '"');
      header('Content-Length: ' . $filesize);
      header('Cache-Control: private, max-age=0, must-revalidate');
      header('Pragma: public');
      header('Expires: 0');

      if (ob_get_level()) {
        ob_end_clean();
      }

      readfile($filepath);
      exit;
    }
    //------------------ thank you page end ------------------
        
    public function data_analytics_gen_ai_masterclass()
    {
      $this->load->view('addpages/data_analytics_gen_ai_masterclass_page');
    }
    public function data_analytics_gen_ai_masterclass2()
    {
      $this->load->view('addpages/data_analytics_gen_ai_masterclass_page2');
    }
    public function dawithgenai_job_bootcamp_masterclass()
    {
      $this->load->view('addpages/dawithgenai_job_bootcamp_masterclass');
    }
    public function data_analytics_gen_ai_masterclass_registration_successfully()
    {
      $this->load->view('addpages/data_analytics_gen_ai_masterclass_registration_successfully_page');
    }
    // sample dsmliotroorkee sample controller
    public function dsmliotroorkeesample10m()
    {
      $this->load->view('addpages/ds_ml_ai_genai_by_eict_iitroorkee_sample');
    }

    public function dsmliotroorkee6m()
    {
      $this->load->view('addpages/ds_ml_6m_by_eict_iitroorkee');
    }
    public function daaiiitroorkee()
    {
      $this->load->view('addpages/data_analytics_and_gen_ai_by_eict_iit_roorkee');
    }
    public function generative_ai_add_cntrl()
    {
      $this->load->view('addpages/genrative_ai_add_page');
    }
    public function christmas_new_year()
    {
      $this->load->view('christmas_new_year_offer');
    }
    public function industry_visit_test_result()
    {
      $this->load->view('addpages/industrial_visit_test_result');
    }

    public function advanced_gen_ai_controller_fun()
    {
      $this->load->view('advanced_gen_ai');
    }

    public function career_sccelx_programs_controller_fun()
    {
      $this->load->view('career_accelx_programs');
    }
    public function short_term_courrses_page()
    {
      redirect('https://www.theiotacademy.co/summer-training-program-in-noida', 301);
    }
    public function short_term_programs_controller_fun()
    {
      $this->load->view('short-term-programs');
    }

    public function data_analyst_crs_by_iitg_fun()
    {
      $this->load->view('data_analyst_iit_guwahati_course');
    }
    public function Payment_summer_training_fun()
    {
      $this->load->view('summer_training_payment');
    }
    /*===Newly Created Page-Controllers From @26-Dec-2020 Start=========*/

    public function industrial_visit_cntrl()
    {
      $this->load->view('industrial_visit');
    }

    public function web_development_coursec()
    {
      //$this->load->view('coursepages/web_development_certification_course'); 
      redirect('https://theiotacademy.co/', 301);
    }
    public function data_analyst_coursec()
    {
      $this->load->view('coursepages/new_data_analyst_course');
    }
    public function five_six_g_events()
    {
      $this->load->view('5g_6g_talks_events');
    }

    public function linear_regression()
    {
      $this->load->view('machine-learning-pages/linear_regression');
    }

    public function business_statistics()
    {
      $this->load->view('machine-learning-pages/business_statistics');
    }
    public function function_in_machine_learning()
    {
      $this->load->view('machine-learning-pages/function_in_machine_learning');
    }

    public function book_free_demo()
    {
      $this->load->view('book_free_demo');
    }

    public function winter_training()
    {
      $this->load->view('winter_training');
    }

    public function digital_marketing_training()
    {
      $this->load->view('coursepages/digital_marketing_training');
    }

    public function data_science_analytics_machine()
    {
      $this->load->view('data_analytica_ml_generativeai');
    }

    public function python_training()
    {
      $this->load->view('coursepages/custom_course/python_training');
    }

    public function machine_learning_with_python_training()
    {
      $this->load->view('coursepages/custom_course/machine_learning_with_python');
    }

    public function java_development_training()
    {
      $this->load->helper('url');
      redirect('https://www.theiotacademy.co/java-certification-course-in-noida', 301);
    }

    public function embedded_systems_course_cnt()
    {
      $this->load->view('coursepages/custom_course/embedded_system_training_course');
    }

    public function iot_training()
    {
      $this->load->view('coursepages/custom_course/iot_training');
    }
    public function iot_training_noida()
    {
      $this->load->helper('url');
      redirect('https://www.theiotacademy.co/iot-training', 301);
    }
    public function our_placement_students()
    {
      $this->load->view('our_placement_students');
    }
    public function our_placement_student()
    {
      $this->load->view('our_placement_page');
    }
    public function our_placement_student_sample()
    {
      $this->load->view('our_placement_page_new');
    }
    public function data_analyst_and_generative_ai_job_bootcamp()
    {
      $this->load->view('data_analyst_and_generative_ai_job_bootcamp');
    }
    public function welcome_kit_dsml_eictpage()
    {
      $this->load->view('welcome_kit_dsml');
    }
    public function welcome_kit_genai_eictpage()
    {
      $this->load->view('welcome_kit_genai');
    }
    public function welcome_kit_eictpage()
    {
      $this->load->view('welcome_kit');
    }
    public function new_home_page_fun()
    {
      $this->load->view('new_home_page');
    }

    public function data_analyst_certification_course_fun()
    {
      $this->load->view('data_analyst_certification_course');
    }

    public function data_analyst_gen_ai_certification_course_fun()
    {
      $this->load->view('data_analyst_gen_ai_certification_course');
    }

    public function data_analyst_with_ai_certification_course_fun()
    {
      $this->load->view('data_analyst_with_ai_certification_course');
    }

    public function digital_marketing_training_fun()
    {
      $this->load->view('digital_marketing_training');
    }

    public function embedded_systems_with_ai_fun()
    {
      $this->load->view('embedded_systems_with_ai');
    }
    public function embedded_iot_sample()
    {
      $this->load->view('embedded-iot-sample');
    }

    public function embedded_systems_basic_fun()
    {
      $this->load->view('embedded_systems_basic');
    }

    /*===Newly Created Page-Controllers End ======*/


    //-------Functions Linked To Our Offerings Links--------------


    public function instructors()
    {
      //$this->load->view('instructors'); 
      redirect('https://www.theiotacademy.co', 301);
    }

    public function instructor_reg()
    {
      $this->load->view('trainers/index2');
    }

    //--------------------function for Events---------------------
    public function events()
    {

      $this->load->view('events');
    }


    //-------Functions Linked To Blog Links--------------

    //--------------------------------------------------

    public function summer_training()
    {

      $this->load->view('summer_training');
    }
    public function industrial_training_program()
    {

      $this->load->view('industrial_training_program_new');
    }

    public function new_about_us()
    {

      $this->load->view('new-about-us');
    }


    public function contact_us()
    {
      $this->load->view('contact_us');
    }

    public function terms_and_conditions()
    {

      $this->load->view('termandconditions');
    }

    public function refundpolicies()
    {

      $this->load->view('refundpolicies');
    }

    public function privacyandpolicies()
    {

      $this->load->view('privacyandpolicies');
    }

    public function disclaimer()
    {

      $this->load->view('disclaimer');
    }

    // salary prediction
    public function salary_prediction()
    {
      $this->load->view('salarypredictor');
    }
    public function predictor_admin_dashboard()
    {
      $this->load->view('salarypredictoradmin');
    }
    public function data_analytics_visualization_business()
    {
      $this->load->view('coursepages/data_analytics_data_visualization_business');
    }

    public function onepps_index()
    {
      $this->load->view('NewPages/1PPS');
    }
  } ?>