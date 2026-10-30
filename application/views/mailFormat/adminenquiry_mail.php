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

			      <th>Full Name</th>

			      <td><?=isset($name) ? $name : ''?></td> 

			    </tr>

			    <!--<tr class="table-row">-->

			    <!--  <th>First Name</th>-->

			    <!--  <td><?=isset($firstname) ? $firstname : ''?></td> -->

			    <!--</tr>-->

			    <!--<tr class="table-row">-->

			    <!--  <th>Last Name</th>-->

			    <!--  <td><?=isset($lastname) ? $lastname : ''?></td> -->

			    <!--</tr>-->

			    <tr class="table-row">

			      <th>Mobile</th>

			      <td><?=isset($mobile_no) ? $mobile_no : ''?></td>

			    </tr>

				<tr class="table-row">
			      <th>Email</th>
			     <td><?= isset($email_id) ? $email_id : '' ?></td>
			    </tr>
			    
				<?php if(isset($work_experience) && !empty($work_experience)): ?>
				<tr class="table-row">
			      <th>Work Experience</th>
			      <td><?=$work_experience?></td>
			    </tr>
			    <?php endif; ?>

				<?php if(isset($qualification) && !empty($qualification)): ?>
					<tr class="table-row">
					<th>Qualification</th>
					<td><?=$qualification?></td>
				  </tr>
				<?php endif; ?>
				
					<?php if(isset($industry) && !empty($industry)): ?>
    <tr class="table-row">
        <th>Industry</th>
        <td><?=$industry?></td>
    </tr>
<?php endif; ?>
				

			    <tr class="table-row">
			      <th>Course Interested</th>
			      <td><?=$course_intrested?></td>
			    </tr>
			    
			    <tr class="table-row">
    <th>Degree</th>
    <td><?=$degree?></td>
</tr>

			    <tr class="table-row">
			      <th>College Name</th>
			      <td><?=$college_name?></td>
			    </tr>

			    <tr class="table-row">

			      <th>Message</th>

			      <td><?=$message?></td>

			    </tr>

			    <tr class="table-row">

			      <th>Url Source</th>

			      <td><?=$url_source?></td>

			    </tr>
			    <tr class="table-row">
    <th>Best Time to Call</th>
    <td><?= $best_time_call ?></td>
</tr>

<?php if (isset($forwho) && !empty($forwho)): ?>
<tr class="table-row">
    <th>For Who</th>
    <td><?= $forwho ?></td>
</tr>
<?php endif; ?>

			    <tr class="table-row">
			      <th>Form name</th>
			      <td><?=$came_from?></td>
			    </tr>

		</table>



		<!-----<button class="btn btn-primary" id="copy_btn" style="margin-top:10px; height:35px; width: 50%;"> Click to copy</button>------>

	</body>

</html>

