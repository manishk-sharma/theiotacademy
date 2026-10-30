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

.form-control:focus {
    outline: none !important;
    box-shadow: none !important;
    border-color: inherit !important;
}

.all_assign_topdv {
    max-height: 700px;
    overflow: auto;
}
</style>

<div class="container-fluid">
    <?php if ($this->session->flashdata('message')) { ?>
    <div class="alert alert-success">
        <?php echo $this->session->flashdata('message');
        $this->session->unset_userdata('message');
        ?>

    </div>
    <?php } ?>

    <?php if ($this->session->flashdata('assign_success')): ?>
    <div class="alert alert-success">
        <?php
        echo $this->session->flashdata('assign_success');
        $this->session->unset_userdata('assign_success');
        ?>

    </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('assign_error')): ?>
    <div class="alert alert-danger">
        <?php echo $this->session->flashdata('assign_error'); ?>
    </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-sm-3">
            <h4 class="text-left heading mt-1 mb-3">All Users Detail List</h4>
        </div>
        <div class="col-sm-5 d-flex">
            <select name="batch" class="form-control" id="BatchsearchInput">
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
                <option value="Batch-16">Batch-16</option>
            </select>

            <select name="assignment-topic" class="form-control" name="assignment-topic" id="AssignmentTopicInput">
                <option value="">--Select Your Assignment Topic--</option>
                <option value="python">01: Python Basics</option>
                <option value="numpy">02: Numpy</option>
                <option value="pandas">03: Pandas</option>
                <option value="data_visualization">04: Data Visualization</option>
                <option value="tableau">05: Tableau</option>
                <option value="powerBI">06: PowerBI</option>
                <option value="EDA">07: EDA</option>
                <option value="Maths_and_Descriptive_Stats">08: Maths and Descriptive Stats</option>
                <option value="inferential_stats_probability">09: Inferential Statistics &amp; Probability
                </option>
                <option value="sql">10: SQL</option>
                <option value="linear_and_logistic_regression">11: Linear and Logistic Regression</option>
                <option value="supervised_ML">12: Supervised ML</option>
                <option value="unsupervised_ML">13: Unsupervised ML</option>
                <option value="ANN_and_CNN">14: ANN and CNN</option>
                <option value="NLP_and_RNN">15: NLP and RNN</option>
                <option value="GenAI_and_Agentic_AI">16: GenAI and Agentic AI</option>
                <option value="Hf-ecosystem-and-prompt-engineering">17: HF Ecosystem and Prompt Engineering
                </option>
            </select>
            <button type="button" class="btn btn-primary ml-2 btn-sm" style="height: 34px;"
                id="searchBtn">Search</button>
        </div>
        <!-- <div class="col-sm-4">
       <input type="search" name="keypress" class="form-control" placeholder="Search by batch, name, email, course, etc." id="searchInput">
  </div> -->

    </div>

    <div class="all_assign_topdv" id="all-data-div">
        <table id="member_result" class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-left">id</th>
                    <th class="text-left">Name</th>
                    <th class="text-left">Email</th>
                    <th class="text-left">Mobile No.</th>
                    <th class="text-left">Course</th>
                    <th class="text-left">Assignment File</th>
                    <th class="text-left">Assignment Topic</th>
                    <th class="text-left">Batch</th>
                    <th class="text-left">Marks</th>
                    <th class="text-left">Feedback</th>
                    <th class="text-left">Uploaded</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>
            <tbody id="data-body">
                <?php
          if (count($result) > 0) {
            $serial_no = 1;
            foreach ($allresult as $row) { ?>
                <tr>
                    <td><?= $serial_no ?></td>
                    <td><?= $row['username'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['mobile'] ?></td>
                    <td><?= $row['course'] ?></td>
                    <td>
                        <a href="<?= base_url('AssignmentAllUserAdmin/download/' . $row['assignpdfid']) ?>">
                            <img src="https://www.theiotacademy.co/assets/assignment/images/qnsicon.png" width="30">
                        </a>
                    </td>
                    <td><?= ucwords(str_replace('_', ' ', $row['title'])) ?></td>
                    <td><?= $row['batch'] ?></td>
                    <td><?php if (isset($row['marks'])) {
                      echo $row['marks'];
                    } else {
                      echo "Null";
                    } ?></td>
                    <td> <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#staticBackdrop<?= $row['assignpdfid'] ?>">feedback</button></td>
                    <td> <?= date('d-m-Y', strtotime($row['created_at'])) ?></td>
                    <td>
                        <a href="<?= base_url() . 'AssignmentAllUserAdmin/editassignmentmarks/' . $row['assignpdfid'] ?>"
                            class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-danger btn-sm deletebtnvc" data-assign-id="<?= $row['assignpdfid'] ?>"
                            data-toggle="modal" data-target="#deleteModal">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>

                <!-- ✅ Feedback Modal -->
                <div class="modal fade" id="staticBackdrop<?= $row['assignpdfid'] ?>" data-backdrop="static"
                    data-keyboard="false" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php
                      if (!empty($row['feedback'])) {
                        echo $row['feedback'];
                      } else {
                        echo "<h4 class='text-center'>No Record Available</h4>";
                      }
                      ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
              $serial_no++;
            }
          } else { ?>
                <tr>
                    <td colspan="9">
                        <p class="text-center">No Users Found.</p>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <br>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-gradient">
            <div class="modal-body">
                <p>Are you sure you want to delete this assignment?</p>
                <input type="hidden" id="baseurl" value="<?= base_url(); ?>">
            </div>
            <div class="modal-footer">
                <a id="deleteurl" href="#" class="btn btn-danger">Delete</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="searchdeleteModal" tabindex="-1" role="dialog" aria-labelledby="searchdeleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-gradient">
            <div class="modal-body">
                <p>Are you sure you want to delete this assignment?</p>
                <input type="hidden" id="searchbaseurl" value="<?= base_url(); ?>">
            </div>
            <div class="modal-footer">
                <a id="searchdeleteurl" href="#" class="btn btn-danger">Delete</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
        pageLength: 1000,
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
        }]
    });
}

