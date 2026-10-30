<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class AppModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
        //$this->load->helper('url');
    }

//-------------Function For Login-----------------------
    public function authenticate($email_id,$password,$ip)
    {   
        $this->db->where('email_id',$email_id);

        $this->db->where('password',md5($password));
        //$this->db->where('status',1);

        $query = $this->db->get('users');

        if($query->num_rows()==1){

            foreach ($query->result() as $row){

                if ($row->status==true) {
                   
                   if($row->user_type_id==4){

                    $data = array(
                        'email_id'=>$row->email_id,
                        'user_id'=>   $row->user_id,
                        'user_type_id'=>$row->user_type_id,
                        'logged_in'=>TRUE
                    );

                    }elseif($row->user_type_id==3){
                        //$empinfo=$this->EmployeeModel->getEmployeeDetailsByUserId($row->user_id);
                        $data = array(
                            'email_id'=>$row->email_id,
                            'user_id'=>   $row->user_id,
                            'user_type_id'=>$row->user_type_id,
                            //'desig_id'=>$empinfo['desig_id'],
                            'login_access'=>true,
                            'logged_in'=>TRUE
                        );
                    }else{
                        $empinfo=$this->EmployeeModel->getEmployeeDetailsByUserId($row->user_id);
                        $data = array(
                            'email_id'=>$row->email_id,
                            'user_id'=>   $row->user_id,
                            'user_type_id'=>$row->user_type_id,
                            'desig_id'=>$empinfo['desig_id'],
                            'logged_in'=>TRUE
                        );
                    }

                }else{  //in user table ststus column is deactive !!

                    if($row->user_type_id==3){

                        $data = array(
                            'email_id'=>$row->email_id,
                            'user_id'=>   $row->user_id,
                            'user_type_id'=>$row->user_type_id,
                            'login_access'=>false,
                            'logged_in'=>TRUE
                        );
                    }
                }
                
            }

            if($email_id==$data['email_id']){
                $this->session->set_userdata($data);
                return TRUE;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }
//----------------------------------------------

}
?>