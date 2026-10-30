<?php
if ($this->session->userdata("user")) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Assignment Dashboard</title>
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
        .live_test_report_dv{
            max-height: 500px;
            overflow: auto;
            margin-bottom: 50px !important;
        }
        .chart-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 30px;
        }
        canvas {
            width: 100% !important;
        }
        /* .change_bg_color_tb tr:nth-child(odd) {
           background-color: #FCD8CD !important;
        } */
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
                                <div class="ps-4 iconic">
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
                                <div class="ps-4 iconic"  style="background: #dededf;">
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
                     <h3 class="mt-4 mb-4">User Project Submission Report</h3>

    <div class="row mt-4">
        <div class="col-md-8">
            <div class="chart-card ">
                <h5 class="text-center">Submission Status Per Topic</h5>
                <canvas id="barChart"></canvas>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-md-4">
            <div class="chart-card">
                <h5 class="text-center">Overall Submission Completion</h5>
                <canvas id="pieChart"></canvas>
            </div>
        </div>

    </div>
            
        <div class="table-responsive my-3 live_test_report_dv">
        <table id="member_data" class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Sr. Number</th>
                    <th class="text-center">Topic Name</th>
                    <th class="text-center" s>Date Range</th>
                    <th class="text-center">Type Of Project</th>
                    <th class="text-center">Marks</th>
                    <th class="text-center">Uploaded Date</th>
                </tr>
            </thead>
            <tbody class="change_bg_color_tb">
                <?php 
                if(!empty($members))
                {   $no_id=1;
                    foreach($members as $row)
                    { 
                        ?>
                        <tr>
                            <td><?php echo $no_id; ?></td>
                            <td class="text-center" style="text-transform:capitalize;"><?php echo $row['topic_name']; ?></td>
                           <td class="text-center" style="text-transform: capitalize;">
                                <?php 
                                    $formatted_date = preg_replace('/(\d+)([A-Za-z]+)/', '$1 $2', $row['date_range']);
                                    echo $formatted_date;
                                ?>
                            </td>
                            <td class="text-center" ><?php echo $row['type_of_project']; ?></td>
                            <td class="text-center"><?php echo $row['marks']; ?></td>
                            <td class="text-center"><?php echo date("d-m-Y", strtotime($row['created_at'])) ; ?></td>
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
                

<?php
$topic_name = [];
$date_range = [];
$marks = [];

if (!empty($members)) {
    foreach ($members as $row) {
        $topic_name[] = $row['topic_name'];
        $date_range[] = $row['date_range'];
        $marks[] = is_numeric($row['marks']) ? (float)$row['marks'] : 0;
    }
}?>
<script>
    const totalMarks = 20;

    // Labels and marks (from PHP)
    const topicLabels = <?= json_encode(array_map(fn($t, $d) => "$t ($d)", $topic_name, $date_range)) ?>;
    const marksData = <?= json_encode($marks) ?>;

    // --- BAR CHART ---

    // Dynamic background color based on percentage
    const backgroundColors = marksData.map(marks => {
        const percent = (marks / totalMarks) * 100;
        if (percent >= 90) return '#DFF5E3';   // Green
        if (percent >= 75) return '#FFF9DB';   // Light Yellow
        if (percent >= 50) return '#FFE4CC';   // Amber
        if (percent >= 30) return '#FDDCDC';   // Orange
        return '#F44336';                      // Red
    });

    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: topicLabels,
            datasets: [{
                label: 'Marks (out of 20)',
                data: marksData,
                backgroundColor: backgroundColors,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true },
                tooltip: {
                    callbacks: {
                        label: function(ctx) {
                            const marks = ctx.parsed.y;
                            const percent = ((marks / totalMarks) * 100).toFixed(1);
                            return `Marks: ${marks}/20 (${percent}%)`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: totalMarks,
                    title: {
                        display: true,
                        text: 'Marks'
                    },
                    ticks: {
                        stepSize: 2
                    }
                }
            }
        }
    });

    // --- PIE CHART ---

    // Band definitions
    const bandCategories = {
        'Excellent (90%+)': [],
        'Very Good (75%-89%)': [],
        'Good (50%-74%)': [],
        'Average (30%-49%)': [],
        'Poor (<30%)': []
    };

    // Categorize topics based on percentage
    topicLabels.forEach((topic, i) => {
        const percent = (marksData[i] / totalMarks) * 100;
        if (percent >= 90) {
            bandCategories['Excellent (90%+)'].push(topic);
        } else if (percent >= 75) {
            bandCategories['Very Good (75%-89%)'].push(topic);
        } else if (percent >= 50) {
            bandCategories['Good (50%-74%)'].push(topic);
        } else if (percent >= 30) {
            bandCategories['Average (30%-49%)'].push(topic);
        } else {
            bandCategories['Poor (<30%)'].push(topic);
        }
    });

    const pieLabels = Object.keys(bandCategories);
    const pieData = pieLabels.map(label => bandCategories[label].length);
    const pieColors = ['#DFF5E3', '#FFF9DB', '#FFE4CC', '#FDDCDC', '#F44336'];

    new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
            labels: pieLabels,
            datasets: [{
                data: pieData,
                backgroundColor: pieColors,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label;
                            const topics = bandCategories[label];
                            return [`${label}: ${topics.length} topic(s)`, ...topics.map(t => '• ' + t)];
                        }
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