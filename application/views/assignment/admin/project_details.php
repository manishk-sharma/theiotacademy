<?php
if ($this->session->userdata("user")) {
?>
    <link rel="stylesheet" href="<?php echo asset_url() ?>admin/css/site.css">
    <?php $this->load->view("assignment/admin/common/adminheader.php"); ?>
    <style type="text/css">
        .submitbtn {
            width: 150px;
            border-radius: 25px;
            font-weight: bold;
        }

        .dataTables_info {
            display: none !important;
        }

        .modal-gradient {
            background: rgb(95, 52, 235);
            background: linear-gradient(90deg, rgba(95, 52, 235, 1) 16%, rgba(181, 39, 241, 1) 42%, rgba(215, 37, 90, 1) 92%);
            color: white;
        }

        .pagination .active {
            color: #ff3115 !important;
        }

        .pagination a {
            color: #3e206d;
            padding: 10px;
            margin: 2px;
            font-weight: bolder;
            text-decoration: none;
        }

        .pagination a:hover {
            text-decoration: underline;
        }

        .data-not-found-assign {
            margin-top: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

    <div class="container-fluid">
        <?php if ($this->session->flashdata('pro_success')): ?>
            <div class="alert alert-success">
                <?php
                echo $this->session->flashdata('pro_success');
                $this->session->unset_userdata('pro_success');
                ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('pro_error')): ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('pro_error'); ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-sm-3">
                <h4 class="text-left heading mt-3 mb-3">All User Project Details</h4>
            </div>
            <div class="col-sm-5 d-flex">
                <select class="form-control" id="BatchsearchInput" required>
                    <option value="">--Choose Batch--</option>
                    <option value="Batch-1">Batch-1</option>
                    <option value="Batch-2">Batch-2</option>
                    <option value="Batch-3">Batch-3</option>
                    <option value="Batch-4">Batch-4</option>
                    <option value="Batch-5">Batch-5</option>
                    <option value="Batch-6">Batch-6</option>
                    <option value="Batch-7">Batch-7</option>
                    <option value="Batch-8">Batch-8</option>
                    <option value="Batch-9">Batch-9</option>
                    <option value="Batch-10">Batch-10</option>
                    <option value="Batch-11">Batch-11</option>
                    <option value="Batch-1-6-months">Batch-1 (6 Months)</option>
                    <option value="Batch-2-6-months">Batch-2 (6 Months)</option>
                    <option value="Batch-3-6-months">Batch-3 (6 Months)</option>
                    <option value="Batch-4-6-months">Batch-4 (6 Months)</option>
                    <option value="Batch-5-6-months">Batch-5 (6 Months)</option>
                    <option value="Batch-12">Batch-12</option>
                    <option value="Batch-13">Batch-13</option>
                    <option value="Batch-14">Batch-14</option>
                    <option value="Batch-15">Batch-15</option>
                </select>

                <select name="assignment-topic" class="form-control" id="AssignmentTopicInput" required>
                    <option value="">-- Select an option --</option>
                    <option value="python">01: Python</option>
                    <option value="python-libraries">02: Python Libraries</option>
                    <option value="tableau">03: Tableau</option>
                    <option value="powerBI">04: PowerBI</option>
                    <option value="EDA">05: EDA</option>
                    <option value="supervised-ml-regression">06: Supervised ML Regression</option>
                    <option value="supervised-ml-classification">07: Supervised ML Classification</option>
                    <option value="image-classification-using-cnn">08: Image Classification using CNN</option>
                    <option value="capstone-1">01: Capstone Project 1</option>
                    <option value="capstone-2">02: Capstone Project 2</option>
                    <option value="capstone-3">03: Capstone Project 3</option>
                    <option value="Industrial-Interview-Questions-Assignment">Industrial Interview Questions Assignment
                    </option>
                </select>

                <button type="button" class="btn btn-primary ml-2 btn-sm" style="height: 34px;"
                    id="searchBtn">Search</button>
            </div>
            <div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Download
                    Project</button>
            </div>
            <!-- ✅ Single Table -->
            <div class="col-sm-12 mt-3" style="overflow: auto;">
                <table class="table table-bordered" id="member_result">
                    <thead>
                        <tr>
                            <th class="text-left">id</th>
                            <th class="text-left">User Name</th>
                            <th class="text-left">Email</th>
                            <th class="text-left">Title</th>
                            <th class="text-left">Course</th>
                            <th class="text-left">Batch</th>
                            <th class="text-left">Project</th>
                            <th class="text-left">Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="projectBody">
                        <?php
                        if (!empty($pr_result)) {
                            $number = 1;
                            foreach ($pr_result as $result) {
                        ?>
                                <tr>
                                    <td><?= $number ?></td>
                                    <td><?= $result['name'] ?></td>
                                    <td><?= $result['email'] ?></td>
                                    <td><?= ucwords(str_replace('-', ' ', $result['title'])) ?></td>
                                    <td><?= $result['course'] ?></td>
                                    <td><?= $result['batch'] ?></td>
                                    <td><a
                                            href="<?= base_url('AssignmentAllUserAdmin/download_project/' . $result['id']) ?>">Project</a>
                                    </td>
                                    <td><?= date('d/m/y', strtotime($result['created_at'])) ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-danger btn-sm delete-project" data-project-id="<?= $result['id'] ?>"
                                            data-toggle="modal" data-target="#deleteModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                        <?php
                                $number++;
                            }
                        } else {
                            echo "<tr><td colspan='9'><h3 class='text-center data-not-found-assign'>No Data Is Available.</h3></td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div>
            <?= $pagination_links; ?>
        </div>

    </div>

    <!-- ✅ Single Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-gradient">
                <div class="modal-body">
                    Are you sure?
                    <input type="hidden" id="deleteProjectId">
                    <input type="hidden" id="baseurl" value="<?= base_url(); ?>">
                </div>
                <div class="modal-footer">
                    <a id="deleteurl" href="#" class="btn btn-danger"> Delete </a>
                    <a type="button" data-dismiss="modal" class="btn"> Cancel</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Download Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="batch_result_div">

                        <form id="Download_Batch_Result_submit" method="post" class="form_of_batch_result">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb-2">Choose Batch For Download Result</div>
                                    <select name="batch" class="form-control">
                                        <option value="">--Choose Batch--</option>
                                        <option value="Batch-1">Batch-1</option>
                                        <option value="Batch-2">Batch-2</option>
                                        <option value="Batch-3">Batch-3</option>
                                        <option value="Batch-4">Batch-4</option>
                                        <option value="Batch-5">Batch-5</option>
                                        <option value="Batch-6">Batch-6</option>
                                        <option value="Batch-7">Batch-7</option>
                                        <option value="Batch-8">Batch-8</option>
                                        <option value="Batch-9">Batch-9</option>
                                        <option value="Batch-10">Batch-10</option>
                                        <option value="Batch-11">Batch-11</option>
                                        <option value="Batch-1-Gen-AI">Batch-1-Gen-AI</option>
                                        <option value="Batch-12">Batch-12</option>
                                        <option value="Batch-13">Batch-13</option>
                                        <option value="Batch-14">Batch-14</option>

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-center mt-4 mb-4">
                                    <input class="btn btn-primary p-2 px-4" type="submit" value="Download Result" />
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view("assignment/admin/common/adminfooter.php"); ?>

    <script>
        function initDataTable() {
            if ($.fn.DataTable.isDataTable('#member_result')) {
                $('#member_result').DataTable().destroy();
            }

            $('#member_result').DataTable({
                info: true,
                paging: true,
                pageLength: 1000, // ✅ Default 1000 rows
                ordering: true,
                searching: true,
                lengthChange: true,
                lengthMenu: [
                    [10, 25, 50, 100, 200, 300, 500, 1000],
                    [10, 25, 50, 100, 200, 300, 500, 1000]
                ],
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }],
                language: {
                    emptyTable: "No Data Found."
                }
            });
        }

        $(document).ready(function() {
            // ✅ Initialize table once
            initDataTable();

            // --- Search Function ---
            function searchProjects() {
                var batchValue = $('#BatchsearchInput').val().trim();
                var topicValue = $('#AssignmentTopicInput').val().trim();

                if (!batchValue) {
                    alert("Please select Batch.");
                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('AssignmentAllUserAdmin/project_search_function') ?>',
                    data: {
                        batchValue: batchValue,
                        topicValue: topicValue
                    },
                    dataType: 'json',
                    success: function(response) {
                        populateDataSearch(response);
                    },
                    error: function() {
                        console.error('Error fetching data');
                    }
                });
            }

            // --- Search Trigger (Button) ---
            $('#searchBtn').on('click', function() {
                searchProjects();
            });

            // --- Populate Data Function ---
            function formatTitle(str) {
                if (!str) return '';
                return str
                    .replace(/-/g, ' ') // Replace hyphens with spaces
                    .replace(/\b\w/g, char => char.toUpperCase()); // Capitalize first letter of each word
            }

            function formatDate(str) {
                if (!str) return '';
                var date = new Date(str);
                var day = String(date.getDate()).padStart(2, '0');
                var month = String(date.getMonth() + 1).padStart(2, '0'); // months are 0-based
                var year = String(date.getFullYear()).slice(-2); // get last 2 digits
                return `${day}/${month}/${year}`;
            }

            function populateDataSearch(data) {
                var $table = $('#member_result').DataTable();

                // Clear old data
                $table.clear();

                if (data && data.length > 0) {
                    var count = 1;
                    $.each(data, function(index, item) {
                        $table.row.add([
                            count,
                            item.name,
                            item.email,
                            formatTitle(item.title),
                            item.course,
                            item.batch,
                            `<a href="<?= base_url('AssignmentAllUserAdmin/download_project/') ?>${item.id}" target="_blank">Project</a>`,
                            formatDate(item.created_at),
                            `<button class="btn btn-danger btn-sm delete-project" 
                                data-project-id="${item.id}" 
                                data-toggle="modal" 
                                data-target="#deleteModal">
                        <i class="fa fa-trash"></i>
                    </button>`
                        ]);
                        count++;
                    });
                }

                // Redraw DataTable (this will also show "No Data Found" automatically)
                $table.draw();
            }

            // --- Handle Delete Modal ---
            $(document).on("click", ".delete-project", function() {
                var projectId = $(this).data("project-id");
                var baseurl = $("#baseurl").val();
                $("#deleteurl").attr("href", baseurl + "AssignmentAllUserAdmin/Delete_Single_Project_dtc/" +
                    projectId);
            });
        });
    </script>


    <script>
        function removeTags(str) {
            if ((str === null) || (str === ''))
                return false;
            else
                str = str.toString();
            return str.replace(/(<([^>]+)>)/ig, '');
        }

        document.getElementById("Download_Batch_Result_submit").addEventListener("submit", function(e) {
            e.preventDefault();
            const formUrl = '<?= base_url() ?>AssignmentAllUserAdmin/download_project_user_details_function';
            const formData = new FormData(this);

            fetch(formUrl, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(csvText => {
                    if (!csvText.trim() || csvText.toLowerCase().includes("error")) {
                        alert("Error: No data available or an issue occurred.");
                        return;
                    }
                    let blob = new Blob([csvText], {
                        type: "text/csv"
                    });
                    let link = document.createElement("a");
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "project-report.csv";
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                })
                .catch(error => {
                    console.error("Download Error:", error);
                    alert("Failed to download CSV.");
                });
        });
    </script>
<?php } else {
    redirect(base_url() . "assignment-login");
} ?>