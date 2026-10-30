<!DOCTYPE html>
<html>
<head>
  <!-- Bootstrap v4 CSS -->
  <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/bootstrap.min.css">
  <style type="text/css">
    table {
      border-collapse: collapse;
      width: 100%;
    }
    .table-row:nth-child(odd) {
      background-color: #f8f9fa !important;
    }
    th {
      background-color: #3A3A3A;
      color: white;
      text-align: left;
      width: 30%;
      padding: 8px;
    }
    td {
      padding: 8px;
    }
  </style>
</head>
<body>
  <table class="table table-bordered" border="1" cellspacing="0" cellpadding="10">
    <tr class="table-row">
      <th colspan="2" style="text-align:center; font-size:16px; background-color:#3A3A3A; color:white;">
        🚀 New Seed Fund Application Received
      </th>
    </tr>

    <tr class="table-row"><th>Full Name</th><td><?= $name ?></td></tr>
    <tr class="table-row"><th>Email Address</th><td><?= $email ?></td></tr>
    <tr class="table-row"><th>Phone Number</th><td><?= $mobile ?></td></tr>
    <tr class="table-row"><th>LinkedIn / Portfolio</th><td><?= $portfolio ?></td></tr>
    <tr class="table-row"><th>Startup Name</th><td><?= $startup_name ?></td></tr>
    <tr class="table-row"><th>Funding Stream</th><td><?= $funding_stream ?></td></tr>
    <tr class="table-row"><th>Problem Statement</th><td><?= $problem_statement ?></td></tr>
    <tr class="table-row"><th>Your Solution</th><td><?= $your_solution ?></td></tr>
    <tr class="table-row"><th>Technology Stack</th><td><?= $technology_stack ?></td></tr>
    <tr class="table-row"><th>Team Size</th><td><?= $team_size ?></td></tr>
    <tr class="table-row"><th>Team Expertise</th><td><?= $team_expertise ?></td></tr>
    <tr class="table-row"><th>Team Description</th><td><?= $team_description ?></td></tr>
    <tr class="table-row"><th>MVP Description</th><td><?= $mvp_description ?></td></tr>
    <tr class="table-row"><th>MVP Demo Link</th><td><?= $mvp_demo_link ?></td></tr>
    <tr class="table-row"><th>Revenue Model</th><td><?= $revenue_model ?></td></tr>
    <tr class="table-row"><th>Target Market</th><td><?= $target_market ?></td></tr>
    <tr class="table-row"><th>Marketing Plan</th><td><?= $marketing_plan ?></td></tr>
    <tr class="table-row"><th>Employment Impact</th><td><?= $employment_impact ?></td></tr>
    <tr class="table-row"><th>Funding Amount Required</th><td><?= $funding_ammount ?></td></tr>
    <tr class="table-row"><th>Funding Utilization Plan</th><td><?= $funding_utilization_plan ?></td></tr>
    <tr class="table-row"><th>Additional Information</th><td><?= $additional_information ?></td></tr>
    <tr class="table-row">
      <th>Submitted On</th>
      <td><?= date('d M Y h:i A', strtotime($created_at)) ?></td>
    </tr>
  </table>
</body>
</html>
