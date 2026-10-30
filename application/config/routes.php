<?php
date_default_timezone_set('Asia/Kolkata');
defined('BASEPATH') or exit('No direct script access allowed');

/*  
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing'; 
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'App';

$route['404_override'] = 'App/Error_404';

$route['translate_uri_dashes'] = FALSE;

$route['about-us'] = "App/new_about_us";

$route['term-and-condition'] = "App/terms_and_conditions";
$route['refund-policies'] = "App/refundpolicies";
$route['disclaimer'] = "App/disclaimer";
$route['privacy-policies'] = "App/privacyandpolicies";

/*===Newly Created Page-routes @26-Dec-2020 Start========*/
$route['startup-seed-fund-program'] = "App/seeds_funds_program_cnt";
$route['industrial-visit'] = "App/industrial_visit_cntrl";
$route['advanced-gen-ai-course'] = "App/advanced_gen_ai_controller_fun";
$route['advanced-generative-ai-certification-course'] = "App/generative_ai_add_cntrl";
$route['industrial-summer-training-programs'] = "App/industrial_training_program";
$route['advanced-generative-ai-course'] = "AppliedMachineLearningWithIotByiig/advanced_generative_ai_course";
$route['advanced-generative-ai-course/apply-now'] = "Mlwithiotregistration/advanced_generative_ai_registration";
$route['advanced-certification-in-data-science-machine-learning-and-ai-by-eict-iitg'] = "AppliedMachineLearningWithIotByiig/advanced_9m_ds_ml_ai";
// Roorkee
$route['advanced-certification-in-data-science-machine-learning-ai-and-genai-by-eict-iitroorkee'] = "AppliedMachineLearningWithIotByiig/roorkee_ds_ml_9m_iot_certification";
$route['demo-of-online-ds-ml-and-edge-ai-iitg'] = "AppliedMachineLearningWithIotByiig/demo_online_ds_ml_edgeai";
$route['ds-ml-iot-by-iit-guwahati'] = "App/dsmliotaddcrt";
$route['ds-ml-ai-genai-by-eict-iitroorkee'] = "App/dsmliotroorkee";
// landing-page
$route['iitroorkee-ds-ai-program'] = "App/dsmliotroorkee_landing_page";
$route['thankyou-iitr-10m'] = "App/thankyou_iitr_10m";

// Dedicated Reusable Thank-You Pages
$route['thankyou-page'] = "App/thankyou_page";
$route['thank-you'] = "App/thankyou_page";

$route['thankyou-brochure'] = "App/thankyou_brochure_page";
$route['brochure-thank-you'] = "App/thankyou_brochure_page";
$route['download-brochure'] = "App/download_brochure";

$route['thankyou-curriculum'] = "App/thankyou_curriculum_page";
$route['curriculum-thank-you'] = "App/thankyou_curriculum_page";
$route['download-curriculum'] = "App/download_curriculum";

$route['thankyou-projects'] = "App/thankyou_projects_page";
$route['projects-thank-you'] = "App/thankyou_projects_page";
$route['download-project'] = "App/download_project";

$route['thankyou-simple'] = "App/thankyou_simple_page";
$route['simple-thank-you'] = "App/thankyou_simple_page";

// data analytics and gen ai masterclass
$route['data-analytics-gen-ai-masterclass'] = "App/data_analytics_gen_ai_masterclass";
$route['data-analytics-gen-ai-masterclass-registration-successfully'] = "App/data_analytics_gen_ai_masterclass_registration_successfully";
//masterclass page 

$route['da-genai-masterclass'] = "App/data_analytics_gen_ai_masterclass2";
$route['dawithgenai-job-bootcamp-masterclass'] = "App/dawithgenai_job_bootcamp_masterclass";


// sample dsml page 10 months page
$route['ds-ml-ai-10months-sample'] = "App/dsmliotroorkeesample10m";

