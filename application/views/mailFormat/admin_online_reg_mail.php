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
			      <th colspan="2" style="text-align: center; font-size: 16px;background-color: #ed3236;color: white;">Online Registration Received</th> 
			    </tr>
			    <tr class="table-row">
			      <th>Student Course</th>
			      <td><?=$student_course?></td>
			    </tr>
			     <tr class="table-row">
			      <th>Student Name</th>
			      <td><?=$student_name ?></td>
			    </tr>
			     <tr class="table-row">
			      <th>Student Mobile No.</th>
			      <td><?=$student_mobile ?></td>
			    </tr>
			    <tr class="table-row">
			      <th>Student Email</th>
			      <td><?=$student_email?></td>
			    </tr>
			     <tr class="table-row">
			      <th>Gender</th>
			      <td><?=$student_gender?></td>
			    </tr>
			     
			     <tr class="table-row">
			      <th>Student Highest Qualification</th>
			      <td><?=$student_highest_qualification?></td>
			    </tr>
			     <tr class="table-row">
			      <th>Student Current Address</th>
			      <td><?=$student_current_address ?></td>
			    </tr>
			    <tr class="table-row">
			      <th>Student Message</th>
			      <td><?=$student_message?></td>
			    </tr>
			    <tr class="table-row">
			      <th>Url Source</th>
			      <td><?=$hash_url ?></td>
			    </tr>
		</table>
	</body>
</html>
