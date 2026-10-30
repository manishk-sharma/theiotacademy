<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo asset_url()?>assignment/css/style.css">
    <link rel="icon" href="https://www.theiotacademy.co/assets/images/iot-academy-favicon-32x32.png" sizes="32x32" type="image/png">
</head>

<body>
<div id="enqform-overlay">
    <div class="enqform-cv-spinner">
        <span class="enqform-spinner"></span>
    </div>
</div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="formprnt">
                <div class="formField">
                    <div class="loginHeader">
                    <?php if($this->session->flashdata('error')){ ?>
					<p class="alert alert-block bg-dark text-white">
						 <?php echo $this->session->flashdata('error'); ?>
					</p>
					<?php } ?>
                    <?php if($this->session->flashdata('LoginMsg')){ ?>
					<p class="alert alert-success text-white" style="background:#0a640a;">
						<?php echo $this->session->flashdata('LoginMsg'); ?>
					</p>
					<?php }  
                      $this->session->unset_userdata('error');
                      $this->session->unset_userdata('LoginMsg');
                    ?>
                        <h4>Sign In</h4>
                        <p>Enter your email and password to sign in!</p>
                    </div>
                    <div class="mt-4">
                        <form action="<?php echo base_url()?>assignment-submit" method="post">
                            <div class="mb-4">
                                <label for="email" class="form-label labelColor">Email<span>*</span></label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="username" 
                                    class="form-control inputfield" 
                                    placeholder="mail@simmple.com">
                            </div>
                            <div class="mb-4">
                                <label for="email" class="form-label labelColor">Password<span>*</span></label>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    class="form-control inputfield" 
                                    placeholder="Min. 8 characters" >
                            </div>
                        
                            <div class="text-end mt-4 mb-4">
                                <a href="<?php echo base_url('assignment-forgot-password')?>" class="text-decoration-none frgtpass">Forget password?</a>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 btnLogin">Sign In</button>
                        </form>
                        
                        <p class="mt-4 text-left newaccnt">
                            Not registered yet? 
                            <a href="<?= base_url()?>assignment-register">Create An Account</a>
                        </p>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-6 d-md-block d-none">
            <div class="loginBg">
                    <div class="iotlogo">
                        <img src="<?php echo asset_url()?>assignment/images/iot-logo.png" alt="IoT Logo">
                    </div>
                    <div class="iotDesc">
                        <p>Buy Courses from here</p>
                        <p>theiotacademy.co</p>
                    </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="<?php echo asset_url()?>assignment/js/script.js"></script>

</body>
</html>
