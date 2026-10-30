<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!--PLUGIN OF RICH TEXT CSS-->

<link rel="stylesheet" href="<?php echo asset_url()?>admin/css/site.css">

<link rel="stylesheet" href="<?php echo asset_url()?>admin/js/richtext.min.css">

<style type="text/css">

	.required{ 
		color: red!important;
	}
</style>


<?php $this->load->view("admin/commons/adminheader.php")?>
<input type="hidden" name="base_url" id="base_url" value="<?=base_url();?>">
<div class="container-fluid">

	<h3 class="text-center mt-2">Add Discount</h3><br>

	<form action="<?php echo base_url()?>Discount/insert_discount" method="post" enctype="multipart/form-data">

	<div class="row"> 

		<div class="col-sm-6"> 

			<div class="row"> 

				<div class="col-sm-4">

					Discount Name:<b class="required">*</b>

				</div>

		  		<div class="col-sm-8">

					<input type="text" name="discount_name" class="form-control" required="required" value=""/>

				</div>

			</div><br>

		</div>

		<div class="col-sm-6">

			<div class="row">

				<div class="col-sm-4">

					Discount Date:<b class="required">*</b>

				</div>

				<div class="col-sm-8">

					<input type="Date" name="discount_date" class="form-control" required="required" value=""/>

				</div>

			</div>

		</div>

	</div>

	<br>

	<div class="row">

		<div class="col-sm-6">

			<div class="row">

				<div class="col-sm-4">

					Discount Rate:<b class="required">*</b>

				</div>

				<div class="col-sm-8">

					<input type="number" name="discount_rate" maxlength="2" class="form-control" required="required"/>

				</div>	

			</div><br>

		</div>

		<div class="col-sm-6">

			<div class="row">

				<div class="col-sm-4">

					Auto/Manual:

				</div>

				<div class="col-sm-8">

					<select name="auto_manual" class="form-control" required="required">
						
						<option value="0">Auto</option>

						<option value="1">Manual</option>

					</select>

				</div>

			</div><br>

		</div>

	</div>

	<br>

	<div class="row">

		<div class="col-sm-6">

			<div class="row">

				<div class="col-sm-4">

					Batch/Event Type:

				</div>



				<div class="col-sm-8">

					<select name="batch_event_type" id="batch_event_type" class="form-control" onchange="changetypeajax(this)">

						<option value="batch">Batch</option>

						<option value="event">Event</option>

					</select>

				</div>

			</div><br>

		</div>

		<div class="col-sm-6">

			<div class="row">

				<div class="col-sm-4 ">

					Batch/Event Name:

				</div>

				<div class="col-sm-8">

					<select name="batch_event_id" id="batch_event_id" class="form-control">
						
						<option value="0">Batch/Event</option>

					</select>

				</div>

			</div>

		</div>

	</div>

	<br>

	<div class="row">

		<div class="col-sm-12">

			<div class="row">

				<div class="col-sm-2 mt-3" title="required field">
						<br>

					Description In Short:<b class="required">*</b>

				</div>

				<div class="col-sm-10">

					<textarea rows="5" name="description" class="form-control" required="required"></textarea>

				</div>

			</div>

		</div>

	</div>


	<div class="row">

		<div class="col-sm-12 text-right mt-4 mb-4">
		<br>
			<input class="btn btn-success p-2" type="submit" name="update discount" value="Add Discount"  />

		</div>

	</div>

	</form>

</div>

<?php $this->load->view("admin/commons/adminfooter.php")?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>/assets/js/ajax/batch_event_dropdownajax.js"></script>

<script type="text/javascript">
$( document ).ready(function() {

	var param = $("#batch_event_type");
	changetypeajax(param);// calling ajax function

});	

</script>
