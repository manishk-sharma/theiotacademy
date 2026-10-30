<?php 
defined('BASEPATH') OR exit('No direct script access allowed');  

class AssignmentAllUserAdmin extends CI_Controller{

	public function __construct(){ 
	 parent::__construct();
	 $this->load->library('session');
	$this->load->helper('utility_helper');
	$this->load->library('form_validation');
	$this->load->model(['CheckAssignmentModel']);
	$this->load->library('email'); 
	$this->load->library('pagination');
}

public function download($id)
{
    $this->load->helper('download');
    $this->load->model('CheckAssignmentModel');

    $file = $this->CheckAssignmentModel->get_assignment_file($id);

    if ($file) {
        $file_path = $file->path;

        // get extension from file path (pdf, ipynb, docx, etc.)
        $extension = pathinfo($file_path, PATHINFO_EXTENSION);

        // sanitize username & title for safe filenames
        $username = preg_replace('/[^A-Za-z0-9_\-]/', '_', $file->username);
        $title    = preg_replace('/[^A-Za-z0-9_\-]/', '_', $file->title);

        $filename = $username . '_' . $title . '.' . $extension;

        // Case 1: relative path in local folder
        if (file_exists(FCPATH . $file_path)) {
            force_download($filename, file_get_contents(FCPATH . $file_path));
        }
        // Case 2: absolute URL stored
        elseif (filter_var($file_path, FILTER_VALIDATE_URL)) {
            $content = @file_get_contents($file_path);
            if ($content !== false) {
                force_download($filename, $content);
            } else {
                show_error('Unable to fetch file from URL: ' . $file_path);
            }
        }
        else {
            show_error('File not found: ' . $file_path);
        }
    } else {
        show_error('Invalid assignment ID: ' . $id);
    }
}


public function download_project($id)
{
    $this->load->helper('download');
    $this->load->model('CheckAssignmentModel');

    $file = $this->CheckAssignmentModel->get_project_name_file($id);

    if ($file) {
        $file_path = $file->path;

        // get extension from file path (pdf, ipynb, docx, etc.)
        $extension = pathinfo($file_path, PATHINFO_EXTENSION);

        // sanitize username & title for safe filenames
        $username = preg_replace('/[^A-Za-z0-9_\-]/', '_', $file->username);
        $title    = preg_replace('/[^A-Za-z0-9_\-]/', '_', $file->title);

        $filename = $username . '_' . $title . '.' . $extension;

        // Case 1: relative path in local folder
        if (file_exists(FCPATH . $file_path)) {
            force_download($filename, file_get_contents(FCPATH . $file_path));
        }
        // Case 2: absolute URL stored
        elseif (filter_var($file_path, FILTER_VALIDATE_URL)) {
            $content = @file_get_contents($file_path);
            if ($content !== false) {
                force_download($filename, $content);
            } else {
                show_error('Unable to fetch file from URL: ' . $file_path);
            }
        }
        else {
            show_error('File not found: ' . $file_path);
        }
    } else {
        show_error('Invalid assignment ID: ' . $id);
    }
}

 public function AllUserForAdmin()
 { 
   $data=$this->CheckAssignmentModel->getAllUserData();
   $alldata=$this->CheckAssignmentModel->AllUserWithMarks();
   $this->load->view('assignment/admin/allusersdetail/result',['result'=>$data,'allresult'=>$alldata]);
 }

