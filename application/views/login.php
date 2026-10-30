<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tag -->
    <meta charset="utf-8">
    <!---Change SEO Data Here For Title-->
    <title>Login Pannel IoT Academy</title>
    <!-- responsive tag -->
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon -->
    <link rel="icon" href="<?= asset_url() ?>images/iot-academy-favicon-32x32.png" type="image/x-icon" />
    <meta name="keywords" content="" />
    <meta name="distribution" content="global" />
    <meta http-equiv="content-language" content="en-gb">
    <meta property="og:title" content="About The IoT Academy" />
    <meta property="og:description" content="The IoT Academy Login Page" />
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url() ?>css/style.min.css">
    <?php $this->load->view("commons/commonheaderlink.php") ?>
    <style type="text/css">
    .loginsection {
        padding: 30px 8%;
        margin-top: 50px;
        background: #e5e4e4;
    }
    </style>
</head>

<body class="instructor-home">
    <?php include "commons/header.php"; ?>
    <div class="row">
        <div class="col-sm-12 pageback">
            <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-block alert-success">
                <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
                <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php } else if ($this->session->flashdata('error')) {  ?>
            <div class="alert alert-block alert-danger">
                <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
                <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
            </div>
            <?php } ?>

            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <div class="loginsection">
                        <h1 class="display-5 text-center pt-3 text-dark mb-4">User Account Login</h1>
                        <form action="App/do_login" method="post">
                            <div class="form-group">
                                <label for="loginemail">Email Address:</label>
                                <input type="email" class="form-control" id="loginemail" name="loginemail"
                                    aria-describedby="emailHelp" placeholder="Enter Your Email" required="required">
                            </div>
                            <div class="form-group">
                                <label for="loginpass">Password</label>
                                <input type="password" class="form-control" id="loginpass" name="loginpass"
                                    placeholder="Password" required="required">
                            </div>
                            <!--<div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>-->
                            <div align="center" class="mt-4">
                                <button type="submit" class="btn btn-primary">Login Now</button><br>
                                <!-- <button type="button" class="btn btn-default btn-sm btn-warning mt-2" data-toggle="modal" 
                    data-target="#forgotPasswordModal" data-backdrop="static" data-keyboard="false">Forgot Password ?</button> -->
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4 mt-4 pt-4 mb-4"></div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Forgot Password ?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                onClick="window.location.reload();">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="jumbotron loginsection">
                                        <form action="User/forgotPassword" method="post" id="forgotform" method="post">
                                            <input type="hidden" name="otp" id="otpdataloginForm">
                                            <div class="form-group">
                                                <label for="loginemail">Email Address:</label>
                                                <input type="email" class="form-control" id="emailloginForm"
                                                    name="newemail" placeholder="Enter Your Email" required="required"
                                                    autocomplete="off">
                                                <p class="text-danger" id="email-errorloginForm"></p>
                                            </div>
                                            <div class="form-group" id="otpDiv">
                                                <label for="otp">OTP</label>
                                                <input type="number" class="form-control" id="otp" name="otp" id="otp"
                                                    placeholder="Enter OTP" required="required">

                                                <p class="mt-2 d-none" id="resendOtpTextloginForm">

                                                    Didn't get? &nbsp;&nbsp;&nbsp;

                                                    <u><a class="click text-primary"
                                                            onclick="sendOTP('otp-url','loginForm');">Resend</a></u>
                                                </p>
                                                <p class="text-danger d-none" id="hideloginForm">Invalid OTP</p>
                                            </div>
                                            <div class="form-group" id="newPasswordDiv">
                                                <label for="otp">Please Enter New Password</label>
                                                <input type="password" class="form-control" id="newpassword"
                                                    name="newpassword" placeholder="Enter Password" required="required"
                                                    maxlength="20">
                                            </div>

                                            <div align="center">
                                                <button type="button" id="send-otp" class="btn btn-primary">Send
                                                    Otp</button>
                                                <br>
                                                <button type="button" class="btn btn-warning mt-2"
                                                    id="resetPassword">Reset Password</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Modal Ends--->
    <?php include "commons/footer.php"; ?>
    <script type="text/javascript" src="<?= asset_url() ?>js/ajax/forgot_password_ajax.js"></script>

    <script type="text/javascript">
    function resendOtplogin() {

        setTimeout(function() {
            disp_text2();
        }, 40000);

    }

    function disp_text2() {

        $('#resendOtpTextloginForm').css("display", "block");

    }

    $(function() {

        $.cookie('login_status', 'null');

        $('#otpDiv').hide();
        $('#newPasswordDiv').hide();
        $('#resetPassword').hide();

        $('#send-otp').click(function() {

            var emailfield = document.getElementById('emailloginForm');
            var email = emailfield.value;
            if (email) {

                var valid = validateEmail(emailfield, 'loginForm');


                if (valid) {

                    if ($.cookie('login_status') == 'null') {

                        sendOTP('otp-url', 'loginForm');

                        $.cookie('login_status', '1');
                    }

                    resendOtplogin();

                    $('#otpDiv').show();
                    $('#newPasswordDiv').show();
                    $('#resetPassword').show();
                    $('#send-otp').hide();


                }

            } else {

                $('#email-errorloginForm').html('Please enter your valid email id first');

            }


        });

    });

    $(function() {

        $('hideloginForm').hide();
        $('#resetPassword').click(function() {

            var OtpEnterd = $('#otp').val();

            var password = $('#newpassword').val();

            var status = validateOTP(OtpEnterd, 'loginForm');
            if (status) {

                if (password.length > 8) {

                    $("#forgotform").submit();
                } else {

                }

            }



        })


    });
    </script>
</body>

</html>