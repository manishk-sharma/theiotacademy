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
	     <h3>  Call Back Enquiry </h3>
		<table class="table table-bordered" border="1" cellspacing="0" cellpadding="10">
				<tr class="table-row" >
			      <th colspan="2" style="text-align: center; font-size: 16px;background-color: #ed3236;color: white;">Call Back Received</th> 
			    </tr>
			    <tr class="table-row">
			      <th>Name</th>
			      <td><?=$name?></td> 
			    </tr>
			    <tr class="table-row">
			      <th>Mobile</th>
			      <td><?=$mobile?></td>
			    </tr>
			    <tr class="table-row">
			      <th>Date</th>

			      <td><?=date('d-M-Y',strtotime($date))?></td>
			    </tr>
			    <tr class="table-row">
			      <th>Time</th>
			      <td><?=date("h:i A",strtotime($time))?></td>
			    </tr>
			    <tr class="table-row">
			      <th>Url Source</th>
			      <td><?=$url_source?>
			      	
			      </td>
			    </tr>
		</table>
	</body>
</html>