 public function editassignmentmarks($id){
	$data['result']=$this->CheckAssignmentModel->getmarksdetaileditbyid($id);
    $this->load->view('assignment/admin/allusersdetail/edit',$data);

}

public function updateassignmentmarksbyid(){
			$this->form_validation->set_rules('assignmenttopic','Assignment Topic','required');
			$this->form_validation->set_rules('marks','Marks','required');

        if($this->form_validation->run()==True){
			$newuid=$this->input->post('assignmentid');
			$umarks=$this->input->post('marks');
			$data=array(
				'marks'=>$umarks,
				'status'=>1
		);

	$udatests=$this->CheckAssignmentModel->changeassignmentmarksbyadmin($data,$newuid);
	if($udatests>0){
		$this->session->set_flashdata('message', 'Marks Updated Successfully.');
		redirect(base_url().'AssignmentAllUserAdmin/AllUserForAdmin');
	}
	else{
	$this->session->set_flashdata('message', 'Some Error Occured. Please Try Again!');
	redirect(base_url().'AssignmentAllUserAdmin/AllUserForAdmin');
	}		
	}else{
		$this->session->set_flashdata('message', "Assignment Topic Field And Marks Field Both Are Required.");
		redirect(base_url().'AssignmentAllUserAdmin/AllUserForAdmin');
	}
} 

public function searchfunction() {
    $keyword = $this->input->post('keyValue', TRUE);
    $batch   = $this->input->post('batchValue', TRUE);
	$topic   = $this->input->post('topicValue', TRUE);

    $result = $this->CheckAssignmentModel->searchRecords($keyword, $batch,$topic);

    echo json_encode($result);
}

public function assign_admin_all_feedback(){
	$all_data=$this->CheckAssignmentModel->AllFeedBackData();
   $this->load->view('assignment/admin/allusersdetail/user_feedback',['fd_result'=>$all_data]);
}

public function edit_status_of_feedback($id){
	 $status=$this->input->post('change-status');
	$data=array(
		'status'=>$status,
);

$status=$this->CheckAssignmentModel->change_feedback_status_admin($data,$id);
if($status>0){
	$this->session->set_flashdata('message', 'Status Has Changed Successfully.');
	redirect(base_url().'assignment-all-feedback');
}
else{
	$this->session->set_flashdata('message', 'Some Error Occured. Please Try Again!');
	redirect(base_url().'assignment-all-feedback');
}		
}

public function admin_all_project_details(){
	$data=$this->CheckAssignmentModel->All_Project_Details_dt();
   $this->load->view('assignment/admin/project_details',['pr_result'=>$data]);
}


// public function admin_all_project_details() {
// 	// Pagination Configuration
	
// 	$config['base_url'] = base_url('AssignmentAllUserAdmin/admin_all_project_details');
// 	$config['total_rows'] = $this->CheckAssignmentModel->count_all_project_list();
// 	$config['per_page'] = 10; 
// 	$config['uri_segment'] = 3;
	
// 	// Pagination Styling (Optional)
// 	$config['full_tag_open'] = '<ul class="pagination">';
// 	$config['full_tag_close'] = '</ul>';
// 	$config['num_tag_open'] = '<li>';
// 	$config['num_tag_close'] = '</li>';
// 	$config['cur_tag_open'] = '<li class="active"><a>';
// 	$config['cur_tag_close'] = '</a></li>';
// 	$config['prev_tag_open'] = '<li>';
// 	$config['prev_tag_close'] = '</li>';
// 	$config['next_tag_open'] = '<li>';
// 	$config['next_tag_close'] = '</li>';
// 	$config['first_tag_open'] = '<li>';
// 	$config['first_tag_close'] = '</li>';
// 	$config['last_tag_open'] = '<li>';
// 	$config['last_tag_close'] = '</li>';
	
// 	// Initialize Pagination
// 	$this->pagination->initialize($config);

// 	// Fetch Users with Pagination
// 	$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
// 	$data['pr_result']=$this->CheckAssignmentModel->All_Project_Details_dt($config['per_page'], $page);
// 	$data['pagination_links'] = $this->pagination->create_links(); 

//    $this->load->view('assignment/admin/project_details',$data);
// }

public function project_search_function() {
    $keyValue   = $this->input->post('keyValue', TRUE);
    $batchValue = $this->input->post('batchValue', TRUE);
    $topicValue = $this->input->post('topicValue', TRUE);

    // Call model method with both parameters
    $result = $this->CheckAssignmentModel->project_search_records($keyValue, $batchValue,$topicValue);

    echo json_encode($result);
}





public function Delete_Single_Project_dtc($id){
	if ($id) {
 $delete_status=$this->CheckAssignmentModel->delete_project_admin_by_id($id);
if ($delete_status) {
 $this->session->set_flashdata('pro_success', 'Project Deleted Successfully.');
}
else{
	$this->session->set_flashdata('pro_error','Project Not Deleted Plz Try Again');
}
}
else {
	$this->session->set_flashdata('pro_error', 'Invalid Project ID.');
}
redirect(base_url().'project-all-details');
}

public function delete_user_assignment($id){
	if ($id) {
 $delete_status=$this->CheckAssignmentModel->delete_assignment_topic_admin_by_id($id);
if ($delete_status) {
 $this->session->set_flashdata('assign_success', 'Assignment Deleted Successfully.');
}
else{
	$this->session->set_flashdata('assign_error','Assignment Not Deleted Plz Try Again');
}
}
else {
	$this->session->set_flashdata('assign_error', 'Invalid  ID.');
}
redirect(base_url().'AssignmentAllUserAdmin/AllUserForAdmin');
}

public function download_result_batch_wise_view(){
	$this->load->view('assignment/admin/allusersdetail/assignment_result_of_user');
}


public function download_result_batch_wise_function() {
    $this->form_validation->set_rules('batch_name', 'Batch Name', 'required');

    if (!$this->form_validation->run()) {
        echo json_encode(['message' => 'error', 'response' => validation_errors()]);
        return;
    }
   
    $batch = $this->input->post('batch_name');
    $results = $this->CheckAssignmentModel->Result_Of_Assignment_Batch($batch);
    if (empty($results)) {
        echo json_encode(['message' => 'error', 'response' => 'No records found.']);
        return;
    }
	$fileName = 'assignment_result' . date('Ymd') . '.csv';
	header("Content-Description: File Transfer");
	header("Content-Disposition: attachment; filename=$fileName");
	header("Content-Type: application/csv;");
	$file = fopen('php://output', 'w');
	$header = array('id', 'user_id', 'Name', 'Email','Title','marks','Date/Time');
	fputcsv($file, $header);
	foreach ($results as $row) {
		fputcsv($file, $row);
	}
	fclose($file);
    exit;
}


public function download_project_user_details_function() {
    // ✅ Get batch from URL
    $batch = $this->input->post('batch');

    if (empty($batch)) {
        echo "<script>alert('Please select a batch first!'); window.history.back();</script>";
        exit;
    }

    // ✅ Fetch batch-wise data
    $results = $this->CheckAssignmentModel->Result_Of_Project_Uploaded_Not_Uploaded($batch);

    // ✅ Check if records exist
    if (empty($results)) {
        echo "<script>alert('No records found for selected batch!'); window.history.back();</script>";
        exit;
    }

    // ✅ Set CSV filename with batch name
    $fileName = 'user_upload_project_detail_' . $batch . '_' . date('Ymd') . '.csv';

    // ✅ CSV headers
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$fileName");
    header("Content-Type: application/csv;");

    $file = fopen('php://output', 'w');
    $header = ['ID', 'Name', 'Email', 'Title', 'Course', 'Batch', 'Project', 'Uploaded Date'];
    fputcsv($file, $header);

    // ✅ Write each row in CSV
    foreach ($results as $row) {
        fputcsv($file, $row);
    }

    fclose($file);
    exit;
}


public function update_feedback($id)
{
    $feedback = $this->input->post('feedback');

    $data = [
        'feedback' => $feedback,
    ];

    $status = $this->CheckAssignmentModel->update_feedback($id, $data);

    if ($status) {
    $this->session->set_flashdata('message', 'Feedback has been updated successfully.');
   
	} else {
		$this->session->set_flashdata('message', 'Some error occurred. Please try again.');
	}


    redirect(base_url('AssignmentAllUserAdmin/AllUserForAdmin'));
}

public function view_update_marks(){
  $this->load->view('assignment/admin/allusersdetail/update_user_marks_manual');
}

public function importmarksCSV() {

    if (!isset($_FILES['csv_file']['name']) || $_FILES['csv_file']['name'] == '') {
        echo json_encode(['status' => 400, 'message' => 'CSV file not uploaded']);
        return;
    }

    $file = $_FILES['csv_file']['tmp_name'];

    if (($handle = fopen($file, "r")) !== FALSE) {

        $header = fgetcsv($handle); // Skip first row (headers)
        $result = true;

        while (($row = fgetcsv($handle)) !== FALSE) {

            $data = array_combine($header, $row); // Map CSV column names to values

            $updateData = [
                'status'   => 1,
                'marks'    => $data['marks'],
                'feedback' => $data['feedback']
            ];

            $updateResult = $this->CheckAssignmentModel->update_Manual_Assignment_Marks($data['assignment_id'], $data['user_id'], $data['title'], $updateData);

            if (!$updateResult) {
                $result = false;
            }
        }

        fclose($handle);

        if ($result) {
             echo json_encode(['status' => 200, 'message' => 'CSV imported and assignment marks updated successfully.']);
             //sleep(2);
		    //redirect(base_url().'assigment-update-marks-manual');

        } else {
             echo json_encode(['status' => 500, 'message' => 'Some rows failed to update.']);
            // sleep(2);
		    //redirect(base_url().'assigment-update-marks-manual');
        }
    } else {
         echo json_encode(['status' => 500, 'message' => 'Failed to open CSV file.']);
           //sleep(2);
		    //redirect(base_url().'assigment-update-marks-manual');
    }
}

}
?>



