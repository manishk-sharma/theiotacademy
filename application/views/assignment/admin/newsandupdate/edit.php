<?php 
if($this->session->userdata("user")){
?>
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!--PLUGIN OF RICH TEXT CSS-->
<link rel="stylesheet" href="<?php echo asset_url()?>admin/css/site.css">
<?php $this->load->view("assignment/admin/common/adminheader.php")?>
<div class="container">
	<h3 class="text-left mt-4">Update News and Update</h3><br>	
	<form action="<?=base_url()?>UploadNewsUpdate/updatenewseventbyid" method="post">
		<div class="row">	
		 	<div class="col-sm-12">
				<input type="hidden" value="<?= $result[0]['id']?>" id="newseventid" name="newseventid"/>
				<div class="mb-2">Title</div>
				<input type="text" name="title" class="form-control" value="<?= $result[0]['title']?>" />
		 		 			
		 	</div>		
		 	<div class="col-sm-12">
				<div class="mb-2 mt-4">Description</div>	
				<textarea type="text" name="description" class="form-control" rows="8" ><?= $result[0]['description']?></textarea>		
		 	</div>	
		</div>		
		<div class="row">		
		    <div class="col-sm-12 text-left mt-4 mb-4">
		        <input class="btn btn-success p-2" type="submit" name="updatenewsevent" value="Update News and Update"/>
		        <div>
		        	<h3 id="success-msg" class="text-success"></h3>
		        	<h3 id="error-msg" class="text-danger"></h3>
		        </div>		
		    </div>	
		</div>	
	</form>
</div>
<?php $this->load->view("assignment/admin/common/adminfooter.php")?>
<!--PLUGIN OF RICH TEXT JS  start-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script type="text/javascript">	

     
     $("#Categoryevc").change(function() {
	   const optopnvalt = $(this).val();
	    if(optopnvalt=="Event"){
             $(".clsoffulldesc").removeClass("d-none");
             $(".pagelinkclsdd").addClass("d-none");
	    }
	    else{
	    	$(".clsoffulldesc").addClass("d-none");
             $(".pagelinkclsdd").removeClass("d-none");
	    }
	});     

</script>			
<?php } 
else{ 
	redirect(base_url()."assignment-login") ;
	}?>
