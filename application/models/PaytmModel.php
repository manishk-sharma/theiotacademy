<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class PaytmModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
    }


    public function insertPaymentResopnse($data)
    {
    	$this->db->insert('payment_details', $data);

    	$paymentid=$this->db->insert_id();

    	//echo "<br>$paymentid";
        
        return true;
    }


}
?>