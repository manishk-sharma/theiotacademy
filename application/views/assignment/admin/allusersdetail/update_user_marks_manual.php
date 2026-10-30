<?php 
if($this->session->userdata("user")){
?>
<link rel="stylesheet" href="<?php echo asset_url()?>admin/css/site.css">
<?php $this->load->view("assignment/admin/common/adminheader.php") ;?>
<style type="text/css">
  .batch_result_div{
	display: flex;
	justify-content: center;
  }
  .form_of_batch_result{
	box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 5px 0px, rgba(0, 0, 0, 0.1) 0px 0px 1px 0px;
	width: 400px;
    margin-top: 5%;
    padding: 40px 30px;

  }
  .submitbtn{
    width:150px; 
    border-radius:25px; 
    font-weight:bold; 
  }

</style> 

<div class="container-fluid">
  <?php if($this->session->flashdata('message')): ?>
    <div class="alert alert-info text-center" style="font-weight:bold;">
        <?= $this->session->flashdata('message'); ?>
    </div>
<?php endif; ?>
<h4>Field Name : - assignment_id,user_id,title,marks,feedback</h4>

	<h3 class="text-center heading mt-4 mb-4">Update User Assignment Marks </h3>
      
	  <div class="batch_result_div">
       
	  <form action="<?= base_url('AssignmentAllUserAdmin/importmarksCSV'); ?>" method="post" enctype="multipart/form-data" class="form_of_batch_result">
		<div class="row">	
		 	<div class="col-sm-12">
				<div class="mb-2">Choose Csv File For Update Marks</div>
                <input type="file" name="csv_file" class="form-control" required>
				
		 	</div>
		</div>		
		<div class="row">		
		    <div class="col-sm-12 text-center mt-4 mb-4">
		        <input class="btn btn-primary p-2 px-4" type="submit" value="Update Result Marks"/>	
		    </div>	
		</div>	
	</form>

	  </div>

</div>

<?php $this->load->view("assignment/admin/common/adminfooter.php") ;?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
<script>
function removeTags(str) {
    if ((str === null) || (str === ''))
        return false;
    else
        str = str.toString();
    return str.replace(/(<([^>]+)>)/ig, '');
}

document.getElementById("Download_Batch_Result_submit").addEventListener("submit", function(e) {
    e.preventDefault(); 
    const formUrl = '<?=base_url()?>AssignmentAllUserAdmin/download_result_batch_wise_function';
    const formData = new FormData(this);

    fetch(formUrl, {
        method: 'POST',
        body: formData
    })
    .then(response => response.text()) 
    .then(csvText => {
        console.log("Raw CSV Response:", csvText);

        if (!csvText.trim() || csvText.toLowerCase().includes("error")) {
            alert("Error: No data available or an issue occurred.");
            return;
        }
        let blob = new Blob([csvText], { type: "text/csv" });
        let link = document.createElement("a");
        link.href = window.URL.createObjectURL(blob);
        link.download = "assignment_results.csv"; // Set filename
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    })
    .catch(error => {
        console.error("Download Error:", error);
        alert("Failed to download CSV.");
    });
});


</script>

<?php } 
else{ 
	redirect(base_url()."assignment-login") ;
	}?>