$route['ds-ml-by-eict-iitroorkee'] = "App/dsmliotroorkee6m";
$route['data-analytics-and-gen-ai-by-eict-iit-roorkee'] = "App/daaiiitroorkee";
$route['professional-data-analytics-program-by-iitg/apply-now'] = "Mlwithiotregistration/data_analytics_crn_iitg_registration";
$route['professional-data-analytics-program-by-iitg'] = "AppliedMachineLearningWithIotByiig/professional_data_analytics_crs_by_iitg";
$route['advanced-generative-ai-leadership-program-by-eict-academy-iitroorkee'] = "AppliedMachineLearningWithIotByiig/advanced_generative_ai_course_iitr";

$route['5G-6G-Talks'] = "App/five_six_g_events";
$route['full-stack-web-development-course'] = "App/web_development_coursec";

$route['advanced-certification-program-in-full-stack-java-development-by-eict-academy-iit-guwahati'] = "AdvancedFullstackJavaIITGuwahati/advanced_fullstack_java_by_eict_iitg";
$route['advanced-certification-program-in-full-stack-java-development-by-eict-academy-iit-guwahati/apply-now'] = "Mlwithiotregistration/full_stack_java_development_by_eict_iitg_registration";
$route['online-certification-in-basic-embedded-system-and-iot-by-eict-academy-iit-guwahati'] = "AppliedMachineLearningWithIotByiig/online_certification_in_basic_embedded_system_and_iot_by_eict_academy_iit_guwahati";

$route['online-certification-in-basic-embedded-system-and-iot-by-eict-academy-iit-guwahati/apply-now'] = "Mlwithiotregistration/basic_embedded_system_and_iot_by_eict_iitg_registration";

$route['online-certification-in-iot-cloud-computing-and-edge-ai-by-eict-academy-iit-guwahati'] = "AppliedMachineLearningWithIotByiig/online_certification_in_iot_cloud_computing_and_edge_ai_by_eict_academy_iit_guwahati";

$route['online-certification-in-iot-cloud-computing-and-edge-ai-by-eict-academy-iit-guwahati/apply-now'] = "IoTCloudComputingandEdgeAIregistration/iot_cloud_computing_and_edge_ai_by_eict_iitg_registration";

// $route['online-certification-in-applied-data-science-machine-learning-edge-ai-by-eict-academy-iit-guwahati'] = "AppliedMachineLearningWithIotByiig/online_data_science_machine_learning_and_edge_ai_with_python_by_eict_iit_guwahati";
// $route['online-certification-in-applied-data-science-machine-learning-edge-ai-by-eict-academy-iit-guwahati/apply-now'] = 'Mlwithiotregistration/ds_ml_and_edge_ai_by_eict_iitg_registration';
$route['certification-in-data-science-and-machine-learning-with-python-in-africa'] = "CertificationDSMLwithPythonInternational/certification_in_ds_and_ml_with_python_in_africa";
$route['certification-in-data-science-and-machine-learning-with-python-in-middle-east'] = "CertificationDSMLwithPythonInternational/certification_in_ds_and_ml_with_python_in_middle_east";
$route['applied-data-science-with-python-certification-program'] = 'AppliedDataScienceCertification/data_science_and_ai_new_page';
$route['advanced-certification-in-data-science-machine-learning-and-iot-by-eict-iitg'] = 'AppliedMachineLearningWithIotByiig/machine_learning_with_iot_by_eict_iitg';

$route['advanced-certification-in-data-science-and-machine-learning-in-africa'] = 'AppliedMachineLearningWithIotByiig/datascience_and_machine_learning_in_africa';

$route['advanced-certification-in-data-science-machine-learning-and-iot-in-middle-east'] = 'AppliedMachineLearningWithIotByiig/datascience_machine_learning_and_iot_in_middle_east';

$route['advanced-certification-in-data-science-machine-learning-and-ai-by-eict-iitg/apply-now'] = 'Mlwithiotregistration/ds_ml_and_ai_9m_by_eict_iitg_registration';
$route['advanced-certification-in-data-science-machine-learning-and-ai-by-eict-iitr/apply-now'] = 'Mlwithiotregistration/ds_ml_and_ai_9m_by_eict_iitr_registration';
$route['advanced-certification-in-data-science-machine-learning-6m-by-eict-iitr/apply-now'] = 'Mlwithiotregistration/ds_ml_6m_by_eict_iitr_registration';

