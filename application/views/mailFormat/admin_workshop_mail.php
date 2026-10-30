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
			      <th colspan="2" style="text-align: center; font-size: 16px;background-color:#3A3A3A;color: white;">New Workshop Application Received</th> 
			    </tr>
			    <tr class="table-row">
			      <th>Course</th>
			      <td><?=$course?></td>
			    </tr>
			     <tr class="table-row">
			      <th>Name</th>
			      <td><?=$first_name ?> <?=$last_name?></td>
			    </tr>
			     <tr class="table-row">
			      <th>Mobile No.</th>
			      <td><?=$mobile_no ?></td>
			    </tr>
			    <tr class="table-row">
			      <th>Email</th>
			      <td><?=$email_id?></td>
			    </tr>
			     <tr class="table-row">
			      <th>College Name</th>
			      <td><?=$college_name?></td>
			    </tr>
			    <tr class="table-row">
			      <th>College City</th>
			      <td><?=$college_city ?></td>
			    </tr>
			    <tr class="table-row">
			      <th>Message</th>
			      <td><?=$query?></td>
			    </tr>
		</table>
	</body>
</html>
