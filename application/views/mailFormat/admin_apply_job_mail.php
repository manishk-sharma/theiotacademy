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
			      <th colspan="2" style="text-align: center; font-size: 16px;background-color:#3A3A3A;color: white;">New Job Application Received</th> 
			    </tr>
			    <tr class="table-row">
			      <th>Applied For</th>
			      <td><?=$emp_job_category?></td>
			    </tr>
			     <tr class="table-row">
			      <th>Employee Name</th>
			      <td><?=$emp_name ?></td>
			    </tr>
			     <tr class="table-row">
			      <th>Mobile No.</th>
			      <td><?=$emp_mobile ?></td>
			    </tr>
			    <tr class="table-row">
			      <th>Email</th>
			      <td><?=$emp_email?></td>
			    </tr>
			     <tr class="table-row">
			      <th>Apply Date</th>
			      <td><?=$created_date?></td>
			    </tr>
			    <tr class="table-row">
			      <th>Url Source</th>
			      <td><?=$url_source ?></td>
			    </tr>
		</table>
	</body>
</html>
