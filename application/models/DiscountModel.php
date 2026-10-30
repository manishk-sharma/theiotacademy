<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');



class DiscountModel extends CI_Model  

{

    public function __construct(){

        parent::__construct();

        $this->load->database();

        $this->load->library('session'); 

        //$this->load->helper('url'); 

    }

// GET ALL DISCOUNT LIST
    public function getDiscountList(){
    	
    	$query = $this->db->get('batch_discount');
        return $query->result();
    }

// GET DISCOUNT BY DISCOUNT ID
    public function getDiscountById($id)
    {
    	
    	$this->db->where('discount_id',$id);

    	$query = $this->db->get('batch_discount');

    	$result = $query->result();

        $data=array();

    	foreach ($result as $row) {

    		$data=array( 

    			'discount_id'=>$row->discount_id,

                'discount_name'=>$row->discount_name, 

				'discount_date'=>$row->discount_date, 

				'discount_rate'=>$row->discount_rate, 

				'auto_manual'=>$row->auto_manual, 

				'batch_event_type'=>$row->batch_event_type, 

				'batch_event_id'=>$row->batch_event_id, 

				'description'=>$row->description

            );
    	}

        return $data;

    }

// GET DISCOUNT BY EVENT/BATCH ID
    public function getAllDiscountEventBatchId($id)
    {
        $bigData=array();
        
        $data=array();

        $this->db->where('batch_event_id',$id);

        $this->db->where('status',1);

        $query = $this->db->get('batch_discount');

        $result = $query->result();

        foreach ($result as $row) {

            $data=array( 
                
                'discount_id'=>$row->discount_id,
                
                'discount_name'=>$row->discount_name, 
                
                'discount_date'=>$row->discount_date, 
                
                'discount_rate'=>$row->discount_rate, 
                
                'auto_manual'=>$row->auto_manual, 
                
                'description'=>$row->description
            );

            array_push($bigData, $data);

        }

        return $bigData ;

    }

// GET DISCOUNT BY EVENT/BATCH ID
    public function getAutoDiscountEventBatchId($id)
    {
        
        $data=array();

        $condition=array('batch_event_id'=>$id,'auto_manual'=>0,'status'=>1);
        
        $this->db->where($condition);

        $query = $this->db->get('batch_discount');

        $result = $query->result();

        //if(count($result)>0)

        foreach ($result as $row) {

            $data=array( 
                
                'discount_id'=>$row->discount_id,
                
                'discount_name'=>$row->discount_name, 
                
                'discount_date'=>$row->discount_date, 
                
                'discount_rate'=>$row->discount_rate, 
                
                'auto_manual'=>$row->auto_manual, 
                
                'description'=>$row->description
            );

        }

        return $data ;

    } 


    public function getDiscountByNameAndEventId($batch_event_type,$batch_event_id,$discount_name)
    {
        $data=array();

        $condition=array('batch_event_type'=>$batch_event_type,'batch_event_id'=>$batch_event_id,'discount_name'=>$discount_name);
        
        $this->db->where($condition);

        $query = $this->db->get('batch_discount');

        $result = $query->result();

        if(count($result)>0){

           foreach ($result as $row) {

                return $row->discount_rate;

            }

        }
        else{

            return false;
        }

        

    }



    public function isInsertExistsInDB($auto_manual,$batch_event_type,$batch_event_id)
        {
        echo "$auto_manual<br>";
        echo "$batch_event_type<br>";
        echo "$batch_event_id";

        $this->db->where(
            array(
                    'auto_manual'=>$auto_manual,

                    'batch_event_type'=>$batch_event_type,

                    'batch_event_id' => $batch_event_id
                ));

        $query = $this->db->get('batch_discount');

        if ($query->num_rows() > 0 && $auto_manual==0){

           return true;
        }

        else{

           return false;

        }
       
    }


// INSERT DISCOUNT DATA
    public function insertDiscountData($discount_name,$discount_date,$discount_rate,$auto_manual,$batch_event_type,$batch_event_id,$description){

    	$data = array(

			
            'discount_name'=>$discount_name, 
			
            'discount_date'=>$discount_date, 
			
            'discount_rate'=>$discount_rate, 
			
            'auto_manual'=>$auto_manual, 
			
            'batch_event_type'=>$batch_event_type, 
			
            'batch_event_id'=>$batch_event_id, 
			
            'description'=>$description

		);


		$this->db->insert('batch_discount', $data);

		$discount_id=$this->db->insert_id();

		return $discount_id;
    	
    }

//UPDATE DISCOUNT DATA
    public function updateDiscount($discount_id,$udiscount_name,$udiscount_date,$udiscount_rate,$uauto_manual,$ubatch_event_type,$ubatch_event_id,$udescription){

    	$data = array(

			
            'discount_name'=>$udiscount_name, 
			
            'discount_date'=>$udiscount_date, 
			
            'discount_rate'=>$udiscount_rate, 
			
            'auto_manual'=>$uauto_manual, 
			
            'batch_event_type'=>$ubatch_event_type, 
			
            'batch_event_id'=>$ubatch_event_id, 
			
            'description'=>$udescription

		);

    	$this->db->where('discount_id',$discount_id);

        $ustatus=$this->db->update('batch_discount',$data);

        return $ustatus; 
    	
    }

//CHANE DISCOUNT STATUS
    public function updateDiscountStatus($discount_id,$status){

        $data = array('status'=>$status);

        $this->db->where('discount_id',$discount_id);

        $ustatus=$this->db->update('batch_discount',$data);

        return $ustatus; 

    }



//FOR UPDATE, CHECK BATCH OR EVENT IS ALREADY EXISTS OR NOT 
    public function isUpdateExistsInDB($discount_id,$auto_manual,$batch_event_type,$batch_event_id)
    {
        echo "$auto_manual<br>";
        echo "$batch_event_type<br>";
        echo "$batch_event_id";

        $this->db->where(
            array(
                    'auto_manual'=>$auto_manual,

                    'batch_event_type'=>$batch_event_type,

                    'batch_event_id' => $batch_event_id
                ));

        if($discount_id) {
            $this->db->where_not_in('discount_id', $discount_id);
        }

        $query = $this->db->get('batch_discount');

        if ($query->num_rows() > 0 && $auto_manual==0){

           return true;
        }

        else{

           return false;

        }
       
    }




}?>