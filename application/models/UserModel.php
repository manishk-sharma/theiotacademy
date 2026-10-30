<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
        //$this->load->helper('url');
	}

	public function getUserList(){
        $query = $this->db->get('users');
        return $query->result();
    }

    public function updateEmailIdByUserId($user_id,$email_id){
        $data=array('email_id'=>$email_id);
        $this->db->where('user_id',$user_id);
        $ustatus=$this->db->update('users',$data);
        return $ustatus ;
    }

    public function isEmailExistsInUsers($new_email_id){
        $count=0 ;
        $this->db->where('email_id',$new_email_id); ;
        $query = $this->db->get('users');
        $result=$query->result();
        $count=count($result) ;
        if($count>0){
            return TRUE ;
        }else{
            return FALSE ;
        }
    }

    public function getUserShortInfoById($id){
        $data=array() ;
        $this->db->where('user_id',$id) ;
        $query = $this->db->get('users');
        $result=$query->result();
        foreach($result as $row){
            $data=array(
                'user_id'=> $row->user_id,
                'email_id'=> $row->email_id,
                'user_type_id'=> $row->user_type_id,
                'status'=> $row->status,
            );
        }
        return $data ;
    }

    public function getEmailByUserId($id){
        $email_id="nil" ;
        $this->db->where('user_id',$id) ;
        $query = $this->db->get('users');
        $result=$query->result();
        foreach($result as $row){
            $email_id=$row->email_id ;
        }
        return $email_id ;
    }

   public function getUserInfoById($id){
        $data=array() ;
        $this->db->where('user_id',$id) ;
        $query = $this->db->get('users');
        $result=$query->result();
        foreach($result as $row){
            $data=array(
                'user_id'=> $row->user_id,
                'email_id'=> $row->email_id,
                'password'=> $row->password,
                'user_type_id'=> $row->user_type_id,
                'status'=> $row->status,
                'created_by'=> $row->created_by,
                'last_updated_on'=> date('d-m-Y',strtotime($row->last_updated_on)),
                'created_on'=> date('d-m-Y',strtotime($row->created_on))
            );
        }
        return $data ;
    }

    public function insertUser($email_id,$password,$user_type_id){
        $userid=0 ;
        $data = array(
            'email_id'=>$email_id,
            'password'=>md5($password),
            'user_type_id'=>$user_type_id
        );
        $this->db->insert('users', $data);
        $userid=$this->db->insert_id();
        return $userid; 
    }


    public function resetPassword($email_id,$password)
    {
         $data = array(
             'password'=>md5($password),
        );

        $this->db->where('email_id',$email_id) ;

        $status=$this->db->update('users', $data);
        return $status;
       

       
    }


}
?>