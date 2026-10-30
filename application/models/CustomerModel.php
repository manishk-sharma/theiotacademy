<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class CustomerModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
    }


    public function saveCustmer($first_name,$last_name,$email_id,$mobile_num,$order_id,$quantity,$batch_event_type,$batch_event_id,$discount_code,$txn_ammount)
    {
        $data=array(
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'email_id'=>$email_id,
            'mobile_num'=>$mobile_num,
            'ORDERID '=>$order_id,
            'quantity'=>$quantity,
            'batch_event_type'=>$batch_event_type,
            'batch_event_id'=>$batch_event_id,
            'discount_name'=>$discount_code,
            'txn_ammount'=>$txn_ammount
        );

    	$this->db->insert('cust_details', $data);
        
        return $this->db->insert_id();
    }



    public function getCustmerByOrderId($order_id)
    {

        $this->db->where('ORDERID', $order_id);
        
        $query = $this->db->get('cust_details');

        $result = $query->result();

        $data=array();

        foreach ($result as $row) {
           
            $data=array(

            'first_name'=>$row->first_name,
            'last_name'=>$row->last_name,
            'email_id'=>$row->email_id,
            'mobile_num'=>$row->mobile_num,
            'quantity'=>$row->quantity,
            'batch_event_type'=>$row->batch_event_type,
            'batch_event_id'=>$row->batch_event_id,
            'discount_name'=>$row->discount_name
            
            );

        }

        return $data;

    }


}
?>