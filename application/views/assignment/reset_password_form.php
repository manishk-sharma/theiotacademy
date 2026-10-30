<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo asset_url()?>assignment/css/style.css">
    <link rel="icon" href="https://www.theiotacademy.co/assets/images/iot-academy-favicon-32x32.png" sizes="32x32" type="image/png">
</head>

<body>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="formprnt">
                <div class="formField signUpformField">
                    <div class="loginHeader">
                        <h4>Reset Password</h4>
                        <p class="mt-1">Please Enter Your New Password Carefully</p>
                    </div>
                    <div class="mt-4">
                        <form action="<?= base_url('UserController/reset_password?token=' . $token) ?>" id="forgotpassword" method="post">
                            <div class="row">
                                <div class="mb-4 col-12">
                                    <input 
                                        type="password" 
                                        name="password" 
                                        class="form-control inputfield" 
                                        placeholder="Enter New Password*"
										Required="true"
										>
			
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 btnLogin mt-4">Reset Password</button>
                        </form>
                        <p class="text text-success" id="successmsg"></p>
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
