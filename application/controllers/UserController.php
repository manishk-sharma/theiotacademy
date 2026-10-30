<?php 
defined('BASEPATH') OR exit('No direct script access allowed');  

class UserController extends CI_Controller{
	public function __construct(){ 
	 parent::__construct();
	 $this->load->library('session');
	$this->load->helper('utility_helper');
	$this->load->library('form_validation');
	$this->load->model(['CheckAssignmentModel']);
	$this->load->library('email'); 

}

public function register_create(){
	$this->load->view('assignment/register');
}

public function register_submit(){
	$this->form_validation->set_rules('fullname','Name','required');
	$this->form_validation->set_rules('mobile','Mobile No','required');
	$this->form_validation->set_rules('email','Email','required');
	$this->form_validation->set_rules('batch','Batch','required');
	$this->form_validation->set_rules('dob','DOB','required');
	$this->form_validation->set_rules('course','Course','required');
	//$this->form_validation->set_rules('profile', 'Image', 'callback_validate_image');


	if($this->form_validation->run()){
		$name=$this->input->post('fullname');
		$mobile=$this->input->post('mobile');
		$email=$this->input->post('email');
		$batch=$this->input->post('batch');
		$dob=$this->input->post('dob');
		$course=$this->input->post('course');
		$password=$this->input->post('password');
		$con_password=$this->input->post('con_password');

		if($password==$con_password){
			$data=array(
				'username'=>$name,
				'mobile'=>$mobile,
				'email'=>$email,
				'batch'=>$batch,
				'dob'=>$dob,
				'course'=>$course,
				'password'=>md5($password),
			);
		   $ismatchdtc=$this->CheckAssignmentModel->userdetailsmatch($email);
		   if (!$ismatchdtc['email']) {
			$apply_job_id=$this->CheckAssignmentModel->Register($data);
			$this->session->set_flashdata('LoginMsg', 'You have Registered Successfully. Login With Your Email And Password.');
			print_r(json_encode(array('message' => 'success', 'statusCode' => 200 ,'response'=>'You Have Registered Successfully.')));
			if($apply_job_id>0 && !empty($_FILES["profile"]["name"])){
                $fileStatus=$this->upload_profile($apply_job_id,$name);
                if($fileStatus['status']==TRUE){
                    $this->CheckAssignmentModel->updateProfileByID($apply_job_id,$fileStatus['file_name']);
                }
                else{
                     print_r(json_encode(array('message' => 'error', 'statusCode' => 501 ,'response'=>'Please Upload Your Profile jpg/jpeg/png.')));

                }   

            }
	
			}
			else{
				print_r(json_encode(array('message' => 'error','response'=>'You Have Already Registered.')));
			}

		}else{
			print json_encode(array('message'=>'error','response'=>"The password and confirm password fields do not match."));
		}
	}
	else{
		print_r(json_encode(array('message' => 'error','response'=>validation_errors())));
	}
}

public function user_update_profile() {
    $this->form_validation->set_rules('fullname', 'Name', 'required');
    $this->form_validation->set_rules('mobile', 'Mobile No', 'required');
    $this->form_validation->set_rules('dob', 'DOB', 'required');

    if (!$this->form_validation->run()) {
        echo json_encode(['message' => 'error', 'response' => validation_errors()]);
        return;
    }
    $id = $this->input->post('userid');
    $data = [
        'username' => $this->input->post('fullname'),
        'mobile' => $this->input->post('mobile'),
        'dob' => $this->input->post('dob'),
    ];

    $update_user_id = $this->CheckAssignmentModel->Update_Profile($id, $data);
    if ($update_user_id > 0 && $_FILES['profile']['name']) {
        $ufileStatus = $this->upload_update_profile($id, $data['username']);
        if ($ufileStatus['status']) {
            $this->CheckAssignmentModel->updateProfileByIDupdate($id, $ufileStatus['file_name']);
        } else {
            echo json_encode(['message' => 'error', 'statusCode' => 501, 'response' => $ufileStatus['error']]);
            return;
        }
    }

    echo json_encode(['message' => 'success', 'statusCode' => 200, 'response' => 'Your information has been successfully updated!']);
}

public function validate_image($str) {
    if (empty($_FILES['profile']['name'])) {
        $this->form_validation->set_message('validate_image', 'The profile image field is required.');
        return FALSE;
    }

    $allowed_types = ['jpg', 'jpeg', 'png'];
    $extension = pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION);

    if (!in_array(strtolower($extension), $allowed_types)) {
        $this->form_validation->set_message('validate_image', 'Only JPG, JPEG, and PNG files are allowed.');
        return FALSE;
    }

    return TRUE;
}


public function upload_profile($apply_job_id, $name) {
    $fileStatus = ['file_name' => '', 'status' => FALSE, 'error' => ''];

    if (empty($_FILES['profile']['name'])) {
        $fileStatus['error'] = 'No file uploaded.';
        return $fileStatus;
    }

    $config = [
        'upload_path' => './uploads/assignmentuser',
        'file_name' => $name . '_Profile_' . $apply_job_id,
        'allowed_types' => 'png|jpg|jpeg',
        'max_size' => 2050, // size in KB
    ];

    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if (!$this->upload->do_upload('profile')) {
        $fileStatus['error'] = $this->upload->display_errors();
    } else {
        $data = $this->upload->data();
        $fileStatus['file_name'] = $data['file_name'];
        $fileStatus['status'] = TRUE;
    }

    return $fileStatus;
}

