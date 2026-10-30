 <?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

class EventRegModel extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->load->database(); 
        $this->load->library('session'); 
    }

    public function register_event($event_id,$fullname,$email_id,$mobile_no){
        $data = array(
            'event_id'=>$event_id,
            'name'=>$fullname,
            'email_id'=>$email_id,
            'mobile_no'=>$mobile_no,
        );
        $this->db->insert('event_reg', $data);
        $reg_id=$this->db->insert_id();
        return $reg_id;
    } 

}?>