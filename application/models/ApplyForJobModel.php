<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');



class ApplyForJobModel extends CI_Model

{

    public function __construct(){

        parent::__construct();

        $this->load->database();

        $this->load->library('session'); 

        date_default_timezone_set('Asia/Kolkata');

    } 



    public function getRecordById($id){

        $this->db->where('id',$id) ;

        $query = $this->db->get('emp_apply_job');

        $result=$query->result();

        $data=array();

        foreach ($result as $row) {

            $data = array(



                'emp_name'=>$row->emp_name,

                'emp_mobile'=>$row->emp_mobile,

                'emp_email'=>$row->emp_email,

                'emp_resume'=>$row->emp_resume,

                'emp_job_category'=>$row->emp_job_category,

                'url_source'=>$row->url_source,

                'created_date'=>$row->created_date,

            );

        }

        return $data;

    }


    public function isemployeedetailsmatch($emp_mobile,$emp_email,$emp_job_category){
        $this->db->where('emp_mobile', $emp_mobile);
         $this->db->where('emp_email', $emp_email);
         $this->db->where('emp_job_category', $emp_job_category);
         $query = $this->db->get('emp_apply_job');
         $result=$query->result();
         $data=array();
         foreach ($result as $row) {
             $data = array(
                 'emp_name'=>$row->emp_name,
                 'emp_mobile'=>$row->emp_mobile,
                 'emp_email'=>$row->emp_email,
                 'emp_resume'=>$row->emp_resume,
                 'emp_job_category'=>$row->emp_job_category,
                 'url_source'=>$row->url_source,
                 'created_date'=>$row->created_date,
             );
         }
         return $data;
    } 


   //start apply job model and exits apply job model

    public function applyJobAapplicationRegister($data){

        $this->db->set('created_date', 'NOW()', FALSE);

        $this->db->insert('emp_apply_job', $data);

        $emp_job_id=$this->db->insert_id();

        return $emp_job_id;

    }



    public function updateResumeByID($id,$resume_name){

        $data = array('emp_resume'=>$resume_name);

        $this->db->where('id',$id);

        $status=$this->db->update('emp_apply_job',$data);

        return $status;

    }



}?>