// New 3 forms

$route['ai-powered-embedded-and-iot-program/apply-now'] = 'Mlwithiotregistration/ai_powered_embedded_and_iot_program_registration';
$route['data-analyst-with-genai-and-agenticai-course/apply-now'] = 'Mlwithiotregistration/da_with_genai_registration';
$route['data-analytics-and-gen-ai-by-eict-iit-roorkee/apply-now'] = 'Mlwithiotregistration/data_analytics_and_gen_ai_by_eict_iitr_registration';

// $route['advanced-certification-in-embedded-systems-and-iot-by-eict-iitg']='AppliedEmbeddedSystemsAndIotByiig/embedded_systems_and_iot_by_eict_iitg';
// $route['advanced-certification-in-embedded-systems-and-iot-by-eict-iitg/apply-now']='Embeddedandiotregistration/embedded_and_iot_by_eict_iitg_registration';


$route['careers'] = "JobUploadController/jobs_seeing_user";
$route['winter-training'] = "App/winter_training";
// $route['digital-marketing-training'] = "App/digital_marketing_training";
$route['python-training'] = "App/python_training";
$route['java-development-training'] = "App/java_development_training";
$route['embedded-systems-training'] = "App/embedded_systems_course_cnt";
// $route['iot-training'] = "App/iot_training";
$route['our-placement-students'] = "App/our_placement_students";
$route['our-placements'] = "App/our_placement_student";
$route['our-placements-sample'] = "App/our_placement_student_sample";
$route['book-free-demo'] = "App/book_free_demo";
$route['upskill-campus-download-offer-letter'] = "Offerletterspdf/user_download_offer_letter";
// $route['data-analyst-certification-course'] = "App/data_analyst_coursec";
$route['data-analyst-certification-course'] = 'App/data_analytics_visualization_business';
$route['iot-training-in-noida'] = "App/iot_training_noida";
$route['embedded-systems-training-in-noida'] = "App/embedded_systems_training";
$route['machine-learning-with-python-training-in-noida'] = "App/machine_learning_with_python_training";
$route['data-analytics-machine-learning-ai-course'] = "App/data_science_analytics_machine";
$route['data-analytics-machine-learning-ai-course/apply-now'] = "Mlwithiotregistration/da_ml_generative_ai_registration";
$route['christmas-new-year-offer'] = "App/christmas_new_year";
$route['industrial-visit-test-result'] = "App/industry_visit_test_result";
$route['hire-from-us'] = "Hire_From_Us_Controller/hire_from_us_cnt_fun";

// Ml Pages
$route['linear-regression'] = "App/linear_regression";
$route['business-statistics'] = "App/business_statistics";
$route['function-in-machine-learning'] = "App/function_in_machine_learning";

// $route['summer-training-program-in-noida'] = "App/career_sccelx_programs_controller_fun";
$route['short-term-courses'] = "App/short_term_courrses_page";
$route['short-term-programs'] = "App/short_term_programs_controller_fun";
$route['welcome-kit'] = "App/welcome_kit_eictpage";
$route['welcome-kit-dsml'] = "App/welcome_kit_dsml_eictpage";
$route['welcome-kit-da-genai'] = "App/welcome_kit_genai_eictpage";
$route['data-analyst-iit-guwahati-course'] = "App/data_analyst_crs_by_iitg_fun";
$route['data-analyst-iit-guwahati-course/apply-now'] = "Mlwithiotregistration/data_analyst_iitg_coursefun_registration";
$route['payment'] = "App/Payment_summer_training_fun";
/*===Newly Created Page-routes @26-Dec-2020 End ======*/

