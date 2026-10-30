<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo asset_url() ?>assignment/css/style.css">
    <link rel="icon" href="https://www.theiotacademy.co/assets/images/iot-academy-favicon-32x32.png" sizes="32x32"
        type="image/png">
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
                <div class="formField signUpformField">
                    <div class="loginHeader">
                        <h4>Sign Up</h4>
                        <p>Create your account by entering your details below.</p>
                        <p id="fileError"></p>
                    </div>

                    <div class="mt-4">
                        <form id="signupForm" method="post" enctype="multipart/form-data" onsubmit="return false">
                            <div class="row">
                                <div class="mb-4 col-sm-12">
                                    <input type="text" name="fullname" class="form-control inputfield"
                                        placeholder="Enter Full Name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-4 col-sm-6">
                                    <input type="tel" name="mobile" class="form-control inputfield"
                                        placeholder="Mobile No"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"
                                        minlength="8" maxlength="10">
                                </div>
                                <div class="mb-4 col-sm-6">
                                    <input type="email" name="email" class="form-control inputfield"
                                        placeholder="user@gmail.com">
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-4 col-sm-6">
                                    <select class="form-select inputfield" name="batch">
                                        <option selected disabled value="">Batch</option>
                                        <option value="Batch-1">Batch-1</option>
                                        <option value="Batch-2">Batch-2</option>
                                        <option value="Batch-3">Batch-3</option>
                                        <option value="Batch-4">Batch-4</option>
                                        <option value="Batch-5">Batch-5</option>
                                        <option value="Batch-6">Batch-6</option>
                                        <option value="Batch-7">Batch-7</option>
                                        <option value="Batch-8">Batch-8</option>
                                        <option value="Batch-9">Batch-9</option>
                                        <option value="Batch-10">Batch-10</option>
                                        <option value="Batch-11">Batch-11</option>
                                        <option value="Batch-1-6-months">Batch-1 (6 Months)</option>
                                        <option value="Batch-2-6-months">Batch-2 (6 Months)</option>
                                        <option value="Batch-3-6-months">Batch-3 (6 Months)</option>
                                        <option value="Batch-4-6-months">Batch-4 (6 Months)</option>
                                        <option value="Batch-5-6-months">Batch-5 (6 Months)</option>
                                        <option value="Batch-12">Batch-12</option>
                                        <option value="Batch-13">Batch-13</option>
                                        <option value="Batch-14">Batch-14</option>
                                        <option value="Batch-15">Batch-15</option>
                                        <option value="Batch-16">Batch-16</option>
                                    </select>
                                </div>
                                <div class="mb-4 col-sm-6">
                                    <select class="form-select inputfield" name="course">
                                        <option selected disabled value="">Course</option>
                                        <option value="Data Science, Machine Learning and AI">Data Science, Machine
                                            Learning and AI</option>
                                        <option value="DS, Machine Learning and Edge AI">DS, Machine Learning and Edge
                                            AI</option>
                                        <option value="Advanced Generative AI">Advanced Generative AI</option>
                                        <option value="Data Analyst Certification Course">Data Analyst Certification
                                            Course</option>
                                        <option
                                            value="Advanced Certification In Applied Data Analytics & Generative AI">
                                            Advanced Certification In Applied Data Analytics & Generative AI</option>
                                        <option
                                            value="Professional Program In Data Science, Machine Learning, AI & Gen AI">
                                            Professional Program In Data Science, Machine Learning, AI & Gen AI</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-sm-6">
                                    <input type="password" name="password" class="form-control inputfield"
                                        placeholder="Password">
                                </div>
                                <div class="mb-3 col-sm-6">
                                    <input type="password" name="con_password" class="form-control inputfield"
                                        placeholder="Confirm password">
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label for="choose" class="labelofdobpro">Choose Your DOB</label>
                                    <input type="date" min="1970-01-01" max="2010-01-01" name="dob"
                                        class="form-control inputfield" placeholder="Date Of Birth">
                                </div>
                                <div class="mb-2 col-12">
                                    <label for="choose" class="labelofdobpro">Choose Your Profile Image</label>
                                    <input type="file" name="profile" id="profileImage" class="form-control inputfield"
                                        accept="image/*">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 btnLogin mt-4">Sign Up</button>
                        </form>
                        <p class="text text-success" id="successmsg"></p>
                        <p class="mt-4 text-left newaccnt">
                            Already Have an Account!
                            <a href="<?= base_url() ?>assignment-login">Login</a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-6 d-md-block d-none">
            <div class="loginBg">
                <div class="iotlogo">
                    <img src="<?php echo asset_url() ?>assignment/images/iot-logo.png" alt="IoT Logo">
                </div>
                <div class="iotDesc">
                    <p>Buy Courses from here</p>
                    <p>theiotacademy.co</p>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="<?php echo asset_url() ?>assignment/js/script.js"></script>
    <script>
        document.getElementById("profileImage").addEventListener("change", function() {
            let file = this.files[0];
            if (file) {
                let fileType = file.type;
                if (!fileType.startsWith("image/")) {
                    document.getElementById("fileError").style.display = "block";
                    this.value = ""; // Clear the invalid file
                } else {
                    document.getElementById("fileError").style.display = "none";
                }
            }
        });



        function removeTags(str) {
            if ((str === null) || (str === ''))
                return false;
            else
                str = str.toString();
            return str.replace(/(<([^>]+)>)/ig, '');
        }

        document.getElementById("signupForm").addEventListener("submit", function(e) {
            e.preventDefault();
            const formUrl = '<?php echo base_url('assignment-register-submit'); ?>';
            const formData = new FormData(this);
            document.getElementById("enqform-overlay").style.display = "block";
            fetch(formUrl, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.message === "error") {
                        alert(removeTags(data.response));
                        document.getElementById("enqform-overlay").style.display = "none";
                    } else if (data.message === "success") {
                        document.getElementById("enqform-overlay").style.display = "none";
                        const sngMsg = document.getElementById('successmsg');
                        sngMsg.innerHTML = data.response;
                        setTimeout(() => {
                            sngMsg.style.display = 'none';
                        }, 15000);
                        document.getElementById("signupForm").reset();
                        window.location.href = "<?php echo base_url('assignment-login'); ?>";

                    } else {
                        console.error("Unexpected response:", data);
                    }
                })
        });
    </script>
</body>

</html>