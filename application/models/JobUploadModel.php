 <?php
 if(!defined('BASEPATH')) exit('No direct script access allowed');

class JobUploadModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
        date_default_timezone_set('Asia/Kolkata');
    }
    
    public function Insertjobupload($data){
		$this->db->insert('job_upload_tb', $data);
		$enqid=$this->db->insert_id();
		return $enqid;
    }

public function getAllJobForApply(){
       $this->db->order_by("deadline", "desc");
        $query = $this->db->get('job_upload_tb');
        return $query->result_array();
}
public function getAllJobForuser(){
        $this->db->order_by("deadline", "desc");
        $query = $this->db->get('job_upload_tb');
        return $query->result_array();
}

public function deleteJobbyid($id){
    $this->db->where('id',$id);
    $status=$this->db->delete('job_upload_tb');
    return $status;
}

public function getJobuserbyid($jid){

      $this->db->where("id", $jid);
        $query = $this->db->get('job_upload_tb');
        return $query->result_array();

}

public function updatevjobiot($data,$jobiid){
     $this->db->where("id", $jobiid);
    $updatedata = $this->db->update('job_upload_tb', $data);
      return $updatedata;     
}

}