$route['data-analyst-certification-course-demo'] = "App/data_analyst_certification_course_fun";
// $route['data-analyst-certification-course-with-ai-demo'] = "App/data_analyst_gen_ai_certification_course_fun";
// $route['data-analyst-with-genai-and-agenticai-course'] = "App/data_analyst_gen_ai_certification_course_fun";
$route['data-analyst-with-genai-and-agenticai-course'] = "App/data_analyst_with_ai_certification_course_fun";
// $route['da-ai-sample'] = "App/data_analyst_with_ai_certification_course_fun";
$route['digital-marketing-training'] = "App/digital_marketing_training_fun";
/*$route['embedded-systems-training-with-ai'] = "App/embedded_systems_with_ai_fun";*/
// $route['embedded-iot-sample'] = "App/embedded_iot_sample";
$route['embedded-systems-training-with-ai'] = "App/embedded_iot_sample";
$route['embedded-systems-basic'] = "App/embedded_systems_basic_fun";

$route['java-certification-course-in-noida'] = "App/course_java_certification_noida";
$route['summer-training'] = "App/summer_training";
$route['instructors-apply'] = "App/instructors";
$route['contact'] = "App/contact_us";
$route['all-courses'] = "App/our_courses_all";
// $route['our-courses']="AddAllCourses/our_courses" ;
//----------------Login And Admin -----------------------
$route['show-leads'] = "LiveLead/get_leads";
$route['application-details-leads'] = "LiveLead/application_details_leads";
$route['job-apply-details'] = "LiveLead/applied_job_applicant_details";
$route['download-csv-leads'] = "LiveLead/downloadCSVlead";
$route['admin-create-plan-login'] = "Admincreateplan/createplanloginview";
$route['admin-create-plan'] = "Admincreateplan/admincreateplanview";
$route['admin-create-plan-details'] = "Admincreateplan/admincreateplandetails";
$route['admin-create-plan-logout'] = "Admincreateplan/logout";
$route['login'] = 'App/login_page';
$route['forgot-password'] = 'User/forgotPassword';
$route['sign-out'] = 'App/logout';
$route['adashboard'] = 'App/dashboard';
$route['upload-job'] = 'JobUploadController/add_job_page';
//------For Users----------------------------
$route['auserportal'] = 'User';

//------For Enquiry--------------------------
$route['aenquiry'] = 'Enquiry';
$route['add-enquiry'] = 'Enquiry/add_enquiry';
$route['submit-enquiry'] = 'Enquiry/enquiry_submit';
$route['update-enquiry'] = 'Enquiry/enquiry_update';
$route['export-enquiry-list-excel'] = 'Enquiry/exportExcelEnquiryList';
//-------------------------------------------------

//------For Enquiry Follow Up--------------------------
$route['aenquiryfollowup'] = 'EnquiryFollowUp';
$route['submit-enquiry-followup'] = 'EnquiryFollowUp/enquiry_followup_submit';
$route['update-enquiry-followup'] = 'EnquiryFollowUp/enquiry_followup_update';
//-------------------------------------------------
//=======route for add all courses=========
$route['all-instructors-course'] = "AddAllCourses/show_all_ins_course";
$route['add-instructor-course'] = "AddAllCourses/add_all_ins_course";
//------For Students--------------------------
$route['astudent'] = 'Student';
$route['update-student'] = 'Student/student_update';
//-------------------------------------------------

//------For Registration--------------------------
$route['aregistration'] = 'Register';
$route['register-now'] = 'Register/addNewRegistration';
$route['register-existing'] = 'Register/newRegisterForExistingStudent';
$route['register-update'] = 'Register/updateRegistration';
$route['get-balance-fee-by-reg-id-ajax'] = 'Register/printBalanceFeeByRegId';
//-------------------------------------------------

