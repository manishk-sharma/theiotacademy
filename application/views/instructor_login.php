<!DOCTYPE html>
<html lang="en">
<head>
        <!-- meta tag -->
        <meta charset="utf-8">
        <!---Change SEO Data Here For Title-->
        <title>Create Password IoT Academy</title> 
        <!-- responsive tag -->
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/style.min.css">
        <?php $this->load->view("commons/commonheaderlink.php") ?>
    </head>
<body class="home1 pageback">
<style type="text/css">
    .pageback{
        background: url('<?php echo asset_url();?>images/loginbg.png') no-repeat center center fixed; 
           -webkit-background-size: cover;
           -moz-background-size: cover;
           -o-background-size: cover;
           background-size: cover;
           padding-bottom:5%;
    }
    .loginsection{
        background-color:white;
        padding-top:20px;
        padding-bottom:20px ;
        opacity:0.9;
        margin:5px;
    }

    .lead,.display-4{
        color:white;
    }

    .modal-backdrop
    {
        opacity:0.9 !important;
    }
</style>
<div class="row mt-4">
    <div class="col-sm-12">
<?php if($this->session->flashdata('success')){ ?>
    <div class="alert alert-block alert-success">
        <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
        <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
    </div>
    <?php }else if($this->session->flashdata('error')){  ?>
    <div class="alert alert-block alert-danger">
        <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
        <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
    </div>
<?php } ?>
  
    <h1 class="display-5 text-center pt-3 text-white">Welcome</h1>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4 p-3">
            <div class="jumbotron loginsection">
            <form action="<?=base_url()?>CareerInstractors/createPass" method="post">
            	 <label for="loginpass" class="mt-2 mb-3">Create Password for : <strong> <?=$email_id?> </strong></label><br>
                <div class="form-group">
                	<input type="hidden" name="email_id" value="<?=$email_id?>">
                	<input type="hidden" name="id" value="<?=$id?>">
                    <label for="password">Enter Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="********" required="required">
                      <!-- <span toggle="#password-field" class="fa fa-eye 4x toggle-password"></span>
 -->
                </div>
                <div class="form-group">
                    <label for="confpassword">Confirm Password</label>
                    <input type="password" class="form-control" id="confpassword" name="confpassword" placeholder="*********" required="required">
                </div>
                
                <div align="center">
                	<br>
                    <button type="submit" class="btn btn-primary">Create Password</button><br>
                    
                </div>
            </form>
            </div>
        </div>
        <div class="col-sm-4 mt-4 pt-4 mb-4"></div>
    </div>
   </div>      
</div>
 <!-- jquery latest version -->
<script src="<?php echo asset_url()?>js/jquery.min.js"></script>
<!-- bootstrap js -->
<script src="<?php echo asset_url()?>js/bootstrap.min.js"></script>
      
<script type="text/javascript">

    $(function(){

	    $(this).toggleClass("fa-eye fa-eye-slash");
	    
	    var input = $("#loginpass");
	    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
	});

</script>
</body>
</html>