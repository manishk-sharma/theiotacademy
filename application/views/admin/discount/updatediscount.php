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

	<h3 class="text-center mt-2">Update Discount</h3><br>

	<form action="<?php echo base_url()?>Discount/update_discount" method="post" enctype="multipart/form-data">

		<input type="hidden" name="udiscount_id" value="<?=$discount_id?>">

	<div class="row"> 

		<div class="col-sm-6"> 

			<div class="row"> 

				<div class="col-sm-4">

					Discount Name:<b class="required">*</b>

				</div>

		  		<div class="col-sm-8">

					<input type="text" name="udiscount_name" class="form-control" required="required" value="<?=$discount_name?>"/>

				</div>

			</div><br>

		</div>

		<div class="col-sm-6">

			<div class="row">

				<div class="col-sm-4">

					Discount Date:<b class="required">*</b>

				</div>

				<div class="col-sm-8">

					<input type="Date" name="udiscount_date" class="form-control" required="required" value="<?=$discount_date?>"/>

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

					<input type="number" name="udiscount_rate" maxlength="2" class="form-control" required="required" value="<?=$discount_rate?>" />

				</div>	

			</div><br>

		</div>

		<div class="col-sm-6">

			<div class="row">

				<div class="col-sm-4">

					Auto/Manual:

				</div>

				<div class="col-sm-8">

					<select name="uauto_manual" class="form-control" required="required">

					<?php if($auto_manual==0){ ?>

						<option value="1">Manual</option>

						<option value="0" selected>Auto</option>

					<?php } else{?>

						<option value="0">Auto</option>

						<option value="1" selected>Manual</option>

					<?php }?>

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

					<?php if($batch_event_type=='batch'){?>

						<option value="event">Event</option>

						<option value="batch" selected="selected">Batch</option>

					<?php }else{?>

						<option value="batch">Batch</option>

						<option value="event" selected="selected">Event</option>
					<?php }?>
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
						
						<option value="<?=$batch_event_id?>" selscted></option>

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

					<textarea rows="5" name="udescription" class="form-control" required="required"><?=$description?></textarea>

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

	var param = document.getElementById('batch_event_type');
	//alert(param.value);
	changetypeajax(param);// calling ajax function


</script>
