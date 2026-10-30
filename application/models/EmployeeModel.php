<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class EmployeeModel extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
    }

    public function getEmployeeList(){

        $query = $this->db->get('employees');
        return $query->result();
    }
    
    public function insertEmployee($fname,$lname,$gender,$birth_date,$mobile_no,$desig_id,$description,$facebook_link,$twitter_link,$linkedin_link,$user_id){
        $data = array(
            'first_name'=>$fname,
            'last_name'=>$lname,
            'gender'=>$gender,
            'birth_date'=>$birth_date,
            'mobile_no'=>$mobile_no,
            'desig_id'=>$desig_id,
            'description'=>$description,
            'facebook_link'=>$facebook_link,
            'twitter_link'=>$twitter_link,
            'linkedin_link'=>$linkedin_link,
            'user_id'=>$user_id
        );
        $this->db->insert('employees', $data);
        $empid=$this->db->insert_id();
        return $empid; 
    } 

    public function updateEmployee($emp_id,$fname,$lname,$gender,$birth_date,$mobile_no,$desig_id,$description,$facebook_link,$twitter_link,$linkedin_link){
        $data = array(
            'first_name'=>$fname,
            'last_name'=>$lname,
            'gender'=>$gender,
            'birth_date'=>$birth_date,
            'mobile_no'=>$mobile_no,
            'desig_id'=>$desig_id,
            'description'=>$description,
            'facebook_link'=>$facebook_link,
            'twitter_link'=>$twitter_link,
            'linkedin_link'=>$linkedin_link
        );
        $this->db->where('emp_id',$emp_id);
        $ustatus=$this->db->update('employees',$data);
        return $ustatus; 
    } 

    public function getEmployeeFirstNameByUserId($id){
        $first_name="nil" ;
        $this->db->where('user_id',$id) ;
        $query = $this->db->get('employees');
        $result=$query->result();
        foreach($result as $row){
          $first_name=$row->first_name ;
        }
        return $first_name ;
    }

    public function getEmployeeFullNameByUserId($id){
        $full_name='nil';
        $this->db->where('user_id',$id) ;
        $query = $this->db->get('employees');
        $result=$query->result();
        foreach($result as $row){

          $full_name=$row->first_name.' '.$row->last_name;

          
        }
       return $full_name;
    }

    public function getEmployeeFullNameById($id){
        $full_name="nil" ;
        $this->db->where('emp_id',$id) ;
        $query = $this->db->get('employees');
        $result=$query->result();
        foreach($result as $row){
          $first_name=$row->first_name ;
          $last_name=$row->last_name ;
          $full_name=$first_name." ".$last_name ;
        }
        return $full_name ;
    }

    public function getEmployeeById($id){
        $data=array() ;
        $this->db->where('emp_id',$id) ;
        $query = $this->db->get('employees');
        $result=$query->result();
        foreach($result as $row){
            $data=array(
                'emp_id'=> $row->emp_id,
                'employee_id'=> $row->employee_id,
                'first_name'=> $row->first_name,
                'last_name'=> $row->last_name,
                'gender'=> $row->gender,
                'birth_date'=> $row->birth_date,
                'mobile_no'=> $row->mobile_no,
                'guardian_name'=> $row->guardian_name,
                'guardian_label'=> $row->guardian_label,
                'desig_id'=> $row->desig_id,
                'description'=> $row->description,
                'facebook_link'=>$row->facebook_link,
                'twitter_link'=>$row->twitter_link,
                'linkedin_link'=>$row->linkedin_link,
                'user_id'=> $row->user_id,
                'photo'=> $row->photo,
                'status'=> $row->status,
                'last_updated_on'=> date('d-m-Y',strtotime($row->last_updated_on)),
                'created_on'=> date('d-m-Y',strtotime($row->created_on))
            );
        }
        return $data ;
    }

    public function getEmployeeDetailsByUserId($id){
        $data=array() ;
        $this->db->where('user_id',$id) ;
        $query = $this->db->get('employees');
        $result=$query->result();
        foreach($result as $row){
            $data=array(
                'emp_id'=> $row->emp_id,
                'employee_id'=> $row->employee_id,
                'first_name'=> $row->first_name,
                'last_name'=> $row->last_name,
                'gender'=> $row->gender,
                'birth_date'=> date('d-m-Y',strtotime($row->birth_date)),
                'mobile_no'=> $row->mobile_no,
                'guardian_name'=> $row->guardian_name,
                'guardian_label'=> $row->guardian_label,
                'desig_id'=> $row->desig_id,
                'description'=> $row->description,
                'user_id'=> $row->user_id,
                'photo'=> $row->photo,
                'status'=> $row->status,
                'last_updated_on'=> date('d-m-Y',strtotime($row->last_updated_on)),
                'created_on'=> date('d-m-Y',strtotime($row->created_on))
            );
        }
        return $data ;
    }

    public function updateEmployeeId($emp_id){
        $employee_id=$this->getEmployeeIdString($emp_id) ;
        $data=array('employee_id'=>$employee_id);
        $this->db->where('emp_id',$emp_id);
        $ustatus=$this->db->update('employees',$data);
        if($ustatus==1){
            return $employee_id ;
        }else{
            return $ustatus ;
        }
    }

    public function getEmployeeIdString($id){
        $req_id_len=4 ;  //required id length
        $actual_id_len=strlen($id) ; //length of enq_id
        $len_diff=$req_id_len-$actual_id_len ;
        $req_id='' ;
        for($i=0; $i<$len_diff; $i++){
            $req_id.='0' ;
        }
        $employee_id="EM".$req_id.$id ; 
        return $employee_id ;
    }
//---------------if pic uplodede-----------------------------
public function updateEmployeeImageNames($emp_id){
            $data = array(
                        'photo'=>'employeepic-'.$emp_id.'.png',
                    );
            $this->db->where('emp_id',$emp_id);
            $ustatus=$this->db->update('employees',$data);
            //print_r($ustatus);
            return $ustatus; 
        }     

//------------------if pic not Uploaded-----------
    /*public function profileUplodaFailed($emp_id){
            $data = array(
                        'photo'=>'nil',
                    );
            $this->db->where('emp_id',$emp_id);
            $ustatus=$this->db->update('employees',$data);
            //print_r($ustatus);
            return $ustatus; 
    } */    
}
?>