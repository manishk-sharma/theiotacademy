<?php
//ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');  
class Discount extends CI_Controller { 
	public function __construct(){ 

		parent::__construct();
    //error_reporting(0);
    $this->load->helper('utility_helper');
    $this->load->library('form_validation');
    $this->load->model('AppModel');
    $this->load->model('EmployeeModel');
    $this->load->model('UserModel');
    $this->load->model('DesigModel');
    $this->load->model('UserTypeModel');
    $this->load->model('StudentModel');
    $this->load->model('EventModel');
    $this->load->model('EventTypeModel');
    $this->load->model('DiscountModel');
    $this->load->model('BlogModel');
    $this->load->model('BatchModel');
    $this->load->model('EventLocationModel');
    $this->load->helper(array('form', 'url'));
    $this->load->library('session');
	}
  public function index(){

    $data['discount_list']=$this->DiscountModel->getDiscountList();
    $this->load->view('admin/discount/discountmanage',$data);

  }

  public function discount_add(){

    $this->load->view('admin/discount/adddiscount');

  }

  public function discount_update($id){

    $data=$this->DiscountModel->getDiscountById($id);
    $this->load->view('admin/discount/updatediscount',$data);

  }


//for discount dropdown populate using ajax    
  public function print_batch_event_list() {

      $batch_event_type=$this->input->post('batch_event_type');
      $data=$this->BatchModel->getActiveBatchList();
      if ($batch_event_type=='event') {
            $data=$this->EventModel->getEventShortList();
      }

      else if($batch_event_type=='batch'){
        $data=$this->BatchModel->getActiveBatchList();

      }

      if(count($data)>0){
        echo json_encode($data);
      }else{

        echo 'false' ;

      }

  }

  public function insert_discount(){

     $discount_name = $this->input->post('discount_name');
     $discount_date = $this->input->post('discount_date');
     $discount_rate = $this->input->post('discount_rate');
     $auto_manual = $this->input->post('auto_manual');
     $batch_event_type = $this->input->post('batch_event_type');
     $batch_event_id = $this->input->post('batch_event_id');
     $description = $this->input->post('description');
     $flag=$this->DiscountModel->isInsertExistsInDB($auto_manual,$batch_event_type,$batch_event_id);

     if(!$flag){

        $discount_id = $this->DiscountModel->insertDiscountData($discount_name,$discount_date,$discount_rate,$auto_manual,$batch_event_type,$batch_event_id,$description);

       if($discount_id>0){
            $message="Discount Added Successfully with Id: ".$discount_id ;
            $this->session->set_flashdata('success',$message);
            redirect(base_url().'adiscount');  
      }
      else{
            $message="Unable To Create The Discount. Contact Administrator." ;
            $this->session->set_flashdata('error',$message);
            redirect(base_url().'discount-add');
        }
     }
     else{
        $message="Duplicate Entry Or Auto Field  For Same Discount ID . Contact Administrator." ;
        $this->session->set_flashdata('error',$message);
        redirect(base_url().'discount-add');
     }
  }

  public function update_discount()

  {

     $udiscount_id = $this->input->post('udiscount_id');
     $udiscount_name = $this->input->post('udiscount_name');
     $udiscount_date = $this->input->post('udiscount_date');
     $udiscount_rate = $this->input->post('udiscount_rate');
     $uauto_manual = $this->input->post('uauto_manual');
     $ubatch_event_type = $this->input->post('batch_event_type');
     $ubatch_event_id = $this->input->post('batch_event_id');
     $udescription = $this->input->post('udescription');
     $flag=$this->DiscountModel->isUpdateExistsInDB($udiscount_id,$uauto_manual,$ubatch_event_type,$ubatch_event_id);

     if(!$flag){
        $ustatus = $this->DiscountModel->updateDiscount($udiscount_id,$udiscount_name,$udiscount_date,$udiscount_rate,$uauto_manual,$ubatch_event_type,$ubatch_event_id,$udescription);

          if($ustatus>0){
              $message="Discount Updated Successfully with Id: ".$udiscount_id ;
              $this->session->set_flashdata('success',$message);
              redirect(base_url().'adiscount');  
        }
        else{
              $message="Unable To Update The Discount. Contact Administrator." ;
              $this->session->set_flashdata('error',$message);
              redirect(base_url().'Discount/discount_update/'.$udiscount_id);
          }

     }

     else{

      $message="Duplicate Entry Or Auto Field  For Same Discount ID . Contact Administrator." ;
      $this->session->set_flashdata('error',$message);
      redirect(base_url().'Discount/discount_update/'.$udiscount_id);

     } 

  } 


//==================Enable and Disable Discount=======================

public function enableDisableDiscount($discount_id,$status){

  $ustatus=$this->DiscountModel->updateDiscountStatus($discount_id,$status) ;

  if($ustatus){ 
    if($status==1){
      $this->session->set_flashdata('success', 'Discount Enabled Successfully. Discount Id: '.$discount_id);
    }else{

      $this->session->set_flashdata('success', 'Discount Disabled Successfully. Discount Id: '.$discount_id);

    }

  }else{

    if($status==1){

      $this->session->set_flashdata('error', 'Unable To Enable The Discount. Try Later!');

    }else{

      $this->session->set_flashdata('error', 'Unable To Disable The Discount. Try Later!');
    }

  }

  redirect(base_url().'adiscount');

}

}?>  