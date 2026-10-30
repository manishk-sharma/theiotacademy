<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class PaymentModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
        //$this->load->helper('url');
    }

    public function getPaymentList()
    {
        $query = $this->db->get('payments');
        return $query->result();
    }

    public function getPaymentListByRegId($reg_id)
    {   $this->db->where('reg_id',$reg_id) ;
        $query = $this->db->get('payments');
        return $query->result();
    }

    public function insertPayment($reg_id,$fee_amount,$tax_amount,$net_amount,$payment_mode,$payment_type,$trans_date,$trans_status,$inst_number,$inst_date,$inst_amount,$inst_bank,$remarks){
        $data = array(
            'reg_id'=>$reg_id,
            'fee_amount'=>$fee_amount,
            'tax_amount'=>$tax_amount,
            'net_amount'=>$net_amount,
            'payment_mode'=>$payment_mode,
            'payment_type'=>$payment_type,
            'trans_date'=>$trans_date,
            'trans_status'=>$trans_status,
            'inst_number'=>$inst_number,
            'inst_date'=>$inst_date,
            'inst_amount'=>$inst_amount,
            'inst_bank'=>$inst_bank,
            'remarks'=>$remarks
        );
        $this->db->insert('payments', $data);
        $payid=$this->db->insert_id();
        return $payid; 
    } 

    public function updatePayment($pay_id,$reg_id,$fee_amount,$tax_amount,$net_amount,$payment_mode,$payment_type,$trans_date,$trans_status,$inst_number,$inst_date,$inst_amount,$inst_bank,$remarks){
        $data = array(
            'reg_id'=>$reg_id,
            'fee_amount'=>$fee_amount,
            'tax_amount'=>$tax_amount,
            'net_amount'=>$net_amount,
            'payment_mode'=>$payment_mode,
            'payment_type'=>$payment_type,
            'trans_date'=>$trans_date,
            'trans_status'=>$trans_status,
            'inst_number'=>$inst_number,
            'inst_date'=>$inst_date,
            'inst_amount'=>$inst_amount,
            'inst_bank'=>$inst_bank,
            'remarks'=>$remarks
        );
        $this->db->where('pay_id',$pay_id);
        $ustatus=$this->db->update('payments', $data);
        return $ustatus; 
    } 

    public function getPaymentById($id){
        $data=array() ;
        $this->db->where('pay_id',$id) ;
        $query = $this->db->get('payments');
        $result=$query->result();
        foreach($result as $row){
            $data=array(
                'pay_id'=> $row->pay_id,
                'payment_id'=> $row->payment_id,
                'reg_id'=>$row->reg_id,
                'fee_amount'=>$row->fee_amount,
                'tax_amount'=>$row->tax_amount,
                'net_amount'=>$row->net_amount,
                'payment_mode'=>$row->payment_mode,
                'payment_type'=>$row->payment_type,
                'trans_date'=>$row->trans_date,
                'trans_status'=>$row->trans_status,
                'inst_number'=>$row->inst_number,
                'inst_date'=>$row->inst_date,
                'inst_amount'=>$row->inst_amount,
                'inst_bank'=>$row->inst_bank,
                'remarks'=>$row->remarks,
                'status'=>$row->status,
                'last_updated_on'=> date('d-m-Y',strtotime($row->last_updated_on)),
                'created_on'=> date('d-m-Y',strtotime($row->created_on))
            );
        }
        return $data ;
    }

    public function updatePaymentStatus($pay_id,$trans_status){
        $data=array('trans_status'=>$trans_status);
        $this->db->where('pay_id',$pay_id);
        $ustatus=$this->db->update('payments',$data);
        return $ustatus ;
    }

    public function updatePaymentId($pay_id){
    	$payment_id=$this->getPaymentIdString($pay_id) ;
        $data=array('payment_id'=>$payment_id);
        $this->db->where('pay_id',$pay_id);
        $ustatus=$this->db->update('payments',$data);
        if($ustatus==1){
        	return $payment_id ;
        }else{
        	return $ustatus ;
        }
    }

    public function getPaymentIdString($id){
		$req_id_len=5 ;  //required id length
		$actual_id_len=strlen($id) ; //length of enq_id
        if($actual_id_len>$req_id_len){
            $req_id_len=$actual_id_len ;
        }
		$len_diff=$req_id_len-$actual_id_len ;
		$req_id='' ;
		for($i=0; $i<$len_diff; $i++){
			$req_id.='0' ;
		}
		$payment_id="P".$req_id.$id ;
		return $payment_id ;
	}

}
?>