<?php


defined('BASEPATH') OR exit('No direct script access allowed');
class AdminOfferController extends CI_Controller {

	function __construct() {

            parent::__construct(); 

            

            // Load member model

            $this->load->model('EmailSetupModel');

            $this->load->model('SubjectAndMessageModel');

            

            // Load form validation library

            $this->load->library('form_validation');

            

            // Load file helper

            $this->load->helper('file');



            $this->load->helper('utility_helper');



            $this->load->library('form_validation');

            $this->load->model('BatchModel');

            $this->load->model('BatchDaysModel');

            $this->load->model('BatchModel');

            $this->load->model('BatchModel');

            $this->load->model('AppModel');

            $this->load->model('EmployeeModel');

            $this->load->model('UserModel');

            $this->load->model('RegisterModel');

            $this->load->model('StudentModel');

            //$this->load->model('EnquiryModel');

            $this->load->model('PaymentModel');

            $this->load->model('ClassRoomModel');

            $this->load->library('session');

             $this->load->library('email');

            }



	public function index()

	{ 

		$this->load->view('admin/offerletters/upload_form');

	}

	public function view_result()

	{

		$data = array();

		

		$data['members'] = $this->Offerletter->get_data();



	    $this->load->view('admin/offerletters/result', $data);

	}

	public function store() {

		if($this->input->post('Submit'))

		{

			$data = array();

			$data = $this->Offerletter->get_status_data();

			if ($data) 

			{		

		        $config['upload_path'] = './assets/images/';

		        $config['allowed_types'] = 'jpg|png|jpeg';

		        $config['max_size'] = 2500;

		        $config['max_width'] = 2500;

		        $config['max_height'] = 2500;

		        $this->load->library('upload', $config);



		        if (!$this->upload->do_upload('profile_image')) {

		            $this->session->set_flashdata('error_msg', $this->upload->display_errors());

		            return redirect('offer-home');

		        } 

		        else 

		        {

		            $upload_data = $this->upload->data();

		            $file_name = $upload_data['file_name'];

		            list($width,$height) = getimagesize("./assets/images/".$file_name);

		            $data = array(

		            	'file_path' => $file_name,

		            	'fonts' => $this->Offerletter->fetch_fontData(),

		            	'file_width' => $width,

		            	'file_height' => $height

		            );

		            $this->load->view('admin/offerletters/upload_result',$data);

		        }

		    }

		    else

		    {

		    	$this->session->set_flashdata('warning_msg','No new users founded, Certificates has been already issued for all users!');

		    	$data['members'] = $this->Offerletter->getRows();

		    	$this->load->view('admin/offerletters/index',$data);

		    }

		}

		else

		{

			redirect('offer-home');

		}

    }

    public function add_text()

    {

    	if($this->input->post('pos_save'))

    	{

    		$eventName = $this->input->post('eventName');

    		$fontName = $this->input->post('fontName');

    		$fontType = $this->input->post('fontType');

	    	$fontColor = $this->input->post('fontColor');

	    	$fontSize = $this->input->post('fontSize');

	    	$fontCase = $this->input->post('fontCase');

	    	$file_name = $this->input->post('filename');

	    	$x = $this->input->post('x');

	    	$y = $this->input->post('y');

	    	$this->Offerletter->store_template_data(implode(',', $fontName),implode(',', $fontType),implode(',', $fontColor),implode(',', $fontSize),implode(',', $fontCase),implode(',', $x),implode(',', $y),$file_name,$eventName);

	    	$data = $this->Offerletter->user_data();

	    	$flag = "";

		    foreach ($data as $value) 

		    {

		    	//$coldata = [$value['name'],$value['course'],$value['email']];
                 $coldata = [$value['offer_issue_date'],$value['name'],$value['email'],$value['mobile'],$value['domain'],$value['start_internship']];
		    	$imgpath = $this->process_text($eventName,$fontName,$fontType,$fontColor,$fontSize,$fontCase,$file_name,$x,$y,$coldata);

		    	if ($imgpath) 

		    	{



		    		$this->Offerletter->update_status($value['id'],$imgpath);

		    		$flag = true;

		    	}

		    	else

		    	{

		    		$flag = false;

		    	}

	    	}

	    	if ($flag) 

	    	{

	    		$this->session->set_flashdata('success_msg','Success!!Process completed successfully!!');

	    		redirect('offer-result');

	    	}

	    	else 

		    {

		    	$this->session->set_flashdata('error_msg', 'Process Failed, please try again.');

		    	return redirect('offer-home');

		    }

	    }

	    else 

	    {

	    	$this->session->set_flashdata('error_msg', 'Process Failed, please try again.');

	    	return redirect('offer-home');

	    }

    }

