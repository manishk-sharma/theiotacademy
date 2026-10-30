<?php 
defined('BASEPATH') OR exit('No direct script access allowed');  

class UploadNewsUpdate extends CI_Controller{

	public function __construct(){ 
	 parent::__construct();
	 $this->load->library('session');
	$this->load->helper('utility_helper');
	$this->load->library('form_validation');
	$this->load->model(['CheckAssignmentModel']);
	$this->load->library('email'); 
}

public function add_new_update_page(){
    $this->load->view('assignment/admin/newsandupdate/index');
 }

 public function insert_news_evnt(){
    
        $this->form_validation->set_rules('title','Title','required');
        $this->form_validation->set_rules('description','Description','required');
        if($this->form_validation->run()==True){
            $title=$this->input->post('title');
            $description=$this->input->post('description');
            $data=array(
                'title'=>$title,
                'description'=>$description,
            );

            $isExistDetails=$this->CheckAssignmentModel->isexiststitleofnews($title); 

            if(!$isExistDetails){
             $gcid=$this->CheckAssignmentModel->NewsUpdateInsertd($data);
            if($gcid>0){
						$this->session->set_flashdata('success', 'News Event Inserted Successfully');
							print json_encode(array('message'=>'success','response'=>"News and Update Inserted Successfully."));
						}
						else{
								print_r(json_encode(array('message' => 'sererror', 'response'=>'News and Event Faield! Try Again')));
						}
					}
					else{
						print_r(json_encode(array('message' => 'sererror','response'=>'This Detail is Already Exists')));
					}
        }else{
            print_r(json_encode(array('message' => 'error','response'=>validation_errors())));
        }
 }
 public function newsupdateshow()
 { 
   $data['result']=$this->CheckAssignmentModel->getAllNewsEventadmin();
   $this->load->view('assignment/admin/newsandupdate/result',$data);
 }

 public function editnewseventdata($id){
	$data['result']=$this->CheckAssignmentModel->getNewseventbyid($id);
 $this->load->view('assignment/admin/newsandupdate/edit',$data);

}

public function updatenewseventbyid(){
			$this->form_validation->set_rules('title','Title','required');
			$this->form_validation->set_rules('description','Description','required');

        if($this->form_validation->run()==True){
			$newsuid=$this->input->post('newseventid');
			$utitle=$this->input->post('title');
			$udesc=$this->input->post('description');
			$data=array(
				'title'=>$utitle,
				'description'=>$udesc
		);

	$udatests=$this->CheckAssignmentModel->updatenewsevents($data,$newsuid);
	if($udatests>0){
		$this->session->set_flashdata('success', 'News And Event Updated Successfully.');
		redirect(base_url().'UploadNewsUpdate/newsupdateshow');
	}
	else{
	$this->session->set_flashdata('error', 'Some Error Occured. Please Try Again!');
	redirect(base_url().'UploadNewsUpdate/newsupdateshow');
				}	
	}else{
		$this->session->set_flashdata('error', validation_errors());
		redirect(base_url().'UploadNewsUpdate/newsupdateshow');
	}

} 


public function DeleteNewsUpdate($id){
	if ($id) {
 $delstatus=$this->CheckAssignmentModel->deletenewsupdatebyid($id);
}
if ($delstatus) {
 $this->session->set_flashdata('success', 'News and Update Deleted Successfully.');
}
else{
	$this->session->set_flashdata('error','News and Update Not Deleted Plz Try Again');
}
redirect(base_url().'UploadNewsUpdate/newsupdateshow');
}



}
?>



