<?php  
if($this->session->userdata("logged_in")){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Certificate In Pdf Format Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="icon" href="https://www.theiotacademy.co/assets/images/logoicon.png" type="image/x-icon" /> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <style type="text/css">
        #importfrm,#importfrm1,#importfrm2{
            text-align: center;
            margin-bottom: 10px;
            padding: 10px;
            border: 2px dashed #007bff;
        }
        .ln-height{line-height: 2.3;}
        *{cursor: pointer;margin: 0;padding: 0}
        .sticky {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1;
        }
        .import__details--text{
            font-size: 20px;
            font-weight: 700;
        }
    </style>
</head>
<body>
<header>
    <nav id="navbar_top" class="navbar navbar-expand-lg navbar-dark bg-info">
    <div class="container-fluid">
        <a class="navbar-brand" href="certificate-pdf-home">
            <img class="rounded" width="40" hieght="40" src="<?php echo base_url('assets/images/logo.png')?>">
        </a>
        <a class="navbar-brand" href="certificate-pdf-home"><h4 class="text-white">Certificate</h4></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="main_nav">  
        <ul class="navbar-nav ml-auto text-white">
            <li class="nav-item">
                <a class="nav-link text-white" href="certificate-pdf-home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="certificate-pdf-result">Result</a>
            </li>
            <li class="nav-item">
                <?php 
                $data_name = array(
                        'class'=>'btn btn-success',
                        'onClick'=>'formToggle(\'importfrm\',\'importfrm1\',\'importfrm2\')',
                        'name' => 'import',
                        'value' => 'Import',
                        'type' => 'button'
                    );
                echo form_input($data_name);
            ?>
            </li>
        </ul>
      </div> 
    </div>
    </nav>
</header>
<div class="container-fluid my-5 bg-light border-primary">
    <div class="row bg-light border-dark">
        <!-- Display status message -->

        <?php 
        if(!empty($success_msg = $this->session->flashdata('success_msg')))
        { ?>
            <div class="col-xl-12 py-2">
                <div class="alert alert-success text-center"><?php echo $success_msg; ?></div>
            </div>
        <?php 
        } 
        if(!empty($error_msg = $this->session->flashdata('error_msg')))
        { ?>
        <div class="col-xl-12 py-2">
            <div class="alert alert-danger text-center"><?php echo $error_msg; ?></div>
        </div>
        <?php 
        } 

        if(!empty($warning_msg = $this->session->flashdata('warning_msg')))
        {
        ?>
        <div class="col-xl-12 py-2">
            <div class="alert alert-warning text-center"><?php echo $warning_msg; ?></div>
        </div>
        <?php } ?>
        <!-- File upload form -->
        <div class="col-md-12 mb-2" id="importfrm" style="display: none;">
            <div><p class="alert alert-warning">All Field Heading name should be like that <b>Name Email Mobile Domain Collegename Issuedate Startdate Enddate </b></p></div>
            <p class="import__details--text">Import CSV File Of Member Details</p>
            <form action="certificate-pdf-import" method="post" enctype="multipart/form-data">
                <input type="file" name="file" accept=".CSV" required/>
                <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
            </form>
        </div>

    </div>
        <!-- Data list table -->
    <div class="table-responsive my-3">
        <table id="member_data" class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th class="text-center">Domain</th>
                    <th class="text-center">Certificate Status</th>
                    <th class="text-center">Uploaded Date</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(!empty($members))
                { 
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
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['mobile']; ?></td>
                            <td class="text-center"><?php echo $row['domain_name']; ?></td>
                            <td class="text-center"><?php echo $status; ?></td>
                            <td class="text-center"><?php echo date("d-m-Y", strtotime($row['created'])) ; ?></td>
                        </tr>
                    <?php } } else { ?>
                <tr><td colspan="5">No member(s) found...</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

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
}else{
  redirect(base_url()."login");
}
?>