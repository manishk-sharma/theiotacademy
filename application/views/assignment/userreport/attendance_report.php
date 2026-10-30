<?php
if ($this->session->userdata("user")) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Attendance Report</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <link rel="icon" href="https://www.theiotacademy.co/assets/images/iot-academy-favicon-32x32.png" type="image/x-icon" />    
        <link rel="stylesheet" href="<?php echo asset_url() ?>assignment/css/style.css">
          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>
            #main {
                width: 600px;
                height: 220px;
                width: 100% !important;
                margin: 0px auto;
                display: flex;
                justify-content: center !important;
                align-items: center !important;
            }

            #main div {
                width: 100% !important;
                display: flex;
                justify-content: center !important;
                align-items: center !important;
            }

            #main div canvas {
                width: 100% !important;
                display: flex;
                justify-content: center !important;
                align-items: center !important;
            }
            p a{
                text-decoration: none;
                color: #000;
            }

         .card-custom {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            padding: 20px;
            background: #ffffff;
            height: 420px;
            }
            .chart-container {
            position: relative;
            height: 300px;
            }
            h5 {
            font-weight: 600;
            color: #1e293b;
            }
             .attendance-table_dv{
            max-height: 500px;
            overflow: auto;
        }
        .table-striped>tbody>tr:nth-of-type(odd)>*{
             background-color: #fcd8cd94 !important;
        }
        .report_anc_btn{
            display: flex;
            color: #000;
            text-decoration: none;
            align-items: center;
        }
        .dashboardList span {
            display: flex !important;
            margin-right: 10px !important;
        }
        </style>
    </head>

    <body>

        <div class="row">
            <div class="col-12 col-md-3 col-lg-2 dashboardParentdiv pb-4">
                <div class="dashboardiotlogo">
                    <div class="phoneMnuHndle">
                        <div class="menutoggle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="var(--blue)"
                                class="bi bi-list" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                            </svg>
                        </div>
                        <div>
                            <img src="<?php echo asset_url() ?>assignment/images/iotbluelogo.png" alt="IoT logo"
                                class="logoaside">
                        </div>
                    </div>
                    <div class="menuSection">
                        <div class="menuHabder">
                            <div class="togglemenus mt-4">
                                <div class="ps-4 iconic">
                                    <div class="dashboardList" id="refreshButton">
                                        <a href="<?=base_url()?>assignment-dashboard" class="report_anc_btn"><span>
                                            <img src="<?php echo asset_url() ?>assignment/images/homedashboard.png"
                                                alt="homeicon" width="20" height="20">
                                        </span>&nbsp; Dashboard</a>
                                    </div>
                                </div>
                                <div class="ps-4 iconic" style="background: #dededf;">
                                    <div class="dashboardList">
                                        
                                       <a href="<?=base_url()?>user-attendance-report" class="report_anc_btn"><span>
                                            <img src="<?php echo asset_url() ?>assignment/images/attendace-report.png" alt="attendance"
                                                width="20" height="20" class="uploadIcon">
                                        </span> &nbsp; Attendance Report</a>
                                    </div>
                                </div>
                                <div class="ps-4 iconic">
                                    <div class="dashboardList">
                                         <a href="<?=base_url()?>user-assignment-mini-live-report" class="report_anc_btn"><span>
                                            <img src="<?php echo asset_url() ?>assignment/images/assignment-testing.png" alt="assignment"
                                                width="20" height="20" class="uploadIcon">
                                        </span> &nbsp; Assignment/Mini Test/Live Test Report</a>
                                    </div>
                                </div>
                                <div class="ps-4 iconic">
                                    <div class="dashboardList">
                                        <a href="<?=base_url()?>user-upload-project-report" class="report_anc_btn"><span>
                                            <img src="<?php echo asset_url() ?>assignment/images/poject-report-icon.png" alt="report"
                                                width="20" height="20">
                                        </span> &nbsp; Project Report</a>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="text-left" style="width: 90%; margin:0 auto;">
                                <a href="<?php echo base_url() ?>assignment-logout" class="btn btn-danger d-block">Log
                                    Out</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Main Content -->
            <div class="col-12 col-md-9 col-lg-10">
                <div class="container">
                     <h3 class="mt-4 mb-4">User Attendance Report</h3>
                     <div class="row g-4">
                
                <div class="col-md-12">
                <div class="card-custom">
                    <h5 class="text-center mb-3">Attendance Bar Chart</h5>
                    <div class="chart-container">
                    <canvas id="barChart"></canvas>
                    </div>
                </div>
                </div>
            </div>
                        <div class="table-responsive my-3 attendance-table_dv">
        <table id="member_data" class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Sr. Number</th>
                    <th class="text-center">Week</th>
                    <th class="text-center">Week Date</th>
                    <th class="text-center">Attended Class</th>
                    <th class="text-center">uploaded date</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(!empty($members))
                {   $no_id=1;
                    foreach($members as $row)
                    { 
                        if ($row['status']) {
                            $status="<div class='btn-sm text-success text-center'>Issued</div>";
                        }
                        else {
                            $status="<div class='btn-sm text-danger text-center'>Not Issued</div>";
                        }
                        ?>
                        <tr>
                            <td><?php echo $no_id; ?></td>
                            <td class="text-center"><?php echo $row['week_label']; ?></td>
                            <td class="text-center" style="text-transform:capitalize;"><?php echo $row['week_range']; ?></td>
                            <td class="text-center"><?php echo $row['attended_classes']; ?></td>
                            <td class="text-center"><?php echo date("d-m-Y", strtotime($row['created'])) ; ?></td>
                        </tr>
                    <?php $no_id++;} } else { ?>
                <tr><td colspan="5">No member(s) found...</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
            
        </div>
    </div>
</div>
                
       
        <!-- <div id="main"></div> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>

        <?php
        $weekLabels = [];
        $attendanceValues = [];

        if (!empty($members)) {
            foreach ($members as $row) {
                $weekLabels[] = $row['week_range'];
                $attendanceValues[] = ($row['attended_classes'] / 2) * 100; // 2 classes = 100%
            }
        }
?>
<script>
  const weekDates = <?php echo json_encode($weekLabels); ?>;
  const attendancePercentage = <?php echo json_encode($attendanceValues); ?>;

  // 🎯 Generate background colors based on attendance percentage
  const backgroundColors = attendancePercentage.map(value => {
    if (value === 100) return '#687FE5';     
    if (value === 50) return '#BDDDE4';      
    if (value === 0) return '#9EC6F3';    
    return '#3b82f6'; 
  });

  // 🧱 Bar Chart
  new Chart(document.getElementById('barChart').getContext('2d'), {
    type: 'bar',
    data: {
      labels: weekDates,
      datasets: [{
        label: 'Attendance %',
        data: attendancePercentage,
        backgroundColor: backgroundColors,  // ✅ Dynamic colors
        borderRadius: 10,
        barThickness: 40
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true,
          max: 100,
          title: {
            display: true,
            text: 'Percentage (%)'
          }
        }
      },
      plugins: {
        legend: { display: false },
        tooltip: {
          callbacks: {
            label: ctx => `Attendance: ${ctx.parsed.y.toFixed(0)}%`
          }
        }
      }
    }
  });
</script>



        <script>
            function darkModeHandler() {
                const currentBlue = getComputedStyle(document.documentElement).getPropertyValue('--blue').trim();

                if (currentBlue === '#100033') {
                    document.documentElement.style.setProperty('--blue', 'white');
                    document.documentElement.style.setProperty('--white', '#100033');
                    document.documentElement.style.setProperty('--bodybackground', '#100033');
                    document.querySelector('.logoaside').setAttribute('src',
                        "https://www.theiotacademy.co/assets/assignment/images/iot-logo.png");
                    document.querySelector('.bi-moon-fill').style.display = 'inline';
                    document.querySelector('.bi-sun-fill').style.display = 'none';
                } else {
                    document.documentElement.style.setProperty('--blue', '#100033');
                    document.documentElement.style.setProperty('--white', 'white');
                    document.documentElement.style.setProperty('--bodybackground', '#F4F7FE');
                    document.querySelector('.logoaside').setAttribute('src',
                        "https://www.theiotacademy.co/assets/assignment/images/iotbluelogo.png")
                    document.querySelector('.bi-moon-fill').style.display = 'none';
                    document.querySelector('.bi-sun-fill').style.display = 'inline';
                }
            }
        </script>
</body>

    </html>
<?php } else {
    redirect(base_url() . "assignment-login");
} ?>