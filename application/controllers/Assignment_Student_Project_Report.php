<?php 
defined('BASEPATH') OR exit('No direct script access allowed');  

class Assignment_Student_Project_Report extends CI_Controller{

	public function __construct(){ 
	 parent::__construct();
	 $this->load->library('session');
	$this->load->helper('utility_helper');
	$this->load->library('form_validation');
	$this->load->model(['CheckAssignmentModel','Assignment_Student_Project_Report_Model']);
	$this->load->library('email'); 
	$this->load->library('pagination');
}



public function assignment_project_report_admin_show(){

    try{
        $data = array();
        $data['members'] = $this->Assignment_Student_Project_Report_Model->get_User_details();
     }
      catch(Exception $e){
        print_r($e);
      }
  $this->load->view('assignment/admin/performance/assignment_project_report', $data);

}

public function assignment_project_report_import_fun(){
    $data = array(); 
    $memData = array();
    if($this->input->post('importSubmit')){
        $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
        if($this->form_validation->run() == true){

            $insertCount = $updateCount = $rowCount = $notAddCount = 0;

            // If file uploaded

            if(is_uploaded_file($_FILES['file']['tmp_name'])){

                $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                // Insert/update CSV data into database

                if(!empty($csvData)){
                    foreach($csvData as $row)

                    {                       
                        if (
                                empty($row['email']) ||
                                empty($row['topic_name']) ||
                                empty($row['date_range']) ||
                                empty($row['type_of_project']) ||
                                !isset($row['marks'])
                            ) {
                                $this->session->set_flashdata('success_msg', 'All fields are required');
                                redirect('assignment-project-admin-report-show');
                            }
                        else{
                        $rowCount++;
                       

                     $memData = array(
                        'email' =>$row['email'] ,
                        'topic_name' => ucwords(strtolower($row['topic_name'])),
                        'date_range' => strtolower($row['date_range']),
                        'type_of_project' => strtolower($row['type_of_project']),
                        'marks' => strtolower($row['marks'])
                        );    

                        // Check whether email already exists in the database

                        $con = array(

                            'where' => array(
                                'email' => $row['email'],
                                'topic_name'=>$row['topic_name']
                            ),

                            'returnType' => 'count'

                        );

                        $prevCount = $this->Assignment_Student_Project_Report_Model->getRows($con);
                        if($prevCount > 0){

                            // Update member data

                            $condition = array('email' => $row['email'],'topic_name'=>$row['topic_name']);
                            $update = $this->Assignment_Student_Project_Report_Model->update($memData, $condition);

                            if($update){
                                $updateCount++;
                            }

                        }else{

                            // Insert member data

                            $insert = $this->Assignment_Student_Project_Report_Model->insert($memData);
                            if($insert){
                                $insertCount++;
                            }
                        }
                        $dynamic_no++;
                    }
                    }
                    
                    // Status message with imported data count

                    $notAddCount = ($rowCount - ($insertCount + $updateCount));

                    $successMsg = 'Members imported successfully. Total Rows ('.$rowCount.') | Inserted ('.$insertCount.') | Updated ('.$updateCount.') | Not Inserted ('.$notAddCount.')';

                    $this->session->set_flashdata('success_msg', $successMsg);

                }

            }else{

                $this->session->set_flashdata('error_msg', 'Error on file upload, please try again.');

            }

        }else{

            $this->session->set_flashdata('error_msg', 'Invalid file, please select only CSV file.');

        }

    }

    redirect('assignment-project-admin-report-show');

}

    

    /*

     * Callback function to check file value and type during validation

     */

    public function file_check($str){

        $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){

            $mime = get_mime_by_extension($_FILES['file']['name']);

            $fileAr = explode('.', $_FILES['file']['name']);

            $ext = end($fileAr);

            if(($ext == 'csv') && in_array($mime, $allowed_mime_types)){

                return true;

            }else{

                $this->form_validation->set_message('file_check', 'Please select only CSV file to upload.');

                return false;

            }

        }else{

            $this->form_validation->set_message('file_check', 'Please select a CSV file to upload.');
            return false;
        }
    }

}
?>



