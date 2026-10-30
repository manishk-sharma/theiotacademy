<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CompTeamModel extends CI_Model{
    function __construct() {
        $this->tableName = 'comp_team';
        $this->primaryKey = 'id';
        $this->load->model('TeamModel');
    }
    
    public function insertTeamName($data = array()){
       
        $insert = $this->db->insert($this->tableName,$data);

        if($insert){
            return $this->db->insert_id();
        }else{
            return false;    
        }
    }


    public function getTeamIdString($id){
        $req_id_len=5 ;  //required id length
        $actual_id_len=strlen($id) ; //length of enq_id
        $len_diff=$req_id_len-$actual_id_len ;
        $req_id='' ;
        for($i=0; $i<$len_diff; $i++){
            $req_id.='0' ;
        }
        $team_id="TechSavvy2020-".$req_id.$id ;
        return $team_id ;
    }



    public function updateTeamNameString($insertID)
    {
        $ustatus=false;
        $teamIdString=$this->getTeamIdString($insertID);

        $data = array(
                'tm_id'=>$this->getTeamIdString($insertID),
           
        );
        $this->db->where('team_id',$insertID);
        $ustatus=$this->db->update('comp_team', $data);
        if($ustatus){

            $ustatus=$teamIdString;
        }
        return $ustatus; 
    }


    public function isTeamExists($tm_id){
        $count=0 ;
        $this->db->where('tm_id',$tm_id);

        $query = $this->db->get('comp_team');

        $result=$query->result();

        $count=count($result) ;
        if($count>0){
            return TRUE ;
        }else{
            return FALSE ;
        }
    }

    public function isTeamNameExists($team_name){
        $count=0 ;
        $this->db->where('team_name',$team_name);

        $query = $this->db->get('comp_team');

        $result=$query->result();

        $count=count($result) ;
        if($count>0){
            return TRUE ;
        }else{
            return FALSE ;
        }
    }


    public function checkPaymentStatus($tm_id){
        
        $this->db->where('payment_status',true);

        $query = $this->db->get('comp_team');

        $result=$query->result();

        $count=count($result) ;

        if($count>0){

            return TRUE ;

        }else{

            return FALSE ;
        }

    }

    public function saveOrderId($order_id,$tmId){
        
        $data = array(
            'ORDERID'=>$order_id
        );
        $this->db->where('tm_id',$tmId);
        $ustatus=$this->db->update('comp_team', $data);
        return $ustatus; 

    }

    public function setTransationStatus($ORDERID,$paymentStatus){

        $data = array(
            'payment_status'=>$paymentStatus
        );
        $this->db->where('ORDERID',$ORDERID);
        $ustatus=$this->db->update('comp_team', $data);
        return $ustatus; 
    }

    public function getTeamByOrderId($ORDERID)
    {
         $this->db->where('ORDERID',$ORDERID);
         $query = $this->db->get('comp_team');

         $result=$query->result();

         $data=array();

         foreach ($result as $row) {
             
             $data=array(

                'team_id'=>$row->team_id,
                'tm_id '=>$row->tm_id,
                'comp_id'=>$row->comp_id,
                'contest_name'=>'Tech Savvy 2020',
                'email_id'=>$this->TeamModel->getMembersBytmId($row->tm_id),
                'team_name'=>$row->team_name,
                'reg_status'=>$row->reg_status,
                'ORDERID'=>$row->ORDERID,
                'payment_status'=>$row->payment_status
             );
         }
         return $data;
         //print_r($data);

    }



    public function getTeamByTmId($tm_id)
    {
         $this->db->where('tm_id',$tm_id);
         $query = $this->db->get('comp_team');

         $result=$query->result();

         $data=array();

         foreach ($result as $row) {
             
             $data=array(

                'team_id'=>$row->team_id,
                'tm_id '=>$row->tm_id,
                'comp_id'=>$row->comp_id,
                'contest_name'=>'Tech Savvy 2020',
                'email_id'=>$this->TeamModel->getMembersBytmId($row->tm_id),
                'team_name'=>$row->team_name,
                'reg_status'=>$row->reg_status,
                'ORDERID'=>$row->ORDERID,
                'payment_status'=>$row->payment_status
             );
         }
         return $data;
         //print_r($data);

    }


    /*public function updateTeamFileName($insertID,$fileName)
    {

        $data = array(
            'filname'=>$fileName,
            'member_id'=>$insertID,
           
        );
        $this->db->where('member_id',$insertID);
        $ustatus=$this->db->update('comp_team', $data);
        return $ustatus; 
    } 
*/


    
   
}