<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class ExpModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
        //$this->load->helper('url');
	}

	public function experiment()
	{
	 $firstname=$this->input->post('firstname');
	//$firstname=	$_GET['firstname'];
	$filename = "$firstname".".php";
	copy("template.php",$filename);
	$OldText="Sell1234";
	$NewText="$firstname";

	//read the entire string
	$str=implode("\n",file($filename));

	$fp=fopen($filename,'w');
	//replace something in the file string - this is a VERY simple example
	$str=str_replace('Sell1234',$firstname,$str);

	//now, TOTALLY rewrite the file
	fwrite($fp,$str,strlen($str));


	$myfile = fopen("test.php", "w") or die("Unable to open file!");
	fwrite($myfile, $filename);
	fwrite($myfile,"\n");
	fclose($myfile);
		header("Location: $filename");	
	
	}


}
?>	