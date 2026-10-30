<?php  
if($this->session->userdata("logged_in")){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Industrial Visit Certificate Result</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <style type="text/css">
        *{cursor: pointer;margin: 0;padding: 0}
        .sticky {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1;
        }
        .ln_height{line-height: 2.5}
    </style>
</head>
<body>
<header id="myHeader">
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
    <div class="container">
        <a class="navbar-brand" href="industrial-admin-certificate-home">
            <img class="rounded" width="40" hieght="40" src="<?php echo base_url('assets/images/logo.png')?>">
        </a>
        <a class="navbar-brand" href="industrial-admin-certificate-home"><h4 class="text-white">Certificate Pdf</h4></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="main_nav">  
        <ul class="navbar-nav ml-auto text-white">
            <li class="nav-item">
                <a class="nav-link text-white" href="industrial-admin-certificate-home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="industrial-admin-certificate-result">Result</a>
            </li>
            <li class="nav-item">
                <button type="button" name="email_button" class="mx-2 text-white btn btn-primary email_button" id="email_button" data-action="bulk">Send Certificate</button>
            </li>
            
        </ul>
      </div> 
    </div>
    </nav>
</header>
<div class="container-fluid my-2 bg-light px-4">
    <div class="row bg-light border-dark">
        <div class="btn btn-primary btn-block my-2" style="display: none;" id="spiner">
            <span class="spinner-border spinner-border-sm"></span>
                Sending....
        </div>
        <div class="w-100" id="res"></div>
        <!-- Display status message -->
        <?php 
        if(!empty($this->session->flashdata('success_msg')))
        { ?>
        <div class="col-xl-12 p-0 mt-3 text-center">
            <div class="alert alert-success text-center"><?php echo $this->session->flashdata('success_msg'); ?></div>
        </div>
        <?php 
    }
    $this->session->unset_userdata('success_msg'); 
    ?>
    </div>
    <div class="table-responsive px-0">    
        <table id="member_result" class="table table-striped table-bordered p-0">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center"><input type="checkbox" id="selectall" class="mr-2" name="selectall"/>Select All</th>
                    <th class="text-center">#ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>College Name</th>
                    <th class="text-center">View Pdf</th>
                    <th class="text-center">Download Pdf</th>
                    <th class="text-center">Mail Status</th>
                    <th class="text-center">uploaded Date</th>
                    

                </tr>
            </thead>
            <tbody>
            <?php
                if(!empty($members))
                { 
                    $counter = 1;

                    foreach($members as $row)
                    { 
                        ?>
                        <tr style="margin-bottom: 5px;">
                            <td class="text-center ln_height"><input type="checkbox" name="single_select" class="checkboxall mx-2 single_select" id="single_select" data-id="<?php echo $row['id']; ?>"/></td>
                            <td class="text-center ln_height"><?php echo $counter++; ?></td>
                            <td class="ln_height"><?php echo $row['name']; ?></td>
                            <td class="ln_height"><?php echo $row['email']; ?></td>
                            <td class="text-center ln_height"><?php echo $row['college_name']; ?></td>
                            <td class="text-center ln_height"><a class="btn btn-primary" href="<?php echo base_url().'IndustrialVisitAdminCertificate/certificatepdfdetails/'. $row['id'] ?>">View</a></td>
                            <td class="text-center ln_height"><a class="btn btn-primary"  href="<?php echo base_url().'IndustrialVisitAdminCertificate/downloadpdfdetails/'. $row['id'] ?>">Download</a></td>
                            <td class="text-center ln_height">
                                <?php 
                                    if($row['mail_status'] ==1)
                                    {
                                        echo '<span class="text-success mail_stts">Sent</span>';
                                    }

                                    else
                                    {
                                        echo '<span class="text-warning mail_stts">Not Sent</span>';
                                    }
                                ?>
                            </td>
                            <td class="text-center"><?php echo date("d-m-Y", strtotime($row['created_at'])) ; ?></td>
                        </tr>
                    <?php } } else { ?>
                <tr><td colspan="5">No member(s) found...</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- </form> -->
<script type="text/javascript">
    $(document).ready(function()
    {
        $(window).scroll(function() 
        {
            if ($(document).scrollTop() > 0) 
            {
              $("header").addClass("sticky");
            } 
            else {
              $("header").removeClass("sticky");
            }
        });
        $("#selectall").click(function(){
                if(this.checked)
                {
                    $('.checkboxall').each(function(){
                        $(".checkboxall").prop('checked', true);
                    })
                }
                else
                {
                    $('.checkboxall').each(function(){
                        $(".checkboxall").prop('checked', false);
                    })
                }
        });
        $('#email_button').click(function()
        {
            var check = $("input[type=checkbox]:checked").length;
            if(!check)
            {
                alert("You must Check at least One Row!!");
                return false;
            }
            else
            {
                $('#email_button').attr('disabled','disabled');
                //var id = $(this).attr("id");
                var action = $(this).data("action");
                var data_id = [];
                if (action == 'single') 
                {
                    data_id.push({
                        id:$(this).data("id")
                    });
                }
                else
                {
                    $('.single_select').each(function()
                    {
                        if ($(this).prop("checked")==true) 
                        {
                            data_id.push({
                                id:$(this).data("id")
                            });
                        }
                    });
                }
 //=======================Send Mail ===========================               
                $.ajax(
                {
                    url:"<?php echo base_url('industrial-admin-certificate-send');?>",
                    method:"POST",
                    data:{checkID:data_id},
                    beforeSend:function()
                    {
                        $('#res').css("display","none");
                        $('#spiner').css("display","block");
                        $('#email_button').text('Sending.......');
                        $('#email_button').removeClass("btn-primary");
                        $('#email_button').addClass("btn-danger");
                    },
                    success:function(data)
                    {
                        if(data == 'ok')
                        {
                            $('#email_button').addClass("btn-primary");
                            $('#email_button').removeClass("btn-danger");
                            $('#email_button').text('Send Certificate');
                            $('.mail_stts').text('Sent');
                            $('#res').css("display","block");
                            $('#res').html("<div class='alert alert-success text-center my-2'>Mail sent Successfully!!</div>");
                        }
                        else
                        {
                            $('#email_button').addClass("btn-primary");
                            $('#email_button').removeClass("btn-danger");
                            $('#email_button').text('Send Certificate');
                            $('#res1').html(data);
                            $('#res').html("<div class='alert alert-danger text-center my-2'>Please try again!! Mail sent failed!!</div>");
                        }
                       $('#email_button').attr('disabled',false);
                       $('#spiner').css("display","none");    
                    }
                });
            }
        }); 
        $("#member_result").DataTable();
    });






    //======================================Ajax Call====================
    $(function() {
    baseurl=5;
      
    $('#sendMail').click(function(){

      //console.log('true1');

       callAjax('1St time');

      /*if(msg==false){

        clearInterval(interval);
        console.log('true1');
      }*/

      var interval = setInterval(function(){
        
        //console.log('true22');
        var i=0;

        callAjax(i++);

        if(i==5){

        clearInterval(interval);
        console.log('true');
      }

      },10000); // Set time in Ms 110000 Ms = 110 Sec
    
    });

  });


  function callAjax(baseurl) {
    console.log(baseurl);
  }

</script>
</body>
</html>
<?php 
}else{
  redirect(base_url()."login");
}
?>