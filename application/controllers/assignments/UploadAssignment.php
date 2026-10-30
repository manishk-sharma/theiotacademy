<?php 
defined('BASEPATH') OR exit('No direct script access allowed');  

class UploadAssignment extends CI_Controller{
	public function __construct(){ 
	 parent::__construct();
	 $this->load->library('session');
	$this->load->helper('utility_helper');
	$this->load->library('form_validation');
	$this->load->model(['CheckAssignmentModel']);
	$this->load->library('email'); 
}

public function upload_assignment_submit() {
    $this->form_validation->set_rules('assignment-topic', 'Assignment Topic', 'required');
    $this->form_validation->set_rules('userid', 'User ID', 'required');

    if ($this->form_validation->run()) {
        $title = $this->input->post('assignment-topic');
        $userid = $this->input->post('userid');

        // Check if the file is uploaded
        if (empty($_FILES['assignment']['name'])) {
            print_r(json_encode([
                'message' => 'error',
                'statusCode' => 400,
                'response' => ' Please ensure that all assignments are submitted in Jupyter Notebook (.ipynb) format. Only Power BI, Tableau, and SQL should be submitted in PDF.'
            ]));
            return;
        }

        // Generate a new file name
        $filename = pathinfo($_FILES['assignment']['name'], PATHINFO_FILENAME);
        $extension = pathinfo($_FILES['assignment']['name'], PATHINFO_EXTENSION);
        //$newfilenameofpdf = $filename . '_' . $userid . '_' . time() . '.' . $extension;
        $newfilenameofpdf = $userid . '_' . time() . '.' . $extension;

        // Data for database insertion
        $data = [
            'title' => $title,
            'user_id' => $userid,
            'assignment_pdf' => base_url('uploads/assignmentpdf/').$newfilenameofpdf,
           ];

		$ismatchassignmenttopic=$this->CheckAssignmentModel->checkassignmenttopicmatch($title,$userid);

		if (!$ismatchassignmenttopic['title'] && !$ismatchassignmenttopic['user_id']){

        //$apply_job_id = $this->CheckAssignmentModel->UploadAssignmentmfn($data);
        $apply_job_id =$userid;

        if ($apply_job_id > 0) {
            $fileStatus = $this->upload_profile($newfilenameofpdf);
            
            if ($fileStatus['status'] === TRUE) {
                $this->CheckAssignmentModel->UploadAssignmentmfn($data);
                print_r(json_encode([
                    'message' => 'success',
                    'statusCode' => 200,
                    'response' => 'Assignment uploaded successfully.',
                    'file_name' => $fileStatus['file_name']
                ]));
            } else {
                print_r(json_encode([
                    'message'=> 'error',
                    'statusCode' => 500,
                    'response' => $fileStatus['error']
                ]));
            }
        } else {
            print_r(json_encode([
                'message' => 'error',
                'statusCode' => 400,
                'response' => 'Database insertion failed.'
            ]));
        }
	}
	else{
		print_r(json_encode([
			 'message' => 'error',
			'statusCode' => 400,
			'response' => 'This Assignment Already Exists'
		]));
	}

    } else {
        print_r(json_encode([
            'message' => 'error',
            'response' => validation_errors()
        ]));
    }
}


public function upload_profile($newfilenameofpdf) {
    $fileStatus = ['file_name' => '', 'status' => FALSE, 'error' => ''];

    $upload_path = './uploads/assignmentpdf/';
    $target_path = $upload_path . $newfilenameofpdf;

    if (!file_exists($upload_path)) {
        mkdir($upload_path, 0777, true);
    }

    $file_ext = pathinfo($_FILES['assignment']['name'], PATHINFO_EXTENSION);

    if (in_array($file_ext, ['pdf', 'ipynb'])) {
        if ($_FILES['assignment']['size'] <= 8150 * 1024) { // Size check in bytes
            if (move_uploaded_file($_FILES['assignment']['tmp_name'], $target_path)) {
                $fileStatus['file_name'] = $newfilenameofpdf;
                $fileStatus['status'] = TRUE;
            } else {
                $fileStatus['error'] = 'File upload failed (move_uploaded_file).';
            }
        } else {
            $fileStatus['error'] = 'File size exceeds limit.';
        }
    } else {
        $fileStatus['error'] = 'File type not allowed.';
    }

    return $fileStatus;
}
public function AllAssignmentpdf(){
	$allassignmentresult = $this->CheckAssignmentModel->AllUserAssignment();
	if (empty($allassignmentresult)) {
        $response = [
            'message' => 'No assignments found',
            'statusCode' => 404,
            'response' => []
        ];
    } else {
        $response = [
            'message' => 'success',
            'statusCode' => 200,
            'response' => $allassignmentresult
        ];
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

public function UpdateAllAssignmentcontent(){
	// $data=array();
	// $data=[ 
	// ['title' => 'theio academy', 'user_id' => 18,'marks' => 300],
    // ['title' =>'ds ml iot css', 'user_id' => 18,'marks' => 600],
    // ['title' =>'fkvnxkncxkx', 'user_id' => 18,'marks' =>500]
	// ];
	// foreach($data as $row){
	// 	$user = [
	// 		'status' => 1, 'marks' => $row['marks']
	// 	];
	// 	$result = $this->CheckAssignmentModel->updateAssignmentMarks($row['user_id'],$row['title'], $user);	
	// }
	// if ($result) {
	// 	echo "Assignment marks updated successfully.";
	// } else {
	// 	echo "Failed to update assignment marks.";
	// }
	//   $jsonData = '[
	// 	{ "title": "theio academy", "user_id": 18, "marks": 390 },
	// 	{ "title": "ds ml iot css", "user_id": 18, "marks": 4000 },
	// 	{ "title": "fkvnxkncxkx", "user_id": 18, "marks": 100 }
	// ]';

	$jsonData = $this->input->raw_input_stream;
    $data = json_decode($jsonData, true); // Decode JSON into an associative array

    if (empty($data)) {
        echo json_encode(['status' => 400, 'message' => 'Invalid or missing data']);
        return;
    }

    $result = true;

    foreach ($data as $row) {
        $user = [
            'status' => 1,
            'marks' => $row['marks'],
            'feedback'=>$row['feedback']
        ];

        $updateResult = $this->CheckAssignmentModel->updateAssignmentMarks($row['assignment_id'],$row['user_id'], $row['title'], $user);
        if (!$updateResult) {
            $result = false; // Mark failure if any update fails
        }
    }
    if ($result) {
        echo json_encode(['status' => 200, 'message' => 'Assignment marks updated successfully.']);
    } else {
        echo json_encode(['status' => 500, 'message' => 'Failed to update some assignment marks.']);
    }


}
public function assignment_user_feedback(){
	$this->form_validation->set_rules('user_id','User ID','required');
	$this->form_validation->set_rules('title','Title','required');
	$this->form_validation->set_rules('description','Description','required');

	if($this->form_validation->run()){
		$userid=$this->input->post('user_id');
		$title=$this->input->post('title');
		$description=$this->input->post('description');
			$data=array(
				'user_id'=>$userid,
				'title'=>$title,
				'description'=>$description
			);
		   $isdetailstc=$this->CheckAssignmentModel->matchcomplaintopic($userid,$title);

		   if (!$isdetailstc['user_id'] && !$isdetailstc['title']) {

			$this->CheckAssignmentModel->feedback_register($data);

			print_r(json_encode(array('message' => 'success', 'status' => 200 ,'response'=>'Thank you for your query. The IoT Academy team member will review it and connect with you as soon as possible.')));

			}
			else{
				print_r(json_encode(array('message' => 'error','status'=>409,'response'=>'You Have Already Registered for This Feedback .')));
			}
	}
	else{
		print_r(json_encode(array('message' => 'error','response'=>validation_errors())));
	}

}


public function user_upload_mini_project() {
    $this->form_validation->set_rules('title', 'Project Name', 'required');
    $this->form_validation->set_rules('userid', 'User ID', 'required');

    if ($this->form_validation->run()) {
        $title = $this->input->post('title');
        $userid = $this->input->post('userid');

        // Check if the file is uploaded
        if (empty($_FILES['project']['name'])) {
            print_r(json_encode([
                'message' => 'error',
                'statusCode' => 400,
                'response' => 'Project File Has Not Selected.'
            ]));
            return;
        }

        // Generate a new file name
        $extension = pathinfo($_FILES['project']['name'], PATHINFO_EXTENSION);
        $mn_project_file_name = 'mini_project'.$userid . '_' . time() . '.' . $extension;
        // Data for database insertion
        $data = [
            'title' => $title,
            'user_id' => $userid,
            'mini_project' => base_url('uploads/mini_project/').$mn_project_file_name,
           ];
		$is_match_min_project=$this->CheckAssignmentModel->check_project_title_match($userid,$title);
		 if (!$is_match_min_project['user_id'] && !$is_match_min_project['title']){
            $fileStatus = $this->upload_mini_project($mn_project_file_name);
            
            if ($fileStatus['status'] === TRUE) {
				if($this->CheckAssignmentModel->UploadMiniProjectSubmit($data)){
					print_r(json_encode([
						'message' => 'success',
						'statusCode' => 200,
						'response' => 'Project Submitted successfully.',
						'file_name' => $fileStatus['file_name']
					]));
				}
                
            } else {
                print_r(json_encode([
                    'message' => 'error',
                    'statusCode' => 500,
                    'response' => $fileStatus['error']
                ]));
            }
        
	}
	else{
		print_r(json_encode([
			'message' => 'error',
			'statusCode' => 400,
			'response' => 'You have Already Submitted Your Project'
		]));
	}

    } else {
        print_r(json_encode([
            'message' => 'error',
			'statusCode' => 500,
            'response' => validation_errors()
        ]));
    }
}

public function upload_mini_project($mn_project_file_name) {
    $fileStatus = ['file_name' => '', 'status' => FALSE, 'error' => ''];

    $config = [
        'upload_path' => './uploads/mini_project/',
        'file_name' => $mn_project_file_name,
        // 'allowed_types' => 'pdf|ipynb',
        'allowed_types' => '*',
        'max_size' => 10050,
    ];

    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if (!$this->upload->do_upload('project')) {
        $fileStatus['error'] = $this->upload->display_errors('', '');
    } else {
        $data = $this->upload->data();
        $fileStatus['file_name'] = $data['file_name'];
        $fileStatus['status'] = TRUE;
    }

    return $fileStatus;
}









}
?>



