 <?php
 if(!defined('BASEPATH')) exit('No direct script access allowed');

class Payment_Training_Model extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
        date_default_timezone_set('Asia/Kolkata');
    }
    
    public function insert_Share_payment_dtc($data){
		$this->db->insert('payment_details_training', $data);
		$enqid=$this->db->insert_id();
		return $enqid;
    }

    public function updatePaymentFileByID($id,$file_name){

        $data = array('screenshot'=>$file_name);

        $this->db->where('id',$id);

        $status=$this->db->update('payment_details_training',$data);

        return $status;

    }

    public function getRecordById($id){

        $this->db->where('id',$id) ;

        $query = $this->db->get('payment_details_training');

        $result=$query->result();

        $data=array();
        foreach ($result as $row) {

            $data = array(
                'name'=>$row->name,
                'email'=>$row->email,
                'mobile'=>$row->mobile,
                'program_name'=>$row->program_name,
                'college_name'=>$row->college_name,
                'location'=>$row->location,
                'url_source'=>$row->url_source,
                'created_date'=>$row->created_at,

            );

        }

        return $data;

    }

}
