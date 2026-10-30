<?php
if ($this->session->userdata("logged_in")) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Add Certificate Details For Verify Certificate</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="icon" href="https://www.theiotacademy.co/assets/images/logoicon.png" type="image/x-icon" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
        <style type="text/css">
            #importfrm,
            #importfrm1,
            #importfrm2 {
                text-align: center;
                margin-bottom: 10px;
                padding: 10px;
                border: 2px dashed #007bff;
            }

            .ln-height {
                line-height: 2.3;
            }

            * {
                margin: 0;
                padding: 0
            }

            .sticky {
                position: fixed;
                top: 0;
                width: 100%;
                z-index: 1;
            }

            .import__details--text {
                font-size: 20px;
                font-weight: 700;
            }
        </style>
    </head>

    <body>
        <header>
            <nav id="navbar_top" class="navbar navbar-expand-lg navbar-dark bg-info">
                <div class="container-fluid">
                    <a href="<?php base_url() ?>adashboard" class="text-white h4">The IoT Academy admin </a>
                    <h4 class="text-white">Certificate</h4>
                </div>
            </nav>
        </header>
        <div class="text-center"> <button type="button" class="btn btn-primary mt-4 px-4 display-1" data-toggle="modal" data-target="#staticBackdrop">Add Certificate Details</button></div>
        <div class="container-fluid my-5 bg-light border-primary">

            <!-- Data list table -->
            <div class="table-responsive my-3">
                <table id="member_data" class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th class="text-center">Domain</th>
                            <th class="text-center">Certification Id</th>
                            <th class="text-center">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($members)) {
                            $number = 1;
                            foreach ($members as $row) {
                        ?>
                                <tr>
                                    <td><?php echo $number; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['domain_name']; ?></td>
                                    <td class="text-center"><?php echo $row['certification_id']; ?></td>
                                    <td class="text-center"><?php echo date("d-m-Y", strtotime($row['updated'])); ?></td>
    
                                </tr>
                            <?php
                         $number++;    
                        }
                        } else { ?>
                            <tr>
                                <td colspan="5">No member(s) found...</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- modal popup for form -->


        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Student Details For Certificate Verification</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <form action="" method="post" id="Add_Certificate">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputName">Name</label>
                                            <input type="text" class="form-control" name="name" aria-describedby="textHelp">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail">Email</label>
                                            <input type="email" name="email" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputMobile">Mobile</label>
                                            <input type="tel" name="mobile" class="form-control" maxlength="15">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputcerti">Domain</label>
                                            <input type="text" name="domain" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputcerti">Certification Id</label>
                                            <input type="text" name="certification_id" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputcerti">Course Start Date</label>
                                            <input type="date" name="course_start_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputcerti">Course End Date</label>
                                            <input type="date" name="course_end_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputcerti">Issue Date</label>
                                            <input type="date" name="issue_date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-left mb-4"><button type="submit" class="btn btn-primary">Submit</button></div>

                                <div id="ensuccess-msg" class="alert alert-success alert-dismissible fade show mt-3 text-center" style="display:none;">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <Script>
            var baseurl = "https://www.theiotacademy.co/";

            function removeTags(str) {
                if ((str === null) || (str === ''))
                    return false;
                else
                    str = str.toString();
                return str.replace(/(<([^>]+)>)/gi, '');
            }
            document.getElementById("Add_Certificate").addEventListener("submit", function(e) {
                e.preventDefault();
                const formUrl = baseurl + 'Certificatepdf/submit_certificate_function_add_certificate_details';
                const formData = new FormData(this);

                fetch(formUrl, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message === "error") {
                            alert(removeTags(data.response));
                        } else if (data.message === "success") {
                            document.getElementById("Add_Certificate").reset();
                            const successMsg = document.getElementById("ensuccess-msg");
                            successMsg.style.display = 'block';
                            successMsg.innerHTML = data.response;
                            setTimeout(() => {
                                successMsg.style.display = 'none';
                            }, 15000);
                        } else {
                            const errorMsg = document.getElementById('ensuccess-msg');
                            errorMsg.style.display = 'block';
                            errorMsg.innerHTML = data.response;
                            setTimeout(() => {
                                errorMsg.style.display = 'none';
                            }, 15000);
                        }
                    })
            });
        </Script>

        
<script type="text/javascript">
        function formToggle(ID,ID1,ID2){
            var ele1 = document.getElementById(ID);
            var element = document.getElementById(ID1);
            var ele = document.getElementById(ID2);
            if(ele1.style.display === "none"){
                ele1.style.display = "block";
                ele.style.display = "none";
                element.style.display = "none";
            }else{
                ele1.style.display = "none";
                ele.style.display = "none";
                element.style.display = "none";
            }
        }
    $(document).ready(function(){
        $(window).scroll(function() {
            if ($(document).scrollTop() > 0) {
              $("header").addClass("sticky");
            } 
            else {
              $("header").removeClass("sticky");
            }
        });
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
        $('#member_data').DataTable();
    });
</script>
    </body>

    </html>
<?php
} else {
    redirect(base_url() . "login");
}
?>