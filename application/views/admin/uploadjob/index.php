<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!--PLUGIN OF RICH TEXT CSS-->
<link rel="stylesheet" href="<?php echo asset_url()?>admin/css/site.css">
 <script src="<?php echo asset_url()?>ckeditor4n/ckeditor4n/ckeditor.js"></script>
<?php $this->load->view("admin/commons/adminheader.php")?>
<div class="container">
	<h3 class="text-left mt-4">Add New Job</h3><br>	
	<form id="jobpostad" method="post" enctype="multipart/form-data" onsubmit="return false">
		<div class="row">	
		 	<div class="col-sm-6">
		 		 	<div class="row">		  		
		 		 		<div class="col-sm-12">
		 		 			<div class="mb-2">Job Title</div>
		 		 		    <input type="text" name="job_title" class="form-control"  placeholder="enter job title" />
		 		 		</div>			
		 		 	</div>		
		 	</div>		
		 	<div class="col-sm-6">
		 	    <div class="row">			
		 	        <div class="col-sm-12">
		 	        	<div class="mb-2">Job Location</div>	
		 	            <input type="text" name="job_location" class="form-control" placeholder="job location" />
		 	        </div>			
		 	    </div>		
		 	</div>	
		</div><br>	
		<div class="row">
		    <div class="col-sm-6">
		        <div class="row">
		            <div class="col-sm-12">
		            	<div class="mb-2">Deadline</div>
		                <input type="date" name="deadline" class="form-control" />
		            </div>				
		        </div>		
		    </div>		
		    <div class="col-sm-6">
		        <div class="row">
		            <div class="col-sm-12">
		            	<div class="mb-2">Number Of Vacancy</div>
		                <input type="number" name="vacancyn" class="form-control" placeholder="number of vacancy" />				
		            </div>			
		        </div>		
		    </div>	
		</div><br>	
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
				    <div class="col-sm-12">
				    	<div class="mb-2">Add Job Details</div>
				        <textarea id="editor1" class="content form-control" name="jobdetails" rows="10"></textarea>	
				    </div>			
				</div>		
			</div>	
		</div>	
		<div class="row">		
		    <div class="col-sm-12 text-left mt-4 mb-4">
		        <input class="btn btn-success p-2" type="submit" name="addjob" value="Add Job"/>
		        <div>
		        	<h3 id="success-msg" class="text-success"></h3>
		        	<h3 id="error-msg" class="text-danger"></h3>
		        </div>		
		    </div>	
		</div>	
	</form>
</div>
<?php $this->load->view("admin/commons/adminfooter.php")?>
<!--PLUGIN OF RICH TEXT JS  start-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script>
    CKEDITOR.replace('editor1');
	function updateCKEditorStatus() {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            return true; // Return true to allow form submission
        }
     $( document ).ready(function() {

     $("#jobpostad").submit(function(e) {
        const formUrl = '<?= base_url() ?>JobUploadController/insert_job';
		updateCKEditorStatus();
        const formData = new FormData(this);
        $.ajax({
            type: 'post',
            url: formUrl,
            processData: false,
            contentType: false,
            dataType:'json',
            data: formData,
            beforeSend: function() {
                $('#enqform-overlay').show();
            },
            
            success: function (data) {
            if (data.message=="error") {
                alert(removeTags(data.response));
                $('#enqform-overlay').hide();
            }
            else{
                if (data.message=="success") { 
                    $('#success-msg').show();
                $('#success-msg').html(data.response);
                $('#success-msg').fadeOut(15000);
                $('#jobpostad')[0].reset();
                 window.location.href="<?php echo base_url()?>JobUploadController/our_jobs";
                $('#enqform-overlay').hide();
                }
                else{
                    $('#error-msg').show();
                    $('#error-msg').html(data.response);
                    $('#error-msg').fadeOut(15000);
                }
            }
        }   
    });
});
});     

</script>			