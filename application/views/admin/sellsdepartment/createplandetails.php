<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>create plan details</title>
    <style type="text/css">
      .every-select-dv{
        display: inline-block;
      }

     .every-select-plan{
        display: inline-block;
     }
     
      .every-input-bx{
        max-width: 44px;
        min-width: 44px;
        margin: 0 8px 0 5px;
        padding: 5px;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
      }  
      
      .amount-inpt-box{
         width: 157px;
         margin: 0 3px 0 10px;
      }
      .plandetailshd {
          margin: 0 0 23px 0;
          font-size: 21px;
          font-weight: 700;
          border-bottom: 3px solid blue;
      }
      .input-field-dv{
         display: inline-flex;
         width: 100%;
      }
      .input-field-level{
         min-width: 160px;
      }
      .choosetimesubs{
        min-width: 100px;
      }
      .customer-mobile-inp{
        margin: 0 0 0 10px;
      }
      .notifyclc{
        margin: 0 0 0 158px;
      }
      .chooselkexdate{
          margin: 0 0 0 158px;
          top: -18px;
          position: relative;
      }

@media only screen and (max-width: 720px) {
     .every-select-dv{
           display: block;
      }

     .every-select-plan{
          display: block;
     }
     .input-field-dv{
         display: block;
         width: 100%;
      }
}
    </style>
  </head>
  <body>
     <div class="container mt-4">
              <div class="row">
                  <div class="col-sm-2 col-md-3 col-lg-3 col-xl-3"></div>
                  <div class="col-sm-8 col-md-6 col-lg-6 col-xl-6">
                    <div class="alert alert-danger print-error-msg" id="error" style="display:none"></div>
                    <div class="alert alert-success print-success-msg" id="success" style="display:none"></div>
                    <?php
                          $msg = $this->session->flashdata('msg');
                          $class = $this->session->flashdata('class');
                          if (isset($msg)) {?>
                        <div id="fadeout-msg" class="alert alert-<?=$class?>">
                            <?=$msg?>
                        </div>
                     <?php }?>
                     <h3><?=  $_SESSION['email'];?> <button class="btn btn-success mx-2"><a href="<?php echo base_url('admin-create-plan-logout'); ?>" style="color: white;">Logout</a></button>  <button class="btn btn-primary mx-2"><a href="<?php echo base_url('admin-create-plan'); ?>" style="color: white;">Create new Plan</a></button></h3>
                    <div class="plandetailshd">Plan Details</div>
                    <form id="SubmitSubsPlanDetailsForm" method="post" enctype="multipart/form-data" onsubmit="return false">
                        <div class="mb-3 input-field-dv">
                          <label for="plan" class="form-label input-field-level">Select Plan *</label>
                          <input type="text" class="form-control" id="plan" value="<?echo $_GET['planid']?>" name="selectplan" readonly="true">
                        </div>
                          <div style="position: relative;left: 176px;font-weight: 500;bottom: 3px;">Immediate</div>
                        <div class="mb-3 input-field-dv">
                          <label for="plan" class="form-label input-field-level">Start Date *</label>
                                <input type="checkbox" id="myCheck" name="checkstartbox" onclick="onCheck(this);" 
                                style="position: relative;top: -24px;">
                               <input type="date" class="form-control textdate" id="txtdate" name="checkstartdate">
                                <input type="time" class="choosetimesubs" id="txtdatetime" name="checkstarttime">
                        </div>
                        <div class="mb-3 input-field-dv">

                          <label for="plan" class="form-label input-field-level">Total Count *</label><br/>
                           <input type="text" name="totalcount" class="form-control" placeholder="Total Count">
                        </div>
                        <div class="mb-3 input-field-dv">

                          <label for="plan" class="form-label input-field-level">Customer Contact *</label><br/>
                          <input type="email" name="custemail" class="form-control" placeholder="Customer Email">
                          <input type="number" name="custmobile" class="form-control customer-mobile-inp" placeholder="Customer Mobile"> 
                        </div>
                        <!----===<div class="mb-3 input-field-dv">
                          <input type="checkbox" name="checknotifybox" class="notifyclc">Notify Customer
                        </div>==---->  
                        <div class="mb-3 input-field-dv">
                          <label for="plan" class="form-label input-field-level">Link Expire *</label><br/>
                          <input type="checkbox" name="linkexpirebox" id="LkExpireDateid" onclick="onCheckexpdate(this);">No Expire
                        </div>
                        <div class="mb-3 input-field-dv">
                          <input type="date" name="chooselinkexdate" class="chooselkexdate" id="LkExpirechoose" >
                          <input type="time" name="chooselinkexptime"  id="LkExpirechoosetime" style="position: relative;top: -18px; margin: 0 0 0 10px;">
                        </div>
                        <button type="submit" class="btn btn-primary">Create Subscription</button>
                    </form>
                  </div>
                  <div class="col-sm-2 col-md-3 col-lg-3 col-xl-3"></div>
              </div>    

     </div>

     <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script type="text/javascript">


/*==========Start create subcription plan form ==========*/

$("#SubmitSubsPlanDetailsForm" ).submit(function(e){ 

    const formUrl ='<?=base_url()?>Admincreateplan/create_subscription_plan_submit_form';   

    const formData = new FormData(this);

    console.log(new FormData(this));

    $.ajax({            

        type:'post',

        url : formUrl,
        data: $('#SubmitSubsPlanDetailsForm').serialize(),

        beforeSend: function() {

            $("#enqform-overlay").show();

        },

        success: function(data) {
          console.log(data)
          if(data){
            $("#SubmitSubsPlanDetailsForm" )[0].reset();
            $(".print-error-msg").css('display','none');
            var res =JSON.parse(data);
            //alert(res.status);
            if(res.status=='error'){
               $(".print-error-msg").css('display','block');
                $(".print-error-msg").html(res.msg);

            }
            else{
              $(".print-success-msg").css('display','block');
              $(".print-success-msg").html("Subscription Created Successfully");
            }

          }
        }, 
        error: function () {
          console.log('Error');
        } 

    });

})


/*==========End subscription plan   Form ==========*/

</script>

<script language="javascript">

    function onCheck(checkbox) {
  var dateElement = document.getElementById('txtdate');
  var dateElementtime = document.getElementById('txtdatetime');
  dateElement.disabled = checkbox.checked;
  dateElementtime.disabled = checkbox.checked;
  if (checkbox.checked) {
    //dateElement.value = new Date().toISOString().substr(0, 10);
    dateElement.value = '';
    dateElementtime.value='';
  }
  else
    dateElement.value = '';
    dateElementtime.value='';
}

function onCheckexpdate(checkbox) {
  var expireLinkNoti = document.getElementById('LkExpirechoose');
  var expireLinkNotitime = document.getElementById('LkExpirechoosetime');
  expireLinkNoti.disabled = checkbox.checked;
  expireLinkNotitime.disabled = checkbox.checked;
  if (checkbox.checked) {
     expireLinkNoti.value = '';
     expireLinkNotitime.value = '';
  }
  else
    expireLinkNoti.value ='';
    expireLinkNotitime.value = '';
}


</script>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
  </body>
</html>