//----------For assignment---------------------
$route['assignment-register'] = 'UserController/register_create';
$route['assignment-register-submit'] = 'UserController/register_submit';
$route['assignment-login'] = 'UserController/login_create';
$route['assignment-logout'] = 'UserController/logout';
$route['assignment-submit'] = 'UserController/submit_login';
$route['assignment-dashboard'] = 'UserController/dashboard';
$route['assignment-user-update-submit'] = 'UserController/user_update_profile';
$route['upload-assignment-submit'] = 'assignments/UploadAssignment/upload_assignment_submit';
$route['all-assignment-content'] = 'assignments/UploadAssignment/AllAssignmentpdf';
$route['all-assignment-content-update'] = 'assignments/UploadAssignment/UpdateAllAssignmentcontent';
$route['assignment-admin-dashboard'] = 'UserController/admin_dashboard';
$route['add-news-and-update'] = 'UploadNewsUpdate/add_new_update_page';
$route['assignment-forgot-password'] = 'UserController/assign_forgot_password';
$route['assignment-user-fd-submit'] = 'assignments/UploadAssignment/assignment_user_feedback';
$route['upload-mini-project-submit'] = 'assignments/UploadAssignment/user_upload_mini_project';
$route['assignment-all-feedback'] = 'AssignmentAllUserAdmin/assign_admin_all_feedback';
$route['project-all-details'] = 'AssignmentAllUserAdmin/admin_all_project_details';
$route['download-result-batch-wise'] = 'AssignmentAllUserAdmin/download_result_batch_wise_view';
$route['assigment-update-marks-manual'] = 'AssignmentAllUserAdmin/view_update_marks';

//   ------------------- for assigment performance---------------
$route['admin-assignment-attendance'] = 'Assignment_Student_Performance/attendance_admin_show';
$route['attendance-csv-report-import'] = 'Assignment_Student_Performance/attendance_import';
$route['assignment-admin-csv-live-test'] = 'Assignment_live_test_asignment_report/assignment_admin_live_show';
$route['assignment-admin-csv-live-test-import'] = 'Assignment_live_test_asignment_report/live_assignment_csv_import';
$route['assignment-project-admin-report-show'] = 'Assignment_Student_Project_Report/assignment_project_report_admin_show';
$route['assignment-project-admin-report-import'] = 'Assignment_Student_Project_Report/assignment_project_report_import_fun';
$route['user-attendance-report'] = 'Assignment_User_Performance_Report/assignment_user_attendace_report_show';
$route['user-assignment-mini-live-report'] = 'Assignment_User_Performance_Report/assignment_user_live_test_report_show';
$route['user-upload-project-report'] = 'Assignment_User_Performance_Report/assignment_user_project_report_show';

//----------For Courses---------------------
$route['acourse'] = 'Course';
$route['add-course'] = 'Course/add_course';
$route['submit-course'] = 'Course/course_submit';
$route['update-course'] = 'Course/course_update';
$route['get-course-fee-ajax'] = 'Course/printCourseFeeById';
//------------------------------------------

//----------For Course Modules---------------------
$route['acoursemodule'] = 'CourseModule';
$route['add-course-module'] = 'CourseModule/add_cmodule';
$route['submit-course-module'] = 'CourseModule/cmodule_submit';
$route['update-course-module'] = 'CourseModule/cmodule_update';
//Adding Course Modules To Batch
$route['submit-course-module-to-batch'] = 'CourseModule/submit_cmodule_to_batch';

$route['get-courseModuleHours-by-ajax'] = 'CourseModule/getAllModuleHourBycourse_id';

//------------------------------------------

//Subject Details--------------------------
$route['asubject'] = 'Subject'; //manage page

$route['add-subject'] = 'Subject/add_subject'; //add page

$route['edit-subject'] = 'Subject/edit_subject'; //edit page

$route['submit-subject'] = 'Subject/subject_submit'; //submit form 
$route['update-subject'] = 'Subject/update_subject'; //update form


//---------For Employees---------------------------
$route['aemployee'] = 'Employee';
$route['add-employee'] = 'Employee/add_employee';
$route['submit-employee'] = 'Employee/employee_submit';
$route['update-employee'] = 'Employee/employee_update';
//-------------------------------------------------

//----------For Designations-----------------------
$route['adesignation'] = 'Designation';
$route['submit-designation'] = 'Designation/designation_submit';
$route['update-designation'] = 'Designation/designation_update';
$route['get-desig-list-by-user-type-ajax'] = 'Designation/printDesigListByUserTypeId';
//-------------------------------------------------

