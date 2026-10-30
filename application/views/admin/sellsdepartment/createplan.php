<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>create plan </title>
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
    </style>
  </head>
  <body>
     <div class="container mt-4">
              <div class="row">
                  <div class="col-sm-2 col-md-3 col-lg-3 col-xl-3"></div>
                  <div class="col-sm-8 col-md-6 col-lg-6 col-xl-6">
                    <!-- $_SESSION['email']; -->
                       <?php
                            $user = $this->session->userdata('user');
                            extract($user);
                        ?>
                     <div class="alert alert-danger print-error-msg" id="error" style="display:none"></div>
                     <h3><? echo $email;?> <button class="btn btn-success mx-2"><a href="<?php echo base_url('admin-create-plan-logout'); ?>" style="color: white;">Logout</a></button></h3>
                    <form id="SubmitCreatePlanForm" method="post" enctype="multipart/form-data" onsubmit="return false">
                        <div class="mb-3">
                          <label for="plan" class="form-label">Plan Name *</label>
                          <input type="text" class="form-control" id="plan" placeholder="StudentName_CourseName_Amount" name="planname">
                        </div>
                        <div class="mb-3">
                          <label for="plan" class="form-label">Plan Description *</label>
                          <textarea class="form-control" id="planDesc" placeholder="Plan Created By" name="plandescription"></textarea>
                        </div>

                        <div class="mb-3">

                          <label for="plan" class="form-label">Billing Frequency *</label><br/>
                           <div class="every-select-dv">every<input type="text" class="every-input-bx" name="everyname"></div>
                           <div class="every-select-plan">
                              <select name="selectplan" class="form-control">
                                <option value="daily">Day(s)</option>
                                <option value="weekly">Week(s)</option>
                                <option selected="" value="monthly">Month(s)</option>
                                <option value="yearly">Year(s)</option>
                              </select>
                           </div>
                        </div>
                        <div class="mb-3">

                          <label for="plan" class="form-label">Billing Amount *</label><br/>
                           <div>Rs<input type="number" class="amount-inpt-box" placeholder="Amount" name="amount">per unit</div>
                        </div>

                        <button class="btn btn-primary">Create Plan</button>
                    </form>
                  </div>
                  <div class="col-sm-2 col-md-3 col-lg-3 col-xl-3"></div>
              </div>    

     </div>

     <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script type="text/javascript">

/*==========Start create plan form ==========*/

$("#SubmitCreatePlanForm" ).submit(function(e){ 

    const formUrl ='<?=base_url()?>Admincreateplan/admin_create_plan_submit_form';   

    const formData = new FormData(this);

    console.log(new FormData(this));

    $.ajax({            

        type:'post',

        url : formUrl,
        data: $('#SubmitCreatePlanForm').serialize(),

        beforeSend: function() {

            $("#enqform-overlay").show();

        },

        success: function(data) {
          if(data){
            $("#SubmitCreatePlanForm" )[0].reset();
            $(".print-error-msg").css('display','none');
            var res =JSON.parse(data);
            if(res.status=='error'){
               $(".print-error-msg").css('display','block');

                $(".print-error-msg").html(res.msg);

             
            }
            else{
               var response =res.response;
               var planid =response.id;
              console.log(response.id);
               window.location.href = "https://www.theiotacademy.co/admin-create-plan-details?planid="+planid; 
            }
          }
        }, 
        error: function () {
          console.log('Error');
        } 

    });

})


/*==========End create plan  Form ==========*/

</script>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
  </body>
</html>