public function upload_update_profile($id, $name) {
    $ufileStatus = ['file_name' => '', 'status' => FALSE, 'error' => ''];

    if (!isset($_FILES['profile']) || empty($_FILES['profile']['name'])) {
        $ufileStatus['error'] = 'No file uploaded.';
        return $ufileStatus;
    }

    $config = [
        'upload_path' => './uploads/assignmentuser/',
        'file_name' => $name . '_UpdateProfile_' . $id,
        'allowed_types' => 'png|jpg|jpeg',
        'max_size' => 1050, // size in KB
    ];

    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if (!$this->upload->do_upload('profile')) {
        $ufileStatus['error'] = strip_tags($this->upload->display_errors());
    } else {
        $data = $this->upload->data();
        $ufileStatus['file_name'] = $data['file_name'];
        $ufileStatus['status'] = TRUE;
    }

    return $ufileStatus;
}

public function login_create(){
	$this->load->view('assignment/login');
}  

public function submit_login(){  
	
	$this->form_validation->set_rules('username','Email','required');
	$this->form_validation->set_rules('password','Password','required');

	if($this->form_validation->run()){
		$email = $this->input->post('username');
		$password = $this->input->post('password');
		$row = $this->CheckAssignmentModel->check_user($email);
		if (!empty($row) && $row['password']==(md5($password)))
		{  
			$data = array(
					'username'=>$row['username'],
					'email'=>$row['email'],
					'is_login'=>true,
			);
			$this->session->set_userdata('user', $data);
			$userData = $this->CheckAssignmentModel->FindMachedAllData($email);
			//$assigmentd = $this->CheckAssignmentModel->SingleUserAssignment($email);
			if($userData['status']==0){
			//$this->load->view('assignment/dashboard',['data'=>$userData,'assignmentdata'=>$assigmentd]);
			redirect(base_url().'assignment-dashboard');
			}
			else if($userData['status']==1){
				//$this->load->view('assignment/admin/admin_dashboard',['data'=>$userData]);
				redirect(base_url().'assignment-admin-dashboard');
			}
				 
		}else{
			$this->session->set_flashdata('error', 'Error! Invalid email and password!');
			redirect(base_url().'assignment-login');
		}		
	}  
	else{
			$this->session->set_flashdata('error', "Error! Email And Password Both Fields Are Required");
			redirect(base_url().'assignment-login');
	}      
}

public function logout(){
	$this->session->sess_destroy();
	redirect(base_url('assignment-login'));

}

public function dashboard() {
    $user = $this->session->userdata('user');
    if (!$user['is_login']) {
        redirect('assignment-login');
    }

	$userData = $this->CheckAssignmentModel->FindMachedAllData($user['email']);
	$assigmentd = $this->CheckAssignmentModel->SingleUserAssignment($user['email']);
	$newsUpdate = $this->CheckAssignmentModel->NewsandUpdateForAll();
	$assignment_feedback = $this->CheckAssignmentModel->FindUserMatchFeedback($user['email']);
	$project_details_user = $this->CheckAssignmentModel->Find_User_Matched_Project_Details($user['email']);
    $this->load->view('assignment/dashboard', ['data'=>$userData,'assignmentdata'=>$assigmentd,'newsupdate'=>$newsUpdate,'userfeedback_content'=>$assignment_feedback,'user_project_detail'=>$project_details_user]);
}

public function admin_dashboard(){
	$user = $this->session->userdata('user');
    if (!$user['is_login']) {
        redirect('assignment-login');
    }
    $userData = $this->CheckAssignmentModel->FindMachedAllData($user['email']);
	$this->load->view('assignment/admin/admin_dashboard', ['data' => $userData]);
}

public function assign_forgot_password(){
	$this->load->view('assignment/forgot_password');
}

public function forgot_password()
{
    $this->form_validation->set_rules('email','Email','required');
	if($this->form_validation->run()){
		$email = $this->input->post('email');
    $user = $this->CheckAssignmentModel->get_user_by_email($email);

    if ($user) {
        $token = bin2hex(random_bytes(32));
        $expiry = date("Y-m-d H:i:s", strtotime('+1 hour'));
        $this->CheckAssignmentModel->update_reset_token($user->id, $token, $expiry);

        // Send reset link via email
        $reset_link = base_url("UserController/reset_password?token=$token");
        $message = "Click here to reset your password: $reset_link";

        $this->load->library('email');
        $this->email->from('enquiry@theiotacademy.co', 'The IoT Academy');
        $this->email->to($email);
        $this->email->subject('Password Reset');
        $this->email->message($message);

        if ($this->email->send()) {
			$this->session->set_flashdata('error', 'Success! Reset link sent to your email Id. Please Open Your Mail Box And Set A New Password');
			redirect('assignment-forgot-password');
        } else {
			$this->session->set_flashdata('error', 'Error! Failed to send email. Please Try After Some Time');
			redirect('assignment-forgot-password');
        }
    } 
	else {
        //echo "Email not found.";
		$this->session->set_flashdata('error', 'Error! Failed to send email. Please Try After Some Time');
			redirect('assignment-forgot-password');
    }
 
	}
	else{
		$this->session->set_flashdata('error', 'Error! Email Field Is Required');
			redirect('assignment-forgot-password');
	}	

}

public function reset_password()
{
    $token = $this->input->get('token');

    $user = $this->CheckAssignmentModel->get_user_by_token($token);

    if ($user && strtotime($user->token_expiry) > time()) {
        if ($this->input->post()) {
            $new_password = md5($this->input->post('password'));

            // Update the password and clear the token
            $this->CheckAssignmentModel->update_password($user->id, $new_password);

            echo "Password reset successfully. You will be redirected to the login page in 10 seconds.";
			echo "<script>
				setTimeout(function() {
					window.location.href = '" . base_url('assignment-login') . "';
				}, 5000);
			</script>";
			exit;

        } else {
            // Load your reset password form view
            $this->load->view('assignment/reset_password_form', ['token' => $token]);
        }
    } else {
        echo "Invalid or expired token.";
    }
}






}
?>



