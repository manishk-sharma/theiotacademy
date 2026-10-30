<!DOCTYPE html>

<html>

	<head>

		<!-- bootstrap v4 css -->

	    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/bootstrap.min.css">

	    <style type="text/css">

	    	table{

	    		border-collapse: collapse;

	    	}

	    	.table-row:nth-child(odd){

	    		background-color: #eee !important;

	    	}

	    </style>



	</head>

	<body>  

		<table class="table table-bordered table-striped" border="1" cellspacing="0" cellpadding="10">

				<tr class="table-row" >

			      <th colspan="2" style="text-align: center; font-size: 16px;background-color:#3A3A3A;color: white;">Special Discount for registration details</th> 

			    </tr>

			    <tr class="table-row">
			      <th>Name</th>
			      <td><?=$name?></td>
			    </tr>
			     <tr class="table-row">
			      <th>Mobile No.</th>
			      <td><?=$mobile ?></td>
			    </tr>
				 <tr class="table-row">
			      <th>Email</th>
			      <td><?=$email?></td>
			    </tr>
			    <tr class="table-row">
			      <th>Company</th>
			      <td><?=$company?></td>
			    </tr>
			    <tr class="table-row">
			      <th>Designation</th>
			      <td><?=$designation?></td>
			    </tr>
			    <tr class="table-row">
			      <th>No of Enrollment</th>
			      <td><?=$no_of_enrollment?></td>
			    </tr>
			     <tr class="table-row">
			      <th>query</th>
			      <td><?=$query?></td>
			    </tr>
			    <tr class="table-row">
			      <th>Url</th>
			      <td><?=$page_url?></td>
			    </tr>
		</table>
	</body>
</html>