//---------For Payments---------------------------
$route['apayment'] = 'Payment';
$route['add-payment'] = 'Payment/add_payment';
$route['submit-payment'] = 'Payment/payment_submit';
//$route['payment-receipt']='Payment/payment_receipt' ;
//-------------------------------------------------

//----------For Batches---------------------
$route['abatch'] = 'Batch';
$route['add-batch'] = 'Batch/add_batch';
$route['submit-batch'] = 'Batch/batch_submit';
$route['update-batch'] = 'Batch/batch_update';
//Adding Students To Batch
$route['submit-students-to-batch'] = 'Batch/student_lot_submit';
//------------------------------------------

//---------For Company----------------------
$route['acompany'] = 'Company';
$route['add-company'] = 'Company/add_company';
$route['submit-company'] = 'Company/company_submit';
$route['update-company'] = 'Company/company_update';
//------------------------------------------

//---------For ClassRoom----------------------
$route['aclassroom'] = 'Classroom';
$route['submit-classroom'] = 'Classroom/classroom_submit';
$route['update-classroom'] = 'Classroom/classroom_update';
//------------------------------------------

//---------For Enquiry Source----------------------
$route['aenquirysource'] = 'EnquirySource';
$route['submit-enquiry-source'] = 'EnquirySource/enquirysource_submit';
$route['update-enquiry-source'] = 'EnquirySource/enquirysource_update';
//------------------------------------------



//-----------------PAYTM PAYMENT-------------
// $route['payment']='Paytm/start_payment';
$route['redirec_url'] = 'Paytm/redirect_page';
$route['resopnse'] = 'Paytm/response_url';
#$route['refund_url']='' /Set if need refund url/
//-------------------------------------


//----------For Events----------------------- 
$route['events'] = "App/events"; //public page
$route['aevent'] = 'Event/event_list';
$route['add-event'] = 'Event/add_event';
$route['submit-event'] = 'Event/event_submit';
$route['update-event'] = 'Event/event_update';
$route['get-event-data-by-ajax'] = 'Event/printEventListByEventId';

$route['get-event-date-data-by-event-ajax'] = 'Event/printEventDaysListByEventId';

$route['get-active-speaker-list-by-type-ajax'] = 'Event/printActiveEventSpeakerListByType';

//for event guest speaker----------------------- 
$route['aspeaker'] = 'EventGuestSpeaker';
$route['add-speaker'] = 'EventGuestSpeaker/add_guest_speaker';
$route['submit-speaker'] = 'EventGuestSpeaker/speaker_submit';
$route['update-speaker'] = 'EventGuestSpeaker/update_speaker';

//for event schedule-------------------
$route['submit-schedule'] = 'EventSchedule/schedule_submit';
$route['update-schedule'] = 'EventSchedule/schedule_update';

//-------------for event type----------------
$route['aeventtype'] = 'EventType';

//------------------for Event loaction --------------
$route['alocation'] = 'Location';

//-----------------Events View--------------------------------
$route['event-template'] = 'App/eventtemplate';
$route['event-regstration'] = 'EventRegistration/event_register';
$route['event-batch-reg'] = 'EventBatchRegistration/reg_event_page';
$route['otp-url'] = 'GenerateOtp/otp_auth';
//-------------------------------------------------------------
//-----------------------------------------
//------------Discount Admin ----------------
$route['adiscount'] = 'Discount/index';
$route['discount-add'] = 'Discount/discount_add';
$route['discount-update'] = 'Discount/discount_update';

$route['get-batch-event-list-by-ajax'] = 'Discount/print_batch_event_list';

$route['work-from-home-internship-on-live-projects'] = 'Industrialinternship/internship';
$route['aemail'] = 'EmailSetup';
$route['addCSVmail'] = 'EmailSetup/csvMsgFile';
$route['upload_img'] = 'EmailSetup/upload_ckeditor_img';
$route['mail-send'] = 'EmailSetup/sendMail';
$route['instructor-reg'] = 'App/instructor_reg';
$route['TechSavvy-2020'] = 'TechSavvy';


//==============For Certificate=====================

