<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class industrialInternshipModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
        //$this->load->helper('url');
    }

    public function saveEnquaryToDB($order_id,$first_name,$last_name,$email_id,$mobile_num,$college_name,$year,$selected_technology,$message,$category,$txn_ammount){
		$data = array(
			'ORDERID '=>$order_id,
	        'first_name'=>$first_name,
	        'last_name'=>$last_name,
			'email_id'=>$email_id,
			'mobile_num'=>$mobile_num,
			'college_name'=>$college_name,
			'year'=>$year,
			'technology'=>$selected_technology,
			'category'=>$category,
			'txn_ammount'=>$txn_ammount,
			'message'=>$message			
		);
		$this->db->insert('internship_details',$data);
		$enqid=$this->db->insert_id();
		return $enqid;
	}


	public function getInternByOrderId($order_id)
    {
    	
        $this->db->where('ORDERID', $order_id);
        
        $query = $this->db->get('internship_details');

        $result = $query->result();      

        foreach ($result as $row) {
           
           $data=array(

            'ORDERID'=> $row->ORDERID,

            'first_name'=> $row->first_name,

            'last_name'=>$row->last_name,

            'email_id'=>$row->email_id,

            'mobile_num'=>$row->mobile_num,

            'college_name'=>$row->college_name,

            'year'=>$row->year,

            'technology'=>$row->technology,

            'category'=>$row->category,

            'txn_ammount'=>$row->txn_ammount, 

            'message'=>$row->message
            );

        }

        return $data;

    }
}
?>