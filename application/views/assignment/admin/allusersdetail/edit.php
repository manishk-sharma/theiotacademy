<?php 
if($this->session->userdata("user")){
?>
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!--PLUGIN OF RICH TEXT CSS-->
<link rel="stylesheet" href="<?php echo asset_url()?>admin/css/site.css">
<?php $this->load->view("assignment/admin/common/adminheader.php")?>
<div class="container">
	<h3 class="text-left mt-4">Update Marks Of Assignment</h3><br>	
	<form action="<?=base_url()?>AssignmentAllUserAdmin/updateassignmentmarksbyid" method="post">
		<div class="row">	
		 	<div class="col-sm-12">
				<input type="hidden" value="<?= $result[0]['id']?>" name="assignmentid"/>
				<div class="mb-2">Assignment Topic</div>
				<input type="text" name="assignmenttopic" class="form-control" value="<?= $result[0]['title']?>" readonly="true"/>			
		 	</div>		
		 	<div class="col-sm-12">
				<div class="mb-2 mt-4">Marks</div>	
				<input type="number" min="0" oninput="this.value = Math.abs(this.value)"  name="marks" class="form-control" value="<?= $result[0]['marks']?>">
		 	</div>	
		</div>		
		<div class="row">		
		    <div class="col-sm-12 text-left mt-4 mb-4">
		        <input class="btn btn-success p-2" type="submit" value="Update Marks"/>	
		    </div>	
		</div>	
	</form>
</div>
<?php $this->load->view("assignment/admin/common/adminfooter.php")?>
<!--PLUGIN OF RICH TEXT JS  start-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script type="text/javascript">	

</script>		
<?php } 
else{ 
	redirect(base_url()."assignment-login") ;
	}?>	