$(document).ready(function() {
    console.log("✅ jQuery version:", $.fn.jquery);
    console.log("✅ DataTables plugin:", $.fn.DataTable);

    // init table first time
    initDataTable();

});

function searchAssignments() {
    var batch = $('#BatchsearchInput').val().trim();
    var topic = $('#AssignmentTopicInput').val().trim();

    // Validation: both required
    if (!batch || !topic) {
        alert("Both Batch and Assignment Topic are required.");
        return; // Stop here if validation fails
    }

    $.ajax({
        type: 'POST',
        url: '<?= base_url('AssignmentAllUserAdmin/searchfunction') ?>',
        data: {
            batchValue: batch,
            topicValue: topic
        },
        dataType: 'json',
        success: function(response) {
            populateDataSearch(response);
        },
        error: function() {
            console.error('Error while fetching search results.');
        }
    });
}

$(document).ready(function() {
    // Trigger search on field change
    // $('#BatchsearchInput').on('change', function () { searchAssignments(); });
    // $('#AssignmentTopicInput').on('change', function () { searchAssignments(); });

    // Trigger search on button click
    $('#searchBtn').on('click', function() {
        searchAssignments();
    });
});


function populateDataSearch(data) {
    var $tbody = $('#data-body');
    $tbody.empty();

    // Remove old modals (to avoid duplicates on new search)
    $('.dynamic-feedback-modal').remove();

    // Utility to escape HTML special characters for textarea
    function escapeHtml(text) {
        if (!text) return '';
        return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    if (data && data.length > 0) {
        let idnom = 1;
        $.each(data, function(index, item) {
            // Format created date
            let createdDate = '';
            if (item.created_at) {
                let d = new Date(item.created_at);
                createdDate =
                    `${String(d.getDate()).padStart(2, '0')}-${String(d.getMonth() + 1).padStart(2, '0')}-${d.getFullYear()}`;
            }

            // Table row
            var row = `
                <tr>
                    <td>${idnom}</td>
                    <td>${item.username}</td>
                    <td>${item.email}</td>
                    <td>${item.mobile}</td>
                    <td>${item.course}</td>
                    <td><a href="<?= base_url('AssignmentAllUserAdmin/download/') ?>${item.assignpdfid}">
                          <img src="https://www.theiotacademy.co/assets/assignment/images/qnsicon.png" width="30">
                        </a></td>
                    <td>${item.title}</td>
                    <td>${item.batch}</td>
                    <td>${item.marks ?? 'Null'}</td>
                    <td>
                        <button type="button" 
                                class="btn btn-success btn-sm" 
                                data-toggle="modal" 
                                data-target="#feedbackModal${item.assignpdfid}">
                            Feedback
                        </button>
                    </td>
                    <td>${createdDate}</td>
                    <td>
                        <a href="<?= base_url() . 'AssignmentAllUserAdmin/editassignmentmarks/' ?>${item.assignpdfid}" 
                           class="btn btn-warning btn-sm">
                           <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-danger btn-sm searchdeletebtnvc" 
                                data-search-assign-id="${item.assignpdfid}" 
                                data-toggle="modal" 
                                data-target="#searchdeleteModal">
                           <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            $tbody.append(row);

            // Modal with textarea for updating feedback
            var modal = `
                <div class="modal fade dynamic-feedback-modal" id="feedbackModal${item.assignpdfid}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <form method="POST" action="<?= base_url("AssignmentAllUserAdmin/update_feedback/") ?>${item.assignpdfid}">
                      <div class="modal-header">
                        <h5 class="modal-title">Feedback for ${item.username}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <div class="modal-body">
                        <textarea class="form-control" rows="5" name="feedback" id="feedbackText${item.assignpdfid}">${escapeHtml(item.feedback || '')}</textarea>
                      </div>

                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                          Save Feedback
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

            `;
            $('body').append(modal);
            idnom++;
        });
    } else {
        $tbody.append(`<tr><td colspan="11"><p class="text-center">No Data Found.</p></td></tr>`);
    }
}
</script>


<script type="text/javascript">
$(document).ready(function() {
    $('.deletebtnvc').on('click', function() {
        var assignId = $(this).data('assign-id');
        var baseurl = $('#baseurl').val();
        $('#deleteurl').attr('href', baseurl + 'AssignmentAllUserAdmin/delete_user_assignment/' +
            assignId);
    });
});

$(document).ready(function() {
    $(document).on('click', '.searchdeletebtnvc', function() {
        var searchassignId = $(this).data('search-assign-id');
        var searchbaseurl = $('#searchbaseurl').val();
        $('#searchdeleteurl').attr('href', searchbaseurl +
            'AssignmentAllUserAdmin/delete_user_assignment/' + searchassignId);
    });
});
</script>



<?php
} else {
  redirect(base_url() . "assignment-login");
} ?>