<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');



class CareersInstractorsModel extends CI_Model

{

    public function __construct(){

        parent::__construct();

        $this->load->database();

        $this->load->library('session'); 

        //$this->load->helper('url');

    }



    public function insertLiveCareer($user_id,$email_id,$pass_key){

    	$pass_key=md5($pass_key);

		$data = array(

			// 'user_id'=>$user_id,

	        

			'email_id'=>$email_id,

			

			// 'pass_key'=>$pass_key	

		);

		$this->db->insert('careers',$data);

		$enqid=$this->db->insert_id();

		return $enqid;

	}





	



	public function CheckPasswordStatus($pass_key)

	{

		$data['status']=false;



		$this->db->where('pass_key',$pass_key);



		$query=$this->db->get('careers');



		$result=$query->result();



		if (count($result)>0) {



			foreach ($result as $row) {

			

				$id=$row->id;

				$email_id=$row->email_id;

				$password_flag=$row->password_flag;



			}

			if($password_flag==0){



				$data['id']=$id;

				$data['status']=true;

				$data['email_id']=$email_id;

			}

		}



		return $data;

	}



	



	public function resetPasswordInstructor($email_id,$password)

    {

         $data = array(

             'password'=>md5($password),

        );

        $this->db->where('email_id',$email_id) ;



        $status=$this->db->update('users', $data);



        if($status){



        	$flag = $this->changePasswordflag($email_id);

        }



        return $flag;

    }





    public function changePasswordflag($email_id)

    {

         $data = array(

             'password_flag'=>true,

        );

        $this->db->where('email_id',$email_id) ;



        $status=$this->db->update('careers', $data);



        return $status;       

    }





}

?>