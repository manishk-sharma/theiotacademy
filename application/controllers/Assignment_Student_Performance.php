<?php 
defined('BASEPATH') OR exit('No direct script access allowed');  

class Assignment_Student_Performance extends CI_Controller{

	public function __construct(){ 
	 parent::__construct();
	 $this->load->library('session');
	$this->load->helper('utility_helper');
	$this->load->library('form_validation');
	$this->load->model(['CheckAssignmentModel','Assigment_Student_Performance_Model']);
	$this->load->library('email'); 
	$this->load->library('pagination');
}



public function attendance_admin_show(){

    try{
        $data = array();
        $data['members'] = $this->Assigment_Student_Performance_Model->get_User_details();
     }
      catch(Exception $e){
        print_r($e);
      }
  $this->load->view('assignment/admin/performance/attendence_index', $data);

}

public function attendance_import(){
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
                        if ($row['email']=='' || $row['week']=='' || $row['week_range']=='' || $row['attendance']=='') {
                            
                            $this->session->set_flashdata('success_msg', 'All Field Are Required');
                            redirect('admin-assignment-attendance');
                        }
                        else{
                        $rowCount++;
                       
                     $week_raw = $row['week'];
                     $week_raw = preg_replace('/week\s*-\s*/i', 'Week-', $week_raw);
                     $memData = array(
                        'email' =>$row['email'] ,
                        'week_label' => $week_raw,
                        'week_range' => strtolower($row['week_range']),
                        'attended_classes' => strtolower($row['attendance'])
                        );    

                        // Check whether email already exists in the database

                        $con = array(

                            'where' => array(
                                'email' => $row['email'],
                                'week_label'=>$week_raw
                            ),

                            'returnType' => 'count'

                        );

                        $prevCount = $this->Assigment_Student_Performance_Model->getRows($con);
                        if($prevCount > 0){

                            // Update member data

                            $condition = array('email' => $row['email'],'week_label'=>$row['week']);
                            $update = $this->Assigment_Student_Performance_Model->update($memData, $condition);

                            if($update){
                                $updateCount++;
                            }

                        }else{

                            // Insert member data

                            $insert = $this->Assigment_Student_Performance_Model->insert($memData);
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

    redirect('admin-assignment-attendance');

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



