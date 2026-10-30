<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');


class AdmincreatePlanModel extends CI_Model

{

	public function check_user($email)
    {
        $this->db->where("user_email",$email);
        $query = $this->db->get('payment_admin');
        if($query->num_rows() > 0)
        {
            
          $data = $query->row_array();
           return $data;
        }
        else
        {   
           return false;
        }
        
    }


}

?>