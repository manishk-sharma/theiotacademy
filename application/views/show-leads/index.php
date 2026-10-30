<?php 
if($this->session->userdata("logged_in")){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Enquiry Leads | The IoT Academy</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
<link rel="icon" href="https://www.theiotacademy.co/assets/images/iot-academy-favicon-32x32.png" sizes="32x32" type="image/png">
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

  <style>
      .tia_enq_notification {
        border: 0px solid transparent;
        background-color: transparent;
        padding: 10px 70px;
        color:white;
        font-size: 20px;
        text-align: center;
        height: 50px;
        box-sizing: border-box;
    }
    .badge {
        color: #fff !important;
        background-color: #ed3236 !important;
    }
	.custom-table-header{
		margin-top:75px;
	}
	.logosofaction a{
		margin: 3px;
		display: contents;
	}
	.logosofaction a img{
		width: 30px;
		padding: 5px;
	}
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary" style="position: sticky;z-index: 99;top: 0">
  <div class="container-fluid" style="width: 100%;">
    <a class="navbar-brand" href="<?=base_url()?>">The IoT Academy</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url()?>application-details-leads">Application Detail Leads</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="<?php echo base_url()?>job-apply-details">Job Apply Details</a>
        </li>
      </ul>
      <span class="navbar-text">
	  <a href="<?php echo base_url()?>download-csv-leads" class="btn btn-primary text-white">Download CSV</a>
	  <a href="<?php echo base_url()?>sign-out" style="color: #ed3236;">Logout</a>

      </span>
    </div>
  </div>
</nav>


	<div class="container-fluid custom-table-header mt-4">
		<div class="table-responsive">
		<table id="LeadsDatatableTablel" class="table table-striped table-bordered">
			<thead>
			  <tr>
				<th scope="col">ID</th>
				<th scope="col">Name</th>
				<th scope="col">Email</th>
				<th scope="col">Mobile</th>
				<th scope="col">Message</th>
				<th scope="col">Course</th>
				<th scope="col">Call Time</th>
				<th scope="col">Experience</th>
				<th scope="col">Came From</th>
				<th scope="col">URL</th>
				<th scope="col"> Date/Time</th>
				<th>Action</th>
			  </tr>
			</thead>
			<tbody>	
            <?php 
				foreach($allLeads as $row){
                    $message = ($row['message'] == "") ? "Null" : $row['message'];
                    $course = ($row['course'] == "") ? "Null" : $row['course'];
                    $best_time_call = ($row['best_time_call'] == "") ? "Null" : $row['best_time_call'];
                    $work_experience = ($row['work_experience'] == "") ? "Null" : $row['work_experience'];
                    $came_from = ($row['came_from'] == "") ? "Null" : $row['came_from'];
                    $url = ($row['url_source'] == "") ? "Null" : $row['url_source'];
				    echo "<tr style='width:100%;'>";
						echo "<td>".$row['id']."</td>";
						echo "<td>".$row['name']."</td>";
						echo "<td>".$row['email_id']."</td>";
						echo "<td>".$row['mobile_no']."</td>";
						echo "<td>".$message."</td>";
						echo "<td>".$course."</td>";
						echo "<td>".$best_time_call."</td>";
						echo "<td>".$work_experience."</td>";
						echo "<td>".$came_from."</td>";
						echo "<td style='white-space:normal;'><a href='".$url."' target='_blank'>".substr($url,0,150)."</a></td>";
						echo "<td>".date('d-m-Y', strtotime($row['created_on']))."</td>";
						echo "<td colspan='3' class='logosofaction'>"."
						 <a href='tel:".$row['mobile_no']."'><img src='https://www.theiotacademy.co/assets/images/phone-iconm.png'></a>
						 <a href='mailto:".$row['email_id']."'><img src='https://www.theiotacademy.co/assets/images/mail-iconm.png'></a>
						 <a href='".$url."'><img src='https://www.theiotacademy.co/assets/images/link-iconm.png'></a>
						 <a href='https://api.whatsapp.com/send?phone=" .$row['mobile_no']. "'><img src='https://www.theiotacademy.co/assets/images/whatsapp-iconm.png'></a>
						  "."</td>";
					  echo "</tr>";
				}
				?>
				
			</tbody>
		</table>
		</div>
	</div>
   <script type="text/javascript">
    $(document).ready( function () {
    $('#LeadsDatatableTablel').DataTable();
} );
</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<?php
}else{
   redirect(base_url()."login") ; 
}
?>