    public function process_text($eventName,$fontName,$fontType,$fontColor,$fontSize,$fontCase,$file_name,$xp,$yp,$name)

    {	

    	$file_type = substr($file_name, strpos($file_name, ".")+1);

    	if ($file_type=="png") 

    	{

    		$our_image = imagecreatefrompng('./assets/images/'.$file_name);

    	}

    	if ($file_type=="jpg" OR $file_type=="jpeg") 

    	{

    		$our_image = imagecreatefromjpeg('./assets/images/'.$file_name);

    	}

		for($i = 0; $i< count($fontName);$i++)

	    {

	    	switch ($fontCase[$i]) {

	    		case '2':

	    			$name[$i] = strtolower($name[$i]);

	    			break;

	    		case '3':

	    			$name[$i] = ucfirst($name[$i]);

	    			break;

	    		case '4':

	    			$name[$i] = lcfirst($name[$i]);

	    			break;

	    		case '5':

	    			$name[$i] = ucwords($name[$i]);

	    			break;

	    		default:

	    			$name[$i] = strtoupper($name[$i]);

	    			break;

	    	}

	    	$fontFileName = $this->Offerletter->font_data($fontName[$i],$fontType[$i]);

	    	$this->load->helper('path');

	    	$font_path = set_realpath("./assets/fonts/".$fontFileName[0]['fontValue']);

	    	//$font_path = realpath('')."/assets/fonts/".$fontFileName[0]['fontValue'];

	    	$color = $this->hexColorAllocate($our_image,$fontColor[$i]);

	    	$tb1 = imagettfbbox($fontSize[$i], 0, $font_path, $name[$i]);

	    	$tx = (ceil($tb1[2]) / 2);

	    	//$coords = explode(',', $pos[$i]);

	    	$x = (int)($xp[$i] - $tx);

	    	$y = $yp[$i];

	    	imagettftext($our_image, $fontSize[$i],0,$x,$y,$color, $font_path,$name[$i]);

	    }

		$target_dir= str_replace(' ','_',"./assets/offerletter/".$eventName."/");

		$img_unique = str_replace(' ','_', uniqid($name[0]).date('d-m-Y'));

		if(!file_exists($target_dir))

		{

		    mkdir($target_dir,0777);

    	}

		if ($file_type=="png") 

    	{

    		$imgName = $img_unique.".png";

    		$imgPath = $target_dir.$imgName;

    		imagepng($our_image,$imgPath);

    	}

    	else if ($file_type=="jpg" OR $file_type=="jpeg")

    	{

    		$imgName = $img_unique.".jpg";

    		$imgPath = $target_dir.$imgName;

    		imagejpeg($our_image,$imgPath);

    	}

    	imagedestroy($our_image);

    	return str_replace(' ','_',$eventName."/".$imgName);

    }

    public function hexColorAllocate($im,$hex)

    {

	    $hex = ltrim($hex,'#');

	    $a = hexdec(substr($hex,0,2));

	    $b = hexdec(substr($hex,2,2));

	    $c = hexdec(substr($hex,4,2));

	    return imagecolorallocate($im, $a, $b, $c); 

	}

	public function test()

	{

		$this->load->view('test');

	}

	public function apply_theme()

	{

		$themeData = $this->Offerletter->fetch_theme_data($this->input->get('themeid'));

		foreach ($themeData as $value) {

			$fontName = explode(',', $value->font_name);

			$fontType = explode(',', $value->font_type);

			$fontColor = explode(',', $value->font_color);

			$fontSize = explode(',', $value->font_size);

			$fontCase = explode(',', $value->font_case);

			$x = explode(',', $value->x_pos);

			$y = explode(',', $value->y_pos);

			$eventName = $value->template_name;

			$file_name = $value->template_image;

		}



	    $data = $this->Offerletter->user_data();

	    $flag = "";

		foreach ($data as $value) 

		{

		 	//$coldata = [$value['name'],$value['course'],$value['email']];
             $coldata = [$value['offer_issue_date'],$value['name'],$value['email'],$value['mobile'],$value['domain'],$value['start_internship']];
		    $imgpath = $this->process_text($eventName,$fontName,$fontType,$fontColor,$fontSize,$fontCase,$file_name,$x,$y,$coldata);

		    if ($imgpath) 

		    {

		    $this->Offerletter->update_status($value['id'],$imgpath);

		    	$flag = true;

		    }

		    else

		    {

		    	$flag = false;

		    }

	    	}

	    	if ($flag) 

	    	{

	    		$this->session->set_flashdata('success_msg','Success!!Process completed successfully!!');

	    		redirect('offer-result');

	    	}

	    	else 

		    {

		    	$this->session->set_flashdata('error_msg', 'Process Failed, please try again.');

		    	return redirect('offer-home');

		    }



	}

}

