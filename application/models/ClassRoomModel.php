<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class ClassRoomModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        //$this->load->model('RegisterModel');
        $this->load->library('session'); 
        //$this->load->helper('url');
    }

    public function getClassRoomList()
    {
        $query = $this->db->get('classrooms');
        return $query->result();
    }

    public function getClassRoomById($id){
        $data=array() ;
        $this->db->where('cr_id',$id) ;
        $query = $this->db->get('classrooms');
        $result=$query->result();
        foreach($result as $row){
            $data=array(
                'cr_id'=> $row->cr_id,
                'classroom_id'=> $row->classroom_id,
                'title'=> $row->title,
                'status'=> $row->status,
                'last_updated_on'=> date('d-m-Y',strtotime($row->last_updated_on)),
                'created_on'=> date('d-m-Y',strtotime($row->created_on))
            );
        }
        return $data ;
    }

    public function insertClassRoom($title){
        $crid=0 ;
        $data = array('title'=>$title);
        $this->db->insert('classrooms', $data);
        $crid=$this->db->insert_id();
        return $crid; 
    }

    public function updateClassRoom($cr_id,$title){
        $data = array('title'=>$title);
        $this->db->where('cr_id',$cr_id);
        $ustatus=$this->db->update('classrooms',$data);
        return $ustatus; 
    }

    public function updateClassRoomId($cr_id){
        $classroom_id=$this->getClassRoomIdString($cr_id) ;
        $data=array('classroom_id'=>$classroom_id);
        $this->db->where('cr_id',$cr_id);
        $ustatus=$this->db->update('classrooms',$data);
        if($ustatus==1){
            return $classroom_id ;
        }else{
            return $ustatus ;
        }
    }

    public function getClassRoomIdString($id){
        $req_id_len=2 ;  //required id length
        $actual_id_len=strlen($id) ; //length of enq_id
        $len_diff=$req_id_len-$actual_id_len ;
        $req_id='' ;
        for($i=0; $i<$len_diff; $i++){
            $req_id.='0' ;
        }
        $classroom_id="CR".$req_id.$id ;
        return $classroom_id ;
    }

}
?>