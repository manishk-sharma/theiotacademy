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
			      <th>Name</th>
			      <td><?=$name?></td>
			    </tr>
			     <tr class="table-row">
			      <th>Batch Number</th>
			      <td><?=$batch_number ?></td>
			    </tr>
			    <tr class="table-row">
			      <th>Email</th>
			      <td><?=$email?></td>
			    </tr>
			     <tr class="table-row">
			      <th>Mobile</th>
			      <td><?=$contact?></td>
			    </tr>
			     <tr class="table-row">
			      <th>Address</th>
			      <td><?=$house_number ?></td>
			    </tr>
			    <tr class="table-row">
			      <th>Pincode</th>
			      <td><?=$pincode?></td>
			    </tr>
                <tr class="table-row">
			      <th>City</th>
			      <td><?=$city?></td>
			    </tr>
                <tr class="table-row">
			      <th>State</th>
			      <td><?=$state?></td>
			    </tr>
                <tr class="table-row">
			      <th>Landmark</th>
			      <td><?=$landmark?></td>
			    </tr>
                <tr class="table-row">
			      <th>T-Shirt Size</th>
			      <td><?=$tshirt_size?></td>
			    </tr>
                <tr class="table-row">
			      <th>Came From</th>
			      <td><?=$came_from?></td>
			    </tr>
			    <tr class="table-row">
			      <th>Url Source</th>
			      <td><?=$url_source ?></td>
			    </tr>
		</table>
	</body>
</html>