$route['store'] = 'AdminController/store';
$route['add'] = 'AdminController/add_text';
$route['home'] = 'Members/index';
$route['import'] = 'Members/import';
$route['result'] = 'AdminController/view_result';
$route['font_style'] = 'AdminController/fetch_fontstyle';
$route['test'] = 'AdminController/test';
$route['theme'] = 'AdminController/apply_theme';
$route['search'] = 'Members/fetch_searched_data';
$route['send'] = 'MailController/send_certificate';
$route['zip'] = 'Zip/index';
$route['createzip'] = 'Zip/createzip';
$route['imgtopdf'] = 'PdfConverter/index';
$route['dltdata'] = 'AdminController/deleteTable';
$route['createFolder'] = 'PdfConverter/create_pdf_folder';
$route['viewPdf'] = 'PdfConverter/view_in_pdf';
$route['pdfresult'] = 'PdfConverter/pdf_result_by_id';
$route['sendmail_test'] = 'MailSystem/send_certificate';

//================offer letter==============
$route['offer-store'] = 'AdminOfferController/store';
$route['offer-add'] = 'AdminOfferController/add_text';
$route['offer-home'] = 'Offerletters/index';
$route['offer-import'] = 'Offerletters/import';
$route['offer-result'] = 'AdminOfferController/view_result';
$route['offer-send'] = 'MailOfferletterController/send_offerletter';
$route['offer-font_style'] = 'AdminOfferController/fetch_fontstyle';
$route['offer-test'] = 'AdminOfferController/test';
$route['offer-theme'] = 'AdminOfferController/apply_theme';
$route['offer-search'] = 'AdminOfferController/fetch_searched_data';
$route['offer-dltdata'] = 'AdminOfferController/deleteTable';
// ==============end offer letter===========
//==========offer letter in pdf str==========
$route['offer-pdf-store'] = 'Offerletterspdf/store';
$route['offer-pdf-home'] = 'Offerletterspdf/index';
$route['offer-pdf-import'] = 'Offerletterspdf/import';
$route['offer-pdf-result'] = 'Offerletterspdf/view_result';
$route['pdf-offer-send'] = 'MailOfferletterinpdf/send_offerletter';
//=============end offer letter in pdf==============
//===========start certificate in pdf =============
$route['certificate-pdf-store'] = 'Certificatepdf/store';
$route['certificate-pdf-home'] = 'Certificatepdf/index';
$route['certificate-pdf-import'] = 'Certificatepdf/import';
$route['certificate-pdf-result'] = 'Certificatepdf/view_result';
$route['pdf-certificate-send'] = 'MailCertificateinpdf/send_certificate';
$route['UpSkill-Campus-verify-certificate'] = 'Certificatepdf/verify_certificate';
$route['verify-certificate'] = 'Certificatepdf/iotoff_certificate_verify';
$route['add-details-for-verify-certificate'] = 'Certificatepdf/add_details_for_verify_certificate';
$route['certificate-scan-verify'] = 'Certificatepdf/scan_verify';
$route['certificate-scan-verify/(:any)'] = 'Certificatepdf/scan_verify/$1';
$route['certificate-token-data'] = 'Certificatepdf/get_certificate_by_token';

//============new certifcate in pdf route========================
$route['new_certificate-pdf-home'] = 'Certificatepdf/new_index';
$route['new_certificate-pdf-import'] = 'Certificatepdf/new_import';

