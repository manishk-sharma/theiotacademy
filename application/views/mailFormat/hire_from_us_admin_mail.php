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

			      <td><?=$name?></td> 

			    </tr>

			    <tr class="table-row">

			      <th>Mobile</th>

			      <td><?=$mobile_no?></td>

			    </tr>

				<tr class="table-row">
			      <th>Email</th>
			      <td><?=$email_id?></td>
			    </tr>

			    <tr class="table-row">

			      <th>Subject</th>

			      <td><?=$subject?></td>

			    </tr>
                <tr class="table-row">
			      <th>Message</th>
			      <td><?=$message?></td>
			    </tr>
                <tr class="table-row">
			      <th>Form name</th>
			      <td><?=$came_from?></td>
			    </tr>
			    <tr class="table-row">
			      <th>Url Source</th>

			      <td><?=$url_source?></td>

			    </tr>
				

		</table>



		<!-----<button class="btn btn-primary" id="copy_btn" style="margin-top:10px; height:35px; width: 50%;"> Click to copy</button>------>

	</body>

</html>

