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
			      <th colspan="2" style="text-align: center; font-size: 16px;background-color:#3A3A3A;color: white;">New Application Received </th> 
			    </tr>
			    <tr class="table-row">
			      <th>Name</th>
			      <td><?=$applicant_name?></td>
			    </tr>
			     <tr class="table-row">
			      <th>Mobile No.</th>
			      <td><?=$applicant_mobile ?></td>
			    </tr>
				<tr class="table-row">
			      <th>Email</th>
			      <td><?=$applicant_email ?></td>
			    </tr>
			    <tr class="table-row">
			      <th>Work Experience</th>
			      <td><?=$applicant_work_exp?></td>
			    </tr>
			     <tr class="table-row">
			      <th>Industry</th>
			      <td><?=$applicant_industry?></td>
			    </tr>
			     <tr class="table-row">
			      <th>Download Resume</th>
			      <td><a href="<?=base_url()?>uploads/applicant_resume/<?=$resume_link?>">click here</a></td>
			    </tr>
			    <tr class="table-row">
			      <th>Course Name</th>
			      <td><?=$applicant_came_from?></td>
			    </tr> 
			    <tr class="table-row">
			      <th>Url</th>
			      <td><?=$applicant_url_source?></td>
			    </tr>

		</table>

	</body>

</html>

