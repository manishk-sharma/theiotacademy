<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');



class AppliedMlIoTByeictIitGuwagatModel extends CI_Model

{

    public function __construct(){

        parent::__construct();

        $this->load->database();

        $this->load->library('session'); 

        date_default_timezone_set('Asia/Kolkata');

    }



    public function DownloadMLWithIotBroucherForm($data)

    {

        $this->db->set('created_on', 'NOW()', FALSE);

		$this->db->insert('leads', $data);

		$enqid=$this->db->insert_id();

		return $enqid;

    }

	public function isEmailExistsAppliedMlIotIIG($new_email_id){

        $count=0 ;

        $this->db->where('email_id',$new_email_id);

        $query = $this->db->get('leads');

        $result=$query->result();

        $count=count($result) ;

        if($count>1){

            return TRUE ;

        }else{

            return FALSE ;

        }

    }

//mliotregistrationfun 
    public function getRecordById($id){
        $this->db->where('application_no',$id) ;
        $query = $this->db->get('iitg_application_form_data');
        $result=$query->result();
        $data=array();
        foreach ($result as $row) {
            $data = array(
                'applicant_name'=>$row->$applicant_name,
                'applicant_mobile'=>$row->$applicant_mobile,
                'applicant_email'=>$row->$applicant_email,
                'applicant_degree'=>$row->$applicant_degree,
                'applicant_university'=>$row->$applicant_university,
                'applicant_work_exp'=>$row->$applicant_work_exp,
                'applicant_industry'=>$row->$applicant_industry,
                'applicant_sop'=>$row->$applicant_sop,
                //'applicant_resume'=>$row->$applicant_resume,
                'applicant_came_from'=>$row->$applicant_came_from,
                'applicant_url_source'=>$row->$applicant_url_source,
                'applicant_created_at'=>$row->applicant_created_at,
            );
        }
        return $data;
    }

    public function SubmitMlIotRegistrationForm($data)

    {
        $this->db->set('applicant_created_at', 'NOW()', FALSE);
        $this->db->insert('iitg_application_form_data', $data);
        $enqid=$this->db->insert_id();
        return $enqid;
    }

    public function updateResumeByID($id,$resume_name){
        $data = array('applicant_resume'=>$resume_name);
        $this->db->where('application_no',$id);
        $status=$this->db->update('iitg_application_form_data',$data);
        return $status;
    }

    public function isEmailExistRegistrationMlIotIIG($new_applicant_email){
        $count=0 ;
        $this->db->where('applicant_email',$new_email_id);
        $query = $this->db->get('iitg_application_form_data');
        $result=$query->result();
        $count=count($result) ;
        if($count>1){
            return TRUE ;
        }else{
            return FALSE ;
        }
    }
//end mliotregistration   
public function isEmailExistspecialcorporate($special_email){
        $count=0 ;
        $this->db->where('email',$special_email);
        $query = $this->db->get('s_corporate_enrollment');
        $result=$query->result();
        $count=count($result) ;
        if($count>8){
            return TRUE ;
        }else{
            return FALSE ;
        }
    } 
public function SpCorporateRegistrationForm($data)

    {
        $this->db->set('created_date', 'NOW()', FALSE);
        $this->db->insert('s_corporate_enrollment', $data);
        $enqid=$this->db->insert_id();
        return $enqid;
    }

}

?>