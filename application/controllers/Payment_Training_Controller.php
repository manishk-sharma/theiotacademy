<?php
class Payment_Training_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Payment_Training_Model');
        $this->load->helper('utility_helper');
        $this->load->library(['form_validation', 'email', 'upload']);
    }

    public function send_details_of_payment_form() {
        $this->form_validation->set_rules('fullname','Name','required');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('mobile', 'Mobile No', 'required|numeric|exact_length[10]');
        $this->form_validation->set_rules('program_name','Program Name','required');
        $this->form_validation->set_rules('college_name','College Name','required');
        $this->form_validation->set_rules('location','Location','required');
        $this->form_validation->set_rules('screenshot','Add Screenshot Of Your Payment','callback_file_check');

        if ($this->form_validation->run()) {
            $data = [
                'name'          => $this->input->post('fullname'),
                'email'         => $this->input->post('email'),
                'mobile'        => $this->input->post('mobile'),
                'program_name'  => $this->input->post('program_name'),
                'college_name'  => $this->input->post('college_name'),
                'location'      => $this->input->post('location'),
                'url_source'    => $this->input->post('url_source')
            ];

            $fileuniquen = time();
            $fileStatus = $this->upload_emp_resume($fileuniquen, $data['name']);

            if ($fileStatus['status'] === TRUE) {
                $share_payment_dtc_id = $this->Payment_Training_Model->insert_Share_payment_dtc($data);
                if ($share_payment_dtc_id > 0) {
                    $this->Payment_Training_Model->updatePaymentFileByID($share_payment_dtc_id, $fileStatus['file_name']);
                    $empData = $this->Payment_Training_Model->getRecordById($share_payment_dtc_id);

                    // Add missing variables for email subject
                    $empData['name'] = $data['name'];
                    $empData['program_name'] = $data['program_name'];
                    $empData['screenshot'] = $fileStatus['file_name'];

                    $adminMailStatus = $this->admin_apply_job_Email($empData);
                    // $userMailStatus = $this->user_apply_job_ConfirmEmail($empData);

                    print json_encode(['message'=>'success', 'response'=>"Thank you for providing your payment information. Upon successful verification, the offer letter will be issued to you within the next 24 hours"]);
                } else {
                    print json_encode(['message'=>'sererror', 'response'=>'Failed! Try Again']);
                }
            } else {
                print json_encode(['message'=>'error', 'response'=>'Please upload a valid screenshot in jpg/jpeg/png/pdf format.']);
            }

        } else {
            print json_encode(['message'=>'error', 'response'=>validation_errors()]);
        }
    }

    public function file_check() {
        if (isset($_FILES['screenshot']) && $_FILES['screenshot']['error'] === 0) {
            $file_name = $_FILES['screenshot']['name'];
            $file_size = $_FILES['screenshot']['size'];
            $file_tmp  = $_FILES['screenshot']['tmp_name'];
            $file_type = $_FILES['screenshot']['type'];
            $temp = explode('.', $file_name);
            $file_ext = strtolower(end($temp));
            $extensions = ["jpg", "jpeg", "png", "pdf"];

            if (!in_array($file_ext, $extensions)) {
                $this->form_validation->set_message('file_check', 'Invalid file type. Only jpg, jpeg, png, pdf allowed.');
                return FALSE;
            }

            if ($file_size > 2097152) {
                $this->form_validation->set_message('file_check', 'File size must be less than 2MB.');
                return FALSE;
            }

            return TRUE;
        }

        $this->form_validation->set_message('file_check', 'Please upload a screenshot.');
        return FALSE;
    }

    public function upload_emp_resume($fileuniquen, $name) {
        $fileStatus = ['status' => FALSE, 'file_name' => ''];

        if (!empty($_FILES['screenshot']['name'])) {
            $config['upload_path']   = './uploads/resume/';
            $config['file_name']     = $name.'_Screenshot_'.$fileuniquen;
            $config['allowed_types'] = 'jpg|jpeg|png|pdf';
            $config['max_size']      = 2050;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('screenshot')) {
                return $fileStatus;
            } else {
                $data = $this->upload->data();
                $fileStatus['file_name'] = $data['file_name'];
                $fileStatus['status'] = TRUE;
                return $fileStatus;
            }
        }

        return $fileStatus;
    }

    public function admin_apply_job_Email($empData) {
    $this->load->library('email'); // Ensure email library is loaded

    $this->email->from("enquiry@theiotacademy.co", 'Payment Details Of Training | The IoT Academy');
    $this->email->to("summertraining@theiotacademy.co");

    // Make sure to use $empData, not $data
    $this->email->subject('New Payment Details Received from ' . $empData['name']);
    $this->email->message($this->load->view('mailFormat/admin_payment_details_mail', $empData, TRUE));
    
    $resume_path = FCPATH . 'uploads/resume/' . $empData['screenshot']; // full path for attachment
    if (file_exists($resume_path)) {
        $this->email->attach($resume_path);
    }

    if ($this->email->send()) {
        $this->email->clear(TRUE);
        return TRUE;
    } else {
        // Debugging output
        log_message('error', 'Email not sent: ' . $this->email->print_debugger());
        return FALSE;
    }
}


    public function user_apply_job_ConfirmEmail($data) {
        $this->email->from("enquiry@theiotacademy.co", 'Enquiry | The IoT Academy');
        $this->email->to($data['email']);
        $this->email->subject('Congratulations '.$data['name'].'! Your Job Application Requested Successfully');
        // $this->email->message($this->load->view('mailFormat/employee_apply_job_mail', $data, TRUE));
        $this->email->message("gerr",True);


        return $this->email->send();
    }

}
