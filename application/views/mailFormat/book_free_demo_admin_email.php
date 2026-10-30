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
			      <th colspan="2" style="text-align: center; font-size: 16px;background-color:#3A3A3A;color: white;">New Demo Received</th> 
			    </tr>
			    <tr class="table-row">
			      <th>Course</th>
			      <td><?=$student_course?></td>
			    </tr>
			     <tr class="table-row">
			      <th>Name</th>
			      <td><?=$student_name ?></td>
			    </tr>
			     <tr class="table-row">
			      <th>Mobile No.</th>
			      <td><?=$student_mobile ?></td>
			    </tr>
			    <tr class="table-row">
			      <th>Email</th>
			      <td><?=$student_email?></td>
			    </tr>
			     <tr class="table-row">
			      <th>Demo Date</th>
			      <td><?=$student_date?></td>
			    </tr>
			     <tr class="table-row">
			      <th>Demo Time</th>
			      <td><?=$student_demo_time ?></td>
			    </tr>
			    <tr class="table-row">
			      <th>Location</th>
			      <td>Online</td>
			    </tr>
			    <tr class="table-row">
			      <th>Url Source</th>
			      <td><?=$hash_url ?></td>
			    </tr>
		</table>
	</body>
</html>