$route['new_certificate-pdf-result'] = 'Certificatepdf/new_view_result';
$route['new-pdf-certificate-send'] = 'MailCertificateinpdf/new_send_certificate';
//============end certificate in pdf=============
//webinar certificate pdf
$route['webinar-pdf-store'] = 'WebinarController/store';
$route['webinar-pdf-home'] = 'WebinarController/index';
$route['webinar-pdf-import'] = 'WebinarController/import';
$route['webinar-pdf-result'] = 'WebinarController/view_result';
$route['pdf-webinar-send'] = 'MailWebinarpdf/send_certificate';
//webinar certificate pdf end
//workshop certificate pdf
$route['workshop-pdf-store'] = 'WorkshopCertificateController/store';
$route['workshop-pdf-home'] = 'WorkshopCertificateController/index';
$route['workshop-pdf-import'] = 'WorkshopCertificateController/import';
$route['workshop-pdf-result'] = 'WorkshopCertificateController/view_result';
$route['pdf-workshop-send'] = 'MailWorkshopCertificate/send_certificate';
//workshop certificate pdf end
//industrial visit certificate pdf
$route['user-industrial-visit-store'] = 'IndustrialVisitCertificate/store';
$route['industrial-user-certificate-home'] = 'IndustrialVisitCertificate/index';
$route['industrial-user-certificate-import'] = 'IndustrialVisitCertificate/import';
$route['industrial-user-certificate-result'] = 'IndustrialVisitCertificate/view_result';
$route['industrial-user-certificate-send'] = 'MailindustrialCertificate/send_certificate';
//industrial visit certificate pdf end
//industrial visit certificate pdf
$route['admin-industrial-visit-store'] = 'IndustrialVisitAdminCertificate/store';
$route['industrial-admin-certificate-home'] = 'IndustrialVisitAdminCertificate/index';
$route['industrial-admin-certificate-import'] = 'IndustrialVisitAdminCertificate/import';
$route['industrial-admin-certificate-result'] = 'IndustrialVisitAdminCertificate/view_result';
$route['industrial-admin-certificate-send'] = 'MailAdminIndustrialVisitCertificate/send_certificate';

$route['event/free-awareness-program-in-iot-and-edge-ai-by-eict-academy-iit-guwahati'] = 'Event/event_61';
$route['event/free-awareness-program-in-iot-and-edge-ai-by-eict-academy-iit-guwahati'] = 'Event/event_62';
$route['event/free-awareness-session-on-iot-and-edge-ai-by-eict-academy-iit-guwahati'] = 'Event/event_63';
$route['event/free-awareness-session-on-data-science-machine-learning-and-iot-by-eict-iitg'] = 'Event/event_64';
$route['event/free-webinar-on-machine-learning-trends-career-and-job-opportunities-by-the-iot-academy'] = 'Event/event_65';
$route['event/free-webinar-iot-edge-ai-its-application'] = 'Event/event_66';
$route['event/free-awareness-session-on-anudaksh-training-cum-internship-programs'] = 'Event/event_67';
$route['event/free-awareness-session-on-anudaksh-training-cum-internship-programs-on-5-june'] = 'Event/event_68';
$route['event/free-webinar-on-how-smart-home-works-using-google-firebase'] = 'Event/event_69';
$route['event/free-webinar-on-image-classification-using-edge-impulse'] = 'Event/event_70';
$route['event/free-webinar-on-learn-how-smart-home-works-using-google-firebase'] = 'Event/event_71';
$route['event/free-webinar-on-predictive-maintenance-using-edge-impulse'] = 'Event/event_72';
$route['event/digital-transformation-for-smart-industry'] = 'Event/event_73';

// salary prediction
$route['salary-predictor'] = 'App/salary_prediction';
$route['salary-predictor-dashboard'] = 'App/predictor_admin_dashboard';
// $route['data-analytics-data-visualization-business'] = 'App/data_analytics_visualization_business';

//open ai chat box
$route['api/aichatbox'] = 'AIChatbox/index';

//new pages
$route['1pps'] = 'App/onepps_index';

// IIT Jodhpur start
$route['da-with-genai-job-bootcamp'] = "App/data_analyst_and_generative_ai_job_bootcamp";


//MASTER CLASS PAGES 

// Masterclass Settings Page
$route['masterclass-settings'] = 'Masterclass_settings/index';

// Fetch current masterclass date
$route['api/masterclass/date']['GET'] = 'Masterclass_settings/get_date';

// Update masterclass date
$route['api/masterclass/update-date']['POST'] = 'Masterclass_settings/update_date';
$route['masterclass-settings/login']['POST'] =
    'Masterclass_settings/login';

    $route['masterclass-settings/logout']['post'] =
    'Masterclass_settings/logout';

// Thank You Page 
$route['thank-you'] = 'App/thankyou_page';
