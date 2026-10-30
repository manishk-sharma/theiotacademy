<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');



class LiveLeadModel extends CI_Model

{

    public function __construct(){

        parent::__construct();

        $this->load->database();

        $this->load->library('session'); 

        date_default_timezone_set('Asia/Kolkata');

    }

    

    public function get_all_leads(){
        $this->db->order_by('id','DESC');
		$this->db->limit(3000);
		$query = $this->db->get('leads');
        return $query->result_array();

	}
    public function getDataForCSVleads() {
        $this->db->order_by('id','DESC');
        $query = $this->db->get('leads');
        return $query->result_array();
    }

    public function appli_details_leads(){
        $this->db->order_by('application_no','DESC');
        $this->db->limit(1500);
        $query = $this->db->get('iitg_application_form_data');
        return $query->result_array();

    }
    
    public function applied_job_details(){
        $this->db->distinct();
        $this->db->order_by('id','DESC');
        $this->db->limit(1500);
        $query = $this->db->get('emp_apply_job');
        return $query->result_array();
    }

    public function insertLiveLead($data){
		//$this->db->set('created_on', 'NOW()', FALSE);
		$this->db->insert('leads', $data);
		$enqid=$this->db->insert_id();

		return $enqid;

	}


    public function insertblogcomment($data){
        $this->db->set('created_on', 'NOW()', FALSE);
        $this->db->insert('leads', $data);
        $commid=$this->db->insert_id();
        return $commid;
    }

    public function insertLiveCallLead($data){

        $this->db->set('created_date', 'NOW()', FALSE);

        $this->db->insert('get_callback_leads', $data);

        $callenqid=$this->db->insert_id();

        return $callenqid;

    }





    public function insert_joinnews_Lead($data){

        

        $this->db->set('inserted_date', 'NOW()', FALSE);

        $this->db->insert('newsletters', $data);

        $joinnewsid=$this->db->insert_id();

        return $joinnewsid;

    }



    public function isEmailExistsInNewsletters($new_email_id){

        $count=0;
        $this->db->where('email_id',$new_email_id);
        $query = $this->db->get('newsletters');
        $result=$query->result();
        $count=count($result) ;
        if($count>0){
            return TRUE ;
        }else{
            return FALSE ;
        }
    }

   public function isextisquizmail($email){
    $count=0;
    $this->db->where('email',$email);
    $query = $this->db->get('quiz');
    $result=$query->result();
    $count=count($result) ;
    if($count>5){
        return TRUE ;
    }else{
        return FALSE ;
    }
   }
   public function homequizsubmit($data){
    $this->db->insert('quiz', $data);
    $quiz_id=$this->db->insert_id();
    return $quiz_id;
} 

    

    public function onlineformregistration($data){
        $this->db->set('created_on', 'NOW()', FALSE);
        $this->db->insert('online_registration', $data);
        $registerid=$this->db->insert_id();
        return $registerid;
    }



    //online registration exits

    public function isEmailExists_online_registration($student_email){

        $count=0 ;

        $this->db->where('student_email',$student_email);

        $query = $this->db->get('online_registration');

        $result=$query->result();

        $count=count($result) ;

        if($count>0){

            return TRUE ;

        }else{

            return FALSE ;

        }  

    }

    //end online registration exists

    

    

    // start book free demo model and exit book free demo model

    

    public function book_free_demo_register($data){

        

        $this->db->set('created_on', 'NOW()', FALSE);

        $this->db->insert('book_free_demo', $data);

        $bookdemoid=$this->db->insert_id();

        return $bookdemoid;

    }

public function insert_welcome_kit($data){
        $this->db->insert('welcome_kit', $data);
        $welid=$this->db->insert_id();
        return $welid;   
}

    //book free demo exits

    public function isEmailExists_bookfreedemo($student_email){

        $count=0 ;

        $this->db->where('student_email',$student_email);

        $query = $this->db->get('book_free_demo');

        $result=$query->result();

        $count=count($result) ;

        if($count>0){

            return TRUE ;

        }else{

            return FALSE ;

        }  

    }

   // end book free demo model and exit book free demo model
    public function insertSeedFundApplication($data){
        $this->db->insert('seed_fund_application', $data);
		$enqid=$this->db->insert_id();
		return $enqid;
    }
    

    

}?>