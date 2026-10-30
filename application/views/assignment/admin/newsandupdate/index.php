<?php 
if($this->session->userdata("user")){
?>

<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!--PLUGIN OF RICH TEXT CSS-->
<link rel="stylesheet" href="<?php echo asset_url()?>admin/css/site.css">
 <script src="<?php echo asset_url()?>ckeditor4n/ckeditor4n/ckeditor.js"></script>
<?php $this->load->view("assignment/admin/common/adminheader.php")?>
<div class="container">
	<h3 class="text-left mt-4">Add News and Update</h3><br>	
	<form id="Addnewsevents" method="post"  onsubmit="return false">
		<div class="row">	
		 	<div class="col-sm-12">	
				<div class="mb-2">Title</div>
				<input type="text" name="title" class="form-control"  placeholder="Title"/>	
		 	</div>	
		 	<div class="col-sm-12">
				<div class="mb-2 mt-4">Description</div>	
				<textarea type="text" name="description" class="form-control" rows="8" placeholder="Description..."></textarea>
		 	        	
		 	</div>	
		</div><br>		
		<div class="row">		
		    <div class="col-sm-12 text-left mt-4 mb-4">
		        <input class="btn btn-success p-2" type="submit" name="addjob" value="Add News and Update"/>
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
 <script>


     $( document ).ready(function() {

     $("#Addnewsevents").submit(function(e) {
        const formUrl = '<?= base_url() ?>UploadNewsUpdate/insert_news_evnt';
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
					$('#Addnewsevents')[0].reset();
					window.location.href="<?php echo base_url()?>UploadNewsUpdate/newsupdateshow";
					$('#enqform-overlay').hide();
                }
                else{
                   alert(removeTags(data.response));
                }
            }
        }   
    });
});
});     

</script>	

<?php } 
else{ 
	redirect(base_url()."assignment-login") ;
	}?>
