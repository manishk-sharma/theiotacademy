<?php 
defined('BASEPATH') OR exit('No direct script access allowed');  

class Assignment_live_test_asignment_report extends CI_Controller{

	public function __construct(){ 
	 parent::__construct();
	 $this->load->library('session');
	$this->load->helper('utility_helper');
	$this->load->library('form_validation');
	$this->load->model(['CheckAssignmentModel','Assignment_Live_Test_Assignment_Report_Model']);
	$this->load->library('email'); 
	$this->load->library('pagination');
}



public function assignment_admin_live_show(){

    try{
        $data = array();
        $data['members'] = $this->Assignment_Live_Test_Assignment_Report_Model->get_User_details();
     }
      catch(Exception $e){
        print_r($e);
      }
  $this->load->view('assignment/admin/performance/assignment_live_test_report', $data);

}

public function live_assignment_csv_import(){
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
                                !is_numeric($row['mini_test1']) ||
                                !is_numeric($row['mini_test2']) ||
                                !is_numeric($row['live_test']) ||
                                !is_numeric($row['assignment'])
                            ) {
                                $this->session->set_flashdata('success_msg', 'All fields are required and must be numeric.');
                                redirect('assignment-admin-csv-live-test');
                            }
                        else{
                        $rowCount++;
                       

                     $memData = array(
                        'email' =>$row['email'] ,
                        'topic_name' => ucwords(strtolower($row['topic_name'])),
                        'date_range' => strtolower($row['date_range']),
                        'mini_test1' => strtolower($row['mini_test1']),
                        'mini_test2' => strtolower($row['mini_test2']),
                        'live_test' => strtolower($row['live_test']),
                        'assignment' => strtolower($row['assignment'])
                        );    

                        // Check whether email already exists in the database

                        $con = array(

                            'where' => array(
                                'email' => $row['email'],
                                'date_range'=>$row['date_range']
                            ),

                            'returnType' => 'count'

                        );

                        $prevCount = $this->Assignment_Live_Test_Assignment_Report_Model->getRows($con);
                        if($prevCount > 0){

                            // Update member data

                            $condition = array('email' => $row['email'],'date_range'=>$row['date_range']);
                            $update = $this->Assignment_Live_Test_Assignment_Report_Model->update($memData, $condition);

                            if($update){
                                $updateCount++;
                            }

                        }else{

                            // Insert member data

                            $insert = $this->Assignment_Live_Test_Assignment_Report_Model->insert($memData);
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

    redirect('assignment-admin-csv-live-test');

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



