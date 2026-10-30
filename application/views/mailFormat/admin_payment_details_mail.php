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
		<table class="table table-bordered" border="1" cellspacing="0" cellpadding="10">
				<tr class="table-row" >
			      <th colspan="2" style="text-align: center; font-size: 16px;background-color:#3A3A3A;color: white;">New Payment Details Received </th> 
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
			      <td><?=$email ?></td>
			    </tr>
			    <tr class="table-row">
			      <th>Program Name</th>
			      <td><?=$program_name?></td>
			    </tr>
			     <tr class="table-row">
			      <th>College Name</th>
			      <td><?=$college_name?></td>
			    </tr>
			     <tr class="table-row">
			      <th>Location</th>
			      <td><?=$location?></td>
			    </tr>
			    <!-- <tr class="table-row">
			      <th>Payment Details File</th>
			      <td><a href="<?=base_url()?>uploads/resume/<?=$screenshot?>">click here</a></td>
			    </tr>  -->
			    <tr class="table-row">
			      <th>Url</th>
			      <td><?=$url_source?></td>
			    </tr>

		</table>

	</body>

</html>

