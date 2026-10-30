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
        <link rel="icon" href="https://www.theiotacademy.co/assets/images/iot-academy-favicon-32x32.png"
            type="image/x-icon" />
        <link rel="stylesheet" href="<?php echo asset_url() ?>assignment/css/style.css">
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

            .progress_report_assignment {
                color: #000;
                text-decoration: none;
                display: flex;
            }
        </style>
    </head>

    <body>
        <div id="enqform-overlay">
            <div class="enqform-cv-spinner">
                <span class="enqform-spinner"></span>
            </div>
        </div>
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
                                <div class="ps-4 iconic active " onclick="showSection('dashboardSection', this)">
                                    <div class="dashboardList" id="refreshButton">
                                        <span>
                                            <img src="<?php echo asset_url() ?>assignment/images/homedashboard.png"
                                                alt="homeicon" width="20" height="20">
                                        </span>
                                        <p>Dashboard</p>
                                    </div>
                                    <div class="activeWidth"></div>
                                </div>
                                <div class="ps-4 iconic" onclick="showSection('uploadSection', this)">
                                    <div class="dashboardList">
                                        <span>
                                            <img src="<?php echo asset_url() ?>assignment/images/upload.png" alt="Upload"
                                                width="20" height="20" class="uploadIcon">
                                        </span>
                                        <p>Upload Assignment</p>
                                    </div>
                                    <div class="activeWidth"></div>
                                </div>
                                <div class="ps-4 iconic" onclick="showSection('uploadProjectMiniSection', this)">
                                    <div class="dashboardList">
                                        <span>
                                            <img src="<?php echo asset_url() ?>assignment/images/project_management.png"
                                                alt="Project" width="20" height="20" class="uploadIcon">
                                        </span>
                                        <p>Project</p>
                                    </div>
                                    <div class="activeWidth"></div>
                                </div>
                                <div class="ps-4 iconic" onclick="showSection('UpdateProfileSection', this)">
                                    <div class="dashboardList">
                                        <span>
                                            <img src="<?php echo asset_url() ?>assignment/images/user-profile-img.png"
                                                alt="update profile" width="20" height="20">
                                        </span>
                                        <p>Update Profile</p>
                                    </div>
                                    <div class="activeWidth"></div>
                                </div>
                                <div class="ps-4 iconic" onclick="showSection('supportSection', this)">
                                    <div class="dashboardList">
                                        <span>
                                            <img src="<?php echo asset_url() ?>assignment/images/support.png" alt="support"
                                                width="20" height="20">
                                        </span>
                                        <p>Support</p>
                                    </div>
                                    <div class="activeWidth"></div>
                                </div>
                                <div class="ps-4 iconic">
                                    <div class="dashboardList">
                                        <a href="<?= base_url() ?>user-attendance-report"
                                            class="progress_report_assignment"><span>
                                                <img src="<?php echo asset_url() ?>assignment/images/progress-report-assignment.png"
                                                    alt="" width="20" height="20">
                                            </span> &nbsp;Progress Report</a>
                                    </div>
                                    <div class="activeWidth"></div>
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
                <div class="dashboardHeader">
                    <div class="visitNav">
                        <h2>Dashboard</h2>
                    </div>
                    <div class="rightsearchSect" style="position:relative;">
                        <button onclick="darkModeHandler()" class="themeHandler">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#A3AED0"
                                class="bi bi-sun-fill themeMode" viewBox="0 0 16 16">
                                <path
                                    d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#A3AED0"
                                class="bi bi-moon-fill themeMode" viewBox="0 0 16 16">
                                <path
                                    d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278" />
                            </svg>
                        </button>
                        <div>
                            <button type="button" class="informationMoadl" data-bs-toggle="modal"
                                data-bs-target="#informationModal" data-bs-whatever="@mdo" title="info of Guidance"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#A3AED0"
                                    stroke-width="0.4" stroke="#A3AED0" class="bi bi-info-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                    <path
                                        d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                </svg></button>
                        </div>
                        <div>
                            <button class="btn" type="button" data-bs-toggle="collapse" style="border: none; padding:0;"
                                data-bs-target="#collapseWidthExample" aria-expanded="false"
                                aria-controls="collapseWidthExample">
                                <span class="profileimg">
                                    <?php
                                    if (explode('_', $data['profile'])[0] == explode(' ', $data['username'])[0]) { ?>
                                        <img src="<?php echo base_url() ?>uploads/assignmentuser/<?php echo $data['profile'] ?>"
                                            width="41" height="41" alt="user profile image">
                                    <?php } else { ?>
                                        <img src="<?php echo base_url() ?>assets/assignment/images/user-profile-img.png"
                                            width="41" height="41" alt="user profile image">
                                    <?php } ?>

                                </span>
                            </button>
                            <div style="min-height: 55px;position:absolute;top: 57px;left:0;z-index: 1;">
                                <div class="collapse collapse-horizontal" id="collapseWidthExample">
                                    <div class="card card-body logoOuterDiv">
                                        <div class="text-left">
                                            <a href="<?php echo base_url() ?>assignment-logout"
                                                class="btn btn-danger d-block">Log Out</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="dashboardSection" class="content-section active">
                    <div class="row mr-4">
                        <div class="col-12 col-md-7 col-lg-4 detailsCard">
                            <div class="profilecover">
                            </div>
                            <div class="profileUserImage">

                                <?php
                                $profileFirstWord = explode('_', trim($data['profile']))[0];
                                $usernameFirstWord = explode(' ', trim($data['username']))[0];

                                if (strtolower($profileFirstWord) == strtolower($usernameFirstWord)) { ?>
                                    <img src="<?php echo base_url('uploads/assignmentuser/' . $data['profile']); ?>" width="100"
                                        height="100" alt="user profile image">
                                <?php } else { ?>
                                    <img src="<?php echo base_url('assets/assignment/images/user-profile-img.png'); ?>"
                                        width="100" height="100" alt="user profile image">
                                <?php }
                                ?>

                                <h4><?php echo ucwords(str_replace("_", " ", $data['username'])); ?></h4>
                                <p><?php echo $data['course'] ?></p>
                            </div>

                            <div class="d-flex justify-content-between ps-4 pe-4">
                                <div class="detailsUDse">
                                    <div>
                                        <h4>Email Address</h4>
                                        <p><?php echo $data['email'] ?></p>
                                    </div>
                                    <div>
                                        <h4>DOB</h4>
                                        <p><?php echo  date('d/m/Y', strtotime($data['dob'])); ?></p>
                                    </div>

                                </div>

                                <div class="detailsUDse">
                                    <div>
                                        <h4>Mobile No</h4>
                                        <p><?php echo $data['mobile'] ?></p>
                                    </div>
                                    <div>
                                        <h4>Batch</h4>
                                        <p><?php echo $data['batch'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="detailsUDse anotheordetai">
                                <div class="prfcolor">
                                    <span></span>
                                    <p>Performance</p>
                                </div>
                                <div>
                                    <select name="" id="seecteie" placeholder="Select Assignment">
                                        <?php if ($assignmentdata[0]['assignment_pdf']) {
                                            echo "<option value='0'>-Select Assignment-</option>";
                                            foreach ($assignmentdata as $row) { ?>
                                                <option value="<?php echo $row['marks'] ?>">
                                                    <?php echo str_replace(" ", " ", ucwords(str_replace("_", " ", $row['title']))); ?>
                                                </option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div id="main"></div>
                        </div>
                        <div class="col-12 col-md-5 col-lg-3 pe-0 prgrDiv">
                            <div class="prgresDe">
                                <div class="midDiv">
                                    <div class="iconHe">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                fill="currentColor" class="bi bi-cloud-check" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M10.354 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                                                <path
                                                    d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383m.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z" />
                                            </svg>
                                        </span>
                                    </div>
                                    <h4>Assignments Progress</h4>
                                    <p>Supervise your drive space <br> in the easiest way</p>
                                </div>

                                <div>
                                    <div class="prgrsData">
                                        <p>
                                            <?php if ($assignmentdata[0]['assignment_pdf']) {
                                                echo "Uploaded: " . count($assignmentdata);
                                            } else {
                                                echo "Uploaded: 0";
                                            }
                                            ?>
                                        </p>
                                        <p>Total: 15</p>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress-fill" id="progressFill"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 eventsDetailsCard mt-3">
                                <h4>Events and News</h4>
                                <?php foreach ($newsupdate as $news) {
                                    $ndate = date('y/m/d', strtotime($news['created_at']));
                                    $newdate = date('y/m/d', strtotime('-5 days'));
                                ?>
                                    <div class="evntsNewsCard">
                                        <span><?php if ($newdate < $ndate) {
                                                    echo "<span class='badge text-bg-danger position-absolute top-0 end-0 bagesNewNotification'>New</span>";
                                                } else {
                                                    echo "";
                                                }
                                                ?></span>
                                        <p><?php echo date('d/m/Y', strtotime($news['created_at'])); ?></p>
                                        <div class="eventhedr">
                                            <h4><?php echo $news['title'] ?></h4>
                                        </div>
                                        <p><?php echo $news['description'] ?></p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-5 prgrDiv22">
                            <div class="applctonStatus">
                                <div class="assgnmentstatus">
                                    <h4>Assignment Status</h4>
                                </div>
                                <table class="tableAssignment">
                                    <thead>
                                        <tr>
                                            <th>Topic </th>
                                            <th>file</th>
                                            <th>Marks</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($assignmentdata[0]['assignment_pdf']) {
                                            foreach ($assignmentdata as $row) {
                                                $title = str_replace(" ", " ", ucwords(str_replace("_", " ", $row['title'])));
                                                $marks = $row['marks'];
                                                $pdf = $row['assignment_pdf'];
                                                $status = $row['status'];
                                                $date = date('d/m/y', strtotime($row['created_at']));
                                                if ($status == 0) {
                                                    $newstatus = '<span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="orange" class="bi bi-hourglass" viewBox="0 0 16 16">
                                                                        <path d="M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5m2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702c0 .7-.478 1.235-1.011 1.491A3.5 3.5 0 0 0 4.5 13v1h7v-1a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351v-.702c0-.7.478-1.235 1.011-1.491A3.5 3.5 0 0 0 11.5 3V2z"/>
                                                                    </svg>
                                                                  </span>
                                                                  <span style="color:orange;">Pending</span>';
                                                } elseif ($status == 1) {
                                                    $newstatus = '<span>
                                                                    <svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="16"
                                                                        height="16"
                                                                        fill="#05CD99"
                                                                        class="bi bi-check-circle-fill"
                                                                        viewBox="0 0 16 16"
                                                                    >
                                                                        <path
                                                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"
                                                                        />
                                                                    </svg>
                                                                    </span>
                                                                    <span style="color:#05CD99;">
                                                                        Approved
                                                                    </span>';
                                                } else {
                                                    $newstatus = '<span>
                                                                    <svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="16"
                                                                        height="16"
                                                                        fill="#EE5D50"
                                                                        class="bi bi-x-circle-fill"
                                                                        viewBox="0 0 16 16"
                                                                    >
                                                                        <path
                                                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"
                                                                        />
                                                                    </svg>
                                                                </span>
                                                                <span>Disable</span>
                                                                ';
                                                }
                                                if ($marks == "") {
                                                    $nmarks = '--';
                                                } elseif ($marks != "") {
                                                    $nmarks = $marks;
                                                }
                                                echo "<tr>
										<td>$title</td>
										<td><a href='" . $pdf . "'><img src='" . asset_url() . "/assignment/images/qnsicon.png" . "' width='20'></a></td>
										<td>$nmarks</td>
										<td style='display:flex; column-gap:2px;'>$newstatus</td>
										<td>$date</td>
									    </tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='5'><p class='h4 mt-3 text-center'>There Is No Data Found.</p></td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="uploadSection" class="content-section">
                    <div class="upload-assignment-section">
                        <h4>Upload Your New Assignment </h4>
                        <div class="uploadDoassign">
                            <p class="text alert alert-success" id="SuccessMsg" style="display:none;"></p>
                            <form id="UploadAssignment" method="post" enctype="multipart/form-data" onsubmit="return false">
                                <div class="mb-3">
                                    <label class="form-label labelName">Assignment Topic</label>
                                    <input type="hidden" class="form-control" name="userid"
                                        value="<?php echo $data['id'] ?>" />
                                    <select class="form-control" name="assignment-topic">
                                        <option value="">--Select Your Assignment Topic--</option>
                                        <option value="python">01: Python Basics</option>
                                        <option value="numpy">02: Numpy</option>
                                        <option value="pandas">03: Pandas</option>
                                        <option value="data_visualization">04: Data Visualization</option>
                                        <option value="tableau">05: Tableau</option>
                                        <option value="powerBI">06: PowerBI</option>
                                        <option value="EDA">07: EDA</option>
                                        <option value="Maths_and_Descriptive_Stats">08: Maths and Descriptive Stats</option>
                                        <option value="inferential_stats_probability">09: Inferential Statistics &
                                            Probability
                                        </option>
                                        <option value="sql">10: SQL</option>
                                        <option value="linear_and_logistic_regression">11: Linear and Logistic Regression
                                        </option>
                                        <option value="supervised_ML">12: Supervised ML</option>
                                        <option value="unsupervised_ML">13: Unsupervised ML</option>
                                        <option value="ANN_and_CNN">14: ANN and CNN</option>
                                        <option value="NLP_and_RNN">15: NLP and RNN</option>
                                        <option value="GenAI_and_Agentic_AI">16: GenAI and Agentic AI</option>
                                        <option value="Hf-ecosystem-and-prompt-engineering">17: HF Ecosystem and Prompt
                                            Engineering
                                        </option>
                                    </select>
                                </div>
                                <div class="uploadAssignmentSection">
                                    <div class="uploadparetdiv">
                                        <div class="uploadFileses">
                                            <label class="form-label" style="display: none;">Select Assignment (Only In
                                                Pdf or ipynb)</label>
                                            <input type="file" class="form-control" name="assignment" id="docsAssignment">
                                        </div>
                                        <div class="showdetlsUpld">
                                            <div id="ChangeUploadedIcon">
                                                <span><img src="<?php echo asset_url(); ?>assignment/images/upload.png"
                                                        alt="upload-icon" width="60" height="60"></span>
                                                <h4>Upload File</h4>
                                            </div>
                                            <p class="pdftext">(Max Size 6MB).</p>
                                        </div>
                                    </div>
                                    <div class="uploadDetails">
                                        <h4>Upload Your Assignment</h4>
                                        <p>
                                            Submit your assignment here for a comprehensive analysis, rapid review, and
                                            precise scoring.
                                        </p>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="UpdateProfileSection" class="content-section">
                    <div class="upload-assignment-section">
                        <h4>Enhance Your Profile Information Here </h4>
                        <div class="update_profile_dassign">
                            <p class="text alert alert-success" id="update_success_msg" style="display:none;"></p>
                            <form id="Update_UserDetails" method="post" enctype="multipart/form-data"
                                onsubmit="return false">
                                <div class="mb-3">
                                    <input type="hidden" class="form-control" name="userid"
                                        value="<?php echo $data['id'] ?>" />
                                    <input type="text" class="form-control" name="fullname" placeholder="Enter Your Name"
                                        value="<?php echo $data['username'] ?>">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="mobile"
                                        placeholder="Enter Your Mobile Number" value="<?php echo $data['mobile'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" style="color: var(--paragraphcolor);">DOB</label>
                                    <input type="date" class="form-control" name="dob" value="<?php echo $data['dob'] ?>">
                                </div>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <div class="mb-3">
                                            <label class="form-label" style="color: var(--paragraphcolor);">Choose Your
                                                Profile
                                                (Only png, jpg and jpeg)</label>
                                            <input type="file" class="form-control" name="profile" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="update_imagedvview">
                                            <img src="<?php echo base_url() ?>uploads/assignmentuser/<?php echo $data['profile'] ?>"
                                                alt="profile img" width="50" height="50">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="supportSection" class="content-section">
                    <div class="sectSupportDiv active">
                        <div class="support-form d-flex justify-content-center align-items-center">
                            <!-- <div class="text-center pt-4 pb-4">
                                <button type="submit" class="btn btn-primary btn btnSubmitSupport"
                                    onclick="supportFormHandler()">Create Ticket</button>
                                <p>Need Help? We're Just a Ticket Away!</p>
                            </div> -->
                        </div>

                        <div class="mt-4">
                            <div class="applctonStatus">
                                <div class="assgnmentstatus">
                                    <h4>Ticket Status</h4>
                                </div>
                                <table class="tableAssignment">
                                    <thead>
                                        <tr>
                                            <th>Subject </th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        if (!empty($userfeedback_content)) {
                                            foreach ($userfeedback_content as $feedbak_result) {
                                        ?>
                                                <tr>
                                                    <td><?= $feedbak_result['title'] ?></td>
                                                    <td><?= $feedbak_result['description'] ?></td>
                                                    <td>
                                                        <?php if ($feedbak_result['status'] == '0') {
                                                            echo "<span style='color:#dd8303;'><img src='https://www.theiotacademy.co/assets/assignment/images/pendig-load-icon-fd.png' style='width: 15px;padding: 1px;'/>Pending</span>";
                                                        } elseif ($feedbak_result['status'] == '1') {
                                                            echo "<span style='color:#05CD99;'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16'
                            fill='#05CD99' class='bi bi-check-circle-fill' viewBox='0 0 16 16'>
                            <path
                                d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z' />
                        </svg>Complete</span>";
                                                        } elseif ($feedbak_result['status'] == '2') {
                                                            echo "<span style='color:red;'><img src='https://www.theiotacademy.co/assets/assignment/images/reject-icon-fd.png' style='width: 15px;padding: 1px;'/>Rejected</span>";
                                                        } else {
                                                            echo "<span style='color:red;'><img src='https://www.theiotacademy.co/assets/assignment/images/reject-icon-fd.png' style='width: 15px;padding: 1px;'/>Failed</span>";
                                                        }
                                                        ?>

                                                    </td>
                                                    <td><?= date('d/m/y', strtotime($feedbak_result['updated_at'])); ?></td>
                                                </tr>
                                        <?php }
                                        } else {
                                            echo "<tr><td colspan='4'><h4 class='text-center p-4'>No records found.</h4></td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="sectSupportDiv">
                        <button onclick="backHandler()" class="btn btn-secondary btn mb-4">Back</button>
                        <div class="support-form">
                            <p class="text alert alert-success" id="feedbkMsg" style="display:none;"></p>
                            <form id="RegisterFeedback" method="post" onsubmit="return false">
                                <div>
                                    <input type="hidden" name="user_id" class="form-control"
                                        value="<?php echo $data['id'] ?>" />
                                    <label for="subject" style="color: var(--blue);">Subject*</label>
                                    <input type="text" name="title" class="form-control" />
                                </div>
                                <div class="mt-4">
                                    <label for="Description" style="color: var(--blue);">Description*</label>
                                    <textarea name="description" class="form-control" rows="10"></textarea>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn mt-4 btnSubmitSupport">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="uploadProjectMiniSection" class="content-section">
                    <div class="sectProjectDiv active">
                        <button type="button" class="btn btn-primary project_upload_btn"
                            onclick="ProjectFormHandler()">Submit Project</button>
                        <div class="mt-4">
                            <div class="applctonStatus">
                                <div class="assgnmentstatus">
                                    <h4>Project Status</h4>
                                </div>
                                <table class="tableAssignment">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Project File</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        if (!empty($user_project_detail)) {
                                            $id_no = 1;
                                            foreach ($user_project_detail as $project_result) {
                                        ?>
                                                <tr>
                                                    <td><?= $id_no ?></td>
                                                    <td><?= $project_result['title'] ?></td>
                                                    <td>
                                                        <a href="<?= $project_result['mini_project'] ?>"
                                                            class="btn btn-outline-info btn-sm">file</a>
                                                    </td>
                                                    <td> <span class="text-success">Uploaded</span></td>
                                                    <td><?= date('d/m/y', strtotime($project_result['updated_at'])); ?></td>
                                                </tr>
                                        <?php
                                                $id_no++;
                                            }
                                        } else {
                                            echo "<tr><td colspan='5'><h4 class='text-center p-4'>No records found.</h4></td></tr>";
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="sectProjectDiv">
                        <button onclick="projectbackHandler()" class="btn btn-secondary btn mb-4">Back</button>
                        <div class="upload_mini_project_start_dvc">
                            <div class="upload_min_project_form_ab_dv">
                                <p class="text alert alert-success" id="mn_project_success_msg" style="display:none;"></p>
                                <form id="UploadMiniProjectfrmId" method="post" enctype="multipart/form-data"
                                    onsubmit="return false">
                                    <div>
                                        <h4>Upload Project Here</h4>
                                        <p class="mb-4"><b>Note:</b> Please upload your project carefully. Once uploaded,
                                            you will not be able to edit it.</p>
                                        <input type="hidden" name="userid" class="form-control"
                                            value="<?php echo $data['id'] ?>" />
                                        <label for="subject">Select Your Project Name*</label>
                                        <select name="title" required class="form-control upload_project_inpt">
                                            <option value="" disabled selected>-- Select an option --</option>

                                            <option value="python">01: Python</option>
                                            <option value="python-libraries">02: Python Libraries</option>
                                            <option value="tableau">03: Tableau</option>
                                            <option value="powerBI">04: PowerBI</option>
                                            <option value="EDA">05: EDA</option>
                                            <option value="supervised-ml-regression">06: Supervised ML Regression</option>
                                            <option value="supervised-ml-classification">07: Supervised ML Classification
                                            </option>
                                            <option value="image-classification-using-cnn">08: Image Classification using
                                                CNN</option>
                                            <option value="capstone-1">01: Capstone Project 1</option>
                                            <option value="capstone-2">02: Capstone Project 2</option>
                                            <option value="capstone-3">03: Capstone Project 3</option>
                                            <option value="Industrial-Interview-Questions-Assignment">Industrial Interview
                                                Questions Assignment</option>

                                        </select>
                                    </div>
                                    <div class="mt-4">
                                        <label for="Description">Choose Your Project File (Only
                                            pdf or ipynb)*</label>
                                        <input type="file" class="form-control upload_project_inpt" name="project">
                                    </div>

                                    <div class="text-left">
                                        <button type="submit"
                                            class="btn btn-primary btn mt-4 btnSubmitSupport">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="informationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <button type="button" class="btn-close dmdemopopbtnr" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <div class="modal-body">
                        <div class="guide_container">
                            <h2>Assignment Submission Guidelines</h2>
                            <table class="guide_table">
                                <tr>
                                    <th>#</th>
                                    <th>Guideline</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td><strong>Include Your Name</strong> – Ensure that your full name is clearly mentioned
                                        in the submitted file.</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><strong>File Format</strong> – <b class="text-danger">Please ensure that all
                                            assignments are submitted in Jupyter Notebook (.ipynb) format. Submissions in
                                            any other format will not be accepted. Only Power BI, Tableau, and SQL should be
                                            submitted in PDF.</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><strong>Question Before Answer</strong> – Each question must be written in full
                                        before providing the corresponding answer. Submitting answers only is not permitted.
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><strong>Text Only, No Images</strong> – Do not include screenshots, scanned images,
                                        or pictures in the submission. Only typed text is allowed.</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><strong>No Scanned Handwritten Responses</strong> – Handwritten responses must not
                                        be scanned and submitted. Only properly typed responses will be accepted.</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td><strong>No Output Inclusions</strong> – Only a detailed solution should be included
                                        in the document. It shouldn't include the findings or outputs.</td>
                                </tr>
                            </table>
                            <p><strong>Note:</strong> Submissions that do not comply with these guidelines may be rejected.
                            </p>
                            <p>For any clarifications or queries, please feel free to reach out.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div id="main"></div> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
        <script>
            function supportFormHandler() {
                let selectedSearch = document.querySelectorAll('.sectSupportDiv');
                selectedSearch.forEach((element) => {
                    element.classList.remove('active');
                });
                selectedSearch[1].classList.add('active');
            }

            function backHandler() {
                let selectedSearch = document.querySelectorAll('.sectSupportDiv');
                selectedSearch.forEach((element) => {
                    element.classList.remove('active');
                });
                selectedSearch[0].classList.add('active');
            }

            function ProjectFormHandler() {
                let selectedprojct = document.querySelectorAll('.sectProjectDiv');
                selectedprojct.forEach((element) => {
                    element.classList.remove('active');
                });
                selectedprojct[1].classList.add('active');
            }

            function projectbackHandler() {
                let selectedprojct = document.querySelectorAll('.sectProjectDiv');
                selectedprojct.forEach((element) => {
                    element.classList.remove('active');
                });
                selectedprojct[0].classList.add('active');
            }

            document.getElementById('docsAssignment').addEventListener('change', function() {
                var filename = this.files[0].name;
                console.log(filename);
                document.querySelector('.pdftext').innerText = filename;
                document.querySelector('#ChangeUploadedIcon').innerHTML =
                    '<img src="<?php echo asset_url(); ?>assignment/images/uploaded_file_icon_new.png" width="80">';
            });
            // 
            function darkModeHandler() {
                const currentBlue = getComputedStyle(document.documentElement)
                    .getPropertyValue('--blue')
                    .trim();
                console.log('currentBlue:', currentBlue);

                let themedColor = localStorage.getItem('currentBlue') || currentBlue;

                if (themedColor === '#100033') {
                    // Switch to Light Mode
                    document.documentElement.style.setProperty('--blue', 'white');
                    document.documentElement.style.setProperty('--white', '#100033');
                    document.documentElement.style.setProperty('--bodybackground', '#100033');
                    document.documentElement.style.setProperty('--paragraphcolor', 'white');

                    document.querySelector('.logoaside').setAttribute('src',
                        "https://www.theiotacademy.co/assets/assignment/images/iot-logo.png");
                    document.querySelector('.bi-moon-fill').style.display = 'inline';
                    document.querySelector('.bi-sun-fill').style.display = 'none';

                    // Save the new theme
                    localStorage.setItem('currentBlue', 'white');
                } else {
                    // Switch to Dark Mode
                    document.documentElement.style.setProperty('--blue', '#100033');
                    document.documentElement.style.setProperty('--white', 'white');
                    document.documentElement.style.setProperty('--bodybackground', '#F4F7FE');
                    document.documentElement.style.setProperty('--paragraphcolor', '#707EAE');

                    document.querySelector('.logoaside').setAttribute('src',
                        "https://www.theiotacademy.co/assets/assignment/images/iotbluelogo.png");
                    document.querySelector('.bi-moon-fill').style.display = 'none';
                    document.querySelector('.bi-sun-fill').style.display = 'inline';

                    // Save the new theme
                    localStorage.setItem('currentBlue', '#100033');
                }
            }

            // On page load, apply saved theme
            function applySavedTheme() {
                const savedBlue = localStorage.getItem('currentBlue');
                if (savedBlue) {
                    // Force theme according to saved value
                    if (savedBlue === 'white') {
                        // Light mode
                        document.documentElement.style.setProperty('--blue', 'white');
                        document.documentElement.style.setProperty('--white', '#100033');
                        document.documentElement.style.setProperty('--bodybackground', '#100033');
                        document.documentElement.style.setProperty('--paragraphcolor', 'white');

                        document.querySelector('.logoaside').setAttribute('src',
                            "https://www.theiotacademy.co/assets/assignment/images/iot-logo.png");
                        document.querySelector('.bi-moon-fill').style.display = 'inline';
                        document.querySelector('.bi-sun-fill').style.display = 'none';
                    } else {
                        // Dark mode
                        document.documentElement.style.setProperty('--blue', '#100033');
                        document.documentElement.style.setProperty('--white', 'white');
                        document.documentElement.style.setProperty('--bodybackground', '#F4F7FE');
                        document.documentElement.style.setProperty('--paragraphcolor', '#707EAE');

                        document.querySelector('.logoaside').setAttribute('src',
                            "https://www.theiotacademy.co/assets/assignment/images/iotbluelogo.png");
                        document.querySelector('.bi-moon-fill').style.display = 'none';
                        document.querySelector('.bi-sun-fill').style.display = 'inline';
                    }
                }
            }

            // Call applySavedTheme() once when the page loads
            window.addEventListener('DOMContentLoaded', applySavedTheme);


            // 
            let menutoggle = document.querySelector(".menutoggle");
            menutoggle.addEventListener("click", function() {
                let menuHeader = document.querySelector(".menuSection");
                if (menuHeader.style.display === "block") {
                    menuHeader.style.display = "none";
                } else {
                    menuHeader.style.display = "block";
                }
            });
            document.getElementById("refreshButton").addEventListener("click", function() {
                window.location.reload();
            });

            function removeTags(str) {
                if ((str === null) || (str === ''))
                    return false;
                else
                    str = str.toString();
                return str.replace(/(<([^>]+)>)/ig, '');
            }

            document.getElementById("UploadAssignment").addEventListener("submit", function(e) {
                e.preventDefault();
                const formUrl = '<?php echo base_url('upload-assignment-submit'); ?>';
                const formData = new FormData(this);
                document.getElementById("enqform-overlay").style.display = "block";
                fetch(formUrl, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message === "error") {
                            alert(removeTags(data.response));
                            document.getElementById("enqform-overlay").style.display = "none";
                        } else if (data.message === "success") {
                            document.getElementById("enqform-overlay").style.display = "none";
                            const successMsg = document.getElementById('SuccessMsg');
                            successMsg.style.display = 'block';
                            successMsg.innerHTML = data.response;
                            setTimeout(() => {
                                location.reload();
                                successMsg.style.display = 'none';
                            }, 2000);
                            document.getElementById("UploadAssignment").reset();
                        } else {
                            const errorMsg = document.getElementById('Berror-msg');
                            errorMsg.style.display = 'block';
                            errorMsg.innerHTML = data.response;
                            setTimeout(() => {
                                errorMsg.style.display = 'none';
                            }, 15000);
                        }
                    })
            });

            document.getElementById("Update_UserDetails").addEventListener("submit", function(e) {
                e.preventDefault();
                const formUrl = '<?php echo base_url('assignment-user-update-submit'); ?>';
                const formData = new FormData(this);
                document.getElementById("enqform-overlay").style.display = "block";
                fetch(formUrl, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message === "error") {
                            alert(removeTags(data.response));
                            document.getElementById("enqform-overlay").style.display = "none";
                        } else if (data.message === "success") {
                            document.getElementById("enqform-overlay").style.display = "none";
                            const updateMsg = document.getElementById('update_success_msg');
                            updateMsg.style.display = 'block';
                            updateMsg.innerHTML = data.response;
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            const errorMsg = document.getElementById('Berror-msg');
                            errorMsg.style.display = 'block';
                            errorMsg.innerHTML = data.response;
                            setTimeout(() => {
                                errorMsg.style.display = 'none';
                            }, 15000);
                        }
                    })
            });

            document.getElementById("RegisterFeedback").addEventListener("submit", function(e) {
                e.preventDefault();
                const formUrl = '<?php echo base_url('assignment-user-fd-submit'); ?>';
                const formData = new FormData(this);
                document.getElementById("enqform-overlay").style.display = "block";
                fetch(formUrl, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message === "error") {
                            alert(removeTags(data.response));
                            document.getElementById("enqform-overlay").style.display = "none";
                        } else if (data.message === "success") {
                            document.getElementById("enqform-overlay").style.display = "none";
                            const fdMsg = document.getElementById('feedbkMsg');
                            fdMsg.style.display = 'block';
                            fdMsg.innerHTML = data.response;
                            setTimeout(() => {
                                location.reload();
                                fdMsg.style.display = 'none';
                            }, 2000);
                            document.getElementById("RegisterFeedback").reset();
                        } else {
                            const fderMsg = document.getElementById('feedbkMsg');
                            fderMsg.style.display = 'block';
                            fderMsg.innerHTML = data.response;
                            setTimeout(() => {
                                fderMsg.style.display = 'none';
                            }, 15000);
                        }
                    })
            });

            document.getElementById("UploadMiniProjectfrmId").addEventListener("submit", function(e) {
                e.preventDefault();
                const formUrl = '<?php echo base_url('upload-mini-project-submit'); ?>';
                const formData = new FormData(this);
                document.getElementById("enqform-overlay").style.display = "block";
                fetch(formUrl, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message === "error") {
                            alert(removeTags(data.response));
                            document.getElementById("enqform-overlay").style.display = "none";
                        } else if (data.message === "success") {
                            document.getElementById("enqform-overlay").style.display = "none";
                            const updateMsg = document.getElementById('mn_project_success_msg');
                            document.getElementById("UploadMiniProjectfrmId").reset();
                            updateMsg.style.display = 'block';
                            updateMsg.innerHTML = data.response;
                            setTimeout(() => {
                                location.reload();
                                updateMsg.style.display = 'none';
                            }, 2000);

                        } else {
                            const errorMsg = document.getElementById('Berror-msg');
                            errorMsg.style.display = 'block';
                            errorMsg.innerHTML = data.response;
                            setTimeout(() => {
                                errorMsg.style.display = 'none';
                            }, 15000);
                        }
                    })
            });
        </script>
        <script>
            function showSection(sectionId, element) {
                console.log(element);
                console.log(sectionId);

                const sections = document.querySelectorAll('.content-section');
                sections.forEach(section => section.classList.remove('active'));

                const activeSection = document.getElementById(sectionId);
                if (activeSection) {
                    activeSection.classList.add('active');
                }
                const icons = document.querySelectorAll('.iconic');
                icons.forEach(icon => icon.classList.remove('active'));
                element.classList.add('active');
            }

            let selectedValue = document.getElementById('seecteie').value;

            function displaySelectedValue() {
                selectedValue = document.getElementById('seecteie').value;
                updateChart(selectedValue);
            }

            document.getElementById('seecteie').addEventListener('change', displaySelectedValue);

            var chartDom = document.getElementById('main');
            var myChart = echarts.init(chartDom);

            function updateChart(selectedValue) {
                selectedValue = parseFloat(selectedValue);

                var option = {
                    series: [{
                        type: 'gauge',
                        min: 1,
                        max: 20,
                        splitNumber: 9,
                        progress: {
                            show: true,
                            width: 14,
                            roundCap: true,
                            itemStyle: {
                                color: '#1500FF'
                            }
                        },
                        axisLine: {
                            lineStyle: {
                                width: 14
                            }
                        },
                        axisTick: {
                            show: false,
                            color: '#999'
                        },
                        splitLine: {
                            length: 5,
                            lineStyle: {
                                width: 0.8,
                                color: '#999'
                            }
                        },
                        axisLabel: {
                            distance: 10,
                            fontSize: 20,
                            show: false,
                            itemStyle: {
                                borderWidth: 10
                            }
                        },
                        anchor: {
                            show: true,
                            showAbove: true,
                            size: 25,
                            color: '#1500FF',
                            itemStyle: {
                                borderWidth: 10,
                                borderColor: '#1500FF'
                            }
                        },
                        title: {
                            show: false
                        },
                        detail: {
                            valueAnimation: true,
                            fontSize: 20,
                            offsetCenter: [0, '70%']
                        },
                        data: [{
                            value: selectedValue,
                            itemStyle: {
                                color: {
                                    type: 'linear',
                                    x: 0,
                                    y: 0,
                                    x2: 1,
                                    y2: 0,
                                    colorStops: [{
                                            offset: 0,
                                            color: '#1500FF'
                                        },
                                        {
                                            offset: 1,
                                            color: '#FFFFFF'
                                        }
                                    ]
                                }
                            }
                        }]
                    }]
                };
                myChart.setOption(option);
            }

            updateChart(selectedValue);



            function updateProgress(data) {
                percent = data * 100 / 15
                const progressFill = document.getElementById("progressFill");
                if (percent >= 0 && percent <= 100) {
                    progressFill.style.width = percent + "%";
                } else {
                    console.error("Percent value must be between 0 and 100.");
                }
            }
            updateProgress(<?php if ($assignmentdata[0]['assignment_pdf']) {
                                echo count($assignmentdata);
                            } else {
                                echo 0;
                            } ?>)
        </script>

        <script>
            setTimeout(() => {
                var myModal = new bootstrap.Modal(document.getElementById('informationModal'));
                myModal.show();
            }, 2000);
        </script>
    </body>

    </html>
<?php } else {
    redirect(base_url() . "assignment-login");
} ?>