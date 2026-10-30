<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class DesigModel extends CI_Model{

    public function __construct(){ 
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
        //$this->load->helper('url');
    }

    public function getDesignationList()
    {
        $query = $this->db->get('designations');
        return $query->result();
    }

    public function getActiveDesignationList()
    {   $this->db->where('status',1) ;
        $query = $this->db->get('designations');
        return $query->result();
    }

    public function getDesigListByUserType($id){
        $this->db->where('user_type_id',$id) ;
        $query = $this->db->get('designations');
        return $query->result();
    }

    public function getDesigTitleById($id){
        $title='nil' ;
        $this->db->where('desig_id',$id) ;
        $query = $this->db->get('designations');
        $result=$query->result();
        foreach($result as $row){
            $title=$row->title ;
        }
        return $title ;
    }

    public function getDesignationById($id){
        $data=array() ;
        $this->db->where('desig_id',$id) ;
        $query = $this->db->get('designations');
        $result=$query->result();
        foreach($result as $row){
            $data=array(
                'desig_id'=> $row->desig_id,
                'title'=> $row->title,
                'description'=> $row->description,
                'user_type_id'=> $row->user_type_id,
                'status'=> $row->status,
                'last_updated_on'=> date('d-m-Y',strtotime($row->last_updated_on)),
                'created_on'=> date('d-m-Y',strtotime($row->created_on))
            );
        }
        return $data ;
    }

    public function insertDesignation($title,$description,$user_type_id){
        $desigid=0 ;
        $data = array(
                    'title'=>$title,
                    'description'=>$description,
                    'user_type_id'=>$user_type_id
                );
        $this->db->insert('designations', $data);
        $desigid=$this->db->insert_id();
        return $desigid; 
    }

    public function updateDesignation($desig_id,$title,$description,$user_type_id){
        $data = array(
                    'title'=>$title,
                    'description'=>$description,
                    'user_type_id'=>$user_type_id
                );
        $this->db->where('desig_id',$desig_id);
        $ustatus=$this->db->update('designations',$data);
        return $ustatus; 
    }
}
?>