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
	     <h3>  Join News Letter Enquiry </h3>
		<table class="table table-bordered" border="1" cellspacing="0" cellpadding="10">
				<tr class="table-row" >
			      <th colspan="2" style="text-align: center; font-size: 16px;background-color: #ed3236;color: white;">Join News Letter Received</th> 
			    </tr>
			    <tr class="table-row">
			      <th>Join News Date</th>
			      <td><?=date("d-M-Y H:i A",time())?></td>
			    </tr>
			     <tr class="table-row">
			      <th>Email Address</th>
			      <td><?=$email_id ?></td>
			    </tr>
			    <tr class="table-row">
			      <th>Url Source</th>
			      <td><?=$hash_url ?></td>
			    </tr>
		</table>
	</body>
</html>
