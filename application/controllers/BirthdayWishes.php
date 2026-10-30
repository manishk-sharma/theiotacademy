<?php 
defined('BASEPATH') OR exit('No direct script access allowed');  

class BirthdayWishes extends CI_Controller{
	public function __construct(){ 
		parent::__construct();
	    $this->load->helper('utility_helper');
	    $this->load->library('form_validation');
	    $this->load->model(['BirthdayWishModel']);
	    $this->load->library('session');
	    $this->load->library('email'); 

	}

	public function BirthdayData(){
		  $result=$this->BirthdayWishModel->BirthdayDateRecord();
        foreach ($result['all_data'] as $row) {
			$mdate=date("Y-m-d");
             $brd=$row->birth_date;
			if($brd==$mdate){
				$this->userConfirmEmail($row);
			}
			
        }
	}


public function userConfirmEmail($row){

$from_email = "enquiry@theiotacademy.co";
$to_email = $row->email;
$message="Dear <strong>".$row->name ."!</strong><br><br>
  On behalf of the entire [Company Name] team, I want to wish you a very happy birthday! 🎉 Your dedication, hard work, and positive energy make a significant difference in our workplace, and we truly appreciate everything you do.
May your special day be filled with happiness, laughter, and moments of joy. Here's to celebrating you and all your accomplishments. We hope the year ahead brings you success, fulfillment, and all the things that make you happiest.
<br>
Enjoy your day to the fullest—you deserve it!
<br> <br>
<strong>Warm wishes,</strong><br/>
  Team The IoT Academy<br />
  Website: ".base_url();
  $this->email->from($from_email,'Birthday Wishes | The IoT Academy');
  $this->email->to($to_email);
  $this->email->subject('Happy Birthday Wishes');
  $this->email->message($message);
  if($this->email->send()){ 
  return TRUE ;
  }else{
  return FALSE ;
  }

}	



}

?>



