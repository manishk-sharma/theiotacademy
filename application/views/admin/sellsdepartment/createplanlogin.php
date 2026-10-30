<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>create plan login</title>
    <style type="text/css">
       .login-row-st{

       	   margin-top: 100px;
       }
       .login-heading{
	        font-size: 20px;
		    font-weight: 700;
		    margin-bottom: 22px;
	}
    </style>
  </head>
  <body>
     <div class="container mt-4">
              <div class="row login-row-st">
                  <div class="col-sm-2 col-md-3 col-lg-3 col-xl-3"></div>
                  <div class="col-sm-8 col-md-6 col-lg-6 col-xl-6">

                     <div class="alert alert-danger print-error-msg" id="error" style="display:none"></div>
                     <?php
                          $msg = $this->session->flashdata('msg');
                          $class = $this->session->flashdata('class');
                          if (isset($msg)) {?>
                        <div id="fadeout-msg" class="alert alert-<?=$class?>">
                            <?=$msg?>
                        </div>
                     <?php }?>

                     <div class="login-heading">Please Login to Create a Plan !</div>
                    <form id="CreatePlanLoginForm" method="post" action="<?=base_url()?>Admincreateplan/admin_create_plan_login_form">
                        <div class="mb-3">
                          <label for="plan" class="form-label">Username</label>
                          <input type="text" class="form-control" id="Username" placeholder="Username" name="username">
                        </div>
                        <div class="mb-3">
                          <label for="plan" class="form-label">Password</label>
                          <input type="password" class="form-control" id="Password" placeholder="Password" name="password">
                        </div>

                        <button class="btn btn-primary" type="submit">login</button>
                    </form>
                  </div>
                  <div class="col-sm-2 col-md-3 col-lg-3 col-xl-3"></div>
              </div>    

     </div>

     <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script type="text/javascript">

/*==========Start create plan form ==========*/



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