<!DOCTYPE html>

<html>

	<head>

		<!-- bootstrap v4 css -->

	    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/bootstrap.min.css">

	    <style type="text/css">

	    	table{

	    		border-collapse: collapse;

	    	}

	    	.table-row:nth-child(even){

	    		background-color: #eee !important;

	    	}

	    </style>



	    <script type="text/javascript">

			var copyBtn = document.querySelector('#copy_btn');

			copyBtn.addEventListener('click', function () {

				alert(true);

			  var urlField = document.querySelector('table');

			   

			  // create a Range object

			  var range = document.createRange();  

			  // set the Node to select the "range"

			  range.selectNode(urlField);

			  // add the Range to the set of window selections

			  window.getSelection().addRange(range);

			   

			  // execute 'copy', can't 'cut' in this case

			  document.execCommand('copy');

			}, false);

		</script>

	</head>

	<body>

		<table class="table table-bordered" border="1" cellspacing="0" cellpadding="10">

			    <tr class="table-row">

			      <th>Name</th>

			      <td><?=$fullname?></td> 

			    </tr>

			    <tr class="table-row">

			      <th>Mobile</th>

			      <td><?=$mobile?></td>

			    </tr>

				<tr class="table-row">
			      <th>Email</th>
			      <td><?=$email?></td>
			    </tr>
				<tr class="table-row">
			      <th>Qualification</th>
			      <td><?=$qualification?></td>
			    </tr>

			    <tr class="table-row">
			      <th><?=$q1?></th>
			      <td><?=$a1?></td>
			    </tr>
                <tr class="table-row">
			      <th><?=$q2?></th>
			      <td><?=$a2?></td>
			    </tr>
                <tr class="table-row">
			      <th><?=$q3?></th>
			      <td><?=$a3?></td>
			    </tr>
                <tr class="table-row">
			      <th><?=$q4?></th>
			      <td><?=$a4?></td>
			    </tr>
                <tr class="table-row">
			      <th><?=$q5?></th>
			      <td><?=$a5?></td>
			    </tr>
                <tr class="table-row">
			      <th><?=$q6?></th>
			      <td><?=$a6?></td>
			    </tr>
                <tr class="table-row">
			      <th><?=$q7?></th>
			      <td><?=$a7?></td>
			    </tr>
                <tr class="table-row">
			      <th><?=$q8?></th>
			      <td><?=$a8?></td>
			    </tr>
                <tr class="table-row">
			      <th><?=$q9?></th>
			      <td><?=$a9?></td>
			    </tr>
                <tr class="table-row">
			      <th><?=$q10?></th>
			      <td><?=$a10?></td>
			    </tr>

		</table>



		<!-----<button class="btn btn-primary" id="copy_btn" style="margin-top:10px; height:35px; width: 50%;"> Click to copy</button>------>

	</body>

</html>

