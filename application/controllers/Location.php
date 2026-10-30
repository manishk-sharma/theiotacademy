<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {

  public function __construct(){ 
    parent::__construct();
    error_reporting(0); 
    $this->load->helper('utility_helper');
        $this->load->library('form_validation');
        $this->load->model('EventLocationModel');
        $this->load->model('AppModel');
        $this->load->model('EmployeeModel');
        $this->load->model('UserTypeModel');
        $this->load->library('session');
    //$this->load->helper(array('form', 'url'));
    
  }
  
  public function index(){
    $this->load->view('admin/location/locationmanage');
  }

  public function insert_location(){
     //Validating the information
          //error messages
          $locationtitleerrmsg=array(
            'required'=>'Location Title Cannot be Empty.',);
          $houseerrmsg=array(
            'required'=>'House Name Cannot be Empty.',);
          $areaerrmsg=array(
            'required'=>'Area Name Cannot be Empty',);
          $cityerrmsg=array(
            'required'=>'City Name Cannot be Empty',);
          $districterrmsg=array(
            'required'=>'districtr Name Cannot be Empty',);
          $stateerrmsg=array(
            'required'=>'State Name Cannot be Empty',);
          $pincodeerrmsg=array(
            'required'=>'Pincode Cannot be Empty',
            'numeric'=>'Pin code. Must Be Numeric.',
            'max_length'=>'Pincode Must Be 6-Digit Only',);
          $maplinkerrmsg=array(
            'required'=>'map field Cannot be Empty'); 
          $countryerrmsg=array(
            'required'=>'country Name Cannot be Empty',);
          $this->form_validation->set_rules('location_title','title',$locationtitleerrmsg);
          $this->form_validation->set_rules('house_no','House No','required',$houseerrmsg);
          $this->form_validation->set_rules('area','area','required',$areaerrmsg);
          $this->form_validation->set_rules('city','City','required',$cityerrmsg);
          $this->form_validation->set_rules('district','district','required',$districterrmsg);
          $this->form_validation->set_rules('state','State','required',$stateerrmsg);
          $this->form_validation->set_rules('pin_code','pincode','required|numeric|max_length[6]',$pincodeerrmsg);
          $this->form_validation->set_rules('map_link','MapLink','required',$maplinkerrmsg);
          $this->form_validation->set_rules('country','Country','required',$countryerrmsg);
          if($this->form_validation->run()){
          $locatio_id=0;
          $location_title=$this->input->post('title');
          $house_no=$this->input->post('house_no');
          $area=$this->input->post('area');
          $city=$this->input->post('city');
          $district=$this->input->post('district');
          $state=$this->input->post('state');
          $pin_code=$this->input->post('pin_code');
          $map_link=$this->input->post('map_link');
          $country=$this->input->post('country'); 

          $location_id=$this->EventLocationModel->insertLocation($location_title,$house_no,$area,$city,$district,$state,$pin_code,$map_link,$country);
          if($location_id>0){
                $message="location Created Successfully with Id: ".$location_id ;
                    $this->session->set_flashdata('success',$message);
                    redirect(base_url().'alocation'); 
            }else{
                $message="Unable To Create The location Type. Contact Administrator." ;
                $this->session->set_flashdata('error',$message);
                redirect(base_url().'alocation');
            }

          }else{
            $this->session->set_flashdata('error',validation_errors());
            redirect (base_url().'alocation');
          }
    
  }

  public function updateLocation(){
        //Validating the information
          //error messages
          $locationtitleerrmsg=array(
            'required'=>'Location Title Cannot be Empty.');

          $houseerrmsg=array(
            'required'=>'House Name Cannot be Empty.');

          $areaerrmsg=array(
            'required'=>'Area Name Cannot be Empty');

          $cityerrmsg=array(
            'required'=>'City Name Cannot be Empty');

          $districterrmsg=array(
            'required'=>'districtr Name Cannot be Empty');

          $stateerrmsg=array(
            'required'=>'State Name Cannot be Empty');

          $pincodeerrmsg=array(
            'required'=>'Pincode Cannot be Empty',
            'numeric'=>'Pin code. Must Be Numeric.',
            'max_length'=>'Pincode Must Be 6-Digit Only');
          $maplinkerrmsg=array(
            'required'=>'map field Cannot be Empty');
          $countryerrmsg=array(
            'required'=>'country Name Cannot be Empty');

          $this->form_validation->set_rules('uplocation_title','title','required',$locationtitleerrmsg);
          $this->form_validation->set_rules('uphouse_no','House No','required',$houseerrmsg);
          $this->form_validation->set_rules('uparea','area','required',$areaerrmsg);
          $this->form_validation->set_rules('upcity','City','required',$cityerrmsg);
          $this->form_validation->set_rules('updistrict','district','required',$districterrmsg);
          $this->form_validation->set_rules('upstate','State','required',$stateerrmsg);
          $this->form_validation->set_rules('uppin_code','pincode','required|numeric|max_length[6]',$pincodeerrmsg);
          $this->form_validation->set_rules('upmap_link','MapLink','required',$maplinkerrmsg);
          $this->form_validation->set_rules('upcountry','Country','required',$countryerrmsg);

          if($this->form_validation->run()){

          $location_id=$this->input->post('uplocationid');
          $location_title=$this->input->post('uplocation_title');
          $house_no=$this->input->post('uphouse_no');
          $area=$this->input->post('uparea');
          $city=$this->input->post('upcity');
          $district=$this->input->post('updistrict');
          $state=$this->input->post('upstate');
          $pin_code=$this->input->post('uppin_code');
          $map_link=$this->input->post('upmap_link');
          $country=$this->input->post('upcountry');

          $status=False ;
          
          $status=$this->EventLocationModel->updateLocation($location_id,$location_title,$house_no,$area,$city,$district,$state,$pin_code,$map_link,$country);
          if($status){
            $message="Location Updated Successfully." ;
            $this->session->set_flashdata('success',$message);
            redirect(base_url().'alocation'); 
        }else{
            $message="Unable To Update The Location. Contact Administrator." ;
            $this->session->set_flashdata('error',$message);
            redirect(base_url().'alocation');
        }
        }else{
            $this->session->set_flashdata('error',validation_errors());
            redirect (base_url().'alocation');
          }
  }
  public function enableDisableLocation($location_id,$status)
  {
      $ustatus=$this->EventLocationModel->updateLocationStatus($location_id,$status);
      if ($ustatus) {
        if ($status==1) {
          $this->session->set_flashdata('success',"Location Enabled Successfully");
        }
        else{
          $this->session->set_flashdata('success',"Location Disabled Successfully");
        }
      }
      else{
        if ($status==1) {
          $this->session->set_flashdata('error',"Failed To Enable Location ");
        }
        else{
          $this->session->set_flashdata('error',"Failed To Disable Location ");
        }
      }
      redirect(base_url().'alocation');
  }
  

}