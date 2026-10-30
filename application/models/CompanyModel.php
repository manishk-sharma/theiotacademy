<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class CompanyModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
    }

    public function getCompanyList()
    {
        $query = $this->db->get('company_master');
        return $query->result();
    }

    public function checkUniqueCompanyNameForUpdate($comp_id = '', $company_name) {
        $this->db->where('company_name', $company_name);
        if($comp_id) {
            $this->db->where_not_in('comp_id', $comp_id);
        }
        return $this->db->get('company_master')->num_rows();
    }

    public function insertCompany($company_name,$pan_no,$gst_no,$website,$remark,$email_id,$contact_no,$alt_contact_no,$company_addr){
        $data = array(
            'company_name'=>$company_name,
            'pan_no'=>$pan_no,
            'gst_no'=>$gst_no,
            'website'=>$website,
            'remark'=>$remark,
            'email_id'=>$email_id,
            'contact_no'=>$contact_no,
            'alt_contact_no'=>$alt_contact_no,
            'company_addr'=>$company_addr
        );
        $this->db->insert('company_master', $data);
        $compid=$this->db->insert_id();
        return $compid; 
    }

    public function updateCompany($comp_id,$company_name,$pan_no,$gst_no,$website,$remark,$email_id,$contact_no,$alt_contact_no,$company_addr){
        $data = array(
            'company_name'=>$company_name,
            'pan_no'=>$pan_no,
            'gst_no'=>$gst_no,
            'website'=>$website,
            'remark'=>$remark,
            'email_id'=>$email_id, 
            'contact_no'=>$contact_no,
            'alt_contact_no'=>$alt_contact_no,
            'company_addr'=>$company_addr
        );
        $this->db->where('comp_id',$comp_id);
        $ustatus=$this->db->update('company_master', $data);
        return $ustatus; 
    } 

    public function getCompanyById($id){
        $data=array() ;
        $this->db->where('comp_id',$id) ;
        $query = $this->db->get('company_master');
        $result=$query->result();
        foreach($result as $row){
            $data = array(
                'comp_id'=>$row->comp_id,
                'company_name'=>$row->company_name,
                'pan_no'=>$row->pan_no,
                'gst_no'=>$row->gst_no,
                'website'=>$row->website,
                'remark'=>$row->remark,
                'email_id'=>$row->email_id,
                'contact_no'=>$row->contact_no,
                'alt_contact_no'=>$row->alt_contact_no,
                'company_addr'=>$row->company_addr,
                'logo'=>$row->logo,
                'status'=>$row->status,
                
            );
        }
        return $data ;
    }

}
?>